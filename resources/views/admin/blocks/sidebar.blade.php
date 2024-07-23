@php use App\Helpers\AssetsHelper;use App\Helpers\NavigationHelper; @endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{route('admin.dashboard')}}"><img
                            src="{{AssetsHelper::assetKiaalap('images/logo/logo.png')}}"
                            alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle text-white" style="font-size: 20px"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{NavigationHelper::isActive(['admin'])}} ">
                    <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  {{NavigationHelper::isActive(['admin/course-categories*'])}} ">
                    <a href="{{route('course-categories.index')}}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Quản lý danh mục</span>
                    </a>
                </li>
                <li class="sidebar-item  {{NavigationHelper::isActive(['admin/courses*'])}}  ">
                    <a href="{{route('courses.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span> Quản lý khóa học</span>
                    </a>
                </li>
                <li class="sidebar-item  {{NavigationHelper::isActive(['admin/sections*'])}}  ">
                    <a href="{{route('sections.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Quản lý chương</span>
                    </a>
                </li>
                <li class="sidebar-item  {{NavigationHelper::isActive(['admin/lessons*'])}}  ">
                    <a href="{{route('lessons.index')}}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Quản lý bài học</span>
                    </a>
                </li>
                {{--                <li class="sidebar-item  has-sub">--}}
                {{--                    <a href="#" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-stack"></i>--}}
                {{--                        <span>Components</span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="submenu ">--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-alert.html">Alert</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-badge.html">Badge</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-breadcrumb.html">Breadcrumb</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-button.html">Button</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-card.html">Card</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-carousel.html">Carousel</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-dropdown.html">Dropdown</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-list-group.html">List Group</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-modal.html">Modal</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-navs.html">Navs</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-pagination.html">Pagination</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-progress.html">Progress</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-spinner.html">Spinner</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="component-tooltip.html">Tooltip</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="sidebar-item  has-sub">--}}
                {{--                    <a href="#" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-collection-fill"></i>--}}
                {{--                        <span>Extra Components</span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="submenu ">--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="extra-component-avatar.html">Avatar</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="extra-component-sweetalert.html">Sweet Alert</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="extra-component-toastify.html">Toastify</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="extra-component-rating.html">Rating</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="extra-component-divider.html">Divider</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="sidebar-item  has-sub">--}}
                {{--                    <a href="#" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-grid-1x2-fill"></i>--}}
                {{--                        <span>Layouts</span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="submenu ">--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="layout-default.html">Default Layout</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="layout-vertical-1-column.html">1 Column</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="layout-vertical-navbar.html">Vertical with Navbar</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item ">--}}
                {{--                            <a href="layout-horizontal.html">Horizontal Menu</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                --}}


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
