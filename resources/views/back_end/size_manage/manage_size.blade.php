@extends('back_end.index')
@section('title')
    Manage | size
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
                        <h4 class="page-title">Manage</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Size & Color</a></li>
                            <li class="breadcrumb-item active">Size manager</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Manage Size</h4>
                                <button class="btn btn-success dropdown-toggle float-lg-right float-md-right float-xl-right float-sm-right" type="button" id="dropdownMenuButton" data-toggle="dropdown">Manager</button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('size_add_view')}}">Add size</a>
                                </div>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th class="text-center">Size</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($sizes as $size)
                                        <tr>
                                            <td width="90">{{$i++}}</td>
                                            <td class="align-items-center">
                                                    {{Form::open(['method'=>'POST','route'=>'update_size'])}}
                                                <div class="form-group col-lg-8 col-md-8 col-xl-8 float-left">
                                                    <input type="text" class="form-control" name="size_value" value="{{$size->Size}}">
                                                    <input type="hidden" class="form-control" name="id" value="{{$size->id}}">
                                                </div>
                                                <div class="form-group col-lg-2 col-md-2 col-xl-2 float-left">
                                                    <input type="submit" class="btn btn-success"  value="Update">
                                                </div>
                                            {{Form::close()}}
                                            </td>
                                            <td width="90">
                                                <a class="text-danger" data-toggle="modal" data-target="#exampleModalCenter{{$size->id}}"><i class="fa fa-trash"  title="Delete" ></i></a>
                                                <!-- Modal -->
                                            </td>
                                        </tr>
                                    @endforeach


                                    @foreach($sizes as $size)
                                        <div class="modal fade" id="exampleModalCenter{{$size->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Are you sure ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Delete this Size ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a href="{{route('delete_size',['id'=>$size->id])}}" class="btn btn-danger">Delete</a>
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
