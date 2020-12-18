  <!-- SLIDER SECTION START -->
        <section id="slider-seciton">
                   <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }});background-size: cover;position: relative;">
                    <!-- Indicators -->                   
                    <!-- Wrapper for slides -->
                    <span style="position: absolute;height: 100%;width: 100%;background: #00000066;"></span>
                    <div class="carousel-inner" role="listbox" style="position:relative">                                
                             <div class="container">    
                                    <!-- <div class="slider-cont"> -->
                                    @if( $pageData['id'] == 3 || $pageData['id'] == 5)
                                        @include('includes.search')
                                    @else
                                      <div class="slider-cont">
                                       {!! $pageData['image_description'] !!}
                                       </div>
                                    @endif
                                    <!-- </div> -->
                                    </div>                               
                        <div class="item slider-background active <?php if($pageData['id'] != 3 && $pageData['id'] != 5  && $pageData['id'] != 8){ echo"custom-height";} ?>"></div>
                    </div>
                </div>           
        </section>
       <!-- / END SLIDER SECTION -->