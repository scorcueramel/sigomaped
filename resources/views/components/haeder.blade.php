<?php
    $usuario = \App\Models\User::find(Auth::id())->with('persona')->get()[0];
  ?>

<header class="main-header">
    <!-- Logo -->
    <a href="index.html" class="logo">
        <!-- mini logo -->
        <b class="logo-mini">
            <span class="light-logo"><img src="{{ asset('assets/images/logo-light.png') }}" alt="logo"></span>
            <span class="dark-logo"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo"></span>
        </b>
        <!-- logo-->
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-light-text.png')}}" alt="logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-dark-text.png')}}" alt="logo" class="dark-logo">
        </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            {{-- <div class="btn-group d-none d-lg-inline-block mt-5">
                <button class="btn dropdown-toggle mr-10 btn-outline btn-white" type="button" data-toggle="dropdown">Dashboard</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://html-templates.multipurposethemes.com/bootstrap-4/admin/fab-admin/src/"><i class="fa fa-dashboard w-30"></i>Main Dashboard</a>
                    <a class="dropdown-item" href="http://html-templates.multipurposethemes.com/bootstrap-4/admin/fab-admin/ecommerce-dashboard/"><i class="fa fa-shopping-basket w-30"></i>eCommerce Dashboard</a>
                    <a class="dropdown-item" href="http://html-templates.multipurposethemes.com/bootstrap-4/admin/fab-admin/hospital-dashboard/"><i class="fa fa-heartbeat w-30"></i>Hospital Dashboard</a>
                    <a class="dropdown-item" href="http://html-templates.multipurposethemes.com/bootstrap-4/admin/fab-admin/horizontal-nav/main"><i class="fa fa-bars w-30"></i>Horizontal Nav Dashboard</a>
                    <a class="dropdown-item" href="http://html-templates.multipurposethemes.com/bootstrap-4/admin/fab-admin/horizontal-nav/real-estate-dashboard"><i class="fa fa-building w-30"></i>Real Estate Dashboard</a>
                </div>
            </div> --}}
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                {{-- <li class="search-box">
                    <a class="nav-link hidden-sm-down" href="javascript:void(0)"><i class="mdi mdi-magnify"></i></a>
                    <form class="app-search" style="display: none;">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li> --}}

                <!-- Messages -->
                {{-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-email"></i>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <li class="header">You have 5 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu inner-content-div">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('assets/images/user2-160x160.jpg')}}" class="rounded-circle" alt="User Image">
                                        </div>
                                        <div class="mail-contnet">
                                            <h4>
                                                Lorem Ipsum
                                                <small><i class="fa fa-clock-o"></i> 15 mins</small>
                                            </h4>
                                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                                        </div>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('assets/images/user3-128x128.jpg')}}" class="rounded-circle" alt="User Image">
                                        </div>
                                        <div class="mail-contnet">
                                            <h4>
                                                Nullam tempor
                                                <small><i class="fa fa-clock-o"></i> 4 hours</small>
                                            </h4>
                                            <span>Curabitur facilisis erat quis metus congue viverra.</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('assets/images/user4-128x128.jpg')}}" class="rounded-circle" alt="User Image">
                                        </div>
                                        <div class="mail-contnet">
                                            <h4>
                                                Proin venenatis
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <span>Vestibulum nec ligula nec quam sodales rutrum sed luctus.</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('assets/images/user3-128x128.jpg')}}" class="rounded-circle" alt="User Image">
                                        </div>
                                        <div class="mail-contnet">
                                            <h4>
                                                Praesent suscipit
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <span>Curabitur quis risus aliquet, luctus arcu nec, venenatis neque.</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ asset('assets/images/user4-128x128.jpg')}}" class="rounded-circle" alt="User Image">
                                        </div>
                                        <div class="mail-contnet">
                                            <h4>
                                                Donec tempor
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <span>Praesent vitae tellus eget nibh lacinia pretium.</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See all e-Mails</a></li>
                    </ul>
                </li> --}}
                <!-- Notifications -->
                {{-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-bell"></i>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <li class="header">You have 7 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu inner-content-div">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> Curabitur id eros quis nunc suscipit blandit.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> In gravida mauris et nisi
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> Praesent eu lacus in libero dictum fermentum.
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> Nunc fringilla lorem
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li> --}}
                <!-- Tasks-->
                {{-- <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="mdi mdi-message"></i>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <li class="header">You have 6 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu inner-content-div">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Lorem ipsum dolor sit amet
                                            <small class="pull-right">30%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 30%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">30% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Vestibulum nec ligula
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 20%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Donec id leo ut ipsum
                                            <small class="pull-right">70%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-light-blue" style="width: 70%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Praesent vitae tellus
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 40%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Nam varius sapien
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 80%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Nunc fringilla
                                            <small class="pull-right">90%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-primary" style="width: 90%" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">90% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li> --}}
                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/images/user5-128x128.jpg')}}" class="user-image rounded-circle" alt="User Image">
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <!-- User image -->
                        <li class="p-2">
                            <p>
                                {{ $usuario->persona->nombres.' '.$usuario->persona->apellidos }}
                                <small>{{ $usuario->email}}</small>
                                <!-- <a href="#" class="btn btn-danger btn-sm btn-rounded">View Profile</a> -->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row no-gutters">
                                <div class="col-12 text-left">
                                    <a href="#"><i class="ion ion-person"></i> Mi Perfíl</a>
                                </div>
                                <div role="separator" class="divider col-12"></div>
                                <div class="col-12 text-left">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
