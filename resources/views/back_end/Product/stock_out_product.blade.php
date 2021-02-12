@extends('back_end.index')
@section('title')
    Manage | Product | Stock
@endsection
@section('body')

    <!-- Button trigger modal -->
    @if(Session()->get('massage'))
        <script>
            $(document).ready(function () {
                $("#massage").modal('show');
            });
        </script>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="massage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <h4 class="page-title">Out of stock Products</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product & brand</a></li>
                            <li class="breadcrumb-item active">Out of stock Products</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Out of stock Products</h4>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>Product Name</th>
                                        <th>Category name</th>
                                        <th>Image</th>
                                        <th>Stock</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->category_name}}</td>
                                            <td width="80"><img src="{{asset('/').$product->product_image}}" alt="product Image" width="80" height="80"></td>
                                            <td class="text-danger">Out of stock</td>
                                            <td class="text-danger">
                                                {{Form::open(['method'=>'post','route'=>'product_stock_update'])}}
{{--                                                <input type="number" class="form-control" name="quantity">--}}
{{--                                                <input type="submit" value="Update">--}}
                                                <div class="form-group col-lg-8 col-md-8 col-xl-8 float-left">
                                                    <input type="number" required class="form-control" name="quantity" value="{{$product->product_quantity}}">
                                                    <input type="hidden" class="form-control" value="{{$product->id}}" name="id">
                                                </div>
                                                <div class="form-group col-lg-2 col-md-2 col-xl-2 float-left">
                                                    <input type="submit" class="btn btn-success"  value="Update">
                                                </div>
                                                {{Form::close()}}

                                            </td>
                                        </tr>

                                    @endforeach

                                    @foreach($products as $product)
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Are you sure ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">Delete <strong class="text-primary font-18"> {{$product->product_name}} </strong>Products?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a href="{{route('delete_product',['id'=>$product->id])}}" class="btn btn-danger">Delete</a>
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
