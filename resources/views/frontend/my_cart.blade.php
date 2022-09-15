@extends('frontend.main_master')
@section('content')

  @php
    if(count(Cart::content()) > 0) {
      $total_price = 0;
      foreach(Cart::content() as $item) {
          $discounted_price = $item->qty * ($item->price - $item->options->discount);
          $total_price += $discounted_price;
      }
      if(session()->get('coupon_discount')) {
        $after_coupon_price = $total_price - session()->get('coupon_discount');
      } 
    }
  @endphp

  <style>
    th {
      font-size: 1em!important;
    }
  </style>

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
        <div class="row">
          <div class="shopping-cart">
            <div class="shopping-cart-table">
              <h1 class="heading-title">Mon panier</h1>
              <div class="table-responsive">

              @php
                $carts = Cart::content();
              @endphp

              @if(count($carts) > 0)
                <table class="table">
                  <thead>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Retirer</th>
                  </thead>
                  <tbody>
                      @foreach($carts as $item)
                        <tr>
                          <td class="col-md-2"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->options->slug]) }}"><img src="{{ asset($item->options->image) }}" style="height: 100px; width: 120px;"></a></td>
                          <td class="col-md-2">
                            <div class="product-name" style="padding-left: 30px; font-size: 1.3em;"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->options->slug]) }}">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->name }}
                              @else
                                  {{ $item->options->name_en }}
                              @endif
                            </a></div>

                            <div class="price" style="padding-left: 30px; font-size: 1.2em;">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->price - $item->options->discount }} €
                              @else
                                  {{ $item->price - $item->options->discount }} $
                              @endif
                            </div>
                          </td>

                          <td class="col-md-2">
                              <h4 style="padding-left: 30px;">{{ $item->options->color }}</h4>
                          </td>

                          <td class="col-md-2" style="padding-left: 60px;">
                              <h4>{{ $item->options->size }}</h4>
                          </td>

                          <td class="col-md-2" style="padding-left: 60px;">
                              <input type="number"class="form-control" name="quantity" value="{{ $item->qty }}" style="width: 50px;">
                          </td>

                          @php
                            $cart = Cart::get($item->rowId);
                          @endphp

                          <td class="col-md-2" style="padding-left: 70px;">
                              <h5 style="font-size: 1.2em;">{{ $item->qty * ($cart->price - $item->options->discount) }} €</h5>
                          </td>


                          <td class="col-md-2 close-btn">
                              <a href="{{ route('cart.remove', $item->rowId) }}"><i class="fa fa-trash fa-lg"></i></a>
                          </td>
                        </tr>
                      @endforeach 

                      <table class="table" style="width: 400px!important; margin-left: 700px; margin-bottom: 10px;">
                        <thead>
                          <tr>
                            <th>
                              <span class="estimate-title">Code de réduction</span>
                              <p>Entrez votre code de réduction si vous en possédez un..</p>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>
                                <form method="post" action="{{ route('coupon.apply') }}">
                                  @csrf
                                  <div class="form-group">
                                    <input type="text" class="form-control unicase-form-control text-input" placeholder="Votre code de réduction.." name="coupon_name">
                                  </div>
                                  <div class="clearfix pull-right">
                                    <button type="submit" class="btn-upper btn btn-primary">APPLIQUER LE CODE DE RÉDUCTION</button>
                                  </div>
                                </form>
                              </td>
                            </tr>
                        </tbody><!-- /tbody -->
                      </table><!-- /table -->

                      <div class="cart-shopping-total" style="width: 400px!important; margin-left: 700px;">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>
                                <div class="cart-sub-total">
                                  Subtotal<span class="inner-left-md">@if(!empty($total_price)){{ $total_price }} € @endif</span>
                                </div>
                                <div class="cart-sub-total" style="margin-left: 55px; margin-top: 15px; margin-bottom: 15px;">
                                  @if(session()->get('coupon_name'))
                                    Code de réduction<span class="inner-left-md" style="margin-right: 10px; margin-left: -30px;">{{ session()->get('coupon_name') }}</span>
                                    <a href="{{ route('coupon.remove') }}"><button><i class="fa fa-times"></i></button></a>
                                  @endif
                                </div>
                                <div class="cart-sub-total" style="margin-left: 10px; margin-top: 15px; margin-bottom: 15px;">
                                  @if(session()->get('coupon_name'))
                                    <span style="margin-right: 30px;">Réduction</span><span class="inner-left-md" style="margin-right: 10px; margin-left: -30px;">{{ session()->get('coupon_discount') }} €</span>
                                  @endif
                                </div>
                                <div class="cart-grand-total">
                                  Grand Total<span class="inner-left-md">
                                    @if(!empty($after_coupon_price))
                                      {{ $after_coupon_price }} €
                                     @else 
                                      @if(!empty($total_price))
                                        {{ $total_price }} € 
                                      @endif 
                                    @endif
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead><!-- /thead -->
                          <tbody>
                              <tr>
                                <td>
                                  <div class="cart-checkout-btn pull-right">
                                    <a href="{{ route('shipping.form') }}"><button type="submit" class="btn btn-primary checkout-btn">PROCÉDER AU PAIEMENT</button></a>
                                    <span class="">Checkout with multiples address!</span>
                                  </div>
                                </td>
                              </tr>
                          </tbody><!-- /tbody -->
                        </table><!-- /table -->
                      </div><!-- /.cart-shopping-total -->
                  </tbody>
                </table>
              @else
                <br><h5>Vous n'avez aucun produit dans votre panier pour le moment.</h5>
              @endif
            </div>
          </div>			
        </div><!-- /.row -->
      </div>

@endsection