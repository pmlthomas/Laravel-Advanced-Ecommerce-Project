<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ route('admin.dashboard') }}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
						  <h3><b>Sunny</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="active">
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		
        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Marques</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.brand') }}"><i class="ti-more"></i>Marques</a></li>
            <li><a href="{{ route('admin.brand.add') }}"><i class="ti-more"></i>Ajouter une marque</a></li>
          </ul>
        </li> 
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i> <span>Catégories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.category') }}"><i class="ti-more"></i>Catégories</a></li>
            <li><a href="{{ route('admin.category.add') }}"><i class="ti-more"></i>Ajouter une catégorie</a></li>
          </ul>
        </li>
		
        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Sous-catégories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.sub_category') }}"><i class="ti-more"></i>Sous-catégories</a></li>
            <li><a href="{{ route('admin.sub_category.add') }}"><i class="ti-more"></i>Ajouter une sous-catégorie</a></li>
          </ul>
        </li> 		  

        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Sous-sous-catégorie</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.sub_sub_category') }}"><i class="ti-more"></i>Sous-sous-catégories</a></li>
            <li><a href="{{ route('admin.sub_sub_category.add') }}"><i class="ti-more"></i>Ajouter une sous-sous-catégorie</a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Produits</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="{{ route('admin.product') }}"><i class="ti-more"></i>Produits</a></li>
			<li><a href="{{ route('admin.product.add') }}"><i class="ti-more"></i>Ajouter un produit</a></li>
		  </ul>
        </li>    

        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Home Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			      <li><a href="{{ route('admin.slider') }}"><i class="ti-more"></i>Sliders</a></li>
			      <li><a href="{{ route('admin.slider.add') }}"><i class="ti-more"></i>Ajouter un Slider</a></li>
		      </ul>
        </li> 

        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Coupons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.coupon') }}"><i class="ti-more"></i>Coupons</a></li>
            <li><a href="{{ route('admin.coupon.add') }}"><i class="ti-more"></i>Ajouter un Coupon</a></li>
          </ul>
        </li> 
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>