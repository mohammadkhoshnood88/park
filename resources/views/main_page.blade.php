<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <style>
        .enter {
            background: white;
            padding: 30px;
            border: 1px solid #e6e9ed;
        }

        .download {
            background: white;
            border: 1px solid #e6e9ed;
            height: 273px;
            padding: 75px;
        }

        .parag {
            text-align: center;
            font-weight: bold;
            font-size: 30px;
            padding: 15px 1px 8px 1px;
            border-radius: 1px 1px 260px 260px;
            background: blue;
            margin-top: 3px;
            display: block;
            position: relative;
        }

        .sub-enter {
            height: 170px;
            width: 170px;
            border: 4px solid red;
            margin: 0 auto;
            background-image: url("{{asset('images/enter.png')}}");
            background-size: contain;
        }

        .ios {
            height: 100px;
            width: 100px;
            border: 3px solid red;
            margin: 0 auto;
            background-image: url("{{asset('images/iOS.png')}}");
            background-size: contain;
        }

        .android {
            height: 100px;
            width: 100px;
            border: 3px solid red;
            margin: 0 auto;
            background-image: url("{{asset('images/android.png')}}");
            background-size: 100px 100px;
        }
        .beacon {
            height: 100px;
            width: 100px;
            border: 3px solid red;
            margin: 0 auto;
            background-image: url("{{asset('images/Beacon.png')}}");
            background-size: contain;
        }
    </style>
    <title>سامانه آفرا</title>
    <link rel="icon" href="{{asset('images/logo.png')}}" type="image/png">

</head>
<body style="background:#f7f7f7;">
<p class="container parag">سامانه تبلیغات محیطی هوشمند آفِرا</p>
<div class="container" style="margin-top: 140px;position: relative">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="enter">


                <a href="{{route('home')}}" style="text-decoration: none">
                    <div class="sub-enter">
                    </div>
                </a>

                <div style="text-align: center;font-size: 18px;margin: 8px;font-weight: bold;color: #1b7e5a"><a
                            style="text-decoration:none"
                            href="{{route('home')}}">ورود به پنل
                        مدیریت</a>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="download row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <a href="{{route('download_apk')}}" style="text-decoration:none">
                    <div class="android"></div>
                    <div style="text-decoration:none;text-align: center;font-size: 15px;margin: 5px;font-weight: bold;color: #9b59b6">
                        دانلود نسخه
                        اندروید
                    </div>
                    </a>

                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="ios"></div>
                    <div style="text-decoration:none;text-align: center;font-size: 15px;margin: 5px;font-weight: bold;color: #9b59b6">
                        دانلود
                        نسخه
                        IOS <br><span style="font-size: 12px;color: blue">(به زودی)</span></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <a href="{{route('beacon-buy')}}" style="text-decoration:none">
                    <div class="beacon"></div>
                    <div style="text-decoration:none;text-align: center;font-size: 15px;margin: 5px;font-weight: bold;color: #9b59b6">
                        خرید بیکن</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer style="text-align: center">
    ©1398 تمامی حقوق برای <span style="font-weight: bold">آفِرا</span> محفوظ است.
</footer>
</body>
</html>