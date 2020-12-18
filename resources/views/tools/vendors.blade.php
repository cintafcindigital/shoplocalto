@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap">
    @include('tools.tools_nav');   
	<div class="wrapper app-tools-container-vendors app-tools-vendor-layer">
		<div class="tools-vendors-header">
	        <h1 class="tools-title">My Vendors</h1>
	        <div class="vendors-headerCount">
	            <div class="tools-vendors-header-item">
	                <p class="vendors-headerCount-total block">{{$data['booked_vendors'] ?? 0}} of {{$data['totalCats'] ?? 0}} vendors booked</p>
	                <div class="tools-boxProgress-container">
	                	<div class="tools-boxProgress-progress" style="width:100% !important;">
							@php if($data['totalCats']!=0){ $percent = round(($data['booked_vendors'] * 100) / $data['totalCats']); }  @endphp
							<div class="app-checklist-progress" style="width: {{$percent ?? 0}}%;"></div>
			            </div>
	                </div>
	            </div>
	            <div class="tools-vendors-header-item mb20 ">
	                <ul class="tools-toggle">
	                    <a role="button" href="{{url('tools/vendors-category?id_categ=&status=')}}" class="tools-toggle-item active">
	                        <i class="icon icon-fav-on-border mr10 fixicon"></i> Saved
	                        <span class="count">{{$data['totalSaved'] ?? 0}}</span>
	                    </a>
	                    <a role="button" href="{{url('tools/vendors-category?id_categ=&status=6')}}" class="tools-toggle-item">
	                        <i class="icon-tools icon-tools-checkbox-black-small mr10 fixicon"></i> Booked
	                        <span class="count">{{$data['booked_vendors'] ?? 0}}</span>
	                    </a>
	                </ul>
	            </div>
	            <div class="tools-vendors-header-item text-right">
	                <button class="btn-flat red app-add-vendor-modal ml40 mb15 app-tools-main-add-vendor-modal" data-toolredirect="true" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="2">
	                    <i class="icon-tools icon-tools-plus-white icon-left"></i> Add Vendor
	                </button>
	            </div>
	        </div>
	    </div>
	    @if(Session::has('message'))
            {!!Session::get('message')!!}
        @endif
	    <div class="pure-g vendors-categBox">
	        <!--/////////////////// Venues List /////////////////-->
	        @php $vendorFound = 0; $vendorcount = 0; @endphp
	        @if(isset($data['vendorCats'][1]) && !empty($data['vendorCats'][1]))
	            @foreach($data['vendorCats'][1] as $vendorCat)
	                @if(isset($vendorCat['booked']) && !empty($vendorCat['booked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['booked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['booked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 1 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=1" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools icon-tools-vendors-group-white-1"></i>
								<p class="vendors-categBox-title">Reception</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][1] ?? 0}}</span>
								<span class="vendors-categBox-button green app-newlink" data-href="{{url('tools/vendors-category')}}?id_categ=1&status=6"><i class="icon-tools icon-tools-check-white mr5"></i> Booked</span>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound = 1; break; @endphp
	                @endif
	                @if(isset($vendorCat['nonBooked']) && !empty($vendorCat['nonBooked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['nonBooked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['nonBooked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 1 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=1" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools icon-tools-vendors-group-white-1"></i>
								<p class="vendors-categBox-title">Reception</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][1] ?? 0}}</span>
								<a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="1" href="javascript:;">
                            		<i class="icon-tools mr5 icon-tools-search"></i> Search
                            	</a>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound = 1; break; @endphp
	                @endif
	            @endforeach
	            @if(!$vendorFound)
                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
	                    <div class="vendors-categBox-item app-link" data-href="{{url('tools/vendors-category')}}?id_categ=1">
	                        <i class="icon-tools icon-tools-vendors-group-1"></i>
	                        <p class="vendors-categBox-title">Reception</p>
	                        <a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="1" href="javascript:;">
	                            <i class="icon-tools mr5 icon-tools-search"></i> Search
	                        </a>
	                    </div>
		            </div>
		            @php $vendorcount++; @endphp
	            @endif
	          @endif
	          <!--/////////////////// Vendors List /////////////////-->
	          @php $imageArray = array('16'=>'reception-icon.png','17'=>'wedding-invitation-icon.png','18'=>'wedding-favours-icon.png','19'=>'photography-icon.png','20'=>'music-icon.png','21'=>'transportation-icon.png','22'=>'wedding-entertainment-icon.png','23'=>'flowers-decoration-icon.png','24'=>'wedding-planner-icon.png','25'=>'photography-icon.png','26'=>'honeymoon-icon.png'); @endphp
	          @php $iconArray = array('16'=>'icon-tools-vendors-group-white-13','17'=>'icon-tools-vendors-group-white-3','18'=>'icon-tools-vendors-group-white-4','19'=>'icon-tools-vendors-group-white-6','20'=>'icon-tools-vendors-group-white-2','21'=>'icon-tools-vendors-group-white-16','22'=>'icon-tools-vendors-group-white-5','23'=>'icon-tools-vendors-group-white-5','24'=>'icon-tools-vendors-group-white-19','25'=>'icon-tools-vendors-group-white-6','26'=>'icon-tools-vendors-group-white-11'); @endphp
	          @if(isset($data['vendorCats'][2]) && !empty($data['vendorCats'][2]))
	            @foreach($data['vendorCats'][2] as $vendorCat)
	                <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
	                    @if(isset($vendorCat['booked']) && !empty($vendorCat['booked']))
		                	<?php
		                		$bgImage = '';
		                		if(@$vendorCat['booked']['image']) {
		                			$bgImage = asset('public/vendors/'.$vendorCat['booked']['image']);
		                		} else {
		                			$imgNum = 0;
		                			foreach($data['catImages'] as $val) {
		                				if(@$val->cat_id == $vendorCat['id'] && @$val->images != '') {
		                					$bgImage = url('public/images/category_images/'.$val->images);
		                					$imgNum++;
		                				}
		                				if($imgNum == 1) { break; }
		                			}
		                		}
		                	?>
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ={{$vendorCat['id']}}" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools {{$iconArray[$vendorCat['id']] ?? 'icon-tools-vendors-group-white-5'}}"></i>
								<p class="vendors-categBox-title">{{$vendorCat['title']}}</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['child_counter'][$vendorCat['id']] ?? 0}}</span>
								<span class="vendors-categBox-button green app-newlink" data-href="{{url('tools/vendors-category')}}?id_categ={{$vendorCat['id']}}&status=6"><i class="icon-tools icon-tools-check-white mr5"></i> Booked</span>
							</div>
	                    @elseif(isset($vendorCat['nonBooked']) && !empty($vendorCat['nonBooked']))
		                	<?php
		                		$bgImage = '';
		                		if(@$vendorCat['nonBooked']['image']) {
		                			$bgImage = asset('public/vendors/'.$vendorCat['nonBooked']['image']);
		                		} else {
		                			$imgNum = 0;
		                			foreach($data['catImages'] as $val) {
		                				if(@$val->cat_id == $vendorCat['id'] && @$val->images != '') {
		                					$bgImage = url('public/images/category_images/'.$val->images);
		                					$imgNum++;
		                				}
		                				if($imgNum == 1) { break; }
		                			}
		                		}
		                	?>
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ={{$vendorCat['id']}}" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools {{$iconArray[$vendorCat['id']] ?? 'icon-tools-vendors-group-white-5'}}"></i>
								<p class="vendors-categBox-title">{{$vendorCat['title']}}</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['child_counter'][$vendorCat['id']] ?? 0}}</span>
	                            <a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="{{$vendorCat['id']}}" href="javascript:;">
	                            	<i class="icon-tools mr5 icon-tools-search"></i> Search
	                            </a>
							</div>
	                    @else
		                    <div class="vendors-categBox-item app-link" data-href="{{url('tools/vendors-category')}}?id_categ={{$vendorCat['id']}}">
		                    	@if($vendorCat['id'] == 49)
		                    		<i class="svgIcon svgIcon__categCake vendors-categBox-item-icon"><svg viewBox="0 0 54 51"><path d="M28.943 13H47v1.588a8.083 8.083 0 01-1 3.91v11.487h8v1.496a7.806 7.806 0 01-1 3.83V51H1V35.31a7.806 7.806 0 01-1-3.83v-1.495h8V18.5a8.078 8.078 0 01-1-3.912V13h18.202l-4.96-4.961c-.784-.882-1.268-2.066-1.268-3.273A4.74 4.74 0 0123.742 0c1.284 0 2.46.501 3.33 1.365A4.7 4.7 0 0130.404 0a4.74 4.74 0 014.766 4.766c0 1.227-.496 2.41-1.379 3.388L28.943 13zM10 29.985h34v-9.109a7.67 7.67 0 01-4.811 1.69c-2.398 0-4.61-1.151-6.081-3.017-1.445 1.855-3.698 3.017-6.108 3.017-2.398 0-4.608-1.151-6.08-3.018-1.445 1.855-3.698 3.018-6.109 3.018A7.68 7.68 0 0110 20.876v9.109zm-7 7.677V49h48V37.662a8.147 8.147 0 01-5.098 1.78c-2.5 0-4.8-1.14-6.3-3.004a8.086 8.086 0 01-6.302 3.005c-2.5 0-4.8-1.141-6.3-3.006a8.08 8.08 0 01-6.3 3.006 8.086 8.086 0 01-6.302-3.005 8.082 8.082 0 01-6.3 3.005A8.147 8.147 0 013 37.662zm11.811-17.096c2.205 0 4.253-1.332 5.19-3.318l.875-1.854.923 1.83c1.024 2.032 3.02 3.342 5.201 3.342 2.205 0 4.253-1.332 5.19-3.318l.876-1.856.922 1.833c1.021 2.03 3.019 3.341 5.2 3.341 3.082 0 5.593-2.458 5.798-5.566H9.013c.206 3.125 2.734 5.566 5.798 5.566zM8.098 37.443a6.061 6.061 0 005.409-3.29l.891-1.749.891 1.75c1.017 1.996 3.1 3.289 5.411 3.289 2.31 0 4.39-1.292 5.41-3.29l.89-1.746.89 1.746a6.063 6.063 0 005.41 3.29c2.312 0 4.394-1.293 5.41-3.29l.892-1.749.891 1.75a6.061 6.061 0 005.409 3.289c3.19 0 5.814-2.412 6.076-5.458H2.022c.262 3.046 2.886 5.458 6.076 5.458zM32.341 6.777c.53-.588.829-1.302.829-2.01A2.74 2.74 0 0030.404 2c-1.046 0-1.954.563-2.448 1.496l-.884 1.67-.884-1.67C25.694 2.562 24.787 2 23.742 2a2.74 2.74 0 00-2.768 2.766c0 .698.294 1.416.723 1.901l5.375 5.375 5.269-5.265z" fill-rule="nonzero"></path></svg></i>
		                    	@elseif($vendorCat['id'] == 50)
		                    		<i class="svgIcon svgIcon__categFlower vendors-categBox-item-icon"><svg viewBox="0 0 34 54"><path d="M1.262 19.007a15.769 15.769 0 01-.262-2.7V5a1 1 0 011-1c3.282 0 6.336 1 8.878 2.709A27.672 27.672 0 0116.343.246a1 1 0 011.314 0 27.673 27.673 0 015.464 6.462c.18-.112.361-.22.545-.326A15.792 15.792 0 0132 4a1 1 0 011 1v11.32c-.074 6.59-4.225 12.225-10.06 14.546a15.496 15.496 0 01-4.94 1.24V43.37a17.164 17.164 0 012.44-3.202c3.326-3.533 7.89-5.348 12.59-5.154l.922.038.035.923c.181 4.698-1.553 9.434-4.798 12.977-3.173 3.194-7.3 4.952-11.679 5.048h-.85c-4.363 0-8.506-1.764-11.68-5.049C1.572 45.516-.173 40.813.013 35.975l.037-.942.942-.02c4.693-.097 9.242 1.712 12.56 5.146.948.98 1.765 2.073 2.448 3.256V32.14C8.57 31.797 2.468 26.23 1.262 19.007zm15.611-4.878a15.757 15.757 0 014.618-6.252A25.576 25.576 0 0017 2.346a25.567 25.567 0 00-4.525 5.588 16.15 16.15 0 014.398 6.195zm5.013 27.42c-1.99 2.059-3.348 4.614-3.907 7.34L17.341 52h.147c3.842-.085 7.475-1.633 10.254-4.429a16.353 16.353 0 004.254-10.567c-3.785.091-7.402 1.668-10.11 4.544zm-5.86 7.366c-.667-2.85-1.99-5.376-3.912-7.366-2.696-2.79-6.314-4.363-10.11-4.525.084 3.946 1.615 7.716 4.405 10.528C9.216 50.457 12.839 52 16.66 52h.089l-.723-3.085zM18 20.015c0 1.334-2 1.334-2 0 0-7.35-5.75-13.46-13-13.98v10.262C3.085 23.864 9.338 30 17 30c7.663 0 13.915-6.136 14-13.692V6.036c-7.2.525-13 6.662-13 13.98z" fill-rule="nonzero"></path></svg></i>
		                    	@elseif($vendorCat['id'] == 51)
		                    		<i class="svgIcon svgIcon__categBand vendors-categBox-item-icon"><svg viewBox="0 0 55 41"><path d="M18.635 4.636a9.002 9.002 0 000 12.728 8.992 8.992 0 0012.722 0 9.004 9.004 0 000-12.729 8.994 8.994 0 00-12.722 0zm14.137-1.414c4.293 4.296 4.293 11.26 0 15.556-4.294 4.296-11.257 4.296-15.551 0-4.295-4.297-4.295-11.26 0-15.556 4.294-4.296 11.257-4.296 15.55 0zM45 26v-3.465a4 4 0 11-4 6.93 4 4 0 014-6.93V6.558l9.014 3.372-.145 7.075L47 14.195V26h-2a2 2 0 10-3.999-.002A2 2 0 0045 26zM2.877 34.27a8.29 8.29 0 00-.229.404c-.398.75-.636 1.485-.648 2.12-.015.903.42 1.569 1.584 2.066 1.248.532 1.547.393 7.754-3.224 4.299-2.505 7.515-3.7 11.178-3.634 3.042.054 5.307 1.278 6.849 3.267.942 1.217 1.43 2.43 1.613 3.284l-1.956.42a5.104 5.104 0 00-.244-.738 7.269 7.269 0 00-.994-1.74c-1.183-1.528-2.891-2.45-5.303-2.493-3.21-.058-6.127 1.026-10.136 3.362-.529.308-2.278 1.356-2.565 1.524-.974.573-1.702.97-2.387 1.288-1.83.852-3.28 1.084-4.593.523-1.912-.815-2.83-2.22-2.8-3.94.018-1 .349-2.018.881-3.022.21-.397.421-.736.605-1.003A4.153 4.153 0 011 30.78v-.297c0-.97.34-1.91.962-2.663l12.776-15.457 1.541 1.274L3.503 29.095A2.18 2.18 0 003 30.483v.297c0 1.132.879 2.088 2.048 2.207a2.334 2.334 0 001.702-.499l15.622-12.595 1.256 1.557L8.005 34.045a4.333 4.333 0 01-3.163.932 4.314 4.314 0 01-1.965-.706zM15.274 2.689l1.452-1.376 18 19-1.452 1.376-18-19zM51.929 14.05l.057-2.745L47 9.442v2.592l4.93 2.017z" fill-rule="nonzero"></path></svg></i>
		                    	@elseif($vendorCat['id'] == 52)
		                    		<i class="svgIcon svgIcon__categReception vendors-categBox-item-icon"><svg viewBox="0 0 54 41"><path d="M4 19.421l-2.401 1.795A1 1 0 01.4 19.614L25.868.584a1 1 0 01.751-.324 1 1 0 01.751.324l25.467 19.03a1 1 0 01-1.198 1.602L48 18.496V41H4V19.421zm2-1.494V39h12V21h16v18h12V17.002L26.619 2.519 6 17.927zM32 39V23H20v16h12z" fill-rule="nonzero"></path></svg></i>
		                    	@elseif($vendorCat['id'] == 53)
		                    		<i class="svgIcon svgIcon__categMore vendors-categBox-item-icon"><svg viewBox="0 0 54 54"><path d="M54 27c0 14.912-12.088 27-27 27S0 41.912 0 27 12.088 0 27 0s27 12.088 27 27zm-2 0C52 13.192 40.808 2 27 2S2 13.192 2 27s11.192 25 25 25 25-11.192 25-25zm-32.182 0a3.416 3.416 0 11-6.832 0 3.416 3.416 0 016.832 0zm-2 0a1.416 1.416 0 10-2.832 0 1.416 1.416 0 002.832 0zm12.113 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0zm13.084 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0z" fill-rule="nonzero"></path></svg></i>
		                    	@elseif($vendorCat['id'] == 54)
		                    		<i class="svgIcon svgIcon__categPhoto vendors-categBox-item-icon"><svg viewBox="0 0 54 40"><path d="M14.628 17.998H2V37.47c0 .303.236.53.592.53h48.816c.356 0 .592-.227.592-.53V17.998H39.372A12.99 12.99 0 0140 22c0 7.18-5.82 13-13 13s-13-5.82-13-13c0-1.397.22-2.742.628-4.002zm.838-2A12.999 12.999 0 0127 9c5.015 0 9.366 2.84 11.534 6.998H52V6.53c0-.303-.236-.53-.592-.53H2.592C2.236 6 2 6.227 2 6.53v9.468zM7 4V2.292C7 1.02 8.06 0 9.344 0h6.312C16.94 0 18 1.02 18 2.292V4h33.408C52.85 4 54 5.104 54 6.53v30.94c0 1.426-1.149 2.53-2.592 2.53H2.592C1.15 40 0 38.896 0 37.47V6.53C0 5.104 1.149 4 2.592 4zm2 0h7V2.292c0-.15-.148-.292-.344-.292H9.344C9.148 2 9 2.142 9 2.292zm31 10a1 1 0 01-1-1V9.032a1 1 0 011-1h8a1 1 0 011 1V13a1 1 0 01-1 1zm7-2v-1.968h-6V12zm-20-1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm.029 4c3.88 0 7.029 3.133 7.029 7 0 3.868-3.148 7-7.03 7C23.149 29 20 25.868 20 22c0-3.867 3.148-7 7.029-7zm0 2C24.25 17 22 19.24 22 22s2.25 5 5.029 5c2.778 0 5.029-2.24 5.029-5s-2.25-5-5.03-5z"></path></svg></i>
		                    	@else
	                            	<img src="{{url('public/images')}}/{{$imageArray[$vendorCat['id']] ?? ''}}" alt="{{$vendorCat['title']}}">
	                            @endif
	                            <p class="vendors-categBox-title">{{$vendorCat['title']}}</p>
	                            <a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="{{$vendorCat['id']}}" href="javascript:;">
		                            <i class="icon-tools mr5 icon-tools-search"></i> Search
		                        </a>
		                    </div>
	                    @endif
	                </div>
	                @php $vendorcount++; @endphp
	            @endforeach
	          @endif
	          <!-- Add Other Vendors -->
	          @php $vendorFound2 = 0; @endphp
	          @if(isset($data['vendorCats'][3]) && !empty($data['vendorCats'][3]))
	            @foreach($data['vendorCats'][3] as $vendorCat)
	                @if(isset($vendorCat['booked']) && !empty($vendorCat['booked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['booked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['booked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 3 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=3" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
							<i class="icon-tools icon-tools-vendors-group-white-9"></i>
							<p class="vendors-categBox-title">Bridal Accessories</p>
							<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][3] ?? 0}}</span>
							<span class="vendors-categBox-button green app-newlink" data-href="{{url('tools/vendors-category')}}?id_categ=3&status=6"><i class="icon-tools icon-tools-check-white mr5"></i> Booked</span>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound2 = 1; break; @endphp
	                @endif
	                @if(isset($vendorCat['nonBooked']) && !empty($vendorCat['nonBooked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['nonBooked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['nonBooked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 1 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=3" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools icon-tools-vendors-group-white-1"></i>
								<p class="vendors-categBox-title">Bridal Accessories</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][3] ?? 0}}</span>
								<a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="3" href="javascript:;">
                            <i class="icon-tools mr5 icon-tools-search"></i> Search</a>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound2 = 1; break; @endphp
	                @endif
	            @endforeach
	            @if(!$vendorFound2)
                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
	                    <div class="vendors-categBox-item app-link" data-href="{{url('tools/vendors-category')}}?id_categ=3">
	                        <i class="icon-tools icon-tools-vendors-group-9"></i>
	                        <p class="vendors-categBox-title">Bridal Accessories</p>
	                        <a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="3" href="javascript:;">
                            <i class="icon-tools mr5 icon-tools-search"></i> Search</a>
	                    </div>
		            </div>
		            @php $vendorcount++; @endphp
	            @endif
	          @endif
	          @php $vendorFound1 = 0; @endphp
	          @if(isset($data['vendorCats'][4]) && !empty($data['vendorCats'][4]))
	            @foreach($data['vendorCats'][4] as $vendorCat)
	                @if(isset($vendorCat['booked']) && !empty($vendorCat['booked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['booked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['booked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 4 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=4" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
							<i class="icon-tools icon-tools-vendors-group-white-10"></i>
							<p class="vendors-categBox-title">Groom's Accessories</p>
							<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][4] ?? 0}}</span>
							<span class="vendors-categBox-button green app-newlink" data-href="{{url('tools/vendors-category')}}?id_categ=4&status=6"><i class="icon-tools icon-tools-check-white mr5"></i> Booked</span>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound1 = 1; break; @endphp
	                @endif
	                @if(isset($vendorCat['nonBooked']) && !empty($vendorCat['nonBooked']))
	                	<?php
	                		$bgImage = '';
	                		if(@$vendorCat['nonBooked']['image']) {
	                			$bgImage = asset('public/vendors/'.$vendorCat['nonBooked']['image']);
	                		} else {
	                			$imgNum = 0;
	                			foreach($data['catImages'] as $val) {
	                				if(@$val->cat_id == 1 && @$val->images != '') {
	                					$bgImage = url('public/images/category_images/'.$val->images);
	                					$imgNum++;
	                				}
	                				if($imgNum == 1) { break; }
	                			}
	                		}
	                	?>
	                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
							<div class="vendors-categBox-item booked app-link" data-href="{{url('tools/vendors-category')}}?id_categ=4" onclick="Frontend.vendorSearhList(this)" style="background:url({{$bgImage}}) no-repeat scroll 50% 50% transparent;background-size:cover;">
								<i class="icon-tools icon-tools-vendors-group-white-1"></i>
								<p class="vendors-categBox-title">Groom's Accessories</p>
								<span class="vendors-categBox-button black"><i class="icon-tools icon-tools-heart-white mr5"></i>{{$data['parent_counter'][4] ?? 0}}</span>
								<a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="4" href="javascript:;">
                            <i class="icon-tools mr5 icon-tools-search"></i> Search</a>
							</div>
	                    </div>
	                    @php $vendorcount++; $vendorFound1 = 1; break; @endphp
	                @endif
	            @endforeach
	            @if(!$vendorFound1)
                    <div class="@if($vendorcount < 8) pure-u-1-4 @else pure-u-1-5 @endif vendors-categBox-separator">
	                    <div class="vendors-categBox-item app-link" data-href="{{url('tools/vendors-category')}}?id_categ=4">
	                        <i class="icon-tools icon-tools-vendors-group-10"></i>
	                        <p class="vendors-categBox-title">Groom's Accessories</p>
	                        <a class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="4" href="javascript:;">
                            <i class="icon-tools mr5 icon-tools-search"></i> Search</a>
	                    </div>
		            </div>
		            @php $vendorcount++; @endphp
	            @endif
	          @endif
        </div>
	</div>
<style>
.vendors-categBox-item .vendors-categBox-item-icon {
    width: 62px;
    height: 55px;
    position: relative;
    fill: #656565;
}
.icon-tools-search::before {
    background-position: -76px -76px;
    height: 17px;
    width: 17px;
}
</style>
</section>
@include('includes.search_vendor_popup')
@include('includes.error_popup')
@include('includes.footer')
<script>
$(document).ready(function(){
    $(".app-link a").click(function(e) {
		e.stopPropagation();
		var catId = $(this).attr('data-cat-id');
		$('#myModalSearchVendor').modal('show');
		$('#search_cat_id').val(catId);
	});
    $(".app-link, .app-newlink").click(function(e) {
		e.stopPropagation();
		var newUrl = $(this).attr('data-href');
		window.location.href = newUrl;
	});
    $('body').on('click','.app-link', function(){
        var curUrl = $(this).attr('data-href');
        window.location.href = curUrl;
    });
});
</script>
@endsection