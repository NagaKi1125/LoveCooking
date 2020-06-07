@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">Menu ID</th>
                    <th scope="col">User's Name</th>
                    <th scope="col">Menu Date</th>
                    <th scope="col">Breakfast List</th>
                    <th scope="col">Lunch List</th>
                    <th scope="col">Dinner List</th>
                    <th scope="col">Last updated</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $me)
                        <tr>
                            <th scope="row">{{ $me->id }}</th>
                            <td>
                                @foreach($users as $us)
                                    @if($us->id == $me->user_id)
                                        {{ $us->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ carbon\carbon::parse($me->menu_date)->toDateString() }}</td>
                            @php
                                $breakfastList = explode("_",$me->breakfast_list);
                                $lunchList = explode("_",$me->lunch_list);
                                $dinnerList = explode("_",$me->dinner_list);
                            @endphp
                            <td>
                                @foreach($breakfastList as $brelist)
                                    @foreach($dish as $di)
                                        @if($brelist == $di->id)
                                        - {{ $di->dish_name }}<br>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @foreach($lunchList as $lunlist)
                                    @foreach($dish as $di)
                                        @if($lunlist == $di->id)
                                        - {{ $di->dish_name }}<br>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                @foreach($dinnerList as $lunlist)
                                    @foreach($dish as $di)
                                        @if($lunlist == $di->id)
                                        - {{ $di->dish_name }}<br>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ carbon\carbon::parse($me->updated_at)->toDateTimeString() }}</td>
                            <td>

                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="container">
        <div class="text-center">
            <h3 class="alert alert-danger" role="alert">Không đủ thẩm quyền</h3>
            <p>Bạn không đủ thẩm quyền truy cập trang web này<br>
                <a class="btn btn-sm btn-primary" href="{{ route('home') }}">Quay về trang chủ </a></p>
        </div>
    </div>
    @endif
@endif
@endsection
