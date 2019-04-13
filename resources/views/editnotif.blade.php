<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | اعلانات</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">

</head>


<body class="nav-md">
<div class="container body">
    <div class="main_container">
        {{--@include('layout.menu')--}}

        {{--<div class="right_col" role="main">--}}
            <div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                {{auth()->user()->name}}
                                <div class="clearfix">مدیریت بیکن {{$notifs->uuid}}</div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <!-- page content -->
                                <form method="post" action="{{url('api/notif/update')}}" id="demo-form2"
                                      data-parsley-validate class="form-horizontal form-label-left">
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <input type="hidden" name="name" value="{{$notifs->uuid}}">

                                        <input type="hidden" name="uuid" value="{{$notifs->uuid}}">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <label>فاصله :</label>
                                                <span>در چه فاصله ای از بیکن شما، پیغام ارسال شود؟</span>
                                                <input type="text" name="dis" value="{{$notifs->dis === "تعیین نشده است" ? "" : $notifs->dis}}" placeholder="{{$notifs->dis === "تعیین نشده است" ? "فاصله را وارد کنید" : ""}}"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <label>متن پیام :</label>
                                <textarea class="form-control" name="txt" placeholder="متن را وارد کنید"
                                >{{$notifs->txt === "تعیین نشده است" ? "" : $notifs->txt}}</textarea>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <label>آدرس URL :</label>
                                                <input type="text" name="url" value="{{$notifs->url === "تعیین نشده است" ? "" : $notifs->url}}" placeholder="{{$notifs->url === "تعیین نشده است" ? "url را وارد کنید" : ""}}"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <label>آپلود تصویر :</label>
                                                <input type="file" name="pic" value="{{$notifs->pic === "تعیین نشده است" ? "" : $notifs->pic}}" placeholder="{{$notifs->pic === "تعیین نشده است" ? "آدرس عکس را وارد کنید" : ""}}"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <label>آپلود فیلم :</label>
                                                <input type="file" name="vid" value="{{$notifs->vid === "تعیین نشده است" ? "" : $notifs->vid}}" placeholder="{{$notifs->vid === "تعیین نشده است" ? "آدرس فیلم را وارد کنید" : ""}}"
                                                       class="form-control col-md-7 col-xs-12">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="ln_solid"></div>
                                                <br>
                                                <button type="submit" class="btn btn-primary">تایید</button>
                                            </div>
                                        </div>
                                    </div>




                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /page content -->

    </div>
{{--</div>--}}

@extends('layout.footer')

</body>
</html>

{{--@endsection--}}

