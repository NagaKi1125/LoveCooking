@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div style="text-center"><a class="btn btn-primary" href="{{ route('admin.dish.add') }}">Thêm món mới</a></div>
<div class="table-responsive-sm">
    <table class="user table table-borderless table-hover table-dark table-striped table-center">
        <thead>
            <tr>
                <th scope="col">ID Món ăn</th>
                <th scope="col">Tên món</th>
                <th scpoe="col">Loại món ăn</th>
                <th scope="col">Avatar</th>
                <th scope="col">Công dụng</th>
                <th scope="col">Nguyên liệu</th>
                <th scope="col">Các bước làm kèm hình ảnh</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Cập nhập lần cuối</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            @foreach($dish as $dish)

                <tr>
                    <th scope="row">{{ $dish->id }}</th>
                    <td>{{ $dish->dish_name }}</td>
                    @php $category = explode("_",$dish->cate_id) @endphp
                    <td>
                        @foreach($category as $ca)
                            @foreach($cate as $c)
                                @if($ca == $c->id)
                                   - {{ $c->category }}<br>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td><img src="{{ asset($dish->avatar) }}" width="20%"></td>
                    <td>{{ $dish->use }}</td>
                    @php $n = explode(PHP_EOL,$dish->material) @endphp
                    <td>
                        @foreach($n as $n)
                            {{ $n }}<br>
                        @endforeach
                    </td>
                    @php $step = explode("_",$dish->steps) @endphp
                    <td>
                        @foreach($step as $st)
                            @if($st != null)
                                <u>Bước {{ $loop->index+1 }}:</u> {{ $st }}<br>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $dish->author }}</td>
                    <td>{{ Carbon\Carbon::parse($dish->updated_at)->format('d-m-Y H:i:s') }}</td>
                    <td>

                        <form action="{{ route('admin.dish.delete',[$dish->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.dish.edit',[$dish->id]) }}"><ion-icon name="create"></ion-icon></a>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <ion-icon name="trash"></ion-icon>
                            </button>
                        </form>
                    </td>
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
