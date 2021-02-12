@extends('back_end.index')
@section('title')
    Logo and Background
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Logo and background manage</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Appearance</a></li>
                            <li class="breadcrumb-item active">Appearance manage</li>
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
                                {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>!empty($appearance_image->id)?'update_logo_other':'new_appearance'])}}

                                <h4 class="mt-0 header-title">Logo & background management</h4>

                                    <div class="form-group">
                                        <label>Logo image</label>
                                        <input type="file" name="logo_image" class="filestyle" data-buttonname="btn-primary" accept="image/*">
                                        @if(!empty($appearance_image->id))
                                        <input type="hidden" name="id" value="{{$appearance_image->id}}">
                                        <input type="hidden" name="DB_logo" value="{{$appearance_image->logo}}">
                                        <br>
                                        <img src="{{asset('/').$appearance_image->logo}}" width="200px" height="200px" alt="Logo image">
                                        @endif
                                    </div>
                                        <div class="form-group">
                                        <label>background image</label>
                                        <input type="file" name="background_image" class="filestyle" data-buttonname="btn-primary" accept="image/*">
                                           <br>
                                            @if(!empty($appearance_image->id))
                                            <img src="{{asset('/').$appearance_image->background_image}}" width="200px" height="200px" alt="background image">
                                            <input type="hidden" name="background_image_DB" value="{{$appearance_image->background_image}}">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                        <label>Fav icon</label>
                                        <input type="file" name="fav_icon" class="filestyle" data-buttonname="btn-primary" accept="image/*">
                                            <br>
                                            @if(!empty($appearance_image->id))
                                            <img src="{{asset('/').$appearance_image->fav_icon}}" width="30px" height="30px" alt="Fav icon image">
                                            <input type="hidden" name="favicon_large" value="{{$appearance_image->fav_icon}}">
                                            <input type="hidden" name="favicon_small_img" value="{{$appearance_image->fav_icon_small}}">
                                            @endif
                                    </div>



                            </div>

                        </div>



                    </div> <!-- end col -->



                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Action</h4>

                                <div class="form-group">
                                    <label></label>
                                    <div>
                                        <input type="submit" class="btn btn-primary waves-effect m-l-10 btn-block" value="{{!empty($appearance_image->id)?'Update':'Save'}}">
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
