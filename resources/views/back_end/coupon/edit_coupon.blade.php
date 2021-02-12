@extends('back_end.index')
@section('title')
    Edit | Coupon
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit coupon</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                            <li class="breadcrumb-item active">Add new Coupon</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card m-b-20">

                            <div class="card-body">
                                @if(Session::get('massage'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Good! </strong>{{Session::get('massage')}}.
                                    </div>
                                @endif
                                <div class="m-b-5">
                                    <a href="{{route('index_coupon')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Something wrong! </strong>
                                        <ol>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach

                                        </ol>
                                    </div>
                                @endif
                                {{Form::open(['method'=>'post','route'=>'edit_save_coupon'])}}

                                <h4 class="mt-0 header-title">Edit coupon</h4>
                                <div class="form-group">
                                    <label>Coupon code <sup class="text-danger"> *</sup></label>
                                    <input type="text" name="coupon_code" value="{{old('coupon_code')?old('coupon_code'):$data['coupon']->coupon_code}}" autocomplete="off" class="form-control"  placeholder="Coupon code"/>
                                    <input type="hidden" name="id" value="{{$data['coupon']->id}}" autocomplete="off" class="form-control"  placeholder="Coupon code"/>
                                </div>


                                <div class="form-group">
                                    <label>Coupon description</label>
                                    <textarea id="editor" name="coupon_description">{{old('coupon_description')?old('coupon_description'):$data['coupon']->coupon_description}}</textarea>
                                </div>


                            </div>

                        </div>

                        <div class="card mb-1 m-t-20">

                            <div id="collapseOne" class="collapse show"
                                 aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Coupon Information</h4>

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#General" role="tab">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Uses_restriction" role="tab">Uses restriction</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Uses_limits" role="tab">Uses limits</a>
                                        </li>


                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="General" role="tabpanel">
                                            <div class="form-group">
                                                <label>Discount type</label>
                                                <select name="discount_type" class="form-control" >
                                                    <option value="1" {{$data['coupon']->discount_type==1?'selected':''}}>Percentage</option>
                                                    <option value="0" {{$data['coupon']->discount_type==0?'selected':''}}>Amount</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount amount</label>
                                                <input name="discount_amount" required value="{{old('discount_amount')?old('discount_amount'):$data['coupon']->discount_amount}}" type="text" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Expire date</label>
                                                <input type="text" name="expire_date" value="{{old('expire_date')?old('expire_date'):$data['coupon']->expire_date}}" class="form-control floating-label" placeholder="Date" id="date">
                                            </div>

                                        </div>
                                        <div class="tab-pane p-3" id="Uses_restriction" role="tabpanel">
                                            <div class="form-group">
                                                <label>Minimum spend</label>
                                                <input required type="number" name="minimum_spend" value="{{old('minimum_spend')?old('minimum_spend'):$data['coupon']->minimum_spend}}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>maximum spend</label>
                                                <input required type="number" name="maximum_spend" value="{{old('maximum_spend')?old('maximum_spend'):$data['coupon']->maximum_spend}}" class="form-control">
                                            </div>
                                            <hr>


                                        </div>
                                        <div class="tab-pane p-3" id="Uses_limits" role="tabpanel">
                                            <div class="form-group">
                                                <label>Uses limit per coupon</label>
                                                <input type="number" name="per_coupon" value="{{old('per_coupon')?old('per_coupon'):$data['coupon']->limit_per_coupon}}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Uses limit per User</label>
                                                <input type="number" value="{{old('per_user')?old('per_user'):$data['coupon']->limit_per_user}}" name="per_user"  class="form-control">
                                            </div>

                                        </div>

                                        <div class="tab-pane p-3" id="Attribute" role="tabpanel">

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div> <!-- end col -->



                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Publish</h4>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <select  name="status" class="form-control">
                                            <option value="1" {{$data['coupon']->status==1?'selected':''}}>Publish</option>
                                            <option value="0" {{$data['coupon']->status==0?'selected':''}}>Unpublished</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Category <sup class="text-danger"> *</sup></h4>

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#all_categories" role="tab">All Categories</a>
                                    </li>


                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="all_categories" role="tabpanel">
                                        <div class="form-group">
                                            <label>Category</label>
                                            @if(Session::get('info'))
                                                <p class="text-danger">{{Session::get('info')}}</p>
                                            @endif
                                            @php($camp_cat_id=json_decode($data['coupon']->category_id))
                                            <div>
                                                <select  name="category[]" class="form-control select2" multiple>
                                                    @foreach($data['categories'] as $category)
                                                        @if($camp_cat_id!=null)
                                                            @if(in_array($category->id,$camp_cat_id)==true)
                                                                <option value="{{$category->id}}" selected>{{$category->category_name}}</option>
                                                            @else
                                                                <option value="{{$category->id}}" >{{$category->category_name}}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{$category->id}}" >{{$category->category_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>


                        </div>


                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Product name<sup class="text-danger"> *</sup></h4>

                                <div class="form-group">
                                    <label>Product name</label>
                                    <div>
                                        <select  name="product[]" class="form-control select2" multiple>
                                            @php($camp_pro_id=json_decode($data['coupon']->product_id))
                                            @foreach($data['products'] as $product)
                                                @if($camp_pro_id!=null)
                                                    @if(in_array($product->id,$camp_pro_id)==true)
                                                        <option value="{{$product->id}}" selected>{{$product->product_name}}</option>
                                                    @else
                                                        <option value="{{$product->id}}" >{{$product->product_name}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$product->id}}" >{{$product->product_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="card m-b-20 col-lg-10">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-group m-b-0 d-flex ">
                                            <a href="{{route('index_campaign')}}" type="reset" class="btn btn-secondary waves-effect m-l-30 ">
                                                Cancel
                                            </a>
                                            {{--                                                <a href="" type="submit" class="btn btn-info waves-effect m-l-10">--}}
                                            {{--                                                    Save product--}}
                                            {{--                                                </a>--}}
                                            <input type="submit" class="btn btn-info waves-effect m-l-10" value="save">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                {{Form::close()}}

            </div>

            <!-- end page content-->
        </div> <!-- container-fluid -->

    </div>


@endsection
