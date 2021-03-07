<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @foreach($SeoMetas as $script_meta)
        @if($script_meta->position==1)
            {!! $script_meta->tag !!}
        @endif
    @endforeach
    <title>@yield('front_title')</title>
    @if(request()->routeIs('single_product'))
    <meta name="description" content="@yield('product_description')"/>
    @endif
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
{{--    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}front_end/assets/images/favicon.png">--}}
    @if(!empty($appearance_image->id))
        <link rel="shortcut icon" href="{{asset('/').$appearance_image->fav_icon}}">
    @endif
    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/vendor/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/vendor/line-awesome.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/vendor/themify.css">
    <!-- othres CSS -->
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/plugins/animate.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/plugins/owl-carousel.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/plugins/slick.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('/')}}front_end/assets///css/style.css">
    <link href="{{asset('/')}}back_end/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <script src="{{asset('/')}}front_end/assets/js/jquery.min.js"></script>
    @yield('mates')

@foreach($SeoMetas as $script_head)
    @if($script_head->position==2)
{!! $script_head->tag !!}
  @endif
@endforeach


</head>

<body>

@foreach($SeoMetas as $script_body_top)
    @if($script_body_top->position==3)
        {!! $script_body_top->tag !!}
    @endif
@endforeach

<div class="main-wrapper">
{{--    *********************************** Header ***************************--}}
    @include('front_end.includes.header')


{{--    --}}{{--************************************** mobile navigation ********************************************    --}}
    @include('front_end.includes.mobile_menu_navigation')

{{--************************************** slider ********************************************    --}}
{{--    @include('front_end.includes.slider')--}}


@yield('home_body')





{{--******************************* footer *****************************************--}}
 @include('front_end.includes.footer')

</div>
<!-- JS
============================================ -->

<!-- Modernizer JS -->
<script src="{{asset('/')}}front_end/assets///js/vendor/modernizr-3.6.0.min.js"></script>
<!-- Modernizer JS -->
<script src="{{asset('/')}}front_end/assets///js/vendor/jquery-3.3.1.min.js"></script>
<!-- Popper JS -->
<script src="{{asset('/')}}front_end/assets///js/vendor/popper.js"></script>
<!-- Bootstrap JS -->
<script src="{{asset('/')}}front_end/assets///js/vendor/bootstrap.min.js"></script>

<!-- Slick Slider JS -->
<script src="{{asset('/')}}front_end/assets///js/plugins/countdown.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/counterup.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/images-loaded.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/isotope.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/instafeed.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/jquery-ui.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/jquery-ui-touch-punch.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/magnific-popup.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/owl-carousel.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/scrollup.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/waypoints.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/slick.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/wow.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/textillate.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/elevatezoom.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/sticky-sidebar.js"></script>
<script src="{{asset('/')}}front_end/assets///js/plugins/smoothscroll.js"></script>
<script src="{{asset('/')}}back_end/plugins/select2/js/select2.min.js"></script>

<!-- Main JS -->
<script src="{{asset('/')}}front_end/assets/js/main.js"></script>

@yield('bottom_scrtpt')

@foreach($SeoMetas as $script_body_bottom)
    @if($script_body_bottom->position==4)
        {!! $script_body_bottom->tag !!}
    @endif
@endforeach
</body>

</html>
