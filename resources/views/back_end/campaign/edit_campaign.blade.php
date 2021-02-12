@extends('back_end.index')
@section('title')
    Edit | Campaign
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit campaign</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                            <li class="breadcrumb-item active">Add new Campaign</li>
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
                                        <a href="{{route('index_campaign')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
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
                                {{Form::open(['method'=>'post','route'=>'edit_save_campaign'])}}

                                <h4 class="mt-0 header-title">Edit campaign</h4>
                                <div class="form-group">
                                    <label>Campaign name <sup class="text-danger"> *</sup></label>
                                    <input type="text" name="campaign_name" value="{{old('campaign_name')?old('campaign_name'):$data['campaign']->campaign_name}}" autocomplete="off" class="form-control"  placeholder="Campaign name "/>
                                    <input type="hidden" name="id" value="{{$data['campaign']->id}}"/>
                                </div>


                                <div class="form-group">
                                    <label>Campaign description</label>
                                    <textarea id="editor" name="campaign_description">{{old('campaign_description')?old('campaign_description'):$data['campaign']->campaign_description}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label>Discount type<sup class="text-danger"> *</sup></label>
                                    <select id="discount_type" name="discount_type" class="form-control">
                                        <option value="1" {{old('discount_type')==1?'selected':''}}>Percentage</option>
                                        <option value="2" {{old('discount_type')==2?'selected':''}}>Amount</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Discount amount<sup class="text-danger"> *</sup></label>
                                    <input type="text" name="discount_amount" value="{{old('discount_amount')?old('discount_amount'):$data['campaign']->discount_amount}}" autocomplete="off" class="form-control"  placeholder="Discount amount"/>
                                </div>

                                <div class="form-group">
                                    <label>Campaign date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" value="{{old('start_date')?old('start_date'):$data['campaign']->campaign_start}}" name="start_date" id="date-start" class="form-control floating-label" placeholder="Start Date">
                                            <input type="text" value="{{old('end_date')?old('end_date'):$data['campaign']->campaign_end}}" name="end_date" id="date-end" class="form-control floating-label" placeholder="End Date">
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
                                            <option value="1" {{$data['campaign']->status==1?'selected':''}}>Publish</option>
                                            <option value="0" {{$data['campaign']->status==0?'selected':''}}>Unpublished</option>
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
                                            <div>
                                                @php($camp_cat_id=json_decode($data['campaign']->category_id))
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
                                            @php($camp_pro_id=json_decode($data['campaign']->product_id))
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
