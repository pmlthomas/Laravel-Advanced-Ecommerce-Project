@extends('frontend.main_master')
@section('content')

<!-- ===== ======== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Acceuil</a></li>
				@if(session()->get('language') == 'fr')
					<li><a href="#">{{ $product['category']['category_name_fr'] }}</a></li>
				@else
					<li><a href="#">{{ $product['category']['category_name_en'] }}</a></li>
				@endif
				@if(session()->get('language') == 'fr')
					<li class='active'>{{ $product->product_name_fr }}</li>				
				@else
					<li class='active'>{{ $product->product_name_en }}</li>
				@endif
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">

  
    
    
    	<!-- ============================================== HOT DEALS ============================================== -->
		<div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'fr')
              Offres du moment
            @else
              Hot deals
            @endif
          </h3>
          <div class="sidebar-widget-body outer-top-xs">
              
              @foreach($hot_deals_products as $item)
                <div class="item">
                  <div class="products special-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"> <img src="{{ asset($item->product_image) }}" alt=""> </a> </div>
                              <!-- /.image --> 
                              
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class="col col-xs-7">
                            <div class="product-info">
                              <h3 class="name"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}">
                                @if(session()->get('language') == 'fr')
                                  {{ $item->product_name_fr }}
                                @else
                                  {{ $item->product_name_en }}
                                @endif
                              </a></h3>
                              
                              @php
                                $product_ratings = App\Models\Review::where('product_id', $item->id)->get('ranking');
                              @endphp

                              @if(count($product_ratings) > 0)
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

                              <div class="product-price"> <span class="price"> 
                                @if(session()->get('language') == 'fr')
                                  {{ $item->product_selling_price - $item->product_discount_price }} €
                                @else
                                  {{ $item->product_selling_price - $item->product_discount_price }} $
                                @endif
                              </span> </div>
                              <!-- /.product-price --> 
                              
                            </div>
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-micro-row --> 
                      </div>
                      <!-- /.product-micro --> 
                      
                    </div>
                    
                  </div>
                </div>
              @endforeach

          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
<!-- ============================================== HOT DEALS: END ============================================== -->					
		<div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">
		  	@if(session()->get('language') == 'fr')
				Tag du produit
			@else
				Product tag
			@endif
		  </h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list"> 
				@if(session()->get('language') == 'fr')
						<a class="item" title="{{ $product->product_tags_fr }}" href="category.html">{{ $product->product_tags_fr }}</a>
				@else
						<a class="item" title="{{ $product->product_tags_en }}" href="category.html">{{ $product->product_tags_en }}</a>
				@endif
			</div>
            <!-- /.tag-list --> 
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
<!-- ============================================== NEWSLETTER ============================================== -->
<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== Testimonials============================================== -->
<!-- ============================================== Testimonials: END ============================================== -->

				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">
                
					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

		<img src="{{ asset($product->product_image) }}" height="220px" width="280px;" style="margin-left: 20px; margin-top: 15px;" />

        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails" style="margin-left: 20px;">

				@foreach($multi_images as $item)
					<div class="item">
						<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
							<img class="img-responsive" width="85" src="{{ asset($item->image) }}" />
						</a>
					</div>
				@endforeach

            </div><!-- /#owl-single-product-thumbnails -->

            

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">
								@if(session()->get('language') == 'fr')
									{{ $product->product_name_fr }}
								@else
									{{ $product->product_name_en }}
								@endif
							</h1>

							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
								
									@if(count($product_ratings) > 0)
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

									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">
												@if(count($product_ratings) > 0)
													@if($ratings_number > 1)
														{{ $ratings_number }} évaluations
													@else
														{{ $ratings_number }} évaluation
													@endif
												@endif
											</a>
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Disponibilité :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value" style="margin-left: 5px;">En stock</span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->
											
								<div class="description-container m-t-20">
									@if(session()->get('language') == 'fr')
										{{ $product->product_short_desc_fr }}
									@else
										{{ $product->product_short_desc_en }}
									@endif
								</div><!-- /.description-container -->

							<form method="post" action="{{ route('cart.add') }}">
								@csrf
								<div style="width: 210px; display: flex; margin-top: 20px;">
									@if(session()->get('language') == 'fr')
										<div style="margin-right: 10px;">
											<select class="form-control unicase-form-control selectpicker" name="color">
												<option selected disabled>choisissez une couleur</option>
												@foreach($product_color_fr as $item)
													<option>{{ $item }}</option>
												@endforeach
											</select>
										</div>
										<select class="form-control unicase-form-control selectpicker" name="size">
											<option selected disabled>choisissez une taille</option>
											@foreach($product_size_fr as $item)
												<option>{{ $item }}</option>
											@endforeach
										</select>
									@else
										<div style="margin-right: 10px;">
											<select class="form-control unicase-form-control selectpicker" name="color">
												<option selected disabled>choose a color</option>
												@foreach($product_color_en as $item)
													<option>{{ $item }}</option>
												@endforeach
											</select>
										</div>
										<select class="form-control unicase-form-control selectpicker" name="size">
											<option selected disabled>choose a size</option>
											@foreach($product_size_en as $item)
												<option>{{ $item }}</option>
											@endforeach
										</select>
									@endif
								</div>

								<div class="price-container info-container m-t-20">
									<div class="row">
									
										<div class="col-sm-6">
											<div class="price-box">
												<span class="price">
													@if(session()->get('language') == 'fr')
														{{ $product->product_selling_price - $product->product_discount_price }} €
													@else
														{{ $product->product_selling_price - $product->product_discount_price }} $
													@endif
												</span>
												<span class="price-strike">
													@if(session()->get('language') == 'fr')
														{{ $product->product_selling_price }} €
													@else
														{{ $product->product_selling_price }} $
													@endif
												</span>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="favorite-button m-t-10">
												<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
													<i class="fa fa-heart"></i>
												</a>
												<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
												<i class="fa fa-signal"></i>
												</a>
												<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
													<i class="fa fa-envelope"></i>
												</a>
											</div>
										</div>

									</div><!-- /.row -->
								</div><!-- /.price-container -->

								<div class="quantity-container info-container">
									<div class="row">
										
										<div class="col-sm-2">
											<span class="label">Quantité :</span>
										</div>

										<div class="col-sm-2">
											<input type="number" class="form-control" name="chosen_quantity">
										</div>

										<div class="col-sm-7" style="margin-left: 70px; margin-top: -34px;">
											<input type="hidden" name="id" id="id" value="{{ $product->id }}">
											<button class="btn btn-primary" type="submit"><i class="fa fa-shopping-cart inner-right-vs"></i> 
												@if(session()->get('language') == 'fr')
													AJOUTER AU PANIER
												@else
													ADD TO CART
												@endif
											</button>
										</div>

										
									</div><!-- /.row -->
								</div><!-- /.quantity-container -->
							</form>
							

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">
									@if(session()->get('language') == 'fr')
										ÉVALUATION
									@else
										REVIEW
									@endif
								</a></li>
								<li><a data-toggle="tab" href="#tags">
									@if(session()->get('language') == 'fr')
										COMMENTAIRES
									@else
										COMMENTS
									@endif
								</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">
											@if(session()->get('language') == 'fr')
												{{ $product->product_long_desc_fr }}
											@else
											{{ $product->product_long_desc_en }}
											@endif
										</p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
			
										<div class="product-add-review">
											<form method="post" action="{{ route('review.store') }}">	
												@csrf
												<h4 class="title">
													@if(session()->get('language') == 'fr')
														<p>Donnez une évaluation à ce produit</p>
													@else
														<p>Give a review to this product</p>
													@endif
												</h4>
												<div class="review-table">
													<div class="table-responsive">

															<table class="table">	
																<thead>
																	<tr>
																		<th class="cell-label">&nbsp;</th>
																		@if(session()->get('language') == 'fr')
																			<th>1 étoile</th>
																			<th>2 étoiles</th>
																			<th>3 étoiles</th>
																			<th>4 étoiles</th>
																			<th>5 étoiles</th>
																		@else
																			<th>1 start</th>
																			<th>2 stars</th>
																			<th>3 stars</th>
																			<th>4 stars</th>
																			<th>5 stars</th>
																		@endif
																	</tr>
																</thead>	
																<tbody>
																	<tr>
																		<td class="cell-label">
																			@if(session()->get('language') == 'fr')
																				<p>Note</p>
																			@else
																				<p>Rating</p>
																			@endif
																		</td>
																		<td><input type="radio" name="rating" class="radio" value="1"></td>
																		<td><input type="radio" name="rating" class="radio" value="2"></td>
																		<td><input type="radio" name="rating" class="radio" value="3"></td>
																		<td><input type="radio" name="rating" class="radio" value="4"></td>
																		<td><input type="radio" name="rating" class="radio" value="5"></td>
																	</tr>
																</tbody>
															</table><!-- /.table .table-bordered -->
														</div><!-- /.table-responsive -->
													</div><!-- /.review-table -->
													<div class="review-form">
														<div class="form-container">
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<label for="author">Votre nom <span class="astk">*</span></label>
																		<input type="text" class="form-control txt" name="author" placeholder="">
																	</div><!-- /.form-group -->
																	<div class="form-group">
																		<label for="review_title">Titre <span class="astk">*</span></label>
																		<input type="text" class="form-control txt" name="review_title" placeholder="">
																	</div><!-- /.form-group -->
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label for="comment">Votre commentaire <span class="astk">*</span></label>
																		<textarea class="form-control txt txt-review" name="comment" rows="4" placeholder=""></textarea>
																	</div><!-- /.form-group -->
																</div>
															</div><!-- /.row -->

															<input type="hidden" name="id" value="{{ $product->id }}">
															
															<div class="action text-right">
																<button class="btn btn-primary btn-upper" type="submit">ENVOYER L'ÉVALUATION</button>
															</div><!-- /.action -->
														<!-- /.cnt-form -->
													</div><!-- /.form-container -->
												</div><!-- /.review-form -->
											</form>
										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
								<div id="tags" class="tab-pane">
									<div class="product-tag">
										
										<h4 class="title">Commentaires pour ce produit</h4>
										
										@foreach($reviews as $item)
											<hr>
											<p>Autheur : {{ $item->author }}</p>
											<p>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
											@php
												$rating = $item->ranking;
											@endphp
											<p>
												@foreach(range(1,5) as $i)
													@if($rating >0)
														@if($rating >0.5)
															<i class="fa fa-star" style="color: orange"></i>
														@else
															<i class="fa fa-star-half-o" style="color: orange"></i>
														@endif
													@else
														<i class="fa fa-star-o" style="color: orange"></i>
													@endif
													@php 
														$rating--;
													@endphp
												@endforeach
											</p>
											<p>Titre : {{ $item->review_title }}</p>
											<p>Commentaire : {{ $item->comment }}</p>
											<hr>
										@endforeach

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
				<div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">
				@if(session()->get('language') == 'fr')
					Produits liés à cet article
				@else
					Products linked to this item
				@endif
			</h3> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="5">
                
                  @foreach($related_products as $item)
					@if($item->id !== $product->id)
						<div class="item item-carousel">
						<div class="products">
							<div class="product">
							<div class="product-image">
								<div class="image"> <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"><img src="{{ asset($item->product_image) }}" style="height: 100px; width: 120px;"></a> </div>
								<!-- /.image -->
								
								<!-- <div class="tag new"><span>new</span></div> -->
							</div>
							<!-- /.product-image -->
							
							<div class="product-info text-left">
								<h3 class="name"><a href="detail.html">{{ $item->product_name_fr }}</a></h3>
								
								@php
									$product_ratings = App\Models\Review::where('product_id', $item->id)->get('ranking');
								@endphp

								@if(count($product_ratings) > 0)
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

								<div class="description"></div>
								<div class="product-price"> <span class="price"> {{ $item->product_selling_price - $item->product_discount_price }} € </span> <span class="price-before-discount">{{ $item->product_selling_price }} €</span> </div>
								<!-- /.product-price --> 
								
							</div>
							<!-- /.product-info -->
							<div class="cart clearfix animate-effect">
								<div class="action">
								<ul class="list-unstyled">
									<li class="add-cart-button btn-group">
									<button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
									<button class="btn btn-primary cart-btn" type="button">Ajouter au panier</button>
									</li>
									<li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
									<li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
								</ul>
								</div>
								<!-- /.action --> 
							</div>
							<!-- /.cart --> 
							</div>
							<!-- /.product --> 
							
						</div>
						<!-- /.products --> 
						</div>
						<!-- /.item -->
					@endif
                  @endforeach

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->

<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
		  </div>
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
		
@endsection