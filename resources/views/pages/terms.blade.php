@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<!-- SLIDER SECTION START -->
<!-- <?php /*include('includes.inner-slider')*/ ?> -->
<!-- / END SLIDER SECTION -->
<!-- SLIDER SECTION START -->
        <section id="slider-seciton">
                   <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }});background-size: cover;object-fit: cover;height: 350px;background-repeat: no-repeat;background-position: center;background-attachment: unset;">
                    <!-- Indicators -->                   
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" style="position:relative">                                
                             <div class="container">    
                                    <!-- <div class="slider-cont"> -->
                                    @if( $pageData['id'] == 3 || $pageData['id'] == 5)
                                        @include('includes.search')
                                    @else
                                      <div class="slider-cont" style="font-size: 52px;color: #fff;font-weight: 600;">
                                        <span class="about-us-title">
                                       {{ strip_tags($pageData['image_description']) }}</span>
                                       </div>
                                    @endif
                                    <!-- </div> -->
                                    </div>               
                        <div class="item slider-background active custom-height" style="height: 350px;"></div>
                    </div>
                </div>           
        </section>
       <!-- / END SLIDER SECTION -->

       <section id="about-section" class="section-padding">
            <div class="container">
                    
                    <!-- ========================================= CONTENT ========================================= -->
                    <div class="col-xs-12 col-sm-12 col-md-12 no-margin">
                        <section id="gaming">
                            <div class="grid-list-products">
                                <div class="tab-content">
                                
                                    <div id="list-view" class="products-grid fade tab-pane  active in">
                                        <div class="products-list text-justify">


                                         {!! $pageData['description'] !!}

                                        </div><!-- /.products-list -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.grid-list-products -->

                        </section><!-- /#gaming -->
                    </div><!-- /.col -->
                    <!-- ========================================= CONTENT : END ========================================= -->
                </div>
        </section>

        <!-- / END SUBSCRIBE SECTION-->
        @include('includes.footer')
@endsection