@extends('front_end.index')
@section('front_title')
    {{$shop_category->category_name}}  | {{env('app_name')}}
@endsection
@section('mates')
    <meta name="addsearch-category" content="{{$shop_category->category_name}}" />

@endsection

@section('home_body')

    <script type="text/javascript">
        $(document).ready(function (){
            $('#search_shop').on('keyup',function (){
                var search_shop=$('#search_shop').val();
                var category_id=$('#cat_id').val();
                $.ajax({

                    url:'{{$mainUrl}}/search-suggestion/load-ajax',
                    type:"GET",
                    data:'search_shop='+search_shop+'&category_id='+category_id,
                    success:function(data){
                       $('#d_list_id').html(data)
                    }

                })


            })



        })
    </script>


    @foreach($BannersShow as $banner_single)

        @if($banner_single->banner_role==7)
            @if($banner_single->category_id==$shop_category->id)
                <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$banner_single->banner_image}});">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h2>{!! $banner_single->banner_name!!}</h2>
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

                            <p>Showing {{$products_shop->currentPage()}}  - {{$products_shop->lastpage()}}  </p>

                        </div>
                        <div class="product-sorting-wrapper">
                            <div class="product-shorting shorting-style">
                                <label>View:</label>
                                {{Form::open(['method'=>'post','id'=>'view_p','route'=>'view_paginate'])}}
                                <select name="paginate_value" onchange="document.getElementById('view_p').submit()">
                                    <option value="10" {{request()->paginate==10?'selected':''}}>10</option>
                                    <option value="20" {{request()->paginate==20?'selected':''}}>20</option>
                                    <option value="25" {{request()->paginate==25?'selected':''}}>25</option>
                                    <option value="30" {{request()->paginate==30?'selected':''}}>30</option>
                                    <option value="40" {{request()->paginate==40?'selected':''}}>40</option>
                                </select>
                                <input type="hidden" name="id" value="{{$shop_category->id}}">
                                {{Form::close()}}

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <h2 class="text-danger">{{$error}}</h2>
                                    @endforeach
                                @endif
                            </div>
                            <div class="product-show shorting-style">
                                <label>Sort by:</label>
                                <select>
                                    <option value="#">Default</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">

                                    @foreach(isset($products_s)?$products_s:$products_shop as $product)

                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="product-wrap mb-35">
                                            <div class="product-img mb-15">
                                                <a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}"><img src="{{asset('/').$product->product_image}}" alt="{{$product->product_name.'image '.env('app_name')}}"></a>
                                                    @if(gettype($product->created_at)=='object')
                                                @php
                                                    $d=$product->created_at;
                                                @endphp
                                                @if(date('d')<=$d->day&&$d->month==date('m')&&$d->year==date('Y'))
                                                    <span class="price-dec font-dec bg-success">NEW</span>
                                                @endif
                                                @endif
                                                @if($product->product_quantity>0)
                                                    @if($product->regular_price!=null)
                                                        <span class="price-dec">{{ceil(($product->sale_price-$product->regular_price)/$product->regular_price*100)}}%</span>
                                                    @endif
                                                @else
                                                    <span class="new-stock"><span>Stock <br>Out</span></span>
                                                @endif
                                                <div class="product-action">
                                                    <a data-toggle="modal" data-target="#product{{$product->id.$shop_category->id}}" title="Quick View" href="#"><i class="la la-plus"></i></a>
                                                    <a title="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                    <a title="Compare" href="#"><i class="la la-retweet"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <span>{{$shop_category->category_name}}</span>
                                                <h4><a href="{{route('single_product',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->product_name}}</a></h4>
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

                                    @endforeach

                                </div>
                            </div>
                            <div id="shop-2" class="tab-pane">

                                @foreach($products_shop as $product)
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

                                        @endforeach
                            </div>

@if(count($products_shop)!=0)
                            <div class="pagination-style text-center">
                                <ul>
                                    @if(!$products_shop->onFirstPage() )
                                        @if(!$products_shop->hasMorePages()==0||$products_shop->hasMorePages()==0)
                                            <li><a class="prev" href="{{$products_shop->previousPageUrl()}}"><i class="la la-angle-left"></i></a></li>
                                        @endif
                                    @endif

                                    @for($i=1;$i<=$products_shop->lastPage();$i++)

                                        @if($i==$products_shop->currentPage())

                                            <li><a class="active" href="{{$products_shop->url($i)}}">{{$i}}</a></li>
                                        @else
                                            <li><a href="{{$products_shop->url($i)}}">{{$i}}</a></li>
                                        @endif


                                    @endfor
                                    @if($products_shop->hasMorePages())
                                        <li><a class="next" href="{{$products_shop->nextPageUrl()}}"><i class="la la-angle-right"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            @else
                                <h3 class="text-danger text-center">Product not found</h3>
                            @endif

                        </div>
                    </div>
                </div>




                <div class="col-lg-3">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Search </h4>
                            <div class="sidebar-search mb-40 mt-20">
                                    {{Form::open(['method'=>'get','class'=>'sidebar-search-form','url'=>'search-shop-product-'.request()->paginate])}}
                                    <input type="text" list="search_value" value="{{isset($search_data)?$search_data:''}}" name="search_shop" id="search_shop" placeholder="Search here...">
                                    <input type="hidden" name="cat_id" id="cat_id" value="{{$shop_category->id}}">
                                    <div id="d_list_id">
                                    </div>
                                    <button>
                                        <i class="la la-search"></i>
                                    </button>

                               {{Form::close()}}
                            </div>
                        </div>
                        <div class="sidebar-widget shop-sidebar-border pt-40">
                            <h4 class="sidebar-title">Shop By Categories</h4>
                            <div class="shop-catigory mt-20">
                                <ul id="faq">
                                   @foreach($blocks as $block)
                                    <li> <a data-toggle="collapse" data-parent="#faq" href="#shop-catigory-{{$block->id}}">{{$block->laval_name}}<i class="la la-angle-down"></i></a>
                                        <ul id="shop-catigory-{{$block->id}}" class="panel-collapse collapse {{$shop_category->collum_id==$block->id?'show':''}}">
                                            @foreach($scategories as $cat)
                                            @if($cat->collum_id==$block->id)
                                              <li><a class="text-{{$cat->id==$shop_category->id?'danger':''}}" href="{{route('category_show_product',['slug'=>$cat->slug,'id'=>$cat->id,'paginate'=>30])}}">{{$cat->category_name}}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="shop-price-filter mt-35 shop-sidebar-border pt-40 sidebar-widget">
                            <h4 class="sidebar-title">Price Filter</h4>
                            {{Form::open(['method'=>'get','url'=>'price-range/'.request()->paginate.'/shop','id'=>'range_id'])}}
                            <div class="price-filter mt-20">
                                <span>Range:  &#2547 0 - &#2547 1.200.00 </span>
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">

                                        <input type="text" id="amount" name="price"  placeholder="Add Your Price" />

                                        <input type="hidden" id="min" name="min"  value="{{isset($max_p)?$min_p:0}}"/>
                                        <input type="hidden" id="max" name="max" value="{{isset($max_p)?$max_p:120000}}" />
                                        <input type="hidden"  name="paginate_v" value="{{request()->paginate}}" />
                                        <input type="hidden" name="category_id" value="{{$shop_category->id}}" />
                                    </div>

                                    <button type="button" onclick="document.getElementById('range_id').submit()">Filter</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>

{{--                        <div class="sidebar-widget shop-sidebar-border pt-40 mt-40">--}}
{{--                            <h4 class="sidebar-title">Refine By </h4>--}}
{{--                            <div class="sidebar-widget-list mt-20">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox"> <a href="#">On Sale <span>4</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">New <span>5</span></a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">In Stock <span>6</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">--}}
{{--                            <h4 class="sidebar-title">Colour </h4>--}}
{{--                            <div class="sidebar-widget-list mt-20">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">Green <span>7</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">Cream <span>8</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">Blue <span>9</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">Black <span>3</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">--}}
{{--                            <h4 class="sidebar-title">Size </h4>--}}
{{--                            <div class="sidebar-widget-list mt-20">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">XL <span>4</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">L <span>5</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">SM <span>6</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="sidebar-widget-list-left">--}}
{{--                                            <input type="checkbox" value=""> <a href="#">XXL <span>7</span> </a>--}}
{{--                                            <span class="checkmark"></span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="sidebar-widget pt-40 mt-40 shop-sidebar-border">--}}
{{--                            <h4 class="sidebar-title">Popular Tags </h4>--}}
{{--                            <div class="sidebar-widget-tag mt-20">--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Clothing</a></li>--}}
{{--                                    <li><a href="#">Accessories</a></li>--}}
{{--                                    <li><a href="#">For Men</a></li>--}}
{{--                                    <li><a href="#">Women</a></li>--}}
{{--                                    <li><a href="#">Fashion</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($products_shop as $product)

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
<style>#product_menus{display: none;}</style>
@endsection
@section('bottom_scrtpt')
    <script type="text/javascript">
        $(document).ready(function(){

            var sl = $('#slider-range');
            var sp = $('#amount');
            sl.slider({
                values: [{{isset($min_p)?$min_p:0}},{{isset($max_p)?$max_p:120000}}],
            })
            sp.val("৳ " + sl.slider("values", 0) +
                " - ৳ " + sl.slider("values", 1));
        });
    </script>
@endsection

