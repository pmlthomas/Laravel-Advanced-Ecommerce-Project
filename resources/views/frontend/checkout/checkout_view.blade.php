@extends('frontend.main_master')
@section('content')

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('frontend/js/client.js') }}" defer></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>

<link rel="stylesheet" href="{{ asset('frontend/css/checkout.css' )}}" />

<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="home.html">Home</a></li>
          <li class='active'>Wishlist</li>
        </ul>
      </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
  </div><!-- /.breadcrumb -->

  <div class="body-content">
	<div class="container">
		<div class="checkout-box ">


            <!-- //? Shipping Form -->
            <div class="row">
                <h3 style="margin-top: 20px; margin-bottom: 10px; margin-left: 15px;">Informations de livraison</h3>
                <div class="col-md-4" style="margin-bottom: -50px;">           
                    <p>{{ $shipping['country'] }}</p>
                    <p>{{ $shipping['city'] }}</p>
                    <p>{{ $shipping['address'] }}</p>
                    <p>{{ $shipping['notes'] }}</p>
                </div>

                <!-- //? Cart Recap -->
                <div class="col-md-4" style="margin-top: -50px;">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Apperçu de votre commande</h4>
                                </div>
                                <div>
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                            <li style="margin-bottom: 5px;"><a href="#"><img src="{{ asset($item->options->image) }}" style="height: 70px; width: 80px;"></a></li>
                                            <li>
                                                <strong>Quantité : </strong>{{ $item->qty }}
                                                <span style="margin-left: 7px; margin-right: 7px;"><strong> Couleur : </strong>{{ $item->options->color }}</span>
                                                <strong> Taille : </strong>{{ $item->options->size }}
                                            </li>
                                        @endforeach
                                    </ul>		
                                </div>

                                @if(session()->get('coupon_name') && session()->get('coupon_discount'))
                                    <hr style="margin-top: 5px; margin-bottom: 15px;">
                                    <div>
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            <li><strong>Code de réduction : </strong>{{ session()->get('coupon_name') }}</li>
                                            <li><strong>Réduction : </strong>{{ session()->get('coupon_discount') }} €</li>
                                        </ul>		
                                    </div>
                                @endif

                                <hr style="margin-top: 5px; margin-bottom: 15px;">
                                <div>
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <li><strong>Total : </strong>
                                            @if($total_price <= 0)
                                                0 €
                                            @else
                                                {{ $total_price }} €
                                            @endif
                                        </li>
                                    </ul>		
                                </div>

                            </div>
                        </div>
                    </div> 
                    <!-- checkout-progress-sidebar -->				
                </div>

                <!-- //? Payment -->
                <div class="col-md-4" style="display: inline-block; width: 350px;">
                    <h3 style="margin-bottom: 20px; margin-top: -40px;">Paiement</h3>
                    <form id="payment-form">
                        @csrf
                        <label for="card-element">
                        Carte bancaire
                        </label>
                        <div id="card-element" style="border: 2px solid black; padding: 10px;">
                        <!-- Elements will create input elements here -->
                        </div>

                        <!-- We'll put the error messages in this element -->
                        <div id="card-errors" role="alert"></div>

                    <button id="submit" style="margin-top: 20px;">Payer</button>
                    </form>
                </div>

        </div>
    </div>

    </div><!-- /.checkout-box -->

    <script>
        const btn = document.getElementById("submit");
        btn.addEventListener('click', function(e){
            e.preventDefault();
            window.location.href = '/payment';
        })
    </script>
    
    <script>
        var response = fetch('/secret').then(function(response) {
            return response.json();
        }).then(function(responseJson) {
        var clientSecret = responseJson.client_secret;
            // Render the form to collect payment details, then
            // call stripe.confirmCardPayment() with the client secret.
        });
    </script>

@endsection