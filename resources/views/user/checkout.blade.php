@extends('main_wo_header_nav')

@section('title')
Elegance Cut
@endsection

@section('content')    
      
      <!-- Content Block
      ============================================-->
      <section class="content-block default-bg">
        <div class="container cont-pad-y-sm">
          @if (isset($_SESSION['elegance_cut']['error']) && $_SESSION['elegance_cut']['error'] != '')
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{$_SESSION['elegance_cut']['error']}}
          </div>
          @endif

          @if (isset($_SESSION['elegance_cut']['success']) && $_SESSION['elegance_cut']['success'] != '')
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{$_SESSION['elegance_cut']['success']}}
          </div>
          @endif
          <div class="message-div"></div>

          <div class="row">
            <div class="main-col col-md-9 mgb-30-xs">
              <div class="panel-group checkout" id="accordion">
              
                @if ($user_id  == null)
                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading heading-iconed">
                    <h4 class="panel-title case-c">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      <i class="icon-left">1</i> checkout method
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-6 mgb-30-xs">
                          <h6>New Customer</h6>
                          <p>Dont have an account? Pick one of the options below.</p>
                          <div class="radio"><label><input value="register" id="reg_type" name="reg_type" type="radio" checked>Register Account</label></div>
                          <div class="radio"><label><input value="guest" id="reg_type" name="reg_type" type="radio">Checkout as guest</label></div>
                          <p>Register with us for a fast and easy checkout and easy access to your order history and status</p>
                          <button id="btn-continue" class="btn btn-default btn-bigger">continue</button>
                        </div>
                        <div class="col-md-6">
                          <h6>Existing Customer</h6>
                            <form>
                              <a href="{{route('login',['callback_url'=>'checkout'])}}" class="btn btn-default btn-bigger">sign in</a>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                

                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading heading-iconed">
                    <h4 class="panel-title">
                    <a id="shippingAddressLink" data-toggle="collapse" data-parent="#accordion" href="#shippingAddress">
                      <i class="icon-left">2</i> Shipping Address
                    </a>  
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="shippingAddress" class="panel-collapse collapse">
                    <div class="panel-body">
                      <form method="post" action="{{route('checkout')}}">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>First Name</label>
                              <input name="fname" type="text" class="form-control" placeholder="Enter Name" value="{{(null !== $form['fname']) ? $form['fname'] : ''}}">
                            </div>  
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Second Name</label>
                              <input name="lname" type="text" class="form-control" placeholder="Enter Name" value="{{(null !== $form['lname']) ? $form['lname'] : ''}}">
                            </div>
                          </div>
                          
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Email</label>
                              <input name="email" type="text" class="form-control" placeholder="Enter Email" value="{{(null !== $form['email']) ? $form['email'] : ''}}">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>City</label>
                              <input name="city" type="text" class="form-control" placeholder="Enter City" value="{{(null !== $form['city']) ? $form['city'] : ''}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>State</label>
                              <select name="state" class="form-control">
                                <option value="select">Select state</option>
                                @foreach ($arrStates as $state)
                                  @if ($form['state'] == $state['code'])
                                    <option value="{{$state['code']}}" selected>{{$state['state']}}</option>
                                   @else 
                                    <option value="{{$state['code']}}">{{$state['state']}}</option>
                                   @endif 
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Country</label>
                              <select name="country" class="form-control">
                                <option value="select">Select country</option>
                                @foreach ($arrCountries as $country)
                                  @if ($form['country'] == $country['code'] || ($form['country'] == '' && $country['code'] == 'IN'))
                                    <option value="{{$country['code']}}" selected>{{$country['country']}}</option>
                                  @else
                                    <option value="{{$country['code']}}">{{$country['country']}}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input name="mobile" type="text" class="form-control" placeholder="Enter Mobile Number" value="{{(null !== $form['mobile']) ? $form['mobile'] : ''}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input name="zip" type="text" class="form-control" placeholder="Enter Zip Code" value="{{(null !== $form['zip']) ? $form['zip'] : ''}}">
                            </div>
                          </div>
                          
                        </div>
                      
                        <div class="form-group">
                          <label>Address Line 1</label>
                          <input name="address1" type="text" class="form-control" placeholder="">
                        </div>
                        
                        <div class="form-group">
                          <label>Address Line 2</label>
                          <input name="address2" type="text" class="form-control" placeholder="">
                        </div> 

                        {{csrf_field()}}
                        <button class="btn btn-default btn-lg">Submit</button>

                      </form>
                    </div>
                  </div>
                </div>
                @endif

                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading heading-iconed">
                    <h4 class="panel-title">
                    <a id="shippingInformationLink" data-toggle="collapse" data-parent="#accordion" href="#shippingInformation">
                      <i class="icon-left">3</i> Shippping Information
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="shippingInformation" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="row">
                          @if($user_id != null)
                          <div class="col-sm-6 col-xs-12">
                            <address>
                              <strong>Shipping Address :</strong><br>
                              {{$objUser->fname}} {{$objUser->lname}}<br>
                              {{$objUser->address}}<br>
                              {{$objUser->city}}, {{$arrStates_code_state[$objUser->state]}}, {{$arrCountries_code_country[$objUser->country]}}<br>
                              {{$objUser->zip_code}}<br>
                              <abbr title="Phone">P:</abbr> {{$objUser->mobile}}
                            </address>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <address>
                              <strong>Billing Address :</strong><br>
                              {{$objUser->fname}} {{$objUser->lname}}<br>
                              {{$objUser->address}}<br>
                              {{$objUser->city}}, {{$arrStates_code_state[$objUser->state]}}, {{$arrCountries_code_country[$objUser->country]}}<br>
                              {{$objUser->zip_code}}<br>
                              <abbr title="Phone">P:</abbr> {{$objUser->mobile}}
                            </address>
                          </div>
                          @else
                          <div class="col-xs-12">
                            <i class="fa fa-map-marker"></i>&nbsp;&nbsp;The Information has not been provided yet.
                          </div>
                          @endif
                        </div>
                    </div>
                  </div>
                  <!-- /Collapse -->
                </div>
                <!-- /Panel -->
                
                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading heading-iconed">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                      <i class="icon-left">4</i> Payment Information
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="collapseFour" class="panel-collapse collapse">
                    <!-- Panel Body -->
                    <div class="panel-body">
                      <p>Please select a payment method.</p>
                      <div class="radio"><label><input value="" name="acnt-opt" type="radio">Cash on delivery</label></div>
                      <div class="radio"><label><input value="" name="acnt-opt" type="radio">Paypal</label></div>
                      <div class="radio"><label><input value="" name="acnt-opt" type="radio" checked>Credit Card</label></div>
                      <hr/>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Name on card</label>
                              <input type="text" class="form-control" placeholder="Enter Name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Credit card number</label>
                              <input type="text" class="form-control" placeholder="Enter Name">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Card Type</label>
                            <select class="form-control">
                              <option>Select country</option>
                              <option>England</option>
                              <option>Germany</option>
                              <option>France</option>
                              <option>Spain</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Expiration date</label>
                            <select class="form-control">
                              <option>Select city</option>
                              <option>New York</option>
                              <option>Paris</option>
                              <option>Nairobi</option>
                              <option>Cairo</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>CCV Code</label>
                              <input type="text" class="form-control" placeholder="3 digits only">
                          </div>
                        </div>
                      </div>
                      <hr/>
                      <button class="btn btn-primary btn-sm btn-bigger">complete order</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Main Col -->
            
            <!-- Side Col -->
            <div class="side-col col-md-3">

              <!-- Side Widget -->
              <div class="order-summary">
                <table>
                  <tbody>
                    <tr>
                      <td>({{$cart_total_items}}) Items</td>
                      <td class="price"><i class="fa fa-inr"></i> {{$cart_total_price}}</td>
                    </tr>
                    <tr>
                      <td>Shipping</td>
                      <td class="price"><span class="success"><i class="fa fa-inr"></i> {{$shipping_charges}}</span></td>
                    </tr>
                    <tr>
                      <td>VAT</td>
                      <td class="price"><i class="fa fa-inr"></i> {{$vat}}</td>
                    </tr>
                    <tr class="total">
                      <td> Total </td>
                      <td class="price"><i class="fa fa-inr"></i> {{$total_price}}</td>
                    </tr>
                  </tbody>
                </table>
                <a href="{{route('cart')}}" class="btn btn-default btn-block btn-bigger">edit cart</a>
                <a href="" class="btn btn-primary btn-block btn-bigger">complete order</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      {{$_SESSION['elegance_cut']['error'] = null}}
      {{$_SESSION['elegance_cut']['success'] = null}}

@section('script')    
    <script type="text/javascript">
      if({{ (isset($message) && $message != '') ? 1 : 0 }})
      {
        $('.message-div').html('{!! (isset($message)) ? $message : '' !!}');
        $('.message-div').show();
      }

      $('#btn-continue').click(function(){
          var reg_type = $("input[name=reg_type]:checked").val();
            
          if(reg_type == 'register')
          {
              window.location.replace("{{route('register',['callback_url'=>'checkout'])}}");
          } 
          else if(reg_type == 'guest')
          {
              $('#shippingAddressLink').click();
          }          
      });

      $(window).load(function(){
        if({{ (isset($user_id) && $user_id != null) ? 1 : 0 }})
        {
            $('#shippingInformationLink').click();
        }
        else if({{ (isset($open_tab) && $open_tab != '') ? 1 : 0 }})
        {
            $('#{{$open_tab}}').click();
        }
      });
    </script>
@endsection    
@endsection      