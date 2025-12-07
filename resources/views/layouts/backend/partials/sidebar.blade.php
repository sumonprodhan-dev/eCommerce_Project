<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/backend/img/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>

                </li>

                <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Category</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/subcategory*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subcategory.index') }}" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Sub Category</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/brand*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brand.index') }}" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Brand</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Product</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider.index') }}" class="nav-link">
                        <i class="fas fa-image"></i>
                        <p>Slider</p>
                    </a>
                </li>
                @if (Request::routeIs('admin.pending.orders') ||
                        Request::routeIs('admin.approved.orders') ||
                        Request::routeIs('admin.processing.orders') ||
                        Request::routeIs('admin.completed.orders') ||
                        Request::routeIs('admin.cancelled.orders') ||
                        Request::routeIs('admin.show.order'))
                    @php($orderNavigation = true)
                @endif

                <li class="nav-item {{ isset($orderNavigation) ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Orders</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isset($orderNavigation) ? 'show' : '' }}" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.pending.orders') }}"
                                    class="{{ Request::routeIs('admin.pending.orders') ? 'sub-active' : '' }}">
                                    <span class="sub-item">Pending Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.approved.orders') }}"
                                    class="{{ Request::routeIs('admin.approved.orders') ? 'sub-active' : '' }}">
                                    <span class="sub-item">Approved Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Processing Orders</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
