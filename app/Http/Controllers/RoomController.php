<?php

namespace App\Http\Controllers;

use App\Model\Room;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller {

    public function index(){
        return Redirect::to(route('index'));
    }

    public function show($roomId){
        $room = Room::find($roomId);
        if ($room){
            $room->user;
            return view('FrontEnd.room')->with('room', $room);
        }
        return abort(404);
    }
}
