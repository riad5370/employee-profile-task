<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Noble<span>UI</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="dashboard-one.html" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">web apps</li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">User</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="" class="nav-link">User List</a>
              </li>
            </ul>
          </div>
        </li> --}}

        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#employee" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Employee</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="employee">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('employees.create')}}" class="nav-link">Create Employee</a>
                <a href="{{route('employees.index')}}" class="nav-link">Manage Employee</a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#product" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Product</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="product">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link">Add Product</a>
                <a href="{{route('products.index')}}" class="nav-link">Manage Product</a>
              </li>
            </ul>
          </div>
        </li>

    </div>
  </nav>