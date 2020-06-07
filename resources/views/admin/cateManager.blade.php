@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)

    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">Categories ID</th>
                    <th scope="col">Loại danh mục</th>
                    <th scope="col">Lần cuối cập nhập</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cate as $cate)
                    <tr>
                        <th scope="row">{{ $cate->id }}</th>
                        <td>{{ $cate->category }}</td>
                        <td>{{ Carbon\Carbon::parse($cate->updated_at)->format('d-m-Y H:i:s') }}</td>
                        <td>

                            <form action="{{ route('admin.categories.delete',[$cate->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.categories.edit',[$cate->id]) }}"><ion-icon name="create"></ion-icon></a>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <ion-icon name="trash"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row"><a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1"
                    role="button" aria-expanded="false" aria-controls="multiCollapseExample"><ion-icon name="add-circle-outline"></ion-icon>Thêm danh mục mới</a></th>
                </tr>
                <tr class="collapse multi-collapse" id="multiCollapseExample1">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <th scope="row" colspan="2">
                            <input id="category" class="form-control @error('category') is-invalid @enderror"
                            name="category" value="{{ old('category') }}" required autocomplete="category"
                            placeholder="Nhập tên danh mục" autofocus>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </th>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <ion-icon name="add-circle-outline"></ion-icon>{{ __('Thêm') }}
                            </button>
                        </td>
                    </form>
                </tr>
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
