@extends('layout.main')
@section('title')
    تعریف بیکن
@endsection
@section('header')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet"/>
    <style>
        .select2-selection--single {
            border-color: #dddddd;
        }

        #flip {
            text-align: center;
            width: 17%;
            margin: auto;
            min-width: 170px;
            padding: 7px;
            border-radius: 5px;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .beacon {
            width: 13%;
            display: inline;
        }
    </style>




@endsection
@section('subtitle')
    مدیریت بیکن ها/ تعریف بیکن

    {{--<li class="breadcrumb-item">مدیریت بیکن ها</li>--}}
    {{--<li class="breadcrumb-item border">تعریف بیکن</li>--}}
@endsection
@section('content')
    @if($errors->has('name'))
        <p class="alert-error p-0" style="border-radius: 4px ; padding-right: 4px">
            {{$errors->first('name') }}
        </p>
    @endif
    @if($errors->count('beacon_mac.*') > 0)
        <p class="alert-error p-0" style="border-radius: 4px ; padding-right: 4px">
            {{$errors->first('beacon_mac.*') }}
        </p>
    @endif
    @if($errors->has('uuid'))
        <p class="alert-error p-0" style="border-radius: 4px ; padding-right: 4px">
            {{$errors->first('uuid') }}
        </p>
    @endif

    @if(session()->has('beacon-message'))
        <p class="alart alert-success p-0" style="border-radius: 4px ; padding-right: 4px">
            {{session('beacon-message')}}
            {{--            {{session('destroy-message')}}--}}
        </p>
    @endif
    <div class="errorTxt"></div>
    {{--{{var_dump(old('beacon_mac'))}}--}}
    <!-- page content -->
    <div id="aaa">
        <form method="post" action="{{route('beacon.store')}}" id="beacon-form"
              data-parsley-validate class="form-horizontal form-label-left">

            {{csrf_field()}}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right" for="name">نام بیکن *
                    :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"
                           name="name"
                           class="form-control col-md-7 col-xs-12" value="{{old('name')}}">
                </div>
                <span style="font-size: 10px;">برای بیکن خود یک نام انتخاب کنید.</span>
                <br>
                <span style="font-size: 8px;">در بقیه بخش ها دسترسی راحتتری به بیکن خود دارید.</span>

            </div>

            <div class="form-group" style="direction: ltr">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">: * mac_address
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <span>[</span>
                    <input name="beacon_mac[0]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.0')}}"/>
                    <span>:</span>
                    <input name="beacon_mac[1]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.1')}}"/>
                    <span>:</span>
                    <input name="beacon_mac[2]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.2')}}"/>
                    <span>:</span>
                    <input name="beacon_mac[3]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.3')}}"/>
                    <span>:</span>
                    <input name="beacon_mac[4]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.4')}}"/>
                    <span>:</span>
                    <input name="beacon_mac[5]" maxlength="2"
                           class="form-control beacon"
                           type="text" value="{{old('beacon_mac.5')}}"/>
                    <span>]</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right" for="uuid">uuid :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="uuid"
                           class="form-control col-md-7 col-xs-12" value="{{old('uuid')}}">
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
                           type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">tx :
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="tx" id="birthday"
                           class="date-picker form-control col-md-7 col-xs-12" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">طبقه بندی * :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="group" class="form-control groups_select2">
                        @foreach($groups as $group)
                            <option value="{{$group}}">{{$group}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">موقعیت مکانی *
                    :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="location" class="form-control locations_select2">
                        @foreach($locations as $location)
                            <option>{{$location}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" id="beacon-click" class="btn btn-success">ثبت</button>
                </div>
            </div>

        </form>
        <div id="flip" class="btn-primary">مشاهده بیکن های ثبت شده
        </div>
        <div id="panel" class="table-responsive">
            @if(count($beacons) == 0)
                <p style="text-align: center;color: #2176bd">هنوز بیکنی را ثبت نکرده اید.</p>
            @else
                <table class="table table-striped jumbotron bulk_action">
                    <thead>
                    <tr class="headings">

                        <th class="column-title">ردیف</th>
                        <th class="column-title">نام بیکن</th>
                        <th class="column-title">uuid</th>
                        <th class="column-title">مک آدرس</th>
                        {{--<th class="column-title">major</th>--}}
                        {{--<th class="column-title">minor</th>--}}
                        {{--<th class="column-title">tx</th>--}}
                        <th class="column-title">طبقه بندی</th>
                        <th class="column-title">مکان</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($beacons as $beacon)

                        <tr class="dtr-column">

                            <td style="vertical-align: middle">{{$loop->index +1}}</td>
                            <td style="vertical-align: middle">{{$beacon->name}}</td>
                            <td style="vertical-align: middle">{{$beacon->uuid}}</td>
                            <td style="vertical-align: middle">{{$beacon->mac_address}}</td>
                            {{--<td>{{$beacon->major}}</td>--}}
                            {{--<td>{{$beacon->minor}}</td>--}}
                            {{--<td>{{$beacon->tx}}</td>--}}
                            <td style="vertical-align: middle">{{$beacon->group}}</td>
                            <td style="vertical-align: middle">{{$beacon->location}}</td>
                            <td class="success" style="text-align: center">
                                <form action="{{ route('beacon.destroy', ['beacon' => $beacon->mac_address])}}"
                                      method="post">
                                    {{csrf_field()}}
                                    {!! method_field('DELETE') !!}
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                            @if($beacon->status==1)
                                <td class="success">
                                    <a href="{{ route('beacon.edit', ['beacon' => $beacon->mac_address])}}">
                                        <button class="btn btn-success beacon-set"><i class="fa fa-pencil"></i> ویرایش</button>
                                    </a>
                                </td>
                            @else
                                <td style="background: red;font-weight: bold;color: white;text-align: center;vertical-align: middle;">
                                    غیرفعال
                                </td>
                            @endif

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

@section('footer')

    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".groups_select2").select2();
        });
        $(document).ready(function () {
            $(".locations_select2").select2();
        });
    </script>
    <script>
        // $('.beacon-set').on('click', function() {
        $(function () {
            setupFormValidator()
        });

         function setupFormValidator() {
                let rules = {

                    name: {
                        required: true,
                        minlength: 3,
                    },
                    uuid: {
                        required: true,
                    },
                    beacon_mac: {
                        required: true,
                    }
                };
                let messages = {
                    name: {
                        required: "نام را وارد کنید",
                        minlength: "نام بیکن باید حداقل شامل 3 حرف باشد"
                    },
                    uuid: {
                        required: "uuid را وارد کنید",
                    },
                    beacon_mac: {
                        required: "مک آدرس را وارد کنید",
                    }
                };

                $("#beacon-form").validate({
                    // onKeyUp: false,
                    // ignore: [],
                    // onFocusOut: false,
                    // focusInvalid: false,
                    // debug: false,
                    lang: 'fa',
                    rules: rules,
                    messages: messages,
                    errorPlacement: function (error, element) {
                        $(document).on('click', '#beacon-click', function (event) {
                            $('.errorTxt').empty();
                        });
                        $('.errorTxt').append(`<p class="alert-error p-0">` + error.text() + `</p>`);

                    }
                });

                $('#beacon-click').click(function () {
                    $("#beacon-form").valid();

                });
            }

    </script>



    <script>
        $(document).ready(function () {
            $("#flip").click(function () {
                $("#panel").slideToggle("slow");
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.alart').delay(3000).slideUp(300);
        });
    </script>
    <style>
        #panel {
            display: none;
            margin: 8px;
        }

        #flip {
            /*width:15%;*/
            margin: 0 auto;
        }

    </style>
@endsection

