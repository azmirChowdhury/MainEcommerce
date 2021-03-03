@extends('back_end.index')
@section('title')
    Manage | Customer
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
                        <h4 class="page-title">All customer</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">All customers</a></li>
                            <li class="breadcrumb-item active">Manage All customers</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Manage customers</h4>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>Customer name L</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                @php($i=1)
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$customer->last_name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->status==1?'Active':''}}{!!$customer->status==0?'<span class="text-warning">not verify</span>':'' !!}{!!$customer->status==2?'<span class="text-danger">Stopped</span>':''!!}</td>
                                        <td width="90">
                                            @if($customer->status==2)
                                            <a href="{{route('active_customer',['id'=>$customer->id])}}" class="text-success" ><i class="fa fa-arrow-circle-up" title="Activation"></i></a>
                                            @else
                                            <a href="{{route('stopped_customer',['id'=>$customer->id])}}" class="text-warning"><i class="fa fa-arrow-circle-down" title="Stopped"></i></a>
                                            @endif
                                            <a href="{{route('customer_details',['id'=>$customer->id])}}" class="text-primary"><i class="fa fa-eye" title="view information"></i></a>
                                            <a  class="text-danger" data-toggle="modal"
                                                data-target="#customer{{$customer->id}}"><i class="fa fa-trash  waves-effect waves-light" id="sa-warning" title="Delete"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach



                                @foreach($customers as $customer)
                                    <div class="modal fade" id="customer{{$customer->id}}"
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
                                                    <p>Delete this {{$customer->last_name}} Customer ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <a href="{{route('delete_customer',['id'=>$customer->id])}}" class="btn btn-danger">Delete</a>
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
