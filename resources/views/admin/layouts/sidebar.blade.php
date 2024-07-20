<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('theme/admin/assets/images/logo-dark.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('theme/admin/assets/images/logo-light.png')}}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
               

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCatalogues" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCatalogues">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Danh mục sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatalogues">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.catalogues.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.catalogues.create')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Thêm mới</a>
                            </li>
                           
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-product-hunt-line"></i> <span data-key="t-layouts">Sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.products.create')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Thêm mới</a>
                            </li>
                           
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.users.create')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Thêm mới</a>
                            </li>
                           
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.order.index')}}">
                        <i class="ri-shopping-cart-2-line"></i> <span data-key="t-layouts">Đơn hàng</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.comments.index')}}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Bình luận</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
            

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>