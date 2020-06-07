@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<a class="btn btn-warning" href="{{ route('admin.index') }}">Quay lại quản lý user</a>
    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">Follow ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Follow List</th>
                    <th scope="col">Lần cuối cập nhập</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($userFollowList as $usfollow)
                        <tr>
                            <th scope="row">{{ $usfollow->id }}</th>
                            <td>{{ $usfollow->name }}</td>
                            @php $list= explode('_',$usfollow->follow_id_list) @endphp
                            <td>
                                @foreach($list as $list)
                                    @foreach($users as $us)
                                        @if($list == $us->id)
                                        - {{ $us->name }}<br>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ carbon\carbon::parse($us->created_at)->toDateTimeString() }}</td>
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
