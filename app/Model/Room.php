<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    protected $table = 'room';
    protected $fillable = [
        'room_name',
        'created_at',
        'updated_at',
        'user_id',
        'room_cover',
        'living_token',
        'hot',
        'care_num',
        'status'
    ];

    public static function getLivingRooms(){
        return Room::where('status', '=', 2)->get();
    }

    public static function getHotRoom(){
        return Room::where('status', '=', 2)->orderBy('hot', 'desc')->first();
    }

    public function user(){
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }
}
