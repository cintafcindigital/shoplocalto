@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<link rel="stylesheet" href="{{url('public/css/select2.min.css')}}" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
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
.adminBox > h3 {
	border-bottom: 1px dotted #ddd;
	margin-bottom: 5px;
}
.clockpicker > input{
	border:none !important;
}
</style>
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
   @include('vendor.tools_nav')
   	 <div class="wrapper">
	   <div class="pure-g">
	      <!-- Left navigation -->
	     	@include('vendor.nav_links')
	      <!-- end left navigation -->
	      <div class="pure-u-5-7">
	         <h1 class="adminTitle">Edit Business Information</h1>
	         @if(session()->has('success'))
              <div class="app-success-box alert alert-success">
                {{session()->get('success')}}
              </div>
            @endif
            @if(session()->has('error'))
              <div class="app-danger-box alert alert-danger">
               {{session()->get('error')}}
              </div>
            @endif

           
	         <div class="adminAlert adminAlert--flex">
	            <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-pencilNote"></i>
	            <div>
	               <p class="adminAlert__title alert_text">Your Profile page features information about your health services to attract and convert our audience of potential clients and patients.</p>
	               <p>It is very important that all the information on your Profile Page and your contact info in updated and accurate.</p>
	            </div>
	         </div>
	         <form class="pure-form mb20" name="frm_business_info" action="{{url('storefront')}}" method="post" >
	         	 {{csrf_field()}}
	            <input type="hidden" name="Nombre" value="Wedding Blossoms">
	            <h3 class="adminSubtitle store_title">Describe your business and services</h3>
	            <div class="adminBox">
	               <p class="mb20">
	                  Share unique, descriptive information about your business in order to convert clients and patients and improve your ranking across top search engines. Please do not include any contact information in this section.<br><a class="color-grey underline block" href="{{url('vendor/read-between-the-wines-podcast-4')}}" target="_blank">
	                  View an example of a Profile</a>
	               </p>
	                <textarea class="description" id="description" name="description">{{ old('description',$data['vendor']->business_description??'') }}</textarea>
	            </div>
	            <h3 class="adminSubtitle store_title">Contact Information</h3>
	            <p class="adminAlert adminAlert--info alert_info_wrp">Lead notifications and updates from My Health Squad will be sent to this email address.</p>
	            <div class="pure-g">
	               <div class="pure-u-1">
	                  <div class="adminBox">
	                      <div class="mb15">
	                        <label class="adminFormLabel">Username</label>
	                        <input class="adminFormInput adminFormInput--limited" name="uname" value="{{ old('uname',$data['vendor']->username??'') }}" maxlength="250" type="text" readonly>
	                        
	                     </div>
	                     <div class="mb15">
	                        <label class="adminFormLabel">Contact Person <span class="adminFormLabel__required">*</span></label>
	                        <input class="adminFormInput adminFormInput--limited" name="contact_person" value="{{ old('contact_person',$data['vendor']->contact_person??'') }}" maxlength="250" type="text">
	                        @if($errors->has('contact_person'))
                                <span class="error">{{$errors->first('contact_person')}}</span>
                             @endif
	                     </div>
	                     <div class="mb15">
	                        <label class="adminFormLabel">Email <span class="adminFormLabel__required">*</span></label>
	                        <input class="adminFormInput adminFormInput--limited" name="email" value="{{ old('email',$data['vendor']->email??'') }}" maxlength="150" type="text">
	                         @if($errors->has('email'))
                                <span class="error">{{$errors->first('email')}}</span>
                             @endif 
                             <input type="hidden" name="email1" value="{{ old('email1',$data['vendor']->email??'') }}">
	                     </div>
	                     <div class="mb15">
	                        <label class="adminFormLabel">Phone number <span class="adminFormLabel__required">*</span></label>
	                        <input class="adminFormInput adminFormInput--limited" name="telephone" data-prefix="+1" value="{{ old('telephone',$data['vendor']->telephone??'') }}" maxlength="40" type="tel">
	                        @if($errors->has('telephone'))
                                <span class="error">{{$errors->first('telephone')}}</span>
                             @endif
	                     </div>
	                     <div class="mb15">
	                        <label class="adminFormLabel">Mobile number</label>
	                        <input class="adminFormInput adminFormInput--limited" name="mobile" value="{{ old('mobile',$data['vendor']->mobile??'') }}" maxlength="20" type="tel">
	                        @if($errors->has('mobile'))
                                <span class="error">{{$errors->first('mobile')}}</span>
                             @endif
	                     </div>
	                     <div class="mb15" hidden>
	                        <label class="adminFormLabel">Fax</label>
	                        <input class="adminFormInput adminFormInput--limited" name="fax" value="{{ old('fax',$data['vendor']->fax??'') }}" maxlength="20" type="tel">
	                     </div>
	                     <div class="mb15">
	                        <label class="adminFormLabel">Website</label>
	                        <input class="adminFormInput adminFormInput--limited " name="website" value="{{ old('website',$data['vendor']->website??'') }}" maxlength="150" type="text">
	                     </div>
	                  </div>
		            <h3 class="adminSubtitle store_title">More Business Info</h3>
	                  <div class="adminBox">
	                  	<h3>Parking</h3>
	                  	<div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Free Parking
	                                <input type="checkbox" value="1" name="free_parking" @if(old('free_parking') != '' || (isset($data['business_info']->free_parking) && $data['business_info']->free_parking == 1)) checked @endif class="parking">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('free_parking'))
	                                <span class="error">{{$errors->first('free_parking')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Paid Parking
	                                <input type="checkbox" value="1" name="paid_parking" @if(old('paid_parking') != '' || (isset($data['business_info']->paid_parking) && $data['business_info']->paid_parking == 1)) checked @endif class="parking">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('paid_parking'))
	                                <span class="error">{{$errors->first('paid_parking')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Indoor Parking
	                                <input type="checkbox" value="1" name="indoor_parking" @if(old('indoor_parking') != '' || (isset($data['business_info']->indoor_parking) && $data['business_info']->indoor_parking == 1)) checked @endif class="parking">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('indoor_parking'))
	                                <span class="error">{{$errors->first('indoor_parking')}}</span>
	                             @endif
                            </div>
                            <div class="col-sm-6">
			                    <img src="{{url('public/images/signs/parking.jpg')}}" id="parking_img" style="width: 12%;float: right;" class="img-responsive pull-right">
                            </div>
	                     </div>
	                     <div class="mb15 row">
	                     	<div class="col-sm-6">
		                        <label class="container-ul">
	                                No Parking
	                                <input type="checkbox" value="1" name="no_parking" @if(old('no_parking') != '' || (isset($data['business_info']->no_parking) && $data['business_info']->no_parking == 1)) checked @endif class="parking no-parking">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('no_parking'))
	                                <span class="error">{{$errors->first('no_parking')}}</span>
	                             @endif
	                     	</div>
	                     	<div class="col-sm-6">
			                    <img src="{{url('public/images/signs/no-parking.jpg')}}" id="no_parking_img" style="width: 12%;float: right;" class="img-responsive pull-right">
	                     	</div>
	                     </div>
	                     <h3></h3>
	                     <div class="mb15 row">
	                     	<div class="col-sm-6">
		                        <label class="container-ul">
	                                Access To Wheelchair
	                                <input type="checkbox" value="1" name="wheelchair" @if(old('wheelchair') != '' || (isset($data['business_info']->wheel_chair) && $data['business_info']->wheel_chair == 1)) checked @endif onclick="image_display('wheelchair_img',this.checked)">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('wheelchair'))
	                                <span class="error">{{$errors->first('wheelchair')}}</span>
	                             @endif
	                         </div>
	                     	<div class="col-sm-6">
			                    <img src="{{url('public/images/signs/wheel-chair.png')}}" id="wheelchair_img" style="width: 12%;float: right;" class="img-responsive pull-right">
			                </div>
	                     </div>
	                     <h3>Payment Options</h3>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Motor Vehicle Accident Insurance
	                                <input type="checkbox" value="1" name="motor_vehicle" @if(old('motor_vehicle') != '' || (isset($data['business_info']->motor_vehicle) && $data['business_info']->motor_vehicle == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('motor_vehicle'))
	                                <span class="error">{{$errors->first('motor_vehicle')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Health Benefit Plan
	                                <input type="checkbox" value="1" name="health_benefit" @if(old('health_benefit') != '' || (isset($data['business_info']->health_benefit) && $data['business_info']->health_benefit == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('health_benefit'))
	                                <span class="error">{{$errors->first('health_benefit')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
	                        <label class="container-ul">
	                                Government Insurance
	                                <input type="checkbox" value="1" name="gov_insurance" @if(old('gov_insurance') != '' || (isset($data['business_info']->gov_insurance) && $data['business_info']->gov_insurance == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('gov_insurance'))
	                                <span class="error">{{$errors->first('gov_insurance')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Self Pay (Cash/Debit/Credit)
	                                <input type="checkbox" value="1" name="self_pay" @if(old('self_pay') != '' || (isset($data['business_info']->self_pay) && $data['business_info']->self_pay == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('self_pay'))
	                                <span class="error">{{$errors->first('self_pay')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Personal Cheque accepted
	                                <input type="checkbox" value="1" name="personal_cheque" @if(old('personal_cheque') != '' || (isset($data['business_info']->personal_cheque) && $data['business_info']->personal_cheque == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('personal_cheque'))
	                                <span class="error">{{$errors->first('personal_cheque')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <div class="mb15 row">
                            <div class="col-sm-6">
		                        <label class="container-ul">
	                                Financing Available - Differed payment
	                                <input type="checkbox" value="1" name="finance_available" @if(old('finance_available') != '' || (isset($data['business_info']->finance_available) && $data['business_info']->finance_available == 1)) checked @endif>
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('finance_available'))
	                                <span class="error">{{$errors->first('finance_available')}}</span>
	                             @endif
	                         </div>
                            <div class="col-sm-6"></div>
	                     </div>
	                     <?php /*<h3>Social Media</h3>
	                     <div class="mb15">
	                     	@foreach($data['socials'] as $social)
	                        <div class="input-group adminFormInput adminFormInput--limited">
	                            <span class="input-group-addon">
	                                <i class="{{$social->icon}}"></i>
	                            </span>
	                            <input style="border:none;" type="text" class="form-control" placeholder="{{$social->name}}" value="{{old($social->slug) != '' ? old($social->slug) : $social->link}}" name="{{$social->slug}}">
                          	</div>
	                        @if($errors->has($social->slug))
                                <span class="error">{{$errors->first($social->slug)}}</span>
                            @endif
                            @endforeach
	                     </div>*/ ?>
	                    <label class="container-ul">
                            <h3>Business Hours</h3>
                            <input type="checkbox" value="1" onclick="businessHours(this.checked)" name="is_business_hours" @if(old('username',@$data['vendor']->username) != '' && old('is_business_hours',@$data['vendor']->is_business_hours) == '1') checked @elseif(old('username',@$data['vendor']->username) == '') checked @endif>
                            <span class="checkmark"></span>
                        </label>
                        <div class="mb15 business-hours">
                            <div class="row business-hours-container">
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
                                        <input type="text" class="form-control" value="{{old('sunday_open') !=''? old('sunday_open') : (isset($data['business_hours']) && array_search('SUN',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('SUN',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="sunday_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" value="{{old('sunday_close') !=''? old('sunday_close') : (isset($data['business_hours']) && array_search('SUN',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('SUN',array_column($data['business_hours'],'day'))]['close'] : '')}}" class="form-control" name="sunday_close">
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
                                        <input type="text" class="form-control" value="{{old('monday_open') !=''? old('monday_open') : (isset($data['business_hours']) && array_search('MON',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('MON',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="monday_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('monday_close') !=''? old('monday_close') : (isset($data['business_hours']) && array_search('MON',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('MON',array_column($data['business_hours'],'day'))]['close'] : '')}}" name="monday_close">
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
                                        <input type="text" class="form-control" value="{{old('tue_open') !=''? old('tue_open') : (isset($data['business_hours']) && array_search('TUE',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('TUE',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="tue_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('tue_close') !=''? old('tue_close') : (isset($data['business_hours']) && array_search('TUE',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('TUE',array_column($data['business_hours'],'day'))]['close'] : '')}}" name="tue_close">
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
                                        <input type="text" class="form-control" value="{{old('wed_open') !=''? old('wed_open') : (isset($data['business_hours']) && array_search('WED',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('WED',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="wed_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('wed_close') !=''? old('wed_close') : (isset($data['business_hours']) && array_search('WED',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('WED',array_column($data['business_hours'],'day'))]['close'] : '')}}" name="wed_close">
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
                                        <input type="text" class="form-control" value="{{old('thu_open') !=''? old('thu_open') : (isset($data['business_hours']) && array_search('THU',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('THU',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="thu_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('thu_close') !=''? old('thu_close') : (isset($data['business_hours']) && array_search('THU',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('THU',array_column($data['business_hours'],'day'))]['close'] : '')}}" name="thu_close">
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
                                        <input type="text" class="form-control" value="{{old('fri_open')!=''? old('fri_open') : (isset($data['business_hours']) && array_search('FRI',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('FRI',array_column($data['business_hours'],'day'))]['open'] : '')}}" name="fri_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" value="{{old('fri_close') !=''? old('fri_close') : (isset($data['business_hours']) && array_search('FRI',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('FRI',array_column($data['business_hours'],'day'))]['close'] : '')}}" name="fri_close">
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
                                        <input type="text" value="{{old('sat_open')!=''? old('sat_open') : (isset($data['business_hours']) && array_search('SAT',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('SAT',array_column($data['business_hours'],'day'))]['open'] : '')}}" class="form-control" name="sat_open">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="input-group clockpicker">
                                        <input type="text" value="{{old('sat_close')!=''? old('sat_close') : (isset($data['business_hours']) && array_search('SAT',array_column($data['business_hours'],'day'))? $data['business_hours'][array_search('SAT',array_column($data['business_hours'],'day'))]['close'] : '')}}" class="form-control" name="sat_close">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb15 business-hours">
                        	<label class="adminFormLabel">Special Message for Holidays / Special Closing</label>
                        	<textarea rows="8" placeholder="Special Message for Holidays / Special Closing" name="special_message" class="adminFormInput adminFormInput--limited">{{old('special_message') != ''?old('special_message'):(isset($data['business_info']->holiday_special)?$data['business_info']->holiday_special:'')}}</textarea>
                        </div>
                        <h3>Language</h3>
                        <!-- <div class="mb15">
	                        <label class="container-ul">
                                Language Spoken
                                <input type="checkbox" value="1" name="language_spoken" @if(old('language_spoken') != '' || (isset($data['business_info']->language_spoke) && $data['business_info']->language_spoke == 1)) checked @endif>
                                <span class="checkmark"></span>
                            </label>
	                        @if($errors->has('language_spoken'))
                                <span class="error">{{$errors->first('language_spoken')}}</span>
                             @endif
	                    </div> -->
	                    <div class="mb15" style="border:1px dotted #ddd;padding: 1px;">
	                        <!-- <select class="adminFormInput adminFormInput--limited" name="language">
                                <option value="English" @if(old('language')=='English' || (isset($data['business_info']->language) && $data['business_info']->language == 'English')) selected @endif>English</option>
                                <option value="French" @if(old('language')=='French' || (isset($data['business_info']->language) && $data['business_info']->language == 'French')) selected @endif>French</option>
                                <option value="Spanish" @if(old('language')=='Spanish' || (isset($data['business_info']->language) && $data['business_info']->language == 'Spanish')) selected @endif>Spanish</option>
                            </select> -->
                            @php
                            	if(isset($data['business_info']->language))
	                            	$storedLanguages = explode(',',$data['business_info']->language);
	                            else
	                            	$storedLanguages = [];
                            @endphp
                            <!--@foreach($spokenLanguages as $lang)
                            <label class="container-ul">
                                {{$lang}}
                                <input type="checkbox" value="{{$lang}}" @if((is_array(old('languages')) && in_array($lang,old('languages'))) || in_array($lang,$storedLanguages)) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            @endforeach-->
                            <select class="form-control languages" name="languages[]" multiple="multiple">
                            </select>
                            <!-- <label class="container-ul">
                                French
                                <input type="checkbox" value="French" @if((is_array(old('languages')) && in_array('French',old('languages'))) || in_array('French',$storedLanguages)) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-ul">
                                Spanish
                                <input type="checkbox" value="Spanish" @if((is_array(old('languages')) && in_array('Spanish',old('languages'))) || in_array('Spanish',$storedLanguages)) checked @endif name="languages[]"> 
                                <span class="checkmark"></span>
                            </label> -->
	                        @if($errors->has('language'))
                                <span class="error">{{$errors->first('language')}}</span>
                             @endif
	                    </div>
	                    <div class="mb15 row">
	                    	<div class="col-sm-6">
		                        <label class="container-ul">
	                                Sign Language
	                                <input type="checkbox" onclick="image_display('sign_lang_img',this.checked)" value="1" @if(old('sign_language') != '' || (isset($data['business_info']->sign_language) && $data['business_info']->sign_language ==1)) checked @endif name="sign_language">
	                                <span class="checkmark"></span>
	                            </label>
		                        @if($errors->has('language_spoken'))
	                                <span class="error">{{$errors->first('language_spoken')}}</span>
	                             @endif
	                    	</div>
	                    	<div class="col-sm-6">
		                        <img src="{{url('public/images/signs/sign-language.png')}}" id="sign_lang_img" style="width: 12%;float: right;" class="img-responsive pull-right">
		                    </div>
                             <span>
                             </span>
	                    </div>
	                    <div class="mb15 row">
	                    	<div class="col-sm-12">
		                        <label class="container-ul">
	                                LGBTQ.
	                                <!--<p>This business is a place where human rights are respected and where LGBTQ people are welcomed and supported without any discrimation or prejudice.</p>-->
	                                <input value="1" onclick="image_display('lgbtq_img',this.checked)" type="checkbox" @if(old('lgbtq') != '' || (isset($data['business_info']->lgbtq) && $data['business_info']->lgbtq ==1)) checked @endif name="lgbtq">
	                                <span class="checkmark"></span>
	                            </label>
	                            <p>
	                                This is not mandatory, but My Health Squad strongly believe in diversity, equality & inclusion and if you want to show that you agree with this approach we strongly encourage you to click this box to post this message to the LGBTQ community and the world that your business is a place where human rights are respected and where LGBTQ people are welcomed and supported without any discrimation or prejudice.
	                            </p>
	                            <p>
	                                By doing this, a small rainbow flag will show up at the bottom of your profile page as well as this message: “<strong>This business is a place where human rights are respected and where LGBTQ people are welcomed and supported without any discrimation or prejudice</strong>”.
	                            </p>
		                        @if($errors->has('language_spoken'))
	                                <span class="error">{{$errors->first('language_spoken')}}</span>
	                             @endif
	                         </div>
	                    	<div class="col-sm-6">
		                        <img src="{{url('public/images/signs/LGBTQ.png')}}" id="lgbtq_img" style="width: 12%;float: right;" class="img-responsive pull-right">
	                        </div>
	                    </div>
	                  </div>
	               </div>
	               <div class="pure-u-2-5">
	               </div>
	            </div>
	            <p class="small small_text color-grey mb10">By pressing "Save", you agree to My Health Squad <a class="color-grey underline" href="{{url('/user-agreement')}}" target="_blank"> User Agreement</a>.</p>
	            <input class="btnFlat btnFlat--primary save_btn" type="submit" value="Save">
	         </form>
	      </div>
   </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
   tinymce.init({
   	  branding: false,
   	  menubar:false,
      statusbar: false,
	  selector: 'textarea#description',  //Change this value according to your HTML
	  auto_focus: 'element1',
	  width: "780",
	  height: "300",
	  setup : function(editor)  {
                editor.on("change keyup", function(e){
                    //console.log('saving');
                    //tinyMCE.triggerSave(); // updates all instances
                    editor.save(); // updates this instance's textarea
                    $(editor.getElement()).trigger('change'); // for garlic to detect change
                });
      }


	});
   $(document).ready(function() {
   		setTimeout(function(){
   			$(".app-success-box").slideUp();

   		},3000);

   })
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
function image_display(image,status) {
  $('#'+image).css('display',status?'block':'none');
}
$('.clockpicker').clockpicker({donetext:'Ok',autoclose:true});
image_display('wheelchair_img'{{old('wheelchair') != '' || (isset($data['business_info']->wheel_chair) && $data['business_info']->wheel_chair == 1)?',1':''}})
image_display('sign_lang_img'{{old('sign_language') != '' || (isset($data['business_info']->sign_language) && $data['business_info']->sign_language ==1)?',1':''}})
image_display('lgbtq_img'{{old('lgbtq') != '' || (isset($data['business_info']->lgbtq) && $data['business_info']->lgbtq == 1)?',1':''}})
image_display('no_parking_img'{{old('no_parking') != '' || (isset($data['business_info']->no_parking) && $data['business_info']->no_parking == 1)?',1':''}})
image_display('parking_img'{{old('indoor_parking') != '' || old('paid_parking') != '' || old('free_parking') != '' || (isset($data['business_info']->free_parking) && $data['business_info']->free_parking == 1) || (isset($data['business_info']->paid_parking) && $data['business_info']->paid_parking == 1) || (isset($data['business_info']->indoor_parking) && $data['business_info']->indoor_parking == 1)?',1':''}})
</script>
<script src="{{url('public/js/select2.min.js')}}" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var data = [
            @php
                $languages = "";
            @endphp
            @foreach($spokenLanguages as $lang)
            @php
                if(empty(old('languages')))
                    $languages .= "{id:'$lang',text:'$lang'".(in_array($lang,$storedLanguages)?",selected:true":'')."},";
                else
                    $languages .= "{id:'$lang',text:'$lang'".(in_array($lang,(array) old('languages'))?",selected:true":'')."},";
            @endphp
            @endforeach
            @php 
                echo $languages;
            @endphp
            ];
        $('.languages').select2({data:data,placeholder: "Enter keyword to search languages and select"});
        @if(old('username',@$data['vendor']->username) != '' && old('is_business_hours',@$data['vendor']->is_business_hours) == '1')
            businessHours(true);
        @elseif(old('username',@$data['vendor']->username) == '')
            businessHours(true);
        @else
            businessHours(false);
        @endif
    });
    function businessHours(status)
    {
        $('.business-hours').css('display',status?'block':'none');
    }
</script>
</section>

@include('includes.footer')

@endsection
