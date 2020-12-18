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
  font-size: 150%;
}

#signup-features {
    margin: 100px auto;
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
                                <h1 class="register_h1">Thank you for the request</h1>
                                <p><a href="/"><button class="btn btn-lg btn-signup">Back to Home</button></a></p>
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
               <div style="text-align:center;padding:50px;">
                   <big>Request successfully sent!</big>
               </div>
            </div>
        </div>
    </div>
</section><!-- Vendor Step Wrapper -->

@include('includes.footer')

@endsection