@php
  $allCategories = App\Models\Category::all();
@endphp

<header class="header-style-1"> 
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
              <!-- <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li> -->
              <!-- <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li> -->
              @auth
                <li><a href="#"><i class="icon fa fa-shopping-cart"></i>
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
        
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form>
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
                      <li class="menu-header">Computer</li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                    </ul>
                  </li>
                </ul>
                <input class="search-field" placeholder="Search here..." />
                <a class="search-button" href="#" ></a> </div>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count">2</span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="sign">$</span><span class="value">600.00</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="assets/images/cart.jpg" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">Simple Product</a></h3>
                      <div class="price">$600.00</div>
                    </div>
                    <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$600.00</span> </div>
                  <div class="clearfix"></div>
                  <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
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
                                        {{ $item->sub_category_name_fr }}
                                      @else
                                        {{ $item->sub_category_name_en }}
                                      @endif 
                                    </h2>
                                    <ul class="links">
                                      @php
                                        $allSubSubCategories = App\Models\SubSubCategory::where('sub_category_id', $item->id)->get();
                                      @endphp

                                      <!-- //? Header SubSubCategories -->
                                      @foreach($allSubSubCategories as $item)
                                        <li><a href="#">
                                          @if(session()->get('language') == 'fr')
                                            {{ $item->sub_sub_category_name_fr }}
                                          @else
                                            {{ $item->sub_sub_category_name_en }}
                                          @endif 
                                        </a></li>
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
