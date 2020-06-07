@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div class="container">
    <div class="text-center"><h3>Thêm lịch sử món ăn</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('admin.history.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="dh_posts" class="col-md-2 col-form-label text-md-right">{{ __('Mô tả món ăn') }}</label>

                    <div class="col-md-10">
                        <textarea rows="4" id="dh_posts" type="text" class="form-control @error('dh_posts') is-invalid @enderror"
                         name="dh_posts" value="{{ old('dh_posts') }}" required autocomplete="dh_posts"
                         placeholder="Nhập mô tả " autofocus></textarea>

                        @error('dh_posts')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row">
                        <label>{{ __('Loại món') }}</label>
                        <select id="dish_id"  name="dish_id" class="selectpicker" data-live-search="true">
                            @foreach ($dish as $di)
                            <option value="{{ $di->id }}">{{ $di->dish_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Add new dish
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
