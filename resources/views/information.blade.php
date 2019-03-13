<!-- /header content -->
@extends('layout.main')
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
                        <h4>مدیریت اطلاعات پایه</h4>
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

            </div>
            <!-- /page content -->
            <div class="row">
            <div class="container">
                <div class="x_panel col-md-6">
                    <form class="form-group" method="post" action="{{url('/api/information/set')}}">

                        <div class="control-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">طبقه بندی ها :</label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <input name="group" id="tags_1" type="text" class="tags form-control"
                                       value="خوراک,پوشاک "/>
                                <div id="suggestions-container"
                                     style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">نام
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" required="required"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <button type="submit" >تایید</button>
                    </form>
            </div>
            </div>
            </div>
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