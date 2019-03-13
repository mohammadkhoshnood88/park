@extends('layout.main')<!-- /header content -->
<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col hidden-print">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{'/'}}" class="site_title"><i class="fa fa-star-half-empty"></i> <span>تبلیغات هوشمند</span></a>
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
                            <li><a><i class="fa fa-home"></i> مدیریت بیکن ها <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{'/api/beacon/create'}}">ایجاد بیکن</a></li>
                                    <li><a href="#">اطلاعات کامل بیکن ها</a></li>
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
                                    <li><a href="#">مشخصات فروشگاه</a></li>
                                    <li><a href="#">خروج از پنل</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

                </div>

            </div>
        </div>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>تنظیم اعلانات هر بیکن</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="جست و جو برای...">
                                <span class="input-group-btn">
                      <button class="btn btn-default" type="button">برو!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_content">
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr style="text-align: center" class="headings">

                                <th class="column-title" style="text-align: center">کد بیکن</th>
                                <th class="column-title" style="text-align: center">uuid</th>
                                <th class="column-title" style="text-align: center">فاصله</th>
                                <th style="text-align: center" class="column-title">متن پیام</th>
                                <th class="column-title" style="text-align: center">URL</th>
                                <th class="column-title" style="text-align: center">تصویر</th>
                                <th style="text-align: center" class="column-title">ویدئو</th>

                            </tr>
                            </thead>
                                @foreach($beacons as $beacon)
                            <tbody>
                            <tr class="even pointer">

                                <td class=" ">{{$beacon->neme}}</td>
                                <td class=" ">{{$beacon->uuid}}</td>
                                <td class=" ">{{$beacon->uuid}}</td>
                                @foreach($beacon->notifs() as $notif)
                                <td class=" ">
                                            <input type="text" class="form-control" readonly="readonly"
                                                   placeholder="{{$notif->txt}}">
                                    </td>

                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->url}}"></td>
                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->pic}}"></td>
                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->vid}}"></td>
                                <td class=" "><a href="#"><button class="btn btn-primary">ویرایش</button></a></td>
                                @endforeach
                            </tr>


                            </tbody>
                                    @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer class="hidden-print">
            <div class="pull-left">
                Gentelella - قالب پنل مدیریت بوت استرپ <a href="https://colorlib.com">Colorlib</a> | پارسی شده توسط <a
                        href="https://morteza-karimi.ir">مرتضی کریمی</a>
            </div>
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
<!-- jQuery -->
@extends('layout.footer')