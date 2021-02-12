@extends('back_end.index')
@section('title')
    Add | Product
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add new product</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                            <li class="breadcrumb-item active">Add new product</li>
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
                                        <a href="{{route('manage_products')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
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
                                    {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>'all_save_product'])}}

                                    <h4 class="mt-0 header-title">Add new product</h4>
                                    <div class="form-group">
                                        <label>Product name <sup class="text-danger"> *</sup></label>
                                        <input type="text" name="product_name" value="{{old('product_name')}}" autocomplete="off" class="form-control" required placeholder="Product Name"/>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label>Product Slug <sup class="text-danger"> *</sup></label>--}}
{{--                                        <input type="text" name="slug" value="{{old('slug')}}" autocomplete="off" class="form-control" required placeholder="product-Slug"/>--}}
{{--                                    </div>--}}


                                    <div class="form-group">
                                        <label>Product Specification</label>
                                        <textarea id="editor" name="product_specification">{{old('product_specification')}}</textarea>
                                    </div>
                            </div>
                        </div>

                        <div id="accordion">
                            <div class="card mb-1">
                                <div class="card-header p-3" id="headingOne">
                                    <h6 class="m-0 font-14">
                                        <a href="#collapseOne" class="text-dark" data-toggle="collapse"
                                           aria-expanded="true"
                                           aria-controls="collapseOne">
                                            Currency <sup class="text-danger"> *</sup> <i class="fa fa-angle-up float-lg-right"></i>
                                        </a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse show"
                                     aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="form-group">
                                           <select required name="currency" class="form-control">
                                               <option value="bt">BDT</option>
                                               <option value="ud">USD</option>
                                           </select>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1 m-t-20">

                            <div id="collapseOne" class="collapse show"
                                 aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Product data</h4>

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#General" role="tab">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Inventory" role="tab">Inventory</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Shipping" role="tab">Shipping</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Attribute" role="tab">Attribute</a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3" id="General" role="tabpanel">
                                            <div class="form-group">
                                                <label>Regular price</label>
                                                <input name="regular_price" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Sale price</label>
                                                <input name="sale_price" required value="{{old('sale_price')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="tab-pane p-3" id="Inventory" role="tabpanel">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input required type="number" name="product_quantity" value="{{old('product_quantity')}}" class="form-control">
                                            </div>

                                        </div>
                                        <div class="tab-pane p-3" id="Shipping" role="tabpanel">
                                            <div class="form-group">
                                                <label>Weight (kg)</label>
                                                <input type="text" name="product_weight"  class="form-control">
                                            </div>
                                            <label>Dimension (cm)</label>
                                            <div class="form-group">
                                                <input type="text" name="product_length" placeholder="Length"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="product_width" placeholder="Width"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="product_height" placeholder="Height"  class="form-control">
                                            </div>

                                        </div>

                                        <div class="tab-pane p-3" id="Attribute" role="tabpanel">

                                            <div class="form-group">
                                                <label class="control-label">Size</label>

                                                <select name="size[]" class="select2 form-control select2-multiple" multiple data-placeholder="Choose size ...">
                                                    @foreach($sizes as $size)
                                                        <option value="{{$size->Size}}">{{$size->Size}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Color</label>

                                                <select name="color[]" class="select2 form-control select2-multiple" multiple data-placeholder="Choose color ...">

                                                    @foreach($colors as $color)
                                                        <option value="{{$color->color_name}}"  >{{$color->color_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card m-b-20 m-t-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Product information</h4>

                                    <div class="form-group">
                                        <label>Product Image<sup class="text-danger"> *</sup></label>
                                        <input type="file" required name="product_image" class="filestyle" data-buttonname="btn-info">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="elm1" name="long_description">{{old('long_description')}}</textarea>
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
                                            <option value="1" selected>Publish</option>
                                            <option value="0">Unpublished</option>
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
                                            <div>
                                                <select  name="category_name" class="form-control select2">
                                                    @foreach($data['categories'] as $category)
                                                    <option value="{{$category->category_name}}" {{$category->category_name==old('category_name')?'selected':''}}>{{$category->category_name}}</option>
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

                                <h4 class="mt-0 header-title">Brand<sup class="text-danger"> *</sup></h4>

                                <div class="form-group">
                                    <label>Brand name</label>
                                    <div>
                                        <select  name="brand_name" class="form-control select2">
                                            @foreach($data['brands'] as $brand)
                                            <option value="{{$brand->brand_name}}" {{$brand->brand_name==old('brand_name')?'selected':''}}>{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

{{--                        <div class="card m-b-20">--}}
{{--                            <div class="card-body">--}}

{{--                                <h4 class="mt-0 header-title">Tag</h4>--}}

{{--                                <div class="form-group">--}}
{{--                                    <label>Select Tag</label>--}}
{{--                                    <div class="form-group">--}}

{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <div class="form-group">--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Product image gallery</h4>

                                <div class="form-group">
                                    <label>Gallery image select</label>
                                    <div class="form-group">
                                        <input type="file" name="product_gallery_images[]" class="filestyle" data-input="false" data-buttonname="btn-secondary" multiple>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card m-b-20 col-lg-10">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-group m-b-0 d-flex ">
                                                <a href="{{url('/dashboard')}}" type="reset" class="btn btn-secondary waves-effect m-l-30 ">
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



    <script>
        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    menubar: false,
                    statusbar: false,
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:200,
                    plugins: [
                        // "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        // "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>


@endsection
