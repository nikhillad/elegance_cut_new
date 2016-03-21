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

          <div class="vcenter-this hidden-xs pull-left">
            <a href="{{route('home')}}">
              <img src="{{asset('images/ec_xs-100x70.png')}}" alt="Elegance Cut">
            </a>
          </div>

          @include('header_menu_sm')
        
        </div>
        <!-- /Main Header
        .............................................. -->
        
        <!-- Nav Bottom
        .............................................. -->
        <nav class="visible-xs nav-bottom hnav hnav-ruled white-bg boxed-section">
        
          <!-- Container -->
          <div class="container">
          
          <!-- Header-->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle no-border" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <i class="fa fa-navicon"></i>
            </button>
            <a class="navbar-brand visible-xs" href="#"><img src="images/ec_xs-100x70.png" alt="Elegance Cut"></a>
          </div>
          <!-- /Header-->
          
          @include('header_nav')
       
        
      </header>
      <!-- /Header Block
      ============================================== -->

      @yield('content')

      @include('footer_menu_xs')

      <!-- Footer
      =================================================== -->
      <footer class="footer-block">

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
