@extends('layout.main')
@section('title')
    صفحه اول
    @endsection
@section('content')

    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> تعداد کاربران سامانه</span>
                <div class="count">20</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن های ثبت شده در سامانه</span>
                <div class="count">20</div>
            </div>
        </div>
    @elseif(\Illuminate\Support\Facades\Auth::user()->isadmin==0 && \Illuminate\Support\Facades\Auth::user()->isuser==1)
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> تعداد بازدید فروشگاه</span>
                <div class="count">20</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن ها</span>
                <div class="count">20</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-tasks"></i> تعداد مسابقات</span>
                <div class="count">20</div>
            </div>
        </div>
    @endif
    @endsection