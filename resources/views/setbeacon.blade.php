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
            });
        });
    </script>
@endsection
@section('subtitle')
    فرم ایجاد بیکن
    @endsection
@section('content')

    <!-- page content -->

                            <form method="post" action="{{route('beacon.store')}}" id="demo-form2"
                                  data-parsley-validate class="form-horizontal form-label-left">

                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">کد بیکن
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" required="required"
                                               name="name"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uuid">uuid
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="uuid" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">mac_address
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="beacon_mac" id="birthday"
                                               class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name"
                                           class="control-label col-md-3 col-sm-3 col-xs-12">major</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" type="text"
                                               name="major">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">minor
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="minor" class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">tx
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="tx" id="birthday"
                                               class="date-picker form-control col-md-7 col-xs-12"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">ماهیت بیکن</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="nature" class="form-control">
                                            <option>انتخاب گزینه</option>
                                            <option>گزینه اول</option>
                                            <option>گزینه دوم</option>
                                            <option>گزینه سوم</option>
                                            <option>گزینه چهارم</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">طبقه بندی</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="group" class="form-control">
                                            <option>انتخاب گزینه</option>
                                            <option>گزینه اول</option>
                                            <option>گزینه دوم</option>
                                            <option>گزینه سوم</option>
                                            <option>گزینه چهارم</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">موقعیت مکانی</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="location" class="form-control">
                                            <option>انتخاب گزینه</option>
                                            <option>گزینه اول</option>
                                            <option>گزینه دوم</option>
                                            <option>گزینه سوم</option>
                                            <option>گزینه چهارم</option>
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

                                        <th class="column-title">کد بیکن</th>
                                        <th class="column-title">uuid</th>
                                        <th class="column-title">major</th>
                                        <th class="column-title">minor</th>
                                        <th class="column-title">tx</th>
                                        <th class="column-title">طبقه بندی</th>
                                        <th class="column-title">ماهیت بیکن</th>
                                        <th class="column-title">مکان</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($beacons as $i=>$beacon)
                                        <tr class="dtr-column">

                                            <td>{{$beacon->uuid}}</td>
                                            <td>{{$beacon->uuid}}</td>
                                            <td>{{$beacon->mac_address}}</td>
                                            <td>{{$beacon->major}}</td>
                                            <td>{{$beacon->minor}}</td>
                                            <td>{{$beacon->tx}}</td>
                                            <td>{{$beacon->group}}</td>
                                            <td>{{$beacon->nature}}</td>
                                            <td>{{$beacon->location}}</td>
                                            <td class="success" style="text-align: center">
                                                <form action="{{ route('beacon.destroy', ['beacon' => $beacon->uuid])}}"
                                                      method="post">
                                                    {{csrf_field()}}
                                                    {!! method_field('DELETE') !!}
                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <input class="btn btn-danger" type="submit" value="حذف"/>
                                                </form>
                                            </td>
                                            <td class="success">
                                                <a href="{{ route('beacon.edit', ['beacon' => $beacon->uuid])}}">
                                                    <button class="btn btn-success">ویرایش</button>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

@endsection

@section('footer')
    <style>
        #panel {
            display: none;
        }

    </style>
@endsection

