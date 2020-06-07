@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)

    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">Market ID</th>
                    <th scope="col">Loại thực phẩm</th>
                    <th scpoe="col">Danh sách nơi bán</th>
                    <th scope="col">Lần cuối cập nhập</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($mark as $mark)
                    <tr>
                        <th scope="row">{{ $mark->id }}</th>
                        <td>{{ $mark->material_type }}</td>
                        @php  $place = explode("_",$mark->place); @endphp
                        <td>
                            @foreach($place as $p)
                                {{ $p }}<br>
                            @endforeach
                        </td>
                        <td>{{ Carbon\Carbon::parse($mark->updated_at)->format('d-m-Y H:i:s') }}</td>
                        <td>

                            <form action="{{ route('admin.market.delete',[$mark->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.market.edit',[$mark->id]) }}"><ion-icon name="create"></ion-icon></a>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <ion-icon name="trash"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row">
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapse"
                        role="button" aria-expanded="false" aria-controls="multiCollapseExample">
                        <ion-icon name="add-circle-outline"></ion-icon>Thêm nơi bán mới</a>
                    </th>
                </tr>
                <tr class="collapse multi-collapse" id="collapse">
                    <form method="POST" action="{{ route('admin.market.store') }}">
                        @csrf
                        <th scope="row" colspan="2">
                            <input id="material_type" class="form-control"
                            name="material_type" value="{{ old('material_type') }}" required autocomplete="material_type"
                            placeholder="Nhập loại nguyên liệu" autofocus>
                        </th>
                        <th scope="row" colspan="2">
                            <input id="place_0" class="form-control"
                            name="place" value="{{ old('place') }}" required autocomplete="place"
                            placeholder="Nhập nơi mua 'Nơi mua 1_Nơi mua 2_..._Nơi mua n'" autofocus>
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
@section('body.script')
<script>
    $('.add').on('click', add);
    $('.remove').on('click', remove);

    function add() {
        var new_place = parseInt($('#total_chq').val()) + 1;
        var new_input = "<input id='place_' class='form-control' type='hidden' name='place' value='{{ old('place') }}' required autocomplete='place' placeholder='Nhập nơi mua' autofocus>";

        $('#place_chq').append(new_input);

        $('#total_chq').val(new_place);
    }

    function remove() {
        var last_chq_no = $('#total_chq').val();

        if (last_chq_no > 1) {
            $('#new_' + last_chq_no).remove();
            $('#total_chq').val(last_chq_no - 1);
        }
    }
</script>
@endsection
