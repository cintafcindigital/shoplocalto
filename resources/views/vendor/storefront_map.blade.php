@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap storefront_main_sect dash_main_sect">
  	@include('vendor.tools_nav')
   	<div class="wrapper">
	   	<div class="pure-g">
			@include('vendor.nav_links')<!-- left navigation -->
			<div class="pure-u-5-7 location_map_wrp">
				<h1 class="adminTitle">Edit address</h1>
				@if(session()->has('success'))
					<div class="app-success-box alert alert-success">{{session()->get('success')}}</div>
				@endif
				@if(session()->has('error'))
					<div class="app-danger-box alert alert-danger">{{session()->get('error')}}</div>
				@endif
				
	      		<div class="row">
	      		    <div class="col-sm-12">
	      		        <form action="{{url()->current()}}" method="POST">
	      		            @csrf
	      		            <div class="form-group">
	      		                <label>Province</label>
	      		                <select name="province" id="province" class="form-control" required>
                                  <option value="">-- select province --</option>
                                    @foreach($regions as $key)
                                        <option value="{{$key->state}}" @if(old('province',$address->province) == $key->state) selected @endif>{{$key->state}}</option>
                                    @endforeach
                                </select>
                                 @if($errors->has('province'))
                                    <span class="error-text"><strong>{{ $errors->first('province') }}</strong></span>
                                @endif
	      		            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" placeholder="City/Town *" class="form-control" required autocomplete="off" list="region_list" onkeyup="get_city_town(this.value);" onclick="get_city_town(this.value,true);" value="{{old('city',$address->city)}}">
                                <datalist id="region_list"></datalist>
                                 @if($errors->has('city'))
                                    <span class="error-text"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="text" name="postal_code" placeholder="Postal Code *" class="form-control" required value="{{old('postal_code',$address->postal_code)}}">
                                 @if($errors->has('postal_code'))
                                    <span class="error-text"><strong>{{ $errors->first('postal_code') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" placeholder="Address *" class="form-control" required onload="geolocate()" value="{{old('address',$address->address)}}">
                                 @if($errors->has('address'))
                                    <span class="error-text"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>
                            <input type="hidden" value="company" name="action" >
                            <button class="btnFlat btnFlat--primary app-add-direction vendorsAddresses__addAddress add_add_btn" type="submit">Submit</button>
	      		        </form>
	      		    </div>
	      		</div>
				<!--<div class="adminAlert adminAlert--flex storefront_alert">
					<i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-map"></i>
					<div>
						<p class="adminAlert__title">Edit your business location by adding your address.</p>
						<p>
							Address must contain the street name followed by any additional information (Apartment, Suite, etc.).<small class="block color-grey">Example: Baker Street, 221B </small>
						</p>
					</div>
				</div>-->
				<div class="pure-g mb1 storefront_loc_wrp" style="display: none;">
					<div class="pure-u-1-2 pt10">
						<p class="adminSubtitle">Location info</p>
					</div>
					<div class="pure-u-1-2 text-right">
						<a class="btnOutline btnOutline--primary" href="javascript:;">Manage Additional Addresses</a>
					</div>
				</div>
	      	</div>
	      	<div class="pure-u-5-7 additional_address_wrp" style="display: none;">
	      		<h1 class="adminTitle">Edit address</h1>
	      		<div class="app-hide-alert edit_map_succ" style="display: none;">
	      			<div class="adminAlert adminAlert--success">
	      				<p class="alert_msg"></p>
	      			</div>
	      		</div>
	      		<!--<div class="text-right">
	      			<button class="btnFlat btnFlat--primary app-add-direction vendorsAddresses__addAddress add_add_btn">Add Address</button>
	      		</div>-->
	      		<div id="app-container-new-directions" class="mt20 new_address_wrp" style="display: none;">
	      			<div class="alert alert-danger print-error-msg" style="display:none">
	      				<ul></ul>
	      			</div>
	      			<div class="box">
	      				<div class="pt15 pl15 pr15 border-bottom header">
	      					<h2>Add Address</h2>
	      				</div>
	      				<form class="app-location-selection- p15 pure-g-r pure-form pure-form-stacked form-events row" id="formDirecciones" name="formDirecciones" method="post">
	      					{{csrf_field()}}
	      					<!-- onsubmit="return va_direcciones_validar('0');return false;" -->
	      					<input type="hidden" name="idDireccion" id="idDireccion" value="">
	      					<div class="pure-u-3-5">
	      						<div class="pure-s">
	      							<div class="unit">
	      								<div class="pure-control-group">
	      									<label class="adminFormLabel">Country sd<span class="required">*</span></label>
	      									<div class="select-fake select-fake-disabled pure-u-1">
	      										<select class="pure-u-1" name="country" id="country">
	      											<option value="">- - Select - -</option>
	      											@foreach($data['countries'] as $country)
	      											<option value="{{$country->id}}">{{$country->name}}</option>
	      											@endforeach
	      										</select>
	      									</div>
	      								</div>
	      								<div class="pure-control-group">
	      									<label for="txtStrPoblacion" class="adminFormLabel">City <span class="required">*</span></label>
	      									<div class="drop-wrapper">
	      										<input type="hidden" name="countryCode" id="countryCode" value="">
	      										<input type="hidden" class="app-suggest-provincia-id-default" name="Provincia">
	      										<input type="hidden" class="app-suggest-poblacion-id-default" name="Poblacion">
	      										<input type="hidden" class="app-suggest-poblacion-id-default" name="city_id" id="city_id">
	      										<input id="city" name="city" class="pure-u-1 autocomplete_txt" type="text" value="" onchange="updateLatLong();">
	      										<div class="app-suggest-poblacion-div-default droplayer droplayer-scroll dnone"></div>
	      									</div>
	      								</div>
	      								<div class="pure-control-group">
	      									<label for="zipCode" class="adminFormLabel">Postal code <span class="required">*</span></label>
	      									<input class="pure-u-1" type="text" id="postal_code" name="postal_code">
	      								</div>
	      								<div>
	      									<label for="address1" class="adminFormLabel">Address <span class="required">*</span></label>
	      									<input class="pure-u-1" type="text" id="address" name="address" onchange="updateLatLong();">
	      								</div>
	      								<div class="pure-control-group text-right mt10">
	      									<input type="button" class="btnFlat btnFlat--grey btnFlat--small btnUpdateMap" onclick="" value="Update Map">
	      								</div>
	      								<div>
											<input type="hidden" name="latitud" id="latitud" value="43.7223">
											<input type="hidden" name="longitud" id="longitud" value="-79.4674">
											<div id="map" class="mt10 pure-u-1" style="height:180px;width: 100%;"></div>
	      									<!-- <input type="hidden" name="latitud" id="latitud" value=""> -->
	      									<!-- <input type="hidden" name="longitud" id="longitud" value=""> -->
	      									<!-- <div id="map" class="mt10 pure-u-1" style="height: 180px; position: relative; overflow: hidden;"> -->
	      										<!-- <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
	      											<div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
	      												<div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;">
	      													<div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
	      														<div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
	      																<div style="position: absolute; z-index: 984; transform: matrix(1, 0, 0, 1, 0, 0);">
	      																	<div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;">
	      																		<div style="width: 256px; height: 256px;"></div>
	      																	</div>
	      																	<div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px;">
	      																		<div style="width: 256px; height: 256px;"></div>
	      																	</div>
	      																	<div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px;">
	      																		<div style="width: 256px; height: 256px;"></div>
	      																	</div>
	      																	<div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px;">
	      																		<div style="width: 256px; height: 256px;"></div>
	      																	</div>
	      																</div>
	      															</div>
	      														</div>
	      														<div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
	      														<div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
	      														<div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
	      																<div style="position: absolute; z-index: 984; transform: matrix(1, 0, 0, 1, 0, 0);">
	      																	<div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: 0px;"></div>
	      																	<div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: 0px;"></div>
	      																	<div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -256px; top: -256px;"></div>
	      																	<div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 0px; top: -256px;"></div>
	      																</div>
	      															</div>
	      															<div style="width: 27px; height: 43px; overflow: hidden; position: absolute; left: -14px; top: -43px; z-index: 0;"><img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
	      														</div>
	      														<div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
	      															<div style="position: absolute; z-index: 984; transform: matrix(1, 0, 0, 1, 0, 0);">
	      																<div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i16!2i32768!3i32768!4i256!2m3!1e0!2sm!3i476153254!3m9!2sen!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;key={{env('GMAP_API_KEY')}}&amp;token=48702" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
	      																<div style="position: absolute; left: -256px; top: 0px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i16!2i32767!3i32768!4i256!2m3!1e0!2sm!3i476153254!3m9!2sen!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;key={{env('GMAP_API_KEY')}}&amp;token=98035" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
	      																<div style="position: absolute; left: -256px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i16!2i32767!3i32767!4i256!2m3!1e0!2sm!3i476153254!3m9!2sen!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;key={{env('GMAP_API_KEY')}}&amp;token=49430" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
	      																<div style="position: absolute; left: 0px; top: -256px; width: 256px; height: 256px; transition: opacity 200ms linear 0s;"><img draggable="false" alt="" role="presentation" src="https://maps.googleapis.com/maps/vt?pb=!1m5!1m4!1i16!2i32768!3i32767!4i256!2m3!1e0!2sm!3i476153254!3m9!2sen!3sUS!5e18!12m1!1e68!12m3!1e37!2m1!1ssmartmaps!4e0&amp;key={{env('GMAP_API_KEY')}}&amp;token=97" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
	      															</div>
	      														</div>
	      													</div>
	      													<div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;">
	      														<p class="gm-style-pbt"></p>
	      													</div>
	      													<div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;">
	      														<div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;">
	      																<div style="width: 27px; height: 43px; overflow: hidden; position: absolute; opacity: 0; touch-action: none; left: -14px; top: -43px; z-index: 0;">
	      																	<img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png" draggable="false" usemap="#gmimap1" style="position: absolute; left: 0px; top: 0px; width: 27px; height: 43px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
	      																	<map name="gmimap1" id="gmimap1">
	      																		<area log="miw" coords="13.5,0,4,3.75,0,13.5,13.5,43,27,13.5,23,3.75" shape="poly" title="" style="cursor: pointer; touch-action: none;">
	      																	</map>
	      																</div>
	      															</div>
	      															<div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
	      														</div>
	      													</div>
	      												</div>
	      												<iframe aria-hidden="true" frameborder="0" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;" src="about:blank"></iframe>
	      												<div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
	      													<a target="_blank" rel="noopener" href="https://maps.google.com/maps?ll=0,0&amp;z=16&amp;t=m&amp;hl=en&amp;gl=US&amp;mapclient=apiv3" title="Open this area in Google Maps (opens a new window)" style="position: static; overflow: visible; float: none; display: inline;">
	      														<div style="width: 66px; height: 26px; cursor: pointer;"><img alt="" src="https://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
	      													</a>
	      												</div>
	      												<div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-sizing: border-box; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 300px; height: 170px; position: absolute; left: 81px; top: 5px;">
	      													<div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
	      													<div style="font-size: 13px;">Map data ©2019</div>
	      													<button draggable="false" title="Close" aria-label="Close" type="button" class="gm-ui-hover-effect" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: absolute; cursor: pointer; user-select: none; top: 0px; right: 0px; width: 37px; height: 37px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%206.41L17.59%205%2012%2010.59%206.41%205%205%206.41%2010.59%2012%205%2017.59%206.41%2019%2012%2013.41%2017.59%2019%2019%2017.59%2013.41%2012z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="pointer-events: none; display: block; width: 13px; height: 13px; margin: 12px;"></button>
	      												</div>
	      												<div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 71px; bottom: 0px; width: 87px;">
	      													<div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;">
	      														<div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
	      															<div style="width: 1px;"></div>
	      															<div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
	      														</div>
	      														<div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="text-decoration: none; cursor: pointer; display: none;">Map Data</a><span>Map data ©2019</span></div>
	      													</div>
	      												</div>
	      												<div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
	      													<div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2019</div>
	      												</div>
	      												<div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
	      													<div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
	      														<div style="width: 1px;"></div>
	      														<div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
	      													</div>
	      													<div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/en_US/help/terms_maps.html" target="_blank" rel="noopener" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div>
	      												</div>
	      												<button draggable="false" title="Toggle fullscreen view" aria-label="Toggle fullscreen view" type="button" class="gm-control-active gm-fullscreen-control" style="background: none rgb(255, 255, 255); border: 0px; margin: 10px; padding: 0px; position: absolute; cursor: pointer; user-select: none; border-radius: 2px; height: 40px; width: 40px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; overflow: hidden; top: 0px; right: 0px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%20018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C0v2v4h2V2h4V0H2H0z%20M16%2C0h-4v2h4v4h2V2V0H16z%20M16%2C16h-4v2h4h2v-2v-4h-2V16z%20M2%2C12H0v4v2h2h4v-2H2V12z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"></button>
	      												<div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;">
	      													<div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
	      														<div style="width: 1px;"></div>
	      														<div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
	      													</div>
	      													<div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_blank" rel="noopener" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@0,0,16z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div>
	      												</div>
	      												<div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="0" controlheight="0" style="margin: 10px; user-select: none; position: absolute; display: none; bottom: 14px; right: 0px;">
	      													<div class="gmnoprint" style="display: none; position: absolute;">
	      														<div draggable="false" style="user-select: none; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255);">
	      															<button draggable="false" title="Zoom in" aria-label="Zoom in" type="button" class="gm-control-active" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; overflow: hidden;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23666%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23333%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpolygon%20fill%3D%22%23111%22%20points%3D%2218%2C7%2011%2C7%2011%2C0%207%2C0%207%2C7%200%2C7%200%2C11%207%2C11%207%2C18%2011%2C18%2011%2C11%2018%2C11%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"></button>
	      															<div style="position: relative; overflow: hidden; width: 30px; height: 1px; margin: 0px 5px; background-color: rgb(230, 230, 230);"></div>
	      															<button draggable="false" title="Zoom out" aria-label="Zoom out" type="button" class="gm-control-active" style="background: none; display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; overflow: hidden;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218%22%20height%3D%2218%22%20viewBox%3D%220%200%2018%2018%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C7h18v4H0V7z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"></button>
	      														</div>
	      													</div>
	      													<div class="gm-svpc" dir="ltr" title="Drag Pegman onto the map to open Street View" controlwidth="40" controlheight="40" style="background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; width: 40px; height: 40px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: none; display: none; position: absolute;">
	      														<div style="position: absolute; left: 50%; top: 50%;"></div>
	      													</div>
	      													<div class="gmnoprint" controlwidth="40" controlheight="40" style="display: none; position: absolute;">
	      														<div style="width: 40px; height: 40px;"><button draggable="false" title="Rotate map 90 degrees" aria-label="Rotate map 90 degrees" type="button" class="gm-control-active" style="background: none rgb(255, 255, 255); display: none; border: 0px; margin: 0px 0px 32px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2222%22%20viewBox%3D%220%200%2024%2022%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20fill-rule%3D%22evenodd%22%20d%3D%22M20%2010c0-5.52-4.48-10-10-10s-10%204.48-10%2010v5h5v-5c0-2.76%202.24-5%205-5s5%202.24%205%205v5h-4l6.5%207%206.5-7h-4v-5z%22%20clip-rule%3D%22evenodd%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 18px; width: 18px;"></button><button draggable="false" title="Tilt map" aria-label="Tilt map" type="button" class="gm-tilt gm-control-active" style="background: none rgb(255, 255, 255); display: block; border: 0px; margin: 0px; padding: 0px; position: relative; cursor: pointer; user-select: none; width: 40px; height: 40px; top: 0px; left: 0px; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23666%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23333%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2218px%22%20height%3D%2216px%22%20viewBox%3D%220%200%2018%2016%22%3E%0A%20%20%3Cpath%20fill%3D%22%23111%22%20d%3D%22M0%2C16h8V9H0V16z%20M10%2C16h8V9h-8V16z%20M0%2C7h8V0H0V7z%20M10%2C0v7h8V0H10z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="width: 18px;"></button></div>
	      													</div>
	      												</div>
	      												<div class="gmnoprint" style="margin: 10px; z-index: 0; position: absolute; cursor: pointer; display: none; left: 0px; top: 0px;">
	      													<div class="gm-style-mtc" style="float: left; position: relative;">
	      														<div role="button" tabindex="0" title="Show street map" aria-label="Show street map" aria-pressed="true" draggable="false" style="direction: ltr; overflow: hidden; text-align: center; height: 40px; display: table-cell; vertical-align: middle; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 18px; background-color: rgb(255, 255, 255); padding: 0px 17px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; min-width: 36px; font-weight: 500;">Map</div>
	      														<div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; left: 0px; top: 40px; text-align: left; display: none;">
	      															<div draggable="false" title="Show street map with terrain" style="color: black; font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 18px; background-color: rgb(255, 255, 255); padding: 5px 8px 5px 5px; direction: ltr; text-align: left; white-space: nowrap;"><span role="checkbox" style="vertical-align: middle;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%203H5c-1.11%200-2%20.9-2%202v14c0%201.1.89%202%202%202h14c1.11%200%202-.9%202-2V5c0-1.1-.89-2-2-2zm-9%2014l-5-5%201.41-1.41L10%2014.17l7.59-7.59L19%208l-9%209z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 1em; width: 1em; transform: translateY(0.15em); display: none;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%205v14H5V5h14m0-2H5c-1.1%200-2%20.9-2%202v14c0%201.1.9%202%202%202h14c1.1%200%202-.9%202-2V5c0-1.1-.9-2-2-2z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 1em; width: 1em; transform: translateY(0.15em);"></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div>
	      														</div>
	      													</div>
	      													<div class="gm-style-mtc" style="float: left; position: relative;">
	      														<div role="button" tabindex="0" title="Show satellite imagery" aria-label="Show satellite imagery" aria-pressed="false" draggable="false" style="direction: ltr; overflow: hidden; text-align: center; height: 40px; display: table-cell; vertical-align: middle; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 18px; background-color: rgb(255, 255, 255); padding: 0px 17px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; min-width: 66px; border-left: 0px;">Satellite</div>
	      														<div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; right: 0px; top: 40px; text-align: left; display: none;">
	      															<div draggable="false" title="Show imagery with street names" style="color: black; font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 18px; background-color: rgb(255, 255, 255); padding: 5px 8px 5px 5px; direction: ltr; text-align: left; white-space: nowrap;"><span role="checkbox" style="vertical-align: middle;"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%203H5c-1.11%200-2%20.9-2%202v14c0%201.1.89%202%202%202h14c1.11%200%202-.9%202-2V5c0-1.1-.89-2-2-2zm-9%2014l-5-5%201.41-1.41L10%2014.17l7.59-7.59L19%208l-9%209z%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 1em; width: 1em; transform: translateY(0.15em);"><img src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224px%22%20height%3D%2224px%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22%23000000%22%3E%0A%20%20%20%20%3Cpath%20d%3D%22M19%205v14H5V5h14m0-2H5c-1.1%200-2%20.9-2%202v14c0%201.1.9%202%202%202h14c1.1%200%202-.9%202-2V5c0-1.1-.9-2-2-2z%22%2F%3E%0A%20%20%20%20%3Cpath%20d%3D%22M0%200h24v24H0z%22%20fill%3D%22none%22%2F%3E%0A%3C%2Fsvg%3E%0A" style="height: 1em; width: 1em; transform: translateY(0.15em); display: none;"></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div>
	      														</div>
	      													</div>
	      												</div>
	      											</div>
	      										</div> -->
	      									<!-- </div> -->
	      								</div>
	      								<div class="pt20">
	      									<button type="submit" class="btnFlat btnFlat--primary mr10 btn-publish-address">Publish Address</button>
	      									<button type="button" class="btnFlat btnFlat--grey app-cancel-new-location">Cancel</button>
	      								</div>
	      							</div>
	      						</div>
	      					</div>
	      					<div class="pure-u-2-5">
	      						<div class="unit">
	      							<div class="pure-control-group">
	      								<label for="phonePrimary" class="adminFormLabel">Main telephone</label>
	      								<input class="pure-u-1" type="text" name="phone_main" id="phone_main" value="">
	      							</div>
	      							<div class="pure-control-group" style="margin-top:2px">
	      								<label for="phonePrimary" class="adminFormLabel">Extension</label>
	      								<input class="pure-u-1" type="text" name="phone_ext" id="phone_ext" value="">
	      							</div>
	      							<div class="pure-control-group">
	      								<label for="phoneFax" class="adminFormLabel">Fax number</label>
	      								<input class="pure-u-1" type="text" name="phone_fax" id="phone_fax" value="">
	      							</div>
	      							<div class="pure-control-group">
	      								<label for="phoneOther" class="adminFormLabel">Other telephone</label>
	      								<input class="pure-u-1" type="text" name="phone_other" id="phone_other" value="">
	      							</div>
	      							<div class="pure-control-group">
	      								<label for="businessHoursText" class="adminFormLabel">Business hours</label>
	      								<textarea class="pure-u-1 app-no-tiny" rows="3" name="business_hours" id="business_hours"></textarea>
	      							</div>
	      						</div>
	      					</div>
	      				</form>
	      			</div>
	      		</div>
	      		<ul class="listBordered">
	      			@if(count($data['location'])==1)
		      			@foreach($data['location'] as $loc)
		      			<li id="{{$loc->id}}" class="listBordered__item app-list-item">
		      				<div class="p15">
		      					<div class="pure-g-r">
		      						<div class="pure-u-1-2">
		      							<i class="icon-vendor icon-vendor-nav-map icon-left"></i>
		      							<a  id="update_add_info_{{$loc->id}}" class="app-direcciones-edit" title="Edit" data-iddireccion="{{$loc->id}}" href="#{{$loc->id}}">{{$loc->address}}</a>
		      							<span id="update_city_info_{{$loc->id}}">{{ $loc->city}}, {{$loc->state}}</span>
		      						</div>
		      						<div class="pure-u-1-2 text-right">
		      							<span class="tag tag-published">Published</span>
		      							<a href="javascript:void(0)" class="app-direcciones-edit icon icon-arrow-right ml20" data-iddireccion="add_info_{{$loc->id}}"></a>
		      						</div>
		      					</div>
		      				</div>
		      				<div id="add_info_{{$loc->id}}" class="app-list-item-content dnone p15 border-top add_frm_cont" style="display: none;">
		      					<form class="app-location-selection-{{$loc->id}}  pure-g-r pure-form pure-form-stacked form-events row" id="formDirecciones" name="formDirecciones" method="post">
		      						{{ csrf_field() }}
		      						<input type="hidden" name="address_id" value="{{$loc->id}}">
		      						<input type="hidden" name="action" value="update">
		      						<input type="hidden"  name="update_city_id" id="update_city_id_$loc->id" value="{{$loc->city_id}}">
		      						<div class="pure-u-3-5">
		      							<div class="pure-s">
		      								<div class="unit">
		      									<div class="pure-control-group">
		      										<label class="adminFormLabel">Country <span class="required">*</span></label>
		      										<div class="select-fake select-fake-disabled pure-u-1">
		      											<select class="pure-u-1" id="country_{{$loc->id}}" name="country">
		      												<option value="">- - Select - -</option>
		      												@foreach($data['countries'] as $country)
		      												<option value="{{$country->id}}" {{isset($loc->country_id) && $loc->country_id==$country->id?'selected':''}}>{{$country->name}}</option>
		      												@endforeach
		      											</select>
		      											<span id="country_err_{{$loc->id}}"></span>
		      										</div>
		      									</div>
	      										<div class="pure-control-group">
	      											<label for="txtStrPoblacion" class="adminFormLabel">City <span class="required">*</span></label>
	      											<div class="drop-wrapper">
	      												<input id="city_{{$loc->id}}" name="city" class="pure-u-1 autocomplete_txt" type="text" autocomplete="off" data-suffix="default" data-update_map_id="{{$loc->id}}" value="{{$loc->city}}, {{$loc->state}}" data-countryus="55" onkeyup="">
	      												<div class="app-suggest-poblacion-div-default droplayer droplayer-scroll dnone"></div>
	      											</div>
	      											<span id="city_err_{{$loc->id}}"></span>
	      										</div>
	  											<div class="pure-control-group">
	  												<label for="zipCode" class="adminFormLabel">Postal code <span class="required">*</span></label>
	  												<input class="pure-u-1" type="text" id="postal_code_{{$loc->id}}" name="postal_code" value="{{$loc->postal_code}}">
	  												<span id="postal_code_err_{{$loc->id}}"></span>
	  											</div>
	  											<div>
													<label for="address1" class="adminFormLabel">Address <span class="required">*</span></label>
													<input class="pure-u-1" type="text" id="address_{{$loc->id}}" name="address" value="{{$loc->address}}">
													<span id="address_err_{{$loc->id}}"></span>
												</div>
												<div class="pure-control-group text-right mt10">
													<input type="button" class="btnFlat btnFlat--grey btnFlat--small btnUpdateMap" data-update_map_id="{{$loc->id}}" onclick="" value="Update Map">
												</div>
												<div>
													<input type="hidden" name="latitud" id="latitud" value="{{$loc->latitude}}">
													<input type="hidden" name="longitud" id="longitud" value="{{$loc->longitude}}">
													<div id="map_{{$loc->id}}" class="mt10 pure-u-1" style="height: 180px;width: 100%;"></div>
												</div>
												<div class="pt20">
													<!-- {{print_r($loc)}} -->
													<button type="submit" class="btnFlat btnFlat--primary mr10 save_map_change" data-address_id="{{$loc->id}}">Save Changes</button>
													<button type="button" class="btnFlat btnFlat--grey app-delete-location" data-eliminate_id="{{$loc->id}}">Eliminate Address</button>
												</div>
											</div>
										</div>
									</div>
									<div class="pure-u-2-5">
										<div class="unit">
											<div class="pure-control-group">
												<label for="phonePrimary" class="adminFormLabel">Main telephone</label>
												<input class="pure-u-1" type="text" id="phone_main_{{$loc->id}}" name="phone_main" value="{{$loc->main_telephone}}">
											</div>
											<div class="pure-control-group" style="margin-top:2px">
												<label for="phonePrimary" class="adminFormLabel">Extension</label>
												<input class="pure-u-1" type="text" id="phone_ext_{{$loc->id}}" name="phone_ext" value="{{$loc->extension}}">
											</div>
											<div class="pure-control-group">
												<label for="phoneFax" class="adminFormLabel">Fax number</label>
												<input class="pure-u-1" type="text" id="phone_fax_{{$loc->id}}" name="phone_fax" value="{{$loc->fax}}">
											</div>
											<div class="pure-control-group">
												<label for="phoneOther" class="adminFormLabel">Other telephone</label>
												<input class="pure-u-1" type="text" id="phone_other_{{$loc->id}}" name="phone_other" value="{{$loc->other_telephone}}">
											</div>
											<div class="pure-control-group">
												<label for="businessHoursText" class="adminFormLabel">Business hours</label>
												<textarea class="pure-u-1 app-no-tiny" rows="3" id="business_hours_{{$loc->id}}" name="business_hours">{{$loc->business_hours}}</textarea>
											</div>
										</div>
									</div>
								</form>
							</div>
						</li>
						@endforeach
					@else
						@foreach($data['location'] as $loc)
						<li id="{{$loc->id}}" class="listBordered__item app-list-item">
							<div class="p15">
								<div class="pure-g-r">
									<div class="pure-u-1-2">
										<i class="icon-vendor icon-vendor-nav-map icon-left"></i>
										<a  id="update_add_info_{{$loc->id}}" class="app-direcciones-edit" title="Edit" data-iddireccion="{{$loc->id}}" href="#{{$loc->id}}">{{$loc->address}}</a>
										<span id="update_city_info_{{$loc->id}}">{{ $loc->city}}, {{$loc->state}}</span>
									</div>
									<div class="pure-u-1-2 text-right">
										<span class="tag tag-published">Published</span>
										<a href="javascript:void(0)" class="app-direcciones-edit icon icon-arrow-right ml20" data-iddireccion="add_info_{{$loc->id}}" data-id="{{$loc->id}}"></a>
									</div>
								</div>
							</div>
							<div id="add_info_{{$loc->id}}" class="app-list-item-content dnone p15 border-top add_frm_cont" style="display: none;">
								<form class="app-location-selection-{{$loc->id}}  pure-g-r pure-form pure-form-stacked form-events row" id="formDirecciones" name="formDirecciones" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="address_id" value="{{$loc->id}}">
									<input type="hidden" name="action" value="update">
									<input type="hidden"  name="update_city_id_{{$loc->id}}" id="update_city_id_{{$loc->id}}" value="{{$loc->city_id}}">
									<div class="pure-u-3-5">
										<div class="pure-s">
											<div class="unit">
												<div class="pure-control-group">
													<label class="adminFormLabel">Country <span class="required">*</span></label>
													<div class="select-fake select-fake-disabled pure-u-1">
														<select class="pure-u-1" id="country_{{$loc->id}}" name="country">
															<option value="">-- Select --</option>
															@foreach($data['countries'] as $country)
															<option value="{{$country->id}}" {{ isset($loc->country_id) && $loc->country_id==$country->id?'selected':''}}>{{$country->name}}</option>
															@endforeach
														</select>
														<span id="country_err_{{$loc->id}}"></span>
													</div>
												</div>
												<div class="pure-control-group">
													<label for="txtStrPoblacion" class="adminFormLabel">City <span class="required">*</span></label>
													<div class="drop-wrapper">
														<input id="city_{{$loc->id}}" name="city" class="pure-u-1 autocomplete_txt" data-update_map_id="{{$loc->id}}" type="text" autocomplete="off" data-suffix="default" data-action="update" value="{{$loc->city}}, {{$loc->state}}" data-countryus="55" onkeyup="">
														<div class="app-suggest-poblacion-div-default droplayer droplayer-scroll dnone"></div>
													</div>
													<span id="city_err_{{$loc->id}}"></span>
												</div>
												<div class="pure-control-group">
													<label for="zipCode" class="adminFormLabel">Postal code <span class="required">*</span></label>
													<input class="pure-u-1" type="text" id="postal_code_{{$loc->id}}" name="postal_code" value="{{$loc->postal_code}}">
													<span id="postal_code_err_{{$loc->id}}"></span>
												</div>
												<div>
													<label for="address1" class="adminFormLabel">Address <span class="required">*</span></label>
													<input class="pure-u-1" type="text" id="address_{{$loc->id}}" name="address" value="{{$loc->address}}">
													<span id="address_err_{{$loc->id}}"></span>
												</div>
												<div class="pure-control-group text-right mt10">
													<input type="button" class="btnFlat btnFlat--grey btnFlat--small btnUpdateMap" data-update_map_id="{{$loc->id}}" value="Update Map">
												</div>
												<div>
													<input type="hidden" name="latitude" id="latitude_{{$loc->id}}" value="{{$loc->latitude}}">
													<input type="hidden" name="longitude" id="longitude_{{$loc->id}}" value="{{$loc->longitude}}">
													<div id="map_{{$loc->id}}" class="mt10 pure-u-1" style="height: 180px;width: 100%;"></div>
												</div>
												<div class="pure-control-group">
													<label class="adminFormLabel">Make Primary </label>
													<input type="radio" name="is_primary" value="1">
												</div>
												<div class="pt20">
													<button type="submit" class="btnFlat btnFlat--primary mr10 save_map_change" data-address_id="{{$loc->id}}">Save Changes</button>
													<button type="button" class="btnFlat btnFlat--grey app-delete-location" data-eliminate_id="{{$loc->id}}">Eliminate Address</button>
												</div>
											</div>
										</div>
									</div>
									<div class="pure-u-2-5">
										<div class="unit">
											<div class="pure-control-group">
												<label for="phonePrimary" class="adminFormLabel">Main telephone</label>
												<input class="pure-u-1" type="text" id="phone_main_{{$loc->id}}" name="phone_main" value="{{$loc->main_telephone}}">
											</div>
											<div class="pure-control-group" style="margin-top:2px">
												<label for="phonePrimary" class="adminFormLabel">Extension</label>
												<input class="pure-u-1" type="text" id="phone_ext_{{$loc->id}}" name="phone_ext" value="{{$loc->extension}}">
											</div>
											<div class="pure-control-group">
												<label for="phoneFax" class="adminFormLabel">Fax number</label>
												<input class="pure-u-1" type="text" id="phone_fax_{{$loc->id}}" name="phone_fax" value="{{$loc->fax}}">
											</div>
											<div class="pure-control-group">
												<label for="phoneOther" class="adminFormLabel">Other telephone</label>
												<input class="pure-u-1" type="text" id="phone_other_{{$loc->id}}" name="phone_other" value="{{$loc->other_telephone}}">
											</div>
											<div class="pure-control-group">
												<label for="businessHoursText" class="adminFormLabel">Business hours</label>
												<textarea class="pure-u-1 app-no-tiny" rows="3" id="business_hours_{{$loc->id}}" name="business_hours">{{$loc->business_hours}}</textarea>
											</div>
										</div>
									</div>
								</form>
							</div>
						</li>
						@endforeach  
					@endif
				</ul>		
			</div>
	   </div>
	</div>
</section>
@include('includes.footer')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<!--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY_NEW')}}&libraries=places&callback=initAutocomplete" async defer></script>
<script>
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
</script>
<!--<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY_NEW')}}"></script>-->
<!--<script type="text/javascript">
$(document).ready(function(){
	$('.update_map_btn').hover(function(){
		$(this).find('i').toggleClass('icon-refresh-white');
		$(this).find('i').toggleClass('icon-refresh-active');
	});
  	var count='<?php echo count($data['location']);?>';
    if(count==1) {
		$(".btnOutlinem .additional_address_wrp").hide();
		console.log('count',count);
		setTimeout(function(){ 
			$(".btnOutline, .app-direcciones-edit").trigger("click");
		},200);
    } else {
	    setTimeout(function(){ 
	  		$(".btnOutline").trigger("click");
	    },200);
    }
	$('.storefront_loc_wrp .btnOutline').click(function(){
		$(this).parents('.location_map_wrp').remove();
		$('.additional_address_wrp').show();
	});
	$('.app-cancel-new-location').click(function(){
		$('.new_address_wrp').hide();
		$('.app-add-direction').removeAttr('disabled');
		$('html, body').animate({ scrollTop: 10 }, 'slow');
	});
	$('.add_add_btn').click(function(){
		$(this).attr('disabled','true');
		$('.add_frm_cont').hide();
		$('.new_address_wrp').show();
	});
	/*$('.save_map_change').click(function(){
		$('.edit_map_succ').slideDown();
	});*/
    setTimeout(function() {
        $('.edit_map_succ').slideUp();
    }, 4000);
	// defInitialize($("#latitud").val(),$("#longitud").val(),$("#address").val()+', '+$("#city").val());
});

function defInitialize(lat,lng,address,map_id) {
  	// alert(lat+ ' '+lng+' '+address);
  	/*var map = new google.maps.Map(document.getElementById("map"), {
      center: {lat:parseFloat(lat), lng: parseFloat(lng)},
      zoom: 8
    });
    var marker = new google.maps.Marker({
      position: {lat:parseFloat(lat),lng:parseFloat(lng)},
      map: map,
      title: address
    });
    return;*/
    var mapOptions = {
        center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
        zoom: 8
    };
    var map = new google.maps.Map(document.getElementById(map_id == undefined ? "map" : map_id), mapOptions);
    var infowindow = new google.maps.InfoWindow({
     content: address
    });
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
		map: map,
		title: ''
	});
	marker.addListener('click', function() {
		infowindow.open(map, marker);
	});
}
function updateLatLong()
{
	var city = $('#city').val();
	var address = $('#address').val();
	$.ajax({
		url: "/autocomplete_latlong",
		method: 'GET',
		data: 'city='+city+'&address='+address,
		dataType: "json",
		success: function(data) {
			if(data[0] && data[1] && data[1]) {
				$("#latitud").val(data[0]);
				$("#longitud").val(data[1]);
				defInitialize(data[0],data[1],data[2]);
			}
		}
	});
}
/* city populate */
$( ".autocomplete_txt" ).autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "/autocomplete_ajax",
            data: { term : request.term },
            dataType: "json",
            success: function(data) {
               	var resp = $.map(data,function(obj) {
                    console.log('obj:',obj);
                    return {
						label: obj.city+', '+obj.state,
						value: obj.city+', '+obj.state,
						data : obj
                    }
               	});
               	response(resp);
            }
        });
    },
    minLength: 2,
    select: function( event, ui ) {
		var action=$(this).data('action');
		var cityid=$(this).attr('id');
		console.log(action+':'+cityid);
		var update_id = $(this).data('update_map_id');
		// alert()
		// setTimeout(function() {
			console.log('data',ui.item.data);
			if(update_id != undefined)
				$('#update_city_id_'+update_id).val(ui.item.data.id);
			if(action=='update'){
				$('#'+cityid).val(ui.item.data.label);
			} else {
				$('#city').val(ui.item.data.label);
				$('#city_id').val(ui.item.data.id);
			}
		// },500);
	}
});
function initialize(id,lat,lng,address) {
	// alert(id+' '+lat+ ' '+lng+' '+address);
	var mapOptions = {
		center: new google.maps.LatLng(parseFloat(lat),parseFloat(lng)),
		zoom: 8
	};
	var map = new google.maps.Map(document.getElementById("map_"+id), mapOptions);
	var infowindow = new google.maps.InfoWindow({
		content: address
	});
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
		map: map,
		title: ''
	});
	marker.addListener('click', function() {
		infowindow.open(map, marker);
	});
}
jQuery(document).on("click", ".app-direcciones-edit", function(e) {
	e.preventDefault();
	$('.app-list-item-content').hide();
	var id = $(this).data('iddireccion');
	var mid = $(this).data('id');
	$("#"+id).css("display","block");
	//$('.app-list-item-content').toggle();
	//$(this).show();
	//$('.app-list-item-content').slideToggle("slow"); 
	//$(this).find('').slideToggle();
	//$(this).removeClass('app-list-item-content').addClass('app-list-item-content');
	setTimeout(function() {
		initialize(mid,$("#latitude_"+mid).val(),$("#longitude_"+mid).val(),$("#address_"+mid).val()+', '+$("#city_"+mid).val()+', '+$("#country_"+mid+" option:selected").text());
	}, 500);
	//var latLng = jQuery(this).attr("data-latLng");          
	//initialize(latLng);
});
/*$(".app-direcciones-edit").on("click",function(){});*/
// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.
</script>-->
<!--<script type="text/javascript">
$(document).ready(function() {
    $(".btn-publish-address").click(function(e) {
		e.preventDefault();
		post_data = {
			_token : $("input[name='_token']").val(),
			country:$("select[name='country']").val(),
			city:$("input[name='city']").val(),
			city_id:$("input[name='city_id']").val(),
			postal_code: $("input[name='postal_code']").val(),
			address: $("input[name='address']").val(),
			main_telephone: $("input[name='phone_main']").val(),
			fax:$("input[name='phone_fax']").val(),
			extension: $("input[name='phone_ext']").val(),
			other_telephone: $("input[name='phone_other']").val(),
			business_hours:$("input[name='business_hours']").val()
		};
        $.ajax({
            url: "/storefront-map",
            type:'POST',
            data: post_data,
            success: function(data) {
                if($.isEmptyObject(data.error)) {
                	$(".print-error-msg, .new_address_wrp").hide();
                	$(".edit_map_succ").show();
                	$(".alert_msg").html(data.success);
                	setTimeout(function() {
        				$('.edit_map_succ').slideUp();
    				}	, 4000);
    				window.location='/storefront-map';	
                    //alert(data.success);
                }else{
                    printErrorMsg(data.error);
                }
            }
        });
    }); 
    /**************** UPDATE ADDRESS INFO ****************************/
    $(".save_map_change").click(function(e) {
        e.preventDefault();
		$('.edit_map_succ').slideDown();
        var address_id = $(this).data('address_id');
        var is_error=false;
        if($("#country_"+address_id).val()=="") {
        	$("#country_err_"+address_id).html("Country is required").css("color","red");
        	is_error=true;
        } else {
        	$("#country_err"+address_id).html("");		
        }
        if($("#postal_code_"+address_id).val()=="") {
        	$("#postal_code_err_"+address_id).html("Postal code is required").css("color","red");
        	is_error=true;
        } else {
        	$("#postal_code_err_"+address_id).html("");		
        }
        if($("#city_"+address_id).val()=="") {
        	$("#city_err_"+address_id).html("City is required").css("color","red");
        	is_error=true;
        } else {
        	$("#city_err_"+address_id).html("");		
        }
        if($("#address_"+address_id).val()=="") {
        	$("#address_err_"+address_id).html("Address is required").css("color","red");
        	is_error=true;
        } else{
        	$("#address_err_"+address_id).html("");		
        }
        if($("#latitude_"+address_id).val()=="" && $("#longitude_"+address_id).val()=="") {
        	alert("You must update map");
        	is_error=true;
        } else{
        	$("#address_err_"+address_id).html("");		
        }
        if(is_error===false) {
	        post_data = {
        		_token : $("input[name='_token']").val(),
        		country:$("#country_"+address_id).val(),
         		city:$("#update_city_id_"+address_id).val(),
         		postal_code: $("#postal_code_"+address_id).val(),
                address: $("#address_"+address_id).val(),
                phone_main: $("#phone_main_"+address_id).val(),
                phone_fax:$("#phone_fax_"+address_id).val(),
         		phone_ext: $("#phone_ext_"+address_id).val(),
                phone_other: $("#phone_other_"+address_id).val(),
                business_hours:$("#business_hours_"+address_id).val(),
                action:'update',
                address_id:address_id,
                latitude: $("#latitude_"+address_id).val(),
        		longitude:$("#longitude_"+address_id).val(),
        		is_primary:$("input[name='is_primary']").val(),
         	};
            $.ajax({
                url: "/storefront-map",
                type:'POST',
                data: post_data,
                success: function(data) {
                	//console.log(data);
                    if($.isEmptyObject(data.error)) {
                    	$("#add_info_"+address_id).hide();
                    	$(".print-error-msg, .new_address_wrp").hide();
                    	$(".edit_map_succ").show();
                    	$("#update_add_info_"+address_id).html($("#address_"+address_id).val());
                    	$("#update_city_info_"+address_id).html(data.city);
         				$(".alert_msg").html(data.success);
                    	setTimeout(function() {
	        				$('.edit_map_succ').slideUp();
	    			}	, 5000);
                    //alert(data.success);
                    }else{
                    	$("#add_info_"+address_id).show();
                        printErrorMsg(data.error);
                    }
                }
            });
        }
    }); 
    /************************* ELIMENATE ADDRESS **************************/
    $(".app-delete-location").click(function(e) {
        e.preventDefault();
        var address_id = $(this).data('eliminate_id');
        post_data = {
    		_token : $("input[name='_token']").val(),
            action:'elimenate',
            address_id:address_id
     	};
        $.ajax({
            url: "/storefront-map",
            type:'POST',
            data: post_data,
            success: function(data) {
            	console.log(data);
                if($.isEmptyObject(data.error)) {
                	$("#add_info_"+address_id).hide();
                	$(".print-error-msg, .new_address_wrp").hide();
                	$(".edit_map_succ").show();
                	//$("#update_add_info_"+address_id).html($("#address_"+address_id).val());
                	//$("#update_city_info_"+address_id).html(data.city);
     				$(".alert_msg").html(data.success);
                	setTimeout(function() {
        				$('.edit_map_succ').slideUp();
	    			}	, 5000);
                    window.location='/storefront-map';
                } else {
                	$("#add_info_"+address_id).show();
                    printErrorMsg(data.error);
                }
            }
        });
    });  
    /************************* UPDATE MAP **************************/
    $(".btnUpdateMap").click(function(e) {
        e.preventDefault();
        var address_id = $(this).data('update_map_id');
        // alert(address_id);
        post_data = {
    		_token : $("input[name='_token']").val(),
    		action:'update_map',
            country:$("#country_"+address_id+" option:selected").text(),
     		city:$("#city_"+address_id).val(),
     		postal_code: $("#postal_code_"+address_id).val(),
            address: $("#address_"+address_id).val(),
            address_id: address_id
     	};
        // alert(post_data.city);
     	console.log(post_data);
        $.ajax({
            url: "/storefront-map",
            type:'POST',
            data: post_data,
            success: function(data) {
            	console.log('map data',data);
                if($.isEmptyObject(data.error)) {
                	//$("#add_info_"+address_id).hide();
                	//$(".print-error-msg, .new_address_wrp").hide();
                	//$(".edit_map_succ").show();
                	//$("#update_add_info_"+address_id).html($("#address_"+address_id).val());
                	//$("#update_city_info_"+address_id).html(data.city);
     				//$(".alert_msg").html(data.success);
                	setTimeout(function() {
        				$("#latitude_"+address_id).val(data.lat);
        				$("#longitude_"+address_id).val(data.lng);
        				defInitialize(data.lat,data.lng,post_data.city,"map_"+address_id)
    				}, 200);
                } else {
                	$("#add_info_"+address_id).show();
                    printErrorMsg(data.error);
                }
            }
        });
    });
    function printErrorMsg (msg) {
    	//alert(msg);
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
});

</script>-->
@endsection