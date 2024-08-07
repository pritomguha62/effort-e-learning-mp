
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('title')
  </title>
  <!-- Favicon -->
  <link href="{{ asset('member_assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('member_assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ asset('member_assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('member_assets/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />

  <!-- Custom CSS -->
  <style>

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

  
@php
function getCurrentUrl() {
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  return $url;
}

function urlContainsWord($word) {
    $url = getCurrentUrl();
    return strpos($url, $word) !== false;
}

$word = "dashboard";  // Replace with the word you are looking for

if (urlContainsWord($word)) {
    // echo "The word '$word' was found in the URL.";
    // Perform your desired action here

@endphp


<style>

/* Mobile styles */
// @media only screen and (max-width: 768px) {
    // #header_body {
    //   display: none;
    // }
// }

/* Desktop styles */
// @media only screen and (min-width: 769px) {
    #header_body {
      display: block;
    }
// }

</style>


@php
} else {
@endphp

<style>

  /* Mobile styles */
  @media only screen and (min-width: 144px) {
      #header_body {
        display: none;
      }
  }

  /* Desktop styles */
  // @media only screen and (min-width: 769px) {
      // #header_body {
        // display: block;
  //     }
  // }

</style>

@php
  
// echo "The word '$word' was not found in the URL.";
}
@endphp
  
</head>

<body class="">
  @php
    $member = App\Models\Member_user::member();
    $refered_inactive_member = App\Models\Member_user::refered_inactive_member();
    $refered_active_member = App\Models\Member_user::refered_active_member();
    $seo = App\Models\Member_user::member_seo();
    $eo = App\Models\Member_user::member_eo();
    $executive = App\Models\Member_user::member_executive();
  @endphp
  
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('pv_assets/img/logo-white.png') }}" class="navbar-brand-img" alt="Logo">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('storage/uploads/pro_pic/'.Session()->get('pro_pic')) }}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="{{ route('member_profile') }}" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="https://chat.whatsapp.com/Hdox5zos9AMJ1FyzJHD8XN" target="_blank" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <a href="https://www.facebook.com/profile.php?id=61560066055093" target="_blank" class="dropdown-item">
              <i class="ni ni-briefcase-24"></i>
              <span>My Business</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ route('member.dashboard') }}">
                <img src="./assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none" method="POST" action="{{ route('search_data_member_panel') }}">
          @csrf
          <div class="input-group input-group-rounded input-group-merge">
            <input type="text" name="search_data" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <button type="submit"><span class="fa fa-search"></span></button>
              </div>
            </div>
          </div>
        </form>
        
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('member.dashboard') }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('member_passbook') }}">
              <i class="ni ni-map-big text-blue"></i> Passbook
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('member_debit_passbook') }}">
              <i class="ni ni-bullet-list-67 text-blue"></i> Withdraw Passbook
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('member_payment_methods') }}">
              <i class="ni ni-align-left-2 text-green"></i> Withdraw
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('member_references') }}">
              <i class="ni ni-tag text-yellow"></i> Reference History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('view_member_courses') }}">
              <i class="ni ni-book-bookmark text-info"></i> Courses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('member_password') }}">
              <i class="ni ni-key-25 text-red"></i> Change Password
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="./examples/register.html">
              <i class="ni ni-circle-08 text-pink"></i> Register
            </a>
          </li> --}}
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        {{-- <h6 class="navbar-heading text-muted">Documentation</h6> --}}
        <!-- Navigation -->
        {{-- <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="ni ni-spaceship"></i> Getting started
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
              <i class="ni ni-palette"></i> Foundation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li>
        </ul> --}}
        {{-- <ul class="navbar-nav">
          <li class="nav-item active active-pro">
            <a class="nav-link" href="./examples/upgrade.html">
              <i class="ni ni-send text-dark"></i> Upgrade to PRO
            </a>
          </li>
        </ul> --}}
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('member.dashboard') }}">Dashboard</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" method="POST" action="{{ route('search_data_member_panel') }}">
          @csrf
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input name="search_data" class="form-control" placeholder="Search" type="text">
              <button class="btn btn-info rounded-circle"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('storage/uploads/pro_pic/'.session()->get('pro_pic')) }}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ session()->get('name') }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="{{ route('member_profile') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              {{-- <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a> --}}
              <a href="https://chat.whatsapp.com/Hdox5zos9AMJ1FyzJHD8XN" target="_blank" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <a href="https://www.facebook.com/profile.php?id=61560066055093" target="_blank" class="dropdown-item">
                <i class="ni ni-briefcase-24"></i>
                <span>My Business</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body" id="header_body">
          
          <!-- Card stats -->
          <div class="row">

            <div class="col-xl-12 col-lg-12 mx-auto mb-4">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">

                    <div class="card-header border-0 text-center">
                      <h2 class="mb-2" style="font-size: 30px;">Welcome To <strong class="text-warning" style="font-size: 35px;">Effort E-learning MP</strong></h2><br>
                      <h4 class="mb-2"><span style="font-size: 25px;">{{ session()->get('name') }}</span></h4>
                      <b class="mb-2 text-info"><span style="font-size: 20px;">Member</span></b>
                      <p class="mb-md-0 text-success"><marquee behavior="" direction="right">
                          ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                      </marquee></p>
                    </div>
              
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span> --}}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Balance</h5>
                      <span class="h2 font-weight-bold mb-0">
                        @if ( $member->balance == null)
                          0
                          @else
                          {{ $member->balance }}
                        @endif
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span> --}}
                  </p>
                </div>
              </div>
            </div>
            @if (!empty($seo->whatsapp))

            <div class="col-xl-3 col-lg-6 seo_card">
              <div class="card card-stats mb-4 mb-xl-0">

                  <a href="https://wa.me/{{ $seo->whatsapp }}" target="_blank" rel="noopener noreferrer">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">SEO</h5>
                          <span class="h2 font-weight-bold mb-0"><i class="fas fa-comments"></i></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        {{-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> SEO</span>
                        <span class="text-nowrap">Since last week</span> --}}
                      </p>
                    </div>
                  </a>

              </div>
            </div>

            @endif
            
            
            @if (!empty($eo->whatsapp))

            <div class="col-xl-3 col-lg-6 eo_card">
              <div class="card card-stats mb-4 mb-xl-0">
                
                  <a href="https://wa.me/{{ $eo->whatsapp }}" target="_blank" rel="noopener noreferrer">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">EO</h5>
                          <span class="h2 font-weight-bold mb-0"> <i class="fas fa-comments"></i></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                            <i class="fas fa-address-card"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        {{-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> EO</span>
                        <span class="text-nowrap">Since yesterday</span> --}}
                      </p>
                    </div>
                  </a>
                
              </div>
            </div>

            @endif

            @if (!empty($executive->whatsapp))

            <div class="col-xl-3 col-lg-6 e_card">
              <div class="card card-stats mb-4 mb-xl-0">

                  <a href="https://wa.me/{{ $executive->whatsapp }}" target="_blank" rel="noopener noreferrer">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Executive</h5>
                          <span class="h2 font-weight-bold mb-0"> <i class="fas fa-comments"></i></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-address-book"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        {{-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> Executive</span>
                        <span class="text-nowrap">Since last month</span> --}}
                      </p>
                    </div>
                  </a>

              </div>
            </div>

            @endif

            <h4 class="mx-auto text-center mobile_card col-12" style="font-size: 24px; font-weight: bold;">My Support</h4>
            <div class="mx-auto mt-3 mobile_card container_fluid" style="border: 10px solid #ee82ee;">
              @if (!empty($seo->whatsapp))

              <div class="col-xl-3 col-lg-6 mt-3">
                <div class="card card-stats mb-4 mb-xl-0">
  
                    <a href="https://wa.me/{{ $seo->whatsapp }}" target="_blank" rel="noopener noreferrer">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">SEO</h5>
                            <span class="h2 font-weight-bold mb-0"><i class="fas fa-comments"></i></span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                              <i class="fas fa-users"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                          {{-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> SEO</span>
                          <span class="text-nowrap">Since last week</span> --}}
                        </p>
                      </div>
                    </a>
  
                </div>
              </div>
  
              @endif
              
              
              @if (!empty($eo->whatsapp))
  
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  
                    <a href="https://wa.me/{{ $eo->whatsapp }}" target="_blank" rel="noopener noreferrer">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">EO</h5>
                            <span class="h2 font-weight-bold mb-0"> <i class="fas fa-comments"></i></span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                              <i class="fas fa-address-card"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                          {{-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> EO</span>
                          <span class="text-nowrap">Since yesterday</span> --}}
                        </p>
                      </div>
                    </a>
                  
                </div>
              </div>
  
              @endif
  
              @if (!empty($executive->whatsapp))
  
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
  
                    <a href="https://wa.me/{{ $executive->whatsapp }}" target="_blank" rel="noopener noreferrer">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Executive</h5>
                            <span class="h2 font-weight-bold mb-0"> <i class="fas fa-comments"></i></span>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                              <i class="fas fa-address-book"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                          {{-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> Executive</span>
                          <span class="text-nowrap">Since last month</span> --}}
                        </p>
                      </div>
                    </a>
  
                </div>
              </div>
  
              @endif
  
            </div>
            
          </div>

          
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-12 mb-4 mt-4 mx-auto">
              {{-- <div class="card card-stats mb-4 mb-xl-0"> --}}
                <div style="background-color: #212529; width: 100%; background-position: center center; transition: all 0.7s ease; background-size: cover; margin: auto;" id="slide">
                        
                  <div class="mx-auto;">

                  </div>

                </div>
              {{-- </div> --}}
            </div>

          </div>

        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      {{-- <div class="row" style="width: 100%!important;"> --}}
        {{-- <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card bg-gradient-default shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                  <h2 class="text-white mb-0">Sales value</h2>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Month</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Week</span>
                        <span class="d-md-none">W</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h2 class="mb-0">Total orders</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="chart-orders" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div> --}}
        @yield('content')
      {{-- </div> --}}
      {{-- <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Page visits</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Page name</th>
                    <th scope="col">Visitors</th>
                    <th scope="col">Unique users</th>
                    <th scope="col">Bounce rate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      /argon/
                    </th>
                    <td>
                      4,569
                    </td>
                    <td>
                      340
                    </td>
                    <td>
                      <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/index.html
                    </th>
                    <td>
                      3,985
                    </td>
                    <td>
                      319
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/charts.html
                    </th>
                    <td>
                      3,513
                    </td>
                    <td>
                      294
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/tables.html
                    </th>
                    <td>
                      2,050
                    </td>
                    <td>
                      147
                    </td>
                    <td>
                      <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/profile.html
                    </th>
                    <td>
                      1,795
                    </td>
                    <td>
                      190
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Social traffic</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Referral</th>
                    <th scope="col">Visitors</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      1,480
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">60%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      5,480
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">70%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Google
                    </th>
                    <td>
                      4,807
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">80%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Instagram
                    </th>
                    <td>
                      3,678
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">75%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      twitter
                    </th>
                    <td>
                      2,645
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">30%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between mt-5">
          <div class="col-xl-6 mt-5">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; {{ date('Y') }} <a href="{{ route('home') }}" class="font-weight-bold ml-1" target="_blank">Effort E-learning MP</a>
            </div>
          </div>
          <div class="col-xl-6 mt-5">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item row">
                Made by <a href="https://wa.me/+8801734167539" class="nav-link" target="_blank">Holy IT</a>
              </li>
              {{-- <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li> --}}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  <script src="{{ asset('member_assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('member_assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   Optional JS   -->
  <script src="{{ asset('member_assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('member_assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
  <!--   Argon JS   -->
  <script src="{{ asset('member_assets/js/argon-dashboard.min.js?v=1.1.2') }}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
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

    
</body>

</html>



