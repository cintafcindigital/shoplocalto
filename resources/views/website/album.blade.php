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
    <title> {{$albumData['couple_name'] ?? 'Wedshoot Album'}} - Perfect Wedding Day </title>
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
    <link rel="stylesheet" href="{{URL::asset('public/css/website/custom-box.css')}}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>   
    .do-ani{
    background-position: -600px;
}

     .dresses-list-item-fav.app-tools-dresses-save{cursor: pointer;
    background-image: url(https://cdn1.weddingwire.ca/assets/img/sprite_fav.png);
    width: 40px;
    height: 40px;
    z-index: 1;
    position: absolute;
    float: right;}
   .animation {
    -webkit-animation: fav .6s steps(16);
    animation: fav .6s steps(16);
}
   .new-font{
        font-family: "Niconne", cursive;
   }
    </style>
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
             if(isset($albumData['banner_image']) && $albumData['banner_image']!=''){
               $defaultImage = $albumData['banner_image'];
             }else{
               $defaultImage = URL::asset('public/images/album_selfie.jpg');
             }
        @endphp
        <!-- start of hero -->   
        <section class="hero hero-slider-wrapper parallax" data-bg-image="{{ $defaultImage ?? $defaultImage}}">
            <div class="announcement-wrapper container">
                <div class="row">
                    <div class="col col-md-8 col-md-offset-2">
                        <div class="announcement wow fadeInLeftSlow" data-wow-delay="0.3s">
                            <div class="announcement-holder wow fadeIn" data-wow-delay="1s">
                                <span class=" wow fadeInDown" data-wow-delay="1.3s">Wedding Photos</span>
                                <h1 class=" wow fadeInDown" data-wow-delay="1.5s">{{$albumData['couple_name'] ?? ''}}</h1>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of hero slider -->
        <!-- start of couple -->
        <section class="couple section-padding" id="couple" style="background-color:#f1f1f1;padding:60px 0 0;">
            <div class="container">
                <div class="row section-title" style="margin-bottom:0px;">
                    <h2 style="margin:auto;"><i class="fi flaticon-favorite"></i> Wedshoots <i class="fi flaticon-favorite"></i></h2>
                </div>
            </div> <!-- end of container -->
        </section>
        <!-- end of couple -->
        
        <!-- start love-story -->
        <section class="love-story section-padding" id="story" style="background-color:#f1f1f1;">
            <div class="container">
                       <div class="row add-images-via">
                            <?php $counter = 1;  ?> 
                             @if(isset($photos) && !empty($photos))
                              @foreach($photos as $pho)
                                <?php if($counter%3 == 1){ ?> <div class="w3-row-padding w3-margin-top">  <?php } ?>    
                                   
                                   <div class="w3-third">
                                     <!-- <div onclick="addlike(this)" data-id="{{$pho['id']}}" class="dresses-list-item-fav app-tools-dresses-save">
                                      <div class="btn-fav on animation" ></div>
                                     </div> -->
                                     <div class="w3-card">
                                       <img style="width:100%;" src="{{$pho['image']}}">
                                            @if($pho['title'])
                                                <div class="w3-container">
                                                    <h5 class="new-font" style="font-size:25px;">{{$pho['title']}}</h5>
                                                    <p class="new-font" style="font-size:20px;">{{$pho['note']}}</p>
                                                </div>
                                            @endif
                                     </div>
                                   </div>
                                <?php if(($counter % 3) == 0){ ?> </div>  <?php } ?>
                                <?php $counter++; ?>
                              @endforeach
                             @endif
                              <?php  if ($counter%3 != 1) echo "</div>"; ?>
                        </div>
                       
        </section>
        <!-- end of love-story -->
        <!-- start footer -->
        <footer>
           <p class="text-center">
                Wedding Wedshoots by <a href="{{url('/')}}">Perfect Wedding Day</a>
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
 
</body>
</html>
