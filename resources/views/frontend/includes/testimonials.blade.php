<section>
                        <div class="container">
                            <div class="section-title">
                                <h2> Testimonials</h2>
                                <div class="section-subtitle">Clients Reviews</div>
                                <span class="section-separator"></span>
                                <p>Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="testimonilas-carousel-wrap fl-wrap">
                            <div class="listing-carousel-button listing-carousel-button-next"><i class="fas fa-caret-right"></i></div>
                            <div class="listing-carousel-button listing-carousel-button-prev"><i class="fas fa-caret-left"></i></div>
                            <div class="testimonilas-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!--testi-item-->
                                        @foreach($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="testi-item fl-wrap">
                                                <div class="testi-avatar"><img src="{{asset('testimonials')}}/{{$testimonial->image}}" alt=""></div>
                                                <div class="testimonilas-text fl-wrap">
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                    <p>"{!!$testimonial->description !!}"</p>
                                                    <a href="#" class="testi-link" target="_blank">Via Facebook</a>
                                                    <div class="testimonilas-avatar fl-wrap">
                                                        <h3>{{$testimonial->added_by }}</h3>
                                                        <!-- <h4>Restaurant Owner</h4> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!--testi-item end-->
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="tc-pagination"></div>
                        </div>
                        <div class="waveWrapper waveAnimation">
                          <div class="waveWrapperInner bgMiddle">
                            <div class="wave-bg-anim waveMiddle" style="background-image: url('images/frontend/wave-top.png')"></div>
                          </div>
                          <div class="waveWrapperInner bgBottom">
                            <div class="wave-bg-anim waveBottom" style="background-image: url('images/frontend/wave-top.png')"></div>
                          </div>
                        </div> 						
                    </section>