@extends('back_end.index')
@section('title')
    Purchase settings
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Purchase settings</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item active">Purchase settings</li>
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
                                @if(Session::get('massage'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Good! </strong>{{Session::get('massage')}}.
                                    </div>
                                @endif
                                <div class="m-b-5">
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
                                <div id="collapseOne" class="collapse show"
                                     aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Purchase settings</h4>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link {{request()->routeIs('purchase_settings')? 'active' : ''}}" data-toggle="tab" href="#shipping"
                                                   role="tab">Shipping</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tax" role="tab">Tax</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payment
                                                    method</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#notes" role="tab">Notes</a>
                                            </li>

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane {{request()->routeIs('purchase_settings')? 'active' : ''}} p-3" id="shipping" role="tabpanel">
                                                {{Form::open(['method'=>'post','route'=>'shipping_save'])}}
                                                <div class="form-group">
                                                    <label>Select district</label>
                                                    <select name="district[]" class="form-control select2 " multiple>
                                                       @foreach($districts as $district_all)
                                                            <option value="{{$district_all->district_name}}">{{$district_all->district_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Shipping cost</label>
                                                    <input name="shipping_cost" required
                                                           value="{{old('shopping_cost')}}" type="text"
                                                           class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Use</label>
                                                    <select name="use" class="form-control">
                                                        <option value="1">Pear product</option>
                                                        <option value="2">All shopping</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Publish</option>
                                                        <option value="0">Unpublished</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" value="Save" class="btn btn-primary ">
                                                </div>
                                                {{Form::close()}}

                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>#Sr.</th>
                                                        <th>Available District</th>
                                                        <th>Shipping cost</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @php($i=1)
                                                    @foreach($shipping as $ship)
                                                        <tr>

                                                            <td>{{$i++}}</td>
                                                            <td>
                                                                @php($disrtcts=json_decode($ship->district_name))
                                                                @foreach($disrtcts as $district)
{{--                                                                {{$ship->district_name=='all'?"All bangladesh":$ship->district_name}}--}}
                                                                    <strong>{{$district.' ,'}}</strong>
                                                                @endforeach
                                                            </td>
                                                            <td>{{$ship->shipping_cost}}</td>
                                                            <td>{{$ship->status==1?"Publish":"Unpublished"}}</td>

                                                            <td width="70">
                                                            @if($ship->status==0)
                                                                <a href="{{route('publish_shipping',['id'=>$ship->id])}}" class="text-success"><i
                                                                        class="fa fa-arrow-circle-up"
                                                                        title="Published"></i></a>
                                                              @else
                                                                <a href="{{route('unpublished_shipping',['id'=>$ship->id])}}" class="text-warning"><i
                                                                        class="fa fa-arrow-circle-down"
                                                                        title="Unpublished"></i></a>
                                                              @endif
                                                                <a href="{{route('edit_shipping',['id'=>$ship->id])}}" class="text-primary"><i class="fa fa-edit"
                                                                                                    title="Edit"></i></a>
                                                                <a class="text-danger"><i class="fa fa-trash  waves-effect waves-light" data-toggle="modal" data-target="#shippingModalCenter{{$ship->id}}" title="Delete"></i></a>

                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    @foreach($shipping as $ship)
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="shippingModalCenter{{$ship->id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger"
                                                                            id="exampleModalLongTitle">
                                                                            Are you sure ?</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-danger">Delete <strong
                                                                                class="text-primary font-18"></strong>District?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                        <a href="{{route('delete_shipping',['id'=>$ship->id])}}" class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="tab-pane p-3" id="tax" role="tabpanel">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input required type="number" name="product_quantity"
                                                           value="{{old('product_quantity')}}" class="form-control">
                                                </div>

                                            </div>
                                            <div class="tab-pane p-3" id="payment" role="tabpanel">
                                                <h4>Payment method</h4>
                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>#Sr.</th>
                                                        <th>Method name</th>
                                                        <th>Text</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @php($i=1)
                                                    @foreach($data['payment_method'] as $method)
                                                        <tr>

                                                            <td>{{$i++}}</td>
                                                            <td>{{$method->method_name}}</td>
                                                            <td>
                                                                <textarea class="form-control" disabled>{{$method->text}}</textarea>
                                                            </td>
                                                            <td>{{$method->status==1?'Publish':'Unpublished'}}</td>

                                                            <td width="70">
                                                                @if($method->status==0)
                                                                    <a href="{{route('publish_payment',['id'=>$method->id])}}" class="text-success"><i
                                                                            class="fa fa-arrow-circle-up"
                                                                            title="Published"></i></a>
                                                                @else
                                                                    <a href="{{route('unpublished_payment',['id'=>$method->id])}}" class="text-warning"><i
                                                                            class="fa fa-arrow-circle-down"
                                                                            title="Unpublished"></i></a>
                                                                @endif

                                                                <a href="{{route('edit_payment',['id'=>$method->id])}}" class="text-primary"><i class="fa fa-edit" title="Delete"></i></a>
                                                                <a class="text-danger"><i class="fa fa-trash  waves-effect waves-light" data-toggle="modal" data-target="#payment{{$method->id}}" title="Delete"></i></a>

                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    @foreach($data['payment_method'] as $method)
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="payment{{$method->id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger"
                                                                            id="exampleModalLongTitle">
                                                                            Are you sure ?</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-danger">Delete <strong
                                                                                class="text-primary font-18">{{$method->method_name}}</strong> Method?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                        <a href="{{route('delete_payment',['id'=>$method->id])}}" class="btn btn-danger"> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane p-3" id="notes" role="tabpanel">

                                                {{Form::open(['method'=>'post','route'=>'notes_save'])}}
                                                <div class="form-group">
                                                    <label>Select role</label>
                                                    <select name="role" class="form-control" >
                                                        <option value="1">Footer description</option>
                                                        <option value="2">Shipping information</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Enter your description</label>
                                                    <textarea id="editor" name="description" placeholder="Enter your text">{{old('description')}}</textarea>
                                                </div>


                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Publish</option>
                                                        <option value="0">Unpublished</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" value="Save" class="btn btn-primary ">
                                                </div>
                                                {{Form::close()}}

                                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>#Sr.</th>
                                                        <th>Role</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @php($i=1)
                                                    @foreach($notes as $note)
                                                        <tr>

                                                            <td>{{$i++}}</td>
                                                            <td>
                                                                <?php
                                                                switch ($note->role){
                                                                    case 1:echo"Footer description";
                                                                    break;
                                                                    case 2:echo"Shipping information";
                                                                    break;
                                                                }

                                                                ?>
                                                            </td>
                                                            <td>{!! $note->description !!}</td>
                                                            <td>{{$note->status==1?"Publish":"Unpublished"}}</td>

                                                            <td width="70">
                                                                @if($note->status==0)
                                                                    <a href="{{route('publish_notes',['id'=>$note->id])}}" class="text-success"><i
                                                                            class="fa fa-arrow-circle-up"
                                                                            title="Published"></i></a>
                                                                @else
                                                                    <a href="{{route('unpublished_notes',['id'=>$note->id])}}" class="text-warning"><i
                                                                            class="fa fa-arrow-circle-down"
                                                                            title="Unpublished"></i></a>
                                                                @endif
                                                                <a href="{{route('edit_notes',['id'=>$note->id])}}" class="text-primary"><i class="fa fa-edit"
                                                                                                                                               title="Edit"></i></a>
                                                                <a class="text-danger"><i class="fa fa-trash  waves-effect waves-light" data-toggle="modal" data-target="#notes{{$note->id}}" title="Delete"></i></a>

                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    @foreach($notes as $note)
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="notes{{$note->id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger"
                                                                            id="exampleModalLongTitle">
                                                                            Are you sure ?</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-danger">Delete <strong
                                                                                class="text-primary font-18"></strong>note?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                        <a href="{{route('delete_notes',['id'=>$note->id])}}" class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>


                    </div> <!-- end col -->


                </div> <!-- end row -->

            </div>

            <!-- end page content-->
        </div> <!-- container-fluid -->

    </div>




@endsection
