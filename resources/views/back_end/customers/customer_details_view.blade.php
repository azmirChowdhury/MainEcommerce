@extends('back_end.index')
@section('title')
    Customer | Details
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Customer details</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Customer</a></li>
                            <li class="breadcrumb-item active">Customer details</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <div class="m-b-5">
                                            <a href="{{route('all_customers',['slug'=>'all-customer'])}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </table>
                                </div>


                                <div class="row" id="table-head">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title text-info text-center">Customer Information</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <th>Customer id :</th>
                                                            <td>#{{$customer->id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status :</th>
                                                            <td>{!!$customer->status==1?'<strong class="text-success">Active</span>':''!!}{!!$customer->status==2?'<strong class="text-danger">Stopped</span>':''!!}{!!$customer->status==0?'<strong class="text-warning">Not verify </span>':''!!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Full name :</th>
                                                            <td>{{$customer->first_name.' '.$customer->last_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email :</th>
                                                            <td><a href="mailto:{{$customer->email}}"><strong>{{$customer->email}}</strong></a></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone :</th>
                                                            <td><a href="tel:{{$customer->phone_number}}"><strong>{{$customer->phone_number}}</strong></a></td>
                                                        </tr>

                                                        <tr>
                                                            <th>Present Address :</th>
                                                            <td>{{$customer->present_address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Permanent Address :</th>
                                                            <td>{{$customer->permanent_address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>District :</th>
                                                            <td>{{$district->district_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Division :</th>
                                                            <td>{{$district->division_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country :</th>
                                                            <td>{{$district->country}}</td>
                                                        </tr>


                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

