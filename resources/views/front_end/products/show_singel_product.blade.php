
@extends('front_end.index')
@section('front_title')
{{$product->product_name}} | at {{env('app_name')}}
@endsection
@section('product_description')
{!!$product->product_name!!}
@endsection
@section('mates')
    <meta name="og:url" content="{{env('app_url').$product->slug.$product->id.'/show'}}"/>
    <meta name="og:title" content="{{$product->product_name}}.at {{env('app_name')}}"/>
    <meta name="og:type" content="{{$product->category_name}}.product"/>
    <meta name="og:description" content="{!!$product->long_description!!}" />
    <meta name="og:image" content="{{env('app_url').$product->product_image}}" />
@endsection

@section('home_body')

    @foreach($BannersShow as $banner_single)

        @if($banner_single->banner_role==7)
            @if($banner_single->category_id==$product->category_id)
            <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$banner_single->banner_image}});">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <h2>{!! $banner_single->banner_name !!}</h2>
                        <ul>
                            <li>
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="active">Full view</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        @endif
    @endforeach

    <div class="product-details-area pt-90 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro" src="{{asset('/').$product->product_image}}" data-zoom-image="{{asset('/').$product->product_image}}" alt="{{$product->product_name}} image" /> @if($product->regular_price!=null)<span>{{ceil(($product->sale_price-$product->regular_price)/$product->regular_price*100)}}%</span>@endif
                        </div>

                        <div id="gallery" class="mt-20 product-dec-slider">
                            <a data-image="{{asset('/').$product->product_image}}" data-zoom-image="{{asset('/').$product->product_image}}">
                                <img width="90" height="90" src="{{asset('/').$product->product_image}}" alt="{{$product->product_name}} image">
                            </a>
                            @if($other_info['images']!=null)
                                @foreach($other_info['images'] as $image)
                                    <a data-image="{{asset('/').$image}}" data-zoom-image="{{asset('/').$image}}">
                                        <img width="90" height="90" src="{{asset('/').$image}}" alt="{{$product->product_name}} image">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content pro-details-content-modify">
                        <span>{{$product->category_name}}</span>
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
                        @if($other_info['colors']!=null)
                        <div class="pro-details-color-wrap">
                            <span>Color:</span>
                            <div class="pro-details-color-content">
                                <ul>
                                    @foreach($other_info['colors'] as $color )
                                        <li style="background-color:{{$color}};"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if($other_info['sizes']!=null)
                        <div class="pro-details-size">
                            <span>Size:</span>
                            <div class="pro-details-size-content">
                                <ul>
                                    @foreach($other_info['sizes'] as $size)
                                    <li><a href="#">{{$size}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="pro-details-price-wrap">
                            <div class="product-price">
                                <span>&#2547 {{$product->sale_price}}</span>
                                @if($product->regular_price!=null)
                                <span class="old">&#2547 {{$product->regular_price}}</span>

                            </div>
                            <div class="dec-rang"><span>{{ceil(($product->sale_price-$product->regular_price)/$product->regular_price*100)}}%</span>@endif</div>
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

    <div class="description-review-wrapper pb-90">
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-auto col-lg-10">
                    <div class="dec-review-topbar nav mb-40">
                        <a data-toggle="tab" href="#des-details1">Description</a>
                        <a class="active" data-toggle="tab" href="#Specification">Specification</a>
                        <a data-toggle="tab" href="#des-details3">Reviews</a>
                    </div>
                    <div class="tab-content dec-review-bottom">
                        <div id="des-details1" class="tab-pane">
                            <div class="description-wrap">
                                {!! $product->long_description !!}
                            </div>
                        </div>
                        <div id="Specification" class="tab-pane active">
                            <div class="specification-wrap table-responsive">
                                {!! $product->product_specification !!}
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="dec-review-wrap mb-50">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-5">
                                        <div class="dec-review-img-wrap">
                                            <div class="dec-review-img">
                                                <img src="{{asset('/')}}front_end/assets///images/product-details/review-1.png" alt="review">
                                            </div>
                                            <div class="dec-client-name">
                                                <h4>Jonathon Doe</h4>
                                                <div class="dec-client-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star-half-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-md-7">
                                        <div class="dec-review-content">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                            <div class="review-content-bottom">
                                                <div class="review-like">
                                                    <span><i class="la la-heart-o"></i> 24 Likes</span>
                                                </div>
                                                <div class="review-date">
                                                    <span>25 Jun 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="dec-review-wrap mb-50">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-5">
                                        <div class="dec-review-img-wrap">
                                            <div class="dec-review-img">
                                                <img src="{{asset('/')}}front_end/assets///images/product-details/review-2.png" alt="review">
                                            </div>
                                            <div class="dec-client-name">
                                                <h4>Jonathon Doe</h4>
                                                <div class="dec-client-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star-half-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-md-7">
                                        <div class="dec-review-content">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                            <div class="review-content-bottom">
                                                <div class="review-like">
                                                    <span><i class="la la-heart-o"></i> 24 Likes</span>
                                                </div>
                                                <div class="review-date">
                                                    <span>25 Jun 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dec-review-wrap">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-5">
                                        <div class="dec-review-img-wrap">
                                            <div class="dec-review-img">
                                                <img src="{{asset('/')}}front_end/assets///images/product-details/review-3.png" alt="review">
                                            </div>
                                            <div class="dec-client-name">
                                                <h4>Jonathon Doe</h4>
                                                <div class="dec-client-rating">
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star"></i>
                                                    <i class="la la-star-half-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-md-7">
                                        <div class="dec-review-content">
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                            <div class="review-content-bottom">
                                                <div class="review-like">
                                                    <span><i class="la la-heart-o"></i> 24 Likes</span>
                                                </div>
                                                <div class="review-date">
                                                    <span>25 Jun 2019</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-85">
        <div class="container">
            <div class="section-title-6 mb-50 text-center">
                <h2>Related Product</h2>
            </div>
            <div class="product-slider-active owl-carousel">

{{--   @foreach($all_products as $related_product)--}}
       @for($i=1;$i<=10;$i++)
           @if(count($all_products)>=10){{--$all_product has provider--}}

            @if($product->category_name==$all_products[$i]->category_name&&$all_products[$i]->id!=$product->id)
                <div class="product-wrap">
                    <div class="product-img mb-15">
                        <a href="{{route('single_product',['slug'=>$all_products[$i]->slug,'id'=>$all_products[$i]->id])}}"><img src="{{asset('/').$all_products[$i]->product_image}}" alt="{{$all_products[$i]->product_name}} image"></a>
                        @if($all_products[$i]->regular_price!=null)
                        <span class="price-dec">{{ceil(($all_products[$i]->sale_price-$all_products[$i]->regular_price)/$all_products[$i]->regular_price*100)}}%</span>
                        @endif
                        <div class="product-action">
                            <a data-toggle="modal" data-target="#relatedproduct_{{$all_products[$i]->id}}" title="Quick View" href="#"><i class="la la-plus"></i></a>
                            <a title="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                            <a title="Compare" href="#"><i class="la la-retweet"></i></a>
                        </div>
                    </div>
                    <div class="product-content">
                        <span>{{$all_products[$i]->category_name}}</span>
                        <h4><a href="{{route('single_product',['slug'=>$all_products[$i]->slug,'id'=>$all_products[$i]->id])}}">{{$all_products[$i]->product_name}}</a></h4>
                        <div class="price-addtocart">
                            <div class="product-price">
                                <span>&#2547  {{$all_products[$i]->sale_price}}</span>
                                @if($all_products[$i]->regular_price!=null)
                                    <span class="old">&#2547 {{$all_products[$i]->regular_price}}</span>
                                @endif

                            </div>
                            <div class="product-addtocart">
                                @if($all_products[$i]->product_quantity>0)
                                    <a title="Add To Cart" href="#">+ Add To Cart</a>
                                @else @endif



                            </div>
                        </div>
                    </div>
                </div>
                    @endif
                @endif
                @endfor
{{--                @endforeach--}}

            </div>
        </div>
    </div>

    @foreach($all_products as $related_product)
        @if($product->category_name==$related_product->category_name&&$related_product->id!=$product->id)

            <!-- Modal -->
    <div class="modal fade" id="relatedproduct_{{$related_product->id}}" tabindex="-1" role="dialog">
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
                                    <img src="{{asset('/').$related_product->product_image}}" alt="">
                                </div>
                                <div id="pro-2" class="tab-pane fade">
                                    <img src="{{asset('/')}}front_end/assets/images/product/quickview-l2.jpg" alt="">
                                </div>
                                <div id="pro-3" class="tab-pane fade">
                                    <img src="{{asset('/')}}front_end/assets/images/product/quickview-l3.jpg" alt="">
                                </div>
                                <div id="pro-4" class="tab-pane fade">
                                    <img src="{{asset('/')}}front_end/assets/images/product/quickview-l2.jpg" alt="">
                                </div>
                            </div>
                            <!-- Thumbnail Large Image End -->
                            <!-- Thumbnail Image End -->
{{--                            <div class="quickview-wrap mt-15">--}}
{{--                                <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">--}}
{{--                                    <a class="active" data-toggle="tab" href="#pro-1"><img src="{{asset('/')}}front_end/assets///images/product/quickview-s1.jpg" alt=""></a>--}}
{{--                                    <a data-toggle="tab" href="#pro-2"><img src="{{asset('/')}}front_end/assets///images/product/quickview-s2.jpg" alt=""></a>--}}
{{--                                    <a data-toggle="tab" href="#pro-3"><img src="{{asset('/')}}front_end/assets///images/product/quickview-s3.jpg" alt=""></a>--}}
{{--                                    <a data-toggle="tab" href="#pro-4"><img src="{{asset('/')}}front_end/assets///images/product/quickview-s4.jpg" alt=""></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-details-content quickview-content">
                                <span>{{$related_product->category_name}}</span>
                                <h2>{{$related_product->product_name}}</h2>
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
                                        <span>&#2547  {{$related_product->sale_price}}</span>
                                        @if($related_product->regular_price!=null)
                                            <span class="old">&#2547 {{$related_product->regular_price}}</span>

                                    </div>
                                    <div class="dec-rang"><span>{{ceil(($related_product->sale_price-$related_product->regular_price)/$related_product->regular_price*100)}}%</span>@endif</div>
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
                                    @if($related_product->product_quantity>0)
                                        <a href="#">Add To Cart</a>
                                    @else
                                        <h4 class="text-danger">Out of stock</h4>
                                        <p>Product id:#{{$related_product->category_name.'-p-'.$related_product->id}}</p>
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
    <!-- Modal end -->
        @endif
    @endforeach
{{--</div>--}}
<!-- JS

============================================ -->
<style>#product_menus{display: none;}</style>

@endsection
