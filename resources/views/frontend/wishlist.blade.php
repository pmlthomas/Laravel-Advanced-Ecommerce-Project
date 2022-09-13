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
      <div class="my-wishlist-page">
        <div class="row">
          <div class="col-md-12 my-wishlist">
          <h1 class="heading-title">Mes favoris</h1>
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <div style="margin-bottom: -20px; margin-top: -3px; margin-left: 30px;">
            {{ $products->links() }}
          </div>
          @if(isset($wishlist_products[0]->product_name_fr))
            @foreach($wishlist_products as $item)
              <tr>
                <td class="col-md-2"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"><img src="{{ asset($item->product_image) }}" style="height: 215px; width: 250px;"></a></td>
                <td class="col-md-7">
                  <div class="product-name"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}">
                    @if(session()->get('language') == 'fr')
                        {{ $item->product_name_fr }}
                    @else
                        {{ $item->product_name_en }}
                    @endif
                  </a></div>

                  @if(!empty($product_ratings))
                    @php
                        $ratings_array = [];
                        foreach($product_ratings as $rating) {
                            array_push($ratings_array, $rating->ranking);
                        }
                        $global_rating = array_sum($ratings_array) / count($product_ratings);
                    @endphp			

                    @foreach(range(1,5) as $i)
                        @if($global_rating >0)
                            @if($global_rating >0.5)
                                <i class="fa fa-star" style="color: orange"></i>
                            @else
                                <i class="fa fa-star-half-o" style="color: orange"></i>
                            @endif
                        @else
                            <i class="fa fa-star-o" style="color: orange"></i>
                        @endif
                        @php 
                            $global_rating--;
                        @endphp
                    @endforeach
                  @else
                      @if(session()->get('language') == 'fr')
                          <p><i class="badge badge-pill">Aucune évaluation</i></p>
                      @else
                          <p><i class="badge badge-pill">No review</i></p>
                      @endif
                  @endif

                  <div class="price">
                    @if(session()->get('language') == 'fr')
                        {{ $item->product_selling_price - $item->product_discount_price }} €
                    @else
                        {{ $item->product_selling_price - $item->product_discount_price }} $
                    @endif
                    <span>
                      @if(session()->get('language') == 'fr')
                          {{ $item->product_selling_price }} €
                      @else
                          {{ $item->product_selling_price }} $
                      @endif
                    </span>
                  </div>
                </td>
                <td class="col-md-2">
                  <form method="post" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <button class="btn-upper btn btn-primary">Ajouter au panier</button>
                  </form>
                </td>
                <td class="col-md-1 close-btn">
                  <a href="{{ route('wishlist.remove', $item->id) }}" class=""><i class="fa fa-times"></i></a>
                </td>
              </tr>

            @endforeach 
          @else
              <h5>Vous n'avez aucun produit en favoris pour le moment.</h5>
          @endif

        </tbody>
      </table>
    </div>
  </div>			</div><!-- /.row -->
      </div><!-- /.sigin-in-->

@endsection