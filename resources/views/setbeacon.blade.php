@extends('layout.main')
@section('title')
    ایجاد بیکن
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#flip").click(function () {
                $("#panel").slideToggle("slow");
                $('html, body').animate({
                    scrollTop: $("aaa").offset().top
                },1000);
            });
        });
    </script>
@endsection
@section('subtitle')
    فرم ایجاد بیکن
    @endsection
@section('content')

    <!-- page content -->
<div id="aaa">
                            <form method="post" action="{{route('beacon.store')}}" id="demo-form2"
                                  data-parsley-validate class="form-horizontal form-label-left">

                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right" for="name">نام بیکن :
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" required="required"
                                               name="name"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                    <span style="font-size: 10px;">برای بیکن خود یک نام انتخاب کنید.</span>
                                    <br>
                                    <span style="font-size: 8px;">در بقیه بخش ها دسترسی راحتتری به بیکن خود دارید.</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right" for="uuid">uuid :
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="uuid" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">mac_address :
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="beacon_mac" id="birthday"
                                               class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name"
                                           class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">major :</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" type="text"
                                               name="major">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">minor :
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="minor" class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">tx :
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="tx" id="birthday"
                                               class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">ماهیت بیکن :</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="nature" class="form-control">

                                            <option>انتخاب گزینه</option>
                                            @foreach($natures as $nature)
                                            <option>{{$nature}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">طبقه بندی :</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="group" class="form-control">
                                            <option>انتخاب گزینه</option>
                                            @foreach($groups as $group)
                                            <option>{{$group}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">موقعیت مکانی :</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="location" class="form-control">
                                            <option>انتخاب گزینه</option>
                                            @foreach($locations as $location)
                                            <option>{{$location}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">ثبت</button>
                                    </div>
                                </div>

                            </form>
                            <div id="flip" style="text-align: center;" class="btn btn-success">مشاهده بیکن های ثبت شده
                            </div>
                            <div id="panel" class="table-responsive">
                                <table class="table table-striped jumbotron bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">نام بیکن</th>
                                        <th class="column-title">uuid</th>
                                        <th class="column-title">مک آدرس</th>
                                        <th class="column-title">major</th>
                                        <th class="column-title">minor</th>
                                        {{--<th class="column-title">tx</th>--}}
                                        <th class="column-title">طبقه بندی</th>
                                        <th class="column-title">ماهیت بیکن</th>
                                        <th class="column-title">مکان</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <input value="{{$i = 1}}" hidden>
                                    @foreach($beacons as $beacon)

                                        <tr class="dtr-column">

                                            <td>{{$i}}</td>
                                            <td>{{$beacon->uuid}}</td>
                                            <td>{{$beacon->mac_address}}</td>
                                            <td>{{$beacon->major}}</td>
                                            <td>{{$beacon->minor}}</td>
{{--                                            <td>{{$beacon->tx}}</td>--}}
                                            <td>{{$beacon->group}}</td>
                                            <td>{{$beacon->nature}}</td>
                                            <td>{{$beacon->location}}</td>
                                            <td class="success" style="text-align: center">
                                                <form action="{{ route('beacon.destroy', ['beacon' => $beacon->mac_address])}}"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    {!! method_field('DELETE') !!}
                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <input class="btn btn-danger" type="submit" value="حذف"/>
                                                </form>
                                            </td>
                                            <td class="success">
                                                <a href="{{ route('beacon.edit', ['beacon' => $beacon->mac_address])}}">
                                                    <button class="btn btn-success">ویرایش</button>
                                                </a>
                                            </td>

                                        </tr>
                                        <input value="{{$i++}}" hidden>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
</div>
@endsection

@section('footer')
    <style>
        #panel {
            display: none;
        }

    </style>
@endsection

