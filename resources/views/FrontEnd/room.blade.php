@extends('layouts.layout')
@section('title', $room['user']['nickname'].'的直播间')
@section('style')
    <link rel="stylesheet" href="{{asset('css/videojs.css')}}">
@endsection

@section('script')
    <script src="{{asset('js/video.js')}}"></script>
    <script src="{{asset('js/videojs-contrib-hls.min.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{$room['room_name']}}</h1>
        </div>
    </div>
    @if($room['status'] == 2)
        <div class="row">
            <div class="col-md-12 text-center center-block">
                <video id="live-video" width="1280" height="720" class="video-js vjs-default-skin center-block" controls>
                </video>
            </div>
        </div>
    @elseif($room['status'] == 0)
        主播被封了
    @else
        主播撩妹去了
    @endif
    <div class="row">
        <div class="col-md-12">
            我是评论区
        </div>
    </div>
    <script>
        rtmp = '<source src="rtmp://172.22.161.91/live/live_room_id_{{$room['id']}}" type="rtmp/flv">';
        hls = '<source src="http://172.22.161.91/live/live_room_id_{{$room['id']}}.m3u8" type="application/x-mpegURL">'
        if(navigator.userAgent.indexOf('Mobile') > 0){
            $('#live-video').append(hls);
            console.log('hls');
        } else {
            $('#live-video').append(rtmp);
            console.log('rtmp');
        }
        var player = videojs('live-video');
        player.play();
    </script>
@endsection