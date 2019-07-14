@extends('layout.main')
@section('title')
    مدیریت پیام های عمومی
@endsection
@section('content')

    <form class="form-group row" method="post" action="{{route('message_set')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-4">
            <label class="col-md-4 col-sm-4 col-xs-12">متن پیام :

            </label>
            <div class="col-md-8 col-sm-4 col-xs-12">
                <textarea type="text" id="favorite" name="content"
                          class="form-control col-md-7 col-xs-12"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <label class="col-md-4 col-sm-4 col-xs-12">دسته بندی :

            </label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="favorite" class="form-control">

                    <option>انتخاب گزینه</option>
                    @foreach($favorites as $favorite)
                        <option>{{$favorite->favorite}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label class="col-md-4 col-sm-4 col-xs-12">تصویر :

            </label>
            <input class="col-md-8" type="file" name="file">

        </div>
        <button class="btn btn-primary"><span class="fa fa-plus"></span></button>

    </form>

    <div class="container">
        <div style="text-align: center;font-size: 15px;border-top:2.5px solid #e5e8ec;margin: 3px 0px 8px 0px "></div>
        @foreach($messages as $message)
            <div class="col-md-55">
    {{--{{asset($message->pic)}}--}}
                <div class="thumbnail">
                    <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{asset($message->pic)}}" alt="پیام عمومی"/>
                        <div class="mask no-caption">
                            <div class="tools tools-bottom">
                                <form action="{{ route('del_message', ['message' => $message->id])}}"
                                      method="post">
                                    {{csrf_field()}}
                                    {!! method_field('DELETE') !!}
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="caption">
                        <p><strong>{{$message->shop_name}}</strong>
                        </p>
                        <p>{{$message->content}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
