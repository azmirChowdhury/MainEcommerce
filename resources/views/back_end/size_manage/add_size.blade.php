@extends('back_end.index')
@section('title')
    Add | size
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add size</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Color & size </a></li>
                            <li class="breadcrumb-item active">Add size</li>
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
                                        <a href="{{route('size')}}" type="button" ><i class="fa fa-arrow-left"></i></a>
                                    </div>
                                    <h4 class="mt-0 header-title">Add size</h4>

                                {{Form::open(['method'=>'POST','route'=>'size_save'])}}

                                <label class="text-muted">Size</label>

                                <input type="text" class="form-control" maxlength="40" value="{{old('size_name')}}" name="size_name"
                                       id="defaultconfig"/>
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
