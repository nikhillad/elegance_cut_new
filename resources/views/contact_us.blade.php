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
            <h2>Contact Us</h2>
          </div>
          <div class="clearfix"></div>
          <hr class="generic-page-header-hr">

          <!-- Row -->
          <div class="row">

            <!-- Main Col -->
            <div id="main-col" class="col-sm-8 col-md-8 mgb-30-xs">
 
                <h4 class="case-c">Send us a message</h4>
                
                <p>Love us? Want to tell how awesome we are? Care for us? Want to help us improve? Give us a shout, we’ll reach you by all possible means.</p>
                
                <!-- message div to show errors, warnings etc. -->
                <div class="message-div">
                  
                </div>
                
                <!-- Comment Form -->
                <div class="contact-form">
                  <form action="{{route('contact_us')}}" method="post">
                    <!-- Row -->
                    <div class="row">
                      <!-- Col -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <input name="name" id="name" type="text" placeholder="Your Name - Required" class="form-control" value="{{(isset($form['name']) && $form['name'] != '') ? $form['name'] : ''}}">
                        </div>
                      </div>
                      <!-- /Col -->
                      <!-- Col -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <input value="{{(isset($form['email']) && $form['email'] != '') ? $form['email'] : ''}}" type="text" name="email" id="email" placeholder="Your Email - Required" class="form-control">
                        </div>
                      </div>
                      <!-- /Col -->
                    </div>
                    <!-- /Row -->
                    
                    <div class="form-group">
                     <textarea name="message" placeholder="You Message..." class="form-control" rows="8">{{(isset($form['message']) && $form['message'] != '') ? $form['message'] : ''}}</textarea>
                    </div>
                    
                    {{csrf_field()}}
                   
                    <button class="btn btn-default" type="submit">Send Message</button>
                  </form>
                </div>
                <!-- /Contact Form -->
                
            </div>
            <!-- /Main Col -->
            
            <!-- Side Col -->
            <div class="col-sm-4 col-md-4">

              <!-- Side Widget -->
              <div class="side-widget">
              
                <h5 class="boxed-title">Our location</h5>
                
                <!-- vlinks -->
                <ul class="vlinks vlinks-iconed vlinks-ruled-dots">
                  <li><i class="icon fa fa-home"></i>
                    No. 11, Hotel Kannimara Buildings,<br>
                    Prabhu Nagar, Kangayam main road,<br>
                    Tirupur – 641606, TAMILNADU.</li>
                  <li class="centered"><i class="icon fa fa-envelope"></i>info@zionfashions.com</li>
                  <li><i class="icon fa fa-phone-square"></i>+91 9833782304</li>
                </ul>
                <!-- /vlinks -->
                
              </div>
              <!-- /Side Widget -->
              
            </div>
            <!-- /Side Col -->

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