<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        @if(!empty($appearance_image->logo))
        <a href="{{url('/dashboard')}}" class="logo">
                        <span>
                            <img src="{{asset('/').$appearance_image->logo}}" alt="" height="54">
                        </span>
            <i>
                <img src="{{asset('/').$appearance_image->logo}}" alt="" height="22">
            </i>
        </a>
    </div>
    @endif
    <nav class="navbar-custom">

        <ul class="navbar-right d-flex list-inline float-right mb-0">
            <li class="dropdown notification-list d-none d-sm-block">
                <form role="search" class="app-search">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" placeholder="Search..">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell noti-icon"></i>
                    <span class="badge badge-pill badge-info noti-icon-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <!-- item-->
                    <h6 class="dropdown-item-text">
                        Notifications (37)
                    </h6>
                    <div class="slimscroll notification-item-list">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="mdi mdi-flag"></i></div>
                            <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                        </a>
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
{{--                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())--}}
{{--                        <img src="{{ asset('/').Auth::user()->profile_photo_url }}" alt="user" class="rounded-circle">--}}
{{--                        @else--}}
                            <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&color=7F9CF5&background=EBF4FF" alt="user" class="rounded-circle">
{{--                        @endif--}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> {{Auth::user()->name}}</a>
{{--                        <a class="dropdown-item d-block" href="{{ route('profile.show') }}"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>--}}
                        <a class="dropdown-item d-block" href="{{ route('profile.show') }}"><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault();document.getElementById('logout').submit()"><i class="mdi mdi-power text-danger"></i> Logout</a>
                        {{Form::open(['method'=>'post','route'=>'logout','id'=>'logout'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect waves-light">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>



    </nav>

</div>
