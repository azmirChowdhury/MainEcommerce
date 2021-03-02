@extends('front_end.index')
@section('front_title')
    Customer login or register | {{env('app_name')}}
@endsection
@section('mates')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection
@section('home_body')


    @foreach($BannersShow as $customerBanner)
        @if($customerBanner->banner_role==3)
                <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$customerBanner->banner_image}});">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h2>{{$customerBanner->banner_name}}</h2>
                            <ul>
                                <li>
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="active">Login or Registration</li>
                            </ul>
                        </div>
                    </div>
                </div>

        @endif
    @endforeach


    <div class="login-register-area pt-85 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="{{Session::get('massage')?'active':''}}{{$errors->any()==false?'active':''}}" data-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            <a data-toggle="tab" href="#lg2" class="{{$errors->any()?'active':''}}">
                                <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane {{Session::get('massage')?'active':''}}{{$errors->any()==false?'active':''}}">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        @if(Session::get('massage'))
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{Session::get('massage')}}</strong>
                                            </div>
                                        @endif
                                            @if(Session::get('ErrorMassage'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>{{Session::get('ErrorMassage')}}</strong>
                                            </div>
                                        @endif
                                        {{Form::open(['method'=>'post','id'=>'loginForm','route'=>'customer_login'])}}
                                            <input type="email" name="email" placeholder="Email">
                                            <input type="password" name="password" placeholder="Password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{route('customer_password_reset_show')}}">Forgot Password?</a>
                                                </div>

                                                <div class="button-box">
                                                    <button type="submit" class="g-recaptcha"  data-sitekey="{{env('recaptcha_site_key')}}"
                                                            data-callback='onLogin'
                                                            data-action='submit'>Login</button>
                                                </div>

                                            </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane {{$errors->any()?'active':''}}">
                                <div class="login-form-container">
                                    <div class="login-register-form">
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
                                        {{Form::open(['method'=>'post','id'=>'reg_form','route'=>'resister_customer'])}}

                                            <input type="text" name="first_name" value="{{old('first_name')}}" placeholder="First name">
                                            <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="Last name">
                                            <input name="email" placeholder="Email" value="{{old('email')}}" type="email">
                                            <input type="password" name="password" value="{{old('password')}}" placeholder="Password">
                                            <input type="text" name="phone_number" value="{{old('phone_number')}}" placeholder="Phone number">
                                            <input type="text" name="present_address" value="{{old('present_address')}}" placeholder="Present Address">
                                            <input type="text" name="permanent_address" value="{{old('permanent_address')}}" placeholder="Permanent Address">
                                            <div class="form-group">
                                            <select class="form-control select2" name="district_id">
                                                <option value="#">--Select your district--</option>
                                            @foreach($districts as $district)
                                                    <option value="{{$district->id}}">{{$district->district_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                           <div class="button-box">
                                                <button type="submit" class="g-recaptcha"  data-sitekey="{{env('recaptcha_site_key')}}"
                                                        data-callback='onSubmit'
                                                        data-action='submit'>Register</button>
                                            </div>

                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script>
        function onLogin(token) {
            document.getElementById("loginForm").submit();
        }
        function onSubmit(token) {
            document.getElementById("reg_form").submit();
        }
    </script>

    <style>#product_menus{display: none;}</style>
@endsection
