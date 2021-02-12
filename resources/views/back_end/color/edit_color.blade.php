@extends('back_end.index')
@section('title')
    Edit | Color
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit color</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Color & size </a></li>
                            <li class="breadcrumb-item active">Edit color</li>
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
                                <div class="m-b-5">
                                    <a href="{{route('color')}}" type="button" ><i class="fa fa-arrow-left"></i></a>
                                </div>
                                <h4 class="mt-0 header-title">Edit color</h4>

                                {{Form::open(['method'=>'POST','route'=>'update_color'])}}

                                <label class="text-muted">Color name</label>

                                <input type="text" class="form-control" maxlength="40" value="{{old('color_name')?old('color_name'):$color->color_name}}" name="color_name"
                                       id="defaultconfig"/>
                                    <input type="hidden" name="id" value="{{$color->id}}"/>
                                <div class="color-picker-inputs">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <div id="colorpicker-color-pattern" data-format="alias" class="input-group colorpicker-component">
                                            <input type="text" class="form-control" name="color" value="{{old('color')?old('color'):$color->color}}" placeholder="Select color or enter color code with #"/>

                                            <span class="input-group-append add-on">
                                                    <button class="btn btn-white" type="button">
                                                        <i style="margin-top: 2px;">C</i>
                                                    </button>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-10">
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
