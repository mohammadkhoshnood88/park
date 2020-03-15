<div class="col-md-3 left_col hidden-print">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <a href="{{route('home')}}" class="site_title"><i class="fa fa-hand-o-left"></i> <span>offera</span></a>
        </div>

    {{--<div class="clearfix"></div>--}}
    <!-- menu profile quick info -->
        <div class="profile clearfix">
            {{--<div class="profile_pic">--}}
            {{--<img src="../build/images/img.jpg" alt="..." class="img-circle profile_img">--}}
            {{--</div>--}}
            <div class="profile_info" style="text-align: center;padding-bottom: 10px">
                <h2><i class="profile_pic"></i><i class="fa fa-user"></i> {{auth()->user()->name}} (<span
                            style="text-align: center;">{{auth()->user()->isadmin===1? "مدیر سامانه" : "کاربر سامانه"}}</span>)
                </h2>

            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-pencil-square"></i> اطلاعات پایه <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin == 1)
                                <li><a href="{{route('information_create')}}">دسته بندی</a></li>
                            @endif
                            <li><a href="{{route('information_add_create')}}">طبقه بندی/موقعیت</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bullseye"></i> مدیریت بیکن ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('beacon_create')}}">تعریف بیکن</a></li>
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin == 1)
                                <li><a href="{{route('shops-beacons')}}">بیکن فروشگاه ها</a></li>
                            @endif
                        </ul>
                    </li>
                    <li disabled="disabled"><a><i class="fa fa-rss"></i> مدیریت پیام ها <span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('notif_create')}}">پیام های محیطی</a></li>
                            <li><a href="{{route('message_create')}}">پیام های عمومی</a></li>
                            <li><a href="{{route('qrcode_create')}}">پیام های qrcode</a></li>
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin == 1)
                                <li><a href="{{route('shops_messages_manage')}}">پیام های فروشگاه ها</a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart"></i> گزارش ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('iot')}}">نمایش جدولی</a></li>
                            <li><a href="{{route('iot-chart')}}">نمایش نموداری</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-gamepad"></i>مدیریت بازی ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('shop_create')}}">ایجاد بازی جدید</a></li>
                            <li><a href="{{route('shop_race_status')}}">وضعیت بازی ها</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i> حساب کاربری <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin == 1)
                                <li><a href="{{url(route('profile_create'))}}">مشخصات مرکز تجاری</a></li>
                                <li><a href="{{url(route('user_messages_show'))}}">مدیریت پیام های کاربران</a></li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin ==0)
                                <li><a href="{{url(route('profile_create'))}}">پروفایل شخصی</a></li>
                            @endif
                            <li><a href="{{url('/logout')}}">خروج از پنل</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>
</div>

<div class="top_nav hidden-print">
    <div class="nav_menu" style="background: #34495E">
        <nav>
            <div class="nav toggle" style="margin-bottom: 10px">
                <a id="menu_toggle"><i style="color: #F7F7F7 !important;" class="fa fa-bars"></i></a>
            </div>
            <div class="page-title">

                <ul class="nav navbar-right" style="margin: 0px 5px 5px 5px;">
                    <li>
                        <a style="border-radius: 4px;color: #F7F7F7 !important;" href="{{url('/logout')}}"
                           class="user-profile"><i class="fa fa-power-off"></i> خروج</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>