@extends('back_end.index')
@section('title')
    Add | Brands
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Brand</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Parents Category</a></li>
                            <li class="breadcrumb-item active">Add Brand</li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
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

                                <h4 class="mt-0 header-title">Add Brands</h4>
                                {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>'save_brand'])}}
                                <label class="text-muted">Brands Name</label>

                                <input type="text" class="form-control" maxlength="40" name="brand_name"
                                       id="defaultconfig" value="{{old('brand_name')}}"/>

                                <div class="m-t-20">
                                    <div class="m-t-20">

                                        <div class="m-t-20">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="brand_image" class="filestyle form-control"
                                                       data-buttonname="btn-secondary" accept="image/*">
                                                <p>File must be image and image size maximum 5MB</p>
                                            </div>
                                        </div>

                                        <div class="m-t-20">
                                            <div class="form-group">
                                                <label>Status</label><br>
                                                <select name="status" class="form-control">
                                                    <option value="1" selected>Publish</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                            </div>


                                            <div class="m-t-10">
                                                <div class="form-group">
                                                    <div>
                                                        <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">
                                                            Save brand
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
