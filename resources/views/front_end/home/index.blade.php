@extends('front_end.index')
@section('front_title')
    {{env('app_name')}} | Home
@endsection
@section('home_body')
<div class="banner-area pt-30 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="banner-wrap mb-30">
                    <a href="product-details.html">
                        <img src="{{asset('/')}}front_end/assets/images/banner/banner-20.png" alt="banner">
                    </a>
                    <div class="banner-content-12">
                        <h2>Qucx Lapoo</h2>
                        <h5>G432xx</h5>
                        <h3>1990.00</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="banner-wrap mb-30">
                    <a href="product-details.html">
                        <img src="{{asset('/')}}front_end/assets/images/banner/banner-21.png" alt="banner">
                    </a>
                    <div class="banner-content-9">
                        <h3>Beots <br>Superb</h3>
                        <p>Lorem Ipsum is simply dummy text</p>
                        <a href="product-details.html">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="banner-wrap mb-30 res-white-overly-xs">
                    <a href="product-details.html">
                        <img src="{{asset('/')}}front_end/assets/images/banner/banner-22.png" alt="banner">
                    </a>
                    <div class="banner-content-9 banner-content-9-mrg2">
                        <h4>Sup<span>erb</span></h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                        <a href="product-details.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-area pb-40">
    <div class="container">
        <div class="section-title-tab-wrap">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4">
                    <div class="section-title-5">
                        <h2>Featured Product</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-8">
                    <div class="product-tab-list-4 nav">
                        <a href="#product-5" data-toggle="tab">
                            <h5>Computer </h5>
                        </a>
                        <a class="active" href="#product-" data-toggle="tab">
                            <h5>Accessories</h5>
                        </a>
                        <a href="#product-" data-toggle="tab">
                            <h5>Apple</h5>
                        </a>
                        <a href="#product-" data-toggle="tab">
                            <h5>Dell </h5>
                        </a>
                        <a href="#product-" data-toggle="tab">
                            <h5>Watch</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content jump">



            <div id="product-" class="tab-pane">
                <div class="product-slider-active owl-carousel">
                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/product/pro-hm5-7.jpg" alt="product"></a>
                            <div class="product-action-4">
                                <div class="product-action-4-style">
                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content product-content-padding">
                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                            <div class="price-addtocart">
                                <div class="product-price">
                                    <span>$210.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/product/pro-hm5-6.jpg" alt="product"></a>
                            <div class="product-action-4">
                                <div class="product-action-4-style">
                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content product-content-padding">
                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                            <div class="price-addtocart">
                                <div class="product-price">
                                    <span>$220.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/product/pro-hm5-5.jpg" alt="product"></a>
                            <div class="product-action-4">
                                <div class="product-action-4-style">
                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content product-content-padding">
                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                            <div class="price-addtocart">
                                <div class="product-price">
                                    <span>$210.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/product/pro-hm5-2.jpg" alt="product"></a>
                            <div class="product-action-4">
                                <div class="product-action-4-style">
                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content product-content-padding">
                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                            <div class="price-addtocart">
                                <div class="product-price">
                                    <span>$230.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/product/pro-hm5-1.jpg" alt="product"></a>
                            <div class="product-action-4">
                                <div class="product-action-4-style">
                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content product-content-padding">
                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                            <div class="price-addtocart">
                                <div class="product-price">
                                    <span>$240.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="banner-area pb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="banner-wrap mb-30">
                    <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/banner/banner-15.png" alt="banner"></a>
                    <div class="banner-content-10">
                        <h2>Mak Pro Gamming</h2>
                    </div>
                    <div class="banner-content-10-btn">
                        <a href="#">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="banner-wrap mb-30 res-white-overly-xs res-white-overly-md">
                    <a href="product-details.html"><img src="{{asset('/')}}front_end/assets/images/banner/banner-23.png" alt="banner"></a>
                    <div class="banner-content-13">
                        <h3>Qucx electric scooter</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="product-area pb-40">
    <div class="container">
        <div class="section-title-tab-wrap">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-4 col-sm-4">
                    <div class="section-title-5">
                        <h2>All Product</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-8">
                    <div class="product-tab-list-4 nav">

                                                <a class="active" href="#product-all" data-toggle="tab">
                                                    <h5>All product</h5>
                                                </a>

                    @foreach($all_subc as $category_all)
                            <a href="#allproduct-{{$category_all->id}}" data-toggle="tab">
                            <h5>{{$category_all->category_name}}</h5>
                        </a>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content jump">
            @foreach($all_subc as $category_all)
            <div id="allproduct-{{$category_all->id}}" class="tab-pane">
                <div class="row">
                    @foreach($all_products as $products)
                        @if($category_all->category_name==$products->category_name)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="product-wrap product-border-3 product-img-zoom mb-30">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{asset('/').$products->product_image}}" alt="product"></a>
                                <div class="product-action-4">
                                    <div class="product-action-4-style">
                                        <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                        <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                        <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content product-content-padding">
                                <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                                <div class="price-addtocart">
                                    <div class="product-price">
                                        <span>$210.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach





                <div id="product-5" class="tab-pane">
                    <div class="row">

                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="product-details.html"><img src="" alt="product"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4><a href="product-details.html">Golden Easy Spot Chair.</a></h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>$210.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>
                </div>











                <div id="product-all" class="tab-pane active">
                    <div class="row">
                @foreach($all_products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                <div class="product-img">
                                    <a href="product-details.html"><img src="{{asset('/').$product->product_image}}" alt="product"></a>
                                    <div class="product-action-4">
                                        <div class="product-action-4-style">
                                            <a data-tooltip="Add To Cart" href="#"><i class="la la-cart-plus"></i></a>
                                            <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                            <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content product-content-padding">
                                    <h4><a href="product-details.html">{{$product->product_name}}</a></h4>
                                    <div class="price-addtocart">
                                        <div class="product-price">
                                            <span>&#2547 {{$product->sale_price}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>



        </div>
    </div>
</div>
@include('front_end.includes.brand')


@endsection
