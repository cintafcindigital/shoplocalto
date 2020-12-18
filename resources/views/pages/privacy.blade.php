@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<!-- SLIDER SECTION START -->
@include('includes.inner-slider')
<!-- / END SLIDER SECTION -->

       <section id="about-section" class="section-padding">
            <div class="container">
                    
                    <!-- ========================================= CONTENT ========================================= -->
                    <div class="col-xs-12 col-sm-12 col-md-12 no-margin">
                        <section id="gaming">
                            <div class="grid-list-products">
                                <div class="tab-content">
                                
                                    <div id="list-view" class="products-grid fade tab-pane  active in">
                                        <div class="products-list">


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