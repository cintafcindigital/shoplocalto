@extends('frontend/layouts/header')
@section('content')
            <div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!--section  -->
                    @include('frontend/includes/session1')
                    <!--section end-->
                    <!--section  -->
                    
                    <!--section end-->
					<div class="sec-circle fl-wrap"></div>
                    <!--section -->
                    @include('frontend/includes/neighbourhood')
                    @include('frontend/includes/featured')
                   
                    
                    <!--section  -->
                    @include('frontend/includes/work')
                    @include('frontend/includes/video')
                    
                    @include('frontend/includes/testimonials')
                    
                </div>
                <!--content end-->
            </div>
            @endsection
            