@php
  $allCategories = App\Models\Category::all();

  if(count(Cart::content()) > 0) {
    $total_price = 0;
    foreach(Cart::content() as $item) {
        $price = $item->qty * $item->price;
        $discount = $item->qty * $item->options->discount;
        $discounted_price = $price - $discount;
        $total_price += $discounted_price;
    } 
  }

@endphp

<header class="header-style-1"> 
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
              <li><a href="{{ route('wishlist.view') }}"><i class="icon fa fa-heart"></i>
                @if(session()->get('language') == 'fr')
                  Favoris
                @else
                  Wishlist
                @endif
              </a></li>
              <!-- <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li> -->
              @auth
                <li><a href="{{ route('cart.page') }}"><i class="icon fa fa-shopping-cart"></i>
                  @if(session()->get('language') == 'fr')
                    Mon panier
                  @else
                    My cart
                  @endif
                </a></li>
                <li><a href="{{ route('user.profile') }}"><i class="icon fa fa-user"></i>
                  @if(session()->get('language') == 'fr')
                    Mon compte
                  @else
                    My account
                  @endif
                </a></li>
                <li><form method="post" action="{{ route('logout') }}" name="logout">@csrf<a href="javascript:document.logout.submit()"><i class="icon fa fa-lock"></i>
                  @if(session()->get('language') == 'fr')
                    Me déconnecter
                  @else
                    Logout
                  @endif
                </a></form></li>
              @else
                <li><a href="{{ route('auth.forms') }}"><i class="icon fa fa-user"></i>
                  @if(session()->get('language') == 'fr')
                    Connexion | Inscription
                  @else
                    Sign in | Sign up
                  @endif
                </a></li>
              @endauth

            </ul>
        </div>
        <!-- /.cnt-account -->
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <!-- <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">USD</a></li>
                <li><a href="#">INR</a></li>
                <li><a href="#">GBP</a></li>
              </ul>
            </li> -->
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
              @if(session()->get('language') == 'fr')
                Français
              @else
                Anglais
              @endif
            </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if(session()->get('language') == 'fr')
                  <li><a href="{{ route('language.english') }}">Anglais</a></li>
                @else
                  <li><a href="{{ route('language.french') }}">Français</a></li>
                @endif
              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div style="margin-top: -7px;"><a href="{{ route('homepage') }}" style="font-size: 2.5em; color: white;">Pml_boutique</a></div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"  style="margin-left: -30px;"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form method="get" action="{{ route('product.search') }}">
              @csrf
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
                      @foreach($allCategories as $item)
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">{{ $item->category_name_fr }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                </ul>
                <input class="search-field" name="search" placeholder="Rechercher..." />
                <button class="search-button" type="submit"></button>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row" style="margin-left: 790px; margin-top: -52px; margin-bottom: 25px;"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          @php
            $carts = Cart::content();
          @endphp
        
            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner" style="width: 200px;">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count">{{ Cart::count() }}</span></div>
                <div class="total-price-basket"> <span class="lbl">panier -</span> <span class="total-price"> <span class="value">@if(!empty($total_price)){{ $total_price }} € @else 0 € @endif</span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                    <div class="cart-item product-summary">

                        @foreach($carts as $item)
                          <div class="row">
                            <div class="col-xs-4">
                              <div class="image"> <a href="{{ url('/product/details/'.$item->id.'/'.$item->options->slug) }}"><img src="{{ asset($item->options->image) }}" style="height: 40px; width: 50px;"></a> </div>
                            </div>
                            <div class="col-xs-7">
                              <h3 class="name"><a href="{{ url('/product/details/'.$item->id.'/'.$item->options->slug) }}">{{ $item->name}}</a></h3>
                              <div style="display: flex;">
                                <div class="price">{{ $item->price - $item->options->discount }} €</div>
                                <div style="margin-left: 5px;">x{{ $item->qty }}</div>
                              </div>
                            </div>
                            <div class="col-xs-1 action"> <a href="{{ route('cart.remove', $item->rowId) }}"><i class="fa fa-trash"></i></a></div>
                          </div>
                        <!-- /.cart-item -->
                        @endforeach

                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix cart-total">
                      <div class="pull-right"> <span class="text">Sous-total :</span><span class='price'>@if(!empty($total_price)){{ $total_price }} € @else 0 € @endif</span> </div>
                      <div class="clearfix"></div>
                      <a href="{{ route('shipping.form') }}" class="btn btn-upper btn-primary btn-block m-t-20">Passer la commande</a> </div>
                    <!-- /.cart-total--> 
                </li>
              </ul>
              <!-- /.dropdown-menu--> 
            </div>
            <!-- /.dropdown-cart --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>

                  <!-- //? Header Categories -->
                  @foreach($allCategories as $item)
                    <li class="dropdown mega-menu"> 
                      <a href="category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                        @if(session()->get('language') == 'fr')
                          {{ $item->category_name_fr }}
                        @else
                          {{ $item->category_name_en }}
                        @endif 
                        </a>
                        <ul class="dropdown-menu container">
                          <li>
                            <div class="yamm-content">
                              <div class="row">
                                @php
                                  $allSubCategories = App\Models\SubCategory::where('category_id', $item->id)->get();
                                @endphp

                                <!-- //? Header SubCategories -->
                                @foreach($allSubCategories as $item)
                                  <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                    <h2 class="title">
                                        @if(session()->get('language') == 'fr')
                                          <a href="{{ url('/sub-category/products/'.$item->id.'/'.$item->sub_category_slug_fr) }}">
                                            {{ $item->sub_category_name_fr }}
                                          </a>
                                        @else
                                          <a href="{{ url('/sub-category/products/'.$item->id.'/'.$item->sub_category_slug_en) }}">
                                            {{ $item->sub_category_name_en }}
                                          </a>
                                        @endif
                                    </h2>
                                    <ul class="links">
                                      @php
                                        $allSubSubCategories = App\Models\SubSubCategory::where('sub_category_id', $item->id)->get();
                                      @endphp

                                      <!-- //? Header SubSubCategories -->
                                      @foreach($allSubSubCategories as $item)
                                        <li>
                                          @if(session()->get('language') == 'fr')
                                            <a href="{{ url('/sub-sub-category/products/'.$item->id.'/'.$item->sub_sub_category_slug_fr) }}">
                                              {{ $item->sub_sub_category_name_fr }}
                                            </a>
                                          @else
                                            <a href="{{ url('/sub-sub-category/products/'.$item->id.'/'.$item->sub_sub_category_slug_en) }}">
                                              {{ $item->sub_sub_category_name_en }}
                                            </a>
                                          @endif
                                      </li>
                                      @endforeach
                                    </ul>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                        </ul>
                    </li>
                  @endforeach
                <!-- <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li> -->
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
  
</header>
