<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | اسپیس</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    {{--<link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"--}}
          {{--rel="stylesheet">--}}

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">

    @yield('header')
</head>


<body class="home_body">
<nav class="navbar navbar-expand-lg navbar-light bg-light home_top_menu">
    <a class="navbar-brand" href="#">pace space</a>

    <div class="home_menu">
        <div class="navbar-nav home_menu_li right row">
            <a class="nav-item" href="#">ثبت نام در اسپیس</a>
            <a class="nav-item" href="#">خرید بیکن</a>
            <a class="nav-item" href="#">ارتباط با ما</a>

        </div>
        <div class="home_menu_li left">
            <a class="nav-item loginp login_content" href="{{url('http://pspace.ir/login')}}">ورود به پنل مدیریت</a>
        </div>
    </div>
</nav>

<div class="home_image_menu">تبلیغات محیطی هوشمند پیس اسپیس<br>(PaceSpace)</div>

</body>
</html>