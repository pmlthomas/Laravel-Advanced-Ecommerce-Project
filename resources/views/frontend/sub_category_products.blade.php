@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class='active'>Handbags</li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 sidebar'> 
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
        <div class="sidebar-module-container">
          <div class="sidebar-filter"> 
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" value="" >
                </div>
                <!-- /.price-range-holder --> 
                <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== PRICE SILDER : END ============================================== --> 
            <!-- ============================================== MANUFACTURES============================================== -->

            <!-- ============================================== MANUFACTURES: END ============================================== --> 
            <!-- ============================================== COLOR============================================== -->

            <!-- ============================================== COLOR: END ============================================== --> 
            <!-- ============================================== COMPARE============================================== -->

            <!-- ============================================== COMPARE: END ============================================== --> 
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
              <h3 class="section-title">Product tags</h3>
              <div class="sidebar-widget-body outer-top-xs">
                <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item" title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture" href="category.html">Furniture</a> <a class="item" title="T-shirt" href="category.html">T-shirt</a> <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item" title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys" href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a> </div>
                <!-- /.tag-list --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
          <!----------- Testimonials------------->

            <!-- ============================================== Testimonials: END ============================================== -->
        
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'> 
        <!-- ========================================== SECTION – HERO ========================================= -->
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-2">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>
                    @if(session()->get('language') == 'fr')
                      Grille  
                    @else
                      Grid
                    @endif
                  </a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>
                    @if(session()->get('language') == 'fr')
                      Liste 
                    @else
                      List
                    @endif
                  </a></li>
                </ul>
              </div>
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
            <div class="col col-sm-12 col-md-6">
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">1</a></li>
                        <li role="presentation"><a href="#">2</a></li>
                        <li role="presentation"><a href="#">3</a></li>
                        <li role="presentation"><a href="#">4</a></li>
                        <li role="presentation"><a href="#">5</a></li>
                        <li role="presentation"><a href="#">6</a></li>
                        <li role="presentation"><a href="#">7</a></li>
                        <li role="presentation"><a href="#">8</a></li>
                        <li role="presentation"><a href="#">9</a></li>
                        <li role="presentation"><a href="#">10</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 

            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right" style="margin-top: -20px; margin-right: -70px;">
              {{ $sub_category_products->links() }}
            </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product" style="margin-left: 12px;">
                <div class="row">

                @foreach($sub_category_products as $item)
                  <div class="col-sm-6 col-md-4 wow fadeInUp" style="margin-right: -10px;">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"><img src="{{ asset($item->product_image) }}" style="height: 215px; width: 250px;"></a> </div>
                          <!-- /.image -->
                          
                          <!-- <div class="tag new"><span>new</span></div> -->
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}">
                            @if(session()->get('language') == 'fr')
                                {{ $item->product_name_fr }}
                            @else
                                {{ $item->product_name_en }}
                            @endif
                          </a></h3>

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
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
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
                <!-- /.row --> 
              </div>
              <!-- /.category-product --> 
              
            </div>
            <!-- /.tab-pane -->
            
            <div class="tab-pane "  id="list-container">
              <div class="category-product">
                <div class="category-product-inner wow fadeInUp">
                  <div class="products">
                    <div class="product-list product">
                      <div class="row product-list-row">

                      @foreach($sub_category_products as $item)
                        <div class="col col-sm-4 col-lg-4">
                          <div class="product-image">
                            <div class="image"> <a href="{{ route('product.details', ['id' => $item->id, 'slug' => $item->product_slug_fr]) }}"><img src="{{ asset($item->product_image) }}" style="height: 215px; width: 250px;"> </div>
                          </div>
                          <!-- /.product-image --> 
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-8 col-lg-8" style="margin-top: 30px;">
                          <div class="product-info">
                            <h3 class="name"><a href="detail.html">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->product_name_fr }}
                              @else
                                  {{ $item->product_name_en }}
                              @endif
                            </a></h3>

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
                            </span> <span class="price-before-discount">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->product_selling_price }} €
                              @else
                                  {{ $item->product_selling_price }} $
                              @endif
                            </span> </div>
                            <!-- /.product-price -->
                            <div class="description m-t-10">
                              @if(session()->get('language') == 'fr')
                                  {{ $item->product_short_desc_fr }}
                              @else
                                {{ $item->product_short_desc_en }}
                              @endif
                            </div>
                            <div class="cart clearfix animate-effect">
                              <div class="action">
                                <ul class="list-unstyled">
                                  <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                  </li>
                                  <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                  <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                </ul>
                              </div>
                              <!-- /.action --> 
                            </div>
                            <!-- /.cart --> 
                            
                          </div>
                          <!-- /.product-info --> 
                        </div>
                        <!-- /.col --> 
                      @endforeach

                      </div>
                      <!-- /.product-list-row -->
                      <!-- <div class="tag new"><span>new</span></div> -->
                    </div>
                    <!-- /.product-list --> 
                  </div>
                  <!-- /.products --> 
                </div>
                <!-- /.category-product-inner -->
                

              </div>
              <!-- /.category-product --> 
            </div>
            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->

              <!-- /.pagination-container --> 
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        <!-- /.search-result-container --> 
        
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
          <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item m-t-10"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item-->
          
          <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt=""> </a> </div>
          <!--/.item--> 
        </div>
        <!-- /.owl-carousel #logo-slider --> 
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 
  
</div>
<!-- /.body-content --> 
    
@endsection