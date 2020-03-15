@extends('layout.main')

@section('title')
    گزارش ها
@endsection
@section('header')

    {{--    <script src="{{asset('css/vendors/jquery/src/ajax.js')}}"></script>--}}
    <style>
        .chart-div {
            border: 1px solid #E0F2BE;
            padding: 15px;
            margin: 6px;
            background: #F7F7F7;
        }

    </style>
@endsection
@section('subtitle')
    گزارش ها/ نمایش نمودار
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="chart-div">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="chart-div">
                <canvas id="linesChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="chart-div">
                <canvas id="piesChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{asset('css/vendors/Chart.js/dist/Chart.min.js')}}"></script>

    <script>
        var beacon_names = [];
        var beacon_counts = [];
        var beacon_counter = [];
        var beacon_create_date = [];
        var week_date = [];

        var random_color = [];
{{--        week_date.push("{{\Morilog\Jalali\Jalalian::forge($last_week_date)->format('%Y-%m-%d')}}");--}}
@forEach($last_week_date as $date)
week_date.push("{{$date}}");
        @endforeach


        @forEach($beacons as $beacon)
        beacon_names.push("بیکن " + "{{$beacon->name}}");
        beacon_counts.push("{{count($beacon->customers())}}");
        beacon_counter.push("{{$beacon->counter()}}");
        {{--beacon_create_date.push("{{\Morilog\Jalali\Jalalian::forge($beacon->created_at)->format('%Y-%m-%d')}}");--}}
        random_color.push("#"+"{{rand(000000,hexdec('FFFFF'))}}");
                @endforeach

        var bar = document.getElementById('barChart');
        new Chart(bar, {
            type: 'bar',
            data: {

                labels: beacon_names,
                datasets: [{
                    label: 'تعداد بازدید',
                    data: beacon_counts,
                    backgroundColor: random_color,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'تعداد بازدید منحصر به فرد از هر بیکن'
                }
            }

        });

        var pie = document.getElementById('piesChart');
        new Chart(document.getElementById("piesChart"), {
            type: 'pie',
            data: {
                labels: beacon_names,
                datasets: [{
                    backgroundColor: random_color,
                    data: beacon_counter,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'تعداد بازدید از هر بیکن'
                }
            }
        });

        lines_datasets = [];
        lines_datasets.push();
        {{--for (var i = 0; i < {{count($beacons)}} ; i++) {--}}
            {{--lines_datasets.push(--}}
                {{--{--}}
                    {{--data: [i,5, i, 1],--}}
                    {{--label: beacon_names[i],--}}
                    {{--borderColor: random_color[i],--}}
                    {{--fill: false--}}
                {{--}--}}
            {{--);--}}
        {{--}--}}
        var line = document.getElementById('linesChart');
        new Chart(line, {
            type: 'line',
            data: {
                labels: week_date,
                datasets: lines_datasets

            },
            options: {
                title: {
                    display: true,
                    text: 'بازدید از هر بیکن در یک هفته اخیر'
                }
            }
        });
    </script>

@endsection
