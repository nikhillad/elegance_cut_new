@extends('main_wo_header_nav')

@section('title')
Elegance Cut
@endsection

@section('content')    
      
      <!-- Content Block
      ============================================-->
      <section style="min-height:550px" class="content-block default-bg">
      
        <!-- Container -->
        <div class="container cont-pad-t-sm">

          @if (count($arrCartItems) > 0)

          <!-- generic header title -->
          <div class="col-md-12 generic-page-header-left">
            <h4>Shopping Cart</h4>
          </div>
          <div class="clearfix"></div>
          
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
          <!-- Cart -->
          <div class="cart">
          
            <!-- Cart Contents -->
            <table class="cart-contents">
              <thead>
                <tr>
                  <th class="hidden-xs">Image</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th class="hidden-xs">Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($arrCartItems as $item)
                <tr>
                  <td class="image hidden-xs"><img src="data:image/jpeg;base64,{{base64_encode(thumbnailImage(DOCUMENT_ROOT.'images/products/'.strtoupper($objCartItems[$item['item_id']]->item_image[0]).'/'.$objCartItems[$item['item_id']]->item_image))}}" alt="product"/></td>
                  <td class="details">
                    <div class="clearfix">
                      
                      <div class="pull-left no-float-xs">
                        <a href="#" class="title">{{$objCartItems[$item['item_id']]->name}}</a>
                        @if ($item['size'] != null)
                          <span>Size : {{$item['size']}}</span>
                        @endif
                      </div>
                      
                      <div class="pull-right no-float-xs">
                        
                          <a href="{{route('remove_cart_item',['item_id'=>$item['item_id']])}}"><button class="btn btn-primary delete"><i class="fa fa-trash-o"></i></button></a> 
                        
                      </div>

                    </div>

                    <!-- apply coupon code section -->
                    @if ($objCartItems[$item['item_id']]->offers == true && $item['coupon_added'] == 0)
                    <div class="pull-right">
                      <form method="post" action="{{route('apply_coupon',['item_id'=>$item['item_id']])}}" class="form-inline">
                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter coupon code here">
                        {{csrf_field()}}
                        <button class="btn btn-primary" type="submit">Apply</button>
                      </form>
                    </div>
                    @elseif ($objCartItems[$item['item_id']]->offers == true && $item['coupon_added'] == 1)
                      <span class="red-text pull-right">Coupon has been applied!</span>
                    @endif


                  </td>
                  <td class="qty">
                      <input type="text" onchange="update_qty({{$item['item_id']}})" value="{{$item['qty']}}" id="qty-{{$item['item_id']}}" name="qty-{{$item['item_id']}}">
                      <a href="#"><i class="object-center fa fa-refresh"></i></a>
                      <input type="hidden" id="qty-old-{{$item['item_id']}}" value="{{$item['qty']}}">
                  </td>
                  <td class="unit-price hidden-xs"><span class="currency"></span><i class="fa fa-inr"></i> {{$item['price']}}</td>
                  <td class="total-price" id="total-{{$item['item_id']}}"><span class="currency"></span><i class="fa fa-inr"></i> {{$item['price']*$item['qty']}}</td>
                  
                  <input type="hidden" id="price-{{$item['item_id']}}" value="{{$item['price']}}">
                  <input type="hidden" id="total-hidden-{{$item['item_id']}}" value="{{$item['price']*$item['qty']}}">
                </tr>
                @endforeach
              </tbody>
          
            </table>
            <!-- /Cart Contents -->
            
            <!-- Cart Summary -->
            <table class="cart-summary">
              <tr>
                <td class="terms">  
                  <h5><i class="fa fa-info-circle"></i> our return policy</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
               </td>
                <td class="totals"> 
                  <table class="cart-totals">
                    <tr>
                      <td>Sub Total</td>
                      <td class="price" id="subtotal"><i class="fa fa-inr"></i> {{$cart_total_price}}</td>
                      <input type="hidden" value="{{$cart_total_price}}" id="subtotal-hidden">
                    </tr>
                    <tr>
                      <td>Shipping</td>
                      <td class="price"><i class="fa fa-inr"></i> {{$shipping_charges}}</td>
                    </tr>
                    <tr>
                      <td>VAT</td>
                      <td class="price"><i class="fa fa-inr"></i> {{$vat}}</td>
                    </tr>
                    <tr>
                      <td class="cart-total">total</td>
                      <td class="cart-total price" id="grandtotal"><i class="fa fa-inr"></i> {{$total_price}}</td>
                      <input type="hidden" value="{{$total_price}}" id="grandtotal-hidden">
                    </tr>
                  </table>
                </td>
              </tr>
            </table>  
            <!-- /Cart Summary -->

          </div>
          <!-- /Cart -->

          <!-- Cart Buttons -->
          <div class="cart-buttons clearfix"> 
            <a class="btn btn-base checkout" href="{{route('checkout')}}"><i class="icon-left fa fa-shopping-cart"></i>checkout</a>
            <a class="btn btn-primary checkout" href="{{route('home')}}"><i class="icon-left fa fa-arrow-left"></i>continue shopping</a>
          </div>
          <!-- /Cart Buttons -->

          @else
          <h2 class="object-center"><i style="font-size:45px;margin-right:10px" class="fa fa-cart-arrow-down"></i> Your cart is empty !</h2>

          <!-- Cart Buttons -->
          <div class="clearfix object-center"> 
            <a class="btn btn-primary checkout" href="{{route('home')}}"><i class="icon-left fa fa-arrow-left"></i>continue shopping</a>
          </div>
          <!-- /Cart Buttons -->
          @endif
          
        </div>
        <!-- /Container -->
        
      </section>
      <!-- /Content Block
      ============================================-->
      <!-- remove error and success from session -->
      {{$_SESSION['elegance_cut']['error'] = null}}
      {{$_SESSION['elegance_cut']['success'] = null}}

@section('script')    
    <script type="text/javascript">
      if({{ (isset($message) && $message != '') ? 1 : 0 }})
      {
        $('.message-div').html('{{ (isset($message)) ? $message : ''}}');
        $('.message-div').show();
      }

      function update_qty(item_id) {
          
          qty = $('#qty-'+item_id).val();
          old_qty = $('#qty-old-'+item_id).val();
          price = $('#price-'+item_id).val();
          old_total = $('#total-hidden-'+item_id).val();
          old_subtotal = $('#subtotal-hidden').val();
          old_grandtotal = $('#grandtotal-hidden').val();

          //ajax call
          $.ajax({
              url: "{{route('change_qty')}}",
              type: "post",
              data: 'item_id='+item_id+'&qty='+qty+'&_token={{csrf_token()}}',
              dataType: 'json',
              success: function(data){
                  if(data['error'] ==  false)
                  {
                      $('.message-div').html('Quantity changed.');
                      $('.message-div').show();
                      $('#qty-old-'+item_id).attr('value',qty);
                     
                      var new_total = price*qty;
                      console.log(new_total);
                      console.log(old_total);
                      var diff = new_total-old_total;
                       console.log(diff);
                       console.log(old_subtotal);                     

                       //change total
                      $('#total-'+item_id).html('<span class="currency"></span><i class="fa fa-inr"></i> '+new_total);
                      
                      //change subtotal  
                      $('#subtotal').html('<span class="currency"></span><i class="fa fa-inr"></i> '+(parseFloat(old_subtotal,10)+parseFloat(diff,10)));

                      //change grandtotal
                      $('#grandtotal').html('<span class="currency"></span><i class="fa fa-inr"></i> '+(parseFloat(old_grandtotal)+parseFloat(diff)));

                      $('#grandtotal-hidden').attr('value',(parseFloat(old_grandtotal)+parseFloat(diff)));
                      $('#subtotal-hidden').attr('value',(parseFloat(old_subtotal)+parseFloat(diff)));
                      $('#total-hidden-'+item_id).attr('value',new_total);

                  }
                  else
                  {
                      $('.message-div').html(data['message']);
                      $('.message-div').show();
                      $('#qty-'+item_id).attr('value',old_qty);
                  } 
                },
              error:function(){
                  $('.message-div').html('Could not complete request. Something went wrong.');
                  $('.message-div').show();
                  $('#qty-'+item_id).attr('value',old_qty);
               }   
            });


      }
    </script>
@endsection    
@endsection      