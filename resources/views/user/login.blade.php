@extends('base')

@section('title')
Login - Elegance Cut
@endsection

@section('content')
	
	 <!-- Empty Block (use .abs-filler to fill page)
    ================================================== -->
    <div style="margin-top:15px;" class="empty-block abs-filler">
      <!-- Vcenter -->
      <div class="vcenter">
        <div class="vcenter-this">
          <!-- Container -->
          <div class="login-container">
          <div class="col-xs-12 col-md-8">
            <!-- Form Panel -->
            <div style="padding-right:0px;padding-left:0px" class="form-panel col-xs-12 col-md-11 hcenter">
              <header>Sign in</header>
              <fieldset>
              <div class="message-div"></div>
              <form method="post" action="{{route('login')}}">
                <div class="col-xs-12 form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                    <input name="email" type="email" class="form-control" placeholder="Email Address" value="{{(isset($email) && $email != '') ? $email : ''}}">
                  </div>
                </div>
                <div class="col-xs-12 form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input name="password" type="password" class="form-control" placeholder="Password">
                  </div>
                </div>
                <div class="hidden-xs form-group">
                  <label class="checkbox-inline"><input name="remember_me" type="checkbox" value="selected">Remember me </label>
                  <a href="" class="pull-right">Forgot password?</a>
                </div>
                <div class="visible-xs form-group">
                  <label class="checkbox-inline"><input name="remember_me" type="checkbox" value="selected">Remember me </label>
                  <br>
                  <a href="" class="">Forgot password?</a>
                </div>
                {{csrf_field()}}
                <button class="btn btn-default btn-lg btn-block">Sign in</button>
              </form>
              </fieldset>
            </div>
            <!-- /Form Panel -->
          </div>

          <div style="padding-top:100px" class="col-xs-12 col-md-4 hidden-xs">
            <div class="align-center">Dont have an Account? <a href="{{route('register')}}">Sign Up</a></div>
            <br>
            <div class="align-center"><a href="{{route('home')}}" class="btn btn-primary">Back to home</a></div>
          </div>
          <div style="margin-bottom:20px" class="col-xs-12 visible-xs">
            <div class="align-center">Dont have an Account? <a href="{{route('register')}}">Sign Up</a></div>
            <br>
            <div class="align-center"><a href="{{route('home')}}" class="btn btn-primary">Back to home</a></div>
          </div>
          <!-- /Container -->
          </div>
        </div>
        <!-- /Vcenter this -->
      </div>
      <!-- /Vcenter -->
    </div>
    <!-- /Empty Block
    ================================================== -->
@section('script')    
    <script type="text/javascript">
      if({{ (isset($message) && $message != '') ? 1 : 0 }})
      {
        $('.message-div').html("{!! (isset($message)) ? $message : '' !!}");
        $('.message-div').show();
      }
    </script>
@endsection  
@endsection   