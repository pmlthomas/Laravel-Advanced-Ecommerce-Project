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
<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
	<h3 class="section-title">
		@if(session()->get('language') == 'fr')
			OFFRES DU MOMENT
		@else
			HOT DEALS
		@endif
	</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
														<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">

							<!-- <div class="sale-offer-tag"><span>35%<br>off</span></div> -->
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">Days</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						@foreach($hot_deals_products as $item)
							@if($item->id !== $product->id)
								<div class="product-info text-left m-t-20">
									<div class="image">
										<a href="{{ route('product.details', $item->id) }}"><img src="{{ asset($item->product_image) }}" height="180px" width="230px"></a>
									</div>
									<h3 class="name"><a href="{{ route('product.details', $item->id) }}">
										@if(session()->get('language') == 'fr')
											{{ $item->product_name_fr }}
										@else
											{{ $item->product_name_en }}
										@endif
									</a></h3>

									@php
										$ratings = App\Models\Review::where('product_id', $item->id)->get('ranking');
									@endphp

									<div>
										@if(count($ratings) > 0)
											@php
											$ratings_array = [];
												foreach($ratings as $rating) {
													array_push($ratings_array, $rating->ranking);
												}
												$average_ranking = array_sum($ratings_array) / count($ratings);
											@endphp

											@foreach(range(1,5) as $i)
												@if($average_ranking >0)
													@if($average_ranking >0.5)
														<i class="fa fa-star" style="color: orange"></i>
													@else
														<i class="fa fa-star-half-o" style="color: orange"></i>
													@endif
												@else
													<i class="fa fa-star-o" style="color: orange"></i>
												@endif
												@php 
													$average_ranking--;
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
									<div class="product-price">	
										<span class="price">
											@if(session()->get('language') == 'fr')
												{{ $item->product_selling_price - $item->product_discount_price }} €
											@else
												{{ $item->product_selling_price - $item->product_discount_price }} $
											@endif
										</span>
											
										<span class="price-before-discount">
											@if(session()->get('language') == 'fr')
												{{ $item->product_selling_price }} €
											@else
												{{ $item->product_selling_price }} $
											@endif
										</span>					
									
									</div><!-- /.product-price -->
									
								</div><!-- /.product-info -->

								<div class="cart clearfix animate-effect">
									<div class="action">
										
										<div class="add-cart-button btn-group">
											<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
												<i class="fa fa-shopping-cart"></i>													
											</button>
											<button class="btn btn-primary cart-btn" type="button">
												@if(session()->get('language') == 'fr')
													Ajouter au panier
												@else
													Add to cart
												@endif
											</button>
																	
										</div>
										
									</div><!-- /.action -->
								</div><!-- /.cart -->
							@endif
						@endforeach

					</div>	
					</div>		        
													
				
						
	    
    </div><!-- /.sidebar-widget -->
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->					

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
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1">
							              </div>
							            </div>
									</div>

									<div class="col-sm-7">
										<a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> 
											@if(session()->get('language') == 'fr')
												AJOUTER AU PANIER
											@else
												ADD TO CART
											@endif
										</a>
									</div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							

							

							
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
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Offres spéciales</h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
	    	
		<div class="item item-carousel">
			<div class="products">


	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="detail.html"><img  src="assets/images/products/p1.jpg" alt=""></a>
			</div><!-- /.image -->			

			            <div class="tag sale"><span>sale</span></div>            		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					$650.99				</span>
										     <span class="price-before-discount">$ 800</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="detail.html" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="detail.html" title="Compare">
							    <i class="fa fa-signal"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->


			</div><!-- /.products -->
		</div><!-- /.item -->
	
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->

@endsection