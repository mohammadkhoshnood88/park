<div class="col-md-3 left_col hidden-print">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{'/'}}" class="site_title"><i class="fa fa-star-half-empty"></i> <span>تبلیغات هوشمند</span></a>
        </div>

    {{--<div class="clearfix"></div>--}}
    <!-- menu profile quick info -->
        <div class="profile clearfix">
            {{--<div class="profile_pic">--}}

            {{--<img src="../build/images/img.jpg" alt="..." class="img-circle profile_img">--}}
            {{--</div>--}}
            <div class="profile_info" style="text-align: center">
                <h2><i class="profile_pic fa fa-user"></i>{{auth()->user()->name}}</h2>
                <span style="text-align: center;">{{auth()->user()->isadmin==="1"? "مدیر سایت" : "کاربر سایت"}}</span>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>فهرست</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> اطلاعات پایه <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{'/api/information/create'}}">ورود</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i> مدیریت بیکن ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{'/api/beacon/create'}}">ورود</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i> مدیریت نوتیفیکشن ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{'/api/notif/create'}}">ورود</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-bar-chart"></i> گزارشات <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{'/api/iot'}}">نمایش جدولی</a></li>
                            <li><a href="#">نمایش نموداری</a></li>
                        </ul>
                    </li><li><a><i class="fa fa-home"></i> حساب کاربری <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">پروفایل شخصی</a></li>
                            <li><a href="{{'/api/setshop'}}">ایجاد مسابقه</a></li>
                            <li><a href="{{url('/logout')}}">خروج از پنل</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>

    </div>
</div>

<div class="top_nav hidden-print">
    <div class="nav_menu" style="background: #34495e">
        <nav>
            <div class="nav toggle" style="margin-bottom: 10px">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div class="page-title">

                <ul class="nav navbar-right">
                    <li>
                        <a href="{{url('/logout')}}" class="user-profile"><i class="fa fa-power-off"></i>  خروج</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>