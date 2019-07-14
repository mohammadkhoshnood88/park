@extends('layout.main')
@section('title')
    صفحه اول
@endsection
@section('header')
    <script src="{{asset('css/vendors/switchery/dist/switchery.min.js')}}"></script>
@endsection
@section('content')
    @if(count($profile)==0)
        <div class="alert-danger" style="padding-right: 3px"><strong class="text-dark">پروفایل خود را کامل
                کنید.</strong> برای این منظور به قسمت حساب کاربری از فهرست سمت راست بروید.
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> تعداد کاربران سامانه</span>
                <div class="count">{{$user_admin}}</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن های ثبت شده در سامانه</span>
                <div class="count">{{$beacon_admin}}</div>
            </div>
        </div>

        <div class="row">
            <div class="x_panel" style="border: none;padding-right: 4px;padding-left: 4px">
                <div class="x_title">
                    <div class="clearfix" style="text-align: center;font-size: 15px">
                        مدیریت کاربران
                    </div>
                </div>
                <div class="x_content">
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="width: 500px">
                            <thead style="background: #a1cbef;color: white">
                            <th class="column-title">ردیف</th>
                            <th class="column-title">نام</th>
                            <th class="column-title">شماره موبایل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_not_register as $j => $unr)
                                <tr class="even pointer">
                                    <td class="a-center">
                                        {{$j+1}}
                                    </td>
                                    <td>{{$unr->name}}</td>
                                    <td>{{$unr->mobile}}</td>
                                    <td>
                                        <label>
                                            <input type="checkbox" class="js-switch"/>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
            @elseif(\Illuminate\Support\Facades\Auth::user()->isadmin==0 && \Illuminate\Support\Facades\Auth::user()->isuser==1)
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-shopping-cart"></i> تعداد بازدید فروشگاه</span>
                        <div class="count">{{$visit_shop}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> تعداد بازدید منحصر به فرد</span>
                        <div class="count">{{$unicount}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن ها</span>
                        <div class="count">{{$beacon_shop}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-tasks"></i> تعداد بازی ها</span>
                        <div class="count">{{$race_shop}}</div>
                    </div>
                </div>
    @endif

@endsection


{{--<div class="right_col" role="main">--}}
{{--<div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
{{--<div class="x_panel">--}}
{{--<div class="x_title">--}}

{{--<div class="clearfix">مدیریت کاربران</div>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}