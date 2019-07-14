@extends('layout.main')
@section('title')
    ویرایش اطلاعات
@endsection

@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script>
        function append1() {
            var groups = $("#groups").val();
            $("#grouplist").val(function (i, origText) {
                return origText + "+" + groups;
            });
            var txt1 = $("<tr style='padding: 10px;text-align: center;border-bottom: 1px solid #ddd'><td style='margin-bottom: 10px'></td></tr>").text(groups);
            $('#grtable tbody').after(txt1);
            $("#groups").val("");
        }
    </script>
    <script>
        function append3() {
            var location = $("#location").val();
            $("#locationlist").val(function (i, origText) {
                return origText + "+" + location;
            });
            var txt3 = $("<tr style='padding: 10px;text-align: center;border-bottom: 1px solid #ddd'><td style='margin-bottom: 10px'></td></tr>").text(location);
            $('#loctable tbody').after(txt3);
            $("#location").val("");
        }
    </script>

    <script>
        $(function(){
            var test = localStorage.input === 'true'? true: false;
            $('input').prop('checked', test || false);
        });

        $('input').on('change', function() {
            localStorage.input = $(this).is(':checked');
            console.log($(this).is(':checked'));
        });
    </script>

@endsection

@section('content')
    <div class="alert-danger" style="padding-right: 3px;margin: 5px">{{$text}}</div>

    <!-- /page content -->
    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
        <form class="form-group row" method="post" action="{{route('favorite_set')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label class="col-md-4 col-sm-12 col-xs-12" for="first-name">دسته بندی مغازه های پاساژ را
                مشخص کنید.

            </label>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <input type="text" id="favorite" name="favorite"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                <input type="file" name="favoritefile">

            </div>
            <button class="btn btn-primary"><span class="fa fa-plus"></span></button>
            <table id="grtable" style="margin: 15px" class="table table-striped table-bordered">

                <tbody id="tbody">
                @foreach($favorites as $favorite)
                <th style="text-align: center">{{$favorite->favorite}}</th>
                    @endforeach
                </tbody>

            </table>

        </form>

        <div class="row">
            <div class="form-group col-md-4">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">طبقه بندی :

            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="groups" name="groups"
            class="form-control col-md-7 col-xs-12">
            </div>
            <button class="btn btn-primary" onclick="append1()"><span class="fa fa-plus"></span></button>
            <table id="grtable" style="margin: 5px" class="table table-striped table-bordered">

            <thead>
            <tr>
            <th style="text-align: center">طبقه بندی</th>
            </tr>
            </thead>
            <tbody id="tbody" style="padding: 10px;margin: 10px">

            </tbody>

            </table>


            </div>

            <div class="form-group col-md-4">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">موقعیت :

                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="location" name="location"
                           class="form-control col-md-7 col-xs-12">
                </div>
                <button class="btn btn-primary" onclick="append3()"><span class="fa fa-plus"></span></button>
                <table id="loctable" style="margin: 5px" class="table table-striped table-bordered">

                    <thead>
                    <tr>
                        <th style="text-align: center">طبقه بندی</th>
                    </tr>
                    </thead>
                    <tbody style="padding: 10px;margin: 10px;">

                    </tbody>

                </table>


            </div>

        </div>
        <form class="form-group" method="post" action="{{route('inform_set')}}">
            {{csrf_field()}}
            <input name="locationlist" type="hidden" id="locationlist">
            <input name="grouplist" type="hidden" id="grouplist">
            <span>جهت ثبت اطلاعات ورودی ثبت اطلاعات را بزنید.</span>
            <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
        </form>
    @elseif(\Illuminate\Support\Facades\Auth::user()->isadmin==0 && \Illuminate\Support\Facades\Auth::user()->isuser==1)

        <form class="form-group" method="post" action="{{route('inform_set')}}">
            {{csrf_field()}}

        <div class="form-group col-md-12 col-sm-6 col-xs-12">
            <label>طبقه بندی</label>
        @foreach($all_groups as $i => $group)
                <label style="padding: 20px;text-align: center;" class="form-check" for="gmenu[{{$i}}]">
                    <div>{{$group}}</div>
                    <input style="" class="flat" name="gmenu[{{$i}}]" type="checkbox"
                           value="{{$group}}">
                </label>
            @endforeach
            <div class="ln_solid"></div>

        </div>



        <div class="form-group col-md-12 col-sm-6 col-xs-12">
            <label>موقعیت</label>
        @foreach($all_locations as $i => $location)
                <label style="padding: 20px;text-align: center;" class="form-check" for="lmenu[{{$i}}]">
                    <div>{{$location}}</div>
                    <input style="" class="flat" name="lmenu[{{$i}}]" type="checkbox"
                           value="{{$location}}">
                </label>
            @endforeach
        </div>


            <span>جهت ثبت اطلاعات ورودی، ذخیره اطلاعات را بزنید.</span>
            <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
        </form>

    @endif
@endsection



