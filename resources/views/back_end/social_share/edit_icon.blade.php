@extends('back_end.index')
@section('title')
    Edit | social link
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit social link</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item ">Edit</li>
                            <li class="breadcrumb-item active">Edit social link</li>
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
                                    <a href="{{route('manage_icon')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'save_edit_link'])}}

                                <h4 class="mt-0 header-title">Edit link add</h4>

                                <div class="form-group">
                                    <label>Platform name</label>
                                    <input type="text" name="platform_name" value="{{old('platform_name')?old('platform_name'):$social->platform_name}}" class="form-control" placeholder="Social media name">
                                    <input type="hidden" name="id" value="{{$social->id}}">
                                </div>

                                <div class="form-group">
                                    <label>URL/Link</label>
                                    <textarea class="form-control" name="url" placeholder="https://www.facebook.com">{{old('url')?old('url'):$social->url}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label>icon class <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank" title="class"><i class="fa fa-question-circle"></i></a></label>
                                    <input type="text" maxlength="30" name="icon_class" value="{{old('icon_class')?old('icon_class'):$social->icon_class}}" class="form-control" placeholder="icon class name example:  ion-social-facebook">
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
                                        <option value="1" {{$social->status==1?'selected':''}}>Publish</option>
                                        <option value="0" {{$social->status==0?'selected':''}}>Unpublished</option>
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
