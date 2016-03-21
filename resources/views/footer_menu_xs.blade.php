@if (isset($_SESSION['elegance_cut_user']['obj']))
      <div class="visible-xs footer-menu-xs">
        <a href="{{route('orders')}}"><div>Track Order<i class="fa fa-caret-right footer-menu-right-icon"></i></div></a>
        <a href="{{route('account')}}"><div>My Account<i class="fa fa-caret-right footer-menu-right-icon"></i></div></a>
        <a href="{{route('logout')}}"><div>Logout<i class="fa fa-caret-right footer-menu-right-icon"></i></div></a>
      </div>
      @else
      <div class="visible-xs footer-menu-xs">
        <a href="{{route('login')}}"><div>Sign in<i class="fa fa-caret-right footer-menu-right-icon"></i></div></a>
        <a href="{{route('register')}}"><div>I am new here! Sign up<i class="fa fa-caret-right footer-menu-right-icon"></i></div></a>
      </div>
      @endif