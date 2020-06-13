@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)

    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Quyền truy cập</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ngày tham gia</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $us)

                        @if($us->level ==0) <tr class="table-dark"> @else <tr> @endif

                            <th scope="row">{{ $us->id }}</th>
                            <td>{{ $us->name }}</td>
                            <td>{{ $us->username }}</td>
                            <td>{{ $us->email }}</td>
                            <td>
                                @if($us->level==1) <span class=""> Adminstrator
                                @elseif($us->level==2)<span class=""> Thành viên/Người dùng
                                @else <span class="">Tài khoản bị vô hiệu
                                @endif </span>
                            </td>
                            <td>
                                @if($us->gender == 1)  Nữ  @else Nam  @endif
                            </td>
                            <td>{{ $us->birthday }}</td>
                            <td>{{ $us->address }}</td>
                            <td>{{ carbon\carbon::parse($us->created_at)->toDateString() }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.user.follow',$us->id) }}">Danh sách theo dõi</a>
                                <a class="btn btn-primary" href="{{ route('admin.user.liked',$us->id) }}">Danh sách món ăn yêu thích</a>
                            </td>
                            @if ( $us->level != 1)
                            <td>
                                <form action="{{ route('admin.user.delete',[$us->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-warning" href="{{ route('admin.user.edit',[$us->id]) }}"><ion-icon name="create"></ion-icon></a>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <ion-icon name="trash"></ion-icon>
                                    </button>
                                </form>
                            </td>
                            @else <td>Adminstrator</td>
                            @endif

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
