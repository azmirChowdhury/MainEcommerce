@extends('back_end.index')
@section('title')
    Manage | Admins
@endsection

@section('body')



    <!-- Button trigger modal -->
    @if(Session()->get('massage'))
        <script>
            $(document).ready(function () {
                $("#exampleModal").modal('show');
            });
        </script>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Work Massage !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(Session::get('massage'))
                        <h5 class="text-success">{{Session::get('massage')}}</h5>
                    @else
                        <h5 class="text-danger">{{Session::get('err')}}</h5>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Admins</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Manage admins</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Admins</h4>
                                <button class="btn btn-success dropdown-toggle float-lg-right float-md-right float-xl-right float-sm-right" type="button" id="dropdownMenuButton" data-toggle="dropdown">Manager</button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('register')}}">Admin register</a>
                                </div>


                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php($i=1)
                                    @foreach($admins_user as $admin)
                                        <tr>
                                            <td>{{$i++}} </td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{$admin->role==1?'Admin':'Co-admin'}}</td>
                                            <td>{{$admin->status==1?'Publish':'Unpublished'}}</td>

                                            @if(Auth::user()->role==1)
                                            <td width="20">
                                                @if($admin->status==0)
                                                    <a href="{{route('publish_admin',['id'=>$admin->id])}}"
                                                       class="text-success"><i class="fa fa-arrow-circle-up" title="Published"></i></a>
                                                @else
                                                    <a href="{{route('unpublished_admin',['id'=>$admin->id])}}"
                                                       class="text-warning"><i class="fa fa-arrow-circle-down" title="Unpublished"></i></a>
                                                @endif
{{--                                                    <div class="dropdown show">--}}
                                                        <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-chevron-circle-down"></i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('change_password',['id'=>$admin->id])}}"><i class="fa fa-key fa-fw"></i> Password change</a>
                                                            <a class="dropdown-item" href="{{route('password_reset_show')}}"><i class="mdi mdi-key-change fa-fw"></i> Forgot Password</a>
                                                            <a class="dropdown-item" href="{{route('edit_co_user',['id'=>$admin->id])}}"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                               data-target="#admin{{$admin->id}}"><i class="fa fa-trash fa-fw"></i> Delete</a>
                                                        </div>
{{--                                                    </div>--}}


                                                <!-- Modal -->
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    @foreach($admins_user as $admin)
                                        <div class="modal fade" id="admin{{$admin->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLongTitle">
                                                            Are you sure ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Delete this <strong>{{$admin->name}}</strong> User ?</p>
                                                        {{Form::open(['method'=>'post','id'=>"password".$admin->id,'route'=>'user_delete'])}}
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="password" name="password" class="form-control">
                                                            <input type="hidden"  name="user_id" value="{{$admin->id}}">
                                                        </div>
                                                        {{Form::close()}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a href="delete" onclick="event.preventDefault();document.getElementById('password{{$admin->id}}').submit()" class="btn btn-danger" autocomplete="off">Confirm Delete</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


        </div>
    </div>
@endsection
