@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
<div class=""><a class="btn btn-primary" href="{{ route('admin.history.add') }}">Thêm mới</a></div>
    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">History ID</th>
                    <th scope="col">Dish name</th>
                    <th scope="col">Post</th>
                    <th scope="col">Main Image</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dishHistory as $his)
                        <tr>
                            <th scope="row">{{ $his->id }}</th>
                            <td>@foreach($dish as $di)
                                    @if($di->id == $his->dish_id)
                                        {{ $di->dish_name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="dhpost">{{ $his->dh_posts }}</td>
                            <td>{{ $his->dh_images }}</td>
                            <td>{{ carbon\carbon::parse($his->updated_at)->toDateTimeString() }}</td>
                            <td>

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
