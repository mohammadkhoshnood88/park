<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>offera | خرید بیکن</title>

    <link href="{{asset('css/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dialog.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    {{--<script src="{{asset('js/widget.js')}}"></script>--}}
    {{--<script src="{{asset('js/unique-id.js')}}"></script>--}}
    {{--<script src="{{asset('js/safe-active-element.js')}}"></script>--}}
    {{--<script src="{{asset('js/dialog.js')}}"></script>--}}
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional-methods.min.js')}}"></script>

    <style>
        #cover {
            margin: auto;
            position: relative;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 40%;
            height: 80%;
            min-width: 600px;
            max-width: 900px;
            padding: 40px;
        }

        #header {
            text-align: center;
            font-weight: bolder;
            padding: 5px;
            margin: 8px;
            font-size: 15px;
            color: #7387A2;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header" id="header">
            سامانه تبلیغات محیطی هوشمند آفِرا<br><span style="font-size: 13px">برای خرید بیکن فرم زیر را تکمیل نمایید.</span>
        </div>
        <div class="card-body">
            <form id="cover" method="post" action="{{route('customer_buy_beacon')}}"
                  style="background: #f7f7f7;border: 1px solid #e6e9ed;">
                @csrf
                <p class="alert-danger errorTxt" style="border-radius: 4px;padding-right: 5px"></p>
                @if(count($errors)>0)
                    <div class="alert-danger">
                        @foreach ($errors->all() as $error)
                            <ol>{{ $error }}</ol>
                        @endforeach
                    </div>
                @endif
                <div>
                    <div class="form-group">
                        <label class="control-label">نام</label>
                        <input class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">نام خانوادگی</label>
                        <input class="form-control" name="family" value="{{old('family')}}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">شماره تماس</label>
                        <input class="form-control" name="phone" value="{{old('phone')}}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">آدرس فروشگاه</label>
                        <input class="form-control" name="address" value="{{old('address')}}">
                    </div>

                    <div class="form-group">
                        <label class="control-label">تعداد بیکن</label>
                        <input class="form-control" type="number" min="0" max="25" name="beacon_number"
                               id="beacon_number" value="{{old('beacon_number')}}">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6"><label class="control-label">قیمت پایه هر بیکن</label>
                            <p class="beacon_price"></p>
                            <input name="beacon_price" hidden>
                        </div>

                        <div class="col-md-offset-6"><label class="control-label">قیمت کل</label>
                            <p class="total_beacon"></p>
                            <input name="total_price" hidden>
                        </div>

                    </div>

                    <div class="form-group">
                        <button id="buy-click" class="btn btn-primary col-sm-4 m-3">سفارش
                        </button>
                        <a href="{{route('main-page')}}"><span class="btn btn-light">بازگشت</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


@extends('layout.footer')



<script>
    $(document).on('input', '#beacon_number', function (event) {
        event.preventDefault();
        var url = "/beacon/setprice";
        var method = 'POST';
        var number = $('#beacon_number').val();
        $.ajax({
            url: url,
            method: method,
            data: {'number': number, '_token': "{{csrf_token()}}"},
            success: function (response) {
                if (response.success) {
                    console.log(response.price);
                    if (response.price == '0') {
                        $('.total_beacon').text("");
                        $('.beacon_price').text("");
                    }
                    else {
                        $('.total_beacon').text(response.price + '  تومان');
                        $('.beacon_price').text(response.beacon_price + '  تومان');
                    }
                }
                else {
                    alert(response.message);
                    $('.total_beacon').text("");
                    $('.beacon_price').text("");
                }


            },
            error: function (xhr) {
                console.log(xhr);
                alert('ارتباط با سرور قطع شده است.');
            }

        });
    });

</script>
<script>
    $(function () {
        setupFormValidator()
    });

    function setupFormValidator() {

        let rules = {

        name: {
            required: true,
        },
        family: {
            required: true,
        },
        address: {
            required: true,
        },
        phone: {
            required: true,
            maxLength: 11
        },
        beacon_number: {
            required: true,
            min: 0,
            max: 25
        },
    };
    let messages = {
        name: {
            required: "نام را وارد کنید",
        },
        family: {
            required: "نام خانوادگی را وارد کنید",
        },
        address: {
            required: "آدرس را وارد کنید",
        },
        phone: {
            required: "شماره تماس را وارد کنید",
            maxLength: "شماره تماس وارد شده معتبر نیست"
        },
        beacon_number: {
            required: "تعداد بیکن را وارد کنید",
        },
    };


        $("#cover").validate({
            // onKeyUp:false,
            focusInvalid: true,
            debug: false,
            lang: 'fa',
            rules: rules,
            messages: messages,
            errorPlacement: function (error, element) {
                $(document).on('click', '#buy-click', function (event) {
                    $('.errorTxt').empty();
                });
                $('.errorTxt').append(`<ol>` + error.text() + `</ol>`);
            }
        });
        $('#buy-click').click(function () {
            $("#cover").valid();
        });
    };

</script>
</body>
</html>