<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | @yield('title')</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">

    @yield('header')
</head>


<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('layout.menu')

        <div class="right_col" role="main">
            <div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <div class="clearfix">@yield('subtitle')</div>
                            </div>
                            <div class="x_content">
                                <br/>
    <!-- page content -->
    @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- /page content -->

    </div>
</div>

@extends('layout.footer')
@yield('footer')
</body>
</html>