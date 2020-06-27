  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-8">
                <h6>-Administrator-</h6>
                {{ Auth::user()->name }}
            </div>
        </div>
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action bg-light">Quản lí Users</a>
        <a href="{{ route('admin.dish.index') }}" class="list-group-item list-group-item-action bg-light">Danh sách món ăn</a>
        <a href="{{ route('admin.dish.check.index') }}" class="list-group-item list-group-item-action bg-light">Công thức chờ duyệt</a>
        <a href="{{ route('admin.comment.index') }}" class="list-group-item list-group-item-action bg-light">Bình luận về món</a>
        <a href="{{ route('admin.history.index') }}" class="list-group-item list-group-item-action bg-light">Lịch sử phát triển món ăn</a>
        <a href="{{ route('admin.menu.index') }}" class="list-group-item list-group-item-action bg-light">Thực đơn</a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-light">Quản lí danh mục</a>
        <a href="{{ route('admin.market.index') }}" class="list-group-item list-group-item-action bg-light">Quản lí chợ mua hàng</a>
    </div>
</div>
  <!-- /#sidebar-wrapper -->
