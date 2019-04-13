@extends('layout.main')
@section('title')
    پروفایل
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}" xmlns=""></script>
    <script>
        $(document).ready(function () {

            $("#input1").change(function () {
                var input = $("#input1").val();
                $("#output1").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input2").change(function () {
                var input = $("#input2").val();
                $("#output2").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input3").change(function () {
                var input = $("#input3").val();
                $("#output3").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input4").change(function () {
                var input = $("#input4").val();
                $("#output4").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input5").change(function () {
                var input = $("#input5").val();
                $("#output5").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input6").change(function () {
                var input = $("#input6").val();
                $("#output6").text(input);
            });
        });
        </script>
    <script>
        $(document).ready(function () {
            $("#input7").change(function () {
                var input = $("#input7").val();
                $("#output7").text(input);
            });
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="{{url('api/setshop')}}" id="demo-form2"
                  data-parsley-validate class="form-horizontal form-label-left">

                {{csrf_field()}}
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" style="text-align: right">نام و نام خانوادگی :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text"
                               name="name" id="input1"
                               class="col-md-6 col-xs-12">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shop_name" style="text-align: right">نام فروشگاه :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="shop_name" id="input2"
                               class="col-md-6 col-xs-12">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">شماره تماس :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="groups" id="input3"
                               class="col-md-6 col-xs-12"
                               type="text">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">آدرس ایمیل :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="groups" id="input4"
                               class="col-md-6 col-xs-12"
                               type="text">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">لوگو :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="logo" id="input5"
                               class="col-md-6 col-xs-12"
                               type="text">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label for="middle-name"
                           class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">آدرس :</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="add" class="col-md-6 col-xs-12" type="text" id="input6">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right">دسته بندی فروشگاه :
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="groups" id="input7"
                               class=" col-md-6 col-xs-12"
                               type="text">
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-top:2%">
            <div class="form-group" style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >نام و نام خانوادگی :
                </label>
                <label id="output1" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group" style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >نام فروشگاه :
                </label>
                <label id="output2" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group" style="margin: 5px">
                <label class=" col-md-6 col-sm-3 col-xs-6" >شماره تماس :
                </label>
                <label id="output3" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group" style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >آدرس ایمیل :
                </label>
                <label id="output4" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group" style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >لوگو :
                </label>
                <label id="output5" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group" style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >آدرس :
                </label>
                <label id="output6" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>
            <div class="form-group " style="margin: 5px">
                <label class="control-label col-md-6 col-sm-3 col-xs-6" >دسته بندی فروشگاه :
                </label>
                <label id="output7" class="control-label col-md-6 col-xs-6" style="color: #000;">
                    تعیین نشده است
                </label>
            </div>

        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">

        <button type="submit" class="btn btn-success">تکمیل پروفایل</button>

    </div>
@endsection
@section('footer')
    <style>
        #input1 , #input2 , #input3 , #input4 , #input5 , #input6 , #input7{
            border-top: none;
            border-left:none;
            border-right:none;
        }
    </style>

@endsection
