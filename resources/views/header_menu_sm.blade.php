<!-- top header menu -->
  <ul class="nav nav-pills top-header-menu hidden-xs">
    <li class="top-header-menu-li"><a href="{{route('orders')}}"><i style="font-size:18px" class="icon-left fa fa-map-marker"></i><span>Track Order</span></a></li>
    
    @if (isset($_SESSION['elegance_cut_user']['obj']))
    <li class="dropdown top-header-menu-li">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <strong>{{ $_SESSION['elegance_cut_user']['obj']->fname }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down toggler hidden-xs"></i></a>

      <!-- Dropdown Panel -->
      <ul class="dropdown-menu">
        <li><a href="{{route('account')}}">My Account</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>
      </ul>
     <!-- /Dropdown Panel -->
    </li>
     @endif 
  </ul>