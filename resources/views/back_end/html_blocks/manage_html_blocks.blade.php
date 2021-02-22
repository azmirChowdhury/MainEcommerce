@extends('back_end.index')
@section('title')
    Manage | Blocks
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
                        <h4 class="page-title"> Parents Category Blocks</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Parents Category blocks</a></li>
                            <li class="breadcrumb-item active">Manage Parents Category Blocks</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Manage parents category blocks</h4>
                                    <button class="btn btn-success dropdown-toggle float-lg-right float-md-right float-xl-right float-sm-right" type="button" id="dropdownMenuButton" data-toggle="dropdown">Manager</button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('parents_menu_blocks_add')}}">Add Collum</a>
                                </div>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>Laval Name</th>
                                        <th>Parents category name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($blocks_in as $block)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$block->laval_name}}</td>
                                            <td>{{$block->parents_category_name}}</td>
                                            <td>{{$block->status==1?'publish':'unpublished'}}</td>
                                            <td width="90">
                                                @if($block->status==0)
                                                    <a href="{{route('status_publish',['id'=>$block->id])}}" class="text-success" ><i class="fa fa-arrow-circle-up" title="Published"></i></a>
                                                @else
                                                    <a href="{{route('status_unpublished',['id'=>$block->id])}}" class="text-warning"><i class="fa fa-arrow-circle-down" title="Unpublished"></i></a>
                                                @endif
                                                <a href="{{route('edit_blocks',['id'=>$block->id])}}" class="text-info"><i class="fa fa-edit" title="Edit"></i></a>

                                                    <a class="text-danger" data-toggle="modal" data-target="#exampleModalCenter{{$block->id}}"><i class="fa fa-trash"  title="Delete" ></i></a>

                                                <!-- Modal -->
                                            </td>
                                        </tr>
                                    @endforeach


                            @foreach($blocks_in as $block)
                                    <div class="modal fade" id="exampleModalCenter{{$block->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="exampleModalLongTitle">Are you sure ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Delete this Block ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="{{route('delete_block',['id'=>$block->id])}}" class="btn btn-danger">Delete</a>
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
