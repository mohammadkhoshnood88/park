@extends('layout.main')
@section('title')
    صفحه اول
@endsection
@section('header')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>

@endsection
@section('content')
    <div style="text-align: center;width: 100%;border-radius: 3px"
       class="alert-error alert-pass">{{\Illuminate\Support\Facades\Session::get('error')}}</div>
    @if(count($profile)==0)
        <div class="alert-danger" style="padding-right: 3px"><strong class="text-dark">پروفایل خود را کامل
                کنید.</strong> برای این منظور به قسمت <a href="{{route('profile_create')}}" style="color: white">حساب
                کاربری</a> از فهرست سمت راست بروید.
        </div>
    @endif



    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
        {{--<form class="formajax" action="{{route('ajaxtest')}}" method="post">--}}
        {{--{{csrf_field()}}--}}
        {{--<input class="aaa" name="name">--}}
        {{--<input name="num1">--}}
        {{--<input name="num2">--}}
        {{--<div class="responseajax" id="responseajax"></div>--}}
        {{--</form>--}}
        {{--<button type="button" id="setajax" class="btn setajax">set</button>--}}
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> تعداد کاربران سامانه</span>
                <div class="count">{{$user_admin}}</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن های ثبت شده در سامانه</span>
                <div class="count">{{$beacon_admin}}</div>
            </div>
        </div>

        <div class="row">
            <div class="x_panel" style="border: none;padding-right: 4px;padding-left: 4px">
                <div class="x_title">
                    <div class="clearfix " style="text-align: center;font-size: 15px">
                        مدیریت کاربران
                    </div>
                </div>
                <div class="x_content">
                    <br/>
                    <div class="table-responsive col-md-6 col-sm-12 col-xs-12">
                        <br>
                        <table class="table table-striped bulk_action" style="width: 500px;margin-top: 7px">
                            <thead style="background: #E6E9ED ;color: #73879C;vertical-align: center">

                            <th style="vertical-align: center" class="column-title">نام</th>
                            <th style="vertical-align: center" class="column-title">شماره موبایل</th>
                            <th style="vertical-align: center">ابزار</th>
                            </thead>
                            <tbody class="verify_table" style="vertical-align: center">
                            @foreach($user_not_register as $unr)
                                <tr style="vertical-align: center" class="verify-parent">
                                    <td hidden class="user-id">{{$unr->id}}</td>
                                    <td class="user-name" style="vertical-align: middle;">{{$unr->name}}</td>
                                    <td class="user-mobile" style="vertical-align: middle">{{$unr->mobile}}</td>
                                    <td style="vertical-align: middle">
                                        <label>
                                            <select class="verify">
                                                <option value="1" @if($unr->isuser == 1) selected @endif>فعال</option>
                                                <option value="0" @if($unr->isuser == 0) selected @endif>غیر فعال
                                                </option>
                                            </select>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $user_not_register->links() }}
                    </div>
                    <div class="col-md-6">

                        <p style="text-align: center;font-weight: bold;">نظرات کاربران</p>
                        @foreach($admin_comments as $comment)
                            <div class="comment-parent"
                                 style="background: {{$comment->answer_status === 1 ? "#F7F7F7" : "lightblue"}} ;padding: 8px;border: 1px solid #E6E9ED;margin: 2px">
                                <div class="row">

                                    <p class="col-md-11"
                                       style="padding-right: 4px;text-align: right;vertical-align: middle;">
                                        <span style="font-weight: bold;">{{$comment->user_name()}} : </span>
                                        {{$comment->comment}}</p>
                                    <span class="col-md-1 comment-reply fa fa-reply"></span>
                                </div>
                                <div class="comment-child" style="display: none">
                                    <div class="row"
                                         style="background: #e6e9ed;width: 80%;margin-right: 15px;border-radius: 2px">
                                        <input class="comment_id" hidden value="{{$comment->id}}">
                                        @csrf
                                        <input {{$comment->answer_status === 1 ? "readonly" : ""}} type="text"
                                               class="answer_text"
                                               placeholder="{{$comment->answer_status === 1 ? $comment->answer : "پاسخ دهید..."}}"
                                               style=";border:none;background: none;padding: 4px;width: inherit">
                                        <button {{$comment->answer_status === 1 ? "disabled" : ""}} id="answer-send"
                                                class="btn fa fa-send answer-send"
                                                style="background: none;float: left"></button>
                                    </div>
                                    {{--</form>--}}
                                </div>
                            </div>
                        @endforeach

                        <div>
                            <p style="text-align: center;font-weight: bold;margin-top: 7px">ارسال پیام عمومی</p>
                            <div class="row admin-comment-send-parent"
                                 style="background: #e6e9ed;width: 90%;margin-right: 15px;border-radius: 2px">
                                <input type="text" class="admin-comment-send-text" placeholder="پیام خود را بنویسید"
                                       style="width: inherit;border:none;background: none;padding: 8px">
                                <button class="btn fa fa-send admin-comment-send-button"
                                        style="background: none;float: left;padding: 8px"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(\Illuminate\Support\Facades\Auth::user()->isadmin==0 && \Illuminate\Support\Facades\Auth::user()->isuser==1)
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-shopping-cart"></i> تعداد بازدید فروشگاه</span>
                <div class="count">{{$visit_shop}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> تعداد بازدید منحصر به فرد</span>
                <div class="count">{{$unicount}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-bullseye"></i> تعداد بیکن ها</span>
                <div class="count">{{$beacon_shop}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-tasks"></i> تعداد بازی ها</span>
                <div class="count">{{$race_shop}}</div>
            </div>
        </div>


        <div class="row">
            <div class="x_panel" style="border: none;padding-right: 4px;padding-left: 4px">
                <div class="x_title">
                    <div class="clearfix " style="text-align: center;font-size: 15px">
                        تالار گفتگو
                    </div>
                </div>
                <div class="x_content">
                    <br/>
                    <div class="col-md-6">
                        <div>
                            <p style="text-align: center;font-weight: bold;margin-top: 7px">ارسال پیام به مدیریت</p>
                            <div class="comment-parent-user"
                                 style="background: #e6e9ed;width: 90%;margin-right: 15px;border-radius: 2px">
                                <input type="text" class="comment_text" placeholder="پیام خود را بنویسید"
                                       style=";border:none;background: none;padding: 8px;width: inherit">
                                <button class="btn fa fa-mail-forward comment-send"
                                        style="background: none;float: left;padding: 8px"></button>
                            </div>
                        </div>
                        @if(count($admin_send_comment)>0)
                            <div style="margin: 10px">
                                <p class="alert-success" style="text-align: center;font-weight: bold;margin-top: 7px">
                                    از طرف مدیریت {{count($admin_send_comment)}} پیام عمومی برای شما ارسال شده است.</p>
                                @foreach($admin_send_comment as $comment)
                                    <div style="background: #F7F7F7;padding: 8px;border: 1px solid #E6E9ED;margin: 2px">

                                        <p>{{$comment->comment}} در تاریخ {{\Morilog\Jalali\ Jalalian::forge($comment->created_at)
                                ->format('%A, %d %B %y')}}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p style="text-align: center;font-weight: bold">پیام های شما</p>
                        <div id="comment_show"></div>
                        @foreach($user_comments as $comment)
                            <div style="background: #F7F7F7;padding: 8px;border: 1px solid #E6E9ED;margin: 2px">
                                <div class="row">

                                    <p class="col-md-9">- {{$comment->comment}}</p>
                                    <p class="col-md-9"><span
                                                style="font-weight: bold;">پاسخ مدیر :</span>{{$comment->answer}}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>


    @endif

@endsection
@section('footer')
    {{--    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>--}}
    <script>
        $(function () {
            $('.comment-reply').on('click', function () {
                let parent = $(this).closest('.comment-parent');
                let content = parent.find('.comment-child');
                $(content).slideToggle("slow");
            });
        });

        $(function () {
            $('.answer-send').on('click', function (event) {
                event.preventDefault();
                let parent = $(this).closest('.comment-child');
                let button = $(this).closest('.answer-send');
                let parent_color = $(this).closest('.comment-parent');
                let content = parent.find(".answer_text");
                let id = parent.find(".comment_id").val();
                let answer = content.val();

                let url = "/answer/send";
                let method = 'POST';
                let data = {'answer': answer, 'id': id, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        alert(response.message);
                        content.val('');
                        if (response.success) {
                            content.attr('readOnly', 'readonly');
                            button.attr('disabled', 'disabled');
                            content.val(response.answer);
                            console.log(parent_color[0]);
                            parent_color[0].style.background = "#F7F7F7";
                        }
                        else {
                            parent_color[0].style.background = "lightblue";

                        }
                    },
                    error: function (xhr) {
                        alert('ارتباط با سرور قطع شده است.');
                        console.log(xhr)
                    }

                });
            });
        });

        $(function () {
            $('.comment-send').on('click', function (event) {
                event.preventDefault();
                let parent = $(this).closest('.comment-parent-user');
                let content = parent.find(".comment_text");
                let comment = content.val();

                let url = "/comment/send";
                let method = 'POST';
                let data = {'comment': comment, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        content.val('');
                        alert(response.message);
                        if (response.success) {
                            $('#comment_show').prepend(`
                                <div style="background: #F7F7F7;padding: 8px;border: 1px solid #E6E9ED;margin: 2px">
                                <div class="row">

                                    <p class="col-md-9">- ${response.comment}</p>
                                    <p class="col-md-9"><span style="font-weight: bold;">پاسخ مدیر :</span></p>
                                </div>

                            </div>
                            `)
                        }

                    },
                    error: function (xhr) {
                        alert('ارتباط با سرور قطع شده است.');
                        console.log(xhr)
                    }

                });
            });
        });
        $(function () {
            $('.verify').on('change', function (event) {
                event.preventDefault();
                let parent = $(this).closest('.verify-parent');

                let content = parent.find(".user-name");
                let name = content.text();

                let contentt = parent.find(".user-mobile");
                let mobile = contentt.text();

                let contenttt = parent.find(".user-id");
                let id = contenttt.text();
                console.log(contenttt);

                let url = "/user/verify";
                let method = 'POST';
                let data = {'id': id, 'mobile': mobile, '_token': "{{csrf_token()}}"};
                console.log(data);

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        console.log(response);

                        if (response.success) {
                            if (response.message == 0) {
                                alert(`وضعیت ${name} با موفقیت به حالت فعال تغییر کرد.`);
                            }
                            else if (response.message == 1) {
                                alert(`وضعیت ${name} با موفقیت به حالت غیرفعال تغییر کرد.`);
                            }

                        }

                    },
                    error: function (xhr) {
                        alert('ارتباط با سرور قطع شده است.');
                        console.log(xhr)
                    }

                });
            });
        });

        $(function () {
            $('.admin-comment-send-button').on('click', function (event) {
                event.preventDefault();
                let parent = $(this).closest('.admin-comment-send-parent');
                let content = parent.find(".admin-comment-send-text");
                let comment = content.val();

                let url = "/admin/comment/send";
                let method = 'POST';
                let data = {'comment': comment, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        content.val('');
                        alert(response.message);

                    },
                    error: function (xhr) {
                        alert('ارتباط با سرور قطع شده است.');
                        console.log(xhr)
                    }

                });
            });
        });

    </script>
@endsection
