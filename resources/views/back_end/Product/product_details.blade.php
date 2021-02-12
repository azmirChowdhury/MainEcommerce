@extends('back_end.index')
@section('title')
    Product | Details
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Product details</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Product & event management</a></li>
                            <li class="breadcrumb-item active">Product details</li>
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
                                            <a href="{{route('manage_products')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                        <tr class="">
                                            <td align="center">
                                                <img class="border-info" height="300" width="300" src="{{asset('/').$product->product_image}}" alt="product image" >
                                            <h3 class="text-center">{{$product->product_name}}</h3>
                                            </td>
                                        </tr>
                                        @if(!$product['imagei']==null)
                                        <tr>
                                            <td align="center">
                                                @foreach($product['imagei'] as $images)
                                                    <img class="border-info" height="100" width="100" src="{{asset('/').$images}}" alt="product image" >
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif
                                        <tr >
                                            <td align="center">
                                                <label for="short description">Short description :</label>
                                                <p>
                                                    {!! $product->product_specification !!}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label for="Long description">Long description :</label>
                                                <div class="border-primary">
                                                        <p>{!! $product->long_description !!}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>


                                <div class="row" id="table-head">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title text-success">Other Information</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tr>
                                                            <th>Product id :</th>
                                                            <td>#{{$product->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Product Category :</th>
                                                            <td>{{$product->category_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Price :</th>
                                                            <td>BDT : {{$product->sale_price }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Quantity Total :</th>
                                                            <td>{{$product->product_quantity }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>Availability :</th>
                                                            @if($product->product_quantity>0)
                                                                <td class=" font-bold" style="color:green;">In stock</td>
                                                            @else
                                                                <td class="font-bold" style="color:red;"> Out of stock</td>
                                                            @endif
                                                        </tr>
                                                        @if($product['color']==true)
                                                        <tr>
                                                            <th>Available color :</th>
                                                            <td><ol>
                                                                    @foreach($product['color'] as $color)
                                                                        <li>{{$color}}</li>
                                                                    @endforeach
                                                                </ol></td>
                                                        </tr>
                                                        @endif
                                                        @if($product['size']==true)
                                                        <tr>
                                                            <th>Product size: </th>
                                                            <td><ol>
                                                                @foreach($product['size'] as $size)
                                                                <li>{{$size}}</li>
                                                                @endforeach
                                                            </ol></td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <th>Publication status :</th>
                                                            @if($product->status==1)
                                                                <td style="color:green;font-weight: bold;">Published</td>
                                                            @else
                                                                <td style="color:red;font-weight: bold;">Unpublished</td>
                                                            @endif
                                                        </tr>
                                                        @if(!$product->product_length==null)
                                                        <tr>
                                                            <th>Length :</th>
                                                            <td>{{$product->product_length}}</td>
                                                        </tr>
                                                        @endif
                                                        @if(!$product->product_width==null)
                                                        <tr>
                                                            <th>width :</th>
                                                            <td>{{$product->product_width}}</td>
                                                        </tr>
                                                        @endif
                                                            @if(!$product->product_height==null)
                                                        <tr>
                                                            <th>height :</th>
                                                            <td>{{$product->product_height}} </td>
                                                        </tr>
                                                            @endif
                                                                @if(!$product->product_weight==null)

                                                        <tr>
                                                            <th>Weight :</th>
                                                            <td>{{$product->product_weight}}</td>
                                                        </tr>
                                                                @endif
                                                        <tr>
                                                            <th>Publish date :</th>
                                                            <td>{{$product->created_at}}</td>
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

