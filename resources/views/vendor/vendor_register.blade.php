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
                            <div class="adminAccessHero__title mb30">{!! $pageData['image_description'] !!}</div>
                            <p style="color: #e8f2f5;">Already have an account? <a href="{{url('login')}}" class="link"> Log in</a><p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- / END SLIDER SECTION -->
<section class="vendor-step-wrap">
   <div class="container">
       <div class="vendors-signup-steps">
            <div class="progress-steps">
                <div class="complete"><span>1</span><hr></div>
                <div><span>2</span><hr></div>
                <!-- <div><span>3</span><hr></div> -->
                <!-- <div><span>4</span><hr></div> -->
            </div>
            <div class="progress-steps-ui">
                <span>General Information</span>
                <span>Photo gallery</span>
                <!-- <span>Frequently Asked Questions</span> -->
                <!-- <span>Promotions</span> -->
            </div>
        </div><!-- Vendors Signup Steps -->
        @if(session()->has('fail'))
            <div class="alert alert-danger">{{ session()->get('fail') }}</div>
        @endif
        <form action="" class="vendor-form-wrap form-submit-vendor" method="post" >
           {{ csrf_field() }}
            <div class="login-info-row">
                <h3>Login Information</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username *" class="form-control" value="@if(@$vendorData->username){{@$vendorData->username}}@else{{old('username')}}@endif" required>
                                @if($errors->has('username'))
                                    <span class="error-text"><strong>{{ $errors->first('username') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password *" class="form-control" required>
                                @if($errors->has('password'))
                                    <span class="error-text"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="vendor_id" value="{{@$vendorData->vendor_id}}">
                                <input type="hidden" name="company_id" value="{{@$vendorData->company_data->id}}">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password *" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="vendor-notice">
                            <p>You will use the username and password to access your account. Username must contain a minimum of 5 characters. Password must contain a minimum of 6 characters and is case sensitive.</p>
                        </div>
                    </div>
                </div>
            </div><!-- Login Information -->
            <div class="login-info-row">
                <h3>Contact information</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <div class="form-group">
                                <input type="text" name="contact_person" placeholder="Contact person *" class="form-control" required value="@if(@$vendorData->contact_person){{@$vendorData->contact_person}}@else{{old('contact_person')}}@endif">
                                 @if($errors->has('contact_person'))
                                    <span class="error-text"><strong>{{ $errors->first('contact_person') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" placeholder="E-mail *" class="form-control" required value="@if(@$vendorData->email){{@$vendorData->email}}@else{{old('email')}}@endif">
                                 @if($errors->has('email'))
                                    <span class="error-text"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="telephone" placeholder="Telephone *" class="form-control" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="@if(@$vendorData->telephone){{@$vendorData->telephone}}@else{{old('telephone')}}@endif">
                                @if($errors->has('telephone'))
                                    <span class="error-text"><strong>{{ $errors->first('telephone') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="mobile" placeholder="Mobile number" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="@if(@$vendorData->mobile){{@$vendorData->mobile}}@else{{old('mobile')}}@endif">
                            </div>
                            <div class="form-group">
                                <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="fax" placeholder="Fax" class="form-control" value="@if(@$vendorData->fax){{@$vendorData->fax}}@else{{old('fax')}}@endif">
                            </div>
                            <div class="form-group">
                                <input type="text" name="website" placeholder="Website" class="form-control" value="@if(@$vendorData->website){{@$vendorData->website}}@else{{old('website')}}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="vendor-notice">
                            <p>Inquiries from potential clients interested in your services and updates from My Health Squad will be sent to this email address.</p>
                        </div>
                    </div>
                </div>
            </div><!-- Contact information -->
            <div class="login-info-row">
                <h3>Business Information</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <div class="form-group">
                                <?php 
                                /* $countries = ['canada'=>'Canada','spain'=>'Spain','france'=>'France','italy'=>'Italy','united_kingdom'=>'United Kingdom','portugal'=>'Portugal','india'=>'India','mexico'=>'Mexico','chile'=>'Chile',
                                 'argentina'=>'Argentina','brazil'=>'Brazil','colombia'=>'Colombia','peru'=>'Peru','uruguay'=>'Uruguay'];*/
                                $countries = ['canada'=>'Canada'];
                                ?>
                                <select name="country" id="country" class="form-control" required>
                                    @foreach($countries as $key=>$contry)
                                        <option value="{{$key}}" @if(@$vendorData->company_data->country == $key) selected @elseif(old('country') == $key) selected @endif>{{$contry}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('country'))
                                    <span class="error-text"><strong>{{ $errors->first('country') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="province" id="province" class="form-control" required>
                                  <option value="">-- select province --</option>
                                    @foreach($regions as $key)
                                        <option value="{{$key->state}}" @if(@$vendorData->company_data->province == $key->state) selected @elseif(old('province') == $key->state) selected @endif>{{$key->state}}</option>
                                    @endforeach
                                </select>
                                 @if($errors->has('province'))
                                    <span class="error-text"><strong>{{ $errors->first('province') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="city" placeholder="City/Town *" class="form-control" required autocomplete="off" list="region_list" onkeyup="get_city_town(this.value);" onclick="get_city_town(this.value,true);" value="@if(@$vendorData->company_data->city){{@$vendorData->company_data->city}}@else{{old('city')}}@endif">
                                <datalist id="region_list"></datalist>
                                 @if($errors->has('city'))
                                    <span class="error-text"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="postal_code" placeholder="Postal Code *" class="form-control" required value="@if(@$vendorData->company_data->postal_code){{@$vendorData->company_data->postal_code}}@else{{old('postal_code')}}@endif">
                                 @if($errors->has('postal_code'))
                                    <span class="error-text"><strong>{{ $errors->first('postal_code') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" id="address" placeholder="Address *" class="form-control" required onload="geolocate()" value="@if(@$vendorData->company_data->address){{@$vendorData->company_data->address}}@else{{old('address')}}@endif">
                                 @if($errors->has('address'))
                                    <span class="error-text"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="vendor-notice">
                            <p>Enter your business address so that users can see your location. Note that search filters and map features are based on this information.</p>
                        </div>
                    </div>
                </div>
            </div><!-- Business Information -->
            <div class="login-info-row">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <div class="form-group">
                                <input type="text" name="business_name" placeholder="Name of your business *" class="form-control" value="@if(@$vendorData->company_data->business_name){{@$vendorData->company_data->business_name}}@else{{old('business_name')}}@endif">
                                @if($errors->has('business_name'))
                                    <span class="error-text"><strong>{{ $errors->first('business_name') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                               <textarea name="business_detail" cols="30" rows="10" class="form-control" placeholder="Describe your business and services">@if(@$vendorData->company_data->business_detail){{@$vendorData->company_data->business_detail}}@else{{old('business_detail')}}@endif</textarea>
                            </div>
                            <!-- <div class="form-group">
                                <input type="hidden" name="address_verify" id="address_verify" value="{{old('address_verify')}}">
                                <input type="text" id="business_address" name="business_address" placeholder="Address *" class="form-control" onload="geolocate()" value="@if(@$vendorData->company_data->business_address){{@$vendorData->company_data->business_address}}@else{{old('business_address')}}@endif">
                                @if($errors->has('business_address'))
                                    <span class="error-text"><strong>{{ $errors->first('business_address') }}</strong></span>
                                @endif
                                <span class="error-text address-verify-error" style="display: @if($errors->has('address_verify')) block; @else none; @endif"><strong>Invalid Address</strong></span>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="vendor-notice">
                            <p>Add a detailed description of all the services and products that your company provides. This information will be useful to potential clients.</p>
                            <p>Our Content Team may edit your text to ensure quality and search engine optimization. Please don’t add contact information such as e-mail, phone number, website, address, etc. in this section</p>
                            <!-- <p><a href="wedding-venues-detail.html">View an example of a Storefront</a></p> -->
                        </div>
                    </div>
                </div>
                <h3>More business info</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                                <label>Parking</label>
                            <div class="form-group">
                                <label class="container-ul">
                                    Free
                                    <input type="checkbox" value="1" name="free_parking" @if(old('free_parking')) checked @endif class="parking">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-ul">
                                     Paid Parking
                                     <input type="checkbox" value="1" name="paid_parking" @if(old('paid_parking')) checked @endif class="parking">
                                     <span class="checkmark"></span>
                                </label>
                                <label class="container-ul">
                                     Indoor Parking
                                     <input type="checkbox" value="1" @if(old('indoor_parking')) checked @endif name="indoor_parking" class="parking">
                                     <span class="checkmark"></span>
                                </label>
                                <label class="container-ul">
                                     No Parking
                                    <input type="checkbox" value="1" @if(old('no_parking')) checked @endif name="no_parking" class="no-parking parking">
                                    <span class="checkmark"></span>
                                 </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <img src="{{url('public/images/signs/parking.jpg')}}" id="parking_img" style="width: 20%;" class="img-responsive">
                      <img src="{{url('public/images/signs/no-parking.jpg')}}" id="no_parking_img" style="width: 20%;" class="img-responsive">
                    </div>
                </div>
                <div class="row" style="border-top: 1px dotted #ddd;padding-top: 8px;">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="container-ul">
                                     Access To Wheelchair
                                    <input type="checkbox" onclick="image_display('wheelchair_img',this.checked)" value="1" @if(old('wheelchair')) checked @endif name="wheelchair">
                                    <span class="checkmark"></span>
                                 </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <img src="{{url('public/images/signs/wheel-chair.png')}}" id="wheelchair_img" style="width: 8%;" class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <label>Payment Options</label>
                            <div class="form-group">
                                <label class="container-ul">
                                    Motor Vehicle Accident Insurance
                                    <input type="checkbox" value="1" @if(old('motor_vehicle')) checked @endif name="motor_vehicle"> 
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-ul">
                                     Health Benefit Plan
                                    <input type="checkbox" value="1" @if(old('health_benefit')) checked @endif name="health_benefit">
                                    <span class="checkmark"></span>
                                 </label>
                                <label class="container-ul">
                                     Government Insurance
                                    <input type="checkbox" value="1" name="gov_insurance" @if(old('gov_insurance')) checked @endif>
                                    <span class="checkmark"></span>
                                 </label>
                                <label class="container-ul">
                                    Self Pay (Cash/Debit/Credit)
                                    <input type="checkbox" value="1" name="self_pay" @if(old('self_pay')) checked @endif> 
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-ul">
                                     Personal Cheque accepted
                                    <input type="checkbox" value="1" @if(old('personal_cheque')) checked @endif name="personal_cheque">
                                    <span class="checkmark"></span>
                                 </label>
                                <label class="container-ul">
                                     Financing Available - Differed payment
                                    <input type="checkbox" value="1" @if(old('finance_available')) checked @endif name="finance_available">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-col">
                            <label>Social Media</label>
                            @foreach($socialMedia as $social)
                            <div class="form-group">
                                <!-- <label>{{$social->name}}</label> -->
                              <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="{{$social->icon}}"></i>
                                </span>
                                <input type="text" value="{{old($social->slug)}}" class="form-control" placeholder="{{$social->name}}" name="{{$social->slug}}">
                              </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label>Business Hours</label>
                        <div class="form-col">
                            <div class="row business-hours-container hidden-xs">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <label>Day</label>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <label>Open</label>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <label>Close</label>
                                </div>
                            </div>
                            <link rel="stylesheet" type="text/css" href="{{url('public/timepicker/bootstrap-clockpicker.min.css')}}">
                            <script type="text/javascript" src="{{url('public/timepicker/bootstrap-clockpicker.min.js')}}"></script>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Sunday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('sunday_open')}}" name="sunday_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" value="{{old('sunday_close')}}" class="form-control" name="sunday_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Monday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('monday_open')}}" name="monday_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('monday_close')}}" name="monday_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Tuesday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('tue_open')}}" name="tue_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('tue_close')}}" name="tue_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Wednesday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('wed_open')}}" name="wed_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('wed_close')}}" name="wed_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Thursday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('thu_open')}}" name="thu_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('thu_close')}}" name="thu_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Friday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('fri_open')}}" name="fri_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('fri_close')}}" name="fri_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row business-hours-container">
                                <div class="col-md-4 col-sm-4">
                                    <label>Saturday</label>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" value="{{old('sat_open')}}" class="form-control" name="sat_open" placeholder="Open time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" value="{{old('sat_close')}}" class="form-control" name="sat_close" placeholder="Close time" autocomplete="off">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label></label>
                        <div class="form-group">
                            <textarea placeholder="Special Message for Holidays / Special Closing" class="form-control" rows="8" name="special_message">{{old('special_message')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label>Language</label>
                        <!-- <div class="form-group">
                          <label class="container-ul">
                            Language Spoken
                            <input type="checkbox" value="1" @if(old('language_spoken')) checked @endif name="language_spoken"> 
                            <span class="checkmark"></span>
                          </label>
                        </div> -->
                        <div class="form-group" style="border:1px dotted #ddd;padding: 1px;">
                            <!-- <select class="form-control" name="language">
                                <option value="English" @if(old('language')=='English') selected @endif>English</option>
                                <option value="French" @if(old('language')=='French') selected @endif>French</option>
                                <option value="Spanish" @if(old('language')=='Spanish') selected @endif>Spanish</option>
                            </select> -->
                            <!-- <label>Languages</label> -->
                            @foreach($spokenLanguages as $lang)
                            <label class="container-ul">
                                {{$lang}}
                                <input type="checkbox" value="{{$lang}}" @if(is_array(old('languages')) && in_array($lang,old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            @endforeach
                            <!-- <label class="container-ul">
                                French
                                <input type="checkbox" value="French" @if(is_array(old('languages')) && in_array('French',old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-ul">
                                Spanish
                                <input type="checkbox" value="Spanish" @if(is_array(old('languages')) && in_array('Spanish',old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-ul">
                                Hindi
                                <input type="checkbox" value="Hindi" @if(is_array(old('languages')) && in_array('Hindi',old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-ul">
                                Punjabi
                                <input type="checkbox" value="Punjabi" @if(is_array(old('languages')) && in_array('Punjabi',old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-ul">
                                Urudu
                                <input type="checkbox" value="Punjabi" @if(is_array(old('languages')) && in_array('Punjabi',old('languages'))) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label> -->
                        </div>
                        <div class="form-group">
                            <label class="container-ul">
                                Sign Language
                                <input type="checkbox" onclick="image_display('sign_lang_img',this.checked)" value="1" @if(old('sign_language')) checked @endif name="sign_language"> 
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="container-ul">
                                 LGBTQ.
                                <p>A place where human rights are respected and where LGBTQ people are welcomed and supported.</p>
                                <input value="1" onclick="image_display('lgbtq_img',this.checked)" type="checkbox" @if(old('lgbtq')) checked @endif name="lgbtq">
                                <span class="checkmark"></span>
                             </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <img src="{{url('public/images/signs/sign-language.png')}}" id="sign_lang_img" style="width: 9%;position: absolute;bottom: 104%;" class="img-responsive">
                        <img src="{{url('public/images/signs/LGBTQ.png')}}" id="lgbtq_img" style="width: 8%;" class="img-responsive">
                        <!-- <div class="vendor-notice">
                            <p>A place where human rights are respected and where LGBTQ people are welcomed and supported.</p>
                        </div> -->
                    </div>
                </div>
            </div><!-- Business Information -->
            <div class="login-info-row">
                <h3>Your Category</h3>
                @if($errors->has('category'))
                    <span class="error-text"><strong>{{ $errors->first('category') }}</strong></span>
                @endif
                <div class="row">
                    @if($errors->has('category'))
                        <!-- <span class="error-text"><strong>{{ $errors->first('category') }}</strong></span> -->
                    @endif
                    @if(isset($categories) && !empty($categories))
                        @foreach($categories as $cat)
                            @if($cat['id'] != 39)
                            <div class="col-md-3 col-sm-3">
                                <div class="wedd-cate-col clearfix">
                                    <h4>{{$cat['title']}}</h4>
                                    <ul class="choose-cate">
                                        @if(isset($cat['child']) && !empty($cat['child']))
                                            @foreach($cat['child'] as $catval)
                                            <li>
                                                <input type="checkbox" id="{{str_slug($catval['title'])}}" name="category[]" value="{{$catval['id']}}" @if(is_array(old('category')) && in_array($catval['id'] , old('category'))) checked @endif>
                                                <label for="{{str_slug($catval['title'])}}">{{$catval['title']}}</label>
                                                <div class="check"></div>
                                            </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div><!-- Wedding Category Col -->
                            @endif
                        @endforeach
                    @endif
                    <div class="col-sm-12 next-row text-center">
                        <p>By clicking "Next" you are agreeing to our <a href="#">legal terms</a>.</p>
                        <button type="submit" class="btn btn-lg btn-next submit-form-register">Next</button>
                    </div>
                </div>
            </div><!-- Business Information -->
        </form>
    </div>
</section><!-- Vendor Step Wrapper -->
@include('includes.footer')
<script>
  // $('.submit-form-register').attr('disabled',true);
  $('#business_address').on('change click',function(){
    /*$.ajax({
      url:"{{url('address_verify')}}",
      type:"POST",
      data:{_token:'{{csrf_token()}}',address:$(this).val()},
      dataType:'JSON',
      success:function(response){
        // alert(JSON.stringify(response));
        if(response.status){
          $('#address_verify').val('Verified');
          $('.address-verify-error').css('display','none');
          // $('.submit-form-register').attr('disabled',false);
        }
        else{
          $('#address_verify').val();
          $('.address-verify-error').css('display','block');
          // $('.submit-form-register').attr('disabled',true);
        }
      },
      error:function(data){
        // alert(JSON.stringify(data));
      }
    });*/
  });
  $(document).on('focus click tap', 'input', function() {
      // $(this).attr("autocomplete", 'new-password');
  });
function get_city_town(vals,click) {
    var province = $('#province').val();
    if(province != '' && vals != '') {
        $.ajax({
            url: "{{url('search-citytown')}}/"+province+'/'+vals,
            type: "GET",
            data: '',
            success: function(response) {
              $("#region_list").prop('display','block');
                $("#region_list").html(response);
                if(click != undefined && click){
                  // alert(click)
                  $("#region_list").css('display','none');
                }
            }
        });
    } else {
        if(province == '') {
            alert('Please select province first !')
        }
    }
}
$('body,html').on('click', '.no-parking', function(event) {
    var noPark = $('.no-parking').is(":checked");
    if(noPark){
      $('input[class="parking"]').prop({
          checked: false
      });
      image_display('parking_img',false);
    }
    image_display('no_parking_img',noPark);
    $('.no-parking').prop({
        checked: noPark
    });
});
$('body,html').on('click', 'input[class="parking"]', function(event) {
    if(!$(this).hasClass('no-parking')){
        $('.no-parking').prop({
            checked: false
        });
        var status = false;
        $('input[class="parking"]:checkbox:checked').each(function(index){
          status = true;
          return true;
        });
        image_display('no_parking_img',false);
        image_display('parking_img',status);
    }else{
        image_display('no_parking_img',true);
        image_display('parking_img',false);
    }
});
$('.clockpicker').clockpicker({donetext:'Ok',autoclose:true});
$('body,html').on('click', '.region_list', function(event) {
  $("#region_list").css('display','none');
});

function image_display(image,status) {
  $('#'+image).css('display',status?'block':'none');
}
image_display('lgbtq_img'{{old('lgbtq')==''?'':','.old('lgbtq')}});
image_display('sign_lang_img'{{old('sign_language')==''?'':','.old('sign_language')}});
image_display('parking_img'{{old('free_parking') == '' && old('paid_parking') == '' && old('indoor_parking') == '' ? '' : ',true'}});
image_display('no_parking_img'{{old('no_parking')==''?'':','.old('no_parking')}});
image_display('wheelchair_img'{{old('wheelchair')==''?'':','.old('wheelchair')}})
</script>
<script type="text/javascript">
  var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('business_address'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete2 = new google.maps.places.Autocomplete(
      document.getElementById('address'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete2.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete2.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY_NEW')}}&libraries=places&callback=initAutocomplete" async defer></script>
@endsection