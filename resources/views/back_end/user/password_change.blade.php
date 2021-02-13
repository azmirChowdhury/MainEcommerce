@extends('back_end.index')
@section('title')
    {{$user->name}} | Password change
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Admin password change</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item ">User</li>
                            <li class="breadcrumb-item active">Admin password change</li>
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
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Good! </strong>{{Session::get('massage')}}.
                                    </div>
                                @endif
                                <div class="m-b-5">
                                    <a href="{{route('manage_admin')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'change_password_save'])}}

                                <h4 class="mt-0 header-title">Admin password change</h4>


                                <div class="form-group">
                                    <label>Admin name</label>
                                    <input type="text" readonly disabled class="form-control" required value="{{$user->name}}" >
                                    <input type="hidden" name="id" readonly  value="{{$user->id}}" >
                                </div>
                                <div class="form-group">
                                    <label>Current password</label>
                                    <input type="text" name="current_password" class="form-control" required  placeholder="Enter password">
                                </div>

                                    <div class="form-group">
                                    <label>New Password</label>
                                    <input type="text" name="password" class="form-control" required  placeholder="Enter new password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="text" name="password_confirmation" class="form-control" required placeholder="Confirm password">
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
                                    <div class="m-l-15">
                                        <a href="{{route('manage_admin')}}" type="reset"
                                           class="btn btn-secondary waves-effect m-l-30 ">
                                            Cancel
                                        </a>
                                        <input type="submit" class="btn btn-primary waves-effect m-l-10" value="Change password">
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
