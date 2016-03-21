<!DOCTYPE html>
<html lang="en">
  
  @include('head')

  <body class="preload tile-1-bg">
  
    @yield('content')

    <!-- Javascript
    ================================================== -->
    <script src="{{asset('js/jquery-latest.min.js')}}"></script>
    <script src="{{asset('js/uikit.js')}}"></script>
    @yield('script')
    <!-- /JavaScript
    ================================================== -->
  </body>
</html>
