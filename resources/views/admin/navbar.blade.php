
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-primary" id="menu-toggle">Menu</button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <!--<li class="nav-item active"> <a class="nav-link" href="{{ route('home') }}">Trang Chủ<span class="sr-only">(current)</span></a></li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Xem Website
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">Blog</a>
                    <a class="dropdown-item" href="">Map</a>
                    <a class="dropdown-item" href="">Đặt sân</a>
                    <a class="dropdown-item" href="">Hình ảnh</a>
                    <a class="dropdown-item" href="">Kỹ thuật đá bóng</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>  -->
            @if (Auth::check())
                <div class="pull-right" style="margin-top: 3px;"><a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Đăng xuất') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form></div>
            @endif
        </ul>

    </div>
</nav>
