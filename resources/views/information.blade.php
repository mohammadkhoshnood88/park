@extends('layout.main')
@section('title')
    ویرایش اطلاعات
@endsection

@section('header')

    <style>
        .disp-none{
            display: none;
        }
        .disp-block{
            display: block;
        }
    </style>
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>


@endsection
@section('subtitle')
    اطلاعات پایه/ دسته بندی
@endsection
@section('content')

    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
        <p>شما به این بخش دسترسی ندارید.</p>
    @else
        <div class="alert-danger">
            @foreach ($errors->all() as $error)
                <ol>{{ $error }}</ol>
            @endforeach
        </div>    <p class="alert-danger errorTxt" style="padding-right: 3px;margin: 5px;border-radius: 3px"></p>
        {{--<div class="alert-danger" style="padding-right: 3px;margin: 5px">{{$textt}}</div>--}}

        <!-- /page content -->
        @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
            <div id="info">
            <form class="form-group row" id="info_form" method="post" action="{{route('favorite_set')}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="col-md-4 col-sm-12 col-xs-12"
                       style="white-space: nowrap;vertical-align: middle;">
                    دسته بندی مرکز تجاری را
                    مشخص کنید.
                </label>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <input type="text" id="favorite" @click="istype()" @mouseup="notype()" v-model="favorite" name="favorite"
                           class="form-control col-md-7 col-xs-12">
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                <span class="btnn btn-uploadd btn-filee">
            <span class="fa fa-upload"></span>   بارگزاری تصویر<input type="file" name="favoritefile">
                    </span>

                </div>
                <button class="btn btn-primary" id="info-click"><span class="fa fa-plus"></span></button>
                {{--<table style="margin: 15px" class="table table-striped table-bordered">--}}

                <div class="container-fluid">
                    @foreach($favorites as $favorite)
                        <a style="text-align: center;border: 1px solid #8986a8;margin: 4px 10px 4px 10px ;padding: 4px"
                           class="col-md-2">{{$favorite->favorite}}</a>
                    @endforeach
                        <a v-if="!is_favorite" style="text-align: center;border: 1px solid #8986a8;margin: 4px 10px 4px 10px ;padding: 4px;"
                           :class="[is_type ? 'disp-block':'disp-none' , 'col-md-2']">@{{ favorite }}</a>
                </div>

                {{--</table>--}}

            </form>
            </div>
        @endif
    @endif
@endsection
@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/Vue.js')}}"></script>
    <script>
    new Vue({
        el:'#info',
        data:{
            favorite:"",
            is_type : false
        },
        methods:
            {
                istype:function () {
                    console.log('istype');
                    this.$data.is_type = true;
                },
                notype:function () {
                    console.log('notype');
                    this.$data.is_type = false;
                }
            },
            computed:{
            is_favorite:function () {
                return this.$data.favorite === "";
            }
            }
    });
    </script>
    <script>

        $(function () {
            setupFormValidator()
        });

        function setupFormValidator() {

            let rules = {

                favorite: {
                    required: true,
                },
                favoritefile: {
                    required: true,
                    extension: "jpg,jpeg,png",
                    size: 1000000,
                }
            };
            let messages = {
                favorite: {
                    required: "نام را وارد کنید",
                },
                favoritefile: {
                    required: "تصویر را بارگزاری کنید",
                    extension: "فرمت فایل صحیح نمی باشد",
                    size: "حجم تصویر بیش از 2 مگابایت است"
                }
            };
            // console.log($('#info_form').removeData());
            // $('.errorTxt').text('');
            $("#info_form").validate({
                ignore: [],
                focusInvalid: false,
                debug: false,
                lang: 'fa',
                rules: rules,
                messages: messages,

                errorPlacement: function (error, element) {
                    $(document).on('click', '#info-click', function (event) {
                        $('.errorTxt').empty();
                    });
                    $('.errorTxt').append(`<ol>` + error.text() + `</ol>`);
                }
            });


        }
    </script>


    <style>
        .btn-filee input[type=file] {
            position: absolute;
            top: 0;
            width: 100px;
            height: 40px;
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
            width: 120px;
            border-color: #46b8da;
        }

        .btnn {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
@endsection



