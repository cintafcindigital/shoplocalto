@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<!-- SLIDER SECTION START -->
<!--include('includes.inner-slider')-->
        <section id="slider-seciton">
               <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }});background-size: 100%;position: relative;background-repeat: no-repeat;">
                    <!-- Indicators -->                   
                    <!-- Wrapper for slides -->
                    <span style="position: absolute;height: 100%;width: 100%;background: #00000047;"></span>
                    <div class="carousel-inner" role="listbox" style="position:relative">                                
                             <div class="container">    
                                    <!-- <div class="slider-cont"> -->
                                      <div class="slider-cont">
                                       {!! $pageData['image_description'] !!}
                                       </div>
                                    <!-- </div> -->
                                    </div>                               
                        <div class="item slider-background active"></div>
                    </div>
                </div>           
        </section>

       <section id="about-section" class="section-padding testimonial-section">
            <div class="container">
                    
                    <!-- ========================================= CONTENT ========================================= -->
                    <div class="col-xs-12 col-sm-12 col-md-12 no-margin">
                        <section id="gaming">
                            <div class="grid-list-products">
                                <div class="tab-content">
                                
                                    <div id="list-view" class="products-grid fade tab-pane  active in">
                                        <div class="products-list">


                                        @if(isset($testimonials) && !empty($testimonials))
                                        @foreach($testimonials as $test)
                                          
                                            <div class="testimonial-list product-item-holder">
                                                <div class="row">
                                                    <div class="no-margin col-xs-12 col-sm-12 col-md-4 image-holder">
                                                        <div class="image">
                                                            <img alt="" src="{{URL::asset('public/testimonials')}}/{{$test->image}}" style="width: 100%;height: 250px;object-fit: cover;vertical-align: unset;margin: unset;padding: unset;max-width: unset;">
                                                        </div>
                                                    </div><!-- /.image-holder -->
                                                    <div class="no-margin col-xs-12 col-md-8 col-sm-12 body-holder">
                                                        <div class="body">
                                                            <div class="pull-left"><div class="title">
                                                                <a href="#">{{$test->name}}</a>
                                                            </div>
                                                            <div class="brand"><i class="fa fa-calendar" aria-hidden="true"></i>
{{date('D, jS M, Y',strtotime($test->created_at))}}</div></div>
                                                            <div class="clear"></div>
                                                            <div class="excerpt">
                                                                <p>{!!$test->description!!}</p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div><!-- /.body-holder -->
                                                    <!-- /.price-area -->
                                                </div><!-- /.row -->
                                            </div><!-- /.product-item -->

                                        @endforeach
                                        <div class="text-center">
                                            {{$testimonials->links()}}
                                        </div>
                                        @endif()
                            
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
        
        <a id="submit-testimonial-request" title="Submit A Testimonial" style="position: fixed;width: 50px;z-index: 9;height: 50px;bottom: 0;right: 0;margin: 10px 15px;background: #980c2b;border-radius: 30px;text-align: center;padding-top: 15px;color: #fff;" href="{{url('add-testimonial')}}"><i class="fa fa-plus"></i></a>
        <script>
            $('#submit-testimonial-request').tooltip();
        </script>
@endsection