

@extends('front_end.index')

@section('mates')
    @if(Session::get('customer_id')!=isset($customer_login->id))
            <META HTTP-EQUIV="Refresh" CONTENT="0;URL={{url('/')}}">
        {{exit()}}
    @endif
@endsection
@section('front_title')
    {{$customer_login->first_name.' '.$customer_login->last_name}} | Account
@endsection
@section('home_body')

    @foreach($BannersShow as $account_banner)
        @if($account_banner->banner_role==3)
            <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$account_banner->banner_image}});">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <h2>{{$account_banner->banner_name}}</h2>
                        <ul>
                            <li>
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="active">My account</li>
                        </ul>
                    </div>
                </div>
            </div>

        @endif
    @endforeach






    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="{{Session::get('Adetailsmassage')||Session::get('AdetailsError')||$errors->all()||Session::get('addressMessage')==null?'active':''}}" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                    <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                        Method</a>
                                    <a href="#address-edit" class="{{Session::get('addressMessage')?'active':''}}" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                    <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

                                    <a href="{{url('/')}}" onclick="event.preventDefault();document.getElementById('customer_logout').submit()"><i class="fa fa-sign-out"></i> Logout</a>
                                    {{Form::open(['method'=>'post','id'=>'customer_logout','route'=>'customer_logout'])}}
                                    {{Form::close()}}

                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade  {{Session::get('Adetailsmassage')||Session::get('addressMessage')==null?'show active':''}}" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>{{$customer_login->first_name.' '.$customer_login->last_name}}</strong> (If Not <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>
                                            </div>

                                            <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Aug 22, 2018</td>
                                                        <td>Pending</td>
                                                        <td>$3000</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>July 22, 2018</td>
                                                        <td>Approved</td>
                                                        <td>$200</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>June 12, 2017</td>
                                                        <td>On Hold</td>
                                                        <td>$990</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade {{Session::get('addressMessage')?'show active':''}}" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            @if(Session::get('addressMessage'))
                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <strong>{!!Session::get('addressMessage')!!}</strong>
                                                </div>
                                            @endif
                                            <h3>Billing Address</h3>
                                            <address>
                                                <p><strong>{{$customer_login->first_name.' '.$customer_login->last_name}}</strong></p>
                                                <p id="address_main">{{$customer_login->present_address}}</p>
                                            </address>

                                            {{Form::open(['method'=>'post','route'=>'account_address_change'])}}
                                                <div id="change_address">

                                                </div>
                                            {{Form::close()}}
                                            <a class="check-btn sqr-btn " id="edit_btn"><i class="fa fa-edit"></i> Edit Address</a>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">
                                                @if(Session::get('Adetailsmassage'))
                                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>{{Session::get('Adetailsmassage')}}</strong>
                                                    </div>
                                                @endif
                                                @if(Session::get('AdetailsError'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <strong>{{Session::get('AdetailsError')}}</strong>
                                                    </div>
                                                @endif
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
<br>
                                                {{Form::open(['method'=>'post','id'=>'change_password','route'=>'account_details_change'])}}

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">First Name</label>
                                                                <input type="text" required name="first_name" value="{{$customer_login->first_name}}" id="first-name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name"  class="required">Last Name</label>
                                                                <input type="text" required name="last_name" value="{{$customer_login->last_name}}" id="last-name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="display-name" class="required">Display Name</label>
                                                        <input type="text" readonly value="{{$customer_login->first_name.' '.$customer_login->last_name}}" id="display-name" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email Addres</label>
                                                        <input type="email" readonly name="email"  value="{{$customer_login->email}}" id="email" autocomplete="off"/>
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Current Password</label>
                                                            <input type="password" name="current_password" id="current-pwd" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">New Password</label>
                                                                    <input type="password" name="new_password"  id="new-pwd" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                    <input type="password"  name="confirm_password" id="confirm-pwd" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn ">Save Changes</button>
                                                    </div>

                                               {{Form::close()}}

                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>









    <style>#product_menus{display: none;}</style>
@endsection
