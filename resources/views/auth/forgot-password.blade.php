@extends('frontend.main_master')
@section('content')

        <body class="cnt-home">
			<!-- ============================================== HEADER ============================================== -->
			<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="home.html">Accueil</a></li>
					<li class='active'>Mot de passe oublié</li>
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
            <h4 style="margin-bottom: 20px; margin-top: -3px;">Mot de passe oublié</h4>
            <div class="mb-4 text-sm text-gray-600" style="margin-bottom: 25px;">
                {{ __('Mot de passe oublié? Aucun problème. Renseigne-nous ton addresse email et tu recevras alors un email pour réinitialiser ton mot de passe.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600" style="margin-bottom: 20px;">
                    <p>Email envoyé avec succès!</p>
                </div>
            @endif

		<form method="post" action="{{ route('password.email') }}">
			@csrf

			<div class="form-group">
				<label class="info-title" for="email">Email<span>*</span></label>
				<input type="email" name="email" id="email" class="form-control unicase-form-control text-input" :value="old('email')" required autofocus >
			</div>

			<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Recevoir l'email de récupération</button>
		</form>					
	</div>
	<!-- Sign-in -->
			</div><!-- /.row -->
			</div><!-- /.sigin-in-->

@endsection