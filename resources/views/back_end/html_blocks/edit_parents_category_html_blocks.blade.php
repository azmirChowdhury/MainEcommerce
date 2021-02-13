@extends('back_end.index')
@section('title')
    Edit| Blocks
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Blocks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Parents Category Blocks</a></li>
                            <li class="breadcrumb-item active">Edit Blocks</li>
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
                                        <a href="{{route('parents_menu_blocks')}}" type="button" class="font-24"><i
                                                class="fa fa-arrow-circle-left"></i></a>
                                    </div>
                                <h4 class="mt-0 header-title">Edit Blocks</h4>
                                {{Form::open(['method'=>'POST','route'=>'edit_blocks_save'])}}

                                <label class="text-muted">Laval Name</label>

                                <input type="text" class="form-control " maxlength="40" value="{{$block->laval_name}}"
                                       name="laval_name"
                                       id="defaultconfig"/>
                                <input type="hidden" class="form-control" value="{{$block->id}}"
                                       name="id"
                                />
                                <div class="m-t-20">
                                    <div class="form-group">
                                        <label>Parents category</label><br>
                                        <select name="parent_category_id" class="form-control select2">
                                            @foreach($categories as $category)
                                                @if($block->parents_category_id==$category->id)
                                                    <option value="{{$category->id}}"
                                                            selected>{{$category->parents_category_name}}</option>
                                                @endif
                                                @if($block->parents_category_id!==$category->id)
                                                    <option value="{{$category->id}}">{{$category->parents_category_name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="m-t-20">
                                        <div class="form-group">
                                            <label>Status</label><br>
                                            <select name="status" class="form-control">
                                                <option value="1" {{$block->status==1?'selected':''}}>Publish</option>
                                                <option value="0" {{$block->status==0?'selected':''}}>Unpublished
                                                </option>
                                            </select>
                                        </div>


                                        <div class="m-t-10">
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
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
                </div>
            </div>
@endsection
