@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div><a class="btn btn-primary" href="{{ route('admin.categories.index') }}">Quay lại trang danh mục</a></div>
<form method="POST" action="{{ route('admin.categories.update',[$cate->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

        <div class="col-md-6">
            <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category"
             value="{{ $cate->category }}" required autocomplete="category" autofocus>

            @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </div>
</form>
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
