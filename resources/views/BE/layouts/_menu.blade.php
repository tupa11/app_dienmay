<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li {!! (Request::is('admin/dashboard')  || Request::is( 'dashboard'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.home')}}">
                        <i class="fi-air-play"></i>
                        <span class="menu-text"> {{__('menu.dashboard')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/admin*') || (Request::is('admin/role*')) )? 'class="active"' : '' !!}>
                    <a href="javascript: void(0);">
                        <i class="fa fa-address-book-o"></i> <span> {{__('menu.admin')}} </span> <span
                            class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li {!! (Request::is('admin/admin*')  || Request::is( 'admin'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.admin.index')}}">
                                <span class="menu-text"> {{__('menu.admin')}} </span>
                            </a>
                        </li>
                        <li {!! (Request::is('admin/role*')  || Request::is( 'role'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.role.index')}}">
                                <span class="menu-text"> {{__('menu.role')}} </span>
                            </a>
                        </li>

                    </ul>

                </li>
                <li {!! (Request::is('admin/member*')  || Request::is( 'member'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.member.index')}}">
                        <i class="fa fa-user-secret"></i>
                        <span class="menu-text"> {{__('menu.member')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/product*') )? 'class="active"' : '' !!}>
                    <a href="javascript: void(0);">
                        <i class="fa fa-product-hunt"></i> <span> {{__('menu.product_manager')}} </span> <span
                            class="menu-arrow"></span>
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li {!! (Request::is('admin/product/*')  || Request::is( 'product'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.product.index')}}">
                                <span class="menu-text"> {{__('menu.product')}} </span>
                            </a>
                        </li>
                        <li {!! (Request::is('admin/productdelete*')  || Request::is( 'productdelete'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.productdelete.index')}}">
                                <span class="menu-text"> {{__('menu.productdelete')}} </span>
                            </a>
                        </li>
                        <li {!! (Request::is('admin/color*')  || Request::is( 'color'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.color.index')}}">
                                <span class="menu-text"> {{__('menu.color')}} </span>
                            </a>
                        </li>
                        <li {!! (Request::is('admin/size*')  || Request::is( 'size'))? 'class="active"' : '' !!}>
                            <a href="{{route('admin.size.index')}}">
                                <span class="menu-text"> {{__('menu.size')}} </span>
                            </a>
                        </li>
                    </ul>

                </li>
                <li {!! (Request::is('admin/category*')  || Request::is( 'category'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.category.index')}}">
                        <i class="fa fa-calendar-minus-o"></i>
                        <span class="menu-text"> {{__('menu.category')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/manufacturer*')  || Request::is( 'manufacturer'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.manufacturer.index')}}">
                        <i class="fa fa-at"></i>
                        <span class="menu-text"> {{__('menu.manufacturer')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/sale_viethan*')  || Request::is( 'sale_viethan'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.sale_viethan.index')}}">
                        <i class="fa  fa-yelp"></i>
                        <span class="menu-text"> {{__('menu.sale_viethan')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/voucher*')  || Request::is( 'voucher'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.voucher.index')}}">
                        <i class="fa fa-meanpath"></i>
                        <span class="menu-text"> {{__('menu.voucher')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/code_voucher*')  || Request::is( 'code_voucher'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.code_voucher.index')}}">
                        <i class="fa fa-building-o"></i>
                        <span class="menu-text"> {{__('menu.code_voucher')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/banner*')  || Request::is( 'banner'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.banner.index')}}">
                        <i class="fa fa-camera"></i>
                        <span class="menu-text"> {{__('menu.banner')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/image*')  || Request::is( 'image'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.image.index')}}">
                        <i class="fa fa-file-image-o"></i>
                        <span class="menu-text"> {{__('menu.image')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/area*')  || Request::is( 'area'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.area.index')}}">
                        <i class="fa  fa-flag-checkered"></i>
                        <span class="menu-text"> {{__('menu.area')}} </span>
                    </a>
                </li>
                <li {!! (Request::is('admin/setting*')  || Request::is( 'setting'))? 'class="active"' : '' !!}>
                    <a href="{{route('admin.setting.index')}}">
                        <i class="fa fa-gear"></i>
                        <span class="menu-text"> {{__('menu.setting')}} </span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
