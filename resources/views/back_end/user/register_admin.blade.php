@extends('back_end.index')
@section('title')
    Admin | Register
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Register admin</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item ">User</li>
                            <li class="breadcrumb-item ">Manager</li>
                            <li class="breadcrumb-item active">Register admin</li>
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
                                {{Form::open(['method'=>'post','route'=>'register'])}}

                                <h4 class="mt-0 header-title">Admin registration</h4>


                                <div class="form-group">
                                    <label>Admin name</label>
                                   <input type="text" name="name" class="form-control" required value="{{old('name')}}" placeholder="Enter admin name">
                                </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                     <input type="text" name="email" class="form-control" required value="{{old('email')}}" placeholder="Enter email">
                                    </div>

                                 <div class="form-group">
                                    <label>Password</label>
                                   <input type="text" name="password" class="form-control" required  placeholder="Enter password">
                                </div>
                                 <div class="form-group">
                                    <label>Confirm Password</label>
                                   <input type="text" name="password_confirmation" class="form-control" required placeholder="Confirm password">
                                </div>

                                    <div class="form-group">
                                    <label>Select role</label>
                                    <select name="role" class="form-control" onchange="myFunction(this)" id="role">
                                        <option value="#">-- Select role --</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Co-admin</option>
                                    </select>
                                </div>

                                    <div class="form-group" style="display:none" id="check_role">
                                        <label>Select permission</label>
                                        <select name="permission[]" id="permissionId" class="form-control select2" multiple>
                                            <option   value="1">Email management</option>
                                            <option   value="2">order management</option>
                                            <option   value="3">customers management</option>
                                            <option   value="4">parents category management</option>
                                            <option   value="5">Html Blocks management</option>
                                            <option   value="6">Subcategory management</option>
                                            <option   value="7">Brand management</option>
                                            <option   value="8">Size & Color management</option>
                                            <option   value="9">Product management</option>
                                            <option   value="10">Deals management</option>
                                            <option   value="11">Coupon management</option>
                                            <option   value="12">Slider management</option>
                                            <option   value="13">Appearance management</option>
                                            <option   value="14">Utilities management</option>
                                            <option   value="15">Pages management</option>
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

                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" >Publish</option>
                                        <option value="0" >Unpublished</option>
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
                                        <a href="{{route('manage_admin')}}" type="reset"
                                           class="btn btn-secondary waves-effect m-l-30 ">
                                            Cancel
                                        </a>
                                        <input type="submit" class="btn btn-primary waves-effect m-l-10" value="Register">
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

        function myFunction(element) {
            document.getElementById("check_role").style.display = element.value==2 ? 'block' : 'none';
            document.getElementById("permissionId").required= element.value==2? true : false;
        }

    </script>
@endsection
