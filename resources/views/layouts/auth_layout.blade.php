<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Abstack - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg bg-gradient">

            <div class="account-pages mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-pattern">

                                <div class="card-body p-4">

                                    <div class="text-center w-75 m-auto">
                                        <a href="index.html">
                                            <span><img src="{{ asset('admin') }}/images/logo-dark.png" alt="" height="18"></span>
                                        </a>
                                        <h5 class="text-uppercase text-center font-bold mt-4">@yield('page-title')</h5>

                                    </div>

                                   @yield('main-content')


                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->



                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->


        <!-- Vendor js -->
        <script src="{{ asset('admin') }}/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="{{ asset('admin') }}/js/app.min.js"></script>

    </body>
</html>
