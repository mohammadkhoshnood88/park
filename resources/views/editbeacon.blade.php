<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title> سیستم مدیریت تبلیغات هوشمند</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


            <div class="x_title clearfix">
                <h3>فرم ویرایش بیکن {{$beacons[0]->name}} </h3>
            </div>

            <div class="x_content">
                <br/>
                <br/>

                <form method="post" action="{{route('beacon.update', ['beacon' => $beacons[0]->mac_address])}}" id="demo-form2"
                      data-parsley-validate class="form-horizontal form-label-left">
                    {!! method_field('PUT') !!}
                    <input type="hidden" name="_method" value="PUT"/>
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="x_panel_notif"
                             style="background:#34495e;color:white;border-radius: 3px; box-shadow: 5px 5px 5px #a858ec;padding: 4px;margin-bottom: 12px">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;" for="name">نام بیکن
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"
                                           name="name" value="{{$beacons[0]->name}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;" for="uuid">uuid
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="uuid" value="{{$beacons[0]->uuid}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;">mac_address
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="beacon_mac"
                                           class="date-picker form-control col-md-7 col-xs-12"
                                           value="{{$beacons[0]->mac_address}}" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name"
                                       class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;">major</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" type="text"
                                           value="{{$beacons[0]->major}}"
                                           name="major">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;">minor
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="minor" class="date-picker form-control col-md-7 col-xs-12"
                                           value="{{$beacons[0]->minor}}" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: center;">tx
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="tx" id="birthday"
                                           class="date-picker form-control col-md-7 col-xs-12"
                                           value="{{$beacons[0]->tx}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5" style="background:#34495e;color:white;border-radius: 3px; box-shadow: 5px 5px 5px #a858ec;padding: 4px;margin-bottom: 12px">

                        <div class="form-group col-md-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">طبقه بندی</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="date-picker form-control col-md-7 col-xs-12"
                                       value="{{$beacons[0]->group}}" type="text" readonly>
                                <select name="group" class="form-control">
                                    <option>انتخاب گزینه</option>
                                    @foreach($groups as $group)
                                        <option>{{$group}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">موقعیت مکانی</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="date-picker form-control col-md-7 col-xs-12"
                                       value="{{$beacons[0]->location}}" type="text" readonly>
                                <select name="location" class="form-control">
                                    <option>انتخاب گزینه</option>
                                    @foreach($locations as $location)
                                        <option>{{$location}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">ثبت</button>
                            <a href="{{route('beacon_create')}}" class="btn btn-danger">بازگشت</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
@extends('layout.footer')