@extends('layout.main')
@section('title')
    صفحه اول
    @endsection
@section('content')
    @if(count($profile)==0)
        <div class="alert-danger" style="padding-right: 3px"><strong class="text-dark">پروفایل خود را کامل کنید.</strong> برای این منظور به قسمت حساب کاربری از فهرست سمت راست بروید.</div>
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