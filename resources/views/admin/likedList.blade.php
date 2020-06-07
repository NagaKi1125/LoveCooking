@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<a class="btn btn-warning" href="{{ route('admin.index') }}">Quay lại quản lý user</a>
    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">LikedList ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Dish Liked List</th>
                    <th scope="col">Lần cuối cập nhập</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($userLikedList as $usliked)
                        <tr>
                            <th scope="row">{{ $usliked->id }}</th>
                            <td>{{ $usliked->name }}</td>
                            @php $list= explode('_',$usliked->dish_id_list) @endphp
                            <td>
                             @foreach($list as $list)
                                    @foreach($dish as $di)
                                        @if($di->id == $list)
                                        - {{ $di->dish_name }}<br>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ carbon\carbon::parse($usliked->updated_at)->toDateTimeString() }}</td>
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
