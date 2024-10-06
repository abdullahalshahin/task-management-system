<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_title ?? '' }} {{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />  

        {{ $style ?? '' }}
    </head>
    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark", "layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="wrapper">
            <div class="leftside-menu">
                <a href="{{ url('admin-panel/dashboard') }}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
                    </span>
                </a>

                <a href="{{ url('admin-panel/dashboard') }}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo_sm_dark.png') }}" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <ul class="side-nav">
                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-success float-end">0</span>
                                <span> Dashboards </span>
                            </a>
                            
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{ url('admin-panel/dashboard') }}">Analytics</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-title side-nav-item">Apps</li>

                        <li class="side-nav-item">
                            <a href="{{ url('admin-panel/dashboard/tasks') }}" class="side-nav-link">
                                <i class="uil-briefcase"></i>
                                <span> Task </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{ url('admin-panel/dashboard/to-dos') }}" class="side-nav-link">
                                <i class="uil-briefcase"></i>
                                <span> ToDo </span>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="content-page">
                <div class="content">
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <span class="account-user-avatar"> 
                                        @if (Auth::user()->profile_image)
                                            <img src="{{ url('images/clients', Auth::user()->profile_image) }}" alt="{{ Auth::user()->full_name ?? "" }}" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/images/avator.png') }}" alt="user-image" class="rounded-circle">
                                        @endif
                                    </span>
                                    <span>
                                        <span class="account-user-name">{{ Auth::user()->name ?? "" }}</span>
                                        <span class="account-position">{{ Auth::user()->email ?? "" }}</span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                    <div class=" dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome !</h6>
                                    </div>

                                    <a href="{{ url('admin-panel/dashboard/my-account') }}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span>My Account</span>
                                    </a>

                                    <a href="{{ url('/') }}" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit me-1"></i>
                                        <span>Home</span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
    
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout me-1"></i>
                                            <span>Logout</span>
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- =============================================================== -->
                    <main>
                        {{ $slot }}
                    </main>
                    <!-- =============================================================== -->
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                Copyright © <script>document.write(new Date().getFullYear())</script> <a href="https://google.com">Google </a> | All Rights Reserved
                            </div>

                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="rightbar-overlay"></div>

        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        {{ $script ?? '' }}
    </body>
</html>
