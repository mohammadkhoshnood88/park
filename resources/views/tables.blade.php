@extends('layout.main')

<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col hidden-print">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{'/'}}" class="site_title"><i class="fa fa-star-half-empty"></i>
                        <span>تبلیغات هوشمند</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="../build/images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2>کاربر گرامی</h2>
                        <span>خوش آمدید,</span>
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
                            <li><a><i class="fa fa-home"></i> مدیریت بیکن ها <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{'/api/beacon/create'}}">ایجاد بیکن</a></li>
                                    <li><a href="#">اطلاعات کامل بیکن ها</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-home"></i> مدیریت نوتیفیکشن ها <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{'/api/notif/create'}}">ورود</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-bar-chart"></i> گزارشات <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{'/api/iot'}}">نمایش جدولی</a></li>
                                    <li><a href="#">نمایش نموداری</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-home"></i> حساب کاربری <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">پروفایل شخصی</a></li>
                                    <li><a href="#">مشخصات فروشگاه</a></li>
                                    <li><a href="#">خروج از پنل</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav hidden-print">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="../build/images/img.jpg" alt="">مرتضی کریمی
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> نمایه</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>تنظیمات</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">کمک</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> خروج</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>مرتضی کریمی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>مرتضی کریمی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>مرتضی کریمی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="../build/images/img.jpg"
                                                                 alt="Profile Image"/></span>
                                        <span>
                          <span>مرتضی کریمی</span>
                          <span class="time">3 دقیقه پیش</span>
                        </span>
                                        <span class="message">
                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>مشاهده تمام اعلان ها</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- /header content -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <h3>گزارشات دریافتی</h3>
                <div class="clearfix"></div>

                <div class="row">


                    <div class="x_content">

                        <p>جدول مشتری</p>

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <th class="column-title">number</th>
                                <th class="column-title">mac_beacon</th>
                                <th class="column-title">mac_address</th>
                                <th class="column-title">uuid</th>
                                <th class="column-title">rssi</th>
                                <th class="column-title">distance</th>
                                <th class="column-title">time</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($iot as $j => $beacon)
                                    <tr class="even pointer">
                                        <td class="a-center ">
                                            {{$j+1}}
                                        </td>
                                        <td class=" ">{{$beacon->customer_id}}</td>
                                        <td class=" ">{{$beacon->beacon_mac}}</td>
                                        <td class=" ">{{$beacon->beacon_id}}</td>
                                        <td class=" ">{{$beacon->rssi}}</td>
                                        <td class=" ">{{round(sqrt(abs($beacon->rssi)))}}cm</td>
                                        <td class=" ">{{$beacon->created_at}}</td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container">
                        <h3>گزارشات خاص</h3>
                        <form method="post" action="{{url('api/iot/specialrecord')}}">
                            <div class="x_panel x_content">
                                <form class="row x_title">
                                    <div class="col-md-6">
                                        <label>از تاریخ :</label>
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-8 xdisplay_inputx form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left"
                                                               id="single_cal4" name="fromdate"
                                                               aria-describedby="inputSuccessStatus">
                                                        <span class="fa fa-calendar-o form-control-feedback left"
                                                              aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <label>تا تاریخ :</label>
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="col-md-8 xdisplay_inputx form-group has-feedback">
                                                        <input type="text" class="form-control has-feedback-left"
                                                               id="single_cal3" name="todate"
                                                               aria-describedby="inputSuccess2Status">
                                                        <span class="fa fa-calendar-o form-control-feedback left"
                                                              aria-hidden="true"></span>
                                                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <button class="btn btn-success" type="submit">دریافت اطلاعات</button>
                                    </div>
                                </form>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-5 col-sm-3 col-xs-12">انتخاب</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" name="prdate">
                                            <option>یک گزینه را انتخاب کنید</option>
                                            <option value="ssss">یک ماه اخیر</option>
                                            <option value="sss">یک هفته اخیر</option>
                                            <option value="ss">دیروز</option>
                                            <option value="s">امروز</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="{{url('api/iot/specialrecord')}}">
                                <div class="row x_title">
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md-8 col-sm-3 col-xs-12" for="uuid">مرتب سازی بر
                                            اساس uuid:
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="uuid" name="uuid"
                                                   class="form-control col-md-8 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label col-md-8 col-sm-3 col-xs-12" for="beacon_mac">مرتب
                                            سازی بر اساس mac هر بیکن:
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="beacon_mac" name="customer_mac"
                                                   class="form-control col-md-5 col-xs-12">
                                        </div>
                                    </div>

                                    <button style="margin:0px 20px 0px 0px" type="submit" class="col-md-2 btn btn-primary">دریافت اطلاعات
                                    </button>
                                </div>

                            </form>

                            @if($spiot != "")


                            <div class="x_content">

                                <h5>جدول گزارشات خاص</h5>

                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <th class="column-title">number</th>
                                        <th class="column-title">mac_beacon</th>
                                        <th class="column-title">mac_address</th>
                                        <th class="column-title">uuid</th>
                                        <th class="column-title">rssi</th>
                                        <th class="column-title">distance</th>
                                        <th class="column-title">time</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($spiot as $j => $beacon)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    {{$j+1}}
                                                </td>
                                                <td class=" ">{{$beacon->customer_id}}</td>
                                                <td class=" ">{{$beacon->beacon_mac}}</td>
                                                <td class=" ">{{$beacon->beacon_id}}</td>
                                                <td class=" ">{{$beacon->rssi}}</td>
                                                <td class=" ">{{round(sqrt(abs($beacon->rssi)))}}cm</td>
                                                <td class=" ">{{$beacon->created_at}}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                                @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer class="hidden-print">

        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>
<div id="lock_screen">
    <table>
        <tr>
            <td>
                <div class="clock"></div>
                <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>
</body>
<!-- jQuery -->
@extends('layout.footer')