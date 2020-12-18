@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<style>
.error-text {
    color: #F11D1D;
    font-size: 14px;
}
</style>
<style>
   .category-container-ul{
      border: 1px solid #ddd;
      margin: auto;
      padding: 5px;
   }
   
/* The container */

.container-ul {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */

.container-ul input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container-ul:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container-ul input:checked ~ .checkmark {
  background-color: #83021e;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container-ul input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container-ul .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

section.signup-section {
    padding: 50px 0px;
}

section.signup-section h2 {
    font-size: 200%;
    margin-bottom: 25px;
    text-align: center;
}

label {
    font-weight:normal;
}

label.agreement {
    font-size: 90%;
    color: #83021e;
}

h1.register_h1 {
  padding: 100px 50px 25px 50px;
  color: #FFF;
  text-align:center;
  font-size: 200%;
}

#signup-features {
    margin: 50px auto;
}

.signup-feature {
    margin-bottom: 25px;
}

.btn-signup {
    background: #83021e;
    padding: 10px;
    font-size: 120%;
    color: #FFF;
}

span.error {
    
}

label input[type=checkbox] {
    display: inline;
    float:left;
    width: auto;
    height:auto;
    margin-right:15px;
}

.modal-body {
    padding: 25px 40px;
}

#service_choose li label {
    font-size: 90%;
}

.modal .modal-dialog {
    width: 800px;
    max-width: 90% !important;
}

p.info-text {
    color: #AAA;
    margin: 5px  0px;
}

.signup-feature {
    text-align:center;
    padding: 25px;
}

.signup-feature img {
    margin-bottom: 25px;
    width: 150px;
    height: auto;
}

h3.modal-title {
    font-size:200%;
}
</style>
<section id="slider-seciton"><!-- SLIDER SECTION START -->
    <div class="header-bottom"></div>
    <div id="myCarousel" class="carousel slide inner-slider" data-ride="carousel"><!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox" style="background:url({{URL::asset('public/sliders')}}/{{$pageData['image']}});background-size:cover;">
            <div class="item active slider-background">
                <span style="position: absolute;background: #00000061;height: 100%;width: 100%;z-index: -1;"></span>
                <div class="wrapper wrapper--blood">
                    <div class="pure-g">
                        <div class="pure-u-1 text-center">
                            <div class="adminAccessHero__title mb30">
                                <h1 class="register_h1">Use the power of the community and team effort to increase your visibility in the marketplace while spending more time taking care of your clients 
                                – we’ll take care of the rest.</h1>
                                
                                <p><a href="#" data-toggle="modal" data-target="#signupModal"><button class="btn btn-lg btn-signup">Get Started Today</button></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- / END SLIDER SECTION -->
<section class="signup-section">
   <div class="container">
       <div class="row">
           <div class="col-xs-12">
               <h2>Promote your practice with a <strong><u>profile</u></strong> page</h2>
               <p>
                    As you know, business has changed, even more in the last year. 
                    Clients want more online functionalities and services. According to the Canadian Medical Association and their report 
                    “The Future of Connected Health Care”, published in 2019, more than 3/4 of Canadians want to book appointments electronically 
                    and over 80% of them consult the Internet already about health issues and make their decisions about consultations based upon 
                    what they find… Are you ready to bring your practice to the next level?
                </p>
                <p>My Health Squad is a full and intuitive platform offering relevant content for clients and enhanced visibility for practitioners like you.</p>
                
                
            </div>
        </div>
        
        <div id="signup-features">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="signup-feature">
                        <img src="/public/images/promote.png" class="img-resonsive" />
                        <h3>Promote your practice with a profile page<br/>Use our prime space on our platform to show your profile</h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="signup-feature">
                        <img src="/public/images/visibility.png" class="img-resonsive" />
                        <h3>Increase your visibility and credibility by creating and sharing content</h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="signup-feature">
                        <img src="/public/images/comingsoon.png" class="img-resonsive" />
                        <h3>Stay tuned as we will be adding more features and functionalities in the coming weeks & months</h3>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section><!-- Vendor Step Wrapper -->

@include('includes.register-popup')

@include('includes.footer')

@endsection