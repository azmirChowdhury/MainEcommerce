
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <noscript><META HTTP-EQUIV="Refresh" CONTENT="0;URL=error.php"></noscript>
    <title>@yield('title')</title>
    <script src="{{asset('/')}}back_end/ckeditor/ckeditor.js"></script>
    <script src="{{asset('/')}}back_end/ckeditor/samples/js/sample.js"></script>

    <link rel="stylesheet" href="{{asset('/')}}back_end/plugins/morris/morris.css">

    <link href="{{asset('/')}}back_end/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}back_end/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />


    <link href="{{asset('/')}}back_end/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}back_end/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}back_end/assets/css/icons.css" rel="stylesheet" type="text/css">

    @if(Auth::user()->role==2)
        <link href="{{asset('/')}}back_end/assets/green_css/style.css" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('/')}}back_end/assets/css/style.css" rel="stylesheet" type="text/css">
    @endif

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script src="{{asset('/')}}back_end/assets/ajax/jquery.min.js"></script>

    <link href="{{asset('/')}}back_end/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="{{asset('/')}}back_end/plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    @if(!empty($appearance_image->id))
        <link rel="shortcut icon" href="{{asset('/').$appearance_image->fav_icon}}">
        <link rel="icon" href="{{asset('/').$appearance_image->fav_icon}}" type="image/x-icon">
        <style>
        .page-title-box {
            background: url("{{asset('/').$appearance_image->background_image}}");
        }
    </style>
    @endif
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    @include('back_end.includes.header')
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
        @include('back_end.includes.menu')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        @yield('body')
        <!-- content -->

        @include('back_end.includes.footer')

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="{{asset('/')}}back_end/assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/metisMenu.min.js"></script>
<script src="{{asset('/')}}back_end/assets/js/jquery.slimscroll.js"></script>
<script src="{{asset('/')}}back_end/assets/js/waves.min.js"></script>

<script src="{{asset('/')}}back_end/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Peity JS -->
<script src="{{asset('/')}}back_end/plugins/peity/jquery.peity.min.js"></script>

<script src="{{asset('/')}}back_end/plugins/morris/morris.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/raphael/raphael-min.js"></script>

<script src="{{asset('/')}}back_end/assets/pages/dashboard.js"></script>

<!-- Required datatable js -->
<script src="{{asset('/')}}back_end/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{asset('/')}}back_end/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/jszip.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/pdfmake.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/vfs_fonts.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/buttons.print.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="{{asset('/')}}back_end/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="{{asset('/')}}back_end/assets/pages/datatables.init.js"></script>



<script src="{{asset('/')}}back_end/plugins/tinymce/tinymce.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/bootstrap-md-datetimepicker/js/moment-with-locales.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/bootstrap-md-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="{{asset('/')}}back_end/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>





<script src="{{asset('/')}}back_end/plugins/select2/js/select2.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

<script src="{{asset('/')}}back_end/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{asset('/')}}back_end/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>



<!-- Plugins Init js -->
<script src="{{asset('/')}}back_end/assets/pages/form-advanced.js"></script>

<!-- App js -->
<script src="{{asset('/')}}back_end/assets/js/app.js"></script>


<script>
    initSample();
</script>

</body>

</html>
