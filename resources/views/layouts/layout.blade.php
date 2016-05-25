<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('style')
    @yield('script')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <nav class="text-center navbar">
        <div class="row">
            <div class="col-md-12">
                <h4>
                    @Author Lich
                </h4>
            </div>
        </div>
    </nav>
</body>
</html>