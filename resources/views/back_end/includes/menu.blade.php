<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
    @php($role=json_decode($permission->permission))
    <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-home"></i><span class="badge badge-primary float-right">3</span> <span> Dashboard </span>
                    </a>
                </li>
                {{--                    Email section start--}}
                @if(in_array(1,$role)==true||Auth::user()->role==1)
                    <li>
                        <a href="javascript:void(0);" class="waves-effect "><i
                                class="mdi mdi-email "></i><span> Email <span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('email')}}" >Send mail</a></li>
{{--                            <li><a href="#">Email Read</a></li>--}}
{{--                            <li><a href="#">Email Compose</a></li>--}}
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="mdi mdi-comment"></i><span class="badge badge-danger float-right">10</span> <span> Comments </span>
                        </a>
                    </li>

                    <li class="{{request()->routeIs('full_view_message')?'active':''}}{{request()->routeIs('message_reply')?'active':''}}">
                        <a href="{{route('inbox_massage')}}" class="waves-effect {{request()->routeIs('full_view_message')?'active':''}}{{request()->routeIs('message_reply')?'active':''}}">
                            <i class="mdi mdi-message"></i><span class="badge badge-danger float-right">{{count($message_count)>0?count($message_count):''}}</span> <span> Message </span>
                        </a>
                    </li>
                @endif
                {{--                email section end--}}



                @if(in_array(2,$role)==true||Auth::user()->role==1)

                    <li class="menu-title">Order</li>

                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i
                                class="mdi mdi-shopping"></i><span>Order <span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="#">Manage Order</a></li>
                            <li><a href="#" class="text-danger">Canceled Order </a></li>
                            <li><a href="#" class="text-warning">Give Shipping Product </a></li>
                            <li><a href="#" class="text-success">Complete Order</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(3,$role)==true||Auth::user()->role==1)

                    <li class="{{request()->routeIs('customer_details') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect {{request()->routeIs('customer_details') ? 'active' : ''}}"><i class="mdi mdi-account-box"></i><span>Customers<span
                                    class="float-right menu-arrow {{request()->routeIs('customer_details') ? 'active' : ''}}"><i class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li class="{{request()->routeIs('customer_details') ? 'active' : ''}}"><a href="{{route('all_customers',['slug'=>'all-customer'])}}">All customer</a></li>
                        </ul>
                    </li>
                @endif


                @if(in_array(4,$role)==true||Auth::user()->role==1)
                    <li class="menu-title">Category & brand</li>

                    {{--Category menu--}}
                    <li class="{{request()->routeIs('edit_parents_category') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect "><i class="mdi mdi-bulletin-board"></i><span>Parents Category <span
                                    class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('add_parents_menu',['slug'=>'Add-parents-Category'])}}">Add parents
                                    Category</a></li>
                            <li class="{{request()->routeIs('edit_parents_category') ? 'active' : ''}}"><a
                                    href="{{route('manage_parents_category',['slug'=>'manage-parents-category'])}}">Manage
                                    parents Category</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(5,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('parents_menu_blocks_add','edit_blocks') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-floor-plan"></i><span>HTML Blocks<span
                                    class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
{{--                            <li><a href="#">Navigation Blocks</a></li>--}}
                            <li class="{{request()->routeIs('parents_menu_blocks_add','edit_blocks') ? 'active' : ''}}">
                                <a href="{{route('parents_menu_blocks')}}">Parents Menu Blocks</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(6,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('edit_subcategory') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-view-list"></i><span>Sub Category <span
                                    class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('index')}}">Add sub Category</a></li>
                            <li class="{{request()->routeIs('edit_subcategory') ? 'active' : ''}}"><a
                                    href="{{route('manage_subcategory')}}">Manage sub Category</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(7,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('edit_brand') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard"></i><span>Brands<span
                                    class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('add_brand',['slug'=>'add-brands'])}}">Add Brands</a></li>
                            <li class="{{request()->routeIs('edit_brand') ? 'active' : ''}}"><a
                                    href="{{route('manage_brand',['slug'=>'manage-brand'])}}">Manage Brands</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(8,$role)==true||Auth::user()->role==1)
                    <li class="menu-title">Product & event management</li>
                    <li class="{{request()->routeIs('size_add_view','color_edit_view') ? 'active' : ''}}{{request()->routeIs('color_add_view') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('size_add_view') ? 'active' : ''}}"><i
                                class="fa fa-paint-brush"></i><span>Size & Color<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li class="{{request()->routeIs('size_add_view') ? 'active' : ''}}"><a
                                    href="{{route('size')}}">Size Management</a></li>
                            <li class="{{request()->routeIs('color_add_view','color_edit_view') ? 'active' : ''}}"><a
                                    href="{{route('color')}}">Color Management</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(9,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('product_full_details') ? 'active' : ''}}{{request()->routeIs('edit_product') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('product_full_details') ? 'active' : ''}}{{request()->routeIs('edit_product') ? 'active' : ''}}"><i
                                class="mdi mdi-cube"></i><span>Product<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('index_view')}}">Add Product</a></li>
                            <li class="{{request()->routeIs('product_full_details') ? 'active' : ''}}{{request()->routeIs('edit_product') ? 'active' : ''}}">
                                <a href="{{route('manage_products')}}">Manage Products</a></li>
                            <li><a class="text-danger" href="{{route('stock_out_product')}}">Stock out Product</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(10,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('add_campaign') ? 'active' : ''}}{{request()->routeIs('edit_campaign') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="waves-effect"><i
                                class="mdi mdi-briefcase"></i><span>Deals<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            {{--                        <li><a href="#">Add Deals</a></li>--}}
                            <li class="{{request()->routeIs('add_campaign') ? 'active' : ''}}{{request()->routeIs('edit_campaign') ? 'active' : ''}}">
                                <a href="{{route('index_campaign')}}">Manage Campaign</a></li>

                        </ul>
                    </li>
                @endif
                @if(in_array(11,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('add_coupon') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('add_coupon') ? 'active' : ''}}"><i
                                class="mdi mdi-tag"></i><span>Coupon<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            {{--                        <li><a href="#">Add Deals</a></li>--}}
                            <li class="{{request()->routeIs('add_coupon') ? 'active' : ''}}"><a
                                    href="{{route('index_coupon')}}">Manage Coupon</a></li>

                        </ul>
                    </li>
                @endif

                @if(in_array(12,$role)==true||Auth::user()->role==1)
                    <li class="menu-title">Appearance</li>

                    <li class="{{request()->routeIs('slider_add') ? 'active' : ''}}">
                        <a href="{{route('slider_index')}}"
                           class="waves-effect {{request()->routeIs('slider_add') ? 'active' : ''}}">
                            <i class="fa fa-sliders-h"></i><span> Slider </span>
                        </a>
                    </li>
                @endif
                @if(in_array(13,$role)==true||Auth::user()->role==1)
                    <li class="{{request()->routeIs('banners_add') ? 'active' : ''}}{{request()->routeIs('edit_banner') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('edit_banner') ? 'active' : ''}}"><i
                                class="mdi mdi-switch"></i><span>Appearance<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li><a href="{{route('logo_background_index')}}">Logo & Admin background</a></li>
                            {{--                        <li><a href="#"></a></li>--}}
                            <li class="{{request()->routeIs('banners_add') ? 'active' : ''}}{{request()->routeIs('edit_banner') ? 'active' : ''}}">
                                <a href="{{route('banners_manage')}}">Banners</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(14,$role)==true||Auth::user()->role==1)

                    <li class="menu-title">Others</li>
                    <li class="{{request()->routeIs('add_meta_script')? 'active' : ''}}{{request()->routeIs('edit_notes')? 'active' : ''}}{{request()->routeIs('edit_shipping')? 'active' : ''}}{{request()->routeIs('edit_meta') ? 'active' : ''}}{{request()->routeIs('add_link') ? 'active' : ''}}{{request()->routeIs('edit_icon') ? 'active' : ''}}{{request()->routeIs('add_contact') ? 'active' : ''}}{{request()->routeIs('edit_contact') ? 'active' : ''}}{{request()->routeIs('edit_payment')? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('add_meta_script') ? 'active' : ''}}{{request()->routeIs('edit_meta') ? 'active' : ''}}{{request()->routeIs('add_link') ? 'active' : ''}}{{request()->routeIs('edit_icon') ? 'active' : ''}}{{request()->routeIs('add_contact') ? 'active' : ''}}{{request()->routeIs('edit_contact') ? 'active' : ''}}{{request()->routeIs('edit_shipping') ? 'active' : ''}}{{request()->routeIs('edit_notes')? 'active' : ''}}{{request()->routeIs('edit_payment')? 'active' : ''}}"><i
                                class="mdi mdi-wrench"></i><span>Utilities<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li class="{{request()->routeIs('edit_shipping')? 'active' : ''}}{{request()->routeIs('edit_notes')? 'active' : ''}}{{request()->routeIs('edit_notes')? 'active' : ''}}{{request()->routeIs('edit_payment')? 'active' : ''}}">
                                <a href="{{route('purchase_settings')}}">Purchase settings</a></li>
                            <li class="{{request()->routeIs('add_contact') ? 'active' : ''}}{{request()->routeIs('edit_contact') ? 'active' : ''}}">
                                <a href="{{route('manage_contact')}}">Contact & help</a></li>
                            <li class="{{request()->routeIs('add_link') ? 'active' : ''}}{{request()->routeIs('edit_icon') ? 'active' : ''}}">
                                <a href="{{route('manage_icon')}}">Social share</a></li>
                            <li class="{{request()->routeIs('add_meta_script') ? 'active' : ''}}{{request()->routeIs('edit_meta') ? 'active' : ''}}">
                                <a href="{{route('manage_script')}}">SEO Meta and Script</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array(15,$role)==true||Auth::user()->role==1)

                    <li class="{{request()->routeIs('add_page') ? 'active' : ''}}{{request()->routeIs('edit_page') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('add_page') ? 'active' : ''}}{{request()->routeIs('edit_page') ? 'active' : ''}}"><i
                                class="mdi mdi-file"></i><span>Pages<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li class="{{request()->routeIs('add_page') ? 'active' : ''}}{{request()->routeIs('edit_page') ? 'active' : ''}}">
                                <a href="{{route('manage_page')}}">Create page</a></li>
                            {{--                        <li><a href="#">Add information</a></li>--}}
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->role==1)
                    <li class="{{request()->routeIs('register') ? 'active' : ''}}{{request()->routeIs('edit_co_user') ? 'active' : ''}}{{request()->routeIs('change_password') ? 'active' : ''}}">
                        <a href="javascript:void(0);"
                           class="waves-effect {{request()->routeIs('register') ? 'active' : ''}}{{request()->routeIs('edit_co_user') ? 'active' : ''}}{{request()->routeIs('change_password') ? 'active' : ''}}"><i
                                class="mdi mdi-account"></i><span>Admin<span class="float-right menu-arrow"><i
                                        class="mdi mdi-plus"></i></span> </span></a>
                        <ul class="submenu">
                            <li class="{{request()->routeIs('register') ? 'active' : ''}}{{request()->routeIs('edit_co_user') ? 'active' : ''}}{{request()->routeIs('change_password') ? 'active' : ''}}"><a
                                    href="{{route('manage_admin')}}">Users</a></li>
                        </ul>
                    </li>
                @endif
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
