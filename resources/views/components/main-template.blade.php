
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PUP Bansud Web-Based Inventory System" name="description" />
    <meta content="PUP Bansud BSIT Batch 2022" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

    <!-- Datatables css -->
    <link href="{{ asset('css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<!-- Begin page -->
<div class="wrapper">
    @include($fragment['sidebar'])
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            @include($fragment['topbar'])

            <!-- Start Content-->
            <div class="container-fluid">

                {{ $slot }}

            </div> <!-- container -->

        </div> <!-- content -->

        @include('partials._footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>

<!-- Datatables js -->
<script src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/vendor/responsive.bootstrap5.min.js') }}"></script>

<!-- Sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--Page Script--}}
<script src="{{ asset('js/form-validation.js') }}"></script>
<script src="{{ asset('js/logout.js') }}"></script>
<script src="{{ $js ?? '' }}"></script>

</body>
</html>
