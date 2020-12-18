@include('include/header');

<style type="text/css">

    .categories {

        list-style-type: none;

        color: #000;

    }

    .categories li label {

        font-size: 19px;

        font-weight: normal;

    }

    .categories ul {

        list-style-type: none;

        color: #000;

    }

    .categories ul li label {

        font-size: 17px;

        font-weight: normal;

    }

    .container-ul {

      display: block;

      position: relative;

      padding-left: 35px;

      margin-bottom: 12px;

      cursor: pointer;

      -webkit-user-select: none;

      -moz-user-select: none;

      -ms-user-select: none;

      user-select: none;

      color: #000;

    }

    .container-ul input {

      position: absolute;

      opacity: 0;

      cursor: pointer;

      height: 0;

      width: 0;

    }

    .checkmark {

      position: absolute;

      top: 0;

      left: 0;

      height: 25px;

      width: 25px;

      background-color: #eee;

    }

    .container-ul:hover input ~ .checkmark {

      background-color: #ccc;

    }

    .container-ul input:checked ~ .checkmark {

      background-color: #2c3e98;

    }

    .checkmark:after {

      content: "";

      position: absolute;

      display: none;

    }

    .container-ul input:checked ~ .checkmark:after {

      display: block;

    }

    .container-ul .checkmark:after {

        left: 9px;

        top: 2px;

        width: 8px;

        height: 17px;

        border: solid white;

        border-width: 0 3px 3px 0;

        -webkit-transform: rotate(45deg);

        -ms-transform: rotate(45deg);

        transform: rotate(45deg);

    }

    .vendors-signup-steps {

    text-align: center;

    background: #FFF;

    margin-bottom: 35px;

}

.progress-steps {

    display: inline-block;

    vertical-align: middle;

    zoom: 1;

    text-align: center;

    margin: 0 auto;

    position: relative;

    overflow: hidden;

}

.progress-steps div:first-child {

    padding: 10px 40px 10px 0;

}

.input-group-addon {

    padding: 6px 12px;

    font-size: 14px;

    font-weight: 400;

    line-height: 1;

    color: #555;

    text-align: center;

    background-color: #eee;

    border: 1px solid #ccc;

    border-radius: 4px;

}

.fa {

    display: inline-block;

    font: normal normal normal 14px/1 FontAwesome;

    font-size: inherit;

    text-rendering: auto;

    -webkit-font-smoothing: antialiased;

}

.clockpicker .input-group-addon {

    cursor: pointer;

}

.btn-lg, .btn-group-lg > .btn {

    padding: 0.5rem 1rem;

    font-size: 1.09375rem;

    line-height: 1.5;

    border-radius: 6px;

}

.vendor-notice {

    background: #e3ffff;

    padding: 20px;

    border: 1px solid #cfecec;

    width: 65%;

    margin: 0 auto;

}

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

.input-group-addon, .input-group-btn {

    width: 1%;

    white-space: nowrap;

    vertical-align: middle;

}

.choose-cate {

    margin: 0;

    padding: 12px 0 0 0;

}

.login-info-row {

    border-bottom: 1px dotted #ccc;

    padding-bottom: 30px;

    margin-bottom: 30px;

}

.choose-cate li {

    color: #888181;

    display: block;

    position: relative;

    float: left;

    width: 100%;

    margin: 5px 0;

}

.business-hours-container, .col-sm-4, .col-md-4 {

    padding: 3px;

}

.business-hours-container {

    border-bottom: 1px dotted #ddd;

    padding-bottom: 5px;

    padding-top: 5px;

}

.glyphicon {

    position: relative;

    top: 1px;

    display: inline-block;

    font-family: 'Glyphicons Halflings';

    font-style: normal;

    font-weight: 400;

    line-height: 1;

    -webkit-font-smoothing: antialiased;

    -moz-osx-font-smoothing: grayscale;

}

.choose-cate li:hover label {

    color: #980c2b;

}

.error-text {

    color:red;

}





</style>



<div class="pcoded-main-container" style="

    background-color: #fff;

">

    <div class="pcoded-content container">

        <div class="row">

            <div class="col-sm-12">

<section class="vendor-step-wrap">

   <div class="container">

      

                <div class="row">

                    <div class="col-sm-12 mb-4">

                        <h1 class="d-inline-block font-weight-normal mb-0">Edit Vendor Profile</h1>

                    </div>

                </div>

                @if(session()->has('success'))

                    <div class="alert alert-info alert-dismissible fade show">{{ session()->get('success') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                @endif

                @if(count($errors) > 0)

                <div class="alert alert-danger alert-dismissible fade show">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>@foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                </div>

                @endif

        <form action="{{url('/admin/update-vendor/')}}/{{$vendorData->vendor_id}}" class="vendor-form-wrap form-submit-vendor" method="post" enctype="multipart/form-data">

           {{ csrf_field() }}

            <div class="login-info-row">

                <h3>Login Information</h3>

                <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <div class="login-info-row">

                            <div class="form-col">

                                <div class="form-group">

                                    <input type="text" name="username" placeholder="Username *" class="form-control" value="{{old('username',@$vendorData->username)}}" required readonly>

                                    @if($errors->has('username'))

                                        <span class="error-text"><strong>{{ $errors->first('username') }}</strong></span>

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="password" name="password" placeholder="Password" class="form-control" >

                                    @if($errors->has('password'))

                                        <span class="error-text"><strong>{{ $errors->first('password') }}</strong></span>

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="hidden" name="vendor_id" value="{{@$vendorData->vendor_id}}">

                                    <input type="hidden" name="company_id" value="{{@$vendorData->company_data->id}}">

                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" >

                                </div>

                            </div>

                        </div>

                        <!-- Login Information -->

                        <div class="login-info-row">

                            <h3>Contact information</h3>

                            <div class="form-col">

                                <div class="form-group">

                                    <input type="text" name="contact_person" placeholder="Contact person" class="form-control" value="{{old('contact_person',@$vendorData->contact_person)}}">

                                     @if($errors->has('contact_person'))

                                        <span class="error-text"><strong>{{ $errors->first('contact_person') }}</strong></span>

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="text" name="email" placeholder="E-mail *" class="form-control" required value="{{old('email',@$vendorData->email)}}">

                                     @if($errors->has('email'))

                                        <span class="error-text"><strong>{{ $errors->first('email') }}</strong></span>

                                    @endif

                                    <input type="hidden" class="form-control" name="email1" value="{{@$vendorData->email}}">

                                </div>

                                <div class="form-group">

                                    <input type="text" name="telephone" placeholder="Telephone *" class="form-control" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{old('telephone',@$vendorData->telephone)}}">

                                    @if($errors->has('telephone'))

                                        <span class="error-text"><strong>{{ $errors->first('telephone') }}</strong></span>

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="text" name="mobile" placeholder="Mobile number" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{old('mobile',@$vendorData->mobile)}}">

                                </div>

                                <div class="form-group">

                                    <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="fax" placeholder="Fax" class="form-control" value="{{old('fax',@$vendorData->fax)}}">

                                </div>

                                <div class="form-group">

                                    <input type="text" name="website" placeholder="Website" class="form-control" value="{{old('website',@$vendorData->website)}}">

                                </div>

                            </div>

                        </div><!-- Contact information -->

                        <div class="">

                            <h3>Business Information</h3>

                            <div class="form-col">

                               <div class="form-group">

                                

                                <select name="district" id="district" class="form-control" required>
                                    <option value="">-- select district --</option>

                                    @foreach($districts as $district)

                                        <option value="{{$district->id}}" @if(old('district',@$vendorData->company_data->district == $district->id)) selected @endif>{{$district->name}}</option>

                                    @endforeach

                                </select>

                                @if($errors->has('district'))

                                    <span class="error-text"><strong>{{ $errors->first('district') }}</strong></span>

                                @endif

                            </div>

                            

                            <div class="form-group">

                                <input type="text" name="location" placeholder="Location/Community *" class="form-control" required autocomplete="off" list="region_list" onkeyup="get_city_town(this.value);" onclick="get_city_town(this.value,true);" value="{{old('location',@$vendorData->company_data->location)}}">

                                <datalist id="region_list"></datalist>

                                 @if($errors->has('location'))

                                    <span class="error-text"><strong>{{ $errors->first('location') }}</strong></span>

                                @endif

                            </div>

                                <div class="form-group">

                                    <input type="text" name="postal_code" placeholder="Postal Code *" class="form-control" required value="{{old('postal_code',@$vendorData->company_data->postal_code)}}">

                                     @if($errors->has('postal_code'))

                                        <span class="error-text"><strong>{{ $errors->first('postal_code') }}</strong></span>

                                    @endif

                                </div>

                                <div class="form-group">

                                    <input type="text" name="address" id="address" placeholder="Address *" class="form-control" required onload="geolocate()" value="{{old('address',@$vendorData->company_data->address)}}">

                                     @if($errors->has('address'))

                                        <span class="error-text"><strong>{{ $errors->first('address') }}</strong></span>

                                    @endif

                                </div>

                            </div>

                        </div><!-- Business Information -->

                    </div>

                    <div class="col-md-6 col-xl-3">

                        <div class="card card-body">

                           @if($vendorData->profile)

                                <img src="{{url('/public/vendors/VENDOR_').$vendorData->vendor_id}}/{{$vendorData->profile}}" class="img-fluid" alt="Vendor Image">

                            @elseif(@$images[0]->image)

                            <img src="{{url('/public/vendors/VENDOR_').$vendorData->vendor_id}}/{{@$images[0]->image}}" class="img-fluid" alt="Vendor Image">

                            @else

                                <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid">

                            @endif

                            <h3><label>Profile Picture</label></h3>

                            <figcaption class="figure-caption text-center mt-2" style="display:inline-block;width:20px;"><i class="m-r-10 f-18 feather icon-upload"></i></figcaption>

                            <p>(Recommended size 300px x 188px)</p>

                            <!-- <input type="file" name="profile_image" style="width:218px;"> -->

                            @include('includes.image-crop-4',['name' => 'profile_image','width' => 750,'height' => 470])

                        </div>

                        <div class="card card-body">

                            @if(!empty($vendorData->featured_image))

                                <!--class="figure-img img-fluid rounded mb-3" alt="Vendor Image"-->

                                <img src="{{url('/public/vendors/VENDOR_').$vendorData->vendor_id}}/{{$vendorData->featured_image}}" class="img-fluid" alt="Vendor Image">

                            @else

                                <img src="{{url('/').'/public/storage/no-image.png'}}" alt="Vendor Image" class="img-fluid">

                            @endif

                            <br>

                            <h3><label>Featured</label></h3>

                            <figcaption class="figure-caption text-center mt-2" style="display:inline-block;width:20px;"><i class="m-r-10 f-18 feather icon-upload"></i></figcaption>

                            <p>(Recommended size 285px x 183px)</p>

                            <!-- <input type="file" name="featured_image" style="width:218px;"> -->

                            @include('includes.image-crop-4',['name' => 'featured_image','width' => 783.75,'height' => 503.25])

                        </div>

                    </div>

                </div>

            </div>

                <div class="row">

                    <div class="col-md-6 col-sm-6">

                    </div>

                    <div class="col-md-6 col-sm-6 d-none">

                         <select class="form-control" name="assign_sales">

                                <option value="">- - Assign Sales Staff - -</option>

                                @foreach($admins as $ads)

                                    @if($ads->role == 3)

                                    <option @if($ads->id == old('assign_sales',@$vendorData->assign_sales)) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                            <p></p>

                            <select class="form-control" name="assign_marketing">

                                <option value="">- - Assign Marketing Staff - -</option>

                                @foreach($admins as $ads)

                                    @if($ads->role == 4)

                                    <option @if($ads->id == old('assign_marketing',@$vendorData->assign_marketing)) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                            <p></p>

                            <select class="form-control" name="assign_customer">

                                <option value="">- - Assign Customer Service - -</option>

                                @foreach($admins as $ads)

                                    @if($ads->role == 5)

                                    <option @if($ads->id == $vendorData->assign_customer) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                            <p></p>

                            <select class="form-control" name="assign_technical">

                                <option value="">- - Assign Technical Staff - -</option>

                                @foreach($admins as $ads)

                                    @if($ads->role == 6)

                                    <option @if($ads->id == $vendorData->assign_technical) selected @endif value="{{$ads->id}}">{{$ads->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                    </div>

                    

                </div>

            <div class="login-info-row">

                <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <div class="form-col">

                            <div class="form-group">

                                <input type="text" name="business_name" placeholder="Name of your business *" class="form-control" value="{{old('business_name',@$vendorData->company_data->business_name)}}">

                                @if($errors->has('business_name'))

                                    <span class="error-text"><strong>{{ $errors->first('business_name') }}</strong></span>

                                @endif

                            </div>

                            <div class="form-group">

                               <textarea name="business_detail" cols="30" rows="10" class="form-control" placeholder="Describe your business and services">{{old('business_detail',@strip_tags(@$vendorData->business_description))}}</textarea>

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

                    

                </div>
                
                <h3>More business info</h3>

                <div class="row">
@if(isset($features))
@php

                            $n=@array_map(function($entry){

               return @$entry['feature_id'];

           }, @$vendorfeatures->toArray());                     

           @endphp
                    <div class="col-md-6 col-sm-6">

                        <div class="form-col">

                                <label>Features</label>

                            <div class="form-group">
                                @foreach($features as $feature)

                                <label class="container-ul">

                                    {{$feature->name}}

                                    <input type="checkbox" value="{{$feature->id}}" name="feature1[]" @if(is_array($n) && in_array($feature->id,$n)) checked @elseif(is_array(old('feature')) && in_array($feature->id , old('feature'))) checked @endif> 

                                    <span class="checkmark"></span>

                                </label>
                                @endforeach

                                

                            </div>

                        </div>

                    </div>
@endif
                    <!-- <div class="col-md-6 col-sm-6">

                      <img src="{{url('public/images/signs/parking.png')}}" id="parking_img" style="/*width: 20%;*/" class="img-responsive">

                      <img src="{{url('public/images/signs/paid-parking.png')}}" id="paid_parking_img" style="/*width: 20%;*/" class="img-responsive">

                      <img src="{{url('public/images/signs/no-parking.png')}}" id="no_parking_img" style="/*width: 20%;*/" class="img-responsive">

                    </div> -->

                </div>

                

                
                <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <div class="form-col">

                            <label>Social Media</label>

            

                            @foreach($socialMedia as $sm)

                            <div class="form-group">

                              <div class="input-group" style="display:block;">

                                  <div class="input-group-prepend">

                                     <span class="input-group-text">

                                        <i class="{{$sm->icon}}"></i>

                                    </span>

                                    <input type="text" value="{{old($sm->slug,@$social->where('social_media_id',$sm->id)->first()->link)}}" class="form-control" placeholder="{{$sm->name}}" name="{{$sm->slug}}">

                                  </div>

                              </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <label class="container-ul">

                            Business Hours

                            <input type="checkbox" value="1" onclick="businessHours(this.checked)" name="is_business_hours" @if(old('username',@$vendorData->username) != '' && old('is_business_hours',@$vendorData->is_business_hours) == '1') checked @elseif(old('username',@$vendorData->username) == '') checked @endif>

                            <span class="checkmark"></span>

                        </label>

                        <div class="form-col business-hours">

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

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('sunday_open',@$businessHours->where('day','SUN')->first()->open)}}" name="sunday_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" value="{{old('sunday_close',@$businessHours->where('day','SUN')->first()->close)}}" class="form-control" name="sunday_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Monday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('monday_open',@$businessHours->where('day','MON')->first()->open)}}" name="monday_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('monday_close',@$businessHours->where('day','MON')->first()->close)}}" name="monday_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Tuesday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('tue_open',@$businessHours->where('day','TUE')->first()->open)}}" name="tue_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('tue_close',@$businessHours->where('day','TUE')->first()->close)}}" name="tue_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Wednesday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('wed_open',@$businessHours->where('day','WED')->first()->open)}}" name="wed_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('wed_close',@$businessHours->where('day','WED')->first()->close)}}" name="wed_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Thursday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('thu_open',@$businessHours->where('day','THU')->first()->open)}}" name="thu_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('thu_close',@$businessHours->where('day','THU')->first()->close)}}" name="thu_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Friday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('fri_open',@$businessHours->where('day','FRI')->first()->open)}}" name="fri_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" class="form-control" value="{{old('fri_close',@$businessHours->where('day','FRI')->first()->close)}}" name="fri_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row business-hours-container">

                                <div class="col-md-4 col-sm-4">

                                    <label>Saturday</label>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" value="{{old('sat_open',@$businessHours->where('day','SAT')->first()->open)}}" class="form-control" name="sat_open" placeholder="Open time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4">

                                    <div class="input-group clockpicker">

                                        <div class="input-group-append">

                                            <input type="text" value="{{old('sat_close',@$businessHours->where('day','SAT')->first()->close)}}" class="form-control" name="sat_close" placeholder="Close time" autocomplete="off">

                                            <span class="input-group-text">

                                                <span class="fa fa-clock"></span>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                 <div class="row">

                    <div class="col-md-6 col-sm-6">
                        @if(isset($tags) && count($tags)>0)
                        @foreach($tags as $tag)
                         @php
                            $am[]=$tag->tagname;
                         @endphp
                        @endforeach    
                        @php 
                        $a=implode(',',$am);
                        @endphp
@endif
                        <label>Tags</label><span>(Please separate each tags with comma)</span>

                        

                        <div class="form-group" style="border:1px dotted #ddd;padding: 1px;">
                            <input type="text" name="tag" id="tag" value="{{@$a}}" class="form-control">
                            

                        </div>

                        

                    </div>

                </div>

                <!-- <div class="row business-hours">

                    <div class="col-md-6 col-sm-6">

                        <label></label>

                        <div class="form-group">

                            <textarea placeholder="Special Message for Holidays / Special Closing" class="form-control" rows="8" name="special_message">{{old('special_message',@$businfo->holiday_special)}}</textarea>

                        </div>

                    </div>

                </div> -->

                <!-- <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <label>Language</label>

                        

                        <div class="form-group" style="border:1px dotted #ddd;padding: 1px;">

                            @foreach($spokenLanguages as $lang)

                            <label class="container-ul">

                                {{$lang}}

                                <input type="checkbox" value="{{$lang}}" @if(@$businfo->language==$lang) checked @elseif(is_array(old('languages')) && in_array($lang,old('languages'))) checked @endif name="languages[]"> 

                                <span class="checkmark"></span>

                            </label>

                            @endforeach

                            <select class="form-control languages" name="languages[]" multiple="multiple">

                            </select>

                        </div>

                        <div class="form-group">

                            <label class="container-ul">

                                Sign Language

                                <input type="checkbox" onclick="image_display('sign_lang_img',this.checked)" value="1" @if(old('sign_language',@$businfo->sign_language) == 1) checked @endif name="sign_language">

                                <span class="checkmark"></span>

                            </label>

                        </div>

                    </div>

                </div> -->

                <!-- <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <div class="form-group">

                            <label class="container-ul">

                                 LGBTQ.

                                <p>A place where human rights are respected and where LGBTQ people are welcomed and supported.</p>

                                <input value="1" onclick="image_display('lgbtq_img',this.checked)" type="checkbox" @if(old('lgbtq',@$businfo->lgbtq) == 1) checked @endif name="lgbtq">

                                <span class="checkmark"></span>

                             </label>

                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6">

                        <img src="{{url('public/images/signs/sign-language.png')}}" id="sign_lang_img" style="/*width: 9%;*/position: absolute;bottom: 104%;" class="img-responsive">

                        <img src="{{url('public/images/signs/LGBTQ.png')}}" id="lgbtq_img" style="/*width: 8%;*/" class="img-responsive">

                    </div>

                </div> -->

            </div><!-- Business Information -->

            <div class="login-info-row">

                <h3>Your Category *</h3>

                @if($errors->has('category'))

                    <span class="error-text"><strong>{{ $errors->first('category') }}</strong></span>

                @endif

                <div class="row">

                    @if($errors->has('category'))

                       

                    @endif

                    @if(isset($categories) && !empty($categories))

                    

                     @php

                            $m=@array_map(function($entry){

               return @$entry['category_id'];

           }, @$cat->toArray());                     

           @endphp

                        @foreach($categories as $cat)

                            @if($cat['id'] != 39)

                            <div class="col-md-3 col-sm-3">

                                <div class="wedd-cate-col clearfix">

                                    <h4>{{$cat['title']}}</h4>

                                    <ul class="choose-cate">

                                        @if(isset($cat['child']) && !empty($cat['child']))

                                            @foreach($cat['child'] as $catval)

                                            <li>

                                                <input type="checkbox" id="{{str_slug($catval['title'])}}" name="category[]" value="{{$catval['id']}}" @if(is_array($m) && in_array($catval['id'],$m)) checked @elseif(is_array(old('category')) && in_array($catval['id'] , old('category'))) checked @endif>

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

                        <!--<p>By clicking "Next" you are agreeing to our <a href="#">legal terms</a>.</p>-->

                        <button type="submit" class="btn btn-lg btn-next submit-form-register" style="

    border: 2px solid black;

">Submit</button>

                    </div>

                </div>

            </div><!-- Business Information -->

        </form>

    </div>

</section>

                

               



                

            </div>

        </div>

    </div>

</div>

<script src="{{url('/assets/js/plugins/bootstrap.min.js')}}"></script>

<script src="{{url('/assets/js/pcoded.min.js')}}"></script>

<script src="{{url('/assets/js/menu-setting.js')}}"></script>

<script src="{{url('/assets/js/plugins/select2.full.min.js')}}"></script>

<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{url('/assets/js/plugins/jquery.dataTables.min.js')}}"></script>

<script src="{{url('/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script>

    /*$(document).ready(function() {

          $('#body').summernote({

             placeholder: 'Share you ideas',

             height: 350

          });

        });*/

    tinymce.init({

      branding: false,

      menubar: false,

      statusbar: false,

      selector: 'textarea#body',  //Change this value according to your HTML

      auto_focus: 'element1',

      width: "100%",

      height: "500",

      setup : function(editor)  {

                editor.on("change keyup", function(e){

                    //console.log('saving');

                    //tinyMCE.triggerSave(); // updates all instances

                    editor.save(); // updates this instance's textarea

                    $(editor.getElement()).trigger('change'); // for garlic to detect change

                });

      }





    });

    tinymce.init({

      branding: false,

      menubar: false,

      statusbar: false,

      selector: 'textarea#excerpt',  //Change this value according to your HTML

      auto_focus: 'element1',

      width: "100%",

      height: "250",

      setup : function(editor)  {

                editor.on("change keyup", function(e){

                    //console.log('saving');

                    //tinyMCE.triggerSave(); // updates all instances

                    editor.save(); // updates this instance's textarea

                    $(editor.getElement()).trigger('change'); // for garlic to detect change

                });

      }





    });

    // CKEDITOR.replace( 'body' );

    // CKEDITOR.replace( 'excerpt' );

</script>

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

    var district = $('#district').val();

    if(district != '' && vals != '') {

        $.ajax({

            url: "{{url('admin/search-location')}}/"+district+'/'+vals,

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

        if(district == '') {

            alert('Please select district first !')

        }

    }

}

$(document).on('click', '.no-parking', function(event) {

    var noPark = $('.no-parking').is(":checked");

    if(noPark){

      $('input.parking').prop({

          checked: false

      });

      image_display('parking_img',false);

      image_display('paid_parking_img',false);

      $('.paid-parking').prop({checked:false});

    }

    image_display('no_parking_img',noPark);

    $('.no-parking').prop({

        checked: noPark

    });

});

$(document).on('click', '.parking', function(event) {

    if(!$(this).hasClass('no-parking')){

        $('.no-parking').prop({

            checked: false

        });

        var status = false;

        var paid = false;

        var indexA = 0;

        $('input.parking:checkbox:checked').each(function(index){

            if($(this).hasClass('paid-parking')){

                paid = true;

                status = false;

                return false;

            }

            status = true;

            indexA++;

          return true;

        });

        image_display('no_parking_img',false);

        image_display('parking_img',status && !paid);

        image_display('paid_parking_img',paid);

    }else{

        image_display('no_parking_img',$('.no-parking').is(":checked"));

        image_display('parking_img',false);

        image_display('paid_parking_img',false);

    }

});

$('.clockpicker').clockpicker({donetext:'Ok',autoclose:true});

$('body,html').on('click', '.region_list', function(event) {

  $("#region_list").css('display','none');

});



function image_display(image,status) {

  $('#'+image).css('display',status?'block':'none');

}

image_display('lgbtq_img'{{old('lgbtq',@$businfo->lgbtq)==''?'':','.old('lgbtq',@$businfo->lgbtq)}});

image_display('sign_lang_img'{{old('sign_language',@$businfo->sign_language)==''?'':','.old('sign_language',@$businfo->sign_language)}});

// image_display('parking_img'{{old('free_parking',@$businfo->indoor_parking) == '' && old('indoor_parking',@$businfo->indoor_parking) == '' ? '' : ',true'}});

image_display('paid_parking_img'{{old('paid_parking',@$businfo->paid_parking) == '' ? '' : ',true'}});

image_display('parking_img'{{old('paid_parking',@$businfo->paid_parking) == '' && (old('free_parking',@$businfo->indoor_parking) == '1' || old('free_parking',@$businfo->free_parking) == '1') ? ',true' : ',false'}});

image_display('no_parking_img'{{old('no_parking',@$businfo->no_parking)==''?'':','.old('no_parking',@$businfo->no_parking)}});

image_display('wheelchair_img'{{old('wheelchair',@$businfo->wheel_chair)==''?'':','.old('wheelchair',@$businfo->wheel_chair)}})

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

@@include('./include/footer.php')

<script src="{{url('public/js/select2.min.js')}}" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

<script>

    $(document).ready(function(){

        var data = [

            @php

                $languages = "";

                $selectedLang = explode(',',@$businfo->language);

            @endphp

            @foreach($spokenLanguages as $lang)

            @php

                $languages .= "{id:'$lang',text:'$lang'".(in_array($lang,(array) old('languages'))?",selected:true":(in_array($lang,$selectedLang)?",selected:true":''))."},";

            @endphp

            @endforeach

            @php 

                echo $languages;

            @endphp

            ];

        $('.languages').select2({data:data,placeholder: "Enter keyword to search languages and select"});

        @if(old('username',@$vendorData->username) != '' && old('is_business_hours',@$vendorData->is_business_hours) == '1')

            businessHours(true);

        @elseif(old('username',@$vendorData->username) == '')

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

</body>

</html>