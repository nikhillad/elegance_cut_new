<!DOCTYPE html>
<html lang="en">
  
  @include('head')

  <body class="preload tile-1-bg">
  
    <!-- Preloader 
    ============================================ -->
    <div class="page-preloader">
      <div class="vcenter"> <div class="vcenter-this"><img class="anim" src="{{asset('images/loader.gif')}}" alt="loading..." /></div></div>
    </div>
    <!-- /Preloader 
    ============================================ --> 
    
    <!-- Page Wrapper
    ++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="page-wrapper boxed-wrapper shadow">

      <!-- Header Block
      ============================================== -->
      <header class="header-block line-top">
        
       
        <!-- Main Header
        ............................................ -->
        
        <div class="main-header container">
         
          @include('header_menu_sm')

          <div class="clearfix"></div>
          <!-- Header Cols -->
          <div class="header-cols"> 
          
            <!-- Brand Col -->
            <div class="brand-col hidden-xs">
              
              <!-- vcenter -->
              <div class="vcenter">
                <!-- v-centered -->               
                <div class="vcenter-this">
                  <a href="{{route('home')}}">
                    <img src="{{asset('images/logo.png')}}" alt="Elegance Cut">
                    <span class="tag-line">Be Elegant, Be Unique</span>
                  </a>
                </div>
                <!-- v-centered -->
              </div>
              <!-- vcenter -->

            </div>
            <!-- /Brand Col -->

            @if (!isset($_SESSION['elegance_cut_user']['obj']))
            <!-- Right Col -->
            <div class="right-col">
            
              <!-- vcenter -->
              <div class="vcenter">
              
                <!-- v-centered -->
                <div class="vcenter-this">

                  <!-- Nav Side -->
                  <nav class="nav-side navbar hnav hnav-sm hnav-borderless" role="navigation">
                  
                    <!-- Dont Collapse -->
                    <div class="navbar-dont-collapse no-toggle">
                    
                      <!-- Nav Right -->
                      <ul class="nav navbar-nav navbar-right case-u active-bcolor navbar-center-xs">
                        <li class="dropdown has-panel">
                          <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-left ti ti-user"></i><span class="hidden-sm">sign in</span><i class="fa fa-angle-down toggler hidden-xs"></i></a>
                          
                          <!-- Dropdown Panel -->
                          <div class="dropdown-menu dropdown-panel arrow-top dropdown-left-xs" data-keep-open="true">
                            <fieldset>
                              <form method="post" action="{{route('login')}}">
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input name="email" class="form-control" placeholder="Email" type="email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                    <input name="password" class="form-control" placeholder="Password" type="password">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="checkbox-inline"><input name="remember_me" value="selected" type="checkbox">Remember me </label>
                                </div>
                                {{csrf_field()}}
                                <button class="btn btn-primary btn-block">sign in</button>
                              </form>
                            </fieldset>
                          </div>
                          <!-- /Dropdown Panel -->
                          
                        </li>
                        
                        <li class="dropdown has-panel">
                          <a aria-expanded="false" href="{{route('register')}}"><i class="icon-left ti ti-pencil-alt"></i><span class="hidden-sm">sign up</span></a>
                        </li>
                      </ul>
                      <!-- /Nav Right-->

                    </div>
                    <!-- /Dont Collapse -->
                    
                  </nav>
                  <!-- /Nav Side -->
                
                </div>
                <!-- /v-centered -->
              </div>
              <!-- /vcenter -->
              
            </div>
            <!-- /Right Col -->
            @endif

            <!-- Left Col -->
            <div class="left-col">
            
              <!-- vcenter -->
              <div class="vcenter">
                
                <!-- v-centered -->               
                <div class="vcenter-this">
                  
                  <form class="header-search">
                    <div class="form-group">
                      <input class="form-control" placeholder="SEARCH" type="text">
                      <button class="btn btn-empty"><i class="fa fa-search"></i></button>
                    </div>
                  </form>

                </div>
                <!-- v-centered -->
                
              </div>
              <!-- vcenter -->
            
            </div>
            <!-- /Left Col -->
          </div>
          <!-- Header Cols -->
        
        </div>
        <!-- /Main Header
        .............................................. -->
        
       @include('header_nav')
        
      </header>
      <!-- /Header Block
      ============================================== -->

      @yield('content')

      @include('footer_menu_xs')

      <!-- Footer
      =================================================== -->
      <footer class="footer-block">
      
        <!-- Container -->
        <div class="container cont-top clearfix simple-container">
        
          <!-- Row -->
          <div class="row">
          
            <!-- Brand -->
            <div class="col-md-3 brand-col brand-center">
              <div class="vcenter">
                <a class="vcenter-this" href="#">
                  <img src="{{asset('images/logo_184x136.jpg')}}" alt="logo"/>
                  <br>
                   <span class="tag-line">Be Elegant, Be Unique</span>
                </a>
              </div>
            </div>
            <!-- /Brand -->
            
            <!-- Links -->
            <div class="col-md-9 links-col">
            
              <!-- Row -->
              <div class="row-fluid">
              
                <!-- Col -->
                <div class="col-xs-12 col-sm-3 col-md-3">
                  <h5>CUSTOMER SERVICE</h5>
                    <ul class="vlinks">
                      <li><a href="shipping_policy.pdf" target="blank">Shipping & Delivery</a></li>
                      <li><a href="return_policy.pdf" target="blank">Returns & Exchange</a></li>
                      <li><a href="#">FAQ</a></li>
                      <li><a href="{{route('orders')}}">Track Order</a></li>
                      <li><a href="{{route('contact_us')}}">Contact Us</a></li>
                    </ul>         
                </div>
                <!-- /Col -->
                
                <!-- Col -->
                <div class="col-xs-12 col-sm-3 col-md-3">
                  <h5>ABOUT ElEGANCE CUT</h5>
                  <ul class="vlinks">
                    <li><a href="{{route('account')}}">Account</a></li>
                    <li><a href="#">Wishlist and Favourites</a></li>
                    <li><a href="{{route('orders')}}">Purchase History</a></li>
                    <li><a href="{{route('cart')}}">View Cart</a></li>
                  </ul>
                </div>
                <!-- /Col -->
                
                <!-- Col -->
                <div class="col-xs-12 col-sm-3 col-md-3">
                  <h5>POLICIES</h5>
                  <ul class="vlinks">
                    <li><a href="privacy_policy.pdf" target="blank">Privacy Policies</a></li>
                    <li><a href="tnc.pdf" target="blank">Terms & Conditions</a></li>
                  </ul>
                </div>
                <!-- /Col -->

                <!-- Col -->
                <div class="col-xs-12 col-sm-3 col-md-3 newsletter">
                  <h5>payment methods</h5>
                  <ul class="grid-list cols-3 cell-pad-5">
                    <li><img src="{{asset('images/cards/amazon.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/paypal.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/visa.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/mastercard.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/maestro.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/obopay.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/discover.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/cirrus.png')}}" alt=""></li>
                    <li><img src="{{asset('images/cards/google.png')}}" alt=""></li>
                  </ul>
                </div>
                <!-- /Col -->
             </div>
             <!-- /Row -->
            </div>
            <!-- /Links -->
          </div>
          <!-- /Row -->
        </div>
        <!-- /Container -->
        
        <div class="container cont-top clearfix simple-container">
          <div class="row">
              <div class="col-md-12">
                  <ul style="text-align:center" class="hlinks hlinks-icons color-icons-borders color-icons-bg color-icons-hovered">
                    <li><a href="#"><i class="icon fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="icon fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="icon fa fa-rss"></i></a></li>
                    <li><a href="#"><i class="icon fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="icon fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="icon fa fa-youtube"></i></a></li>
                  </ul>
              </div>
          </div>
        </div>

       @include('footer')
        
      </footer>
      <!-- /Footer
      =================================================== -->
      
    </div>
    <!-- /Page Wrapper
    ++++++++++++++++++++++++++++++++++++++++++++++ -->

    <!-- Javascript
    ================================================== -->
    <script src="{{asset('js/jquery-latest.min.js')}}"></script>
    <script src="{{asset('js/uikit.js')}}"></script>
    @yield('script')
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
