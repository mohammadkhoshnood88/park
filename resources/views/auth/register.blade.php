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
    <div class="login_wrapper">
        <div class="col-md-12">
            <div class="login_form">
                @foreach ($errors->all() as $error)
                    {{--<li>{{ $error }}</li>--}}
                    <p style="margin: 5px;text-align: center;width: 100%;border-radius: 4px" class="alert-danger">{{ $error }}</p>
                @endforeach
                <div class="alert-number">
                </div>
                <p style="margin: 5px;position: absolute;text-align: center;width: 100%" class="alert-error alert-mobile">{{\Illuminate\Support\Facades\Session::get('error_text')}}</p>
                <p style="margin: 5px;position: absolute;text-align: center;width: 100%" class="alert-success">{{\Illuminate\Support\Facades\Session::get('error_text_r')}}</p>

                <div class="login_content">
                    <form method="POST" id="register-form" action="{{ route('register') }}">
                        @csrf

                        <h1>ایجاد حساب</h1>
                        <div class="form-group row">
                            <label for="name" class="col-form-label text-md-right">نام و نام خانوادگی
                                :</label>

                            {{--<div class="col-md-8">--}}
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{\Illuminate\Support\Facades\Session::get('name')}}">

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-form-label text-md-right">شماره موبایل :</label>

                            {{--<div class="col-md-8">--}}
                                <input id="mobile" type="text" class="form-control" name="mobile"
                                       value="{{\Illuminate\Support\Facades\Session::get('mobile')}}">


                            {{--</div>--}}
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-form-label text-md-right">رمز عبور :</label>

                            {{--<div class="col-md-8">--}}
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password">

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-form-label text-md-right">تایید رمز عبور
                                :</label>

                            {{--<div class="col-md-8">--}}
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            {{--</div>--}}
                        </div>


                        <div>
                            <button type="submit" id="submit" class="btn btn-default submit">
                                عضویت
                            </button>
                        </div>



                    </form>
                    <div class="separator">
                        <a href="{{route('login')}}" class="to_register">فرم ورود</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('layout.footer')
<script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/additional-methods.min.js')}}"></script>

<script>
    $(function () {
        setupFormValidator();
    });

    function setupFormValidator() {
        let rules = {
            name: {
                required: true,
            },
            mobile: {
                required: true,
                pattern:"^(09)[0-9]{9}$"
            },
            password: {
                required: true,
            }
        };
        let messages = {
            mobile: {required: "شماره تماس را وارد کنید.",
                pattern: "شماره تماس وارد شده معتبر نیست"},
            name: {required: "نام را وارد کنید.",},
            password: {required: "رمز عبور را وارد کنید",}
        };
        $('#register-form').removeData('validator');

        $("#register-form").validate({
            ignore: [],
            focusInvalid: false,
            debug: false,
            lang: 'fa',
            rules: rules,
            messages: messages,
            errorPlacement: function (error, element) {

                $("#mobile").keyup(function(){
                    if ($("div").hasClass("alert-number")) {
                        $('.alert-pass').empty();
                        $('.alert-number').empty();
                    }

                });

                $('.alert-mobile').text("");
                $(document).on('click', '#submit', function (event) {
                    $('.alert-number').empty();

                });
                $('.alert-mobile').text("");
                $('.alert-number').append(
                    `<p class="alert-danger" style="margin: 5px;text-align: center;width: 100%">` + error.text() + `</p>`
                    );
            }
        });


    }
</script>
{{--<script>--}}
    {{--$(document).ready(function () {--}}
        {{--$('.alert-number').delay(7000).slideUp(200);--}}
        {{--$('.alert-mobile').delay(7000).slideUp(200);--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>

