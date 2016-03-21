 <!-- Nav Bottom
  .............................................. -->
  <nav class="nav-bottom hnav hnav-ruled white-bg boxed-section">
  
    <!-- Container -->
    <div class="container">
    
      <!-- Header-->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle no-border" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-navicon"></i>
        </button>
        <a class="navbar-brand visible-xs" href="#"><img src="{{asset('images/ec_xs-100x70.png')}}" alt="Elegance Cut"></a>
      </div>
      <!-- /Header-->
    
      <!-- Collapse -->
      <div class="collapse navbar-collapse navbar-absolute">
      
        <!-- Navbar Center -->
        <ul class="nav navbar-nav navbar-center line-top line-pcolor case-c">
          
          <li class="active"><a href="{{route('home')}}">home</a></li>

          @foreach ($arrCategory as $category)
            <li class="dropdown dropdown-mega"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$category->name}}<i class="fa fa-angle-down toggler"></i></a>
            <!-- Mega Menu -->
            <div class="mega-menu dropdown-menu">
              <!-- Row -->
              <div class="row">
              
                <!-- col -->
                <div class="col-md-3">
                  <img class="featured-img hidden-xs hidden-sm" src="{{WEB_ROOT.'/images/'.$category->menu_image}}" alt="">
                </div>
                
                @foreach(array_chunk($arrTypeCategoryWise[$category->cat_id],7) as $type_group)
                  
                  <div class="col-md-3">
                  
                  <ul class="links">
                  @foreach ($type_group as $type)
                      
                          <li><a href="{{route('type_page',['category'=>$category->cat_code,'type_code'=>$type->type_code])}}">{{$type->name}}</a></li>
                       
                  @endforeach
                  </ul>
                  </div>
                  
                @endforeach
                
              </div>
              
            </div>
            
          </li>
          @endforeach
          
          
         
          
        </ul>
        <!-- /Navbar Center -->
        
      </div>
      <!-- /Collapse -->
      
      <!-- Dont Collapse -->
      <div class="navbar-dont-collapse">

        <!-- Navbar btn-group -->
        <div class="navbar-btn-group btn-group navbar-right no-margin-r-xs">
        
         
          <!-- Btn Wrapper -->
          <div class="btn-wrapper dropdown">
          
          <!--   <a aria-expanded="false" class="btn btn-outline"><b class="count count-scolor count-round">2</b><i class="fa fa-shopping-cart" style="font-size:28px"></i> My Cart</a> -->
            <a href="{{route('cart')}}">
              <button class="btn blue-button">
              @if ($count_cart > 0)
              <b class="count count-scolor count-round">{{$count_cart}}</b>
              @endif
              <i class="fa fa-shopping-cart" style="font-size:23px"></i><span class="cart-button-title hidden-xs">My Cart</span></button>
            </a>


          </div>
          <!-- /Btn Wrapper -->

        </div>
        <!-- /Navbar btn-group -->
        
        <!-- Navbar Left -->
       
      </div>
      <!-- /Dont Collapse -->

    </div>
    <!-- /Container -->
    
  </nav>
  <!-- /Nav Bottom
  .............................................. -->