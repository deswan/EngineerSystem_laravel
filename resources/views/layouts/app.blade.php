<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="@yield('css')" rel="stylesheet">
    <link href="http://vjs.zencdn.net/5.0.2/video-js.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>

<div class="nav">
    <div class="logo_area">
        <a href="/"><img src="{{asset('images/logo.jpg')}}"></a>
    </div>
    <div class="main_nav">
        <ul>
            <li><a href="/course_list">课程</a></li>
            <li><a href="/news/2">资讯</a></li>
        </ul>
    </div>
    <div class="p_data">

        <ul>

            @if(Auth::check())
                <li class="admin_l">
                <a class="admin_a" href="#"><img src="{{asset('images/logo2.jpg')}}"><span>{{Auth::user()->name}}</span></a>
                    <ul class="admin_s_l">
                        <li><a href="/user/courses">我的课程</a></li>
                    </ul>
                </li>
                <li><a href="/user/logout">退出</a></li>
            @elseif(Auth::guard('admin')->check())
                <li class="admin_l">
                <a class="admin_a" href="#"><img src="{{asset('images/logo2.jpg')}}"><span>{{Auth::guard('admin')->user()->name}}</span></a>
                    <ul class="admin_s_l">
                        <li><a href="/admin/courses">我的课程</a></li>
                        <li><a href="/admin/news">我的资讯</a></li>
                    </ul>
                </li>
                <li><a href="/admin/logout">退出</a></li>
            @else
                <li class="admin_l">
                <a class="admin_a" href="/user/login"><img src="{{asset('images/logo2.jpg')}}">登陆</a>
                </li>
            @endif
        </ul>

    </div>
</div>

@section('main')
@show
<script type="text/javascript">
    $(function(){

        $(".admin_l").hover(function(){

            $(".admin_a").css({"background":"#fff","color":"#2c81c8"});

            $(".admin_a img").attr("src","/images/logo2_c.jpg");

            $(".admin_s_l").css({"display":"block"});
        },function(){
            $(".admin_a").css({"background":"#2c81c8","color":"#fff"});
            $(".admin_a img").attr("src","/images/logo2.jpg");
            $(".admin_s_l").css({"display":"none"});
        });
        $('.admin_a span').text($('.admin_a span').text().substr(0,5));
    })

</script>
</body>
</html>
</body>
</html>
