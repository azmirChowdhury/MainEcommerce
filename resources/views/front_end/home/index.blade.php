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
                                            <h2>{!!$slider_bottom_banner->banner_name!!}</h2>
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
    @if(count($feature_category)>=1)
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

                                <a href="#all_feature_category" class="active" data-toggle="tab">
                                    <h5>Featured products</h5>
                                </a>

                                @foreach($feature_category as $fpc)
                                    <a href="#feature_category-{{$fpc->id}}" data-toggle="tab">
                                        <h5>{{$fpc->category_name}}</h5>
                                    </a>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content jump">

                    <div id="all_feature_category" class="tab-pane active">

                        <div class="product-slider-active owl-carousel">
                            @foreach($all_products as $feature_product)
                                <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                    <div class="product-img">
                                        <a href="{{route('single_product',['slug'=>$feature_product->slug,'id'=>$feature_product->id])}}"><img
                                                src="{{asset('/').$feature_product->product_image}}"
                                                alt="product{{$feature_product->product_name}}"></a>
                                        @if($feature_product->regular_price!=null)
                                            <span class="price-dec">{{ceil(($feature_product->sale_price-$feature_product->regular_price)/$feature_product->regular_price*100)}}%</span>
                                        @endif
                                        @php
                                            $d=$feature_product->created_at->addDay(3);
                                        @endphp
                                        @if(date('d')<=$d->day&&$d->month==date('m')&&$d->year==date('Y'))
                                            <span class="price-dec font-dec bg-success">NEW</span>
                                        @endif
                                        <div class="product-action-4">
                                            <div class="product-action-4-style">
                                                <a data-tooltip="Add To Cart" href="#"><i
                                                        class="la la-cart-plus"></i></a>
                                                <a data-tooltip="Wishlist" href="#"><i class="la la-heart-o"></i></a>
                                                <a data-tooltip="Compare" href="#"><i class="la la-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content product-content-padding">
                                        <h4>
                                            <a href="{{route('single_product',['slug'=>$feature_product->slug,'id'=>$feature_product->id])}}">{{$feature_product->product_name}}</a>
                                        </h4>
                                        <div class="price-addtocart">
                                            <div class="product-price">
                                                <span>&#2547 {{$feature_product->sale_price}}</span>
                                                @if($feature_product->regular_price!=null)
                                                    <span class="old">&#2547 {{$feature_product->regular_price}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    @foreach($feature_category as $fpc)
                        <div id="feature_category-{{$fpc->id}}" class="tab-pane">

                            <div class="product-slider-active owl-carousel">
                                @foreach($all_products as $feature_product)
                                    @if($fpc->id==$feature_product->category_id)

                                        <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                            <div class="product-img">
                                                <a href="{{route('single_product',['slug'=>$feature_product->slug,'id'=>$feature_product->id])}}"><img
                                                        src="{{asset('/').$feature_product->product_image}}"
                                                        alt="product"></a>
                                                @if($feature_product->regular_price!=null)
                                                    <span class="price-dec">{{ceil(($feature_product->sale_price-$feature_product->regular_price)/$feature_product->regular_price*100)}}%</span>
                                                @endif
                                                @php
                                                    $d=$feature_product->created_at->addDay(3);
                                                @endphp
                                                @if(date('d')<=$d->day&&$d->month==date('m')&&$d->year==date('Y'))
                                                    <span class="price-dec font-dec bg-success">NEW</span>
                                                @endif
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
                                                    <a href="{{route('single_product',['slug'=>$feature_product->slug,'id'=>$feature_product->id])}}">{{$feature_product->product_name}}</a>
                                                </h4>
                                                <div class="price-addtocart">
                                                    <div class="product-price">
                                                        <span>&#2547 {{$feature_product->sale_price}}</span>
                                                        @if($feature_product->regular_price!=null)
                                                            <span
                                                                class="old">&#2547 {{$feature_product->regular_price}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            </div>

                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    @endif

    <div class="banner-area pt-30 pb-100">
        @foreach($BannersShow as $featured_bottom_slider)
            @if($featured_bottom_slider->banner_role==2)
                <div class="container">
                    <div class="bg-img pt-100 pb-100 learn-banner"
                         style="background-image:url({{asset('/').$featured_bottom_slider->banner_image}});">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-11">
                                <div class="banner-content">
                                    <h2>{!! $featured_bottom_slider->banner_name !!}</h2>
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

                                <a href="#category_product-{{$category_all->id}}" data-toggle="tab">
                                    <h5>{{$category_all->category_name}}</h5>
                                </a>
                                {{--                              @endfor--}}
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content jump">
                <?php
                use App\Models\ProductModel;
                ?>
                @foreach($category_all_product as $pCategory)
                    <div id="category_product-{{$pCategory->id}}" class="tab-pane">
                        <div class="row">
                            <?php
                            $produduct_cateogry_all = ProductModel::where('status', 1)
                                ->where('category_id', $pCategory->id)
                                ->orderBy('id', 'DESC')
                                ->limit(8)
                                ->get();
                            foreach ($produduct_cateogry_all as $products){
                            $d=$products->created_at->addDay(3);
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="product-wrap product-border-3 product-img-zoom mb-30">
                                    <div class="product-img">
                                        <a href="{{route('single_product',['slug'=>$products->slug,'id'=>$products->id])}}"><img
                                                src="{{asset('/').$products->product_image}}"
                                                alt="product {{$products->product_name}}"></a>

                                        @if(date('d')<=$d->day&&$d->month==date('m')&&$d->year==date('Y'))
                                            <span class="price-dec font-dec bg-success">NEW</span>
                                        @endif

                                        @if($products->regular_price!=null)
                                            <span class="price-dec">{{ceil(($products->sale_price-$products->regular_price)/$products->regular_price*100)}}%</span>
                                        @endif
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

                            <?php } ?>

                        </div>
                        @if(count($produduct_cateogry_all)>=8)
                            <div class="section-title-6 mb-50 text-center">
                                <a href="{{route('category_show_product',['slug'=>$pCategory->slug,'id'=>$pCategory->id,'paginate'=>30])}}"
                                   class="btn btn"
                                   style="color:#FFFFFF;background-color:#ff5151">All product</a>
                            </div>
                        @endif
                        @if(count($produduct_cateogry_all)<=0)
                            <h4 class="text-danger text-center">Product not found</h4>
                        @endif
                        <div>
                        </div>
                    </div>
                    {{--                @endif--}}

                @endforeach
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
                                            @if($all_products[$i]->regular_price!=null)
                                                <span class="price-dec">{{ceil(($all_products[$i]->sale_price-$all_products[$i]->regular_price)/$all_products[$i]->regular_price*100)}}%</span>
                                            @endif
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
