@extends('layouts.layout')
@section('title', '直播')
@section('content')
    <div class="row">
        <div class="col-md-3"><h3>热门直播</h3></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    @if($hotRoom['id'])
    <div class="row text-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 center-block">
                    <a href="{{route('room.show', ['id'=>$hotRoom['id']])}}">
                        <img src="{{asset('uploads/'.$hotRoom['room_cover'])}}" class="img-responsive img-rounded" alt="">
                    </a>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4>主播: {{$hotRoom['user']['nickname']}}</h4></div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    @else
    <div class="row text-center">
        <div class="col-md-12">没有直播</div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3"><h3>房间列表</h3></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row text-center center-block">
        @forelse ($roomList as $room)
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('room.show', ['id'=>$room['id']])}}">
                                <img src="{{asset('uploads/'.$room['room_cover'])}}" class="img-responsive img-rounded" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><h4>主播: {{$room['user']['nickname']}}</h4></div>
                    </div>
                </div>
        @empty
            <div class="col-md-12">
                <h4><p>暂无直播</p></h4>
            </div>
        @endforelse
    </div>

@endsection