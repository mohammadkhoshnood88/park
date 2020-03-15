@extends('layout.main')
@section('title')
    مدیریت پیام های محیطی
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

@endsection
@section('subtitle')
    مدیریت پیام ها/ پیام های محیطی
@endsection
@section('content')

    @if(count($notifs) == 0)
        <p>هنوز بیکنی را ثبت نکرده اید. ابتدا از منوی <a href="{{route('beacon_create')}}"><strong>مدیریت بیکن
                    ها</strong></a>بیکن خود را ثبت کنید سپس مجددا وارد این قسمت شوید.</p>
    @else
        @foreach($notifs as $notif)
            @if($notif->status == 1)
                <div id="notif" class="col-md-3 profile_details">

                    <div class="well profile_view parent" style="width: 260px;">
                        <div class="col-md-12">
                            <h2>بیکن {{$notif->name}}</h2>
                            <div class="data">
                                <p><strong>طبقه
                                        بندی: </strong>{{$notif->group === 'انتخاب گزینه' ? 'انتخاب نکرده اید'  : $notif->group  }}
                                </p>
                                <div class="ln_solid"></div>
                                <p>
                                    <strong>موقعیت: </strong>{{$notif->location === 'انتخاب گزینه' ? 'انتخاب نکرده اید'  : $notif->location  }}
                                </p>
                            </div>
                            <div class="content" style="display: none;">
                                <p style="overflow: hidden;width: 230px;text-overflow: ellipsis;white-space: nowrap;"><strong>متن: </strong>{{$notif->txt}} </p>
                                <p style="overflow: hidden;width: 230px;text-overflow: ellipsis;white-space: nowrap;"><strong>URL :</strong>{{$notif->url}}</p>
                                <p style="overflow: hidden;width: 230px;text-overflow: ellipsis;white-space: nowrap;"><strong>آدرس عکس: </strong>{{$notif->pic}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 bottom text-center"
                             style="padding: 0px; @if($notif->type == 1) background:#5cd08d @endif">
                            <div class="col-xs-12 col-sm-6 emphasis">

                                {{--<input type="button" class="left btn btn-success btn-xs observe" value="مشاهده">--}}
                                <span class="left btn btn-success btn-xs observe">مشاهده</span>

                                <form action="{{route('notif_edit', ['beacon' => $notif->beacon_mac])}}" method="post"
                                      class="left">
                                    @csrf
                                    <input value="ویرایش" type="submit" class="btn btn-primary btn-xs">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

@endsection
@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script>
        $(function () {
            $('.observe').on('mouseenter', function () {
                let parent = $(this).closest('.parent');
                let content = parent.find('.content');
                let data = parent.find('.data');

                // data.css("display", "none");
                // content.css("display", "block");
                data.hide(180);
                content.show(180);

            });
            $('.observe').on('mouseout', function () {
                let parent = $(this).closest('.parent');
                let content = parent.find('.content');
                let data = parent.find('.data');

                // content.css("display", "none");
                // data.css("display", "block");
                content.hide(180);
                data.show(180);
            })

        })
    </script>
@endsection