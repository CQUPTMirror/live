<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use App\Model\Room;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller {

    //登录
    public function index(){
        if (Auth::check()) {
            return Redirect::to(route('upspace'));
        }
        return view('FrontEnd.login');
    }

    //用户空间
    public function space(){
        $room = Room::where('user_id', '=', Auth::id())->first();
        $room_id = $room['id'];
        $room_status = $room['status'];
        return view('FrontEnd.userspace')->with('room_id', $room_id)->with('room_status', $room_status);
    }


    //注册
    private function register($input){
        $num = User::where('uid', '=', $input['username'])->count();
        if($num!=0){
            $error = '你已注册';
            return Redirect::back()->withErrors($error, 'register');
        }
        $result = $this->curl_api(['user' => $input['username'], 'password' => $input['password']], 'http://hongyan.cqupt.edu.cn/RedCenter/Api/Handle/login');
        if ($result['status'] == 200) {
            $num = User::where('uid', '=', $input['username'])->count();
            if($num!=0){
                return 'error';
            }
            $data = array(
                'username' => $input['username'],
                'uid' => $input['username'],
                'password' => Hash::make($input['password']),
                'status' => 1
            );
            User::create($data);
            return true;
        }
        else{
            $info = '账号或密码有误, 点击<a href="http://hongyan.cqupt.edu.cn/RedCenter/index.php/Home/ForgetPassword/">找回密码</a>';
            return  Redirect::back()->withInput()->withErrors($info, 'register');
        }
    }

    //登录
    public function login(Request $request){
        $input = Input::all();
        $num = User::where('uid', '=', $input['username'])->count();
        if($num > 0) {
            $result = $this->curl_api(['user' => $input['username'], 'password' => $input['password']], 'http://hongyan.cqupt.edu.cn/RedCenter/Api/Handle/login');
            if ($result['status'] == 200) {
                if ($this->verify($request)) { //todo 更新密码
                    $nickname = User::where('uid', '=', $input['username'])->first();
                    Session::put('nickname', $nickname['username']);
                    Session::put('uid', $nickname['id']);
                    return Redirect::to('upspace');
                }
                else{
                    $info = '用户名或密码错误';
                    return Redirect::back()->withInput()->withErrors($info, 'login');
                }
            }
            else{
                $info = '用户名或密码错误';
                return Redirect::back()->withInput()->withErrors($info, 'login');
            }
        }
        elseif($num <= 0){
            if($this->register($input)){

                if($this->verify($request)){

                    $nickname = User::where('uid', '=', $input['username'])->first();
                    Session::put('nickname', $nickname['username']);
                    Session::put('uid', $nickname['id']);
                    return Redirect::to('/');
                }
                else{
                    $info = '用户名或密码错误';
                    return Redirect::back()->withInput()->withErrors($info, 'login');
                }
            }

        }
        else{
            $info = '用户名或密码错误';
            return Redirect::back()->withInput()->withErrors($info, 'login');
        }
    }
    
    //登录验证
    private function verify($request){
        $rules = array(
            'username' => 'required',
            'password' =>' required',
        );

        $this->validate($request, $rules);
        if(Auth::attempt(['username' => $request['username'], 'password' => $request['password']], true)){
            return true;
        };
        return false;
    }
    /*curl通用函数*/
    private function curl_api($data = array(), $url){

        // 初始化一个curl对象
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        // 运行curl，获取网页。
        $contents = json_decode(curl_exec($ch),true);
        // 关闭请求
        curl_close($ch);
        return $contents;
    }
}
