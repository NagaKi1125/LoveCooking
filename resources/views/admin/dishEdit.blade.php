@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div class="container">
    <div class="text-center"><h3>Chỉnh sửa món ăn</h3></div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" action="{{ route('admin.dish.update',[$dish->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="dish_name" class="col-md-2 col-form-label text-md-right">{{ __('Tên món ăn') }}</label>

                    <div class="col-md-10">
                        <input id="dish_name" type="text" class="form-control @error('dish_name') is-invalid @enderror"
                         name="dish_name" value="{{ $dish->dish_name }}"  required autocomplete="dish_name"
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
                         name="avatar" autofocus onchange="readURL(this)">
                        <img class="img-thumbnail" src="{{ asset($dish->avatar) }}" id="imagePreview" width="50%">

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
                         name="description" required autocomplete="description"
                         placeholder="Nhập mô tả " autofocus>{{ $dish->description }}</textarea>

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
                         name="use" value="{{ $dish->use }}"  required autocomplete="use"
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
                            <label>Nguyên liệu</label>
                            <textarea rows="10" id="material" type="text" class="form-control @error('material') is-invalid @enderror"
                                name="material" required   autocomplete="material"
                                placeholder="Nhập nguyên liệu cần dùng
Nguyên liệu 1: bao nhiêu ?
Nguyên liệu 2: bao nhiêu ?
" autofocus>{{ $dish->material }}</textarea>

                            @error('material')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label>{{ __('Loại món') }}</label>
                            <select multiple="multiple" id="category"  name="category[]" class="selectpicker" required data-live-search="true">
                                @php $dishcate = explode('_',$dish->cate_id);  $caid=1;@endphp
                                @foreach ($cate as $cate)
                                    @foreach($dishcate as $dica)
                                        @if($dica == $cate->id)
                                            <option value="{{ $cate->id }}" selected >{{ $cate->category }}</option>
                                            @php $caid=$cate->id; $catename=$cate->category; @endphp
                                        @endif
                                    @endforeach
                                    @if($cate->id != $caid )
                                        <option value="{{ $cate->id }}">{{ $cate->category }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label>Các bước làm (Tối thiểu là 3 bước)</label>
                        @php $steps = explode('_',$dish->steps); $step_imgs = explode('_',$dish->step_imgs); $add =0;@endphp
                        @for($i=1;$i<11;$i++)
                            @if($i<=2)
                                <div>
                                    <label>Bước {{ $i }}:</label>
                                    <input id="steps_{{ $i }}" type="text" accept="image/*" class="form-control" name="steps[]" required autocomplete="steps"
                                        placeholder="Bước {{ $i }}" value="{{ $steps[$add] }}" autofocus>
                                    <input id="step_imgs_{{ $i }}" type="file" accept="image/*"
                                        name="step_imgs_{{ $i }}" autofocus onchange="readURLSteps_{{ $i }}(this)">
                                    <img class="img-thumbnail" src="{{ asset($step_imgs[$add]) }}" id="imagePreview-steps_{{ $i }}" width="20%"></div>
                            @else
                                <div>
                                    <label>Bước {{ $i }}:</label>
                                    <input id="steps_{{ $i }}" type="text" accept="image/*" class="form-control" name="steps[]" autocomplete="steps"
                                        placeholder="Bước {{ $i }}" value="{{ $steps[$add] }}" autofocus>
                                    <input id="step_imgs_{{ $i }}" type="file" accept="image/*"
                                        name="step_imgs_{{ $i }}" autofocus onchange="readURLSteps_{{ $i }}(this)">
                                    <img class="img-thumbnail" src="{{ asset($step_imgs[$add]) }}" id="imagePreview-steps_{{ $i }}" width="20%">
                                </div>
                            @endif
                            @php $add+=1; @endphp
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
