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
      
      <div class="object-center">
        <i style="font-size:20px;color:green" class="fa fa-check-circle"></i>
        <br>
        <h3>Your order has been placed succesfully.</h3>
        <h5>Your invoice has been mailed on your email id - {{$objTxnMaster->consumer_email}}.</h5> 
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
<script type="text/javascript">
   if({{ (isset($message) && $message != '') ? 1 : 0 }})
   {
     $('.message-div').html('{{ (isset($message)) ? $message : ''}}');
     $('.message-div').show();
   }
</script>
@endsection    
@endsection