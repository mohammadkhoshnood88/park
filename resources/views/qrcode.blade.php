@extends('layout.main')
@section('title')
    مدیریت پیام های qrcode
@endsection

@section('content')

    <form method="post" action="{{route('beacon.store')}}" id="demo-form2"
          data-parsley-validate class="form-horizontal form-label-left">

        {{csrf_field()}}
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">کد qr
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" required="required"
                       name="name"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">ماهیت qr</label>
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12">طبقه بندی qr</label>
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
            <label class="control-label col-md-3 col-sm-3 col-xs-12">موقعیت مکانی qr</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="location" class="form-control">
                    <option>انتخاب گزینه</option>
                    @foreach($locations as $location)
                        <option>{{$location}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">متن
                پیام : </label>
            <div class="col-md-8 col-sm-9 col-xs-12">
                    <textarea type="text" name="txt" class="form-control"
                              placeholder="متن پیام"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">تصویر
                 : </label>
            <div class="col-md-8 col-sm-9 col-xs-12">
                    <input type="file" name="pic">
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">ثبت</button>
            </div>
        </div>

    </form>

@endsection
