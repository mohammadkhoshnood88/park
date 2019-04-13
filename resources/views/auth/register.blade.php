<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | ثبت نام</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">

</head>

<body class="login">
<div class="container">
    <p style="text-align: center;color: black;font: 50px">سامانه تبلیغات هوشمند</p>
    <div class="login_wrapper">
        <div class="col-md-12">
            <div class="login_form">

                <div class="login_content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>ایجاد حساب</h1>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">نام<br/>و نام خانوادگی :</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">شماره موبایل :</label>

                            <div class="col-md-8">
                                <input id="mobile" type="text" class="form-control" name="mobile" required>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mac" class="col-md-4 col-form-label text-md-right">آدرس مک بیکن :</label>

                            <div class="col-md-8">
                                <input id="mac" type="text" class="form-control" name="beacon_mac" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور :</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تایید رمز عبور :</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                            <div>
                                <button type="submit" class="btn btn-default submit">
                                    عضویت
                                </button>
                            </div>

                    </form>
                    <div class="separator">
                            <a href="/login" class="to_register">فرم ورود</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('layout.footer')
</body>
</html>

