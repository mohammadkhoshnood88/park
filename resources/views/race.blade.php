@extends('layout.main')
@section('title')
    ایجاد بازی
@endsection

@section('subtitle')
    مدیریت بازی ها/ فرم ایجاد بازی جدید
@endsection
@section('content')
    <form method="post" action="{{url('api/setshop')}}" id="demo-form2"
          data-parsley-validate class="form-horizontal form-label-left">

        {{csrf_field()}}

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right"> بیکن :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="beacon_mac"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
                    @foreach($beacons as $beacon)
                    <option>{{$beacon->name}}</option>
                        @endforeach
                </select>
            </div>
            <span style="font-size: 10px;vertical-align: middle">آن بیکنی که میخواهید برای آن بازی تعریف کنید را مشخص کنید.</span>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">نوع مسابقه :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="type" class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">دسته بندی فروشگاه :--}}
            {{--</label>--}}
            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                {{--<input name="groups"--}}
                       {{--class="date-picker form-control col-md-7 col-xs-12"--}}
                       {{--type="text">--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">عنوان مسابقه :</label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="race_title"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">توضیحات مسابقه :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="race_desc"
                       class="date-picker form-control col-md-4 col-xs-12"
                       type="text">
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">ایجاد</button>
            </div>
        </div>

    </form>
@endsection

@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
@endsection


