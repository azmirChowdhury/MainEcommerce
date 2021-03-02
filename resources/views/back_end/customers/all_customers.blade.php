@extends('back_end.index')
@section('title')
    Manage | Customer
@endsection
@section('body')
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
                                        <th>Customer name</th>
                                        <th>demo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$customer->last_name}}</td>
                                        <td>demo</td>
                                        <td>{{$customer->status==1?'Active':''}}{!!$customer->status==0?'<span class="text-warning">not verify</span>':'' !!}{!!$customer->status==2?'<span class="text-danger">Stopped</span>':''!!}</td>
                                        <td width="90">
                                            @if($customer->status==1)
                                            <a href="" class="text-success" ><i class="fa fa-arrow-circle-up" title="Published"></i></a>
                                            @else
                                            <a href="" class="text-warning"><i class="fa fa-arrow-circle-down" title="Unpublished"></i></a>
                                            @endif
                                            <a href="" class="text-primary"><i class="fa fa-eye" title="view information"></i></a>
                                            <a href="" class="text-info"><i class="fa fa-edit" title="Edit"></i></a>
                                            <a  class="text-danger"><i class="fa fa-trash  waves-effect waves-light" id="sa-warning" title="Delete"></i></a>
                                        </td>
                                    </tr>
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
