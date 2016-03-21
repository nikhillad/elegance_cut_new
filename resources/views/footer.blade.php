 <!-- Bottom -->
  <div class="footer-bottom invert-colors bcolor-bg">
  
    <!-- Container -->
    <div class="container">
    
      <span class="copy-text">&copy; 2016 Elegance Cut</span>
      <!-- hlinks -->
      <ul class="hlinks pull-right">
        <li><a href="{{route('about_us')}}">About</a></li>
        @if (isset($_SESSION['elegance_cut_user']['obj']))
          <li><a href="{{route('logout')}}">Logout</a></li>
        @else
          <li><a href="{{route('login')}}">Login</a></li>
          <li><a href="{{route('register')}}">Sign Up</a></li>
        @endif    
        <li><a href="#">Support</a></li>
      </ul>
      <!-- /hlinks -->
      
    </div>
    <!-- /Container -->
    
  </div>
  <!-- /Bottom -->

  <!-- Promo Modal
  ============================================ -->      
  <div class="modal fade modal-promo" data-call="bs-modal" data-options="">
    <!-- Dialog -->
    <div class="modal-dialog">
    
      <!-- Promo Image (use background image to allow scaling) -->
      <div class="promo-img bg-cover" style="background:url(images/modal-promo.jpg)"></div>
      
      <!-- Text Col -->
      <div class="text-col">
        <div class="text">
          <h5>daily exclusive deals</h5>
          
          <img src="images/modal-promo-xs.jpg" alt="" class="visible-xs mgb-20" />
          <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</p>
          
          <!-- Modal Form -->
          <form class="form-inline modal-form">
            <div class="form-group">
              <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address"/>
            </div>
            <button type="submit" class="btn btn-base">Subscribe</button>
          </form>
          <!-- /Modal Form -->
          <p class="hidden-xs" >Follow us on social media for exclusive deals.</p>
          
          <!-- hlinks -->
          <ul class="hlinks hlinks-icons hlinks-icons-round color-icons-bg color-icons-hovered">
            <li><a href="#"><i class="icon fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="icon fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="icon fa fa-rss"></i></a></li>
            <li><a href="#"><i class="icon fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="icon fa fa-youtube"></i></a></li>
          </ul>
          <!-- /hlinks --> 
        </div>
      </div>
      <!-- /Text Col -->

      <button type="button" class="btn-close btn btn-base" data-dismiss="modal"><i class="fa fa-close"></i></button>
    </div>
    <!-- /Dialog -->
  </div>
  <!-- /Promo Modal
  ============================================ --> 
  