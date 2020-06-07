@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div><a class="btn btn-primary" href="{{ route('admin.market.index') }}">Quay lại trang chợ</a></div>
<br>
<div class="container">
<form class ="marketform" method="POST" action="{{ route('admin.market.update',[$mark->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-6">
            <input id="material_type" type="text" class="form-control @error('material_type') is-invalid @enderror" name="material_type"
             value="{{ $mark->material_type }}" required autocomplete="material_type" placeholder="Loại nguyên liệu" autofocus>

            @error('material_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place"
             value="{{ $mark->place }}" required autocomplete="place" placeholder="Địa điểm bán" autofocus>

            @error('place')
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

    // java script here =))))
</script>
@endsection
