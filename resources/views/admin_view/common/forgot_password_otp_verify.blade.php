<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Admin - OTP Verification</title>
        <!-- plugins:css -->

        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}" />
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" />
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}" />
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}" />
        <style>
          /* Custom CSS for vertical centering */
          .modal-dialog-centered {
              display: flex;
              align-items: center;
              min-height: calc(100% - 1rem);
          }
        </style>
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                                <div class="brand-logo mx-auto">
                                    <div class="mx-auto" style="width: 70px; height: 70px;"><img style="width: 70px; height: 70px;" src="{{ asset('admin_assets/images/logo-white.png') }}" alt="logo" /></div>
                                </div>
                                <h4>Email  verification</h4>
                                <h6 class="font-weight-light">We sent an email to your email address.</h6>
                                <form class="pt-3" method="POST" action="{{ route('admin_otp_verification_submit') }}">

                                    @if (session()->has('error'))
                                      <p class="mb-0 alert alert-danger">{{ session()->get('error') }}</p>
                                    @endif
                                    @if (session()->has('success'))
                                      <p class="mb-0 alert alert-success">{{ session()->get('success') }}</p>
                                    @endif
                    
                                    @csrf
                                    
                                    <div class="form-group">
                                        <input name="password_reset_token" type="text" class="form-control form-control-lg" id="exampleInputOtp" placeholder="OTP here.." />
                                        @error('password_reset_token')
                                        <p class="mb-0 alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3 d-grid gap-2">
                                        <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="Submit">
                                    </div>
                                    {{-- <div class="mb-2 d-grid gap-2">
                                        <button type="button" class="btn btn-block btn-facebook auth-form-btn"><i class="mdi mdi-facebook me-2"></i>Connect using facebook</button>
                                    </div> --}}
                                    {{-- <div class="text-center mt-4 font-weight-light">Don't have an account? <a href="{{ route('admin_register') }}" class="text-primary">Create!</a></div> --}}
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
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
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
        <script src="{{ asset('admin_assets/js/proBanner.js') }}"></script>

        <!-- End custom js for this page-->
        <script src="{{ asset('admin_assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <!-- endinject -->
                
        <!-- JavaScript to auto show modal on page load -->
        <script>
            $(document).ready(function(){
                $("#myModal").modal('show');
            });
        </script>

    </body>
</html>


