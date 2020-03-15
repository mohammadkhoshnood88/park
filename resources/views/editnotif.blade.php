<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | پیام های محیطی</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">

    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

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
                            <div class="clearfix" style="font-size: 12px">مدیریت پیام ها/ پیام های محیطی/ بیکن {{$beacon_name}}</div>
                        </div>
                        <div class="x_content">

                            <br/>
                            <!-- page content -->
                            <form method="post" action="{{route('notif_update')}}" id="demo-form2"
                                  data-parsley-validate class="form-horizontal form-label-left">
                                {{csrf_field()}}
                                <input type="hidden" name="beacon_mac" value="{{$notifs->beacon_mac}}">

                                <div class="form-check col-md-4">
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="x_panel_notif"
                                         style="background:#34495e;color:white;border-radius: 3px; box-shadow: 5px 5px 5px #a858ec">
                                        <div>
                                            <br/>
                                            <form class="form-horizontal form-label-left">

                                                <div class="form-group">
                                                    <label style="text-align: right" class="control-label col-md-3 col-sm-3 col-xs-12">متن
                                                        پیام : </label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                                        <textarea style="text-align: right" type="text" name="txt" class="form-control"
                                                                  placeholder="متن پیام">
                                                           {{!empty($notifs->txt) ? $notifs->txt : ""}}
                                                        </textarea>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <label style="text-align: right" class="control-label col-md-3 col-sm-3 col-xs-12">آدرس
                                                        URL : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input type="text" name="url" class="form-control"
                                                               value="{{!empty($notifs->url) ? $notifs->url : ""}}"
                                                               placeholder="مثال:www.pspace.ir">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <label style="text-align: right" class="control-label col-md-3 col-sm-3 col-xs-12">بارگزاری
                                                        تصویر : </label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
<span class="btnn btn-uploadd btn-filee">
            <span class="fa fa-upload"></span>   بارگزاری<input type="file" name="file">
                    </span>                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>

                                                <div class="form-group" style="margin-right: 25px">
                                                    <label class="btn col-md-5" style="background: blue" id="offer_click" onclick="offer()">فعال سازی تخفیف</label>
                                                    <label class="control-label col-md-3 col-sm-6 col-xs-12" id="offer">درصد : </label>
                                                    <div class="col-md-2 col-sm-4 col-xs-12" id="offer-box">
                                                        <input type="hidden" id="offer_set" name="offer_set" value="0">
                                                        <input readonly="readonly" type="text" name="offer_percent" id="offer_percent" class="form-control"
                                                               value="{{!empty($notifs->offer_percent) ? $notifs->offer_percent : ""}}">
                                                    </div>
                                                    {{--<div class="col-md-1">--}}
                                                    {{--<input type="checkbox" class="flat">--}}
                                                    {{--</div>--}}
                                                </div>


                                                <div class="ln_solid"></div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">دسته بندی
                                                        :</label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                                        <select name="favorite" class="form-control">
                                                            @foreach($favorites as $favorite)
                                                            <option>{{$favorite->favorite}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" style="text-align: right">دسته
                                                        بندی جدید :</label>
                                                    <div class="col-md-6 form-group" style="margin: 5px"><input
                                                                type="text" name="newfavorite" class="form-control">
                                                    </div>

                                                </div>


                                                <div class="ln_solid"></div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <button type="submit" class="btn btn-success">ثبت</button>
                                            <a href="{{route('notif_create')}}" class="btn btn-danger">بازگشت</a>
                                        </div>
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

<script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

@extends('layout.footer')
<script>
    function offer() {
        $('#offer_set').val("1");
        document.getElementById("offer_click").style["background"] = "red";
        document.getElementById("offer_click").innerHTML = "غیر فعال سازی تخفیف";
        document.getElementById("offer_percent").removeAttribute("readonly");
        document.getElementById("offer_click").removeAttribute("onclick");
        document.getElementById("offer_click").setAttribute("onclick" , "nooffer()");
    }
    function nooffer() {
        $('#offer_set').val("0");
        $('#offer_percent').val("");
        document.getElementById("offer_click").style["background"] = "blue";
        document.getElementById("offer_click").innerHTML = "فعال سازی تخفیف";
        document.getElementById("offer_percent").setAttribute("readonly" , "readonly");
        document.getElementById("offer_click").removeAttribute("onclick");
        document.getElementById("offer_click").setAttribute("onclick" , "offer()");
    }

</script>
<style>
    .btn-filee input[type=file] {
        position: absolute;
        top: 0;
        width: 80px;
        height: 40px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .btn-uploadd {
        color: #fff;
        background-color: #5bc0de;
        border-color: #46b8da;
        width: 100px;
    }

    .btnn {
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
</body>
</html>

{{--@endsection--}}

