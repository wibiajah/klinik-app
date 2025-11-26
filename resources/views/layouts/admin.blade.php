<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $title . ' - Klinik Marchsya' ?? 'Klinik Marchsya' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template (SB Admin 2 + Bootstrap 4.6) -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- jQuery (Required for Bootstrap 4 and SB Admin 2) -->
    <script defer src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Bundle with Popper (Bootstrap 4.6) -->
    <script defer src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script defer src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script defer src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <!-- Chart.js v2.9.4 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CKEditor 5 Classic Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<style>
    /* Hanya target text elements, bukan icon */
    p, span, div, h1, h2, h3, h4, h5, h6, a, td, th, li, label, input, textarea, select, button {
        color: #000000 !important;
        font-weight: bold !important;
    }
    
    /* Override Bootstrap text classes */
    .text-muted, .text-secondary, .text-gray-600, .text-gray-500, .text-gray-400 {
        color: #000000 !important;
    }
    
    .text-dark, .text-light, .text-white, .text-primary, .text-info, .text-warning, .text-danger, .text-success {
        color: #000000 !important;
    }
    
    /* Pastikan icon tetap warna aslinya */
    i, .fas, .far, .fab, .fal, svg {
        color: inherit !important;
        font-weight: inherit !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>@Allright Reserved by: <a href="#" target="_blank">Klinik Marchsya                           </a></span>

                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    @yield('scripts')
</body>

</html>
