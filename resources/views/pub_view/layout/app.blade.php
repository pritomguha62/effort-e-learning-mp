<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title')</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Favicons -->
        <link href="{{ asset('pv_assets/img/favicon.ico') }}" rel="icon" />
        <link href="{{ asset('pv_assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link href="{{ asset('pv_assets/vendor/aos/aos.css') }}" rel="stylesheet" />
        <link href="{{ asset('pv_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('pv_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('pv_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('pv_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('pv_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

        <!-- Template Main CSS File -->
        <link href="{{ asset('pv_assets/css/style.css') }}" rel="stylesheet" />
    </head>

    <body>
        <!-- ======= Top Bar ======= -->
        <section id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:mpeffortelearning@gmail.com">mpeffortelearning@gmail.com</a></i>
                    {{-- <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i> --}}
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="mailto:mpeffortelearning@gmail.com" class="mail"><i class="bi bi-envelope"></i></a>
                    <a href="https://www.facebook.com/share/8ArHkTsELrrZa4wq/" class="facebook"><i class="bi bi-facebook"></i></a>
                    {{-- <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
                </div>
            </div>
        </section>

        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo">
                    <a href="{{ route('home') }}">
                        {{-- BizLand<span>.</span> --}}
                        <img src="{{ asset('pv_assets/img/logo-white.png') }}" alt="Logo" />
                    </a>
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="{{ route('home') }}#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link scrollto" href="#courses">Courses</a></li>
                        {{-- <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                        <li><a class="nav-link scrollto" href="#team">Team</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Drop Down 1</a></li>
                                <li class="dropdown">
                                    <a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Drop Down 1</a></li>
                                        <li><a href="#">Deep Drop Down 2</a></li>
                                        <li><a href="#">Deep Drop Down 3</a></li>
                                        <li><a href="#">Deep Drop Down 4</a></li>
                                        <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Drop Down 2</a></li>
                                <li><a href="#">Drop Down 3</a></li>
                                <li><a href="#">Drop Down 4</a></li>
                            </ul>
                        </li> --}}
                        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        <a class="btn btn-primary btn-sm col-3 col-md-2 col-lg-2 text-light py-2 px-2 mx-2" href="{{ route('member.login') }}">Login</a>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            </div>
        </header>
        <!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="zoom-out" data-aos-delay="100">
                <h1>Welcome to <span>Effort E-learning MP</span></h1>
                <h2>We are team of talented workers</h2>
                <div class="d-flex">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <main id="main">
            

            @yield('content')

        </main>
        <!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer">
            {{-- <div class="footer-newsletter">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h4>Join Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                            <form action="" method="post"><input type="email" name="email" /><input type="submit" value="Subscribe" /></form>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 footer-contact">
                            <h3> Effort E-learning MP<span>.</span></h3>
                            <p>
                                Sunamganj, <br />
                                Sylhet, <br />
                                Bangladesh <br />
                                <br />
                                {{-- <strong>Phone:</strong> +1 5589 55488 55<br /> --}}
                                <strong>Email:</strong> <a href="mailto:mpeffortelearning@gmail.com">mpeffortelearning@gmail.com</a><br />
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#about">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#courses">Courses</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('terms_condition') }}">Terms of service</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        {{-- <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                            </ul>
                        </div> --}}

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Social Networks</h4>
                            <p>Join with us.</p>
                            <div class="social-links mt-3">
                                <a href="#" class="mail"><i class="bx bxl-gmail"></i></a>
                                <a href="https://www.facebook.com/share/8ArHkTsELrrZa4wq/" class="facebook"><i class="bx bxl-facebook"></i></a>
                                {{-- <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container py-4 justify-content-center">
                <div class="copyright" style="float: none;">
                    &copy; Copyright {{ date('Y') }} <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer"><strong><span>Effort E-learning MP</span></strong></a>. All Rights Reserved
                </div>
                {{-- <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div> --}}
            </div>
        </footer>
        <!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('pv_assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('pv_assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('pv_assets/js/main.js') }}"></script>
    </body>
</html>


