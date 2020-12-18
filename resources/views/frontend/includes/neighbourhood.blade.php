<section   class="gray-bg hidden-section particles-wrapper">
                        <div class="container">
                            <div class="section-title">
                                <h2>Shop by Neighbourhood</h2>
                                <div class="section-subtitle">Catalog of Categories</div>
                                <span class="section-separator"></span>
                                <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.</p>
                            </div>
                            <div class="listing-item-grid_container fl-wrap">
                                <div class="row">
                                    @foreach($locations as $location)
                                	<div class="col-sm-4">
                                        <div class="listing-item-grid">
                                            <div class="bg"  data-bg="locations/{{$location->image}}"></div>
                                            <div class="d-gr-sec"></div>
                                            
                                            <div class="listing-item-grid_title">
                                                <h3><a href="{{url('locations/'.$location->slug)}}">{{$location->name}}</a></h3>
                                                <p>{{$location->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                                                                                                           
                                </div>
                            </div>
                            @if(count($locations)>8)
                            <a href="listing.html" class="btn dec_btn   color2-bg">View All Cities<i class="fal fa-arrow-alt-right"></i></a>
                            @endif
                        </div>
                    </section>