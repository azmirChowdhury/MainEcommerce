@extends('back_end.index')
@section('title')
    E-mail
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Email</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Email</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">All mail </a></li>
                            <li class="breadcrumb-item active">Web server mail</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <!-- Left sidebar -->
                        <div class="email-leftbar card">
                            <a href="{{route('email_compose')}}" class="btn btn-danger btn-rounded btn-block waves-effect waves-light">Compose</a>

                            <div class="mail-list m-t-20">
                                <a href="{{route('email')}}" class="{{request()->routeIs('email')?'active':''}}">Inbox <span class="ml-1">(18)</span></a>

                                <a href="#">Starred</a>
                                <a href="#">Important</a>
                                <a href="#">Draft</a>
                                <a href="#">Sent Mail</a>
                                <a href="#">Trash</a>
                            </div>


                            <h6 class="m-t-30">Labels</h6>

                            <div class="mail-list m-t-20">
                                <a href="#"><span class="mdi mdi-arrow-right-drop-circle text-info float-right"></span>Theme Support</a>
                                <a href="#"><span class="mdi mdi-arrow-right-drop-circle text-warning float-right"></span>Freelance</a>
                                <a href="#"><span class="mdi mdi-arrow-right-drop-circle text-primary float-right"></span>Social</a>
                                <a href="#"><span class="mdi mdi-arrow-right-drop-circle text-danger float-right"></span>Friends</a>
                                <a href="#"><span class="mdi mdi-arrow-right-drop-circle text-success float-right"></span>Family</a>
                            </div>


                            <div class="m-t-20">

                            </div>
                        </div>
                        <!-- End Left sidebar -->


                        <!-- Right Sidebar -->
                        <div class="email-rightbar mb-3">

                            <div class="card">
                                <div class="btn-toolbar p-3" role="toolbar">
                                    <div class="btn-group mo-mb-2">
                                        <a href="{{route('email')}}" type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></a>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                    </div>
{{--                                    <div class="btn-group ml-1 mo-mb-2">--}}
{{--                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                            <i class="fa fa-folder"></i>--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu">--}}
{{--                                            <a class="dropdown-item" href="#">Updates</a>--}}
{{--                                            <a class="dropdown-item" href="#">Social</a>--}}
{{--                                            <a class="dropdown-item" href="#">Team Manage</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="btn-group ml-1 mo-mb-2">--}}
{{--                                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                            <i class="fa fa-tag"></i>--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu">--}}
{{--                                            <a class="dropdown-item" href="#">Updates</a>--}}
{{--                                            <a class="dropdown-item" href="#">Social</a>--}}
{{--                                            <a class="dropdown-item" href="#">Team Manage</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                </div>
                                @yield('mail_body')
                            </div> <!-- card -->

{{--                            <div class="row m-t-20">--}}
{{--                                <div class="col-7">--}}
{{--                                    Showing 1 - 20 of 1,524--}}
{{--                                </div>--}}
{{--                                <div class="col-5">--}}
{{--                                    <div class="btn-group float-right">--}}
{{--                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>--}}
{{--                                        <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->

            </div>
@endsection
