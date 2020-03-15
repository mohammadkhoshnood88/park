@extends('layout.main')
@section('title')
    ویرایش اطلاعات
@endsection

@section('header')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet"/>

@endsection
@section('subtitle')
    اطلاعات پایه/ طبقه بندی و موقعیت
@endsection
@section('content')

    <!-- /page content -->
    @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
        <div class="row container-fluid" style="margin: auto">
            <div class="form-group col-md-5">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">طبقه بندی :

                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="groups" name="groups"
                           class="form-control col-md-7 col-xs-12">
                </div>
                <button class="btn btn-primary group_send"><span class="fa fa-plus"></span></button>
                <p class="alert-success group-error"></p>
                <table id="grtable" class="table table-striped table-bordered">

                    <thead>
                    <tr>
                        <th style="text-align: center" colspan="2">طبقه بندی</th>
                    </tr>
                    </thead>
                    <tbody  id="new-group" style="padding: 10px;margin: 10px">

                    @foreach($all_groups as $group)
                        <tr>
                            <td style="text-align: center;width: 95%">{{$group}}</td>

                            <td style="width: 5%;background: red;color: white">
                                <a style="display: flex;justify-content: center;text-decoration: none; color: white;">
                                <i class="fa fa-remove" ></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>


            </div>

            <div class="form-group col-md-5">
                <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">موقعیت :

                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="locations" name="location"
                           class="form-control col-md-7 col-xs-12">
                </div>
                <button class="btn btn-primary location_send"><span class="fa fa-plus"></span></button>
                <p class="alert-success location-error"></p>

                <table id="loctable" class="table table-striped table-bordered">

                    <thead>
                    <tr>
                        <th style="text-align: center" colspan="2">موقعیت</th>
                    </tr>
                    </thead>
                    <tbody style="padding: 10px;margin: 10px;" id="new-location">
                    @foreach($all_locations as $location)
                        <tr>
                            <td style="text-align: center;width: 95%">{{$location}}</td>

                                <td style="width: 5%;background: red;color: white">
                                    <a style="display: flex;justify-content: center;text-decoration: none; color: white;">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>

                      </tr>
                    @endforeach
                    </tbody>

                </table>


            </div>

        </div>

    @elseif(\Illuminate\Support\Facades\Auth::user()->isadmin==0 && \Illuminate\Support\Facades\Auth::user()->isuser==1)

        <form class="form-group" method="post" action="{{route('inform_add_set')}}">
            {{csrf_field()}}

            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <label>طبقه بندی </label>
                <select style="width: 30%" class="js-example-basic-multiple" name="groups[]" multiple="multiple">
                    @foreach($all_groups as $group)
                        <option @if($all_user_groups != "")
                                @foreach($all_user_groups as $user_group)
                                @if($user_group == $group)
                                selected
                                @endif
                                @endforeach
                                @endif
                                value="{{$group}}">
                            {{$group}}</option>
                    @endforeach
                </select>
                <div class="ln_solid"></div>

            </div>


            <div class="col-md-12 col-sm-6 col-xs-12">
                <label>موقعیت</label>
                <select class="js-example-basic-multiple-a" style="width: 30%" name="locations[]" multiple="multiple">
                    @foreach($all_locations as $location)
                        <option @if($all_user_locations != "")
                                @foreach($all_user_locations as $user_location)
                                @if($user_location == $location)
                                selected
                                @endif
                                @endforeach
                                @endif
                                value="{{$location}}">
                            {{$location}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-12 col-sm-6 col-xs-12" style="margin:1%">
                <span>جهت ثبت اطلاعات ورودی، ذخیره اطلاعات را بزنید.</span>
                <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
            </div>

        </form>

    @endif
@endsection
@section('footer')
    <script src="{{asset('css/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-multiple").select2();
        });
        $(document).ready(function () {
            $(".js-example-basic-multiple-a").select2();
        });
    </script>

    <script>
        $(function () {
            $('.group_send').on('click', function (event) {
                event.preventDefault();
                $('.group-error').text("");



                let group = $('#groups').val();
                let url = "admin/set/group";
                let method = 'POST';
                let data = {'group': group, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        console.log(response.message);
                        $('#groups').val('');
                        $('.group-error').append(response.message);
                        if (response.success) {
                            $('#new-group').prepend(`<tr>
                        <td style="text-align: center">${response.group}</td>
                        <td style="width: 5%;background: red;color: white">
                                    <a style="display: flex;justify-content: center;text-decoration: none; color: white;">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                    </tr>`)
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
            $('.location_send').on('click', function (event) {
                event.preventDefault();
                $('.location-error').text("");

                let location = $('#locations').val();
                let url = "admin/set/location";
                let method = 'POST';
                let data = {'location': location, '_token': "{{csrf_token()}}"};

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        $('#locations').val('');
                        $('.location-error').append(response.message);
                        if (response.success) {
                            $('#new-location').prepend(`<tr>
                        <td style="text-align: center">${response.location}</td>
                        <td style="width: 5%;background: red;color: white">
                                    <a style="display: flex;justify-content: center;text-decoration: none; color: white;">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                    </tr>`)
                        }

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



