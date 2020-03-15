@extends('layout.main')
@section('title')
    پیام های فروشگاه ها
@endsection
@section('header')
    @include('home.js')
    <style>
        .exam-parent {
            background: #F7F7F7;
            border: 1px solid #E6E9ED;
            margin: 3px;
        }

        .exam-name {
            font-size: 14px;
            font-weight: bold;
            color: #73879C;
            width: 100%;
            text-align: right;
            margin-bottom: 5px;
            margin-right: 5px;
            display: inline-block;
            padding: 6px 12px;
            line-height: 1.42857143;
            vertical-align: middle;
            cursor: pointer;
        }

        .exam-name span {
            font-size: 14px;
            font-weight: bolder;
            float: left;
            padding-top: 5px;
        }

        .content-exam {
            background: white;
            border: 1px solid #E6E9ED;
            height: 100%;
        }

        .content-exam p {
            alignment: center;
            padding: 3px;
            color: #029ef3;
            text-align: center;
        }

        .label-exam {
            font-size: 14px;
            color: #73879C;
            font-weight: bold;
        }

        .table td, .table th {
            padding: 6px;
        }
    </style>

@endsection
@section('subtitle')
    مدیریت پیام ها/ مدیریت پیام های مرکز تجاری {{$admin_shop}}
@endsection
@section('content')

    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
        <p>شما به این بخش دسترسی ندارید.</p>
    @else
        @foreach($shops as $shop)
            <div class="col-md-12 col-sm-12 col-xs-12 exam-parent">
            <span class="exam-name">{{$shop->shop_name}}
                <i style="font-size: 9px">(تعداد پیام عمومی : {{$shop->message_num()}})</i>
                <i style="font-size: 9px">(تعداد پیام کیوآر : {{$shop->qrcode_num()}} )</i>
                <span
                        class="fa fa-chevron-down"></span></span>
                <div class="row">
                    @foreach($shop->messages() as $shop_messages)
                        <div style="padding: 10px;display: none"
                             class="col-md-4 col-sm-4 col-xs-4 exam-child">
                            <div class="card content-exam">
                                <p class="card-header container" style="width: 80%;border-bottom: 1px solid #029ef3 ">پیام عمومی
                                </p>
                                <input type="hidden" class="beacon-id" value="{{$shop_messages->user_id}}">
                                <div class="card-body row container-fluid">
                                    <div class="col-md-4 col-sm-4">

                                        <div style="margin: 8px;height: 100px;width: 100px;">
                                            <img style="width: 100%;height: 100%; display: block;"
                                                 src="{{asset($shop_messages->pic)}}"
                                                 alt="{{$shop_messages->content}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-4 col-sm-offset-4">
                                        <p style="text-align: center">متن پیام</p>
                                        <p class="container-fluid label-exam">
                                            {{$shop_messages->content}}</p>
                                    </div>


                                    <div class="col-md-6">
                                        {{--<label class="label-exam">مشخصات بیکن</label>--}}
                                        {{--<br>--}}
                                        {{--<tr>--}}
                                        {{--<th style="width: 100%;font-size: 13px;font-weight: bold">مک آدرس بیکن</th>--}}
                                        {{--<td style="width: 100%">{{$shop_beacon->mac_address}}</td>--}}
                                        {{--</tr>--}}
                                        <table class="table">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>نوع</th>
                                                <td>{{$shop_messages->type === 1 ? "تخفیفی" : "عادی"}}</td>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 10px;font-weight: bold;vertical-align: middle">میزان تخفیف</th>
                                                <td>{{$shop_messages->type === 1 ? $shop_messages->percent : "-"}}</td>
                                            </tr>
                                            <tr>
                                                <th>تاریخ ثبت</th>
                                                <td>{{\Morilog\Jalali\ Jalalian::forge($shop_messages->created_at)->format('%d %B %y')}}</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-6">
                                        {{--<label class="label-exam">پیام عمومی</label>--}}
                                        {{--<br>--}}
                                        <table class="table">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>وضعیت</th>
                                                <td class="beacon-status">{{$shop_messages->status === 1 ? "فعال"  : "غیرفعال" }}</td>
                                            </tr>
                                            <tr>
                                                <th>پیام</th>
                                                <td>ثبت شده</td>
                                            </tr>
                                            <tr>
                                                <th>تعداد بازدید</th>
                                                <td>2</td>
                                            </tr>

                                            {{--<tr>--}}
                                            {{--<th> درصد</th>--}}
                                            {{--<td>48.2</td>--}}
                                            {{--</tr>--}}
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm disabled-beacon"
                                            style="background: {{$shop_messages->status === 1 ? "#C9302C"  : "#169F85" }};color: white">
                                        {{$shop_messages->status === 1 ? "غیرفعال کردن"  : "فعال کردن" }}</button>
                                    <button class="btn btn-sm btn-success">ویرایش</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach($shop->qrcodes() as $shop_qrcodes)
                        <div style="padding: 10px;display: none"
                             class="col-md-4 col-sm-4 col-xs-4 exam-child">
                            <div class="card content-exam">
                                <p class="card-header container" style="width: 80%;border-bottom: 1px solid #029ef3 ">پیام qrcode
                                </p>
                                <input type="hidden" class="beacon-id" value="{{$shop_qrcodes->user_id}}">
                                <div class="card-body row container-fluid">
                                    <div class="col-md-4 col-sm-4">

                                        <div style="margin: 8px;height: 100px;width: 100px;">
                                            <img style="width: 100%;height: 100%; display: block;"
                                                 src="{{asset($shop_qrcodes->get_pic())}}"
                                                 alt="{{$shop_qrcodes->content}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-4 col-sm-offset-4">
                                        <p style="text-align: center">متن پیام</p>
                                        <p class="container-fluid label-exam">
                                            {{$shop_qrcodes->content}}</p>
                                    </div>


                                    <div class="col-md-6">
                                        {{--<label class="label-exam">مشخصات بیکن</label>--}}
                                        {{--<br>--}}
                                        {{--<tr>--}}
                                        {{--<th style="width: 100%;font-size: 13px;font-weight: bold">مک آدرس بیکن</th>--}}
                                        {{--<td style="width: 100%">{{$shop_beacon->mac_address}}</td>--}}
                                        {{--</tr>--}}
                                        <table class="table">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>طبقه بندی</th>
                                                <td>{{$shop_qrcodes->group}}</td>
                                            </tr>
                                            <tr>
                                                <th>موقعیت</th>
                                                <td>{{$shop_qrcodes->location}}</td>
                                            </tr>
                                            <tr>
                                                <th>تاریخ ثبت</th>
                                                <td>{{\Morilog\Jalali\ Jalalian::forge($shop_qrcodes->created_at)->format('%d %B %y')}}</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-6">
                                        {{--<label class="label-exam">پیام عمومی</label>--}}
                                        {{--<br>--}}
                                        <table class="table">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>وضعیت</th>
                                                <td class="beacon-status">{{$shop_qrcodes->status === 1 ? "فعال"  : "غیرفعال" }}</td>
                                            </tr>
                                            <tr>
                                                <th>پیام</th>
                                                <td>ثبت شده</td>
                                            </tr>
                                            <tr>
                                                <th>تعداد بازدید</th>
                                                <td>2</td>
                                            </tr>

                                            {{--<tr>--}}
                                            {{--<th> درصد</th>--}}
                                            {{--<td>48.2</td>--}}
                                            {{--</tr>--}}
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm disabled-beacon"
                                            style="background: {{$shop_qrcodes->status === 1 ? "#C9302C"  : "#169F85" }};color: white">
                                        {{$shop_qrcodes->status === 1 ? "غیرفعال کردن"  : "فعال کردن" }}</button>
                                    <button class="btn btn-sm btn-success">ویرایش</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach
    @endif
@endsection
@section('footer')

    <script>
        $(function () {
            $('.exam-name').on('click', function () {
                let parent = $(this).closest('.exam-parent');
                let content = parent.find('.exam-child');
                $(content).slideToggle("slow");
            });
        });

    </script>
@endsection