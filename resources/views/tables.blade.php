@extends('layout.main')

@section('title')
    گزارش ها
@endsection
@section('header')
    <link href="{{asset('datatable/datatables.css')}}" rel="stylesheet">
    <link href="{{asset('datatable/button.css')}}" rel="stylesheet">

    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    {{--    <script src="{{asset('css/vendors/jquery/src/ajax.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
            $("#adv_search_p").click(function () {
                $("#search_panel").slideToggle("slow");
                $('html, body').animate({
                    scrollTop: $("aaa").offset().top
                }, 1000);
            });
        });
    </script>
    <style>
        #adv_search_p {
            text-align: center;
            margin-left: 6px;
            border-radius: 3px;
        }

        #search_panel {
            display: none;
            margin-top: 14px;
            margin-right: 5px;
        }
    </style>
    <style>
        #thdatatable {
            text-align: center;
            padding-left: 5px;
        }

        #tdtitle {
            font-size: 6px;
            text-align: center;
            font-weight: bold;
            padding: 0px;
            margin: 0px;
            background: rgba(52, 73, 94, .3);
            border-radius: 0px 0px 0px 13px;
            color: red;
            width: 80px;
        }

        #example_info_ {
            clear: both;
            float: left;
            padding-top: 0.755em;
            font-size: 12px;
            font-weight: bold;
            color: #73879c;
        }

        #label_ss {
            text-align: center;
            /*padding: auto;*/
            padding-top: 7px;
        }

        .dt-buttons button {
            background: #26b99a;
            color: white;
            border: 1px solid #169f85;
            border-radius: 3px;
            padding: 4px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.76143;
            white-space: nowrap;
            vertical-align: middle;
        }

        .buttons-html5:hover {
            background: #169F85;
        }

        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            /*opacity: 0.9;*/
            background-color: #F7F7F7;
            z-index: 99;
            text-align: center;
        }

        #loading-image {
            margin: 200px;
            text-align: center;
            color: red;
            font-size: 17px;
            font-weight: bolder;
        }
    </style>


    {{--$("#panel").slideToggle("slow");--}}

    {{--$('#all').animate({--}}
    {{--scrollTop: $("#flip").offset().top--}}
    {{--},1000);--}}
    {{--});--}}
    {{--});--}}



    {{--</script>--}}
@endsection

@section('subtitle')
    گزارش ها/ نمایش جدول
@endsection
@section('content')
    <div id="loading">
        <p id="loading-image">
            <span>در حال دریافت اطلاعات از سرور،
                <br>
                لطفا منتظر بمانید...
            </span>
            <br>
            <span style="font-size: 15px;color: blue">آفرا - offera-tech</span>
        </p>

    </div>


    {{--<p>جدول مشتری</p>--}}
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th id="thdatatable">ردیف</th>
            <th id="thdatatable">مک آدرس</th>
            <th id="thdatatable">نام بیکن</th>
            <th id="thdatatable">مک بیکن</th>
            <th id="thdatatable">فاصله</th>
            <th id="thdatatable">اولین بازدید</th>
            <th id="thdatatable">آخرین بازدید</th>
        </tr>
        </thead>
        <tbody>

        @foreach($beacon_iot as $i => $ii)
            <tr>
                <td id="thdatatable">{{$i+1}}</td>
                <td id="thdatatable">{{$ii->customer_id}}</td>
                <td id="thdatatable">{{$ii->name}}</td>
                <td id="thdatatable">{{$ii->beacon_mac}}</td>
                <td id="thdatatable">{{round(sqrt(abs($ii->rssi)))}}</td>
                <td id="thdatatable">{{\Morilog\Jalali\ Jalalian::forge($ii->created_at)->format('%A, %d %B %y | h:i:s')}}</td>
                <td id="thdatatable">{{\Morilog\Jalali\ Jalalian::forge($ii->updated_at)->format('%A, %d %B %y | h:i:s')}}</td>

            </tr>
        @endforeach
        </tbody>

        <tfoot>
        {{--<tr>--}}

        {{--</tr>--}}
        <tr>
            <td id="tdtitle">برای بهبود عملکرد جست و جو،<br>
                حداقل سه کاراکتر را وارد کنید :
            </td>
            <th>مک آدرس</th>
            <th>نام بیکن</th>
            <th>مک بیکن</th>
            <th id="ff">فاصله</th>
            <th>تاریخ</th>
            <th>تاریخ</th>
        </tr>

        </tfoot>

    </table>

    <div class="ln_solid"></div>
    <div id="test" class="btn-group">
        <p id="adv_search_p" class="btn btn-success">جست و جو پیشرفته</p>

    </div>
    <div class="row" id="search_panel">
        <div class="col-md-2 col-sm-2 col-xs-3">
            <input type="text" id="min" name="min" class="form-control" placeholder="کمینه فاصله">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-3">
            <input type="text" id="max" name="max" class="form-control" placeholder="بیشینه فاصله">
        </div>
        <div class="form-group">
            <label class="col-md-1 col-sm-2 col-xs-2" id="label_ss">بازدید های </label>
            <div class="col-md-3 col-sm-4 col-xs-4">
                <select class="form-control" id="selection_date">
                    <option id="none" value="none">یک گزینه را انتخاب کنید</option>
                    <option id="today" value="today">امروز</option>
                    <option id="yesterday" value="yesterday">دیروز</option>
                    <option id="last_week" value="last_week">هفته گذشته</option>
                    <option id="last_month" value="last_month">ماه گذشته</option>
                </select>
            </div>
        </div>
    </div>

@endsection

@section('footer')

    <script language="javascript" type="text/javascript">
        window.onload = function () {
            document.getElementById("loading").style.display = "none"
        }

    </script>

    <script type="text/javascript" src="{{asset('datatable/datatables.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/Button/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/Button/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/Button/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/Button/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/Button/html5.min.js')}}"></script>


    <script>

        $(document).ready(function () {

            $('#selection_date').change(function () {
                var e = document.getElementById("selection_date");
                var strUser = e.options[e.selectedIndex].value;
                // alert(strUser);
                switch (strUser) {
                    case "none":

                        break;
                    case "today":
                        alert("این گزارش موجود نیست");
                        // document.getElementById("dateee").value = document.getElementById("now_date").value;
                        // document.getElementById("date").value = document.getElementById("now_date").value;
                        // document.getElementById("max_date").value = "asdasd";
                        break;
                    case "yesterday":
                        alert("این گزارش موجود نیست");
                        break;
                    case "last_week":
                        alert("این گزارش موجود نیست");
                        break;
                    case "last_month":
                        alert("این گزارش موجود نیست");
                        break;

                }
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = parseInt($('#min').val(), 10);
                    var max = parseInt($('#max').val(), 10);
                    var dis = parseFloat(data[4]) || 0; // use data for the age column

                    if ((isNaN(min) && isNaN(max)) ||
                        (isNaN(min) && dis <= max) ||
                        (min <= dis && isNaN(max)) ||
                        (min <= dis && dis <= max)) {
                        return true;
                    }
                    return false;
                }
            );


            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input class="form-control" style="font-size: 10px;font-weight: bold;" type="text" placeholder="جست و جو بر اساس ' + title + '" />');
            });
            // DataTable

            var table = $('#example').DataTable(
                {
                    'responsive': true,
                    {{--'processing': true,--}}
                    {{--'serverSide':true,--}}
                    {{--'ajax' : "{{route('datatable_getdata')}}",--}}
                    {{--'columns' :[--}}
                        {{--{"data" : "shop_id"},--}}
                        {{--{"data" : "id"}--}}
                    {{--],--}}
                    dom: 'lfrtipB',
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-copy"></i> کپی',
                            titleAttr: 'copy'
                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i> اکسل',
                            titleAttr: 'Excel'
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i> PDF',
                            titleAttr: 'PDF',
                        }
                    ]

                }
            );
            console.log('aaa');
            table.buttons().container().appendTo($('#test'));
            $(".buttons-html5").removeClass("dt-button");

            document.getElementById("example_filter").innerHTML = "";
            // document.getElementById("example_info_").innerHTML = document.getElementById("example_info").innerHTML;
            // document.getElementById("example_info").innerHTML = "";

            $('#min, #max').keyup(function () {
                table.draw();
            });

            $('#min_date, #max_date').keyup(function () {
                table.draw();
            });

            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                        // document.getElementById("example_info_").innerHTML = document.getElementById("example_info").innerHTML;
                        // document.getElementById("example_info").innerHTML = "";

                    }
                });
            });
        });


    </script>


@endsection


