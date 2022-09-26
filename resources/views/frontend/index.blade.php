@extends('frontend.main_master')
@section('content')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar" style="margin-top: 20px;"> 
        
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> 
            @if(session()->get('language') == 'fr')
              Catégories
            @else
              Categories
            @endif
          </div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">

              @foreach($allCategories as $item)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @if(session()->get('language') == 'fr')
                    {{ $item->category_name_fr }}
                  @else
                    {{ $item->category_name_en }}
                  @endif
                </a>
                  <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                      <div class="row">
                      @php
                        $allSubCategories = App\Models\SubCategory::where('category_id', $item->id)->get();
                      @endphp

                        @foreach($allSubCategories as $sub_category)
                          <div class="col-sm-5 col-md-3">
                            <ul class="links list-unstyled">
                              <li style="font-weight: bold;"><a href="#">
                                @if(session()->get('language') == 'fr')
                                  {{ $sub_category->sub_category_name_fr }}
                                @else
                                  {{ $sub_category->sub_category_name_en }}
                                @endif
                              </a></li>
                            </ul>
                          </div>
                          @php
                            $allSubSubCategories = App\Models\SubSubCategory::where('category_id', $item->id)->get();
                          @endphp

                          @foreach($allSubSubCategories as $sub_sub_category)
                            <div class="col-sm-5 col-md-3">
                              <ul class="links list-unstyled">
                                <li><a href="#">
                                  @if(session()->get('language') == 'fr')
                                    {{ $sub_sub_category->sub_sub_category_name_fr }}
                                  @else
                                    {{ $sub_sub_category->sub_sub_category_name_en }}
                                  @endif
                                </a></li>
                              </ul>
                            </div>
                          @endforeach

                        @endforeach
                      </div>
                      <!-- /.row --> 
                    </li>
                    <!-- /.yamm-content -->
                  </ul>
                </li>
              @endforeach

            </ul>
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== --> 
        
        <!-- ============================================== HOT DEALS ============================================== -->
        <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">
            @if(session()->get('language') == 'fr')
              Offres du moment
            @else
              Hot deals
            @endif
          </h3>
          <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
            
            @foreach($hot_deals_products as $item)
              <div class="item">
                  <div class="products">
                    
                    <div class="product-info text-left m-t-20">
                      <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"><img src="{{ asset($item->product_image) }}" style="height: 120px; width: 130px; margin-top: -15px;"></a>
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

                        <div class="product-price"> 
                          <span class="price"> 
                            @if(session()->get('language') == 'fr')
                              {{ $item->product_selling_price - $item->product_discount_price}} €
                            @else
                              {{ $item->product_selling_price - $item->product_discount_price}} $
                            @endif
                          </span> <span class="price-before-discount">
                            @if(session()->get('language') == 'fr')
                              {{ $item->product_selling_price }} €
                            @else
                              {{ $item->product_selling_price }} $
                            @endif 
                          </span> </div>
                        <!-- /.product-price --> 
                        
                      </div>
                      <!-- /.product-info -->
                  </div>
                </div>
              @endforeach

          </div>
          <!-- /.sidebar-widget --> 
        </div>
        <!-- ============================================== HOT DEALS: END ============================================== --> 
        
        <!-- ============================================== SPECIAL OFFER ============================================== -->
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'fr')
              Offres spéciales
            @else
              Special offers
            @endif
          </h3>
          <div class="sidebar-widget-body outer-top-xs">
              
              @foreach($special_offers_products as $item)
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
        <!-- ============================================== SPECIAL OFFER : END ============================================== --> 
        <!-- ============================================== PRODUCT TAGS ============================================== -->
        <div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">Product tags</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item" title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture" href="category.html">Furniture</a> <a class="item" title="T-shirt" href="category.html">T-shirt</a> <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item" title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys" href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a> </div>
            <!-- /.tag-list --> 
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== PRODUCT TAGS : END ============================================== --> 
        <!-- ============================================== SPECIAL DEALS ============================================== -->
        
        <div class="sidebar-widget outer-bottom-small wow fadeInUp" style="margin-top: 30px;">
          <h3 class="section-title">
            @if(session()->get('language') == 'fr')
              Occasions spéciales
            @else
              Special deals
            @endif
          </h3>
          <div class="sidebar-widget-body outer-top-xs">
              
              @foreach($special_deals_products as $item)
                <div class="item">
                  <div class="products special-product">
                    <div class="product">
                      <div class="product-micro">
                        <div class="row product-micro-row">
                          <div class="col col-xs-5">
                            <div class="product-image">
                              <div class="image"> <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"> <img src="{{ asset($item->product_image) }}"  alt=""> </a> </div>
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
        <!-- ============================================== SPECIAL DEALS : END ============================================== --> 
        <!-- ============================================== NEWSLETTER ============================================== -->
       
        <!-- ============================================== NEWSLETTER: END ============================================== --> 
        
        <!-- ============================================== Testimonials============================================== -->
        
        <!-- ============================================== Testimonials: END ============================================== -->
        
        <div class="home-banner"> <img src="{{ asset('frontend/images/banners/LHS-banner.jpg') }}" alt="Image"> </div>
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            
          @foreach($allSliders as $item)
            <div class="item" style="background-image: url({{asset($item->slider_image)}});">
                <div class="container-fluid">
                  <div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1">
                      @if(session()->get('language') == 'fr')
                        {{ $item->slider_topleft_title_fr }}
                      @else
                        {{ $item->slider_topleft_title_en }}
                      @endif
                    </div>
                    <div class="big-text fadeInDown-1"> 
                      @if(session()->get('language') == 'fr')
                        {{ $item->slider_title_fr }}
                      @else
                        {{ $item->slider_title_en }}
                      @endif
                    </div>
                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>
                      @if(session()->get('language') == 'fr')
                        {{ $item->slider_subtitle_fr }}
                      @else
                        {{ $item->slider_subtitle_en }}
                      @endif
                    </span> </div>
                    <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">
                      @if(session()->get('language') == 'fr')
                        Acheter Maintenant
                      @else
                        Shop Now
                      @endif
                    </a> </div>
                  </div>
                  <!-- /.caption --> 
                </div>
                <!-- /.container-fluid --> 
              </div>
              <!-- /.item -->
            @endforeach

          </div>
          <!-- /.owl-carousel --> 
        </div>
        
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
            <div class="row">
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">money back</h4>
                    </div>
                  </div>
                  <h6 class="text">30 Days Money Back Guarantee</h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">free shipping</h4>
                    </div>
                  </div>
                  <h6 class="text">Shipping on orders over $99</h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Special Sale</h4>
                    </div>
                  </div>
                  <h6 class="text">Extra $5 off on all items </h6>
                </div>
              </div>
              <!-- .col --> 
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.info-boxes-inner --> 
          
        </div>
        <!-- /.info-boxes --> 
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">
              @if(session()->get('language') == 'fr')
                Nouveaux produits
              @else
                New products
              @endif
            </h3> 
          </div>
          
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                  @foreach($new_products as $item)
                    <div class="item item-carousel">
                      <div class="products">
                        <div class="product">
                          <div class="product-image">
                            <div class="image"> <a href="{{ url('/product/details/'.$item->id.'/'.$item->product_slug_fr) }}"><img src="{{ asset($item->product_image) }}" style="height: 150px; width: 187px;"></a> </div>
                            <!-- /.image -->
                            
                            <div class="tag new"><span>new</span></div>
                          </div>
                          <!-- /.product-image -->
                          
                          <div class="product-info text-left">
                            <h3 class="name"><a href="{{ url('/product/details/'.$item->id.'/'.$item->product_slug_fr) }}">{{ $item->product_name_fr }}</a></h3>
                            
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
                                <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="{{ route('wishlist.store', $item->id) }}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
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
                  @endforeach

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
        
            
            
            <div class="tab-pane" id="">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                  
                  
                  
                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            
            <div class="tab-pane" id="apple">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="detail.html"><img src="{{ asset('frontend/images/products/p18.jpg') }}" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <div class="tag sale"><span>sale</span></div>
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                          <div class="rating rateit-small"></div>
                          <div class="description"></div>
                          <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="lnk wishlist"> <a class="add-to-cart" href="{{ route('wishlist.store', $item->id) }}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
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
  
                  

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane --> 
            
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 
        <!-- ============================================== SCROLL TABS : END ============================================== --> 
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/images/banners/home-banner1.jpg') }}" alt=""> </div>
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col -->
            <div class="col-md-5 col-sm-5">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/images/banners/home-banner2.jpg') }}" alt=""> </div>
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'fr')
              Produits à la une
            @else
              Featured products
            @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
          
            @foreach($featured_products as $item)
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="detail.html"><img src="{{ asset($item->product_image) }}" style="height: 150px; width: 187px;"></a> </div>
                      <!-- /.image -->
                      
                      <div class="tag hot"><span>hot</span></div>
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
                      <div class="product-price"> <span class="price"> 
                        @if(session()->get('language') == 'fr')
                          {{ $item->product_selling_price - $item->product_discount_price }} €
                        @else
                        {{ $item->product_selling_price - $item->product_discount_price }} $
                        @endif
                      </span> <span class="price-before-discount">
                        @if(session()->get('language') == 'fr')
                          {{ $item->product_selling_price }} €
                        @else
                          {{ $item->product_selling_price }} $
                        @endif
                      </span> </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                  </div>
                  <!-- /.product --> 
                </div>
                <!-- /.products --> 
              </div>
              <!-- /.item -->
            @endforeach
            
          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-12">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="{{ asset('frontend/images/banners/home-banner.jpg') }}" alt=""> </div>
                <div class="strip strip-text">
                  <div class="strip-inner">
                    <h2 class="text-right">New Mens Fashion<br>
                      <span class="shopping-needs">Save up to 40% off</span></h2>
                  </div>
                </div>
                <div class="new-label">
                  <div class="text">NEW</div>
                </div>
                <!-- /.new-label --> 
              </div>
              <!-- /.wide-banner --> 
            </div>
            <!-- /.col --> 
            
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== BEST SELLER ============================================== -->
        <!-- ============================================== BEST SELLER : END ============================================== --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->
        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
          <h3 class="section-title">latest form blog</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a></h3>
                    <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/images/blog-post/post2.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/images/blog-post/post2.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
            </div>
            <!-- /.owl-carousel --> 
          </div>
          <!-- /.blog-slider-container --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp" style="margin-left: 20px; margin-top: 40px;">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          
          @foreach($allBrands as $item)
            <a href="#"><img src="{{ asset($item->brand_image) }}" style="height: 150px; width: 200px; padding-right: 30px;"></a>
          @endforeach                
        </div>
        <!-- /.owl-carousel #logo-slider --> 
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
  </div>
  <!-- /.container --> 
</div>

@endsection