@extends('layout.main')
@section('title')
    مدیریت اعلانات
@endsection
@section('content')


                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr style="text-align: center" class="headings">

                            <th class="column-title" style="text-align: center">کد بیکن</th>
                            <th class="column-title" style="text-align: center">uuid</th>
                            <th class="column-title" style="text-align: center">فاصله</th>
                            <th style="text-align: center" class="column-title">متن پیام</th>
                            <th class="column-title" style="text-align: center">URL</th>
                            <th class="column-title" style="text-align: center">تصویر</th>
                            <th style="text-align: center" class="column-title">ویدئو</th>

                        </tr>
                        </thead>
                        @foreach($notifs as $notif)
                            <tbody>
                            <tr class="even pointer">

                                <td class=" ">{{$notif->neme}}</td>
                                <td class=" ">{{$notif->uuid}}</td>
                                <td class=" ">{{$notif->uuid}}</td>


                                <td class=" ">
                                    <input type="text" class="form-control" readonly="readonly"
                                           placeholder="{{$notif->txt === "" ? "تعیین نشده است" : $notif->txt}}">
                                </td>

                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->url === "" ? "تعیین نشده است" : $notif->url}}">
                                </td>
                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->pic === "" ? "تعیین نشده است" : $notif->pic}}">
                                </td>
                                <td class=" "><input type="text" class="form-control" readonly="readonly"
                                                     placeholder="{{$notif->vid === "" ? "تعیین نشده است" : $notif->vid}}">
                                </td>
                                <td class=" "><form action="/api/notif/{{{$notif->uuid}}}/edit" method="post">
                                        {{csrf_field()}}
                                        <input value="ویرایش" type="submit" class="btn btn-primary">
                                    </form></td>

                            </tr>
                            </tbody>
                        @endforeach

                    </table>
                </div>

@endsection
