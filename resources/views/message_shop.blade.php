@extends('layout.main')
@section('title')
    مدیریت پیام های عمومی
@endsection
@section('header')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet"/>

    <style>
        .btn-filee input[type=file] {
            position: absolute;
            top: 49px;
            /*left: 468px;*/
            width: 95px;
            height: 30px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .btn-uploadd {
            color: #fff;
            background-color: #5bc0de;
            width: 100px;
            border-color: #46b8da;
        }

        .btnn {
            margin-right: 6px;
            display: inline-block;
            padding: 6px 2px;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
@endsection
@section('subtitle')
    مدیریت پیام ها/ پیام های عمومی
@endsection
@section('content')
    <p class="alert-error errorTxt" id="errorTxt" style="border-radius: 3px"></p>
    <form style="background:#34495e;color:white;border-radius: 3px; box-shadow: 5px 5px 5px #a858ec" id="message-form"
          method="post" action="{{route('message_set')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div style="margin: 20px" class="form-group">
                    <label>متن پیام :

                    </label>
                    {{--<div class="col-md-8 col-sm-4 col-xs-12">--}}
                    <input type="text" id="favorite" name="content"
                           class="form-control col-md-7 col-xs-12">
                    {{--</div>--}}
                </div>

                <br>
                <div style="margin: 20px" class="form-group">
                    <label>دسته بندی :

                    </label>
                    {{--<div class="col-md-6 col-sm-4 col-xs-12">--}}
                    <select name="favorite" class="selectt2" style="width: 200px;">

                        @foreach($favorites as $favorite)
                            <option value="{{$favorite->favorite}}">{{$favorite->favorite}}</option>
                        @endforeach
                    </select>
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-md-6 col-xs-6">
                <div class="form-group" style="margin: 25px">
                    <label class="">بارگزاری تصویر :</label>

                    {{--<div class="col-md-5 col-sm-9 col-xs-12 dropzone" action="{{route('message_set')}}"--}}
                    {{--id="my-awesome-dropzone"></div>--}}
                    <div class="">
<span class="btnn btn-uploadd btn-filee">
            <span style="margin-right: 8px" class="fa fa-upload"></span>   بارگزاری<input type="file" name="file">
                    </span>
                    </div>

                </div>
                <div class="form-group" style="margin-right: 25px;">
                    {{--<div class="form-group">--}}
                    <label class="btn col-md-5" style="background: blue; color: white" id="offer_click"
                           onclick="offer()">فعال سازی
                        تخفیف</label>
                    <div class="control-label col-md-2 col-sm-6 col-xs-12" style="height: 34px">
                        <label style="margin-top:11% " id="offer">درصد : </label>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12" id="offer-box">
                        <input type="hidden" id="offer_set" name="offer_set" value="0">
                        <input readonly="readonly" type="text" name="offer_percent" id="offer_percent"
                               class="form-control"
                               value="{{!empty($notifs->offer_percent) ? $notifs->offer_percent : ""}}">
                        {{--</div>--}}
                    </div>

                </div>


            </div>
        </div>

        <div class="align-content-center" style="width:1px;margin-left: auto;margin-right: auto;">
            <button id="message-click" class="btn btn-primary"><span class="fa fa-plus"></span></button>
        </div>
    </form>

    <div class="container">
        <div style="text-align: center;font-size: 15px;border-top:2.5px solid #e5e8ec;margin: 3px 0px 8px 0px "></div>
        @foreach($messages as $message)
            <div class="col-md-55">
                {{--{{asset($message->pic)}}--}}
                <div class="thumbnail" style="@if($message->type == 1) background:#5cd08d @endif">
                    <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{asset($message->pic)}}"
                             alt="{{$message->shop_name()}}"/>
                        <div class="mask no-caption">
                            <div class="tools tools-bottom">
                                <form action="{{ route('del_message', ['message' => $message->id])}}"
                                      method="post">
                                    {{csrf_field()}}
                                    {!! method_field('DELETE') !!}
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="caption" style="@if($message->type == 1) background:#5cd08d @endif">
                        <p><strong>{{$message->shop_name()}}</strong>
                        </p>
                        <p>{{$message->content}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/dropzone.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $(".selectt2").select2();
        });
    </script>

    <script>
        function offer() {
            $('#offer_set').val("1");
            document.getElementById("offer_click").style["background"] = "red";
            document.getElementById("offer_click").innerHTML = "غیر فعال سازی تخفیف";
            document.getElementById("offer_percent").removeAttribute("readonly");
            document.getElementById("offer_click").removeAttribute("onclick");
            document.getElementById("offer_click").setAttribute("onclick", "nooffer()");
        }

        function nooffer() {
            $('#offer_set').val("0");
            $('#offer_percent').val("");
            document.getElementById("offer_click").style["background"] = "blue";
            document.getElementById("offer_click").innerHTML = "فعال سازی تخفیف";
            document.getElementById("offer_percent").setAttribute("readonly", "readonly");
            document.getElementById("offer_click").removeAttribute("onclick");
            document.getElementById("offer_click").setAttribute("onclick", "offer()");
        }

    </script>



    <script>
        $(function () {
            setupFormValidator()

        })

        function setupFormValidator() {

            let rules = {

                content: {
                    required: true,
                },
                file: {
                    required: true,
                    extension: "jpg,jpeg,png",
                    size: 1000000,
                },
                favorite: {
                    required: true,
                },
                offer_percent:
                    {
                        required: function (element) {
                            let offer = document.getElementById("offer_percent");
                            if (offer.hasAttribute('readonly')) {
                                return false;
                            }
                            else {
                                return true;
                            }

                        }
                    }
            };
            let messages = {
                content: {
                    required: "متن پیام را وارد کنید",
                },
                file: {
                    required: "تصویر را بارگزاری کنید",
                    extension: "فرمت فایل صحیح نمی باشد",
                    maxFilesize: "حجم تصویر بیش از 2 مگ است."
                },
                favorite: {
                    required: "دسته بندی را انتخاب کنید",
                },
                offer_percent: {
                    required: "درصد تخفیف را وارد کنید"
                }
            };

            $("#message-form").validate({
                focusInvalid: false,
                debug: false,
                lang: 'fa',
                rules: rules,
                messages: messages,
                errorPlacement: function (error, element) {
                    $(document).on('click', '#message-click', function (event) {
                        $('.errorTxt').empty();
                    });
                    $('.errorTxt').append(`<ol>` + error.text() + `</ol>`);

                }
            });


        }
    </script>

    <script>

        Dropzone.options.myAwesomeDropzone = {
            dictDefaultMessage: "فایل را اینجا رها کنید تا آپلود شود",
            dictFallbackMessage: "مرورگر شما آپلود فایل drag'n'drop را پشتیبانی نمی کند.",
            dictFallbackText: "برای بارگذاری فایل های خود مانند روزهای گذشته، از فرم پشت زیر استفاده کنید.",
            dictFileTooBig: "پرونده خیلی بزرگ است (MiB). حداکثر اندازه فایل: MiB.",
            dictInvalidFileType: "شما نمیتوانید فایلهای این نوع آپلود کنید.",
            dictResponseError: "سرور کد  را در پاسخ داد.",
            dictCancelUpload: "لغو آپلود",
            dictCancelUploadConfirmation: "آیا مطمئن هستید که میخواهید این آپلود را لغو کنید؟",
            dictRemoveFile: "حذف فایل",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "شما نمیتوانید فایلهای بیشتری آپلود کنید."
        }
    </script>
@endsection
