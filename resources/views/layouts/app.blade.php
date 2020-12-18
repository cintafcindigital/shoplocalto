<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perfect Wedding Day') }}</title>  
    <!-- Styles -->
    <!-- <link href="{{ url('public/css/app.css') }}" rel="stylesheet"> -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">  
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/raty/jquery.raty.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/main.css')}}">
<style>
.skin-blue .main-header .navbar {
    background-color: #26A69A;
}
.skin-blue .main-header .logo:hover {
    background-color: #26A69A;
    color: #fff;
    border-bottom: 0 solid transparent;
}
.skin-blue .main-header .logo {
    background-color: #26A69A;
        padding: 5px 0px;
    color: #fff;
    border-bottom: 0 solid transparent;
}
.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #1e282c;
    border-left-color: #26A69A;
}
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #263238;
}
.skin-blue .main-header .navbar .sidebar-toggle:hover {
    color: #fff;
    background-color: #1CA094;
}
.sidebar {
    padding-bottom: 10px;
    font-size: 15px;
}
.skin-blue .sidebar a {
    color: #ffffff;
}
.skin-blue .main-header .navbar {
    background-color: #26A69A;
    padding: 5px 0px;
}
.main-header{ background-color: #26A69A; }
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 80px;
        height: 80px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    #loading {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: 999999;
        background: rgba(12, 11, 11, 0.75);
    }
   #loaderImg{
        margin: auto;
        display: block;
        margin-top: 240px;
    }
    label.label {
        font-size: 14px;
    }
.sidebar{ margin-top:10px;}
</style>
</head>
<body>
<body class="hold-transition skin-blue sidebar-mini">
  <div id="loading" style="display: none;">
    <div class="loader" id="loaderImg"></div>
  </div>
    <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">AM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img width="100" src="{{url('public/images/logo.jpg')}}"></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav"> 
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <ul class="dropdown-menu">                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                     <!--  <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign out </a> -->
                    </div>
                  </li>
                </ul>
              </li>              
            </ul>
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav"> 
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                    <a href="{{url('admin/logout')}}">
                        <span class="hidden-xs">Sign out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
              </li>              
            </ul>
          </div>
        </nav>

      </header>
      <style>.sidebar-menu>li .label, .sidebar-menu>li .badge {
            margin-top: 3px;
            margin-right: 25px;
        }</style> 
    
      <aside class="main-sidebar">
            <section class="sidebar">
              @php $uri = Request::segment(2) @endphp
                <ul class="sidebar-menu">
                    <li class="header">SITE MANAGEMENT</li>
                    <li class="treeview ">
                      <a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>            
                    </li>  
                    <li class="treeview @if($uri == 'manage-admin' || $uri == 'company-settings' || $uri == 'social-settings' || $uri == 'edit-admin' || $uri == 'edit-company-settings' || $uri == 'edit-social-settings' || $uri == 'faqs' || $uri == 'add-faq' || $uri == 'edit-faq' || $uri == 'wedding-stories' || $uri =='add-wedding-stories' || $uri =='edit-wedding-stories' ) ) active @endif">
                      <a href="#"><i class="fa fa-wrench"></i> <span>Site Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/manage-admin') }}">Manage Admin</a></li> 
                          <li><a href="{{ url('admin/company-settings') }}">Company Settings</a></li> 
                          <li><a href="{{ url('admin/social-settings') }}">Social Media</a></li> 
                          <!-- <li><a href="{{ url('admin/faqs') }}">Manage FAQs</a></li> -->
                          <li><a href="{{ url('admin/wedding-stories') }}">Manage Wedding Stories</a></li>
                        </ul>
                    </li>
                     <li class="treeview @if($uri == 'pages' || $uri == 'add-slider' || $uri == 'add-page' || $uri == 'edit-page') ) active @endif">
                      <a href="#"><i class="fa fa-file"></i> <span>Page Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/pages') }}">Manage Pages</a></li> 
                          <li><a href="{{ url('admin/add-slider') }}">Manage Slider</a></li> 
                        </ul>
                    </li>
                    <li class="treeview @if($uri=='categories' || $uri =='add-category' || $uri =='edit-category') active @endif">
                      <a href="#"><i class="fa fa-cog"></i> <span>Manage Category</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/categories') }}">Categories</a></li> 
                        </ul>
                    </li>
                    <li class="treeview @if($uri=='add-questions' || $uri == 'questions' || $uri == 'edit-to-category' || $uri == 'add-to-category') active @endif">
                      <a href="#"><i class="fa fa-question"></i> <span>Frequently Questions</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/questions') }}">Manage Questions</a></li> 
                          <li><a href="{{ url('admin/add-questions') }}">Add Questions</a></li> 
                        </ul>
                    </li>
                    <li class="treeview @if($uri=='vendors' || $uri =='vendor-details') active @endif">
                      <a href="#"><i class="fa fa-briefcase"></i> <span>Manage Vendors</span> <i class="fa fa-angle-left pull-right"></i>
                         @if(isset($slideBar['new_vendors']) && $slideBar['new_vendors'] >= 1)
                         <small class="label pull-right bg-red">New</small>
                         @endif
                      </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/vendors') }}">Vendors</a></li>
                          <li><a href="{{ url('admin/inactive-vendors') }}">Inactive Vendors</a></li>
                        </ul>
                    </li>
                     <li class="treeview @if($uri=='users') active @endif">
                      <a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> <span>Manage Users</span>
                         @if(isset($slideBar['new_users']) && $slideBar['new_users'] >= 1)
                         <small class="label pull-right bg-red">New</small>
                         @endif
                      </a>
                    </li>
                     <li class="treeview @if($uri == 'contact-enquiry' || $uri == 'request-enquiry') ) active @endif">
                      <a href="#"><i class="fa fa-life-ring"></i> <span>Enquiry</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/request-enquiry') }}">Request Enquiry</a></li> 
                          <li><a href="{{ url('admin/contact-enquiry') }}">Contact Us</a></li> 
                        </ul>
                    </li>
                    <li class="treeview @if($uri=='admin-testimonials') active @endif">
                      <a href="{{ url('admin/admin-testimonials') }}"><i class="fa fa-quote-left"></i> <span>Testimonials</span> </a>            
                    </li>               
                     <li class="treeview @if($uri=='newsletter') active @endif">
                      <a href="{{ url('admin/newsletter') }}"><i class="fa fa-envelope"></i> <span>Newsletter</span> </a>            
                    </li>

                     <li class="treeview @if($uri=='Community' || $uri =='add-group-community') active @endif">
                      <a href="#"><i class="fa fa-users"></i> <span>Community</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/community') }}">Manage Community</a></li> 
                        </ul>
                    </li>

                    <li class="treeview @if($uri=='weddingideas' || $uri =='add-weddingideas-categories') active @endif">
                      <a href="#"><i style="width: 20px" class="far fa-lightbulb"></i> <span>Wedding Ideas</span> <i class="fa fa-angle-left pull-right"></i> </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/weddingideas') }}">Manage Wedding Ideas</a></li> 
                        </ul>
                    </li>

                    <li class="treeview @if($uri=='weddingdress' || $uri =='weddingdress-designer' || $uri =='weddingdress-collections' || $uri =='weddingdress-products') active @endif">
                      <a href="#"><i style="width: 20px" class="fas fa-tshirt"></i> <span>Wedding Dresses</span> <i class="fa fa-angle-left pull-right"></i> </a>
                        <ul class="treeview-menu">
                          <li><a href="{{ url('admin/weddingdress') }}">Wedding Dress Type</a></li>
                          <li><a href="{{ url('admin/weddingdress-designer') }}">Wedding Dress Designer</a></li>
                          <li><a href="{{ url('admin/weddingdress-collections') }}">Wedding Dress Collections</a></li>
                          <li><a href="{{ url('admin/weddingdress-products') }}">Wedding Dress Product</a></li>

                        </ul>
                    </li>
                </ul>
            </section>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <style>
     .content{ min-height: 0px; }
    </style>     
        @yield('content')
    <!-- /.content -->
  </div>
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 <a href="#">{{ config('app.name', 'Perfect Wedding Day') }}</a>.</strong> All rights reserved.
      </footer>
      
    </div><!-- ./wrapper -->

    <!--  JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->

    <script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/plugins/datatablesCurrent/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>
    <!-- CK Editor -->
    <!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>-->
    <!-- Select2 -->
    <script src="{{asset('assets/admin/plugins//select2/select2.full.min.js')}}"></script>
    <!-- bootstrap time picker -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
   <!-- <script src="http://localhost/cardcenter/assets/admin/plugins//timepicker/bootstrap-timepicker.min.js"></script> -->
    <script src="{{asset('assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
   <!-- <script src="http://localhost/cardcenter/assets/admin/plugins//pace/pace.min.js"></script> -->
   <!-- <script type="text/javascript" src="http://localhost/cardcenter/assets/js/jquery.datetimepicker.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
    <!-- <script src="{{asset('assets/admin/dist/js/star-rating.js')}}"></script> -->
    <script src="{{asset('assets/admin/dist/js/bootstrap-filestyle.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/raty/jquery.raty.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/admin-perfectweddingday.js')}}"></script>

    <script>
        $(".select3").select2();    
        $(document).on('ready', function () {
            $(document).ajaxStart(function(){
                    $("#loading").css("display", "block");
            });

            $(document).ajaxComplete(function(){
                   $("#loading").css("display", "none");
            });
        });
        var ajaxUrl = '{{ url("/admin") }}';
    </script>
    <script>
      $.fn.raty.defaults.path = '{{asset('assets/admin/plugins/raty/images')}}';
      $(function () {
           $('.readOnly').raty({ readOnly: true });
            $('.readOnly-callback').raty({
              readOnly: function() {
                return 'true becomes readOnly' == 'true becomes readOnly';
              }
            });

       });

      $(function () {

      	 $('.fq-type-handler').click(function(){
      	 	 var typeVal = $(this).val();
      	 	 if(typeVal=='radio' || typeVal == 'checkbox'){
                $('.other-field').removeClass('hide');
                $('.show-first').addClass('hide');
      	 	 }else{
      	 	 	$('.other-field').addClass('hide');
      	 	 	$('.show-first').removeClass('hide');
      	 	 	$('.more-fields').html('<tr><td><input type="text" name="options[]" id="options"  class="form-control" placeholder="Option Value"></td><td><input type="number" name="orders[]" id="orders"  class="form-control" placeholder="Sequence Number"></td><td><button type="button" id="add-more" class="btn btn-primary">Add</button></td></tr>');
      	 	 }
      	 });

         var counter = 1;          
          $(document).on('click','#add-more',function(){   
            var html ='';
              counter++;
              html += '<tr id="row-'+counter+'" class="delete-html">';              
              html += '</td><td><input type="text"  name="options[]" id="base_fare" class="form-control" required placeholder="Option Value"></td><td><input type="number"  name="orders[]" id="km_price"  class="form-control" required placeholder="Sequence No."></td><td><button type="button" delete-row="'+counter+'" class="btn btn-danger danger-row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>'
              $('.more-fields').append(html);
            });
           $(document).on('click','.danger-row',function(){
               var delelteRow =  $(this).attr('delete-row');      
               $('#row-'+delelteRow).remove();
          });

         CKEDITOR.replace('description');               
         CKEDITOR.replace('image_description');     


      });




    </script>

   
</html>
