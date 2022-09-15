@extends('frontend.main_master')
@section('content')

  <style>
    .btn-group.bootstrap-select.form-control.unicase-form-control {
      margin-bottom: 10px;
      margin-right: 10px;
    }
    #qty {
      width: 60px;
      margin-right: 40px;
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

              @php
                $product_color_fr = explode(',', $item->product_color_fr);
                $product_color_en = explode(',', $item->product_color_en);

                $product_size_fr = explode(',', $item->product_size_fr);
                $product_size_en = explode(',', $item->product_size_en);
              @endphp
              
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

                    @if(session()->get('language') == 'fr')
                      <div style="display: flex;">
                        <div style="display: flex; flex-direction: column;">
                          <select class="form-control unicase-form-control selectpicker" name="color">
                            <option selected disabled>choisissez une couleur</option>
                            @foreach($product_color_fr as $color)
                              <option>{{ $color }}</option>
                            @endforeach
                          </select>
                          @error('color')
                            <span class="text-danger" style="margin-bottom: 5px;">{{ $message }}</span>
                          @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                          <select class="form-control unicase-form-control selectpicker" name="size">
                            <option selected disabled>choisissez une taille</option>
                            @foreach($product_size_fr as $size)
                              <option>{{ $size }}</option>
                            @endforeach
                          </select>
                          @error('size')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-2" style="margin-right: 15px; margin-top: 6px;">
                        <span class="label" style="font-size: 1em; color: black;">Quantité :</span>
                      </div>

                      <div class="col-sm-2">
                        <input type="number" class="form-control" id="qty" name="chosen_quantity">
                      </div>
                      @error('chosen_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    @else
                      <div style="display: flex;">
                        <div style="display: flex; flex-direction: column;">
                          <select class="form-control unicase-form-control selectpicker" name="color">
                            <option selected disabled>choisissez une couleur</option>
                            @foreach($product_color_en as $color)
                              <option>{{ $color }}</option>
                            @endforeach
                          </select>
                          @error('color')
                            <span class="text-danger" style="margin-bottom: 5px;">{{ $message }}</span>
                          @enderror
                        </div>

                        <div style="display: flex; flex-direction: column;">
                          <select class="form-control unicase-form-control selectpicker" name="size">
                            <option selected disabled>choisissez une taille</option>
                            @foreach($product_size_en as $size)
                              <option>{{ $size }}</option>
                            @endforeach
                          </select>
                          @error('size')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-sm-2" style="margin-right: 15px; margin-top: 6px;">
                        <span class="label" style="font-size: 1em; color: black;">Quantité :</span>
                      </div>

                      <div class="col-sm-2">
                        <input type="number" class="form-control" id="qty" name="chosen_quantity">
                      </div>
                      @error('chosen_quantity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    @endif

                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <button class="btn-upper btn btn-primary" style="margin-left: 40px;">Ajouter au panier</button>
                  </form>
                </td>
                <td class="col-md-1 close-btn">
                  <a href="{{ route('wishlist.remove', $item->id) }}" class=""><i class="fa fa-times fa-lg"></i></a>
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