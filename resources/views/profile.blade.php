@extends('layout.main')
@section('title')
    پروفایل
@endsection
@section('header')
{{--    @include('home.js')--}}
@endsection
@section('subtitle')
    حساب کاربری/ پروفایل
@endsection
@section('content')

    <div class="alert-danger" style="margin: 7px;padding-right: 2px;">{{$text}}</div>
    <div class="row" id="profile">
        <div class="col-md-6">
            <form method="post" action="{{route('profile_set')}}" id="demo-form2"
                  data-parsley-validate class="form-horizontal form-label-left">

                {{csrf_field()}}
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" style="text-align: right">نام و
                        نام خانوادگی :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text"
                               name="name" id="input1" v-model="name"
                               class="col-md-6 col-xs-12">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">شماره تماس :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="tel_num" id="input3"
                               class="col-md-6 col-xs-12" v-model="mobile"
                               type="text">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_name" style="text-align: right">نام
                        فروشگاه :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="shop_name" id="input2"
                               v-model="shop_name"
                               class="col-md-6 col-xs-12">
                    </div>
                </div>

                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">آدرس ایمیل :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="groups" id="input4"
                               class="col-md-6 col-xs-12"
                               v-model="email"
                               type="text">
                    </div>
                </div>

                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">لوگو :
                    </label>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                <span class="btnn btn-uploadd btn-filee">
            <span class="fa fa-upload"></span> بارگزاری تصویر لوگو<input name="logo" id="input5"
                                                                         type="file">
                    </span>

                    </div>
                </div>

                @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
                    <div class="form-group" style="margin: 20px">
                        <label for="middle-name"
                               class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">آدرس پاساژ
                            :</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="address" class="col-md-6 col-xs-12"
                                   v-model="address" type="text"
                                   id="input6">
                        </div>
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)

                    <div class="btn-group" style="margin: 20px">
                        <div class="col-md-5">
                            <label for="middle-name"
                                   class="control-label col-md-5 col-sm-3 col-xs-12" style="text-align: right">طبقه
                                :</label>
                            {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
                            <input class="col-md-3" name="floor"
                                   v-model="floor" type="text" id="input6">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" style="text-align: right">پلاک
                                :</label>
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                            <input class="col-md-3" id="input8" name="plaque"
                                   v-model="plaque" type="text"></div>
                    </div>
                    {{--</div>--}}
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
                    <input type="hidden" name="type" value="admin">
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
                    <div class="form-group" style="margin: 20px">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">دسته بندی
                            فروشگاه :
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            {{--<input name="type" id="input7"--}}
                            {{--class=" col-md-6 col-xs-12"--}}
                            {{--type="text">--}}
                            <select name="type" id="input7" class="form-control">
                                {{--<option>انتخاب گزینه</option>--}}
                                @foreach($favorites as $favorite)
                                    <option>{{$favorite->favorite}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                @endif
                <button type="submit" class="btn btn-success">تکمیل پروفایل</button>
                <a class="btn btn-light" href="{{asset('home')}}">صفحه اصلی</a>
            </form>
        </div>
        <div class="col-md-offset-6">
            <div class="card"
                 style="margin-right:120px ;padding: 4px;width: 50%;background:#F7F7F7;border: 1px solid #E6E9ED;">
                <div class="card-body">

                    <div class="row" style="margin: 5px;height: 25px;width: 100%">
                        <p class="col-md-6">نام و نام خانوادگی :
                        </p>
                        <p id="output1" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                            @{{ name }}
                        </p>
                    </div>

                    <div class="row" style="margin: 5px;height: 25px;width: 100%">
                        <p class="col-md-6">شماره تماس :
                        </p>
                        <p id="output3" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                            @{{ mobile }}
                        </p>
                    </div>

                    <div class="row" style="margin: 5px;height: 25px;width: 100%">
                        <p class="col-md-6 col-sm-3 col-xs-6">نام فروشگاه :
                        </p>
                        <p id="output2" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                            @{{ shop_name }}
                        </p>
                    </div>

                    <div class="row" style="margin: 5px;height: 25px;width: 100%">
                        <p class="col-md-6 col-sm-3 col-xs-6">آدرس ایمیل :
                        </p>
                        <p id="output4" class="col-md-offset-6" style="color: #000;
                            overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                            @{{ email }}
                        </p>
                    </div>

                    <div class="row" style="margin: 5px;height: 25px;width: 100%">
                        <p class="col-md-6 col-sm-3 col-xs-6">لوگو :
                        </p>
                        <p id="output5" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                            @{{ logo }}
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
                        <div class="row" style="margin: 5px;height: 25px;width: 100%">
                            <p class="col-md-6 col-sm-3">آدرس :
                            </p>
                            <p id="output6" class="col-md-offset-6" style="color: #000;
                    overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                                @{{ address }}
                            </p>
                        </div>
                    @endif

                    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
                        <div class="row" style="margin: 5px;height: 25px;width: 100%">
                            <p class="col-md-6">پلاک :
                            </p>
                            <p id="output7" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                                @{{ plaque }}
                            </p>
                        </div>
                        <div class="row" style="margin: 5px;height: 25px;width: 100%">
                            <p class="col-md-6">طبقه :
                            </p>
                            <p id="output7" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                                @{{ floor }}
                            </p>
                        </div>

                        <div class="row" style="margin: 5px;height: 25px;width: 100%">
                            <p class="col-md-6">دسته بندی فروشگاه :
                            </p>
                            <p id="output7" class="col-md-offset-6" style="color: #000;
overflow: hidden;width: 110px;text-overflow: ellipsis;white-space: nowrap;">
                                @{{ type }}
                            </p>
                        </div>

                    @endif

                </div>
            </div>
        </div>

    </div>
    <div class="ln_solid"></div>
    <div class="form-group">


    </div>
@endsection
@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/Vue.js')}}"></script>
    <script>
        new Vue({
            el: "#profile",
            data: {
                name: "{{auth()->user()->name}}",
                mobile: "{{auth()->user()->mobile}}",
                shop_name: "{{!empty($profile->shop_name) ? $profile->shop_name : ""}}",
                email: "{{!empty($profile->email) ? $profile->email: ""}}",
                logo: "{{!empty($profile->logo) ? $profile->logo: ""}}",
                address: "{{!empty($profile->address) ? $profile->address: ""}}",
                floor: "{{!empty($profile->floor) ? $profile->floor: ""}}",
                plaque: "{{!empty($profile->plaque) ? $profile->plaque: ""}}",
                type: "{{!empty($profile->type) ? $profile->type: ""}}",
            }
        });

    </script>
    <style>
        #input1, #input2, #input3, #input4, #input5, #input6, #input7, #input8 {
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .btn-filee input[type=file] {
            position: absolute;
            top: 0;
            width: 130px;
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
            width: 150px;
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
