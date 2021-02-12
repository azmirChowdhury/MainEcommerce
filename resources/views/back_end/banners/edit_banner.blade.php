@extends('back_end.index')
@section('title')
    Edit | Banner
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit banners</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Appearance</a></li>
                            <li class="breadcrumb-item ">Manager</li>
                            <li class="breadcrumb-item active">Edit banners</li>
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
                                    <a href="{{route('banners_manage')}}" type="button" class="font-24"><i
                                            class="fa fa-arrow-circle-left"></i></a>
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

                                {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>'edit_save_banner'])}}

                                <h4 class="mt-0 header-title">Banners</h4>

                                <div class="form-group">
                                    <label>Banner name</label>
                                    <input type="text"
                                           value="{{old('banner_name')?old('banner_name'):$banner->banner_name}}"
                                           name="banner_name" class="form-control">
                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <input type="hidden" name="role_id" value="{{$banner->banner_role}}">
                                </div>
                                <div class="form-group">
                                    <label>Banner image</label>
                                    <input type="file" name="banner_image" class="filestyle"
                                           data-buttonname="btn-primary" accept="image/*">
                                    <p>The selected image must be <strong> Width:1170 px and Height:350 px</strong> for good looking. </p>
                                    <br><img src="{{asset('/').$banner->banner_image}}" width="292.5" height="83.5"
                                             alt="banner">
                                </div>

                                <div class="form-group">
                                    <label>Banner role</label>
                                    <select name="banner_role" class="form-control select2" id="role"
                                            onchange="myFunction(this)">
                                        <option value="1" {{$banner->banner_role==1?"selected":''}}>After slider
                                        </option>
                                        <option value="2" {{$banner->banner_role==2?"selected":''}}>After featured
                                            product
                                        </option>
                                        <option value="3" {{$banner->banner_role==3?"selected":''}}>Customer banner
                                        </option>
                                        <option value="4" {{$banner->banner_role==4?"selected":''}}>Shop banner</option>
                                        <option value="5" {{$banner->banner_role==5?"selected":''}}>Contact banner
                                        </option>
                                        <option value="6" {{$banner->banner_role==6?"selected":''}}>About us banner
                                        </option>
                                        <option value="7" {{$banner->banner_role==7?"selected":''}}>Category banner
                                        </option>

                                    </select>

                                </div>

                                <div class="form-group" id="slider_button_content"
                                     style="display:{{$banner->category_id>0?'block':'none'}} !important;">
                                    <label>Category name</label>
                                    <input type="hidden" name="category_value" value="{{$banner->category_id}}">
                                    <select name="category_id" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            @if($banner->category_id==$category->id)
                                                <option value="{{$category->id}}"
                                                        selected>{{$category->category_name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>


                    </div> <!-- end col -->


                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Publication status</h4>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Publish</option>
                                        <option value="0">Unpublished</option>
                                    </select>

                                </div>

                            </div>
                        </div>

                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Action</h4>

                                <div class="form-group">
                                    <label></label>
                                    <div class="m-l-15">
                                        <a href="{{route('banners_manage')}}" type="reset"
                                           class="btn btn-secondary waves-effect m-l-30 ">
                                            Cancel
                                        </a>
                                        <input type="submit" class="btn btn-primary waves-effect m-l-10" value="Save">
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

    <script type="text/javascript">

        function myFunction(element) {
            document.getElementById("slider_button_content").style.display = element.value == 7 ? 'block' : 'none';
        }

    </script>

@endsection
