@extends('back_end.index')
@section('title')
    Edit | Notes
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit notes</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item ">Purchase settings</li>
                            <li class="breadcrumb-item ">Notes</li>
                            <li class="breadcrumb-item active">Edit note</li>
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
                                    <a href="{{route('purchase_settings')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'notes_edit_save'])}}

                                <h4 class="mt-0 header-title">Edit note</h4>


                                    <div class="form-group">
                                        <label>Select role</label>
                                        <select name="role" class="form-control" >
                                            <option value="1" {{$note->role==1?'selected':''}}>Footer description</option>
                                            <option value="2" {{$note->role==2?'selected':''}}>Shipping information</option>
                                        </select>
                                    </div>
                                    <input type="hidden" value="{{$note->id}}" name="id">
                                    <div class="form-group">
                                        <label>Enter your description</label>
                                        <textarea id="editor" name="description" placeholder="Enter your text">{{old('description')?old('description'):$note->description}}</textarea>
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
                                        <option value="1" {{$note->status==1?'selected':''}}>Publish</option>
                                        <option value="0" {{$note->status==0?'selected':''}}>Unpublished</option>
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
                                        <a href="{{route('purchase_settings')}}" type="reset"
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
