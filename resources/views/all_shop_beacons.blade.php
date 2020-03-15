@extends('layout.main')
@section('title')
    بیکن فروشگاه ها
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
        .exam-name span{
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
    مدیریت بیکن ها/ مدیریت بیکن های مرکز تجاری {{$admin_shop}}
@endsection
@section('content')

    {{--@cannot('is-admin')--}}
        {{--<p>شما به این بخش دسترسی ندارید.</p>--}}
    {{--@elsecannot('is-admin')--}}


    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
        <p>شما به این بخش دسترسی ندارید.</p>
    @else
        @foreach($shops as $shop)
            <div class="col-md-12 col-sm-12 col-xs-12 exam-parent">
            <span class="exam-name">{{$shop->shop_name}} ({{$shop->beacon_num()}})<span
                        class="fa fa-chevron-down"></span></span>
                <div class="row">
                    @foreach($shop->beacons() as $shop_beacon)
                        <div style="padding: 10px; display: none"
                             class="col-md-4 col-sm-12 col-xs-12 exam-child">
                            <div class="content-exam card">
                                <p class="container card-header" style="width: 80%;border-bottom: 1px solid #029ef3 ">
                                    بیکن {{$shop_beacon->name}}</p>
                                <input type="hidden" class="beacon-id" value="{{$shop_beacon->mac_address}}">
                                <div class="row card-body container-fluid">
                                    <p class="container-fluid label-exam"
                                       style="width: 80%;border-bottom: 1px solid #029ef3">مک آدرس
                                        :{{$shop_beacon->mac_address}}</p>
                                    <p class="container-fluid label-exam" style="width: 80%;">متن پیام
                                        :{{$shop_beacon->mac_address}}</p>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="label-exam">مشخصات بیکن</label>
                                        {{--<br>--}}
                                        {{--<tr>--}}
                                        {{--<th style="width: 100%;font-size: 13px;font-weight: bold">مک آدرس بیکن</th>--}}
                                        {{--<td style="width: 100%">{{$shop_beacon->mac_address}}</td>--}}
                                        {{--</tr>--}}
                                        <table class="table">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>طبقه بندی</th>
                                                <td>{{$shop_beacon->group}}</td>
                                            </tr>
                                            <tr>
                                                <th>موقعیت</th>
                                                <td>{{$shop_beacon->location}}</td>
                                            </tr>
                                            <tr>
                                                <th>تاریخ ثبت</th>
                                                <td>{{\Morilog\Jalali\ Jalalian::forge($shop_beacon->created_at)->format('%d %B %y')}}</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        {{--<label class="label-exam">پیام عمومی</label>--}}
                                        <br>
                                        <table class="table" style="margin-top: 8px">
                                            <tbody style="text-align: center">
                                            <tr>
                                                <th>وضعیت</th>
                                                <td class="beacon-status">{{$shop_beacon->status === 1 ? "فعال"  : "غیرفعال" }}</td>
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
                                    <button class="btn disabled-beacon"
                                            style="background: {{$shop_beacon->status === 1 ? "#C9302C"  : "#169F85" }};color: white">
                                        {{$shop_beacon->status === 1 ? "غیرفعال کردن"  : "فعال کردن" }}</button>
                                    <button class="btn btn-success">ویرایش</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        @endforeach
    @endif
    {{--@endcannot--}}
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
    <script>
        $(function () {
            $('.disabled-beacon').on('click', function (event) {
                event.preventDefault();
                let button = $(this);
                let parent = $(this).closest('.content-exam');
                let status = parent.find('.beacon-status');

                // let parent_color = $(this).closest('.comment-parent');
                let mac_address = parent.find(".beacon-id").val();
                // let answer = content.val();

                let url = "/beacon/change/status";
                let method = 'POST';
                let data = {'mac_address': mac_address, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        console.log(response.new_status);
                        // alert(response.message);
                        if (response.success) {
                            // content.attr('readOnly', 'readonly');
                            // button.attr('disabled', 'disabled');
                            if (response.new_status == 1){
                                status.text("فعال");
                                button[0].innerHTML = "غیر فعال کردن";
                                button[0].style.background = "#C9302C";
                            }
                            else {

                                status.text("غیر فعال");
                                button[0].innerHTML = "فعال کردن";
                                button[0].style.background = "#169F85";
                            }

                            // console.log(parent_color[0]);
                            // parent_color[0].style.background = "#F7F7F7";
                        }
                        else {
                            alert('پاسخ مناسب از سرور دریافت نشد.')

                        }
                    },
                    error: function (xhr) {
                        alert('ارتباط با سرور قطع شده است.');
                        console.log(xhr)
                    }

                });
            });
        });
    </script>
    @endsection