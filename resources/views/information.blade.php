@extends('layout.main')
@section('title')
    ویرایش اطلاعات
@endsection

@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script>
        function append2() {
            var nature = $("#nature").val();
            $("#naturelist").val(function(i,origText){return origText + "+" +nature; });
            var txt2 = $("<tr style='text-align: center;border-bottom: 1px solid #ddd'><td></td></tr>").text(nature);
            $('#nattable tbody').after(txt2);
            $("#nature").val("");

        }
    </script>
    <script>
        function append1() {
            var groups = $("#groups").val();
            $("#groupslist").val(function(i,origText){return origText + "+" +groups; });
            var txt1 = $("<tr style='padding: 10px;text-align: center;border-bottom: 1px solid #ddd'><td style='margin-bottom: 10px'></td></tr>").text(groups);
            $('#grtable tbody').after(txt1);
            $("#groups").val("");
        }
    </script>
    <script>
        function append3() {
            var location = $("#location").val();
            $("#locationlist").val(function(i,origText){return origText + "+" +location; });
            var txt3 = $("<tr style='padding: 10px;text-align: center;border-bottom: 1px solid #ddd'><td style='margin-bottom: 10px'></td></tr>").text(location);
            $('#loctable tbody').after(txt3);
            $("#location").val("");
        }
    </script>
    @endsection

@section('content')

        <!-- /page content -->

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
                                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">ماهیت  :

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nature" name="nature"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                                <button class="btn btn-primary" onclick="append2()"><span class="fa fa-plus"></span></button>
                                <table id="nattable" style="margin: 5px" class="table table-striped table-bordered">

                                    <thead>
                                    <tr>
                                        <th style="text-align: center">ماهیت</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

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
                    <form class="form-group" method="post" action="{{url('/api/information/set')}}">
                        <input name="locationlist" type="hidden" id="locationlist">
                        <input name="grouplist" type="hidden" id="grouplist">
                        <input  name="naturelist" type="hidden" id="naturelist">
                        <span>جهت ثبت اطلاعات ورودی ثبت اطلاعات را بزنید.</span>
                        <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
                    </form>



@endsection



