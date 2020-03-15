@extends('layout.main')
@section('title')
    پیام های qrcode
@endsection
@section('header')
    {{--<script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>--}}
    <link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/print.css')}}" rel="stylesheet"/>

    <style>
        .qr-box {
            border: 1px solid #E6E9ED;
            background: #F7F7F7;
            padding: 10px 2px 10px 2px;
            min-height: 120px;
            margin: 2px 0 6px 0;

        }

        .qr-image {
            padding: 0px !important;
            /*position: relative;*/
            overflow: hidden;
            display: block;
        }

        #flip {
            text-align: center;
            width: 17%;
            min-width: 160px;
            margin: auto;
            padding: 7px;
            border-radius: 5px;
            margin-bottom: 8px;
            cursor: pointer;

        }

        .qr-remove {
            display: none;
            position: absolute;
            overflow: hidden;
            top: 0;
            left: 0;
            width: 50%;
            /*height: 100%;*/
            /*background-color: blue;*/
            /*float: left;*/
            /*margin: 45px 12px 25px 35px;*/
            margin: 25% 2% 18% 42%;
        }

        .qr-box:hover .qr-remove {
            opacity: 0.9;
            display: block;
            vertical-align: middle;
            /*text-align: center;*/
            border-radius: 3px;
            /*transition: all 1s ease-in-out;*/
        }
    </style>
@endsection
@section('subtitle')
    مدیریت پیام ها/ پیام های qrcode
@endsection
@section('content')

    @if(session()->has('qr-message'))
        <p class="alert-success p-0" style="border-radius: 4px ; padding-right: 4px">
            {{session('qr-message')}}
            {{--            {{session('destroy-message')}}--}}
        </p>
    @endif

    <form method="post" action="{{route('qrcode_generate')}}" id="demo-form2"
          data-parsley-validate class="form-horizontal form-label-left">

        {{csrf_field()}}

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">متن
                پیام : </label>
            <div class="col-md-8 col-sm-9 col-xs-12">
                <input type="text" name="txt" class="form-control"
                       placeholder="متن پیام">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">طبقه بندی</label>
            <div class="col-md-8 col-sm-6 col-xs-6">
                <select name="group" class="form-control groups_select2">
                    @foreach($all_user_groups as $groups)
                        <option>{{$groups}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">موقعیت</label>
            <div class="col-md-8 col-sm-6 col-xs-6">
                <select name="location" class="form-control locations_select2">
                    @foreach($all_user_locations as $locations)
                        <option>{{$locations}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
                <button type="submit" class="btn btn-success submit-qr">ثبت</button>
            </div>
        </div>

    </form>

    <div id="flip" class="btn-primary">مشاهده qr های ثبت شده</div>

    <div id="panel" style="display: none;">

        @if(count($qr_notifs) == 0)
            <p style="text-align: center;color: #2176bd">هنوز پیامی را ثبت نکرده اید.</p>
        @endif
        @if(count($qr_notifs) > 1)
            <div>
            <span
                    onclick="printJS({
                            printable: [
                    @foreach($qr_notifs as $notif)
                            '{{asset($notif->get_pic())}}',
                    @endforeach
                            ],
                            type: 'image',
                            header: 'سامانه تبلیغات محیطی هوشمند آفرا',
                            imageStyle: 'width:25%;margin-bottom:20px;'
                            })"
                    class="btn btn-primary" style="text-align: center;color: white">
                <i class="fa fa-print"></i> چاپ همه</span>
            </div>
        @endif
        @foreach($qr_notifs as $notif)

            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="qr-box">

                    <div class="col-md-6 col-sm-8 col-xs-7 qr-image">
                        <div class="qr-image-content" style="margin: 15px;height: 90px;width: 90px;">
                            <img style="width: 100%;height: 100%; display: block;"
                                 src="{{asset($notif->get_pic())}}"
                                 alt="{{$notif->content}}"/>
                            <div class="qr-remove">
                                <form style="float: right" action="{{ route('del_qrcode', ['qrcode' => $notif->id])}}"
                                      method="post">
                                    {{csrf_field()}}
                                    {!! method_field('DELETE') !!}
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button type="submit" class="btn btn-danger"><i
                                                class="fa fa-times"></i></button>
                                </form>
                                <span
                                        onclick=" printJS(
                                                {printable:'{{asset($notif->get_pic())}}',
                                                type: 'image',
                                                header: 'سامانه تبلیغات محیطی هوشمند آفرا',
                                                imageStyle: 'width:25%;margin-bottom:20px;' })"
                                        class="btn btn-primary"><i
                                            class="fa fa-print"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-offset-6 col-sm-offset-7 col-xs-offset-7">
                        <div class="form-group">
                            <label class="control-label">متن پیام :</label>
                            <p class="control-label">{{$notif->content}}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">طبقه بندی :</label>
                            <span class="control-label">{{$notif->group}}</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">موقعیت :</label>
                            <span class="control-label">{{$notif->location}}</span>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/print.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#flip").click(function () {
                $("#panel").slideToggle("slow");

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".groups_select2").select2();
        });
        $(document).ready(function () {
            $(".locations_select2").select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".submit-qr").click(function () {
                if ({{count($qr_notifs)}} >=
                5
            )
                alert("شما تاکنون 5 qr ثبت کرده اید. برای تولید qr جدید به مدیریت درخواست بدهید.");
            })
        });
    </script>

@endsection