@extends('frontend.main_master')
@section('content')

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

                    @php
                      $carts = Cart::content();
                    @endphp

                    @if(count($carts) > 0)
                      @foreach($carts as $item)
                        <tr>
                          <td class="col-md-2"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->options->slug]) }}"><img src="{{ asset($item->options->image) }}" style="height: 100px; width: 120px;"></a></td>
                          <td class="col-md-2">
                            <div class="product-name" style="padding-left: 30px;"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->options->slug]) }}">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->name }}
                              @else
                                  {{ $item->options->name_en }}
                              @endif
                            </a></div>

                            <div class="price" style="padding-left: 30px;">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->price - $item->options->discount }} €
                              @else
                                  {{ $item->price - $item->options->discount }} $
                              @endif
                              <span>
                                @if(session()->get('language') == 'fr')
                                    {{ $item->price }} €
                                @else
                                    {{ $item->price }} $
                                @endif
                              </span>
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

                          <td class="col-md-2" style="padding-left: 70px;">
                              <h5>{{ Cart::subtotal() - ($item->qty * $item->options->discount) }} €</h5>
                          </td>


                          <td class="col-md-2 close-btn">
                              <a href="{{ route('cart.remove', $item->rowId) }}"><i class="fa fa-trash fa-lg"></i></a>
                          </td>
                        </tr>
                      @endforeach 

                    @else
                      <br>
                        <h5>Vous n'avez aucun produit dans votre panier pour le moment.</h5>
                    @endif

                  </tbody>
                </table>
              </div>
            </div>			
          </div><!-- /.row -->
        </div>

@endsection