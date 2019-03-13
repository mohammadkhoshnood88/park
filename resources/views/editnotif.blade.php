@extends('layout.main')
<body>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


            <div class="x_title clearfix">
                <h3>فرم ویرایش بیکن  {{$beacons[0]->uuid}} </h3>
            </div>

            <div class="x_content">
                <br/>
                <br/>

                <form method="post" action="{{url('api/notif/edit')}}" id="demo-form2"
                      data-parsley-validate class="form-horizontal form-label-left">
                    {!! method_field('PUT') !!}
                    <input type="hidden" name="_method" value="PUT" />
                    {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12" for="name">کد بیکن
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"
                                       name="name" readonly value="{{$beacons[0]->name}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                            <label class="control-label col-md-5 col-sm-3 col-xs-12" for="uuid">uuid
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" readonly name="uuid" value="{{$beacons[0]->uuid}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="dis" placeholder="فاصله را تعیین کنید"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" name="txt" placeholder="متن پیام را بنویسید"
                                ></textarea>
                            </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="url" placeholder="url را تعیین کنید"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="pic" placeholder="آدرس عکس را وارد کنید"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="vid" placeholder="آدرس ویدئو را وارد کنید"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-warning">تایید</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
@extends('layout.footer')