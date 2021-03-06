<header class="header-area">
    <div class="main-header-wrap">
        <div class="header-top pt-15 pb-15 bg-black-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="welcome">
                            <p>Welcome to our shop</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="setting-wrap-2">
                            <div class="setting-content2-left">
                                <a class="currency-dropdown-active" href="#">BDT <i class="la la-angle-down"></i></a>
                                <div class="currency-dropdown">
                                    <ul>
{{--                                        <li><a href="#">USD</a></li>--}}
{{--                                        <li><a href="#">Euro</a></li>--}}
{{--                                        <li><a href="#">Real</a></li>--}}
                                        <li><a href="#">BDT</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="setting-content2-right">
                                <a href="#">Wishlist</a>
                                @if(Session::get('customer_id')&&Session::get('customer_email'))
                                    <a href="{{route('customer_dashboard')}}">My Account</a>
                                @else
                                    <a href="{{route('loginRegister')}}">Sign in</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle border-top-2 pt-30 pb-30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            @if(!empty($appearance_image->id))
                                <a href="{{url('/')}}"><img src="{{asset('/').$appearance_image->logo}}" height="70" alt="logo"></a>
                            @endif</div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="header-contact-search-wrap header-contact-search-mrg">
                            <div class="header-contact-2">
                                <div class="header-contact-2-icon">
                                    <i class="la la-phone"></i>
                                </div>
                                <div class="header-contact-2-text">
                                    <span>Contact</span>
                              @if($contacts!=null)

                                    <p>{{$contacts->phone_number}}</p>
                               @endif
                                </div>
                            </div>
                            <div class="search-style-4">
                                {{Form::open(['method'=>'post','route'=>'search_products'])}}
                                    <div class="form-search-4">
                                        <input id="search" value="{{isset($search_val)?$search_val:''}}" name="search" class="input-text" placeholder="Search Hear" type="search">
                                        <button>
                                            <i class="la la-search"></i>
                                        </button>
                                    </div>
                               {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-2">
                        <div class="cart-wrap cart-wrap-3 cart-wrap-3-white">
                            <button class="cart-active">
                                <i class="la la-shopping-cart"></i> <br>
                                <span class="mini-cart-price-3">$400.00</span>
                                <span class="count-style-3">01</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <h4>Your Cart</h4>
                                    <a class="cart-close" href="#"><i class="la la-close"></i></a>
                                </div>
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-1.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-2.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-3.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div class="shopping-cart-total">
                                        <h4>Subtotal <span class="shop-total">$290.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover default-btn text-center">
                                        <a class="black-color" href="checkout.html">Continue to Chackout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="header-bottom sticky-bar bg-red">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="category-menu-wrap">
                            <h3 class="showcat">
                                <a href="#">
                                    <img class="category-menu-non-stick" src="{{asset('/')}}front_end/assets/images/icon-img/category-menu.png" alt="icon">
                                    <img class="category-menu-stick" src="{{asset('/')}}front_end/assets/images/icon-img/category-menu-stick.png" alt="icon">
                                    All Department <i class="la la-angle-down"></i>
                                </a>
                            </h3>

                            <div class="category-menu hidecat" id="product_menus">
                                <nav>
                                    <ul>
                                        @foreach($parents_menu as $menu)
                                        <li class="cr-dropdown  pb-2"><a class="font-weight-bold" href="#">{{$menu->parents_category_name}}<span class="la la-angle-right"></span></a>
                                            <div class="category-menu-dropdown ct-menu-res-height-1">
                                                @foreach($blocks as $block)
                                                    @if($block->parents_category_id==$menu->id)
                                                <div class="single-category-menu ct-menu-mrg-bottom category-menu-border">
                                                    <h4>{{$block->laval_name}}</h4>
                                                    <ul>
                                                        @foreach($scategories as $scategory)
                                                            @if($block->id==$scategory->collum_id&&$scategory->parents_category_id==$menu->id)
                                                                 <li><a href="{{route('category_show_product',['slug'=>$scategory->slug,'id'=>$scategory->id,'paginate'=>30])}}">{{$scategory->category_name}}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>

                                                </div>
                                                    @endif
                                                @endforeach

                                                <div class="single-category-menu">
                                                    <a href="#"><img src="{{asset('/').$menu->parents_category_image}}" alt=""></a>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <div class="main-menu menu-common-style menu-lh-5 menu-margin-4 menu-font-2 menu-font-2-white res-hm8-margin">
                            <nav>
                                <ul>
{{--                                    <li class="angle-shape"><a href="index.html">Home</a>--}}
{{--                                        <ul class="submenu">--}}
{{--                                            <li><a href="index.html">Home version 1 </a></li>--}}
{{--                                            <li><a href="index-2.html">Home version 2 </a></li>--}}
{{--                                            <li><a href="index-3.html">Home version 3 </a></li>--}}
{{--                                            <li><a href="index-4.html">Home version 4 </a></li>--}}
{{--                                            <li><a href="index-5.html">Home version 5 </a></li>--}}
{{--                                            <li><a href="index-6.html">Home version 6 </a></li>--}}
{{--                                            <li><a href="index-7.html">Home version 7 </a></li>--}}
{{--                                            <li><a href="index-8.html">Home version 8 </a></li>--}}
{{--                                            <li><a href="index-9.html">Home version 9 </a></li>--}}
{{--                                            <li><a href="index-10.html">Home version 10 </a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="angle-shape"><a href="shop.html">Shop </a>--}}
{{--                                        <ul class="mega-menu mega-menu-mrg-ngtv2">--}}
{{--                                            <li><a class="menu-title" href="#">Shop Layout</a>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="shop.html">standard style</a></li>--}}
{{--                                                    <li><a href="shop-2.html">standard style 2</a></li>--}}
{{--                                                    <li><a href="shop-2-col.html">shop 2 column</a></li>--}}
{{--                                                    <li><a href="shop-no-sidebar.html">shop no sidebar</a></li>--}}
{{--                                                    <li><a href="shop-fullwide.html">shop fullwide</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}

{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="angle-shape"><a href="#">Pages</a>--}}
{{--                                        <ul class="submenu">--}}
{{--                                            <li><a href="about-us.html">about us </a></li>--}}
{{--                                            <li><a href="cart.html">cart page </a></li>--}}
{{--                                            <li><a href="checkout.html">checkout </a></li>--}}
{{--                                            <li><a href="compare.html">compare </a></li>--}}
{{--                                            <li><a href="wishlist.html">wishlist </a></li>--}}
{{--                                            <li><a href="my-account.html">my account </a></li>--}}
{{--                                            <li><a href="contact.html">contact us </a></li>--}}
{{--                                            <li><a href="login-register.html">login/register </a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="angle-shape"><a href="blog.html">Blog</a>--}}
{{--                                        <ul class="submenu">--}}
{{--                                            <li><a href="blog.html">standard style </a></li>--}}
{{--                                            <li><a href="blog-2col.html">blog 2 column </a></li>--}}
{{--                                            <li><a href="blog-sidebar.html">blog sidebar </a></li>--}}
{{--                                            <li><a href="blog-details.html">blog details </a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="shop.html">Mens</a></li>--}}
                                    <li><a href="{{route('contactus')}}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-small-mobile">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a href="{{url('/')}}">
                            @if(!empty($appearance_image->id))
                                <a href="{{url('/')}}"><img src="{{asset('/').$appearance_image->logo}}" height="70" alt="logo"></a>
                             @endif
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        <div class="cart-wrap common-style">
                            <button class="cart-active">
                                <i class="la la-shopping-cart"></i>
                                <span class="count-style">2 Items</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <h4>Your Cart</h4>
                                    <a class="cart-close" href="#"><i class="la la-close"></i></a>
                                </div>
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-1.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-2.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="{{asset('/')}}front_end/assets/images/cart/cart-3.jpg"></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Golden Easy Spot Chair.</a></h4>
                                            <span>$99.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="la la-trash"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div class="shopping-cart-total">
                                        <h4>Subtotal <span class="shop-total">$290.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover default-btn text-center">
                                        <a class="black-color" href="checkout.html">Continue to Chackout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="la la-navicon la-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-red pt-20 pb-20 ct-menu-small-device">
        <div class="container">
            <div class="category-menu-wrap">
                <h3 class="showcat">
                    <a href="#">
                        <img class="category-menu-non-stick" src="{{asset('/')}}front_end/assets/images/icon-img/category-menu.png" alt="icon">
                        <img class="category-menu-stick" src="{{asset('/')}}front_end/assets/images/icon-img/category-menu-stick.png" alt="icon">
                        All Department <i class="la la-angle-down"></i>
                    </a>
                </h3>
                <div class="category-menu mobile-category-menu hidecat">
                    <nav>

                        <ul>
                            @foreach($parents_menu as $menu)

                            <li class="cr-dropdown"><a href="#">{{$menu->parents_category_name}}<span class="la la-angle-down"></span></a>

                                <ul class="cr-menu-desktop-none">
                                    @foreach($blocks as $block)
                                        @if($block->parents_category_id==$menu->id)
                                    <li class="cr-sub-dropdown sub-style"><a href="#">{{$block->laval_name}}<i class="la la-angle-down"></i></a>
                                        <ul>
                                            @foreach($scategories as $scategory)
                                                @if($block->id==$scategory->collum_id&&$scategory->parents_category_id==$menu->id)

                                                    <li><a href="{{route('category_show_product',['slug'=>$scategory->slug,'id'=>$scategory->id,'paginate'=>20])}}">{{$scategory->category_name}}</a></li>

                                                @endif
                                         @endforeach
                                        </ul>
                                    </li>
                                        @endif
                                    @endforeach

                                </ul>

                            </li>

                            @endforeach

                        </ul>


                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
