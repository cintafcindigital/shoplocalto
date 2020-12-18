@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<!--include('includes.inner-slider')-->
<!-- SLIDER SECTION START -->
    <section id="slider-seciton">
       <div class="header-bottom"></div>
       <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
            <div class="carousel-inner" role="listbox" style="background:url({{ URL::asset('public/sliders') }}/{{ $pageData['image'] }});background-size:cover;height: 350px;position: relative;">
                <span style="position: absolute;width: 100%;height: 100%;background: #00000066;">
                    <h1 class="banner-title">Contact Us</h1>
                </span>
            </div>
        </div>           
    </section>
<style> .error-text{ color: #F11D1D;
         font-size: 14px;
    }
</style>      
<!-- / END SLIDER SECTION -->


       <!-- ABOUT SECTION START-->
        <section class="section-padding">
            <div class="container">
                <div class="login-col contact-wrap"> 
                    <div class="login-content">
                        <p>Please fill in this form with your comments or questions and we will get back to you within 2 business days.</p>
                        <div class="form-content">
                         @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        @if(session()->has('danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('danger') }}
                        </div>
                        @endif
                        <form action="{{url('send-enquiry')}}" method="post">
                           {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input type="text" name="name" placeholder="Name *" class="form-control">
                                    @if($errors->has('name'))
                                     <span class="custom-error">{{$errors->first('name')}}</span>
                                    @endif
                                 </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="email" placeholder="E-mail *" class="form-control">
                                    @if($errors->has('email'))
                                     <span class="custom-error">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <select class="form-control" name="reason">
                                        <option value="" selected="" disabled="">Choose a reason for contact</option>
                                        <option value="Community Contribution">Community Contribution</option>
                                        <option value="Request for a Health Professional">Request for a Health Professional</option>
                                        <option value="Employment">Employment</option>
                                        <option value="General Inquiry / Other">General Inquiry / Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="phone" placeholder="Phone" class="form-control">
                                </div>
                                <div class="form-group col-sm-12">
                                    <textarea name="comment" id="" cols="30" rows="5" class="form-control" placeholder="Comment *"></textarea>
                                    @if($errors->has('comment'))
                                     <span class="custom-error">{{$errors->first('comment')}}</span>
                                    @endif
                                </div>
                                @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    
                                @endif
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <div class="g-recaptcha" data-sitekey="{{'6Lfst80ZAAAAALX7HIMxbftvMW-Fqit6kS8ajQh3'}}"></div>
                                    </div>
                                </div>
                            </div>
                            <p><input type="submit" class="btn btn-lg" value="Send Message"></p>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END ABOUT SECTION-->

        <!-- / END SUBSCRIBE SECTION-->
        @include('includes.footer')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection