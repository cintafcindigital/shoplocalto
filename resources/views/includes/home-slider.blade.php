<!-- SLIDER SECTION START -->
<section id="slider-seciton">
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide home-slider" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner qc_slider" role="listbox" style="position:relative">
            <div class="container">@include('includes.home_search')</div>
            <?php $counter = 1;
            if(count($sliders) > 0) {
                foreach ($sliders as $slider) { ?>
                    <div class="item <?php if($counter==1){echo"active";}?>" style="background-image:url({{url('public/sliders')}}/{{$slider->image}});background-repeat: no-repeat;background-attachment: fixed;background-position: center;"></div>
                    <?php
                    $counter++;
                }
            }
            ?>
            <div class="innner-slideroverlay"></div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- / END SLIDER SECTION -->