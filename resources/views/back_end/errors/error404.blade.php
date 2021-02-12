<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Error 4040</title>
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
@if(isset(Auth::user()->name))
<div class="account-pages"></div>

<!-- Begin page -->
<div class="wrapper-page">
    <div class="card">
        <div class="card-block">

            <div class="ex-page-content text-center">
                <h1 class="text-dark">404!</h1>
                <h4 class="">Sorry, {{Auth::user()->name}}  page not found</h4><br>

                <a class="btn btn-info mb-5 waves-effect waves-light" href="{{url('/')}}"><i class="mdi mdi-home"></i> Back</a>
            </div>

        </div>
    </div>
</div>
@else
{{--    {{404 'page not found'}}--}}
@endif


<!-- jQuery  -->
<script src="{{asset('/')}}back_end/assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/metisMenu.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/jquery.slimscroll.js"></script>
<script src="{{asset('/')}}back_end/assets/js/waves.min.js"></script>

<script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>
