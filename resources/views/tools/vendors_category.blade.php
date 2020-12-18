@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
  <section class="section-padding dashboard-wrap">
      @include('tools.tools_nav');   
		<div class="wrapper">
        <div class="pure-g">
            <div class="pure-u-1-5">
                <div class="app-search-tags mr35 mt10">
					<p class="tools-subtitle">Your search</p>
					<ul class="directory-search-tags">
					    @if($data['cat_id'])
						    <li class="app-tag-filter-category tag-filter app-link" data-href="tools/vendors-category?id_categ=&amp;status={{$data['status']}}" onclick="Frontend.redirectVendorSearch(this)">
						    	<span>{{$data['search_cat']}}</span>
						    </li>
					    @endif
					    @if($data['status'])
					    	@php $statusValArray = array('1'=>'Not available','2'=>'Discarded','3'=>'Evaluating','4'=>'Preselection','5'=>'Negotiation','6'=>'Reserved'); @endphp
						    <li class="app-tag-filter-category tag-filter app-link" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=" onclick="Frontend.redirectVendorSearch(this)">
						    	<span>{{$statusValArray[$data['status']]}}</span>
						    </li>
					    @endif
					</ul>
                </div>
				<div class="app-filter-vendor-category mr35 mt20">
				    <p class="tools-subtitle">By Category</p>
				    <ul class="tools-filters">
			            <li class="tools-filters-item @if($data['cat_id']==1) current @endif" data-href="tools/vendors-category?id_categ=1&amp;status={{$data['status']}}" data-id-categ="1" onclick="Frontend.vendorSearhList(this)">
			                <span class="tools-filters-item-name">Reception</span>
			                <span class="tools-filters-item-count app-num-dress" data-count="1">{{$data['sideBar']['parent_counter'][1] ?? 0}}</span>
			            </li>
			            @if(isset($data['sideBar']['vendorCats'][2]) && !empty($data['sideBar']['vendorCats'][2]))
			              @foreach($data['sideBar']['vendorCats'][2] as $catV)
				            <li class="tools-filters-item @if($data['cat_id'] == $catV['id']) current @endif" data-href="tools/vendors-category?id_categ={{$catV['id']}}&amp;status={{$data['status']}}" data-id-categ="{{$catV['id']}}" onclick="Frontend.vendorSearhList(this)">
				                <span class="tools-filters-item-name">{{str_replace('Wedding',' ',$catV['title'])}}</span>
				                <span class="tools-filters-item-count app-num-dress" data-count="1">{{$data['sideBar']['child_counter'][$catV['id']] ?? 0}}</span>
				            </li>
				          @endforeach
			            @endif
			            <li class="tools-filters-item @if($data['cat_id']==3) current @endif" data-href="tools/vendors-category?id_categ=3&amp;status={{$data['status']}}" data-id-categ="3" onclick="Frontend.vendorSearhList(this)">
			                <span class="tools-filters-item-name">Bridal Accessories</span>
			                <span class="tools-filters-item-count app-num-dress" data-count="1">{{$data['sideBar']['parent_counter'][3] ?? 0}}</span>
			            </li>
			            <li class="tools-filters-item @if($data['cat_id']==4) current @endif" data-href="tools/vendors-category?id_categ=4&amp;status={{$data['status']}}" data-id-categ="4" onclick="Frontend.vendorSearhList(this)">
			                <span class="tools-filters-item-name">Groom's Accessories</span>
			                <span class="tools-filters-item-count app-num-dress" data-count="1">{{$data['sideBar']['parent_counter'][4] ?? 0}}</span>
			            </li>
			        </ul>
				</div>
				<div class="app-filter-vendor-status mr35 mt20">
			    <p class="tools-subtitle">Status</p>
					<ul class="tools-filters tools-filters-bullets app-filter-status">
						@if(isset($data['status_counter'][1]))<li class="tools-filters-item app-link tools-filters-item-red @if($data['status'] == 1) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=1" data-status="1" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Not available</span>
						    <span class="tools-filters-item-count" data-count="0">{{$data['status_counter'][1] ?? 0}}</span>
						</li> @endif
						        @if(isset($data['status_counter'][2]))<li class="tools-filters-item app-link tools-filters-item-red @if($data['status'] == 2) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=2" data-status="2" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Discarded</span>
						    <span class="tools-filters-item-count" data-count="0">{{$data['status_counter'][2] ?? 0}}</span>
						</li> @endif
						       @if(isset($data['status_counter'][3])) <li class="tools-filters-item app-link tools-filters-item-orange  @if($data['status'] == 3) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=3" data-status="3" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Evaluating</span>
						    <span class="tools-filters-item-count" data-count="3">{{$data['status_counter'][3] ?? 0}}</span>
						</li> @endif
						        @if(isset($data['status_counter'][4]))<li class="tools-filters-item app-link tools-filters-item-orange @if($data['status'] == 4) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=4" data-status="4" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Preselection</span>
						    <span class="tools-filters-item-count" data-count="0">{{$data['status_counter'][4] ?? 0}}</span>
						</li> @endif
						        @if(isset($data['status_counter'][5]))<li class="tools-filters-item app-link tools-filters-item-orange @if($data['status'] == 5) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=5" data-status="5" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Negotiation</span>
						    <span class="tools-filters-item-count" data-count="0">{{$data['status_counter'][5] ?? 0}}</span>
						</li> @endif
						        @if(isset($data['status_counter'][6]))<li class="tools-filters-item app-link tools-filters-item-green @if($data['status'] == 6) current @endif" data-href="tools/vendors-category?id_categ={{$data['cat_id']}}&amp;status=6" data-status="6" onclick="Frontend.vendorSearhList(this)">
						    <span class="tools-filters-item-name">Reserved</span>
						    <span class="tools-filters-item-count" data-count="2">{{$data['status_counter'][6] ?? 0}}</span>
						</li> @endif
					</ul>
                </div>            
            </div>
            <div class="pure-u-4-5">
                <div class="pure-g mb20">
                    <div class="pure-u-1-2">
                        <h1 class="tools-title tools-title-inline">{{$data['search_cat']}}</h1>
                        <span class="count app-tools-vendors-categ-count" data-count="{{count($data['vendors']) ?? 0}}">
				            <div class="tools-vendors-header-item mt10">
				                <ul class="tools-toggle">
				                    <a role="button" href="javascript:;" class="tools-toggle-item active">
				                        <i class="icon icon-fav-on-border mr10 fixicon"></i> Saved
				                        <span class="count">{{count($data['vendors']) ?? 0}}</span>
				                    </a>
				                </ul>
				            </div>
                        </span>
                    </div>
                    <div class="pure-u-1-2 tools-header-actionContainer">
		                <a href="{{url('tools/vendors')}}" style="display:block;margin:-30px 0px 20px;">
		                    <i class="icon-header icon-header-arrow-left icon-left"></i>
		                    <span class="title upper color-grey app-link" data-href="{{url('vendors')}}">Go back</span>
		                </a>
                    	<a class="pointer tools-toggle-action btn-flat red app-add-vendor-modal app-top-btn" href="#" role="button" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="{{$data['cat_id'] ?? 2}}">Add Vendor</a>
                    </div>
                </div>
                @if(Session::has('message'))
                   {!!Session::get('message')!!}
                @endif
                <hr>
                <div class="app-tools-vendors-categ-detail">
                	<div class="app-success-box alert alert-success dnone"></div>
                    <div id="myvendors-category" class="pure-g vendors-saved">
                      @if(isset($data['vendors']) && !empty($data['vendors']))
                        @foreach($data['vendors'] as $vdata)
                        @php 
                           	$imageUlr = URL::asset('public/vendors/no-photo.png');
                           	$ratingCounter = 0;
                           	$avgRating = 0;
                           	if(isset($vdata->image_date[0]['image'])){
                           		$imageUlr = URL::asset('public/vendors').'/'.$vdata->image_date[0]['vendor_folder'].'/'.$vdata->image_date[0]['image'];
                           	}
                           	if(isset($vdata->rating_data) && count($vdata->rating_data) >= 1){ $ratingCounter = count($vdata->rating_data);
                                $avgRating = array_sum(array_column($vdata->rating_data,'average_rating'))/count($vdata->rating_data);
                            }
                        @endphp
	                    <?php
	                    	$imgNum = 0;
	                        foreach($data['catImages'] as $val) {
								if((@$val->cat_id == $vdata->cat_id || @$val->cat_id == $vdata->cat_parent_id) && @$val->images != '') {
									$imageUlr = url('public/images/category_images/'.$val->images);
									$imgNum++;
								}
								if($imgNum == 1) { break; }
	                        }
	                    ?>
						<div class="pure-u-1-3 app-vendors-container app-tools-vendors-after-banner" data-filtervalue="6">
							<div class="app-tools-vendors-modif vendors-item" data-id-empresa="9513" data-id-escaparate="" data-listed="1" data-categ="116">
								<figure class="vendors-item-header app-link" >
									<i class="vendors-item-remove icon-tools icon-tools-times-white" data-booked-id="{{$vdata->id}}" onclick="Frontend.deleteSavedVendor(this)"></i>
									<img class="app_toolsVendorsEdit" style="width:100%" data-id-empresa="9513" src="{{$imageUlr}}" alt="{{$vdata->business_name}}" >
									<figcaption class="vendors-item-header-info" data-href="{{$vdata->cat_parent_slug}}/{{$vdata->cat_slug}}/{{$vdata->business_name_slug}}" onclick="Frontend.vendorSearhList(this)">
										<p class="vendors-item-header-categ">{{$vdata->cat_name}}</p>
										<p class="vendors-item-header-title">{{$vdata->business_name}}</p>
										<p class="vendors-item-header-location">{{$vdata->city}}</p>
									</figcaption>
								</figure>
							<div class="vendors-item-content">
							<div class="pure-g">
							<div class="vendors-item-select pure-u-1 active">
							<i class="app-tools-vendor-statuslabel vendors-item-select-icon icon-tools icon-tools-checkbox-white-small"></i>
									<select name="Status" class="app-tools-vendors-select-status @if($vdata->book_status == 6) new-reserved @endif" data-valid="" data-id="{{$vdata->id}}" onchange="Frontend.updateSavedVendor(this)">
									<option value="1" @if($vdata->book_status == 1) selected @endif >Not available</option>
									<option value="2" @if($vdata->book_status == 2) selected @endif >Discarded</option>
									<option value="3" @if($vdata->book_status == 3) selected @endif >Evaluating</option>
									<option value="4" @if($vdata->book_status == 4) selected @endif >Preselection</option>
									<option value="5" @if($vdata->book_status == 5) selected @endif >Negotiation</option>
									<option value="6" @if($vdata->book_status == 6) selected @endif >Reserved</option>
									</select>
			 				<i class="vendors-item-select-caret icon icon-caret-down-white"></i>
							</div>
							</div>
							<div class="pure-g">
							<div class="pure-u-3-5">
							<div class="vendors-item-rating">
							<p class="input-group-line-label block">
							<span class="app-tools-vendors-rating-text">User Ratings</span>
							</p>
							<div class="star-holder inline">
							 <div class="readOnly" data-score="{{$avgRating}}"><span style="float: right;">&nbsp; ({{$ratingCounter}}) </span> </div>
                             </div>                             
							</div>
							</div>
							<div class="pure-u-2-5">
							<div class="app-tools-vendors-change-price vendors-item-price">
							<p class="input-group-line-label block">Price</p>
							<input class="app-vendors-item-price-edit-value" placeholder="0" type="hidden" name="Precio" value="0">
							<span class="vendors-item-price-currency">C$ </span>
							<input class="app-vendors-item-price-edit vendors-item-price-edit" onblur="Frontend.saveAddNoteData(this)" data-field="price" data-id="{{$vdata->id}}" placeholder="0" type="text" name="PrecioTexto" value="{{$vdata->price}}" style="width: 9px;">
							</div>
							</div>
							</div>
							<div class="app-vendors-note-main vendors-item-note">
			                        <span class="app-vendors-note app-vendors-note-add vendors-item-note-empty">
			                        <span class="icon-tools-note mr10 fa fa-file-text"></span>Add note</span>
			                        <textarea name="add_note" onblur="Frontend.saveAddNoteData(this)" data-field="add_note" data-id="{{$vdata->id}}" class="form-control">{{$vdata->add_note}}</textarea>
			                </div>
							<div id="app-emp-phone-9513" class="vendors-item-dropdown pure-u-1"></div>
							</div>
							<footer class="vendors-item-footer">
								<!-- <div class="vendors-item-footer-section">
									<a class="vendors-item-footer-action" id="app-emp-phone-9513-txt" role="button" data-visible="false" onclick="tools_showTelefonoTrace('9513')">
									<i class="icon-tools icon-tools-phone"></i> Phone number </a>
								</div> -->
								<div class="vendors-item-footer-section">
									<a class="vendors-item-footer-action app-ua-track-event" role="button" onclick="Frontend.setRequestForm({{$vdata->business_id}})" data-toggle="modal" data-target="#myModal">
									<i class="icon-tools icon-tools-envelope icon-left"></i> Contact us </a>
								</div>
							</footer>
							</div>
						</div>
                      @endforeach
                   	@else
	                   <div class="pure-u-1 text-center">
		                    <div class="pt40 pb20">
				                <i class="svgIcon svgIcon__categReception tools-noResult-icon">
		                    	@if($data['cat_id'] == 1 || $data['cat_id'] == 52)
				                	<svg viewBox="0 0 54 41"><path d="M4 19.421l-2.401 1.795A1 1 0 0 1 .4 19.614L25.868.584a1 1 0 0 1 .751-.324 1 1 0 0 1 .751.324l25.467 19.03a1 1 0 0 1-1.198 1.602L48 18.496V41H4V19.421zm2-1.494V39h12V21h16v18h12V17.002L26.619 2.519 6 17.927zM32 39V23H20v16h12z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 16)
				                	<svg viewBox="0 0 50 33"><path d="M39.678 28.996v-.004c-.216.01-.431.01-.647.003V29H.995L1 27.995c.063-11.97 8.762-21.843 20.165-23.686A2.796 2.796 0 0 1 21 3.374C21 1.476 22.864 0 25 0s4 1.476 4 3.374c0 .308-.054.614-.155.907a24.195 24.195 0 0 1 17.82 12.85 10.076 10.076 0 0 1 2.385-.102l.856.065.065.856a10.398 10.398 0 0 1-1.366 5.945c.258 1.483.395 2.82.395 4.105v1H39.678v-.004zm5.008-11.331A22.181 22.181 0 0 0 25.156 6C13.29 5.936 3.611 15.238 3.028 27H33.96a8.646 8.646 0 0 1-.497-.459c-1.784-1.783-2.66-4.2-2.426-6.606l.08-.82.82-.079c2.411-.23 4.831.642 6.63 2.437.271.284.522.583.75.896a10.06 10.06 0 0 1 1.743-2.368 10.614 10.614 0 0 1 3.626-2.336zM46.9 26.13a9.93 9.93 0 0 1-1.019.869h1.09c-.017-.284-.04-.573-.07-.869zM25.054 4h1.69c.163-.2.256-.429.256-.626C27 2.696 26.12 2 25 2s-2 .696-2 1.374c0 .197.093.426.257.626h1.797zm9.823 21.127c1.135 1.133 2.597 1.781 4.104 1.864a6.713 6.713 0 0 0-1.843-4.118c-1.141-1.14-2.614-1.788-4.13-1.865.077 1.51.727 2.978 1.87 4.119zm7.592-3.707a7.97 7.97 0 0 0-1.929 3.183c.27.722.42 1.483.465 2.3 1.749-.26 3.346-1.038 4.582-2.286 1.491-1.554 2.334-3.57 2.408-5.612-2.033.073-3.985.91-5.526 2.415zM0 33v-2h50v2H0z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 19 || $data['cat_id'] == 25 || $data['cat_id'] == 54)
				                	<svg viewBox="0 0 54 40"><path d="M14.628 17.998H2V37.47c0 .303.236.53.592.53h48.816c.356 0 .592-.227.592-.53V17.998H39.372A12.99 12.99 0 0 1 40 22c0 7.18-5.82 13-13 13s-13-5.82-13-13c0-1.397.22-2.742.628-4.002zm.838-2A12.999 12.999 0 0 1 27 9c5.015 0 9.366 2.84 11.534 6.998H52V6.53c0-.303-.236-.53-.592-.53H2.592C2.236 6 2 6.227 2 6.53v9.468zM7 4V2.292C7 1.02 8.06 0 9.344 0h6.312C16.94 0 18 1.02 18 2.292V4h33.408C52.85 4 54 5.104 54 6.53v30.94c0 1.426-1.149 2.53-2.592 2.53H2.592C1.15 40 0 38.896 0 37.47V6.53C0 5.104 1.149 4 2.592 4zm2 0h7V2.292c0-.15-.148-.292-.344-.292H9.344C9.148 2 9 2.142 9 2.292zm31 10a1 1 0 0 1-1-1V9.032a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1V13a1 1 0 0 1-1 1zm7-2v-1.968h-6V12zm-20-1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm.029 4c3.88 0 7.029 3.133 7.029 7 0 3.868-3.148 7-7.03 7C23.149 29 20 25.868 20 22c0-3.867 3.148-7 7.029-7zm0 2C24.25 17 22 19.24 22 22s2.25 5 5.029 5c2.778 0 5.029-2.24 5.029-5s-2.25-5-5.03-5z"></path></svg>
				                @elseif($data['cat_id'] == 20 || $data['cat_id'] == 51)
				                	<svg viewBox="0 0 55 41"><path d="M18.635 4.636a9.002 9.002 0 0 0 0 12.728 8.992 8.992 0 0 0 12.722 0 9.004 9.004 0 0 0 0-12.729 8.994 8.994 0 0 0-12.722 0zm14.137-1.414c4.293 4.296 4.293 11.26 0 15.556-4.294 4.296-11.257 4.296-15.551 0-4.295-4.297-4.295-11.26 0-15.556 4.294-4.296 11.257-4.296 15.55 0zM45 26v-3.465A4 4 0 1 1 43 22c.729 0 1.412.195 2 .535V6.558l9.014 3.372-.145 7.075L47 14.195V26h-2a2 2 0 1 0-3.999-.002A2 2 0 0 0 45 26zM2.877 34.27a8.29 8.29 0 0 0-.229.404c-.398.75-.636 1.485-.648 2.12-.015.903.42 1.569 1.584 2.066 1.248.532 1.547.393 7.754-3.224 4.299-2.505 7.515-3.7 11.178-3.634 3.042.054 5.307 1.278 6.849 3.267.942 1.217 1.43 2.43 1.613 3.284l-1.956.42a5.104 5.104 0 0 0-.244-.738 7.269 7.269 0 0 0-.994-1.74c-1.183-1.528-2.891-2.45-5.303-2.493-3.21-.058-6.127 1.026-10.136 3.362-.529.308-2.278 1.356-2.565 1.524-.974.573-1.702.97-2.387 1.288-1.83.852-3.28 1.084-4.593.523-1.912-.815-2.83-2.22-2.8-3.94.018-1 .349-2.018.881-3.022.21-.397.421-.736.605-1.003A4.153 4.153 0 0 1 1 30.78v-.297c0-.97.34-1.91.962-2.663l12.776-15.457 1.541 1.274L3.503 29.095A2.18 2.18 0 0 0 3 30.483v.297c0 1.132.879 2.088 2.048 2.207a2.334 2.334 0 0 0 1.702-.499l15.622-12.595 1.256 1.557L8.005 34.045a4.333 4.333 0 0 1-3.163.932 4.314 4.314 0 0 1-1.965-.706zM15.274 2.689l1.452-1.376 18 19-1.452 1.376-18-19zM51.929 14.05l.057-2.745L47 9.442v2.592l4.93 2.017z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 21)
				                	<svg viewBox="0 0 55 36"><path d="M2 25.023c.05-.008.1-.012.153-.012h7.914a7.547 7.547 0 0 1 6.779-4.224 7.55 7.55 0 0 1 6.719 4.101h9.593a7.55 7.55 0 0 1 6.72-4.101 7.547 7.547 0 0 1 6.716 4.101h6.084v-6.497c0-.73-.149-1.447-.438-2.11L46.795 3.718A2.858 2.858 0 0 0 44.174 2H3.138A1.14 1.14 0 0 0 2 3.139v21.884zM2 27v1.333c0 .665.54 1.206 1.206 1.206h6.187a7.612 7.612 0 0 1 .02-2.528h-7.26c-.052 0-.103-.004-.153-.011zm8.009 4.539H3.206A3.206 3.206 0 0 1 0 28.333V3.139a3.14 3.14 0 0 1 3.138-3.14h41.036a4.859 4.859 0 0 1 4.455 2.924l5.446 12.56a7.28 7.28 0 0 1 .603 2.908v9.846a3.304 3.304 0 0 1-3.302 3.302h-4.662a7.547 7.547 0 0 1-6.837 4.346 7.55 7.55 0 0 1-6.838-4.346h-9.354a7.55 7.55 0 0 1-6.839 4.346 7.547 7.547 0 0 1-6.837-4.346zm37.32-2h4.047c.718 0 1.302-.585 1.302-1.302v-1.349h-5.391a7.59 7.59 0 0 1 .043 2.65zm-35.736.588c.023.049.04.1.055.152a5.55 5.55 0 1 0 10.423-3.82.994.994 0 0 1-.166-.41 5.551 5.551 0 0 0-10.312 4.078zm12.665-3.239a7.585 7.585 0 0 1 .043 2.65h8.122a7.607 7.607 0 0 1 .043-2.65h-8.208zm9.926-19.885H22.54v5.524h11.643V7.003zm2 .041v5.767l1.08.813 1.147.86.514.386c.116.086.553.23.7.23h6.027a2831.413 2831.413 0 0 0-1.59-3.625l-.028-.062A660.403 660.403 0 0 0 42.524 8c-.176-.392-.32-.712-.432-.957h-5.908zm-15.643-.04H9.03v5.523h11.512V7.003zm14.504 7.453v.07H7.03V5.003h28.016v.041h7.674c.97.514.97.514.896.548l.063.123c.039.08.091.191.158.335.123.266.295.647.513 1.134.383.855.899 2.022 1.516 3.423l.027.063a1914.415 1914.415 0 0 1 2.205 5.03l.612 1.4h-9.084c-.576 0-1.431-.282-1.895-.627l-.518-.388a1306.421 1306.421 0 0 1-2.167-1.628zM19.071 28.335a2.222 2.222 0 0 1-2.224 2.222 2.222 2.222 0 1 1 0-4.444c1.228 0 2.224.994 2.224 2.222zm-2 0c0-.122-.1-.222-.224-.222a.222.222 0 1 0 0 .444c.124 0 .224-.099.224-.222zm22.806-5.548a5.549 5.549 0 1 0-.002 11.097 5.549 5.549 0 0 0 .002-11.097zm2.223 5.548a2.224 2.224 0 1 1-4.448 0 2.224 2.224 0 0 1 4.448 0zm-2 0a.22.22 0 0 0-.222-.222c-.126 0-.226.1-.226.222s.1.222.226.222a.22.22 0 0 0 .222-.222z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 17)
				                	<svg viewBox="0 0 50 51"><path d="M45 22.32V9.19C45 8.54 44.444 8 43.748 8H6.252C5.556 8 5 8.54 5 9.19v13.058l20.398 12.324L45 22.321zm2-1.25l.553-.345-.553-.461v.807zm1 1.734L27.317 35.731 48 48.227V22.804zM3 21.04v-.776l-.54.45.54.326zM45.411 49L2 22.773V49h43.411zM3 17.66V9.19C3 7.423 4.463 6 6.252 6h9.978l5.589-4.868C22.546.402 23.564 0 24.656 0c1.13 0 2.125.34 2.783 1.004L33.245 6h10.503C45.537 6 47 7.423 47 9.19v8.47l3 2.5V51H0V20.16l3-2.5zM19.274 6H30.18L26.08 2.468C25.777 2.166 25.293 2 24.656 2c-.572 0-1.078.2-1.472.592L19.274 6zm8.819 8C30.248 14 32 15.78 32 18.008a4 4 0 0 1-1.14 2.803l-4.636 4.878a1 1 0 0 1-1.443.006l-4.766-4.935A4.306 4.306 0 0 1 19 18.008C19 15.813 20.72 14 22.907 14c.968 0 1.891.37 2.593.999A3.904 3.904 0 0 1 28.093 14zm1.323 5.428c.382-.396.584-.883.584-1.42 0-1.13-.864-2.008-1.907-2.008a1.91 1.91 0 0 0-1.693 1.061 1 1 0 0 1-1.801 0A1.908 1.908 0 0 0 22.907 16C21.848 16 21 16.894 21 18.008c0 .532.198 1.045.504 1.42l3.99 4.127 3.922-4.127z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 18)
				                	<svg viewBox="0 0 51 52"><path d="M20 50h10V14v-.003a7.631 7.631 0 0 1-.216.003H20.21l-.21-.003V50zm-2 0V13.661c-2.892-.911-5-3.559-5-6.661 0-3.892 3.227-7 7.21-7 1.788 0 3.454.64 4.776 1.761A7.37 7.37 0 0 1 29.784 0c3.983 0 7.21 3.108 7.21 7 0 3.155-2.12 5.795-5.046 6.682.034.1.052.207.052.318v36h14V25a1 1 0 0 1 2 0v26a1 1 0 0 1-1 1H3.996a1 1 0 0 1-1-1V25a1 1 0 0 1 2 0v25H18zM29.784 2c-1.586 0-3.075.69-4.023 1.811a1 1 0 0 1-1.508.022C23.213 2.673 21.777 2 20.21 2 17.315 2 15 4.23 15 7c0 2.732 2.339 5 5.21 5h9.574c2.895 0 5.21-2.23 5.21-5s-2.315-5-5.21-5zM1 26a1 1 0 0 1-1-1V13a1 1 0 0 1 1-1h49a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H1zm1-2h47V14H2v10z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 23 || $data['cat_id'] == 50)
				                	<svg viewBox="0 0 34 54"><path d="M1.262 19.007a15.769 15.769 0 0 1-.262-2.7V5a1 1 0 0 1 1-1c3.282 0 6.336 1 8.878 2.709A27.672 27.672 0 0 1 16.343.246a1 1 0 0 1 1.314 0 27.673 27.673 0 0 1 5.464 6.462c.18-.112.361-.22.545-.326A15.792 15.792 0 0 1 32 4a1 1 0 0 1 1 1v11.32c-.074 6.59-4.225 12.225-10.06 14.546a15.496 15.496 0 0 1-4.94 1.24V43.37a17.164 17.164 0 0 1 2.44-3.202c3.326-3.533 7.89-5.348 12.59-5.154l.922.038.035.923c.181 4.698-1.553 9.434-4.798 12.977-3.173 3.194-7.3 4.952-11.679 5.048h-.85c-4.363 0-8.506-1.764-11.68-5.049C1.572 45.516-.173 40.813.013 35.975l.037-.942.942-.02c4.693-.097 9.242 1.712 12.56 5.146.948.98 1.765 2.073 2.448 3.256V32.14C8.57 31.797 2.468 26.23 1.262 19.007zm15.611-4.878a15.757 15.757 0 0 1 4.618-6.252A25.576 25.576 0 0 0 17 2.346a25.567 25.567 0 0 0-4.525 5.588 16.15 16.15 0 0 1 4.398 6.195zm5.013 27.42c-1.99 2.059-3.348 4.614-3.907 7.34L17.341 52h.147c3.842-.085 7.475-1.633 10.254-4.429a16.353 16.353 0 0 0 4.254-10.567c-3.785.091-7.402 1.668-10.11 4.544zm-5.86 7.366c-.667-2.85-1.99-5.376-3.912-7.366-2.696-2.79-6.314-4.363-10.11-4.525.084 3.946 1.615 7.716 4.405 10.528C9.216 50.457 12.839 52 16.66 52h.089l-.723-3.085zM18 20.015c0 1.334-2 1.334-2 0 0-7.35-5.75-13.46-13-13.98v10.262C3.085 23.864 9.338 30 17 30c7.663 0 13.915-6.136 14-13.692V6.036c-7.2.525-13 6.662-13 13.98z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 22)
				                	<svg viewBox="0 0 54 34"><path d="M9 21.908V34H7V20.223C2.67 16.008.036 9.363 0 1.605 0 .715.718 0 1.606 0c.425 0 .797.185 1.153.54 1.653 1.881 3.815 2.354 9.537 2.583 1.178.047 1.659.068 2.298.106C20.655 3.59 24.46 4.993 27 8.863c2.535-3.857 6.34-5.266 12.374-5.63.657-.039 1.15-.061 2.358-.11 5.656-.225 7.826-.69 9.449-2.514C51.45.199 51.9 0 52.394 0 53.264 0 54 .619 54 1.546c-.159 16.629-12.055 28.12-27.001 21.708C20.047 26.224 13.757 25.35 9 21.908zM51.97 2.65C49.966 4.449 47.373 4.9 41.812 5.122c-1.195.048-1.68.07-2.318.108-6.151.37-9.478 1.824-11.599 6.092L27 13.124l-.896-1.802c-2.127-4.282-5.45-5.73-11.628-6.095-.622-.037-1.095-.058-2.26-.105-5.605-.224-8.199-.681-10.192-2.478.267 6.503 2.733 12.634 6.72 16.426 4.595 4.373 10.766 5.347 17.847 2.18l.41-.183.409.183c13.278 5.965 23.917-3.729 24.56-18.6zM14.866 18.387c-2.699-1.095-4.714-3.435-5.492-6.235l-.207-.746.671-.388c2.557-1.474 5.577-1.696 8.265-.53 2.702 1.092 4.716 3.433 5.493 6.236l.209.755-.683.383a9.6 9.6 0 0 1-8.256.525zm6.54-1.908c-.74-1.865-2.195-3.386-4.076-4.147-1.87-.811-3.926-.771-5.771.051.74 1.869 2.196 3.395 4.059 4.15a7.607 7.607 0 0 0 5.789-.054zm17.75 1.9a9.17 9.17 0 0 1-8.298-.528l-.659-.39.205-.738c.779-2.803 2.793-5.143 5.492-6.235 2.753-1.117 5.838-.913 8.277.537l.657.39-.205.737c-.767 2.76-2.757 5.051-5.47 6.226zm3.286-6c-1.77-.785-3.878-.815-5.795-.037-1.865.754-3.322 2.282-4.061 4.156a7.17 7.17 0 0 0 5.775.045c1.9-.824 3.349-2.329 4.08-4.165z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 49)
				                	<svg viewBox="0 0 54 51"><path d="M28.943 13H47v1.588a8.083 8.083 0 01-1 3.91v11.487h8v1.496a7.806 7.806 0 01-1 3.83V51H1V35.31a7.806 7.806 0 01-1-3.83v-1.495h8V18.5a8.078 8.078 0 01-1-3.912V13h18.202l-4.96-4.961c-.784-.882-1.268-2.066-1.268-3.273A4.74 4.74 0 0123.742 0c1.284 0 2.46.501 3.33 1.365A4.7 4.7 0 0130.404 0a4.74 4.74 0 014.766 4.766c0 1.227-.496 2.41-1.379 3.388L28.943 13zM10 29.985h34v-9.109a7.67 7.67 0 01-4.811 1.69c-2.398 0-4.61-1.151-6.081-3.017-1.445 1.855-3.698 3.017-6.108 3.017-2.398 0-4.608-1.151-6.08-3.018-1.445 1.855-3.698 3.018-6.109 3.018A7.68 7.68 0 0110 20.876v9.109zm-7 7.677V49h48V37.662a8.147 8.147 0 01-5.098 1.78c-2.5 0-4.8-1.14-6.3-3.004a8.086 8.086 0 01-6.302 3.005c-2.5 0-4.8-1.141-6.3-3.006a8.08 8.08 0 01-6.3 3.006 8.086 8.086 0 01-6.302-3.005 8.082 8.082 0 01-6.3 3.005A8.147 8.147 0 013 37.662zm11.811-17.096c2.205 0 4.253-1.332 5.19-3.318l.875-1.854.923 1.83c1.024 2.032 3.02 3.342 5.201 3.342 2.205 0 4.253-1.332 5.19-3.318l.876-1.856.922 1.833c1.021 2.03 3.019 3.341 5.2 3.341 3.082 0 5.593-2.458 5.798-5.566H9.013c.206 3.125 2.734 5.566 5.798 5.566zM8.098 37.443a6.061 6.061 0 005.409-3.29l.891-1.749.891 1.75c1.017 1.996 3.1 3.289 5.411 3.289 2.31 0 4.39-1.292 5.41-3.29l.89-1.746.89 1.746a6.063 6.063 0 005.41 3.29c2.312 0 4.394-1.293 5.41-3.29l.892-1.749.891 1.75a6.061 6.061 0 005.409 3.289c3.19 0 5.814-2.412 6.076-5.458H2.022c.262 3.046 2.886 5.458 6.076 5.458zM32.341 6.777c.53-.588.829-1.302.829-2.01A2.74 2.74 0 0030.404 2c-1.046 0-1.954.563-2.448 1.496l-.884 1.67-.884-1.67C25.694 2.562 24.787 2 23.742 2a2.74 2.74 0 00-2.768 2.766c0 .698.294 1.416.723 1.901l5.375 5.375 5.269-5.265z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 53)
				                	<svg viewBox="0 0 54 54"><path d="M54 27c0 14.912-12.088 27-27 27S0 41.912 0 27 12.088 0 27 0s27 12.088 27 27zm-2 0C52 13.192 40.808 2 27 2S2 13.192 2 27s11.192 25 25 25 25-11.192 25-25zm-32.182 0a3.416 3.416 0 11-6.832 0 3.416 3.416 0 016.832 0zm-2 0a1.416 1.416 0 10-2.832 0 1.416 1.416 0 002.832 0zm12.113 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0zm13.084 0a3.416 3.416 0 11-6.833 0 3.416 3.416 0 016.833 0zm-2 0a1.416 1.416 0 10-2.833 0 1.416 1.416 0 002.833 0z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 24)
				                	<svg viewBox="0 0 58 58"><path d="M49.207 37.13V5.87a3.066 3.066 0 0 0-3.066-3.067H7.357v52.394H46.14a3.066 3.066 0 0 0 3.066-3.067v-15zm2 0H58v12.056h-6.793v2.944a5.066 5.066 0 0 1-5.066 5.067H5.066A5.066 5.066 0 0 1 0 52.13V5.87A5.066 5.066 0 0 1 5.066.803h41.075a5.066 5.066 0 0 1 5.066 5.067V6.95H58v12.056h-6.793v3.04H58v12.056h-6.793v3.027zM5.357 55.197V2.803h-.29A3.066 3.066 0 0 0 2 5.87v46.26a3.066 3.066 0 0 0 3.066 3.067h.29zm34.346-41.453v12.458H16.277V13.744h23.426zm-21.426 2v8.458h19.426v-8.458H18.277zm32.93 1.263H56V8.951h-4.793v8.056zm0 15.096H56v-8.056h-4.793v8.056zm0 15.083H56V39.13h-4.793v8.056z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 3)
				                	<svg viewBox="0 0 49 54"><path d="M39 36.064a22.418 22.418 0 0 0-1.352-1.036 25.587 25.587 0 0 1-4.901 2.73c-7.223 2.846-15.282 1.765-21.485-2.655C5.857 38.972 2.337 45.147 2.022 52H39V36.064zm2 1.875V52h5.977c-.243-5.372-2.439-10.309-5.977-14.06zm-5.184-4.079a22.689 22.689 0 0 0-4.337-1.908l.61-1.904c2.53.81 4.861 2.003 6.932 3.503V18.516c0-2.794-.28-4.741-1.106-6.936-3.02-7.783-11.733-11.591-19.403-8.516-5.65 2.31-9.368 7.869-9.512 13.933v17.314a24.27 24.27 0 0 1 7.99-4.265l.597 1.908a22.277 22.277 0 0 0-4.5 1.974c5.56 3.65 12.594 4.464 18.904 1.978a23.682 23.682 0 0 0 3.825-2.046zM7 36.113v-19.14C7.163 10.102 11.36 3.83 17.761 1.21c8.712-3.493 18.596.827 22.022 9.656.925 2.457 1.238 4.634 1.238 7.65v16.651C45.974 39.62 49 46.013 49 53v1H0v-1c0-6.493 2.64-12.498 7-16.887zM7 36h2v17H7V36zm30.145-10.979l.263.287v.389c0 .761-1.565 2.934-3.386 4.516C31.303 32.576 27.906 34 23.87 34c-3.648 0-6.813-1.244-9.47-3.308a16.936 16.936 0 0 1-2.396-2.264c-.409-.47-.688-.845-.84-1.074l-.856-1.3 1.54-.238c6.87-1.06 13.593-4.51 18.398-11.389l1.668-2.387.15 2.908c.175 3.37 2.11 6.83 5.081 10.073zm-6.707-7.535c-4.592 5.602-10.488 8.719-16.593 10a15.06 15.06 0 0 0 1.782 1.627C17.954 30.92 20.701 32 23.87 32c3.523 0 6.467-1.234 8.84-3.296a13.837 13.837 0 0 0 2.138-2.327 9.97 9.97 0 0 0 .355-.526c-2.34-2.663-4.041-5.476-4.765-8.365z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 4)
				                	<svg viewBox="0 0 49 54"><path d="M38.816 19.577c.145-.837.221-1.698.221-2.577 0-8.284-6.724-15-15.018-15C15.77 2 9.073 8.643 9 16.863c1.904.656 3.948.988 6.073.988 6.374 0 12.286-3.235 15.762-8.443l1.697-2.544.134 3.056a11.453 11.453 0 0 0 6.15 9.657zm-.488 1.991a13.47 13.47 0 0 1-7.319-9.08c-3.922 4.592-9.728 7.363-15.935 7.363a20.8 20.8 0 0 1-5.94-.845C10.113 26.34 16.405 32 24.017 32c6.7 0 12.375-4.381 14.31-10.432zM16.509 32.26C8.172 35.392 2.425 43.103 2.023 52h19.68l-.186-1.212-.012-.153V41.68l1.17-1.945-1.943-2.513 2.546-3.238a16.94 16.94 0 0 1-6.769-1.725zm-2.162-1.27C9.908 27.921 7 22.8 7 17 7 7.612 14.621 0 24.018 0c9.4 0 17.019 7.61 17.019 17 0 5.686-2.794 10.72-7.086 13.806C42.803 34.537 48.742 43.196 48.742 53v1H0v-1c0-9.627 5.736-18.133 14.347-22.01zM31.8 32.123a16.921 16.921 0 0 1-6.07 1.792l2.531 3.316-1.937 2.504 1.17 1.945v8.954l-.01.153-.187 1.212h19.422c-.409-9.065-6.356-16.911-14.919-19.876zm-8.073 19.876h1.546l.222-1.441v-8.322l-.995-1.654-.995 1.654v8.322l.222 1.441zm2.012-14.776l-1.214-1.59-1.257 1.599 1.232 1.592 1.239-1.601z" fill-rule="nonzero"></path></svg>
				                @elseif($data['cat_id'] == 26)
				                	<svg viewBox="0 0 54 54"><path d="M50.572 11.446a5.68 5.68 0 0 0-8.5-7.533L9.365 40.803a2.714 2.714 0 0 0 .002 3.601 2.713 2.713 0 0 0 3.832.231L50.087 11.93c.16-.143.34-.322.485-.484zm.846 1.977L14.525 46.132a4.713 4.713 0 0 1-6.655-.4 4.713 4.713 0 0 1 0-6.258L40.575 2.586a7.678 7.678 0 1 1 10.843 10.837zM40.211 31.775l3.213-3.215a3.505 3.505 0 1 1 4.957 4.957l-3.215 3.215a3.505 3.505 0 0 1-4.955-4.957zm1.414 3.542c.586.587 1.54.587 2.128 0l3.214-3.214a1.505 1.505 0 1 0-2.13-2.128l-3.212 3.214a1.505 1.505 0 0 0 0 2.128zM17.267 8.834l3.214-3.217a3.507 3.507 0 0 1 4.958 4.959l-3.215 3.214a3.505 3.505 0 0 1-4.957-4.956zm3.543 3.541l3.215-3.213a1.507 1.507 0 0 0-2.13-2.13l-3.213 3.216a1.505 1.505 0 0 0 2.128 2.127zm-1.218 34.82a.962.962 0 0 0 1.584-1.01l-2.272-5.728 1.859-.737 2.278 5.744a2.959 2.959 0 0 1-.676 3.143c-1.154 1.158-3.038 1.158-4.15.037l-.06-.056-3.675-3.674 1.415-1.415 3.664 3.665.033.031zM5.296 35.73a2.97 2.97 0 0 1 .095-4.098 2.95 2.95 0 0 1 3.15-.673l5.74 2.277-.738 1.86-5.726-2.273a.946.946 0 0 0-1.012.224c-.377.377-.377.987-.042 1.323.018.01.026.014.062.061l3.674 3.676-1.414 1.414L5.4 35.835l-.105-.105zm40.018 17.075l1.397-1.433-1.397 1.433-18.672-18.672 1.415-1.415 18.656 18.656a2.168 2.168 0 0 0 3.056-.01c.612-.61.794-1.519.489-2.308l-4.945-12.47-.145.145a3.503 3.503 0 0 1-4.957 0 3.505 3.505 0 0 1 0-4.957l2.287-2.287-2.918-7.359 1.86-.737 3.401 8.58-.464.466-2.752 2.75a1.505 1.505 0 1 0 2.13 2.13l2.295-2.297.561 1.415 5.51 13.892a4.168 4.168 0 0 1-6.816 4.467l.703-.71.707-.708-1.4 1.429zM32.611 12.56l-.737 1.86-7.972-3.163.737-1.859 7.972 3.162zM19.566 7.388l-.737 1.86L4.952 3.744a2.167 2.167 0 0 0-2.33 3.539L21.28 25.945l-1.414 1.414L1.205 8.694a4.168 4.168 0 0 1 .015-5.88 4.17 4.17 0 0 1 4.462-.932l13.884 5.506z" fill-rule="nonzero"></path></svg>
				                @endif
				            	</i>
				            </div>
				            <p class="color-grey mb40">You do not have any vendors in this category saved</p>
			           </div>
                   	@endif
                </div>
	        </div>
            </div>
        </div>
    </div>
    <style>
	.tools-noResult-icon.svgIcon {
	    width: 46px;
	    height: 46px;
	}
	.icon-tools-search::before {
	    background-position: -76px -76px;
	    height: 17px;
	    width: 17px;
	}
	.icon-fav-on-border::before {
	    background-position: -69px -181px;
	    height: 17px;
	    width: 17px;
	}
	.tools-header-actionContainer {
	    display: block;
	    text-align: right;
	}
    </style>	
</section>
  @include('includes.request_popup')
  @include('includes.search_vendor_popup')
  @include('includes.error_popup')
  @include('includes.footer')
@endsection       
