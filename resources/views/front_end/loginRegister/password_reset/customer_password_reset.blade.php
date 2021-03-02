@extends('front_end.index')
@section('front_title')
    Password reset | {{env('app_name')}}
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
                            <li class="active">Password reset</li>
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
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> Forget password </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
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
                                        @if($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                @foreach($errors->all() as $error)
                                                <strong>{{$error}}</strong>
                                                @endforeach
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
                                        {{Form::open(['method'=>'post','id'=>'customerReset_form','route'=>'customer_reset_request'])}}
                                        <input type="email" required name="email" autocomplete="off" placeholder="Email">
                                            <div class="button-box">

                                            <div class="button-box">
                                                <button type="submit" class="g-recaptcha pull-right"  data-sitekey="{{env('recaptcha_site_key')}}"
                                                        data-callback='onReset'
                                                        data-action='submit'>Reset</button>
                                            </div>

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
        function onReset(token) {
            document.getElementById("customerReset_form").submit();
        }
    </script>

    <style>#product_menus{display: none;}</style>
@endsection
