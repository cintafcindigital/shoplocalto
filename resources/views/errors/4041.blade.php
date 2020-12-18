@extends('layouts.default')
@section('meta_title','404 Page | My Health Squad')
@section('meta_keyword','My Health Squad')
@section('meta_description','My Health Squad')
@section('content')
         @include('includes.menu')
        <!-- SLIDER SECTION START -->
        <section id="slider-seciton">
                <div class="header-bottom"></div>
                <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel" style="background:url({{ URL::asset('public/sliders/bg_404.jpg') }});background-size: cover;">
                    <!-- Indicators -->
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" style="position:relative">
                        <div class="container">
                            <div class="slider-cont">
                             <h3><strong><i class="fa fa-frown-o" aria-hidden="true" style="font-size: 60px;"></i><br>Page not found</strong></h3>
                             <p class="text-center">Sorry, We couldn't found that page.</p>
                            </div>
                        </div>
                        <div class="item active slider-background"></div>
                    </div>
                </div>
        </section>
       <!-- / END SLIDER SECTION -->

       <section class="vendor-step-wrap">
           <div class="container">
               <div class="form-field field-button" style="text-align: center;">
                <a href="{{url('/')}}" class="btn btn-lg" style="padding: 15px 20px;">Go To Home</a>
               </div>
            </div>
       </section><!-- Vendor Step Wrapper -->
        
        <!-- / END SUBSCRIBE SECTION-->
        @include('includes.footer')
@endsection