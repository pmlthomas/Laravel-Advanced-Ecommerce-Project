@extends('frontend.main_master')
@section('content')

	<!DOCTYPE html>
	<html lang="fr">
		<head>
			<!-- Meta -->
			<meta charset="utf-8">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
			<meta name="description" content="">
			<meta name="author" content="">
			<meta name="keywords" content="MediaCenter, Template, eCommerce">
			<meta name="robots" content="all">

			<title>Pml_boutique</title>

			<!-- Bootstrap Core CSS -->
			<link rel="stylesheet" href="asset('frontend/css/bootstrap.min.css') }}">
			
			<!-- Customizable CSS -->
			<link rel="stylesheet" href="asset('frontend/css/main.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/blue.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/owl.carousel.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/owl.transitions.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/animate.min.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/rateit.css') }}">
			<link rel="stylesheet" href="asset('frontend/css/bootstrap-select.min.css') }}">
			
			<!-- Icons/Glyphs -->
			<link rel="stylesheet" href="asset('frontend/css/font-awesome.css') }}">

			<!-- Fonts --> 
			<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


		</head>
		<body class="cnt-home">
			<!-- ============================================== HEADER ============================================== -->
			<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="home.html">Home</a></li>
					<li class='active'>Connexion</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content">
		<div class="container">
			<div class="sign-in-page">
				<div class="row">
					<!-- Sign-in -->			
	<div class="col-md-6 col-sm-6 sign-in">
		<h4 class="">Se connecter</h4>
		<p class="">Bonjour, nous sommes heureux de vous revoir!</p>
		<div class="social-sign-in outer-top-xs">
			<a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Se connecter avec Facebook</a>
			<a href="#" class="twitter-sign-in" style="margin-top: 10px;"><i class="fa fa-twitter"></i> Se connecter avec Twitter</a>
		</div>
		
		<form class="register-form outer-top-xs" method="post" action="{{ route('login') }}">
			@csrf

			<div class="form-group">
				<label class="info-title" for="username">Nom d'utilisateur<span>*</span></label>
				<input type="username" name="username" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label class="info-title" for="password">Mot de passe <span>*</span></label>
				<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
			</div>
			<div class="radio outer-xs">
				<label>
					<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Se souvenir de moi
				</label>
				<a href="{{ route('password.email') }}" class="forgot-password pull-right">Mot de passe oublié?</a>
			</div>
			<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Se connecter</button>
		</form>					
	</div>
	<!-- Sign-in -->

	<!-- create a new account -->
	<div class="col-md-6 col-sm-6 create-new-account">
		<h4 class="checkout-subtitle">S'inscrire</h4>
		<p class="text title-tag-line">Créez un compte pour accéder à notre site</p>

		<form class="register-form outer-top-xs" method="post" action="{{ route('register') }}">
			@csrf

			<div class="form-group">
				<label class="info-title" for="email">Email <span>*</span></label>
				<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" >
			</div>
			<div class="form-group">
				<label class="info-title" for="name">Nom <span>*</span></label>
				<input type="text" name="name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label class="info-title" for="username">Nom d'utilisateur <span>*</span></label>
				<input type="text" name="username" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label class="info-title" for="password">Mot de passe <span>*</span></label>
				<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label class="info-title" for="password_confirmation">Confirmation du mot de passe <span>*</span></label>
				<input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
			</div>
			<button type="submit" class="btn-upper btn btn-primary checkout-page-button">S'inscrire</button>
		</form>
		
	</div>	
	<!-- create a new account -->			</div><!-- /.row -->
			</div><!-- /.sigin-in-->



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

		<!-- For demo purposes – can be removed on production -->
		
		<script src="switchstylesheet/switchstylesheet.js"></script>
		
		<script>
			$(document).ready(function(){ 
				$(".changecolor").switchstylesheet( { seperator:"color"} );
				$('.show-theme-options').click(function(){
					$(this).parent().toggleClass('open');
					return false;
				});
			});

			$(window).bind("load", function() {
			$('.show-theme-options').delay(2000).trigger('click');
			});
		</script>
		<!-- For demo purposes – can be removed on production : End -->

	</body>
	</html>

@endsection