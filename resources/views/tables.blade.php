@extends('layout.main')

@section('title')
    گزارش ها
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");

                $('#all').animate({
                    scrollTop: $("#flip").offset().top
                },1000);
            });
        });



    </script>
    @endsection

@section('subtitle')
    گزارش ها
    @endsection
@section('content')

                    {{--<p>جدول مشتری</p>--}}
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <th class="column-title">number</th>
                            <th class="column-title">mac_beacon</th>
                            <th class="column-title">mac_address</th>
                            <th class="column-title">uuid</th>
                            <th class="column-title">rssi</th>
                            <th class="column-title">distance</th>
                            <th class="column-title">time</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($iot as $j => $beacon)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        {{$j+1}}
                                    </td>
                                    <td class=" ">{{auth()->user()->beacon_mac===$beacon?$beacon->customer_id:"s"}}</td>
                                    <td class=" ">{{$beacon->beacon_mac}}</td>
                                    <td class=" ">{{$beacon->beacon_id}}</td>
                                    <td class=" ">{{$beacon->rssi}}</td>
                                    <td class=" ">{{round(sqrt(abs($beacon->rssi)))}}cm</td>
                                    <td class=" ">{{$beacon->created_at}}</td>


                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    {{ $iot->links() }}

                <div class="container">
                    <div id="flip" class="btn btn-primary"> گزارشات خاص<i style="font-size: 17px" class="fa fa-chevron-down"></i></div>
                    <div id="panel">
                    <form method="post" action="{{route('beacon_record')}}">
                        {{csrf_field()}}
                        <div class="x_panel x_content">
                            <form class="row x_title">
                                <div class="col-md-6">
                                    <label>از تاریخ :</label>
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-8 xdisplay_inputx form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left"
                                                           id="single_cal4" name="fromdate"
                                                           aria-describedby="inputSuccessStatus">
                                                    <span class="fa fa-calendar-o form-control-feedback left"
                                                          aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <label>تا تاریخ :</label>
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-8 xdisplay_inputx form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left"
                                                           id="single_cal3" name="todate"
                                                           aria-describedby="inputSuccess2Status">
                                                    <span class="fa fa-calendar-o form-control-feedback left"
                                                          aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button class="btn btn-success" type="submit">دریافت جدول</button>
                                </div>
                            </form>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-5 col-sm-3 col-xs-12">انتخاب</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="prdate">
                                        <option>یک گزینه را انتخاب کنید</option>
                                        <option value="ssss">یک ماه اخیر</option>
                                        <option value="sss">یک هفته اخیر</option>
                                        <option value="ss">دیروز</option>
                                        <option value="s">امروز</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                        <form method="post" action="{{route('beacon_record')}}">
                            {{csrf_field()}}
                            <div class="row x_title">
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-8 col-sm-3 col-xs-12" for="uuid">مرتب سازی بر
                                        اساس uuid:
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="uuid" name="uuid"
                                               class="form-control col-md-8 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-8 col-sm-3 col-xs-12" for="beacon_mac">مرتب
                                        سازی بر اساس mac هر بیکن:
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="beacon_mac" name="customer_mac"
                                               class="form-control col-md-5 col-xs-12">
                                    </div>
                                </div>

                                <button style="margin:0px 20px 0px 0px" type="submit" class="col-md-2 btn btn-primary">دریافت جدول
                                </button>
                            </div>

                        </form>

                    </div>
                        @if($spiot != "")

                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <th class="column-title">number</th>
                                        <th class="column-title">mac_beacon</th>
                                        <th class="column-title">mac_address</th>
                                        <th class="column-title">uuid</th>
                                        <th class="column-title">rssi</th>
                                        <th class="column-title">distance</th>
                                        <th class="column-title">time</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($spiot as $j => $beacon)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    {{$j+1}}
                                                </td>
                                                <td class=" ">{{$beacon->customer_id}}</td>
                                                <td class=" ">{{$beacon->beacon_mac}}</td>
                                                <td class=" ">{{$beacon->beacon_id}}</td>
                                                <td class=" ">{{$beacon->rssi}}</td>
                                                <td class=" ">{{round(sqrt(abs($beacon->rssi)))}}cm</td>
                                                <td class=" ">{{$beacon->created_at}}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    @endif
                </div>




@endsection

@section('footer')

    <style>
        #panel{
            padding: 5px;
            display: none;}
        #flip{
          text-align: center;
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
    @endsection
