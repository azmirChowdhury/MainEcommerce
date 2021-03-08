@extends('front_end.index')
@section('front_title')
    All products | {{env('app_name')}}
@endsection
@section('mates')
    {{--    <meta name="addsearch-category" content="{{$shop_category->category_name}}" />--}}

@endsection

@section('home_body')


    @foreach($BannersShow as $customerBanner)
        @if($customerBanner->banner_role==3)
            <div class="breadcrumb-area bg-img"
                 style="background-image:url({{asset('/').$customerBanner->banner_image}});">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <h2>All products</h2>
                        <ul>
                            <li>
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="active">All products</li>
                        </ul>
                    </div>
                </div>
            </div>

        @endif
    @endforeach



    <div class="shop-area pt-90 pb-90">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-topbar-wrapper">
                        <div class="shop-topbar-left">
                            <div class="view-mode nav">
                                <a class="active" href="#shop-1" data-toggle="tab"><i class="la la-th"></i></a>
                                <a href="#shop-2" data-toggle="tab"><i class="la la-list-ul"></i></a>
                            </div>
                            <p>Showing {{$all_products_shop->currentPage()}}  - {{$all_products_shop->lastpage()}}  page</p>
                        </div>
                        <div class="product-sorting-wrapper">

                            <div class="product-show shorting-style">
                                <label>Sort by:</label>
                                <select>
                                    <option value="">Default</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">


                                    @foreach($all_products_shop as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="product-wrap mb-35">
                                                <div class="product-img mb-15">
                                                    <a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}"><img
                                                            src="{{asset('/').$product->product_image}}"
                                                            alt="product"></a>
                                                    @php
                                                        $d=$product->created_at->addDay(3);
                                                    @endphp
                                                    @if(date('d')<=$d->day&&$d->month==date('m')&&$d->year==date('Y'))
                                                        <span class="price-dec font-dec bg-success">NEW</span>
                                                    @endif
                                                    @if($product->product_quantity>0)
                                                    @if($product->regular_price!=null)
                                                        <span class="price-dec">{{ceil(($product->sale_price-$product->regular_price)/$product->regular_price*100)}}%</span>
                                                    @endif
                                                    @else
                                                        <span class="new-stock"><span>Stock <br>Out</span></span>
                                                    @endif
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#product{{$product->id}}"
                                                           title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                        <a title="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                        <a title="Compare" href="#"><i class="la la-retweet"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <span>{{$product->category_name}}</span>
                                                    <h4><a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->product_name}}</a></h4>
                                                    <div class="price-addtocart">
                                                        <div class="product-price">
                                                            <span>&#2547 {{$product->sale_price}}</span>
                                                            @if($product->regular_price!=null)
                                                                <span
                                                                    class="old">&#2547 {{$product->regular_price}}</span>
                                                            @endif</div>
                                                        <div class="product-addtocart">
                                                            <a title="Add To Cart" href="#">+ Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                            <div id="shop-2" class="tab-pane">
                                <div class="row">
                                    @foreach($all_products_shop as $product)
                                    <div class="col-lg-6">
                                        <div class="shop-list-wrap mb-30">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6">
                                                    <div class="product-list-img">
                                                        <a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">
                                                            <img
                                                                src="{{asset('/').$product->product_image}}"
                                                                alt="Product Style">
                                                        </a>
                                                        <div class="product-list-quickview">
                                                            <a data-toggle="modal" data-target="#product{{$product->id}}"
                                                               title="Quick View" href="#"><i
                                                                    class="la la-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6">
                                                    <div class="shop-list-content">
                                                        <span>{{$product->category_name}}</span>
                                                        <h4><a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->product_name}}</a>
                                                        </h4>
                                                        <div class="pro-list-price">
                                                            <span>&#2547 {{$product->sale_price}}</span>
                                                            @if($product->regular_price!=null)
                                                                <span
                                                                    class="old">&#2547 {{$product->regular_price}}</span>
                                                            @endif </div>
                                                        <p>{!!  $product->long_description!!}</p>
                                                        <div class="product-list-action">
                                                            <a title="Wishlist" href="#"><i
                                                                    class="la la-heart-o"></i></a>
                                                            <a title="Compare" href="#"><i
                                                                    class="la la-retweet"></i></a>
                                                            <a title="Add To Cart" href="#"><i
                                                                    class="la la-shopping-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="pagination-style text-center">
                                <ul>
                                    @if(!$all_products_shop->onFirstPage() )
                                        @if(!$all_products_shop->hasMorePages()==0||$all_products_shop->hasMorePages()==0)
                                            <li><a class="prev" href="{{$all_products_shop->previousPageUrl()}}"><i class="la la-angle-left"></i></a></li>
                                        @endif
                                    @endif

                                    @for($i=1;$i<=$all_products_shop->lastPage();$i++)

                                        @if($i==$all_products_shop->currentPage())

                                            <li><a class="active" href="{{$all_products_shop->url($i)}}">{{$i}}</a></li>
                                        @else
                                            <li><a href="{{$all_products_shop->url($i)}}">{{$i}}</a></li>
                                        @endif


                                    @endfor
                                    @if($all_products_shop->hasMorePages())
                                        <li><a class="next" href="{{$all_products_shop->nextPageUrl()}}"><i class="la la-angle-right"></i></a></li>
                                    @endif</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($all_products_shop as $product)

        <div class="modal fade" id="product{{$product->id}}" tabindex="-1" role="dialog">
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

                                    <div class="pro-details-price-wrap">
                                        <div class="product-price">
                                            <span>&#2547  {{$product->sale_price}}</span>
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
            </div>
        </div>
    @endforeach
    <style>#product_menus {
            display: none;
        }</style>
@endsection



