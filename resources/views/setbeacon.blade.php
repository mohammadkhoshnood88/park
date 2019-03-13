@extends('layout.main')<!-- /header content -->
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
                        <h3>به سامانه مدیریت تبلیفات هوشمند خوش آمدید</h3>
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

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <form method="post" action="{{route('beacon.store')}}" id="demo-form2"
                                      data-parsley-validate class="form-horizontal form-label-left">

                                    {{csrf_token()}}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">کد بیکن
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" required="required"
                                                   name="name"
                                                   class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uuid">uuid
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="uuid" required="required"
                                                   class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">mac_address
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="beacon_mac" id="birthday"
                                                   class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name"
                                               class="control-label col-md-3 col-sm-3 col-xs-12">major</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input class="form-control col-md-7 col-xs-12" type="text"
                                                   name="major">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">minor
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="minor" class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">tx
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="tx" id="birthday"
                                                   class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ماهیت بیکن</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="nature" class="form-control">
                                                <option>انتخاب گزینه</option>
                                                <option>گزینه اول</option>
                                                <option>گزینه دوم</option>
                                                <option>گزینه سوم</option>
                                                <option>گزینه چهارم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">طبقه بندی</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="group" class="form-control">
                                                <option>انتخاب گزینه</option>
                                                <option>گزینه اول</option>
                                                <option>گزینه دوم</option>
                                                <option>گزینه سوم</option>
                                                <option>گزینه چهارم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">موقعیت مکانی</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="location" class="form-control">
                                                <option>انتخاب گزینه</option>
                                                <option>گزینه اول</option>
                                                <option>گزینه دوم</option>
                                                <option>گزینه سوم</option>
                                                <option>گزینه چهارم</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">ثبت</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped jumbotron bulk_action">
                                        <thead>
                                        <tr class="headings">

                                            <th class="column-title">کد بیکن</th>
                                            <th class="column-title">uuid</th>
                                            <th class="column-title">major</th>
                                            <th class="column-title">minor</th>
                                            <th class="column-title">tx</th>
                                            <th class="column-title">طبقه بندی</th>
                                            <th class="column-title">ماهیت بیکن</th>
                                            <th class="column-title">مکان</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($beacons as $i=>$beacon)
                                            <tr class="dtr-column">

                                                <td>{{$beacon->uuid}}</td>
                                                <td>{{$beacon->mac_address}}</td>
                                                <td>{{$beacon->major}}</td>
                                                <td>{{$beacon->minor}}</td>
                                                <td>{{$beacon->tx}}</td>
                                                <td>{{$beacon->group}}</td>
                                                <td>{{$beacon->nature}}</td>
                                                <td>{{$beacon->location}}</td>
                                                <td class="success" style="text-align: center">
                                                    <form action="{{ route('beacon.destroy', ['beacon' => $beacon->uuid])}}" method="post">
                                                        {{csrf_field()}}
                                                        {!! method_field('DELETE') !!}
                                                        <input type="hidden" name="_method" value="delete" />
                                                        <input class="btn btn-danger" type="submit" value="حذف" />
                                                    </form>
                                                </td>
                                                <td class="success">
                                                        <a href="{{ route('beacon.edit', ['beacon' => $beacon->uuid])}}"><button class="btn btn-success">ویرایش</button></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
@extends('layout.footer')