@extends('back_end.index')
@section('title')
    Add | Banner
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add banners</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Appearance</a></li>
                            <li class="breadcrumb-item ">Manager</li>
                            <li class="breadcrumb-item active">Add new banners</li>
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
                                {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>'save_banner'])}}

                                <h4 class="mt-0 header-title">Banners</h4>

                                <div class="form-group">
                                    <label>Banner name</label>
{{--                                    <input type="text" value="{{old('banner_name')}}" name="banner_name"--}}
{{--                                           class="form-control">--}}
                                    <textarea id="editor" name="banner_name"> {{old('banner_name')}}</textarea>
{{--                                    <script>--}}
{{--                                        CKEDITOR.replace('editor', {--}}
{{--                                            height: 250,--}}
{{--                                            extraPlugins: 'colorbutton'--}}
{{--                                        });--}}
{{--                                    </script>--}}

                                </div>
                                <div class="form-group">
                                    <label>Banner image</label>
                                    <input type="file" name="banner_image" class="filestyle"
                                           data-buttonname="btn-primary" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label>Banner role</label>
                                    <select name="banner_role" class="form-control select2" id="role"
                                            onchange="myFunction(this)">
                                        <option value="1">After slider</option>
                                        <option value="2">After featured product</option>
                                        <option value="3">Customer banner</option>
                                        <option value="4">Shop banner</option>
                                        <option value="5">Contact banner</option>
                                        <option value="6">About us banner</option>
                                        <option value="7">Category banner</option>
                                    </select>

                                </div>

                                <div class="form-group" id="slider_button_content">
                                    <label>Category name</label>
                                    <select name="category_id" class="form-control select2">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
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
            document.getElementById("slider_button_content").style.display = element.value ==7 ? 'block' : 'none';
        }

    </script>

@endsection
