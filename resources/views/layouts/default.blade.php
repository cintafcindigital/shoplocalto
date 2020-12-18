<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic page needs
        ============================================ -->
        <title>@yield('meta_title')</title>
        <meta charset="utf-8">  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="keywords" content="@yield('meta_keyword')">
        <meta name="description" content="@yield('meta_description')">
        <meta name="author" content="">
        <!-- Mobile specific metas
        ============================================ -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Google web fonts
        ============================================ -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Roboto:300,400,500,700|Dancing+Script" rel="stylesheet">  
        
        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="{{url('public/images/mhs_favicon.png')}}">
        <link rel="shortcut icon" type="image/png" href="{{url('public/images/mhs_favicon.png')}}">
        <link rel="icon" type="image/png" href="{{url('public/images/mhs_favicon.png')}}">

        <!-- CSS  -->
        <!-- Bootstrap CSS
        ============================================ -->
        <link rel="stylesheet" href="{{URL::asset('public/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- font-awesome CSS
        ============================================ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{URL::asset('public/css/bootstrap-select.css')}}">

        <link rel="stylesheet" href="{{URL::asset('public/css/base.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/css/tools.css')}}">
        <link rel="stylesheet" href="{{url('public/css/slick.css')}}">
        
        <!-- owl.carousel CSS
        ============================================ -->
        <link rel="stylesheet" href="{{URL::asset('public/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/css/owl.theme.css')}}">
        <!-- animate CSS
        ============================================ -->
        <link rel="stylesheet" href="{{URL::asset('public/css/animate.css')}}">
        <!-- SuperSlider CSS
        ============================================ -->

        <!-- main CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">
        <!-- responsive CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{URL::asset('public/css/responsive.css')}}">
        <!-- prettyPhoto CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{URL::asset('public/css/lightbox.min.css')}}">
        <!-- prettyPhoto CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{URL::asset('public/css/prettyPhoto.css')}}">

        <link rel="stylesheet" href="{{URL::asset('public/css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/plugins/raty/jquery.raty.css')}}">
        <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
        <link rel="stylesheet" href="{{URL::asset('public/css/vendor.css')}}">

        
        <!-- modernizr js
        ============================================ -->        
        <script src="{{URL::asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{URL::asset('public/js/modernizr.js')}}"></script>
        <script src="{{url('public/js/slick.min.js')}}"></script>
        
        <script type="text/javascript">
            var globalLang = '';
            var GlobalVariables = {
                'userLogin' : '{!!json_encode(Auth::check())!!}',
                'userId'  : '{{(Auth::user())?Auth::user()->id:''}}',
                'baseUrl'  : '{{url('/')}}/',
                'dataHandler': {},
                'counter':0
            };
        </script>
        <script src="{{URL::asset('public/js/custom.js')}}"></script> 
        <script src="{{URL::asset('public/js/jscolor.js')}}"></script> 
        <style>
            a.result-entry:hover {
                background: #EEE;
            }
            .tox-notification { 
                display: none !important;
            }
        </style>
    </head>

    <body data-spy="scroll" data-offset="0" data-target="#navbar-main" class="dashbord">
        <div id="loading" style="display: none;">
            <div class="loader" id="loaderImg"></div>
        </div>
        @yield('content')       
        @include('includes.error_popup')
        <!-- JS --> 
        <!-- jquery js -->   
        <!-- bootstrap js -->
        <script type="text/javascript" src="{{URL::asset('public/js/bootstrap.min.js')}}"></script> 
       
        <!-- prettyPhoto js -->   
        <script type="text/javascript" src="{{URL::asset('public/js/jquery.prettyPhoto.js')}}"></script> 
        <!-- prettyPhoto js -->   
        <script type="text/javascript" src="{{URL::asset('public/js/lightbox.min.js')}}"></script> 
        <!-- easing js -->
        <script type="text/javascript" src="{{URL::asset('public/js/jquery.easing.1.3.js')}}"></script>
        <!-- isotope js -->
        <script type="text/javascript" src="{{URL::asset('public/js/isotope.pkgd.min-v-3.0.4.js')}}"></script> 
        <!-- mousescroll js -->
        <script type="text/javascript" src="{{URL::asset('public/js/mousescroll.js')}}"></script> 
        <!-- smoothscroll js -->
        <script type="text/javascript" src="{{URL::asset('public/js/smoothscroll.js')}}"></script> 
        <!-- inview js -->
        <script type="text/javascript" src="{{URL::asset('public/js/jquery.inview.min.js')}}"></script>
        <!-- superslides js -->
        <script type="text/javascript" src="{{URL::asset('public/js/jquery.superslides.min.js')}}"></script>
        <!-- owl carousel js -->
        <script type="text/javascript" src="{{URL::asset('public/js/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/js/bootstrap-select.js')}}"></script>
        <!-- wow js -->
        <script src="{{ URL::asset('public/js/wow.min.js') }}"></script>
        <!-- ajax contact js -->
        <script src="{{ URL::asset('public/js/app.js') }}"></script>   
           
        <script>
                new WOW().init();
        </script>   
        <!-- Main js -->    
        <script type="text/javascript" src="{{ URL::asset('public/js/main.js') }}"></script> 
        <script src="{{asset('assets/admin/plugins/raty/jquery.raty.js')}}"></script>
        <script>
          (function( $ ) {
            $.fn.raty.defaults.path = '{{asset('assets/admin/plugins/raty/images')}}';
            $(function () {
                   $('.writeRatig').raty();
                   $('.readOnly').raty({ readOnly: true });
                    $('.readOnly-callback').raty({
                      readOnly: function() {
                        return 'true becomes readOnly' == 'true becomes readOnly';
                      }
                    });

            });

            $(document).ajaxStart(function(){
               $("#loading").css("display", "block");
            });

            $(document).ajaxComplete(function(){
             $("#loading").css("display", "none");
            });

          })(jQuery);
           
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('.datetimepicker').datetimepicker({
                    format: 'DD/MM/YYYY',
                    viewMode: 'years'
                });
                $("body").delegate(".result-entry","click",function(e){
                    e.preventDefault();
                    $("#search").val($(this).attr("data-val"));
                    $("#result-entries").attr("style","display:none;");
                    $("#searchForm").submit();
                });
                
                $("#search").keyup(function(){
                    var val = $("#search").val();
                    
                    if(val.length > 0) {
                        
                        $.getJSON( "/search-string?search=" + val, function(response) {
                            $("#search-results").attr("style","display:block;");
                            $("#result-entries").html('');
                            
                            $.each( response, function( key, item ) {
                                  $("#result-entries").append('<li style="text-align:left;font-size:110%;"><a href="#" style="display:block;padding:10px;" class="result-entry" data-val="'+item.name+'">'+item.name+'</a></li>');
                            });
                            
                        }).done(function() {
                                
                        }).fail(function() {
                                
                        });
                    }
                    
                    if(val.length < 1) {
                        $("#search-results").attr("style","display:none;")
                    }
                })
            });
        </script>
       <!--  <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
        <script>
            // Export Lead Popup
              $('.export_lead_btn').click(function(){
                $('.export_lead_cont').show();
                $('.popup_overlay').show();
              });
              
              $('.export_close,.popup_overlay').click(function(){
                $('.export_lead_cont').hide();
                $('.popup_overlay').hide();
              });

              CKEDITOR.replace( 'business_detail',
            {
                toolbar :
                [
                    { name: 'basicstyles', items : [ 'Bold','Italic','Tabel','Block Quote' ] },
                    { name: 'paragraph', items : [ 'NumberedList','BulletedList', 'Format'] },
                    { name: 'tools', items : [ 'Maximize' ] }
                ]
            });

           
        </script> -->
    </body> 
</html>