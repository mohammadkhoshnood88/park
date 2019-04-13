@extends('layout.main')
@section('title')
    ایجاد بازی
@endsection
@section('content')
    <form method="post" action="{{url('api/setshop')}}" id="demo-form2"
          data-parsley-validate class="form-horizontal form-label-left">

        {{csrf_field()}}
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">نام :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"
                       name="name"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_name">نام فروشگاه :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="shop_name"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">مک بیکن :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="beacon_mac"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">لوگو :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="logo"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="middle-name"
                   class="control-label col-md-3 col-sm-3 col-xs-12">آدرس :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="add" class="form-control col-md-7 col-xs-12" type="text"
                >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">نوع مسابقه :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="type" class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">دسته بندی فروشگاه :
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="groups"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">عنوان مسابقه :</label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="race_title"
                       class="date-picker form-control col-md-7 col-xs-12"
                       type="text">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">توضیحات مسابقه :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="race_desc"
                       class="date-picker form-control col-md-4 col-xs-12"
                       type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">زمان اجرای مسابقه :</label>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <input name="arr_time"
                       class="date-picker form-control col-md-4 col-xs-12"
                       type="time">
            </div>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">تعداد شرکت کننده ها :</label>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <input name="number"
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



