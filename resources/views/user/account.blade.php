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

          <!-- generic header title -->
          <div class="col-md-12 generic-page-header">
            <h2>My Account</h2>
          </div>
          <div class="clearfix"></div>
          <hr class="generic-page-header-hr">

          <!-- Row -->
          <div class="row">

            <!-- Main Col -->
            <div id="main-col" class="col-sm-12 col-md-12">
                
                @if ($objUserMaster->email_verified == false)
                <div class="alert alert-info">
                  Your email has not been verified yet! <a href="{{route('generate_verify_link',['token_type'=>config('global.token_types.verify_email')])}}">Click here to verify</a> it now.
                </div>
                @endif
                <div class="message-div"></div>
                <table class="table-striped table">
                  <tr>
                    <td><strong>Name</strong></td><td>{{$objUserMaster->fname}} {{$objUserMaster->lname}}</td>
                  </tr>
                  <tr>
                    <td><strong>Email</strong></td><td>{{$objUserMaster->email}}</td>
                  </tr>
                  <tr>
                    <td><strong>Mobile</strong></td><td>{{$objUserMaster->mobile}}</td>
                  </tr>
                  <tr>
                    <td><strong>Address</strong></td>
                    <td>
                      {{$objUserMaster->address}}<br>
                      {{$objUserMaster->city}}, {{$objUserMaster->state}}, {{$objUserMaster->country}}<br>
                      {{$objUserMaster->zip_code}}
                    </td>
                  </tr>
                </table>
                
                <div class="button-div">
                    <a class="btn btn-danger" href="{{route('deactivate_account')}}"> De-activate account</a>
                    <a class="btn btn-default" href="{{route('edit_account')}}">Edit Details</a>
                </div>
            </div>


            <!-- /Main Col -->
            

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

      if({{ (isset($_SESSION['message']) && $_SESSION['message'] != '') ? 1 : 0 }})
      {
        $('.message-div').html("{{ (isset($_SESSION['message'])) ? $_SESSION['message'] : ''}}");
        $('.message-div').show();
        <?php unset($_SESSION['message']) ?>
      }
    </script>
@endsection    
@endsection      