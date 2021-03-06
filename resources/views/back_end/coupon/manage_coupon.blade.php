@extends('back_end.index')
@section('title')
    Manage | Coupon
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
                        <h4 class="page-title">Coupon</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                            <li class="breadcrumb-item active">Manage Coupon</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Manage coupon</h4>
                                <button class="btn btn-success dropdown-toggle float-lg-right float-md-right float-xl-right float-sm-right" type="button" id="dropdownMenuButton" data-toggle="dropdown">Manager</button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('add_coupon')}}">New coupon</a>
                                </div>


                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>Coupon Name</th>
                                        <th>Coupon Expire</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php($i=1)
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->expire_date}}</td>
                                            <td>{{$coupon->status==1?'Published':"Unpublished"}}</td>

                                            <td width="90">
                                                @if($coupon->status==0)
                                                    <a href="{{route('published_coupon',['id'=>$coupon->id])}}"
                                                       class="text-success"><i class="fa fa-arrow-circle-up" title="Published"></i></a>
                                                @else
                                                    <a href="{{route('unpublished_coupon',['id'=>$coupon->id])}}"
                                                       class="text-warning"><i class="fa fa-arrow-circle-down" title="Unpublished"></i></a>
                                                @endif
                                                <a href="{{route('edit_coupon',['id'=>$coupon->id])}}"
                                                   class="text-info"><i class="fa fa-edit" title="Edit"></i></a>

                                                <a class="text-danger" data-toggle="modal"
                                                   data-target="#exampleModalCenter{{$coupon->id}}"><i
                                                        class="fa fa-trash" title="Delete"></i></a>

                                                <!-- Modal -->
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach($coupons as $coupon)
                                        <div class="modal fade" id="exampleModalCenter{{$coupon->id}}"
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
                                                        <p>Delete this {{$coupon->coupon_code}} Coupon ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a href="{{route('delete_coupon',['id'=>$coupon->id])}}" class="btn btn-danger">Delete</a>
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
