<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="POS" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">POS</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Taufan</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              Dashboard
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
        </li>
        @if (auth()->user()->can('show products') || auth()->user()->can('create products') || auth()->user()->can('delete products'))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-server"></i>
              <p>
                Manajemen Produk
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
            </ul>
          </li>
        @endif
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Manajemen User
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('users.roles-permission') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Role Permission</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fa fa-sign-out"></i>
            <p>{{ __('Logout') }}</p>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
