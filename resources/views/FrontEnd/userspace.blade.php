@extends('layouts.layout')
@section('title', '用户空间')
@section('content')
    @if($room_id)
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-success">{{$room_status == 2 ? '关闭直播':'获取直播码'}}</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 code text-center">
            @if($room_status == 2)
                {{'直播地址: rtmp://172.22.161.91/live <br>直播码: live_room_id_'.$room_id.'?room_id='.$room_id.'&user_id='.Auth::id().'&token='.$room['living_token']}}
            @endif
        </div>
    </div>
    <script>
        @if($room_status != 2)
            $("button").on('click', function () {
                $.ajax({
                    type: "post",
                    url: "{{route('room.update', ['roomId' => $room_id])}}",
                    data: {'user_id': "{{Auth::id()}}", '_token':"{{csrf_token()}}"},
                    dataType: "json",
                    success: function(data){
                        if(data.status != 200){
                            alert(data.info);
                        } else {
                         $(".code").html('直播地址: rtmp://172.22.161.91/live'+'<br>直播码: ' + data.data);
                        }
                    }
                })
            })
        @else
            $("button").on('click', function () {
            $.ajax({
                type: "post",
                url: "{{route('room.destroy', ['roomId' => $room_id])}}",
                data: {'user_id': "{{Auth::id()}}", '_token':"{{csrf_token()}}"},
                dataType: "json",
                success: function(data){
                    alert(data.info);
                }
            })
        })
        @endif
    </script>
    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-success">申请直播间</button>
            </div>
        </div>
        <script>
            $("button").on('click', function () {
                $.ajax({
                    type: "post",
                    url: "{{route('room.apply')}}",
                    data: {'user_id': "{{Auth::id()}}", '_token':"{{csrf_token()}}"},
                    dataType: "json",
                    success: function(data){
                        alert(data.info);
                    }
                })
            })
        </script>
    @endif
@endsection