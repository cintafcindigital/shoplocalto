@extends('frontend/layouts/header')
@section('content')
<div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!--  section  -->
                    <section class="parallax-section small-par" data-scrollax-parent="true">
                        <div class="bg"  data-bg="{{asset('images/frontend/bgimage1.jpg')}}" data-scrollax="properties: { translateY: '30%' }"></div>
                        <div class="overlay op7"></div>
                        <div class="container">
                            <div class="error-wrap">
                                <div class="bubbles">
                                    <h2>404</h2>
                                </div>
                                <p>We're sorry, but the Page you were looking for, couldn't be found.</p>
                                <div class="clearfix"></div>
                                <!-- <form action="#">
                                    <input name="se" id="se" type="text" class="search" placeholder="Search.." value="Search...">
                                    <button class="search-submit color-bg" id="submit_btn"><i class="fal fa-search"></i> </button>
                                </form> -->
                                <div class="clearfix"></div>
                                
                                <a href="{{url('')}}" class="btn   color2-bg">Back to Home Page<i class="far fa-home-alt"></i></a>
                            </div>
                        </div>
                    </section>
                    <!--  section  end-->
                </div>
                <!--content end-->
            </div>
            @endsection