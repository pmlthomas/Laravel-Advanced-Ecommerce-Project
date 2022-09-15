<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">
        <title>Pml_boutique</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

        <!-- Customizable CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/blue.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.transitions.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/rateit.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">

        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    
    </head>

    <body class="cnt-home">

        @include('frontend.layouts.header')

        @yield('content')

        @include('frontend.layouts.footer')



    <!-- JavaScripts placed at the end of the document so the pages load faster --> 
        <script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/bootstrap-hover-dropdown.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/echo.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/jquery.easing-1.3.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/bootstrap-slider.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/jquery.rateit.min.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('frontend/js/lightbox.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script> 
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="https://js.stripe.com/v3/"></script>
        <!-- <script charset="uft-8">
            var stripe = Stripe('pk_test_51LRCAyBA6XPq8iANX5OGqH6S4aVsKXuVd3ezd95vzL3Qx4Gy8ww7NhxMCJULnu6IAFsxSuj8Ci8Ss1c8dPf2r6Sl00lm8dguJT');
        </script> -->

    </body>
</html>