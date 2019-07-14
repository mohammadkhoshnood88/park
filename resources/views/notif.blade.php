@extends('layout.main')
@section('title')
    مدیریت پیام های محیطی
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$("#observe").hover(function () {--}}
                {{--$("#data").slideToggle("slow");--}}
                {{--forEach ($("#content") as $("#conten"))--}}
                {{--$("#conten").slideToggle("slow");--}}

            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection
@section('content')


    {{--<div class="table-responsive">--}}
    {{--<table class="table table-striped jambo_table bulk_action">--}}
    {{--<thead>--}}
    {{--<tr style="text-align: center" class="headings">--}}

    {{--<th class="column-title" style="text-align: center">کد بیکن</th>--}}
    {{--<th class="column-title" style="text-align: center">uuid</th>--}}
    {{--<th class="column-title" style="text-align: center">فاصله</th>--}}
    {{--<th style="text-align: center" class="column-title">متن پیام</th>--}}
    {{--<th class="column-title" style="text-align: center">URL</th>--}}
    {{--<th class="column-title" style="text-align: center">تصویر</th>--}}
    {{--<th style="text-align: center" class="column-title">ویدئو</th>--}}

    {{--</tr>--}}
    {{--</thead>--}}
    {{--@foreach($notifs as $notif)--}}
    {{--<tbody>--}}
    {{--<tr class="even pointer">--}}

    {{--<td class=" ">{{$notif->neme}}</td>--}}
    {{--<td class=" ">{{$notif->uuid}}</td>--}}
    {{--<td class=" ">{{$notif->uuid}}</td>--}}


    {{--<td class=" ">--}}
    {{--<input type="text" class="form-control" readonly="readonly"--}}
    {{--placeholder="{{$notif->txt === "" ? "تعیین نشده است" : $notif->txt}}">--}}
    {{--</td>--}}

    {{--<td class=" "><input type="text" class="form-control" readonly="readonly"--}}
    {{--placeholder="{{$notif->url === "" ? "تعیین نشده است" : $notif->url}}">--}}
    {{--</td>--}}
    {{--<td class=" "><input type="text" class="form-control" readonly="readonly"--}}
    {{--placeholder="{{$notif->pic === "" ? "تعیین نشده است" : $notif->pic}}">--}}
    {{--</td>--}}
    {{--<td class=" "><input type="text" class="form-control" readonly="readonly"--}}
    {{--placeholder="{{$notif->vid === "" ? "تعیین نشده است" : $notif->vid}}">--}}
    {{--</td>--}}
    {{--<td class=" "><form action="/api/notif/{{{$notif->uuid}}}/edit" method="post">--}}
    {{--{{csrf_field()}}--}}
    {{--<input value="ویرایش" type="submit" class="btn btn-primary">--}}
    {{--</form></td>--}}

    {{--</tr>--}}
    {{--</tbody>--}}
    {{--@endforeach--}}

    {{--</table>--}}
    {{--</div>--}}



{{--{{$notifs}}--}}

    {{--///////// t e s t ////////////--}}
    @if(count($notifs) == 0)
    <p>هنوز بیکنی را ثبت نکرده اید. ابتدا از منوی <a href="{{route('beacon_create')}}"><strong>مدیریت بیکن ها</strong></a>بیکن خود را ثبت کنید سپس مجددا وارد این قسمت شوید.</p>
    @else
    @foreach($notifs as $notif)

        <div id="notif" class="col-md-3 col-sm-4 col-xs-12 profile_details">

            <div class="well profile_view parent">
                <div class="col-sm-12">
                    <h2>بیکن {{$notif->name}}</h2>
                    <div class="data">
                        <p><strong>طبقه بندی: </strong>{{$notif->group === 'انتخاب گزینه' ? 'انتخاب نکرده اید'  : $notif->group  }}</p>
                        <p><strong>موقعیت: </strong>{{$notif->location === 'انتخاب گزینه' ? 'انتخاب نکرده اید'  : $notif->location  }}</p>
                    </div>
                    <div class="content" style="display: none;">
                        <p><strong>متن: </strong>{{$notif->txt}} </p>
                        <p><strong>URL :</strong>{{$notif->url}}</p>
                        <p><strong>آدرس عکس: </strong>{{$notif->pic}}</p>
                    </div>
                </div>
                <div class="col-xs-12 bottom text-center" style="padding: 0px;">
                    <div class="col-xs-12 col-sm-6 emphasis">

                        {{--<input type="button" id="observe" class="left btn btn-success btn-xs observe" value="مشاهده">--}}
                        <span class="left btn btn-success btn-xs observe">مشاهده</span>

                        <form action="/pacespace/api/notif/{{{$notif->beacon_mac}}}/edit" method="post" class="left">
                            {{csrf_field()}}
                            <input value="ویرایش" type="submit" class="btn btn-primary btn-xs">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endif

@endsection
@section('footer')
    <script>
        $(function () {
            $('.observe').on('mouseenter', function () {
                let parent = $(this).closest('.parent');
                let content = parent.find('.content');
                let data = parent.find('.data');

                content.show(180);
                data.hide(180);
            })
            $('.observe').on('mouseout', function () {
                let parent = $(this).closest('.parent');
                let content = parent.find('.content');
                let data = parent.find('.data');

                content.hide(180);
                data.show(180);
            })


        })
    </script>
    {{--<style>--}}
        {{--#content{--}}
            {{--display: none;--}}
        {{--}--}}
        {{--#notif :hover{--}}
            {{--background: #f1f4f6;--}}
        {{--}--}}
    {{--</style>--}}
@endsection