<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" >

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS
    ================================================== -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template
    ================================================== -->
    <link href="{{asset('css/uikit.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="uikit/js/html5shiv.js"></script>
    <script src="uikit/js/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .page-wrapper{
        #background-color: #F9F9F9 !important;
        background-color: transparent !important;
      }
      .tag-line{
        font-weight:bold;
        color:#e95144;
        font-size:17px;
        font-family: 'Poiret One', cursive;
      }
      .top-header-menu{
        margin: 0px;     
        float: right; 
      }
      .top-header-menu-li {
        margin-right: 8px;
        margin-left: 8px;
        font-size: 12px;
      }
      .header-cols{
        /*height: 130px;*/
      }
      .main-header .brand-col{
        padding-top: 0px !important;
        padding-bottom: 24px !important;
      }
      .cart-button-title{
          vertical-align:top;
          margin-left:10px;
      }
      .blue-button{
        background-color: #006CB4;
        border-radius: 3px !important;
        color: #fff;
      }
      .blue-button:hover, .blue-button:visited, .blue-button:focus{
        color: #fff !important;
      }
      .simple-container{
         padding-top: 0px !important;
         padding-bottom: 15px !important;
      }
      .generic-page-header{
        text-align: center;
        margin-bottom: 10px;
      }
       .generic-page-header-left{
       
      }
      .generic-page-header-hr{
        color: #e7214c;
        margin: 0 auto;
        width: 100px;
        margin-bottom: 30px;
        border-bottom: 2px solid #e7214c;
      }
      .message-div{
        background-color: #e7214c;
        border-radius: 3px;
        margin-top: 5px;
        margin-bottom: 20px;
        padding: 10px;
        color: #fff;
        display: none;
      }
      .btn-block{
        display: -moz-box;
      }
      .footer-menu-xs{
        display: block;
        background-color: #fff;
        margin-right: 5px;
        margin-left: 5px;
        text-align: center;
        border-style:solid;
        border-color:grey;
        border-radius: 3px;
        margin-bottom: 10px;
        border-width: 0.08em;
        border-bottom: 0px;
      }
      .footer-menu-xs div{
        border-bottom: 0.08em solid grey;
        padding: 5px 0px 5px 0px;
      }
      .footer-menu-xs a{
        color: grey;
      }
      .footer-menu-right-icon{
        float:right;
        margin:5px 20px 0px 0px;
      }
      .object-center{
        width: 100%;
        text-align: center;
      }
      .yellow-link, .yellow-link:active, .yellow-link:focus, .yellow-link:hover{
        color:yellow;
      }
      .left-align-header-h4{
        background-color: #D3DCE3;
        padding: 6px 15px;
        margin-bottom: 2px;
        color: black;
        text-transform: capitalize;
      }
      .desc{
        display: inline !important;
        text-transform: capitalize;
      }
      .product .title{
        padding: 0px 30px 0px 30px;
        word-wrap: break-word;
      }
      .button-div-center{
        width: 100%;
        text-align: center;
      }
      .white-text{
        color: #fff;
      }
      .grey-text{
        color: #807F83;
      }
      .red-text{
        color: #E7214C;
      }
        
      .intro-slider .slide .text{
        height: 70% !important;
      } 
      .zero-border-table td{
        border-top: 0px !important;
      }
      .top-right-span
      {
        float: right;
        margin-top: -10px;
        margin-right: -10px;
        padding: 3px;
        background-color: #007FB8;
        color: #FFFFFF;
        border-radius: 0px 0px 0px 7px;
      }
      .order-box{
        background-color:white;
        padding:10px;
        border:1px solid #007FB8;
      }
      .text-icon-box i{
        font-size: 35px;
        position: absolute;
        margin-top: -6px;
      }
      .text-icon-box span{
        margin-left: 40px;
      }

      /* Small devices (tablets, 768px and up) */
      @media (min-width: 300px) {
        .intro-slider .bx-viewport{
          height: 150px !important;
        }
      }

      /* Medium devices (desktops, 992px and up) */
      @media (min-width: 700px) {
        .intro-slider .bx-viewport{
          height: 500px !important;
        }
      }
    </style>
  </head>