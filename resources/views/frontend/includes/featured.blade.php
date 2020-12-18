<section class="slw-sec" id="sec1">
                        <div class="section-title">
                            <h2>The Featured Listing</h2>
                            <div class="section-subtitle">Newest  Listings</div>
                            <span class="section-separator"></span>
                            <p>Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum.</p>
                        </div>
                        <div class="listing-slider-wrap fl-wrap">
                            <div class="listing-slider fl-wrap">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!--  swiper-slide  -->
                                        @foreach($vendors as $vendor)
                                        <div class="swiper-slide">
                                            <div class="listing-slider-item fl-wrap">
                                                <!-- listing-item  -->
                                                <div class="listing-item listing_carditem">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="geodir-category-img">
                                                            <div class="geodir-js-favorite_btn"><i class="fal fa-heart"></i><span>Save</span></div>
                                                            <a href="listing-single.html" class="geodir-category-img-wrap fl-wrap">
                                                            <img src="{{asset('vendors/VENDOR_'.$vendor->vendor_id.'/'.$vendor->featured_image)}}" alt=""> 
                                                            </a>
                                                            <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>Open Now</div>
                                                            <div class="geodir-category-opt">
                                                                <div class="geodir-category-opt_title">
                                                                    <h4><a href="{{url('singleshop')}}">{{$vendor->business_name}}</a></h4>
                                                                    <div class="geodir-category-location"><a href="#"><i class="fas fa-map-marker-alt"></i>  {{$vendor->business_address}}</a></div>
                                                                </div>
                                                                <!-- <div class="listing-rating-count-wrap">
                                                                    <div class="review-score">4.1</div>
                                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                                    <br>
                                                                    <div class="reviews-count">26 reviews</div>
                                                                </div> -->
                                                                <div class="listing_carditem_footer fl-wrap">
                                                                    <a class="listing-item-category-wrap" href="#">
                                                                        <div class="listing-item-category red-bg"><i class="fal fa-cheeseburger"></i></div>
                                                                        <span>Restaurants</span>
                                                                    </a>
                                                                    <!-- <div class="price-level geodir-category_price">
                                                                        <span class="price-level-item" data-pricerating="2"></span>
                                                                        <span class="price-name-tooltip">Pricey</span>
                                                                    </div> -->
                                                                    <div class="post-author"><a href="#"><img src="{{asset('vendors/VENDOR_'.$vendor->vendor_id.'/'.$vendor->profile)}}" alt=""><span>By , {{$vendor->contact_person}}</span></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- listing-item end -->                                                   
                                            </div>
                                        </div>
                                        @endforeach
                                        <!--  swiper-slide end  -->  
                                        <!--  swiper-slide  -->
                                        
                                        <!--  swiper-slide end  -->                                        
                                    </div>
                                </div>
                                <div class="listing-carousel-button listing-carousel-button-next2"><i class="fas fa-caret-right"></i></div>
                                <div class="listing-carousel-button listing-carousel-button-prev2"><i class="fas fa-caret-left"></i></div>
                            </div>
                            <div class="tc-pagination_wrap">
                                <div class="tc-pagination2"></div>
                            </div>
                        </div>
                    </section>