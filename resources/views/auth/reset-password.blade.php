@extends('frontend.main_master')
@section('content')

         <body class="cnt-home">
			<!-- ============================================== HEADER ============================================== -->
			<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="home.html">Accueil</a></li>
					<li class='active'>Nouveau mot de passe</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content">
		<div class="container">
			<div class="sign-in-page">
				<div class="row">

		<form method="post" action="{{ route('password.update') }}">
			@csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div style="margin-top: 5px; margin-left: 20px; margin-right: 600px; margin-bottom: 10px;">
                <div class="form-group">
                    <label class="info-title" for="email">Email<span>*</span></label>
                    <input type="email" name="email" id="email" class="form-control unicase-form-control text-input" :value="old('email')" required autofocus >
                </div>

                <div class="form-group">
                    <label for="password" class="info-title">Nouveau mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control unicase-form-control text-input" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="info-title">Confirmation du nouveau mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control unicase-form-control text-input" />
                </div>

			    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Enregistrer mon nouveau mot de passe</button>
            </div>
        
        </form>					
	</div>
	<!-- Sign-in -->
			</div><!-- /.row -->
			</div><!-- /.sigin-in-->

@endsection