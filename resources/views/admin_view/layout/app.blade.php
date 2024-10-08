<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>@yield('title')</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}" />
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" />
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> --}}
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <!-- DataTables Bootstrap 4 CSS -->
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}" />
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}" />
        <style>
            /* input{
                border: 1px solid rgb(0, 0, 0)!important;
            } */
/*
            select{
                border: 1px solid rgb(0, 0, 0)!important;
            }
            select option{
                color: rgba(0, 0, 0, 0.958);
            } */
        </style>

        @if (session()->get('admin_id') == null)
            <script>
                // Function to disable all events
                function disableAllEvents(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }

                // Disable mouse events
                document.addEventListener('mousedown', disableAllEvents, true);
                document.addEventListener('mouseup', disableAllEvents, true);
                document.addEventListener('click', disableAllEvents, true);
                document.addEventListener('dblclick', disableAllEvents, true);
                document.addEventListener('contextmenu', disableAllEvents, true);

                // Disable keyboard events
                document.addEventListener('keydown', disableAllEvents, true);
                document.addEventListener('keypress', disableAllEvents, true);
                document.addEventListener('keyup', disableAllEvents, true);

                // Disable touch events
                document.addEventListener('touchstart', disableAllEvents, true);
                document.addEventListener('touchend', disableAllEvents, true);
                document.addEventListener('touchmove', disableAllEvents, true);
                document.addEventListener('touchcancel', disableAllEvents, true);

                console.log('All mouse, keyboard, and touch events are disabled.');

            </script>
        @endif

        <!-- Custom CSS -->
        <style>

        /* Mobile styles */
        @media only screen and (min-width: 144px) and (max-width: 768px) {
            #mobile_search {
                display: block;
            }
        }

        /* Mobile styles */
        @media only screen and (min-width: 769px) {
            #mobile_search {
                display: none;
            }
        }

        /* Mobile styles */
        @media only screen and (max-width: 426px) {
            .mobile_card {
                display: block;
            }
            .seo_card {
                display: none;
            }
            .eo_card {
                display: none;
            }
            .e_card {
                display: none;
            }
            #slide {
                height: 25vh;
            }
        }

        /* Tablet styles */
        @media only screen and (min-width: 430px) and (max-width: 768px) {
            #slide {
                height: 35vh;
            }
        }

        /* Desktop styles */
        @media only screen and (min-width: 430px) {
            .mobile_card {
                display: none;
            }
            .seo_card {
                display: block;
            }
            .eo_card {
                display: block;
            }
            .e_card {
                display: block;
            }
        }

        /* Desktop styles */
        @media only screen and (min-width: 769px) and (max-width: 1024px) {
            #slide {
                height: 50vh;
            }
        }

        /* Desktop styles */
        @media only screen and (min-width: 1025px) {
            #slide {
                height: 80vh;
            }
        }

        </style>

    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:../../partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex justify-content-center">
                    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><div style="width: 50px;"><img src="{{ asset('admin_assets/images/logo-white.png') }}" alt="logo" /></div></a>
                        <a class="navbar-brand brand-logo-white" href="{{ route('admin.dashboard') }}"><div style="width: 50px;"><img src="{{ asset('admin_assets/images/logo-white.png') }}" alt="logo" /></div></a>
                        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><div style="width:30px;"><img src="{{ asset('admin_assets/images/logo-white.png') }}" alt="logo" /></div></a>
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-sort-variant"></span>
                        </button>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav me-lg-6 w-100 row">
                        <form action="{{ route('search_data_admin_panel') }}" method="POST" class="w-100 row">
                            @csrf
                            <li class="nav-item nav-search d-none d-lg-block col-8 col-md-8 col-lg-8">
                                <div class="input-group">
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text" id="search">

                                        </span>
                                    </div> --}}
                                    <input type="text" name="search_data" class="form-control" placeholder="Search now" aria-label="search" value="{{ old('search_data') }}" aria-describedby="search" />
                                    @error('search_data')
                                        <p class="mb-0 alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </li>
                            <li class="nav-item nav-search d-none d-lg-block col-2 col-md-2 col-lg-2">
                                <button class="btn btn-info" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </li>
                        </form>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        {{-- <li class="nav-item dropdown me-1">
                            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                <i class="mdi mdi-message-text mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../../assets/images/faces/face4.jpg" alt="image" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal">David Grey</h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            The meeting is cancelled
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../../assets/images/faces/face2.jpg" alt="image" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook</h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            New product launch
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../../../assets/images/faces/face3.jpg" alt="image" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal">Johnson</h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            Upcoming board meeting
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown me-4">
                            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                <i class="mdi mdi-bell mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="mdi mdi-information mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Just now
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-weather-sunny mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Settings</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Private message
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-account-box mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            2 days ago
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li> --}}
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                <img src="{{ asset('storage/uploads/pro_pic/'.Session()->get('pro_pic')) }}" alt="profile" />
                                <span class="nav-profile-name">{{ Session()->get('name') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('admin_profile') }}">
                                    <i class="mdi mdi-account-circle text-primary"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="https://chat.whatsapp.com/Hdox5zos9AMJ1FyzJHD8XN" target="_blank">
                                    <i class="mdi mdi-comment-account text-primary"></i>
                                    Support
                                </a>
                                <a class="dropdown-item">
                                    <i class="mdi mdi-cog text-primary"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>

                                <form action="{{ route('search_data_admin_panel') }}" method="POST" id="mobile_search" class="w-100 row mx-auto text-center">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="search_data" class="form-control" placeholder="Search now" aria-label="search" value="{{ old('search_data') }}" aria-describedby="search" />
                                        @error('search_data')
                                            <p class="mb-0 alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button style="width: 70px;" class="btn mx-auto btn-info" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item nav-settings d-none d-lg-flex">
                            <a class="nav-link" href="#">
                                <i class="mdi mdi-apps"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:../../partials/_sidebar.html -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.passbooks') }}">
                                <i class="mdi mdi-book-open-variant menu-icon"></i>
                                <span class="menu-title">Passbook</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.debit_passbooks') }}">
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                                <span class="menu-title">Withdraw Passbook</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payment_methods') }}">
                                <i class="mdi mdi-format-list-checks menu-icon"></i>
                                <span class="menu-title">Withdrawals</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#refer_history" aria-expanded="false" aria-controls="refer_history">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Reference History</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="refer_history">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('refer_admins') }}">Refer Admins</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('refer_members') }}">Refer Members</a></li>
                                </ul>
                            </div>
                        </li>


                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <i class="mdi mdi-circle-outline menu-icon"></i>
                                <span class="menu-title">UI Elements</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="../../pages/ui-features/buttons.html">Buttons</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/ui-features/dropdowns.html">Dropdowns</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li>
                                </ul>
                            </div>
                        </li> --}}

                        @if (session()->get('role_id') == 1 or session()->get('role_id') == 2 or session()->get('role_id') == 9 or session()->get('role_id') == 10)

                        @if (session()->get('role_id') !== 10)
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#courses" aria-expanded="false" aria-controls="courses">
                                    <i class="mdi mdi-book-open menu-icon"></i>
                                    <span class="menu-title">Courses</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="courses">
                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"><a class="nav-link" href="{{ route('view_courses') }}">View Courses</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('add_course') }}">Add Course</a></li>

                                    </ul>
                                </div>
                            </li>
                        @endif

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#classes" aria-expanded="false" aria-controls="classes">
                                    <i class="mdi mdi-format-align-left menu-icon"></i>
                                    <span class="menu-title">Classes</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="classes">
                                    <ul class="nav flex-column sub-menu">

                                        <li class="nav-item"><a class="nav-link" href="{{ route('view_classes') }}">View Classes</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('create_class') }}">Create Class</a></li>

                                    </ul>
                                </div>
                            </li>

                        @endif

                        @if (session()->get('role_id') == 1 or session()->get('role_id') == 2 or session()->get('role_id') == 7 or session()->get('role_id') == 8)

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#approvals" aria-expanded="false" aria-controls="approvals">
                                <i class="mdi mdi-account-check menu-icon"></i>
                                <span class="menu-title">Approvals</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="approvals">
                                <ul class="nav flex-column sub-menu">
                                    @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('join_requests') }}">Join Requests</a></li>
                                    @endif
                                    @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('withdraw_approvals') }}">Withdraw Approvals</a></li>
                                    @endif
                                    @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('pending_approvals') }}">Pending Approvals</a></li>
                                    @endif
                                    @if (session()->get('role_id') == 1)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('dg_approvals') }}">DG Approval</a></li>
                                    @endif
                                    @if (session()->get('role_id') == 2)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('director_approvals') }}">Director Approval</a></li>
                                    @endif
                                    {{-- @if (session()->get('role_id') == 4)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('seo_approvals') }}"> SEO Approval </a></li>
                                    @endif
                                    @if (session()->get('role_id') == 5)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('eo_approvals') }}"> EO Approval </a></li>
                                    @endif
                                    @if (session()->get('role_id') == 6)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('executive_approvals') }}"> Executive Approval </a></li>
                                    @endif --}}
                                    @if (session()->get('role_id') == 7)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('cp_approvals') }}"> CP Approval </a></li>
                                    @endif
                                    @if (session()->get('role_id') == 8)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('presenter_approvals') }}"> Presenter Approval </a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>

                        @endif

                        @if (session()->get('role_id') == 4 or session()->get('role_id') == 5 or session()->get('role_id') == 6 or session()->get('role_id') == 7 or session()->get('role_id') == 8 or session()->get('role_id') == 9 or session()->get('role_id') == 10)

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#my_team" aria-expanded="false" aria-controls="my_team">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">My Team</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="my_team">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('my_members') }}">My Members</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('all_teachers') }}">All Teachers</a></li>
                                </ul>
                            </div>
                        </li>

                        @endif

                        @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#member_panel" aria-expanded="false" aria-controls="member_panel">
                                <i class="mdi mdi-account-box menu-icon"></i>
                                <span class="menu-title">Member Panel</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="member_panel">
                                <ul class="nav flex-column sub-menu">
                                    @if (session()->get('email') == 'pritomguha62@gmail.com' or session()->get('email') == 'holy.it01@gmail.com' or session()->get('email') == 'mukaddasluvan@gmail.com' or session()->get('email') == 'priyaakter01749@gmail.com' or session()->get('email') == 'mahdimir4455@gmail.com')
                                        <li class="nav-item"><a class="nav-link" href="{{ route('all_members') }}">All Members</a></li>
                                    @endif
                                    @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)

                                        <li class="nav-item"><a class="nav-link" href="{{ route('todays_leads') }}">Todays Leads</a></li>

                                    @endif
                                    <li class="nav-item"><a class="nav-link" href="{{ route('active_members') }}">Active Members</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('inactive_members') }}">Inactive Members</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" href="../../pages/samples/error-404.html"> Head Teachers </a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/samples/error-404.html"> Teachers </a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li> --}}
                                </ul>
                            </div>
                        </li>

                        @endif

                        @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#admin_panel" aria-expanded="false" aria-controls="admin_panel">
                                <i class="mdi mdi-security menu-icon"></i>
                                <span class="menu-title">Admin Panel</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="admin_panel">
                                <ul class="nav flex-column sub-menu">
                                    {{-- <li class="nav-item"><a class="nav-link" href="../../pages/samples/blank-page.html"> All Admin </a></li> --}}
                                    @if (session()->get('email') == 'pritomguha62@gmail.com' or session()->get('email') == 'holy.it01@gmail.com' or session()->get('email') == 'mukaddasluvan@gmail.com' or session()->get('email') == 'priyaakter01749@gmail.com' or session()->get('email') == 'mahdimir4455@gmail.com')
                                        <li class="nav-item"><a class="nav-link" href="{{ route('all_admins') }}"> All Admins </a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link" href="{{ route('active_admins') }}"> Active Admin </a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('inactive_admins') }}"> Inactive Admin </a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../pages/samples/register.html"> Register </a></li> --}}
                                </ul>
                            </div>
                        </li>

                        @endif

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="../../../docs/documentation.html">
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                                <span class="menu-title">Documentation</span>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:../../partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }} <a href="{{ route('home') }}" target="_blank">Effort E-learning MP</a>. All rights reserved.</span>
                            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made by <i class="mdi mdi-heart text-danger"></i><a href="https://wa.me/+8801734167539" target="_blank" rel="noopener noreferrer">Holy IT</a></span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- custom js -->
        <script>

            // $(document).ready(function(){
            //     $("#myInput").on("keyup", function() {
            //         var value = $(this).val().toLowerCase();
            //         $("#myTable tr").filter(function() {
            //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //         });
            //     });
            // });

        </script>

        <script>
            var i = 0;
            var images = [];
            var time = 6000;
            images[0] = "url({{asset('storage/uploads/site_elements/slide01.png')}})";
            images[1] = "url({{asset('storage/uploads/site_elements/slide02.png')}})";
            images[2] = "url('{{asset('storage/uploads/site_elements/slide03.png')}})";
            images[3] = "url({{asset('storage/uploads/site_elements/slide04.png')}})";
            function changeImg() {
                document.getElementById("slide").style.backgroundImage = images[i];
                if (i<images.length - 1) {
                    i++;
                }else{
                    i = 0;
                }
                setTimeout("changeImg()", time);
            }
            window.onload = changeImg;
        </script>


        <!-- custom js -->

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <!-- DataTables Bootstrap 4 JS -->
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <!-- plugins:js -->
        <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{ asset('admin_assets/vendors/chart.js/chart.umd.js') }}"></script>
        <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin_assets/js/template.js') }}"></script>
        <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
        <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
        <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
        <script src="{{ asset('admin_assets/js/proBanner.js') }}"></script>

        <!-- End custom js for this page-->
        <script src="{{ asset('admin_assets/js/jquery.cookie.js') }}" type="text/javascript"></script>


        <script>
            $(document).ready(function() {

                // $('#inactive_admins').DataTable();
                // $('#inactive_admins').prop('disabled', false);
                // $('#active_admins').DataTable();
                // $('#inactive_members').DataTable();
                // $('#active_members').DataTable();



            });
            </script>

            <script>
                $(document).ready(function() {
                    $('#filterButton').click(function() {
                        var startTimestamp = $('#startTimestamp').val();
                        var endTimestamp = $('#endTimestamp').val();

                        $('tbody tr').each(function() {
                            var rowTimestamp = $(this).find('td:nth-last-child(2)').text();

                            if (isWithinRange(rowTimestamp, startTimestamp, endTimestamp)) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });

                    function isWithinRange(timestamp, start, end) {
                        var timestampDate = new Date(timestamp);
                        var startDate = new Date(start);
                        var endDate = new Date(end);

                        return (timestampDate >= startDate && timestampDate <= endDate);
                    }

                });

                // $(document).ready(function() {
                //     $('#filterButton').click(function() {
                //         var startTimestamp = $('#startTimestamp').val();
                //         var endTimestamp = $('#endTimestamp').val();

                //         $('#filterTableMember tbody tr').each(function() {
                //             var rowTimestamp = $(this).find('td:nth-last-child(2)').text();

                //             if (isWithinRange(rowTimestamp, startTimestamp, endTimestamp)) {
                //                 $(this).show();
                //             } else {
                //                 $(this).hide();
                //             }
                //         });
                //     });

                //     function isWithinRange(timestamp, start, end) {
                //         var timestampDate = new Date(timestamp);
                //         var startDate = new Date(start);
                //         var endDate = new Date(end);

                //         return (timestampDate >= startDate && timestampDate <= endDate);
                //     }
                // });
            </script>

    </body>
</html>


