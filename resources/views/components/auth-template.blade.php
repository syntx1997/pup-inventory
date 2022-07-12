<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PUP Bansud Web-Based Inventory System" name="description" />
    <meta content="PUP Bansud BSIT Batch 2022" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start text-center">
                    <a href="/" class="logo-dark text-center">
                        <span><img src="{{ asset('images/PUP.png') }}" alt="" height="100"></span>
                        <h5 class="text-dark">
                            <strong>INVENTORY SYSTEM</strong>
                        </h5>
                    </a>
                    <a href="/" class="logo-light">
                        <span><img src="{{ asset('images/PUP.png') }}" alt="" height="100"></span>
                    </a>
                </div>

                <!-- title-->
                <h4 class="mt-0">{{ $title }}</h4>
                <p class="text-muted mb-4">{{ $description }}</p>

                {{ $slot }}

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            {{--                        <h2 class="mb-3">I love the color!</h2>--}}
            {{--                        <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very much! . <i class="mdi mdi-format-quote-close"></i>--}}
            {{--                        </p>--}}
            {{--                        <p>--}}
            {{--                            - Hyper Admin User--}}
            {{--                        </p>--}}
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>

<script src="{{ asset('js/global-vars.js') }}"></script>
<script src="{{ asset('js/form-validation.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>

</body>

</html>
