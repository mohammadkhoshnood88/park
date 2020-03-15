<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <title>offera | ورود</title>


    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/nprogress/nprogress.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">

    <link href="{{asset('css/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{asset('css/build/css/custom.min.css')}}" rel="stylesheet">
    {{--<script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>--}}


</head>

<body class="login">

<div class="container">
    <div class="login_wrapper">
        <div class="col-md-12">
            <div class="login_form">
                <div class="alert-number">

                </div>


                <p style="margin: 5px;position: absolute;text-align: center;width: 100%;border-radius: 3px"
                   class="alert-error alert-pass">{{\Illuminate\Support\Facades\Session::get('error_text')}}</p>
                <p style="margin: 5px;position: absolute;text-align: center;width: 100%;border-radius: 3px"
                   class="alert-info">{{\Illuminate\Support\Facades\Session::get('error_text_q')}}</p>
                <div class="login_content">
                    <form method="POST" id="login-form" action="{{ route('login') }}">
                        @csrf
                        <h1>ورود به سامانه</h1>


                        <div class="form-group row">

                            <label for="mobile" class="col-form-label text-md-right" style="vertical-align: middle;">شماره
                                تلفن :</label>

                            {{--<div class="col-md-8">--}}
                            <input id="mobile" type="text"
                                   value="{{\Illuminate\Support\Facades\Session::get('mobile')}}"
                                   class="form-control"
                                   name="mobile">

                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-form-label text-md-right" style="vertical-align: middle;">رمز
                                عبور :</label>

                            {{--<div class="col-md-8">--}}
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password">


                        </div>


                        <div>
                            <button id="submit" type="submit" class="btn btn-default submit">
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
                        <p class="change_link"> در آفِرا عضو نشده اید؟
                            <a href="{{ route('register') }}" class="to_register"> ایجاد حساب </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')

<script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/additional-methods.min.js')}}"></script>

<script>
    $(function () {
        setupFormValidator();
    });

    function setupFormValidator() {

        let rules = {
            mobile: {
                required: true,
                pattern: "^(09)[0-9]{9}$"

            },
            password: {
                required: true,
            }
        };
        let messages = {
            mobile: {
                required: "شماره تماس را وارد کنید.",
                pattern: "شماره تماس وارد شده معتبر نیست"
            },
            password: {required: "رمز عبور را وارد کنید",}
        };
        $('#login-form').removeData('validator');

        $('.alert-number').empty();


        $("#login-form").validate({

            ignore: [],
            focusInvalid: false,
            debug: false,
            lang: 'fa',
            rules: rules,
            messages: messages,
            errorPlacement: function (error, element) {

                $('.alert-pass').text("");
                // $("#mobile").blur(function(){
                //     if ($("div").hasClass("alert-number")) {
                //         $('.alert-pass').empty();
                //         $('.alert-number').empty();
                //     }
                //
                // });

                $("#mobile").keyup(function(){
                    if ($("div").hasClass("alert-number")) {
                        $('.alert-pass').empty();
                        $('.alert-number').empty();
                    }

                });
                
                $('.alert-pass').text("");
                $(document).on('click', '#submit', function (event) {
                    $('.alert-number').empty();
                });
                // $('.alert-number').append('');
                console.log('alert');
                    $('.alert-number').append(
                        `<p class="alert-danger" style="margin:5px;text-align: center;width: 100%;border-radius: 3px">` + error.text() + `</p>`
                    )
            }

        });

    }

</script>

</body>


</html>