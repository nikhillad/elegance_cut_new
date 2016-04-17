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

          <!-- generic header title -->
          <div class="col-md-12 generic-page-header-left">
            <h4>Your Orders</h4>
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
          
          <div class="row">
            @if(count($objOrders) > 0)
            <div class="col-xs-12">
            @foreach($objOrders as $order)
                <div class="media order-box">
                  <div class="top-right-span">Order ID: {{$order->order_id}}</div>
                  <div class="media-left">
                    <a href="#">
                      <img style="width:90px" class="media-object" src="{{asset('images/products/P/product3.jpg')}}" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <table class="table table-hover table-condensed zero-border-table">
                      <tr>
                        <td class="col-xs-4">
                          <strong style="font-size:18px">tshirt 3</strong><br>
                          sleevless t-shirt
                        </td>
                        <td><span style="font-size:14px"><strong>Total:</strong> Rs. {{number_format($order->price)}}</span></td>
                        <td><span style="font-size:14px"><strong>Status:</strong> <span style="color:green">{{$order->status}}</span></span></td>
                      </tr>
                      <tr>
                        <td><strong>Qty:</strong> {{$order->qty}}</td>
                        <td><span style="font-size:14px"><strong>Order placed:</strong> {{date('d-m-Y H:i:s',strtotime($order->created_at))}}</span></td>
                      </tr>
                    </table>
                    <button class="btn btn-default">Track Package</button>
                    <button class="btn btn-default">Return Package</button>
                  </div>
                </div>
            @endforeach
            </div>
            @else
            <div class="col-xs-12">
              <div class="text-icon-box alert alert-info">
                <i class="fa fa-info-circle"></i>
                <span>No order history to show.</span>
              </div>
            </div>
            @endif
          </div>

        </div>
        <!-- /Container -->
        
      </section>
      <!-- /Content Block
      ============================================-->
      <!-- remove error and success from session -->
      {{$_SESSION['elegance_cut']['error'] = null}}
      {{$_SESSION['elegance_cut']['success'] = null}}

@section('script')    
    
@endsection    
@endsection      