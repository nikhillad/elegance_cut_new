@extends('main')

@section('title')
Elegance Cut
@endsection

@section('content')    
      
      
<!-- Content Block
============================================-->
<section class="content-block default-bg">
  <!-- Container -->
  <div class="container">
    <!-- Row -->
    <div class="row">
          <div class="col-sm-12">
            <div class="message-div"></div>
          </div>
       <!-- Product Row -->
          <div class="product-details">
          
            <!-- Col -->
            <div class="col-md-4 mgb-30-xs">
            
              <!-- Slider Wrapper -->
              <div class="main-slider">
                <!-- BxSlider -->
                <ul class="bxslider" data-call="bxslider" data-options="{pagerCustom:'#thumb-pager', controls:false}">
                  <li>
                    <a href="#"><img class="fillw" src="data:image/jpeg;base64,{{base64_encode(thumbnailImage(DOCUMENT_ROOT.'images/products/'.strtoupper($objItem->item_image[0]).'/'.$objItem->item_image))}}" alt="" /></a>
                  </li>
                  @foreach ($objProductImages as $product_image)
                  <li>
                    <a href="#"><img class="fillw" src="data:image/jpeg;base64,{{base64_encode(thumbnailImage(DOCUMENT_ROOT.'images/products/'.strtoupper($product_image->image[0]).'/'.$product_image->image))}}" alt="" /></a>
                  </li>
                  @endforeach
                </ul>
                <!-- /BxSlider -->
              </div>
              <!-- /Slider Wrapper -->
              
              <!-- Slider Wrapper -->
              <div  class="thumb-slider bx-controls-box">
                <!-- BxSlider -->
                <ul id="thumb-pager" class="bxslider" data-call="bxslider" data-options="{pager:false, slides:10, slideMargin:10}">
                  @foreach ($objProductImages as $product_image)
                  <li>
                    <a data-slide-index="1" href="#"><img class="fillw" src="data:image/jpeg;base64,{{base64_encode(thumbnailImage(DOCUMENT_ROOT.'images/products/'.strtoupper($product_image->image[0]).'/'.$product_image->image))}}" alt="" /></a>
                  </li>
                  @endforeach
                </ul>
                <!-- /BxSlider -->
              </div>
              <!-- /Slider Wrapper -->
              
            </div>
            <!-- /Col -->
            
            <!-- Col -->
            <div class="col-md-7">
            
              
              <h3 class="product-title" style="padding-left:10px">{{$objItem->name}}</h3>
              
              <h5 style="padding-left:10px;margin-top:-5px">{{$arrType_id_obj[$objItem->item_type]->name}}</h5>

              <div class="price-box" style="padding-left:10px">
                <h4 class="product-price"><i class="fa fa-inr"></i> {{$objItem->price}}
                @if (!empty($objCouponMaster))
                  <span style="font-size:15px;color:grey">(Discount offers available. Scroll down to see all the available offers)</span>
                @endif
                </h4>
              </div>
              
              <!-- Accordion -->
              <div class="panel-group" id="accordion">
              
                <!-- Panel -->
                @if ($objItem->desc != '')
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      Product Details
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                    {{$objItem->desc}}
                    </div>
                  </div>
                  <!-- /Collapse -->
                </div>
                @endif

                @if ($objItem->specs != '')
                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                      Product Specifications
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                    {{$objItem->specs}}
                    </div>
                  </div>
                  <!-- /Collapse -->
                </div>
                @endif
                
                @if ($objItem->add_info != '')
                <!-- Panel -->
                <div class="panel panel-default">
                  <!-- Heading -->
                  <div class="panel-heading">
                    <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                      Additional Information
                    </a>
                    </h4>
                  </div>
                  <!-- /Heading -->
                  
                  <!-- Collapse -->
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                    {{$objItem->add_info}}
                    </div>
                  </div>
                  <!-- /Collapse -->
                </div>
                @endif

              </div>
              <!-- /Accordion -->

              <form method="post" action="{{route('product',['item_id'=>$objItem->item_id])}}">
              <!-- Row -->
              <div class="row grid-20">

                @if ($show_size_chart == true)
                <!-- Col -->
                <div class="col-md-6">
                  <!-- /Form Group -->
                  <div class="form-group">
                    <!-- Input Group -->
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon fa fa-male"></i></div>
                      <select name="size" class="form-control">
                        <option value="select">Select size</option>

                        @foreach ($objSizes as $size)
                          @if($size->qty == 0)
                            <option value="{{$size->size_code}}" disabled>{{$size->name}}</option>
                          @else
                            <option value="{{$size->size_code}}">{{$size->name}}</option>
                          @endif    
                        @endforeach
                      
                      </select>
                    </div>
                    <!-- /Input Group -->
                  </div>
                </div>
                <!-- /Col -->
                @endif

                <!-- Col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <!-- Input Group -->
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon fa fa-calculator"></i></div>
                      <select name="qty" class="form-control">
                        <option value="select">Select Quantity</option>
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                    <!-- /Input Group -->
                  </div>
                  <!-- /Form Group -->
                </div>
                <!-- /Col -->

                
                <!-- show offers details here -->
                @if (!empty($objCouponMaster))
                <div class="col-sm-12">
                 <div class="alert alert-info">
                    @foreach($objCouponMaster as $coupon)
                      - Additional <strong>{{round($coupon->discount_percent)}}%</strong> discount available. Use coupon code <strong>{{$coupon->coupon_code}}</strong> on Cart page.<br>
                    @endforeach
                 </div> 
                </div> 
                @endif
                

              </div>
              <!-- /Row -->
              {{csrf_field()}}
              <button type="submit" class="btn btn-primary btn-bigger" {{($total_available_qty < 1) ? 'disabled' : ''}}><i class="icon-left ti ti-shopping-cart"></i>Buy Now</button>
              @if ($total_available_qty < 1)
               <span style="font-size:13px" class="label label-danger">Out of stock!</span>
              @endif  

              </form>

            </div>
            <!-- /Col -->
            
          </div>
          <!-- /Product Row -->
      
    </div>
    <!-- /Row -->
  
  </div>
  <!-- /Container -->
</section>
<!-- /Content Block
============================================-->


@section('script')    
    <script type="text/javascript">
      if({{ (isset($message) && $message != '') ? 1 : 0 }})
      {
        $('.message-div').html('{!! (isset($message)) ? $message : '' !!}');
        $('.message-div').show();
      }
    </script>
@endsection    
@endsection      