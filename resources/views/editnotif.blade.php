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
                            {{--                            فروشگاه {{}}--}}
                            <div class="clearfix">مدیریت بیکن {{$beacon_name}}</div>
                        </div>
                        <div class="x_content">

                            <br/>
                            <!-- page content -->
                            <form method="post" action="{{route('notif_update'))}}" id="demo-form2"
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
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">متن
                                                        پیام : </label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                                        <textarea type="text" name="txt" class="form-control"
                                                                  placeholder="متن پیام"></textarea>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">آدرس
                                                        URL : </label>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <input type="text" name="url" class="form-control"
                                                               placeholder="مثال:www.pspace.ir">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">آپلود
                                                        تصویر : </label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                                        <input type="file" name="pic">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input type="checkbox" class="flat">
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">دسته بندی
                                                        :</label>
                                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                                        <select name="favorite" class="form-control">
                                                            <option>انتخاب گزینه</option>
                                                            <option>انتخاب گزینه</option>
                                                            <option>انتخاب گزینه</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group right">
                                                    <label class="control-label col-md-4" style="text-align: right">دسته بندی جدید :</label>
                                                    <div class="col-md-6 form-group" style="margin: 5px"><input type="text" name="newfavorite" class="form-control"></div>

                                                </div>

                                                {{--<div class="form-group">--}}
                                                {{--<label class="control-label col-md-3 col-sm-3 col-xs-12">آپلود--}}
                                                {{--فیلم : </label>--}}
                                                {{--<div class="col-md-8 col-sm-9 col-xs-12">--}}
                                                {{--<input type="file" name="vid">--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-1">--}}
                                                {{--<input type="checkbox" class="flat">--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="ln_solid"></div>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <button type="submit" class="btn btn-success">ارسال</button>
                                            <a href="{{route('notif_create')}}" class="btn btn-danger">بازگشت</a>
                                        </div>
                                    </div>
                                </div>

                            {{--<div class="row">--}}

                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="ln_solid"></div>--}}
                            {{--<label>متن پیام :</label>--}}
                            {{--<textarea class="form-control" name="txt" placeholder="متن را وارد کنید"--}}
                            {{-->{{$notifs->txt === "تعیین نشده است" ? "" : $notifs->txt}}</textarea>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="ln_solid"></div>--}}
                            {{--<label>آدرس URL :</label>--}}
                            {{--<input type="text" name="url"--}}
                            {{--value="{{$notifs->url === "تعیین نشده است" ? "" : $notifs->url}}"--}}
                            {{--placeholder="{{$notifs->url === "تعیین نشده است" ? "url را وارد کنید" : ""}}"--}}
                            {{--class="form-control col-md-7 col-xs-12">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="ln_solid"></div>--}}
                            {{--<label>آپلود تصویر :</label>--}}
                            {{--<input type="file" name="pic"--}}
                            {{--value="{{$notifs->pic === "تعیین نشده است" ? "" : $notifs->pic}}"--}}
                            {{--placeholder="{{$notifs->pic === "تعیین نشده است" ? "آدرس عکس را وارد کنید" : ""}}"--}}
                            {{--class="form-control col-md-7 col-xs-12">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="ln_solid"></div>--}}
                            {{--<label>آپلود فیلم :</label>--}}
                            {{--<input type="file" name="vid"--}}
                            {{--value="{{$notifs->vid === "تعیین نشده است" ? "" : $notifs->vid}}"--}}
                            {{--placeholder="{{$notifs->vid === "تعیین نشده است" ? "آدرس فیلم را وارد کنید" : ""}}"--}}
                            {{--class="form-control col-md-7 col-xs-12">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="ln_solid"></div>--}}
                            {{--<br>--}}
                            {{--<button type="submit" class="btn btn-primary">تایید</button>--}}
                            {{--<a href="{{url('/api/notif/create')}}" class="btn btn-danger">بازگشت</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            {{--<div class="x_panel" style="background: black">--}}

                            {{--شما برای این بیکن می توانید 3 پیام متمایز تعریف کنید.--}}
                            {{--<div class="" role="tabpanel" data-example-id="togglable-tabs">--}}
                            {{--<ul id="myTab" class="nav nav-tabs bar_tabs right" role="tablist">--}}
                            {{--<li role="presentation" class="active"><a href="#tab_content1"--}}
                            {{--id="home-tab" role="tab"--}}
                            {{--data-toggle="tab"--}}
                            {{--aria-expanded="true">پیام--}}
                            {{--1</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation" class=""><a href="#tab_content2" role="tab"--}}
                            {{--id="profile-tab"--}}
                            {{--data-toggle="tab"--}}
                            {{--aria-expanded="false">پیام 2</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation" class=""><a href="#tab_content3" role="tab"--}}
                            {{--id="profile-tab2"--}}
                            {{--data-toggle="tab"--}}
                            {{--aria-expanded="false">پیام 3</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div id="myTabContent" class="tab-content">--}}
                            {{--<div role="tabpanel" class="tab-pane fade active in" id="tab_content1"--}}
                            {{--aria-labelledby="home-tab">--}}
                            {{--sfddfasfsa--}}
                            {{--</div>--}}
                            {{--<div role="tabpanel" class="tab-pane fade" id="tab_content2"--}}
                            {{--aria-labelledby="profile-tab">--}}
                            {{--</div>--}}
                            {{--<div role="tabpanel" class="tab-pane fade" id="tab_content3"--}}
                            {{--aria-labelledby="profile-tab">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                            {{--</div>--}}
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layout.footer')
<style>
    #panel {
        display: none;
    }
</style>

</body>
</html>

{{--@endsection--}}

