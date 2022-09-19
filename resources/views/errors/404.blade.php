@extends('frontend.main_master')
@section('content')

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="x-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12 x-text text-center">
					<h1>404</h1>
					<p>Nous sommes désolé, la page que vous recherchez n'est pas disponible.</p><br>
					<a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Se rendre à la page principale</a>
				</div>
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection