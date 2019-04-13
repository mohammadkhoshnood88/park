<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>PsPace | ورود</title>


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

                <div class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>ورود به سامانه</h1>
                        <div class="form-group row">

                            <label for="mobile" class="col-md-4 col-form-label text-md-right">شماره تلفن :</label>

                            <div class="col-md-8">
                                <input id="email" type="text"
                                       class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                       name="mobile" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور :</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div>
                            <button type="submit" class="btn btn-default submit">
                                ورود
                            </button>

                            {{--href="{{ route('password.request') }}--}}
                            {{--@if (Route::has('password.request'))--}}
                                {{--<a class="btn" href="/register">--}}
                                    {{--رمز عبور را فراموش کرده اید...--}}
                                {{--</a>--}}
                            {{--@endif--}}
                            </div>
                    </form>
                    <div class="separator">
                        <p class="change_link"> در سامانه عضو نشده اید؟
                            <a href="/register" class="to_register"> ایجاد حساب </a>
                        </p>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layout.footer')
</body>

</html>