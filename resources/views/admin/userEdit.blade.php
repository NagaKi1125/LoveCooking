@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div class="container">
    <div><a class="btn btn-primary btn-sm" href="{{ route('admin.index') }}">Quay lại quản lí</a></div>
    <div class="text-center"><h3>Sửa thông tin người dùng</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('admin.user.update',[$user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Họ và tên') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                         name="name" value="{{ $user->name }}"  required autocomplete="name"
                         placeholder="Nhập tên đầy đủ" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-md-2 col-form-label text-md-right">{{ __('Biệt hiệu') }}</label>

                    <div class="col-md-10">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                         name="username" value="{{ $user->username }}"  required autocomplete="username"
                         placeholder="Nhập tên đầy đủ" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label class="col-md-2 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                        <select class="selectpicker" required data-live-search="true" id="gender" name="gender">
                            @if($user->gender == 0)
                                <option value="0" selected >Nam</option>
                                <option value="1">Nữ</option>
                            @else
                                <option value="0">Nam</option>
                                <option value="1" selected>Nữ</option>
                            @endif

                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md">
                        <label class="col-md-2 col-form-label text-md-right">{{ __('Quyền truy cập') }}</label>

                        <select class="selectpicker" required data-live-search="true" id="level" name="level">
                                @if($user->level == 1)
                                    <option value="1" selected>Adminstrator</option>
                                    <option value="2">Thành viên/Người dùng</option>
                                    <option value="0">Tài khoản bị vô hiệu</option>
                                @elseif($user->level == 2)
                                    <option value="1">Adminstrator</option>
                                    <option value="2" selected>Thành viên/Người dùng</option>
                                    <option value="0">Tài khoản bị vô hiệu</option>
                                @else
                                    <option value="1">Adminstrator</option>
                                    <option value="2">Thành viên/Người dùng</option>
                                    <option value="0" selected>Tài khoản bị vô hiệu</option>
                                @endif
                        </select>
                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>

                    <div class="col-md-10">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                         name="address" value="{{ $user->address }}"  required autocomplete="address"
                         placeholder="Nhập địa chỉ" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="birthday" class="col-md-2 col-form-label text-md-right">Birthday:</label>

                    <input type="date" id="birthday" name="birthday"
                        min="1960-01-01" max="2020-12-31" value="{{ $user->birthday }}">
                    @error('birthday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Cập nhật tài khoản
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
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
@section('body.script')
<script>
$('select').selectpicker();
</script>
    <script type="text/javascript">

    </script>
@endsection
