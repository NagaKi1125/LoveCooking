@extends('admin.admin')

@section('body.content')
@if(Auth::check())
@if(Auth::user()->level==1)
    <div class="table-responsive-sm">
        <table class="user table table-borderless table-hover table-dark table-striped table-center">
            <thead>
                <tr>
                    <th scope="col">Comment ID</th>
                    <th scope="col">User name</th>
                    <th scope="col">Dish ID</th>
                    <th scope="col">Comment</th>
                    <th scope="col">DateTime</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($comment as $cmt)
                        <tr>
                            <th scope="row">{{ $cmt->id }}</th>
                            <td>@foreach($dish as $dish)
                                    @if($dish->id == $cmt->dish_id)
                                        {{ $dish->dish_name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>@foreach($users as $us)
                                    @if($us->id == $cmt->user_id)
                                        {{ $us->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $smt->comment }}</td>
                            <td>{{ carbon\carbon::parse($cmt->updated_at)->toDateTimeString() }}</td>
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
