<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WeddingTime - Responsive Wedding Template">
    <meta name="keywords" content="wedding,events,ceremony,couple,pear,love">
    <!-- Page Title -->
    <title> {{$websiteData['couple_name'] ?? 'Wedding Website'}} - Perfect Wedding Day </title>
    <!-- Favicon and Touch Icons -->
    <link href="images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    <!-- Icon fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Plugins for this template -->
    <link href="{{URL::asset('public/css/website/animate.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('public/css/website/style.css')}}" rel="stylesheet">
</head>

<body id="home">
   
    <!-- start page-wrapper -->
    <div class="page-wrapper home-static">
        
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader">
                <i class="fi flaticon-window"></i>
            </div>
        </div>
        <!-- end preloader -->
        @php
             if($websiteData['banner_image']!=''){
               $defaultImage = $websiteData['banner_image'];
             }else{
               $defaultImage = URL::asset('public/images/web_background.jpeg');
             }
        @endphp
        <!-- start of hero -->   
        <section class="hero hero-slider-wrapper parallax" data-bg-image="{{ $defaultImage ?? $defaultImage}}">
            <div class="announcement-wrapper container">
                <div class="row">
                    <div class="col col-md-8 col-md-offset-2">
                        <div class="announcement wow fadeInLeftSlow" data-wow-delay="0.3s">
                            <div class="announcement-holder wow fadeIn" data-wow-delay="1s">
                                <span class=" wow fadeInDown" data-wow-delay="1.3s">Celebrating Wedding</span>
                                <h1 class=" wow fadeInDown" data-wow-delay="1.5s">{{$websiteData['couple_name'] ?? ''}}</h1>
                                @if(isset($websiteData['wedding_date']) && $websiteData['wedding_date'] !='0000-00-00' && $websiteData['wedding_date'] !='')
                                <span class="date wow fadeInDown" data-wow-delay="1.8s">{{date('d F Y',strtotime($websiteData['wedding_date']))}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of hero slider -->
        <!-- start of couple -->
        <section class="couple section-padding" id="couple" style="background-color:#{{$websiteData['background_color'] ?? 'f1f1f1'}}">
            <div class="container">
                <div class="row section-title">
                    <h2><i class="fi flaticon-favorite"></i> {{$websiteData['couple_name'] ?? ''}} <i class="fi flaticon-favorite"></i></h2>
                </div> <!-- end of section-title -->
                
                <div class="row">
                    <div class="col col-lg-10 col-lg-offset-1">
                        <div class="row">
                            <!-- <span class="heart"><i class="fa fa-heart"></i></span> -->
                            <div class="col col-sm-6">
                                <div class="groom wow fadeInLeftSlow">
                                    @php if(isset($partnerData[0]) && !empty($partnerData[0]['avatar'])){
                                       $pro1 = url('storage').'/'.$partnerData[0]['avatar'];
                                    }else{
                                       $pro1 = URL::asset('public/images/default-avatar.jpg');
                                    }
                                    @endphp
                                    <img src="{{$pro1??''}}" style="200px" class="img img-responsive" alt>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="bride wow fadeInRightSlow">
                                    @php if(isset($partnerData[0]) && !empty($partnerData[0]['partner_avatar'])){
                                       $pro2 = url('storage').'/'.$partnerData[0]['partner_avatar'];
                                    }else{
                                       $pro2 = URL::asset('public/images/default-avatar.jpg');
                                    }
                                    @endphp
                                    <img src="{{$pro2??''}}" style="200px" class="img img-responsive" alt>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div> <!-- end of container -->
        </section>
        <!-- end of couple -->
        <!-- start count-down -->
        <section class="count-down parallax" data-bg-image="{{$websiteData['banner_image'] ?? ''}}">
            <h2 class="hidden">Count down</h2>
            <div class="container">
                <div class="row">
                    <div class="col col-md-8 col-md-offset-2">
                        <div id="clock"></div>
                    </div>
                </div>
            </div> <!-- end of container -->
        </section>
        <!-- end of count-donw -->
        <!-- start love-story -->
        <section class="love-story section-padding" id="story" style="background-color:#{{$websiteData['background_color'] ?? 'f1f1f1'}}">
            <div class="container">
                <div class="row section-title">
                    <h2><i class="fi flaticon-favorite"></i>{{$websiteData['title'] ?? ''}} <i class="fi flaticon-favorite"></i></h2>
                </div> <!-- end of section-title -->

                <div class="story-details">
                       <p style="padding: 0px 50px 0 50px;">{{$websiteData['description'] ?? ''}}</p>
                </div>
            </div> <!-- end of container -->
        </section>
        <!-- end of love-story -->
        <!-- start footer -->
        <footer>
           <p class="text-center">
                Wedding Website by <a href="{{url('')}}">Perfect Wedding Day</a>
            </p>
        </footer>
        <!-- end footer -->
    </div>
    <!-- end of page-wrapper -->
    <!-- All JavaScript files
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{URL::asset('public/js/website/jquery-plugin-collection.js')}}"></script>
    <!-- Custom script for this template -->
    <script src="{{URL::asset('public/js/website/script.js')}}"></script>
    <script>
        /*------------------------------------------
        = BIGDAY COUNTDOWN
        -------------------------------------------*/
        var weddingDate = '<?php echo ($websiteData['wedding_date'] != "0000-00-00")?date("M d, Y",strtotime($websiteData['wedding_date'])):"0"; ?>';
        if ($("#clock").length) {
            var todaysDate = new Date();
            var marrigeDate = new Date(weddingDate); 
            $("#clock").countdown({
                until: marrigeDate
            }).on('update.countdown', function(event) {
                $(this).addClass("asdf");
            });
        }
    </script>
</body>
</html>
