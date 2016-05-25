<?php

namespace App\Http\Controllers;

use App\Model\Room;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller {

    //首页
    public function index(){
        $roomList = Room::getLivingRooms();
        foreach ($roomList as $room){
            $room->user;
        }
        $hotRoom = Room::getHotRoom();
        $hotRoom->user;

        return view('FrontEnd.index')->with('roomList', $roomList)->with('hotRoom', $hotRoom);
    }
    
}
