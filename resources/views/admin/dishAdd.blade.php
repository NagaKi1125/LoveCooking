@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div class="container">
    <div class="text-center"><h3>Thêm một món mới</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('admin.dish.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="dish_name" class="col-md-2 col-form-label text-md-right">{{ __('Tên món ăn') }}</label>

                    <div class="col-md-10">
                        <input id="dish_name" type="text" class="form-control @error('dish_name') is-invalid @enderror"
                         name="dish_name" value="{{ old('dish_name') }}" required autocomplete="dish_name"
                         placeholder="Nhập tên món ăn" autofocus>

                        @error('dish_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="avatar" class="col-md-2 col-form-label text-md-right">{{ __('Chọn ảnh đại diện') }}</label>

                    <div class="col-md-10">
                        <input id="avatar" type="file"  class=" @error('avatar') is-invalid @enderror"
                         name="avatar" required autofocus onchange="readURL(this)">
                        <img class="img-thumbnail" src="" id="imagePreview" width="50%">

                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Mô tả món ăn') }}</label>

                    <div class="col-md-10">
                        <textarea rows="4" id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                         name="description" value="{{ old('description') }}" required autocomplete="description"
                         placeholder="Nhập mô tả " autofocus></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="use" class="col-md-2 col-form-label text-md-right">{{ __('Công dụng') }}</label>

                    <div class="col-md-10">
                        <input id="use" type="text" class="form-control @error('use') is-invalid @enderror"
                         name="use" value="{{ old('use') }}" required autocomplete="use"
                         placeholder="Nhập công dụng" autofocus>

                        @error('use')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group row">
                            <label>Nguên liệu</label>
                            <textarea rows="10" id="material" type="text" class="form-control @error('material') is-invalid @enderror"
                                name="material" value="{{ old('material') }}" required autocomplete="material"
                                placeholder="Nhập nguyên liệu cần dùng
Nguyên liệu 1: bao nhiêu ?
Nguyên liệu 2: bao nhiêu ?
" autofocus></textarea>

                            @error('material')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label>{{ __('Loại món') }}</label>
                            <select multiple="multiple" id="category"  name="category[]" class="selectpicker" data-live-search="true">
                                @foreach ($cate as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label>Các bước làm (Tối thiểu là 3 bước)</label>
                        @for($i=1;$i<11;$i++)
                            @if($i<=3)
                                <div>
                                    <label>Bước {{ $i }}:</label>
                                    <input id="steps_{{ $i }}" type="text" accept="image/*" class="form-control" name="steps[]" required autocomplete="steps"
                                    placeholder="Bước {{ $i }}" autofocus>
                                    <input id="step_imgs_{{ $i }}" type="file" accept="image/*"
                                    name="step_imgs_{{ $i }}" autofocus onchange="readURLSteps_{{ $i }}(this)">
                                    <img class="img-thumbnail" src="" id="imagePreview-steps_{{ $i }}" width="20%"></div>
                            @else
                                <div>
                                    <label>Bước {{ $i }}:</label>
                                    <input id="steps_{{ $i }}" type="text" accept="image/*" class="form-control" name="steps[]" autocomplete="steps"
                                    placeholder="Bước {{ $i }}" autofocus>
                                    <input id="step_imgs_{{ $i }}" type="file" accept="image/*"
                                    name="step_imgs_{{ $i }}" autofocus onchange="readURLSteps_{{ $i }}(this)">
                                    <img class="img-thumbnail" src="" id="imagePreview-steps_{{ $i }}" width="20%">
                                </div>
                            @endif
                        @endfor

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
<script type="text/javascript">
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        /// read steps
    function readURLSteps_1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_1')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_2')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_3')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_4')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_5')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_6(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_6')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_7(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_7')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_8(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_8')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
     function readURLSteps_9(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_9')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSteps_10(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview-steps_10')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
//read Steps
</script>
    <script>
    $('select').selectpicker();
    </script>
    <script type="text/javascript">

    </script>
@endsection
