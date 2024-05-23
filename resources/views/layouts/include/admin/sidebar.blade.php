<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <!-- dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Sales -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('orders-index-admin') }}">
        <i class="mdi mdi-cart menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>

    <!-- Category -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-category" aria-expanded="false" aria-controls="ui-category">
        <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('category-create') }}">Add Category</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('category-index') }}">View Category</a></li>
        </ul>
      </div>
    </li>

    <!-- Product -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-products" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-shopping menu-icon"></i>
        <span class="menu-title">Product</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('product-create') }}">Add Product</a></li> <!--   -->
          <li class="nav-item"> <a class="nav-link" href="{{ route('product-index') }}">View Product</a></li> <!--   -->
        </ul>
      </div>
    </li>

    <!-- Brands -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('brands') }}">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Brands</span>
      </a>
    </li>

    <!-- Colors -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('colors-index') }}">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Colors</span>
      </a>
    </li>

    <!-- Users -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Admin</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Users</a></li>
        </ul>
      </div>
    </li>

    <!-- Home Slider -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('slider-index') }}">
        <i class="mdi mdi-view-carousel menu-icon"></i>
        <span class="menu-title">Home Slider</span>
      </a>
    </li>

    <!-- Site Setting -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('setting') }}">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Site Setting</span>
      </a>
    </li>

  </ul>
</nav>