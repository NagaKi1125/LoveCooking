<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Cook | Admin Management</title>

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- shortcut icon-->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/gif">

	<!-- Css & bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- bootstrap multi select -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" />

    <!--ion-icons-->
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>

	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('head.style')
</head>
<body>
    @if(Auth::check())
        @if(Auth::user()->level==1 || Auth::user()->level==2)
        <div class="d-flex" id="wrapper">
            @include('admin.sidebar')

            <div id="page-content-wrapper">
                @include('admin.navbar')
                @yield('body.content')
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

    @yield('body.script')
    <!-- Menu Toggle Script -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
