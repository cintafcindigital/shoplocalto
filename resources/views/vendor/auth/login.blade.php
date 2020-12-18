@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<?php
    $verification = '';
    $verify = @Request::get('verification');
    if($verify) {
        $verification = decrypt($verify);
    }
?>
<section id="slider-seciton">
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
        <div class="carousel-inner" role="listbox" style="background:url({{URL::asset('public/sliders')}}/{{$pageData['image']}});background-size:cover;">
            <div class="item active slider-background">
                <div class="wrapper wrapper--blood">
                    <div class="xxpure-g row">
                        <div class="xxpure-u-2-3 col-sm-6 text-center">
                            <div class="adminAccessHero__title vendor-login-info">{!! $pageData['image_description'] !!}</div>
                            <a href="{{url('register')}}" class="adminLandingCta">Claim your listing </a>
                        </div>
                        <div class="xxpure-u-1-3 col-sm-6">
                            <form class="adminAccessLogin adminAccessLogin--right" name="frmAcceso" action="{{url('login')}}" method="post">
                                {{ csrf_field() }}
                                @if(session()->has('msg'))
                                    <p class="adminAccessLogin__error">{{ session()->get('msg') }}</p>
                                @endif
                                @if ($errors->has('username'))
                                   <p class="adminAccessLogin__error">{{ $errors->first('username') }}</p>
                                @endif
                                @if ($errors->has('password'))
                                   <p class="adminAccessLogin__error">{{ $errors->first('password') }}</p>
                                @endif
                                <p class="adminAccessLogin__title">Log In</p>
                                <div class="adminAccessLogin__inputContainer">
                                    <i class="adminAccessLogin__inputIcon adminAccessLogin__inputIcon--user"></i>
                                    <input class="adminAccessLogin__input adminAccessLogin__input--user" type="text" placeholder="Username" name="username" id="Login" value="{{$verification}}">
                                </div>
                                <div class="adminAccessLogin__inputContainer">
                                    <i class="adminAccessLogin__inputIcon adminAccessLogin__inputIcon--pass"></i>
                                    <input class="adminAccessLogin__input adminAccessLogin__input--pass" type="password" placeholder="Password" name="password" id="Password" maxlength="20">
                                </div>
                                <input class="adminAccessLogin__submit" type="submit" value="Log In">
                                <a class="adminAccessLogin__rememberPass app-va-open-modal" href="{{ url('password/reset') }}">Forgot your password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !!$pageData->description!! -->
<!-- ABOUT SECTION START-->
<style type="text/css">
    .about-section{
        padding:2%;
        background: #ddd;
    }
    .about-col > h4 {
        padding-bottom: 30px;
    }
    .about-col > span {
        font-size: 22px;
    }
    .about-section-2 {
        background: #ddd;
    }
    .desc {
        /*background: #fff;*/
        position: absolute;
        top: 30%;
        right: 50%;
        left: 3%;
        color: #000;
        font-size: 18px;
    }
    .icon-with-text{
        float: right;
        width: 100%;
        /*background: #fff;*/
        margin: 5px;
        text-align:justify;
        padding: 10px;
    }
    .icon-with-text:hover{
        /*-webkit-box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
        box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
        cursor: pointer;
        font-weight: bold;*/
    }
    .icon-with-text:hover span {
        /*-webkit-animation: in 1s;*/
    }
    @-webkit-keyframes in {
    from   { -webkit-transform: rotate(0deg); }
    to { -webkit-transform: rotate(20deg);}
    }

    @-webkit-keyframes out {
        0%   { -webkit-transform: rotate(20deg); }
        100% { -webkit-transform: rotate(0deg); }
    }
    .icon-with-text span{
        float: left;
        -webkit-animation: out 1s;
    }
    .about-section-call {
        padding: 50px;
        height: 250px;
        background: #9a9a9a;
        color: white;
    }
    .slideanim {
        visibility:hidden;
    }
    .slide {
        animation-name: slide;
        -webkit-animation-name: slide;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        visibility: visible;
    }
    @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  .logo-small {
    color: #83021e;
    font-size: 50px;
  }
  .about-cot {
    /*background: white; */
    height: 250px;
    border: 1px solid #ddd;
    /* border-radius: 6px; */
    /* padding-bottom: 5px; */
    /* padding-top: 0px; */
    padding: 16px;
    height: 300px;
  }
  .about-cot:hover {
    /*-webkit-box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
    box-shadow: -1px -1px 11px -6px rgba(0,0,0,0.75);
    cursor: pointer;*/
  }
  .about-cot > h4 {
    font-size: 19px;
    line-height: 1.375em;
    /*color: #0a0a0a;*/
    color: #000;
    font-weight: 400;
    margin-bottom: 30px;
    text-align: center;
    height: 35px;
  }
  .about-cot > p {
    text-align: justify;
  }
  .pic-about-cot {
    background-image: url('{{url('public/images/login-run.jpg')}}');
    /*background-attachment:fixed;*/
    background-repeat: no-repeat;
    background-size: cover;
    height: 450px;
    position: relative;
  }
  .more-info-text {
    /*background: #0000006b;*/
    margin-top: 13%;
    margin-left: 6%;
    padding: 3%;
    border-radius: 2px;
    color: #fff;
    font-size: 20px;
    line-height: 30px;
    text-align: justify;
  }
@media (max-width: 1440px){
    .more-info-text {
        margin-top: 25%;
    }
}
@media (max-width: 768px){
    .pic-about-cot {
        height: auto;
    }
    .pic-about-cot > p {
        margin-top: 5%;
    }
    .about-cot {
        height: 500px;
    }
    .about-cot > h4 {
        height: 23%;
    }
    .more-info-text {
        margin-top: 4%;
        background: transparent;
        color: #000;
    }
}
@media (max-width: 575px){
    .about-cot {
        height: auto;
    }
    .about-section {
        padding-top: 7%;
    }
    .icon-with-text {
        text-align: unset;
    }
}
</style>
<section class="about-section">
    <div class="row slideanim slide wrapper wrapper--blood">
        <div class="col-sm-4 col-md-4 about-cot">
            <span class="homeTools__itemIcon homeTools__itemIcon--myvendors logo-small"></span>
            <h4>Reach potential clients</h4>
            <p>Create an engaging profile that encourages clients to reach out to you. Set yourself apart in your designated field.</p>
        </div>
        <div class="col-sm-4 col-md-4 about-cot">
            <span class="homeTools__itemIcon homeTools__itemIcon--guests logo-small"></span>
            <h4>Get clients that are looking for your specific service now</h4>
            <p>Get in front of potential clients when they are in need of health services or treatments and make it easy for them to interact with you.</p>
        </div>
        <div class="col-sm-4 col-md-4  about-cot">
            <span class="homeTools__itemIcon homeTools__itemIcon--checklist logo-small"></span>
            <h4>We’re not just a plain listing, but your full portfolio to show the world</h4>
            <p>As a health professional you are well aware that client relationships come from deeper interactions, not just a simple listing in a phone book. Connecting directly with those people are essential to grow your business.</p>
        </div>
    </div>
</section>
<section class="about-section-2 visible-xs">
    <div style="height: 161px;padding: 0px;position: relative;padding-bottom: 84%;">
        <img src="{{url('public/images/login-run.jpg')}}" class="img-responsive" style="width: 100%;height: 263px;object-fit: cover;overflow: hidden;">
        <span style="position: absolute;width: 100%;height: 263px;background: #00000047;top: 0;bottom: 0;"></span>
        <div style="height: 100%;padding: 12% 7% 7% 7%;position: absolute;top: 0;color:#fff;font-size: 18px;">
            <p class="text-justify">My Health Squad will give you a clear advantage because the expertise and content of your peers will increase your own visibility. We will let you do what you do best - take care of your clients - while the entire team will chase around for content and new clients, and that can only improve your bottom line. </p>
        </div>
    </div>
</section>
<section class="about-section-2 hidden-xs">
    <div class="pic-about-cot">
        <span style="position: absolute;height: 100%;width: 100%;background: #00000047;"></span>
        <div class="row wrapper wrapper--blood">
            <div class="col-sm-6">
                <div class="more-info-text">
                    <p>My Health Squad will give you a clear advantage because the expertise and content of your peers will increase your own visibility. We will let you do what you do best - take care of your clients - while the entire team will chase around for content and new clients, and that can only improve your bottom line. </p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;">
            <span style="position: absolute;background: #0003;height: 100%;width: 100%;"></span>
            <img src="{{url('public/images/login-run.jpg')}}" style="width: 100%;">
            <div class="desc">
                <p class="text-justify">My Health Squad will give you a clear advantage because the expertise and content of your peers will increase your own visibility. We will let you do what you do best - take care of your clients - while the entire team will chase around for content and new clients, and that can only improve your bottom line. </p>
            </div>
        </div>
    </div> -->
</section>
<section class="about-section">
    <div class="row wrapper wrapper--blood">
        <div class="col-sm-12">
            <h3 class="text-center" style="padding-bottom: 15px;font-size: 28px;font-weight: normal;">Your Clean Bill of Business</h3>
        </div>
        <div class="col-sm-6">
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--budget"></span> Get notified when you have messages and requests for further information. Access your Clients Admin Tool (CAT) account to manage requests and information from your potential clients.</p>
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--myvendors"></span> Track your impressions and views.</p>
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--wedsite"></span> Manage your profile page, upload photos and update your service details.</p>
        </div>
        <div class="col-sm-6">
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--com"></span> Use your chat feature and interact in real time with potential clients.</p>
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--checklist"></span> Access your invoice and billing history with My Health Squad.</p>
            <p class="icon-with-text"><span class="homeTools__itemIcon homeTools__itemIcon--guests"></span>Request reviews from clients and reach an exclusive level of customer satisfaction and as an additional reward, get selected to join the MHS All-Star Team.For more details,check our the All-Star Team details here.</p>
        </div>
    </div>
</section>
<section>
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel">
        <div class="carousel-inner" role="listbox" style="position:relative;background-image: url({{url('public/images/login-health-page.jpg')}});background-position: center;    background-size: cover;background-attachment: fixed;">
            <span style="position: absolute;width: 100%;height: 100%;background: #00000066;"></span>
            <div class="container">
                <div class="slider-cont">
                    <h3 style="color: #fff;"><strong>LIVE HEALTHY & PROSPER WITH MY HEALTH SQUAD !</strong></h3>
                    <!-- <p class="text-left">My Health Squad will give you a clear advantage because the expertise and content of your peers will increase your own visibility. We will let you do what you do best - take care of your clients - while the entire team will chase around for content and new clients, and that can only improve your bottom line. </p> -->
                    <div class=" field-button qc_sign-btn text-center">
                        <a href="{{url('register')}}" class="btn btn-search">Claim your listing</a>
                    </div>
                </div>
            </div>
            <div class="item active" ></div>
        </div>
    </div>
</section>
@php
/*<p>Reach potential clients &amp; patients</p>

<p>Create an engaging profile that encourages clients &amp; patients to reach out to you. Set yourself apart as an health expert in your field.</p>

<p>Get clients &amp; patients that are looking for your specific service now</p>

<p>Get in front of potential clients &amp; patients when they are in need of health services and make it easy for them to interact with you.</p>

<p>We&rsquo;re not just a plain listing, but your full portfolio to show the world</p>

<p>As a health professional you are well aware that clients &amp; patients relationship come from deeper interactions, not just a simple phonebook listing. Connecting directly with those people are essential to grow your business.</p>
<!-- / END ABOUT SECTION-->

<h2>Your Business Dashboard</h2>

<ul>
    <li>
    <p>Get notified when you have messages and requests for further information. Access your Lead Gen Pro account to manage your leads.</p>
    </li>
    <li>
    <p>Track your impressions and views.</p>
    </li>
    <li>
    <p>Manage your profile page, upload photos and update your service details.</p>
    </li>
</ul>

<ul>
    <li>
    <p>Use your chat feature and interact in real time with potential clients &amp; patients.</p>
    </li>
    <li>
    <p>Access your invoice and billing history.</p>
    </li>
    <li>
    <p>Request reviews from past clients &amp; patients.</p>
    </li>
</ul> */
@endphp
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
@include('includes.footer')
<style>
    .confirm.btn.btn-lg.btn-primary {
        width: 70px;
        outline: none;
        padding-right: 5px;
    }
</style>
<script>
$( document ).ready(function() {
    var verification = "{{$verification}}";
    if(verification) {
        swal("Welcomes You", "Your Account is verified successfully!", "success");
    }
});
</script>
@endsection