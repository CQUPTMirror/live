@extends('layouts.layout')
@section('title', '登录')
@section('content')
    <form action="{{route('login')}}" method="post">
        <div class="form-group">
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="text" name="username" class="form-control"  style="height: inherit">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input id="inputPassword" type="password" name="password" class="form-control" >
                </div>
                <div class="col-md-4"></div>
            </div>
            {{ csrf_field() }}
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">登录</button>
            </div>
        </div>
    </form>
@endsection