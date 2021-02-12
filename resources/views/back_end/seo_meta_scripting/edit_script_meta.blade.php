@extends('back_end.index')
@section('title')
    Edit | meta script
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit meta</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item ">Manager</li>
                            <li class="breadcrumb-item active">Add new meta and script</li>
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
                                    <a href="{{route('manage_script')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'edit_update'])}}

                                <h4 class="mt-0 header-title">Edit meta tag /script</h4>

                                <div class="form-group">
                                    <label>Meta tag or Script <a href="https://www.w3schools.com/tags/tag_meta.asp" target="_blank"><i class="fa fa-link"></i></a></label>
                                    <textarea class="form-control" name="tag" placeholder='<meta name="description" content=" "> or <script type="text/javascript>" </script>'>{{old('tag')?old('tag'):$tag->tag}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label>Tag position</label>
                                    <select class="form-control" name="position">
                                        <option value="1" {{$tag->position==1?'selected':''}}>Meta tag</option>
                                        <option value="2" {{$tag->position==2?'selected':''}}>Head</option>
                                        <option value="3" {{$tag->position==3?'selected':''}}>Body top</option>
                                        <option value="4" {{$tag->position==4?'selected':''}}>Body bottom</option>
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
                                    <input type="hidden" name="id" value="{{$tag->id}}">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{$tag->status==1?'selected':''}}>Publish</option>
                                        <option value="0" {{$tag->status==0?'selected':''}}>Unpublished</option>
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
                                        <a href="{{route('manage_script')}}" type="reset"
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


@endsection
