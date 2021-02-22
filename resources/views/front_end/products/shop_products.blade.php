@extends('front_end.index')
@section('front_title')
    {{$shop_category->category_name}} |{{env('app_name')}}
@endsection


@section('home_body')
    @foreach($BannersShow as $banner_single)

        @if($banner_single->banner_role==7)
            @if($banner_single->category_id==$shop_category->id)
                <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$banner_single->banner_image}});">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h2>{{$banner_single->banner_name}}</h2>
                            <ul>
                                <li>
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="active">Shop product</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach


    <div class="shop-area pt-90 pb-90">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-topbar-wrapper">
                        <div class="shop-topbar-left">
                            <div class="view-mode nav">
                                <a class="active" href="#shop-1" data-toggle="tab"><i class="la la-th"></i></a>
                                <a href="#shop-2" data-toggle="tab"><i class="la la-list-ul"></i></a>
                            </div>
                            <p>Showing 1 - 20 of 30 results </p>
                        </div>
                        <div class="product-sorting-wrapper">
                            <div class="product-shorting shorting-style">
                                <label>View:</label>
                                <select>
                                    <option value=""> 20</option>
                                    <option value=""> 23</option>
                                    <option value=""> 30</option>
                                </select>
                            </div>
                            <div class="product-show shorting-style">
                                <label>Sort by:</label>
                                <select>
                                    <option value="">Default</option>
                                    <option value=""> Name</option>
                                    <option value=""> price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">

                                    @foreach($all_products as $product)
                                        @if($product->category_id==$shop_category->id)
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="product-wrap mb-35">
                                            <div class="product-img mb-15">
                                                <a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}"><img src="{{asset('/').$product->product_image}}" alt="{{$product->product_name.'image '.env('app_name')}}"></a>
                                                <span class="price-dec">-30%</span>
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#product{{$product->id.$shop_category->id}}" title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                    <a title="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                    <a title="Compare" href="#"><i class="la la-retweet"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <span>{{$shop_category->category_name}}</span>
                                                <h4><a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">Golden Easy Spot Chair.</a></h4>
                                                <div class="price-addtocart">
                                                    <div class="product-price">
                                                        <span>&#2547  {{$product->sale_price}}</span>
                                                        @if($product->regular_price!=null)
                                                            <span class="old">&#2547 {{$product->regular_price}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-addtocart">
                                                        <a title="Add To Cart" href="#">+ Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div id="shop-2" class="tab-pane">

                                @foreach($all_products as $product)
                                    @if($product->category_id==$shop_category->id)
                                <div class="shop-list-wrap mb-30">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6">
                                            <div class="product-list-img">
                                                <a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">
                                                    <img src="{{asset('/').$product->product_image}}" alt="{{$product->product_name.'image '.env('app_name')}}">
                                                </a>
                                                <div class="product-list-quickview">
                                                    <a data-toggle="modal" data-target="#product{{$product->id.$shop_category->id}}" title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6">
                                            <div class="shop-list-content">
                                                <span>{{$shop_category->category_name}}</span>
                                                <h4><a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->product_name}}</a></h4>
                                                <div class="pro-list-price">
                                                    <span>&#2547  {{$product->sale_price}}</span>
                                                    @if($product->regular_price!=null)
                                                        <span class="old-price">&#2547 {{$product->regular_price}}</span>
                                                    @endif
                                                </div>
                                                <p>{!! $product->long_description !!}</p>
                                                <div class="product-list-action">
                                                    <a title="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                    <a title="Compare" href="#"><i class="la la-retweet"></i></a>
                                                    <a title="Add To Cart" href="#"><i class="la la-shopping-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                        @endforeach
                            </div>
                            <div class="pagination-style text-center">
                                <ul>
                                    <li><a class="prev" href="#"><i class="la la-angle-left"></i></a></li>
                                    <li><a href="#">01</a></li>
                                    <li><a href="#">02</a></li>
                                    <li><a class="active" href="#">03</a></li>
                                    <li><a href="#">04</a></li>
                                    <li><a href="#">05</a></li>
                                    <li><a href="#">06</a></li>
                                    <li><a class="next" href="#"><i class="la la-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Search </h4>
                            <div class="sidebar-search mb-40 mt-20">
                                <form class="sidebar-search-form" action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button>
                                        <i class="la la-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget shop-sidebar-border pt-40">
                            <h4 class="sidebar-title">Shop By Categories</h4>
                            <div class="shop-catigory mt-20">
                                <ul id="faq">
                                    <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-1">Women Fashion <i class="la la-angle-down"></i></a>
                                        <ul id="shop-catigory-1" class="panel-collapse collapse show">
                                            <li><a href="#">Dress </a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Sunglasses </a></li>
                                            <li><a href="#">Sweater </a></li>
                                            <li><a href="#">Handbag </a></li>
                                        </ul>
                                    </li>
                                    <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-2">Men Fashion <i class="la la-angle-down"></i></a>
                                        <ul id="shop-catigory-2" class="panel-collapse collapse">
                                            <li><a href="#">Shirt </a></li>
                                            <li><a href="#">Shoes</a></li>
                                            <li><a href="#">Sunglasses </a></li>
                                            <li><a href="#">Sweater </a></li>
                                            <li><a href="#">Jacket </a></li>
                                        </ul>
                                    </li>
                                    <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-3">Furniture <i class="la la-angle-down"></i></a>
                                        <ul id="shop-catigory-3" class="panel-collapse collapse">
                                            <li><a href="#"> Chair</a></li>
                                            <li><a href="#">Lift Chair</a></li>
                                            <li><a href="#">Bunk Bed</a></li>
                                            <li><a href="#">Computer Desk</a></li>
                                            <li><a href="#">Bookcase</a></li>
                                        </ul>
                                    </li>
                                    <li> <a href="#">Lamp</a></li>
                                    <li> <a href="#">Electronics</a> </li>
                                    <li> <a href="#">Accessories</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-price-filter mt-35 shop-sidebar-border pt-40 sidebar-widget">
                            <h4 class="sidebar-title">Price Filter</h4>
                            <div class="price-filter mt-20">
                                <span>Range:  $100.00 - 1.300.00 </span>
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                    <button type="button">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget shop-sidebar-border pt-40 mt-40">
                            <h4 class="sidebar-title">Refine By </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox"> <a href="#">On Sale <span>4</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">New <span>5</span></a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">In Stock <span>6</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">
                            <h4 class="sidebar-title">Colour </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">Green <span>7</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">Cream <span>8</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">Blue <span>9</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">Black <span>3</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">
                            <h4 class="sidebar-title">Size </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XL <span>4</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">L <span>5</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">SM <span>6</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XXL <span>7</span> </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">
                            <h4 class="sidebar-title">Popular Tags </h4>
                            <div class="sidebar-widget-tag mt-20">
                                <ul>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">For Men</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Fashion</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($all_products as $product)
        @if($product->category_id==$shop_category->id)
    <div class="modal fade" id="product{{$product->id.$shop_category->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="tab-content quickview-big-img">
                                <div id="pro-1" class="tab-pane fade show active">
                                    <img src="{{asset('/').$product->product_image}}" alt="{{$product->product_name.'image'}}">
                                </div>
                                <div id="pro-2" class="tab-pane fade">
                                    <img src="assets/images/product/quickview-l2.jpg" alt="">
                                </div>
                                <div id="pro-3" class="tab-pane fade">
                                    <img src="assets/images/product/quickview-l3.jpg" alt="">
                                </div>
                                <div id="pro-4" class="tab-pane fade">
                                    <img src="assets/images/product/quickview-l2.jpg" alt="">
                                </div>
                            </div>
                            <!-- Thumbnail Large Image End -->
                            <!-- Thumbnail Image End -->
                            <div class="quickview-wrap mt-15">
                                <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                    <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/images/product/quickview-s1.jpg" alt=""></a>
                                    <a data-toggle="tab" href="#pro-2"><img src="assets/images/product/quickview-s2.jpg" alt=""></a>
                                    <a data-toggle="tab" href="#pro-3"><img src="assets/images/product/quickview-s3.jpg" alt=""></a>
                                    <a data-toggle="tab" href="#pro-4"><img src="assets/images/product/quickview-s4.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-details-content quickview-content">
                                <span>{{$shop_category->category_name}}</span>
                                <h2>{{$product->product_name}}</h2>
                                <div class="product-ratting-review">
                                    <div class="product-ratting">
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star"></i>
                                        <i class="la la-star-half-o"></i>
                                    </div>
                                    <div class="product-review">
                                        <span>40+ Reviews</span>
                                    </div>
                                </div>
{{--                                <div class="pro-details-color-wrap">--}}
{{--                                    <span>Color:</span>--}}
{{--                                    <div class="pro-details-color-content">--}}
{{--                                        <ul>--}}
{{--                                            <li class="green"></li>--}}
{{--                                            <li class="yellow"></li>--}}
{{--                                            <li class="red"></li>--}}
{{--                                            <li class="blue"></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="pro-details-size">--}}
{{--                                    <span>Size:</span>--}}
{{--                                    <div class="pro-details-size-content">--}}
{{--                                        <ul>--}}
{{--                                            <li><a href="#">s</a></li>--}}
{{--                                            <li><a href="#">m</a></li>--}}
{{--                                            <li><a href="#">xl</a></li>--}}
{{--                                            <li><a href="#">xxl</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="pro-details-price-wrap">
                                    <div class="product-price">
                                        <span>&#2547  {{$product->sale_price}}</span>
                                        @if($product->regular_price!=null)
                                            <span class="old">&#2547 {{$product->regular_price}}</span>

                                    </div>
                                    <div class="dec-rang"><span>- 30%</span>@endif</div>
                                </div>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                                    </div>
                                </div>
                                <div class="pro-details-compare-wishlist">
                                    <div class="pro-details-compare">
                                        <a title="Add To Compare" href="#"><i class="la la-retweet"></i> Compare</a>
                                    </div>
                                    <div class="pro-details-wishlist">
                                        <a title="Add To Wishlist" href="#"><i class="la la-heart-o"></i> Add to wish list</a>
                                    </div>
                                </div>
                                <div class="pro-details-buy-now btn-hover btn-hover-radious">
                                    @if($product->product_quantity>0)
                                        <a href="#">Add To Cart</a>
                                    @else
                                        <h4 class="text-danger">Out of stock</h4>
                                        <p>Product id:#{{$product->category_name.'-p-'.$product->id}}</p>
                                        <p>Order to call :<strong class="text-info"> <a href="tel:{{$contacts->phone_number}}">{{$contacts->phone_number}}</a></strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
    @endforeach
<style>#product_menus{display: none;}</style>

@endsection
