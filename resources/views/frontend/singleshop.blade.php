 @extends('frontend/layouts/header')
 @section('content')
 <div id="wrapper">
                <!-- content-->
                <div class="content">
                    <section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="sec1">
                        <div class="bg-parallax-wrap">
                            <div class="bg par-elem "  data-bg="{{asset('images/frontend/bg/1.jpg')}}" data-scrollax="properties: { translateY: '30%' }"></div>
                            <div class="overlay"></div>
                        </div>
                        <div class="container">
                            <div class="list-single-header-item  fl-wrap">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h1>Iconic Cafe in Manhattan <span class="verified-badge"><i class="fal fa-check"></i></span></h1>
                                        <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>  70 Bright St New York, USA</a> <a href="#"> <i class="fal fa-phone"></i>+38099231212</a> <a href="#"><i class="fal fa-envelope"></i> yourmail@domain.com</a></div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="list-single-header_bottom fl-wrap">
                                <a class="listing-item-category-wrap" href="#">
                                    <div class="listing-item-category  red-bg"><i class="fal fa-cheeseburger"></i></div>
                                    <span>Restaurants</span>
                                </a>
                                <div class="list-single-author"> <a href="author-single.html"><span class="author_avatar"> <img alt='' src='{{asset('images/frontend/avatar/1.jpg')}}'>  </span>By  Alisa Noory</a></div>
                                <div class="geodir_status_date gsd_open"><i class="fal fa-lock-open"></i>Open Now</div>
                                <div class="list-single-stats">
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- scroll-nav-wrapper--> 
                    <div class="scroll-nav-wrapper fl-wrap">
                        <div class="container">
                            <nav class="scroll-nav scroll-init">
                                <ul class="no-list-style">
                                    <li><a class="act-scrlink" href="#sec1"><i class="fal fa-images"></i> Top</a></li>
                                    <li><a href="#sec2"><i class="fal fa-info"></i>Details</a></li>
                                    <li><a href="#sec3"><i class="fal fa-image"></i>Gallery</a></li>
                                    <li><a href="#sec5"><i class="fal fa-comments-alt"></i>Reviews</a></li>
                                </ul>
                            </nav>
                            <div class="scroll-nav-wrapper-opt">
                                <a href="#" class="scroll-nav-wrapper-opt-btn"> <i class="fas fa-heart"></i> Save </a>
                                <a href="#" class="scroll-nav-wrapper-opt-btn showshare"> <i class="fas fa-share"></i> Share </a>
                                <div class="share-holder hid-share">
                                    <div class="share-container  isShare"></div>
                                </div>
                                <div class="show-more-snopt"><i class="fal fa-ellipsis-h"></i></div>
                                <div class="show-more-snopt-tooltip">
                                    <a href="#"> <i class="fas fa-comment-alt"></i> Write a review</a>
                                    <a href="#"> <i class="fas fa-flag-alt"></i> Report </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- scroll-nav-wrapper end--> 
                    <section class="gray-bg no-top-padding">
                        <div class="container">
                            <div class="breadcrumbs inline-breadcrumbs fl-wrap">
                                <a href="#">Home</a><a href="#">Listings</a><a href="#">New York</a><span>Listing Single</span> 
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <!-- list-single-main-wrapper-col -->
                                <div class="col-md-8">
                                    <!-- list-single-main-wrapper -->
                                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                                        
                                        <!-- list-single-main-item --> 
                                        <div class="list-single-main-item fl-wrap block_box">
                                            <div class="list-single-main-item-title">
                                                <h3>Description</h3>
                                            </div>
                                            <div class="list-single-main-item_content fl-wrap">
                                                <p>Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec nec velit non odio aliquam suscipit. Sed non neque faucibus, condimentum lectus at, accumsan enim.   </p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>
                                                
                                            </div>
                                        </div>
                                        <!-- list-single-main-item end -->                                               
                                        <!-- list-single-main-item --> 
                                        <div class="list-single-main-item fl-wrap block_box">
                                            <div class="list-single-main-item-title">
                                                <h3>Listing Features</h3>
                                            </div>
                                            <div class="list-single-main-item_content fl-wrap">
                                                <div class="listing-features fl-wrap">
                                                    <ul class="no-list-style">
                                                        <li><a href="#"><i class="fa fa-rocket"></i> Elevator in building</a></li>
                                                        <li><a href="#"><i class="fa fa-wifi"></i> Free Wi Fi</a></li>
                                                        <li><a href="#"><i class="fa fa-motorcycle"></i> Free Parking</a></li>
                                                        <li><a href="#"><i class="fa fa-cloud"></i> Air Conditioned</a></li>
                                                        <li><a href="#"><i class="fa fa-shopping-cart"></i> Online Ordering</a></li>
                                                        <li><a href="#"><i class="fa fa-paw"></i> Pet Friendly</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- list-single-main-item end -->                                    
                                        <!-- list-single-main-item-->   
                                        <div class="list-single-main-item fl-wrap block_box" id="sec3">
                                            <div class="list-single-main-item-title">
                                                <h3>Gallery / Photos</h3>
                                            </div>
                                            <div class="list-single-main-item_content fl-wrap">
                                                <div class="single-carousel-wrap fl-wrap lightgallery">
                                                    <div class="sc-next sc-btn color2-bg"><i class="fas fa-caret-right"></i></div>
                                                    <div class="sc-prev sc-btn color2-bg"><i class="fas fa-caret-left"></i></div>
                                                    <div class="single-carousel fl-wrap full-height">
                                                        <div class="swiper-container">
                                                            <div class="swiper-wrapper">
                                                                <!-- swiper-slide-->   
                                                                <div class="swiper-slide">
                                                                    <div class="box-item">
                                                                        <img  src="{{asset('images/frontend/all/1.jpg')}}"   alt="">
                                                                        <a href="{{asset('images/frontend/all/1.jpg')}}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                                    </div>
                                                                </div>
                                                                <!-- swiper-slide end-->   
                                                                <!-- swiper-slide-->   
                                                                <div class="swiper-slide">
                                                                    <div class="box-item">
                                                                        <img  src="{{asset('images/frontend/all/1.jpg')}}"   alt="">
                                                                        <a href="{{asset('images/frontend/all/1.jpg')}}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                                    </div>
                                                                </div>
                                                                <!-- swiper-slide end-->                                                                  
                                                                <!-- swiper-slide-->   
                                                                <div class="swiper-slide">
                                                                    <div class="box-item">
                                                                        <img  src="{{asset('images/frontend/all/1.jpg')}}"   alt="">
                                                                        <a href="{{asset('images/frontend/all/1.jpg')}}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                                    </div>
                                                                </div>
                                                                <!-- swiper-slide end-->                                                                 
                                                                <!-- swiper-slide-->   
                                                                <div class="swiper-slide">
                                                                    <div class="box-item">
                                                                        <img  src="{{asset('images/frontend/all/1.jpg')}}"   alt="">
                                                                        <a href="{{asset('images/frontend/all/1.jpg')}}" class="gal-link popup-image"><i class="fa fa-search"  ></i></a>
                                                                    </div>
                                                                </div>
                                                                <!-- swiper-slide end-->                                                                  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          
                                        
                                         
                                        <div class="list-single-main-item fl-wrap block_box" id="sec5">
                                            <div class="list-single-main-item-title">
                                                <h3>Item Reviews -  <span> 2 </span></h3>
                                            </div>
                                            <!--reviews-score-wrap-->   
                                            <div class="reviews-score-wrap fl-wrap">
                                                <div class="review-score-total">
                                                    <span class="review-score-total-item">
                                                    4.1
                                                    </span>
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                </div>
                                                <div class="review-score-detail">
                                                    <!-- review-score-detail-list-->
                                                    <div class="review-score-detail-list">
                                                        <!-- rate item-->
                                                        <div class="rate-item">
                                                            <div class="rate-item-title"><span>Quality</span></div>
                                                            <div class="rate-item-bg" data-percent="100%">
                                                                <div class="rate-item-line gradient-bg"></div>
                                                            </div>
                                                            <div class="rate-item-percent">5.0</div>
                                                        </div>
                                                        <!-- rate item end-->
                                                        <!-- rate item-->
                                                        <div class="rate-item">
                                                            <div class="rate-item-title"><span>Location</span></div>
                                                            <div class="rate-item-bg" data-percent="90%">
                                                                <div class="rate-item-line gradient-bg"></div>
                                                            </div>
                                                            <div class="rate-item-percent">4.0</div>
                                                        </div>
                                                        <!-- rate item end-->                                                        
                                                        <!-- rate item-->
                                                        <div class="rate-item">
                                                            <div class="rate-item-title"><span>Price</span></div>
                                                            <div class="rate-item-bg" data-percent="60%">
                                                                <div class="rate-item-line gradient-bg"></div>
                                                            </div>
                                                            <div class="rate-item-percent">3.0</div>
                                                        </div>
                                                        <!-- rate item end-->  
                                                        <!-- rate item-->
                                                        <div class="rate-item">
                                                            <div class="rate-item-title"><span>Service</span></div>
                                                            <div class="rate-item-bg" data-percent="80%">
                                                                <div class="rate-item-line gradient-bg"></div>
                                                            </div>
                                                            <div class="rate-item-percent">4.0</div>
                                                        </div>
                                                        <!-- rate item end--> 
                                                    </div>
                                                    <!-- review-score-detail-list end-->
                                                </div>
                                            </div>
                                            <!-- reviews-score-wrap end -->                                             
                                            <div class="list-single-main-item_content fl-wrap">
                                                <div class="reviews-comments-wrap">
                                                    <!-- reviews-comments-item -->  
                                                    <div class="reviews-comments-item">
                                                        <div class="review-comments-avatar">
                                                            <img src="{{asset('images/frontend/avatar/1.jpg')}}" alt=""> 
                                                        </div>
                                                        <div class="reviews-comments-item-text fl-wrap">
                                                            <div class="reviews-comments-header fl-wrap">
                                                                <h4><a href="#">Liza Rose</a></h4>
                                                                <div class="review-score-user">
                                                                    <span class="review-score-user_item">4.2</span>
                                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                                </div>
                                                            </div>
                                                            <p>" Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. "</p>
                                                            <div class="reviews-comments-item-footer fl-wrap">
                                                                <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i>12 April 2018</span></div>
                                                                <a href="#" class="rate-review"><i class="fal fa-thumbs-up"></i>  Helpful Review  <span>2</span> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--reviews-comments-item end--> 
                                                    <!-- reviews-comments-item -->  
                                                    <div class="reviews-comments-item">
                                                        <div class="review-comments-avatar">
                                                            <img src="{{asset('images/frontend/avatar/1.jpg')}}" alt=""> 
                                                        </div>
                                                        <div class="reviews-comments-item-text fl-wrap">
                                                            <div class="reviews-comments-header fl-wrap">
                                                                <h4><a href="#">Adam Koncy</a></h4>
                                                                <div class="review-score-user">
                                                                    <span class="review-score-user_item">5.0</span>
                                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                                </div>
                                                            </div>
                                                            <p>" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. "</p>
                                                            <div class="review-images ">
                                                                <a href="{{asset('images/frontend/all/1.jpg')}}" class="image-popup"><img src="{{asset('images/frontend/all/1.jpg')}}" alt=""></a>
                                                                <a href="{{asset('images/frontend/all/1.jpg')}}" class="image-popup"><img src="{{asset('images/frontend/all/1.jpg')}}" alt=""></a>
                                                            </div>
                                                            <div class="reviews-comments-item-footer fl-wrap">
                                                                <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i>03 December 2017</span></div>
                                                                <a href="#" class="rate-review"><i class="fal fa-thumbs-up"></i>  Helpful Review  <span>4</span> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--reviews-comments-item end-->                                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <!-- list-single-main-item end -->                                       
                                        <!-- list-single-main-item -->   
                                        <div class="list-single-main-item fl-wrap block_box" id="sec6">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Add Review</h3>
                                            </div>
                                            <!-- Add Review Box -->
                                            <div id="add-review" class="add-review-box">
                                                <!-- Review Comment -->
                                                <form id="add-comment" class="add-comment  custom-form" name="rangeCalc" >
                                                    <fieldset>
                                                        <div class="review-score-form fl-wrap">
                                                            <div class="review-range-container">
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Cleanliness</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="4">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end --> 
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Comfort</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1"  value="1">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end --> 
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Staf</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="5" >
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end --> 
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Facilities</div>
                                                                    <div class="range-slider-wrap">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="3">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end -->                                     
                                                            </div>
                                                            <div class="review-total">
                                                                <span><input type="text" name="rg_total"   data-form="AVG({rgcl})" value="0"></span>    
                                                                <strong>Your Score</strong>
                                                            </div>
                                                        </div>
                                                        <div class="list-single-main-item_content fl-wrap">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label><i class="fal fa-user"></i></label>
                                                                    <input type="text" placeholder="Your Name *" value=""/>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label><i class="fal fa-envelope"></i>  </label>
                                                                    <input type="text" placeholder="Email Address*" value=""/>
                                                                </div>
                                                            </div>
                                                            <textarea cols="40" rows="3" placeholder="Your Review:"></textarea>
                                                            <div class="clearfix"></div>
                                                            <div class="photoUpload">
                                                                <span><i class="fal fa-image"></i> <strong>Add Photos</strong></span>
                                                                <input type="file" class="upload" multiple>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <button class="btn  color2-bg  float-btn">Submit Review <i class="fal fa-paper-plane"></i></button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                            <!-- Add Review Box / End -->
                                        </div>
                                        <!-- list-single-main-item end -->                                    
                                    </div>
                                </div>
                                <!-- list-single-main-wrapper-col end -->
                                <!-- list-single-sidebar -->
                                <div class="col-md-4">
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Working Hours</h3>
                                        </div>
                                        <div class="box-widget opening-hours fl-wrap">
                                            <div class="box-widget-content">
                                                <ul class="no-list-style">
                                                    <li class="mon"><span class="opening-hours-day">Monday </span><span class="opening-hours-time">9 AM - 5 PM</span></li>
                                                    <li class="tue"><span class="opening-hours-day">Tuesday </span><span class="opening-hours-time">9 AM - 5 PM</span></li>
                                                    <li class="wed"><span class="opening-hours-day">Wednesday </span><span class="opening-hours-time">9 AM - 5 PM</span></li>
                                                    <li class="thu"><span class="opening-hours-day">Thursday </span><span class="opening-hours-time">9 AM - 5 PM</span></li>
                                                    <li class="fri"><span class="opening-hours-day">Friday </span><span class="opening-hours-time">9 AM - 5 PM</span></li>
                                                    <li class="sat"><span class="opening-hours-day">Saturday </span><span class="opening-hours-time">9 AM - 3 PM</span></li>
                                                    <li class="sun"><span class="opening-hours-day">Sunday </span><span class="opening-hours-time">Closed</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                                                         
                                    <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Location / Contacts  </h3>
                                        </div>
                                        <div class="box-widget">
                                            <div class="map-container">
                                                <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781" data-mapTitle="Our Location"></div>
                                            </div>
                                            <div class="box-widget-content bwc-nopad">
                                                <div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
                                                    <ul class="no-list-style">
                                                        <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#">USA 27TH Brooklyn NY</a></li>
                                                        <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="#">+7(123)987654</a></li>
                                                        <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="#">AlisaNoory@domain.com</a></li>
                                                        <li><span><i class="fal fa-browser"></i> Website :</span> <a href="#">themeforest.net</a></li>
                                                    </ul>
                                                </div>
                                                <div class="list-widget-social bottom-bcw-box  fl-wrap">
                                                    <ul class="no-list-style">
                                                        <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                        <li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>
                                                        <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                                    </ul>
                                                    <div class="bottom-bcw-box_link"><a href="#" class="show-single-contactform tolt" data-microtip-position="top" data-tooltip="Write Message"><i class="fal fa-envelope"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    
                                    
                                    
                                    <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Tags</h3>
                                        </div>
                                        <div class="box-widget opening-hours fl-wrap">
                                            <div class="box-widget-content">
                                                <div class="list-single-tags tags-stylwrap">
                                                    <a href="#">Hotel</a>
                                                    <a href="#">Hostel</a>
                                                    <a href="#">Room</a>
                                                    <a href="#">Spa</a>
                                                    <a href="#">Restaurant</a>
                                                    <a href="#">Parking</a>                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="box-widget-item fl-wrap block_box">
                                        <div class="box-widget-item-header">
                                            <h3>Send a message now</h3>
                                        </div>
                                        <div class="box-widget">
                                            <div class="box-widget-content">
                                                <form   class="add-comment custom-form">
                                                    <fieldset>
                                                        <label><i class="fal fa-user"></i></label>
                                                        <input type="text" placeholder="Your First Name and Last Name *" value=""/>
                                                        <div class="clearfix"></div>
                                                        <label><i class="fal fa-envelope"></i>  </label>
                                                        <input type="text" placeholder="Email Address*" value=""/>
                                                        <div class="clearfix"></div>
                                                        <label><i class="fal fa-phone"></i>  </label>
                                                        <input type="text" placeholder="Phone Number*" value=""/>
                                                        <div class="clearfix"></div>
                                                        <textarea cols="40" rows="3" placeholder="Comment"></textarea>
                                                    </fieldset>
                                                    <button class="btn color2-bg url_btn float-btn" onclick="window.location.href='booking.html'">Send Message <i class="fal fa-bookmark"></i></button>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    
                                                    <h6><input type="checkbox" checked> Agree to receive promotional emails and messages from ShopLocalTO.ca.</h6>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget-item end -->       
                                </div>
                                <!-- list-single-sidebar end -->                                
                            </div>
                        </div>
                    </section>
                    <div class="limit-box fl-wrap"></div>
                </div>
                <!--content end-->
            </div>
            @endsection