<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Template Main CSS File -->

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/boxicons/fonts/basic/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/boxicons/fonts/animations.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/boxicons/fonts/transformations.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/notiflix/src/notiflix.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/datatables/datatables.min.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('layouts.header')
    @include('layouts.sidebar')
    <main id="main" class="main">

        @yield('container')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Gerakan Pemuda / i dan Remaja Kebon Cau</span></strong>. 2024
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
<script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.number.js') }}"></script>
     <script src="{{ asset('assets/notiflix/src/notiflix.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Notiflix.Confirm.init({
            width: '350px',
            titleColor: '#3656dc',
            okButtonBackground: '#3656dc',
        });
        Notiflix.Loading.init({
            backgroundColor: '#4b49a14d',
            svgColor: '#0f12b6',
        })
        Notiflix.Notify.init({
            width: '280px',
            position: 'right-top',
            distance: '10px',
            opacity: 1,
            borderRadius: '5px',
            rtl: false,
            timeout: 3000,
            messageMaxLength: 110,
            backOverlay: false,
            backOverlayColor: 'rgba(0,0,0,0.5)',
            plainText: true,
            showOnlyTheLastOne: false,
            clickToClose: false,
            pauseOnHover: true,
            ID: 'NotiflixNotify',
            className: 'notiflix-notify',
            zindex: 4001,
            fontFamily: 'Quicksand',
            fontSize: '13px',
            cssAnimation: true,
            cssAnimationDuration: 400,
            cssAnimationStyle: 'fade',
            closeButton: false,
            useIcon: true,
            useFontAwesome: false,
            fontAwesomeIconStyle: 'basic',
            fontAwesomeIconSize: '34px',
            success: {
                background: '#32c682',
                textColor: '#fff',
                childClassName: 'notiflix-notify-success',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-check-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
                backOverlayColor: 'rgba(50,198,130,0.2)',
            },
            failure: {
                background: '#ff5549',
                textColor: '#fff',
                childClassName: 'notiflix-notify-failure',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-times-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
                backOverlayColor: 'rgba(255,85,73,0.2)',
            },
            warning: {
                background: '#eebf31',
                textColor: '#fff',
                childClassName: 'notiflix-notify-warning',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-exclamation-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
                backOverlayColor: 'rgba(238,191,49,0.2)',
            },
            info: {
                background: '#26c0d3',
                textColor: '#fff',
                childClassName: 'notiflix-notify-info',
                notiflixIconColor: 'rgba(0,0,0,0.2)',
                fontAwesomeClassName: 'fas fa-info-circle',
                fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
                backOverlayColor: 'rgba(38,192,211,0.2)',
            },
        });
    </script>
    @yield('script')

</body>

</html>
