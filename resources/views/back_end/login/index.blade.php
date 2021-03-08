<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <noscript> <META HTTP-EQUIV="Refresh" CONTENT="0;URL='yourjavascriptproblem'"> </noscript>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('/')}}back_end/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}back_end/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}back_end/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}back_end/assets/css/style.css" rel="stylesheet" type="text/css">
    @if(!empty($appearance_image->id))
    <link rel="shortcut icon" href="{{asset('/').$appearance_image->fav_icon}}">
    <style>
    .account-pages{
        background: url({{asset('/').$appearance_image->background_image}});
    }
    </style>
    @endif
</head>

<body>

<!-- Background -->
<div class="account-pages"></div>
<!-- Begin page -->
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">

            <h3 class="text-center m-0">
                @if(!empty($appearance_image->id))
                <a href="" class="logo logo-admin"><img src="{{asset('/').$appearance_image->logo}}" height="70" alt="logo"></a>
                @endif
            </h3>
                 <x-jet-validation-errors class="mb-4 text-danger" />
            <div class="p-3">
                <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to {{env('app_name')}}.</p>

                    {{Form::open(['class'=>'form-horizontal m-t-30','method'=>'post','route'=>'login'])}}
                    <div class="form-group">
                        <label for="username">E-mail</label>
                        <input type="text" name="email" class="form-control" id="username" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                    </div>

                    <div class="form-group row m-t-20 ">
                        <div class="col-8 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                {{Form::close()}}

            </div>

        </div>
    </div>

    <div class="m-t-40 text-center">
        <p class="text-muted">© <?php echo date('Y');?>{{env('APP_NAME')}}</p>
    </div>

</div>

<!-- END wrapper -->


<!-- jQuery  -->
<script src="{{asset('/')}}back_end/assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/metisMenu.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/jquery.slimscroll.js"></script>
<script src="{{asset('/')}}back_end/assets/js/waves.min.js"></script>

<script src="{{asset('/')}}back_end/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- App js -->
<script src="{{asset('/')}}back_end/assets/js/app.js"></script>

</body>

</html>
