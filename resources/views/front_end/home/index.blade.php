@extends('front_end.index')
@section('front_title')
    {{env('app_name')}} | Home
@endsection
@section('home_body')
    {{--************************************** slider ********************************************    --}}
    @include('front_end.includes.slider')
    <div class="banner-area pt-30 pb-40">
        @foreach($BannersShow as $slider_bottom_banner)
            @if($slider_bottom_banner->banner_role==1)
                <div class="container">
                    <div class="deal-area">
                        <div class="bg-img deal-bg"
                             style="background-image:url({{asset('/').$slider_bottom_banner->banner_image}});">
                            <div class="container">
                                <div class="row">
                                    <div class="ml-auto col-lg-7 col-md-10 col-sm-10 col-12">
                                        <div class="deal-content-4">
                                            <img src="{{asset('/').$slider_bottom_banner->banner_image}}"
                                                 alt="{{$slider_bottom_banner->banner_name}}">
                                            <h2>{{$slider_bottom_banner->banner_name}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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
                                <a href="product-details.html"><img
                                        src="{{asset('/')}}front_end/assets/images/product/pro-hm5-7.jpg" alt="product"></a>
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
                                <a href="product-details.html"><img
                                        src="{{asset('/')}}front_end/assets/images/product/pro-hm5-6.jpg" alt="product"></a>
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
                                <a href="product-details.html"><img
                                        src="{{asset('/')}}front_end/assets/images/product/pro-hm5-5.jpg" alt="product"></a>
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
                                <a href="product-details.html"><img
                                        src="{{asset('/')}}front_end/assets/images/product/pro-hm5-2.jpg" alt="product"></a>
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
                                <a href="product-details.html"><img
                                        src="{{asset('/')}}front_end/assets/images/product/pro-hm5-1.jpg" alt="product"></a>
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

    <div class="banner-area pt-30 pb-100">
        @foreach($BannersShow as $featured_bottom_slider)
            @if($featured_bottom_slider->banner_role==2)
                <div class="container">
                    <div class="bg-img pt-100 pb-100 learn-banner"
                         style="background-image:url({{asset('/').$featured_bottom_slider->banner_image}});">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-11">
                                <div class="banner-content">
                                    <h2>{{$featured_bottom_slider->banner_name}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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
                            @php($i=1)
                            @foreach($category_all_product as $category_all)

                                <a href="#category_product-{{$i++}}" data-toggle="tab">
                                    <h5>{{$category_all->category_name}}</h5>
                                </a>
                                {{--                              @endfor--}}
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content jump">
                @if(isset($product_all_section['one']))
                    <div id="category_product-1" class="tab-pane">
                        <div class="row">
                            @foreach($product_all_section['one'] as $products)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}"><img
                                                    src="{{asset('/').$products->product_image}}"
                                                    alt="product {{$products->product_name}}"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i
                                                            class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i
                                                            class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4>
                                                <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}">{{$products->product_name}}</a>
                                            </h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>&#2547 {{$products->sale_price}}</span>
                                                    @if($products->regular_price!=null)
                                                        <span class="old">&#2547 {{$products->regular_price}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>

                        </div>

                    </div>
                @endif
                @if(isset($product_all_section['tow'])==true)
                    <div id="category_product-2" class="tab-pane">
                        <div class="row">
                            @foreach($product_all_section['tow'] as $products)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}"><img
                                                    src="{{asset('/').$products->product_image}}" alt="product"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i
                                                            class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i
                                                            class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4>
                                                <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}">{{$products->product_name}}</a>
                                            </h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>&#2547 {{$products->sale_price}}</span>
                                                    @if($products->regular_price!=null)
                                                        <span class="old">&#2547 {{$products->regular_price}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>

                        </div>

                    </div>
                @endif

                @if(isset($product_all_section['three'])==true)
                    <div id="category_product-3" class="tab-pane">
                        <div class="row">
                            @foreach($product_all_section['three'] as $products)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}"><img
                                                    src="{{asset('/').$products->product_image}}" alt="product"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i
                                                            class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i
                                                            class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4>
                                                <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}">{{$products->product_name}}</a>
                                            </h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>&#2547 {{$products->sale_price}}</span>
                                                    @if($products->regular_price!=null)
                                                        <span class="old">&#2547 {{$products->regular_price}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>

                        </div>

                    </div>
                @endif

                @if(isset($product_all_section['fore'])==true)
                    <div id="category_product-4" class="tab-pane">
                        <div class="row">
                            @foreach($product_all_section['fore'] as $products)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}"><img
                                                    src="{{asset('/').$products->product_image}}" alt="product"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i
                                                            class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i
                                                            class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4>
                                                <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}">{{$products->product_name}}</a>
                                            </h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>&#2547 {{$products->sale_price}}</span>
                                                    @if($products->regular_price!=null)
                                                        <span class="old">&#2547 {{$products->regular_price}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>

                        </div>

                    </div>
                @endif


                <div id="product-6" class="tab-pane">
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
                                            <span class="old">$230.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div id="product-all" class="tab-pane active">
                    <div class="row">
                        {{--                @foreach($all_products as $products)--}}
                        @for($i=1;$i<=8;$i++)
                            @if(count($all_products)>=8)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                        <div class="product-img">
                                            <a href="{{route('single_product',['slug'=>$all_products[$i]->slug,'id'=>$all_products[$i]->id])}}"><img
                                                    src="{{asset('/').$all_products[$i]->product_image}}"
                                                    alt="product{{$all_products[$i]->product_name}}"></a>
                                            <div class="product-action-4">
                                                <div class="product-action-4-style">
                                                    <a data-tooltip="Add To Cart" href="#"><i
                                                            class="la la-cart-plus"></i></a>
                                                    <a data-tooltip="Wishlist" href="#"><i
                                                            class="la la-heart-o"></i></a>
                                                    <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content product-content-padding">
                                            <h4>
                                                <a href="{{route('single_product',['slug'=>$all_products[$i]->slug,'id'=>$all_products[$i]->id])}}">{{$all_products[$i]->product_name}}</a>
                                            </h4>
                                            <div class="price-addtocart">
                                                <div class="product-price">
                                                    <span>&#2547 {{$all_products[$i]->sale_price}}</span>
                                                    @if($all_products[$i]->regular_price!=null)
                                                        <span
                                                            class="old">&#2547 {{$all_products[$i]->regular_price}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h2 class="text-info text-center">Please upload minimum eight product then show all
                                    product</h2>
                            @endif
                        @endfor
                        {{--                        @endforeach--}}
                    </div>
                    @if(count($all_products)>=10)
                        <div class="section-title-6 mb-50 text-center">
                            <a href="{{route('show_all_product')}}" class="btn btn"
                               style="color:#FFFFFF;background-color:#ff5151">All product</a>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
    @include('front_end.includes.brand')


@endsection
