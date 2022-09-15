@extends('frontend.main_master')
@section('content')

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
                <h2 style="margin-top: 20px; margin-bottom: 60px; margin-left: 15px;">Informations de livraison</h2>
                <div class="col-md-8" style="margin-top: -45px;">
                    
                    <form class="register-form outer-top-xs" method="post" action="{{ route('checkout.view') }}">
                        @csrf

                        <!-- User Infos -->
                        <div class="form-group">
                            <label class="info-title" for="email">Email</label>
                            <input type="email" name="email" class="form-control unicase-form-control text-input" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="phone">Numéro de téléphone</label>
                            <input type="phone" name="phone" class="form-control unicase-form-control text-input" >
                        </div>

                        <!-- Shipping Infos -->
                        <div class="form-group">
                            <label class="info-title" for="country">Pays</label>
                            <input type="country" name="country" class="form-control unicase-form-control text-input" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="city">Ville</label>
                            <input type="city" name="city" class="form-control unicase-form-control text-input" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="address">Addresse</label>
                            <input type="address" name="address" class="form-control unicase-form-control text-input" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="notes">Informations supplémentaires</label>
                            <input type="notes" name="notes" class="form-control unicase-form-control text-input" >
                        </div>
                    
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="margin-bottom: 40px; margin-top: 10px;">Enregistrer mes informations de livraison</button>
                    </form>		

                </div>

    <!-- //? Cart Recap -->
    <div class="col-md-4">
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
                    </div>
                </div>

    </div><!-- /.checkout-box -->

@endsection