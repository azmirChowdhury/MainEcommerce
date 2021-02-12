@extends('back_end.index')
@section('title')
    Edit | Shipping settings
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Shipping settings</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item ">Purchase settings</li>
                            <li class="breadcrumb-item ">Shipping</li>
                            <li class="breadcrumb-item active">Edit shipping</li>
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
                                    <a href="{{route('purchase_settings')}}" type="button" class="font-24"><i
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
                                {{Form::open(['method'=>'post','route'=>'shipping_edit_save'])}}

                                <h4 class="mt-0 header-title">Edit shipping settings</h4>


                                    <div class="form-group">
                                        <label>Select district</label>
                                        @php($district_info=json_decode($shipping->district_name))
                                        <select name="district[]" class="form-control select2 " multiple>
                                            @foreach($district_info as $dis)
                                                <option value="{{$dis}}" selected>{{$dis}}</option>
                                            @endforeach
                                            @foreach($districts as $district)
                                                    <option value="{{$district->district_name}}" {{in_array($district->district_name,$district_info)?'selected':''}}>{{$district->district_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="id" value="{{$shipping->id}}">
                                    <div class="form-group">
                                        <label>Shipping cost</label>
                                        <input name="shipping_cost" required
                                               value="{{old('shopping_cost')?old('shopping_cost'):$shipping->shipping_cost}}" type="text"
                                               class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Use</label>
                                        <select name="use" class="form-control">
                                            <option value="1" {{$shipping->use==1?'selected':''}}>Pear product</option>
                                            <option value="2" {{$shipping->use==2?'selected':''}}>All shopping</option>
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
                                        <option value="1" {{$shipping->status==1?'selected':''}}>Publish</option>
                                        <option value="0" {{$shipping->status==0?'selected':''}}>Unpublished</option>
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
                                        <a href="{{route('purchase_settings')}}" type="reset"
                                           class="btn btn-secondary waves-effect m-l-30 ">
                                            Cancel
                                        </a>
                                        <input type="submit" class="btn btn-primary waves-effect m-l-10" value="Save">
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


@endsection
