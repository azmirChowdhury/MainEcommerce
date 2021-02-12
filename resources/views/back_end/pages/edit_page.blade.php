@extends('back_end.index')
@section('title')
    Edit page
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit page</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Edit page</li>
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
                                    <a href="{{route('manage_page')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'save_edit_page'])}}

                                <h4 class="mt-0 header-title">Edit page</h4>

                                <div class="form-group">
                                    <label>Page name</label>
                                    <input type="text" name="page_name" value="{{old('page_name')?'':$page->page_name}}" class="form-control" placeholder="Enter your page name">
                                        <input type="hidden" name="id" value="{{$page->id}}">
                                </div>

                                <div class="form-group">
                                    <label>Footer collum</label>
                                    <select class="form-control" name="collum_id">
                                        <option value="1" {{$page->collum_id==1?'selected':''}}>Company</option>
                                        <option value="2" {{$page->collum_id==2?'selected':''}}>Products</option>
                                        <option value="3" {{$page->collum_id==3?'selected':''}}>Helps</option>
                                        <option value="4" {{$page->collum_id==4?'selected':''}}>Social Network</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="editor" rows="15" name="description">{{old('description')?:$page->description}}</textarea>
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
                                        <option value="1" {{$page->status==1?'selected':''}}>Publish</option>
                                        <option value="0" {{$page->status==0?'selected':''}}>Unpublished</option>
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
                                        <a href="{{route('manage_page')}}" type="reset"
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
    CKEDITOR.editorConfig = function( config ) {
        config.resize_enabled = true;
    };
</script>
@endsection
