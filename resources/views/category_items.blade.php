@extends('main')

@section('title')
Elegance Cut
@endsection

@section('content')    
      
      
      <!-- Content Block
      ============================================-->
      <section class="content-block default-bg">
        <!-- Container -->
        <div class="container no-pad-t">
          

          <!-- Row -->
          <div class="row">

           <!-- generic header title -->
          <div class="col-md-12 generic-page-header-left">
            <h6 class="left-align-header-h4">Cetegory > <strong>{{strtolower($objCategory->name)}}</strong></h6>
          </div>
          <div class="clearfix"></div>

            @if (empty($objItems))
              <div class="clearfix"></div>
              <div class="object-center">
                <h4><i class="fa fa-meh-o"></i> Oops! No items found under this section.</h4>
              </div>
            @else

            @foreach ($objItems as $item)
            <div class="">
                <!-- Col -->
                <div class="col-sm-6 col-md-2">
                
                  <!-- product -->
                  <div class="product clearfix">
                  
                    <!-- Image -->
                    <div class="image"> 
                      <a href="{{route('product',['item_id'=>$item->item_id])}}" class="main"><img src="data:image/jpeg;base64,{{base64_encode(thumbnailImage(DOCUMENT_ROOT.'images/products/'.strtoupper($item->item_image[0]).'/'.$item->item_image))}}" alt=""></a>
                    </div>
                    <!-- Image -->
                    
                    <!-- <span class="label label-sale">sale</span> -->
                    
                    <!-- Details -->
                    <div class="details">
                    
                      <a class="title" href="{{route('product',['item_id'=>$item->item_id])}}" title="{{$item->name}}">{{strlen($item->name) > 85 ? substr($item->name,0,80)."..." : $item->name}}</a>
                      
                      <!-- rating -->
                      <!-- <ul class="hlinks hlinks-rating">
                        <li class="active"><a href="#"><i class="icon fa fa-star"></i></a></li>
                        <li class="active"><a href="#"><i class="icon fa fa-star"></i></a></li>
                        <li class="active"><a href="#"><i class="icon fa fa-star"></i></a></li>
                        <li><a href="#"><i class="icon fa fa-star"></i></a></li>
                        <li><a href="#"><i class="icon fa fa-star"></i></a></li>
                      </ul> -->
                      <!-- /rating -->
                      
                      <p class="desc">{{strtolower($item->type_name)}}</p>
                      
                      <!-- Price Box -->
                      <div class="price-box">
                       <!--  <span class="price price-old">$2350</span> -->
                       <span class="price"><i class="fa fa-inr"></i> {{$item->price}}</span>
                      </div>
                      <!-- /Price Box -->
                      
                      <!-- buttons -->
                     <!--  <div class="btn-group">
                        <a class="btn btn-outline btn-base-hover" href="cart.html">add to cart</a>  
                        <a class="btn btn-outline btn-default-hover" href="product.html"><i class="icon fa fa-heart"></i></a>
                      </div>  -->
                      <!-- /buttons -->
                      
                    </div>
                    <!-- /Details -->
                    
                  </div>
                  <!-- /product -->
                
                </div>
            
            <!-- /Col -->
            </div>
            @endforeach
            @endif
            
            <div class="clearfix"></div>
            <div class="col-md-12 object-center">
              {{$pagination->render(route('category_page',['cat_code'=>$objCategory->cat_code]))}}
            </div>
          
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
        $('.message-div').html('{{ (isset($message)) ? $message : ''}}');
        $('.message-div').show();
      }
    </script>
@endsection    
@endsection      