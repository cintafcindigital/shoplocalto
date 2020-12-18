@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<link rel="Stylesheet" type="text/css" href="{{URL::asset('public/css/sweetalert.css')}}" />
<link rel="Stylesheet" type="text/css" href="{{URL::asset('public/css/croppie.css')}}" />
<style>
.avatar-group-item a, .avatar-group-item img {
    border-radius: 50%;
}
</style>
<!-- Dashboard SECTION START-->
<section class="section-padding dashboard-wrap">
    @include('tools.tools_nav')
    <div class="row">
      <div class="col-sm-12">
        <form action="" method="POST">
          {{csrf_field()}}
          
        </form>
      </div>
    </div>
    <div id="toolsHeading" class="app-tools-heading dash-hero hidden">
        <div id="photoLoading" class="wrapper">
            <div id="uploadContainer" class="pure-g-r dash-heroContainer">
                <div id="pickfiles" class="app-spinner-container app-pencil-profile pure-u-1-3 dash-cover app-tools-has-cover-upload">
                    <!-- <input type="file" id="my_file" style="display: none">
                    <img src="{{url('public/images/wedding-pic.jpg')}}" alt="" class="wedding-pic-change">
                    <button class="dash-cover-edit"><i class="fa fa-camera"></i>Change photo</button>-->       
                    <!-- User Profile Image -->
                    <div id="timelineContainerg"> 
                    <div class="container_info clearfix">
                      <div class="author-image" data-toggle="tooltip" data-placement="bottom">
                      <a href="javascript:void(0)" class="">
                            <button class="dash-cover-edit profileImage" title="Click & Change"><i class="icon-tools icon-tools-camera-small-white"></i>Change photo</button>
                      </a>
                      <img src="{{$pro_image}}" alt="Profile Image">
                      </div>
                      <div class="image-editor" style="display:none">
                          <form action="{{url('profile_pic')}}" id="formAddProfilePic" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            {{csrf_field()}}
                            <input type="file" name="profile_image" class="cropit-image-input" style="display:none">
                            <input type="hidden" name="imageData" id="imageData">
                            <div class="cropit-preview"></div>
                            <!-- <div class="slider-wrapper">
                              <span class="fa fa-image small-image"></span>
                              <input type="range" class="cropit-image-zoom-input custom" min="0" max="1" step="0.01">
                              <span class="fa fa-image large-image"></span>
                            </div> -->
                            <input type="button" class="profileImage-save dash-cover-edit" value="update">
                            <input type="button" class="profileImage-cancel dash-cover-edit image-crop-cancel" value="Cancel">
                          </form>
                      </div> 
                    </div> 
                  </div>
                  <div class="dash-cover-info">
                      <div id="defaultCountdown" class="dash-cover-date app-tools-main-countdown hasCountdown">
                      </div>
                  </div>
                </div>

                <div class="pure-u-2-3">
                    <div class="dash-summary">
                        <a class="dash-summary-edit btn-outline outline-red hidden" href="#" data-remote="/tools/Wedding" data-toggle="modal" data-target="#myModal02" role="button">Edit</a><br>
                        <div class="dash-summary-info">
                            <ul class="avatar-group reverse avatar-group-medium">
                                <li class="avatar-group-item ">
                                    <a href="#" onclick="Frontend.showCropModel('self','Crop your photo')">
                                        <div class="modal-myWedding-dash-sectionAvatar modal-myWedding-dash-sectionAvatar-small">
                                            <label for="upload" class="pointer frame-inputFile">
                                                 <div class="modal-myWedding-dash-sectionAvatar-hover modal-myWedding-dash-sectionAvatar-hover-small">
                                                    <i class="icon-tools icon-tools-avatar-camera-white"></i>
                                                </div> 
                                                <div class="avatar-alias size-avatar-xmedium avatar-center self-avatar-image">
                                                    @if(isset($user_partner[0]['avatar']) && !empty($user_partner[0]['avatar']))
                                                     <img src="{{url('public/storage')}}/USER_{{ $user_partner[0]['user_id'] }}/{{$user_partner[0]['avatar']}}">
                                                    @else
                                                      <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                          <circle fill="#90caa4" cx="100" cy="100" r="100"></circle>
                                                          <text transform="translate(100,130)" y="0">
                                                              <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{($user_partner[0]['firstname']!=null)?substr($user_partner[0]['firstname'],0,1):'A'}}</tspan>
                                                          </text>
                                                      </svg>
                                                   @endif
                                               </div>
                                            </label>
                                        </div>
                                    </a>
                                </li>
                                <li class="avatar-group-item">
                                    <a href="#" onclick="Frontend.showCropModel('partner','Crop your partner photo')">
                                        <div class="modal-myWedding-dash-sectionAvatar modal-myWedding-dash-sectionAvatar-small">
                                            <label for="upload" class="pointer frame-inputFile">
                                                <div class="modal-myWedding-dash-sectionAvatar-hover modal-myWedding-dash-sectionAvatar-hover-small">
                                                    <i class="icon-tools icon-tools-avatar-camera-white"></i>
                                                </div>
                                                <div class="avatar-alias size-avatar-xmedium avatar-center partner-avatar-image">
                                                  @if(isset($user_partner[0]['partner_avatar']) && !empty($user_partner[0]['partner_avatar']))
                                                   <img src="{{url('public/storage')}}/USER_{{ $user_partner[0]['user_id'] }}/{{$user_partner[0]['partner_avatar']}}">
                                                  @else
                                                  <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                      <circle fill="#EAD6C3" cx="100" cy="100" r="100"></circle>
                                                      <text transform="translate(100,130)" y="0">
                                                          <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{($user_partner[0]['partner_name']!=null)?substr($user_partner[0]['partner_name'],0,1):'B'}}</tspan>
                                                      </text>
                                                  </svg>
                                                  @endif
                                              </div>
                                            </label>
                                        </div>
                                    </a>
                                </li>                          
                            </ul>
                            <p class="dash-couple-names">
                                <span class="app-owner-name">{{$user_partner[0]['firstname'].' '.$user_partner[0]['lastname'] ?? 'A'}}</span>
                                @if(isset($user_partner[0]['partner_name']))
                                &amp;
                                @endif
                                <span class="app-partner-name">{{$user_partner[0]['partner_firstname'].' '.$user_partner[0]['partner_lastname'] ?? ''}}</span>
                            </p>
                            @if(isset($user_partner[0]['wedding_date']) && !empty($user_partner[0]['wedding_date']))
                                <p class="dash-couple-date">{{date('F dS, Y',strtotime($user_partner[0]['wedding_date'])) ?? ''}}</p>
                            @endif
                            @if( isset($data['websitedata'][0]['website_link']) && !empty($data['websitedata'][0]['website_link']) ) 
                            <div class="websitelink">
                                <a target="_blank" href="{{url('/web/'.$data['websitedata'][0]['website_link'])}}">Wedding Website</a>
                            </div>
                            @endif
                        </div>
                        <div class="dash-couple-progress">
                            <p class="dash-couple-progress-label clearfix">
                                <span>Status:</span>
                                <span class="fright">Just said yes? Let's get started!</span>
                            </p>
                            <div class="tools-boxProgress-progress tools-boxProgress-progressBig">
                                <div class="app-checklist-progress" style="width: 10%;"></div>
                            </div>
                        </div>
                        <ul class="pure-g dash-couple-info">
                            <li class="pure-u-1-3 app-link" data-href="/tools/Vendors">
                              <a href="{{url('tools/vendors')}}">
                                <p class="dash-couple-info-item">
                                    <span><strong>{{$data['booked_vendors'] ?? 0}}</strong> of {{$data['totalCats']}}</span>
                                    <small>vendors <br>booked</small>
                                </p>
                              </a>
                            </li>
                            <li class="pure-u-1-3 app-link" data-href="/tools/Checklist">
                                <a href="{{url('tools/to-do-list')}}">
                                <p class="dash-couple-info-item">
                                    <span><strong>{{$data['listData']['complete'] ?? 0}}</strong> of {{$data['listData']['total'] ?? 0}}</span>
                                    <small>tasks <br>completed</small>
                                </p>
                                </a>
                            </li>
                            <li class="pure-u-1-3 app-link" data-href="/tools/Guests">
                               <a href="{{url('tools/guests')}}">
                                <p class="dash-couple-info-item">
                                    <span><strong>{{$data['guests']['confirmed'] ?? 0}}</strong> of {{$data['total_guests'] ?? 0}}</span>
                                    <small>guests <br>confirmed</small>
                                </p>
                               </a>
                            </li>                            
                           <!--  <li class="pure-u-1-4 app-link" data-href="/tools/Tables">
                                <a href="{{url('tools/tables')}}">
                                  <p class="dash-couple-info-item">
                                      <span><strong>0</strong> of 0</span>
                                      <small>guests <br>seated</small>
                                  </p>
                                </a>
                              </li> -->
                        </ul>
                    </div>
                </div>
          </div>
        </div>
      </div>
      
      <div class="dashboard-mid-wrap hidden" id="service-wedding">
        <div class="container">
          <h2 class="dash-title mb15 mt10">
               Vendor Manager 
              <a class="dash-title-action color-grey" href="{{url('tools/vendors')}}">
                  View all<i class="icon icon-arrow-right icon-right"></i>
              </a>
          </h2>
          <div class="app-slider-container dash-vendors pure-g row">
              @php $imageArray = array('16'=>'reception-icon.png','17'=>'wedding-invitation-icon.png','19'=>'photography-icon.png','20'=>'music-icon.png','18'=>'wedding-favours-icon.png'); @endphp
              @if(isset($data['vendorCats']) && !empty($data['vendorCats']))
                @foreach($data['vendorCats'] as $vendorCat)
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
                    <div class="pure-u-1-5">
                        @if(isset($vendorCat['booked']) && !empty($vendorCat['booked']))
                        <a href="{{url('tools/vendors')}}">
                        <div class="dash-vendors-item app-link">
                            <figure class="dash-vendors-item-figure dash-vendors-item-figure-cover" style="background:url({{$bgImage}}) no-repeat 50% 50%;background-size:cover;">
                                <span class="dash-vendors-item-name">{{$vendorCat['booked']['business_name']}}</span>
                            </figure>
                        </div>
                        <p class="dash-vendors-item-categ text-center app-link">{{str_replace('Wedding','',$vendorCat['title'])}}</p>
                        </a>
                        @else
                        <div class="dash-vendors-item app-link">
                            <figure class="dash-vendors-item-figure dash-vendors-item-figure-empty">
                                <i class="dash-vendors-item-icon icon-tools-vendors-group-1"><img src="{{url('public/images')}}/{{@$imageArray[@$vendorCat['id']]}}" alt="{{@$vendorCat['title']}}"></i>
                                  <span class="vendors-categBox-button app-icon-hover app-tools-main-add-vendor-modal" data-toggle="modal" data-target="#myModalSearchVendor" data-cat-id="{{$vendorCat['id']}}">
                                      <i class="icon-tools icon-tools-plus mr5"></i>
                                      Add
                                  </span>
                            </figure>
                        </div>
                        <p class="dash-vendors-item-categ text-center app-link">{{str_replace('Wedding','',$vendorCat['title'])}}</p>
                        @endif
                    </div>
                @endforeach
              @endif
          </div>   
          <!-- starts 16/10 -->
        <div class="dash-cntnt">  
          <div class="pure-g">
             <div class="pure-u-7-10">
                <div class="mr40">
                   <p class="dash-title">Finally married!</p>
                   <div class="dash-real">
                      <div class="pure-g">
                         <div class="pure-u-1-2 flex">
                            <div class="dash-real-item border-right">
                               <p class="pb10">
                                  <i class="svgIcon svgIcon__recom svgIcon--center svgIcon--huge">
                                     <svg viewBox="0 0 52 49">
                                        <path d="M17.346 38.586C7.925 38.586.25 30.162.25 19.893.25 9.47 8.129.25 17.42.25H34.73c9.291 0 17.17 9.22 17.17 19.643 0 10.283-7.763 18.857-17.17 18.857h-5.757l-9.307 9.286a.727.727 0 0 1-1.241-.515v-8.835l-1.078-.1zm10.811-1.078a.727.727 0 0 1 .514-.213h6.058c8.57 0 15.716-7.892 15.716-17.402 0-9.666-7.283-18.188-15.716-18.188H17.42c-8.433 0-15.715 8.522-15.715 18.188 0 9.494 7.055 17.239 15.706 17.242l1.806.163a.727.727 0 0 1 .661.725v7.745l8.28-8.26zm-10.81-21.042l5.47-.438 2.563-5.327a.727.727 0 0 1 1.312.003l2.528 5.324 5.581.438c.62.049.897.802.456 1.24l-3.932 3.914 1.073 5.689a.727.727 0 0 1-1.067.77l-5.296-2.932-5.285 2.932a.727.727 0 0 1-1.067-.77l1.076-5.693-3.871-3.913a.727.727 0 0 1 .458-1.237zm3.68 5.421l-.197-.646-.071.375.268.271zm7.06-4.855l-2.056-4.33-2.085 4.333a.727.727 0 0 1-.597.41l-4.328.346 3.04 3.073c.168.17.242.412.198.647l-.859 4.545 4.282-2.376a.727.727 0 0 1 .705 0l4.294 2.378-.857-4.547a.727.727 0 0 1 .202-.65l3.083-3.069-4.423-.347a.727.727 0 0 1-.6-.413z"></path>
                                     </svg>
                                  </i>
                               </p>
                               <h3 class="dash-real-item-title">Review your vendors</h3>
                               <p class="dash-real-item-description">Share your vendor experiences to help other couples plan their big day.</p>
                               <form id="frmRecomendaciones" name="frmRecomendaciones" action="{{ url('tools') }}/shared/rate" method="post">
                                  {{ csrf_field() }}
                                  <div class="flex">
                                     <div class="app-common-ajaxform-section">
                                        <div class="input-group-line mr20 dash-real-item-suggest">
                                           <div class="drop-wrapper ">

                                              <input type="hidden" class="app-suggest-vendor-id-add-vendor" id="suProvider_id-add-vendor" name="app-suggest-vendor-input-id-add-vendor" value="">

                                              <input id="suProvider-add-vendor" type="text" name="app-suggest-vendor-input-add-vendor" autocomplete="on" class="pure-u-1 app-input-vendor " placeholder="Vendor name" value="">

                                              <div class="app-suggest-vendor-div-add-vendor droplayer droplayer-scroll dnone"></div>
                                              <span class="app-loader-line loader-line input-line "></span>
                                           </div>
                                           <input class="app-tools-main-id-empresa" type="hidden" name="idVendor" value="">
                                           <input class="app-tools-main-name-empresa" type="hidden" name="vendorName" value="" data-msgerror="Enter the vendor's name">
                                        </div>
                                     </div>
                                     <input class="btn-flat red" type="submit" value="Review">
                                  </div>
                               </form>
                            </div>
                         </div>
                         <div class="pure-u-1-2 flex">
                            <div class="dash-real-item">
                               <p class="pb10">
                                  <i class="svgIcon svgIcon__review svgIcon--center svgIcon--huge">
                                     <svg viewBox="0 0 61 49">
                                        <path d="M46.258 16.107h9.47a.734.734 0 1 1 0 1.468h-10.95l-2.249 2.228h9.84c.663 0 .986.809.506 1.266-6.282 5.974-11.535 6.937-15.48 4.87a7.72 7.72 0 0 1-.664-.39l-3.077 3.05a.734.734 0 0 1-1.034-1.042l3.103-3.075a8.974 8.974 0 0 1-.566-4.206c.417-4.249 3.516-8.685 8.407-13.12a61.678 61.678 0 0 1 5.714-4.568 59.568 59.568 0 0 1 1.884-1.285c.343-.224.59-.38.725-.462a.734.734 0 0 1 1.116.626v5.888l5.59-5.541a.734.734 0 0 1 1.032-.003c.205.203.477.57.736 1.116 1.194 2.508.928 6.118-1.697 10.885a.734.734 0 0 1-.643.38h-9.83l-1.933 1.915zm-5.199 5.153l-3.256 3.228c.085.05.176.1.274.151 3.09 1.619 7.205 1.043 12.383-3.368h-9.273a.739.739 0 0 1-.128-.011zM51.55 8.796a.738.738 0 0 1-.014-.14v-5.84c-.437.292-.909.616-1.407.97a60.233 60.233 0 0 0-5.578 4.457c-4.644 4.21-7.56 8.386-7.932 12.177a7.583 7.583 0 0 0 .262 2.916l14.669-14.54zm7.449-5.316l-9.327 9.244h7.912c2.215-4.173 2.404-7.168 1.453-9.167a4.797 4.797 0 0 0-.038-.077zM1.718 1.718V45.84h11.95a.734.734 0 1 1 0 1.468H.984a.734.734 0 0 1-.734-.734V.984C.25.579.58.25.984.25h34.5c.406 0 .734.329.734.734v7.9a.734.734 0 1 1-1.467 0V1.719H1.718zm37.544 44.376v1.422a.734.734 0 0 1-.734.734h-19.28a.734.734 0 0 1-.733-.734V45.93a7.41 7.41 0 0 1 7.318-7.41l-.004-1.092h-.722a.734.734 0 0 1-.734-.734v-2.651c0-.406.328-.734.734-.734h7.333c.405 0 .734.328.734.734v2.538a.734.734 0 0 1-.732.734l-.714.002-.002 1.202a7.575 7.575 0 0 1 7.536 7.575zm-1.468 0a6.107 6.107 0 0 0-6.107-6.107h-.696a.734.734 0 0 1-.734-.735l.005-2.668c0-.404.328-.731.732-.733l.712-.002v-1.072H25.84v1.183h.721c.404 0 .733.327.734.732l.008 2.559a.734.734 0 0 1-.734.736h-.644a5.943 5.943 0 0 0-5.942 5.943v.852h17.811v-.688z"></path>
                                     </svg>
                                  </i>
                               </p>
                               <h3 class="dash-real-item-title">Share your Real Wedding</h3>
                               <p class="dash-real-item-description">Publish your wedding photos and details on WeddingWire to earn entries to win $1,000!</p>
                               <a class="btn-flat red" onclick="setZOrigen(68);return true" href="/real-weddings/edit">Get started                                            </a>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="clearfix">
                      <p class="dash-title fleft">
                         <a href="{{url('tools/to-do-list')}}" class="dash-checklist-title dash-title">Upcoming tasks</a>
                      </p>
                      <span class="dash-checklist-complete dash-subtitle fright">{{$data['listData']['complete'] ?? 0}} of {{$data['listData']['total'] ?? 0}} completed</span>
                   </div>
                   <div class="dash-checklist checklist-tasks">
                      <ul>
                         @if(isset($data['listData']['pending_task']) && !empty($data['listData']['pending_task']))
                            @foreach($data['listData']['pending_task'] as $pendingD)
                         <li class="checklist-tasks-item app-link">
                            <div class="checklist-tasks-item-checkBox">
                               <a><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                            </div>
                            <div class="checklist-tasks-item-description">
                               <p class="checklist-tasks-item-title"><a href="{{url('tools/todolist-task-details?taskid=')}}{{$pendingD['list_id']}}">{{$pendingD['title']}}</a></p>
                               <span class="checklist-tasks-item-tag">{{$pendingD['category']}}</span>
                            </div>
                         </li>
                          @endforeach
                        @endif 

                      </ul>
                   </div>
                   <div class="dash-checklist-footer">
                      <a href="{{url('tools/to-do-list')}}" class="link--primary">View all tasks
                        <i class="icon icon-arrow-right-red icon-right"></i>
                      </a>
                   </div>

                    <div class="pure-g row">
                        @if(count($data['guest_list']) > 0)
                            <div class="pure-u-1-2">
                                <div class="unit">
                                    <p class="dash-title">Guest List</p>
                                    <div class="dash-box app-link" data-href="/tools/Guests">
                                        <p class="dash-subtitle pt10 pb15 text-center border-bottom">RSVP pending for 6 guests</p>
                                        <ul class="dash-guests">
                                            @foreach($data['guest_list'] as $list)
                                                <li class="dash-guests-item app-link pure-g">
                                                    <div class="pure-u-1-7">
                                                        <div class="dash-guests-avatar"><span class="icon-tools icon-tools-boy"></span></div>
                                                    </div>
                                                    <div class="pure-u-6-7 pl10">
                                                        <p class="dash-guests-name">{{ $list['firstname'].' '.$list['lastname'] }}</p>
                                                        <p class="dash-guests-group">{{ $list['get_group']['title'] }}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="text-right mt20 mr10">
                                        <a href="{{url('/tools/guests')}}" class="link--primary">See Guest List <i class="icon-right icon icon-arrow-right-red"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- <div class="pure-u-1-2">
                            <div class="unit">
                            <p class="dash-title">My Budget</p>
                            <div class="dash-box app-link" data-href="/tools/Budget">
                            <div class="dash-budget">
                            <div class="pure-g mb25">
                            <div class="pure-u-1-2">
                            <i class="icon-tools-pig block mb20"><img src="{{url('public/images/estimated-budget-icon.png')}}" alt=""></i>
                            <p class="dash-budget-title">Estimated <br> budget</p>
                            <p class="dash-budget-price">
                            C$ {{$data['total_estimate'] ?? 0}}
                            </p>
                            </div>
                            <div class="pure-u-1-2">
                            <i class="icon-tools-pig block mb20"><img src="{{url('public/images/final-cols-icon.png')}}" alt=""></i>
                            <p class="dash-budget-title">Final <br> cost</p>
                            <p class="dash-budget-price green">
                            C$ {{$data['total_final_cost'] ?? 0}}
                            </p>
                            </div>
                            </div>
                            <a class="btn manage-expenses-btn" href="{{url('tools/budget')}}">Manage expenses</a>
                            </div>
                            </div>
                            </div>
                            <div class="text-right mt20 mr10">
                            <a href="{{url('tools/budget')}}" class="app-icon-hover" data-icon-old="icon-arrow-right" data-icon-new="icon-arrow-right-red">View budget <i class="icon-right icon icon-arrow-right"></i></a>
                            </div>
                        </div> -->
                        <div class="pure-u-1-2">
                            <div class="unit">
                                <p class="dash-title">My Budget</p>
                                <div class="dash-box app-link" data-href="/tools/Budget">
                                    <div class="dash-budget">
                                        <div class="pure-g mb25">
                                            <div class="pure-u-1-2">
                                                <i class="icon-tools icon-tools-pig block mb20"></i>
                                                <p class="dash-budget-title">Estimated budget</p>
                                                <p class="dash-budget-price">C$ {{$data['total_estimate'] ?? 0}}</p>
                                            </div>
                                            <div class="pure-u-1-2">
                                                <i class="icon-tools icon-tools-price block mb20"></i>
                                                <p class="dash-budget-title">Final cost</p>
                                                <p class="dash-budget-price green">C$ {{$data['total_final_cost'] ?? 0}}</p>
                                            </div>
                                        </div>
                                        <a class="btn-outline outline-red" href="{{url('tools/budget')}}">Manage expenses</a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt20 mr10">
                                <a href="{{url('tools/budget')}}" class="link--primary">View Budget <i class="icon-right icon icon-arrow-right-red"></i></a>
                            </div>
                        </div>
                    </div>

                   <!-- <p class="dash-title mb20 mt30">Wedding details</p>
                   <div class="dash-wedding mb40">
                      <div id="misTags" data-url-base-buscador="https://www.weddingwire.ca/users">
                         <ul class="profile-aboutwedding pure-g row profile-aboutwedding-editprofile">
                            <li class="pure-u-1-5">
                               <div class="box app-container">
                                  <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                     <div class="profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old">
                                        <i data-grupo="1" class="icon icon-miss"></i>
                                     </div>
                                     <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                     <div class="droplayer profile-aboutwedding-droplayer app-about-wedding-layer dnone text-center">
                                        <ul class="profile-aboutwedding-droplayer--content pure-g" data-grupo="1">
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="142">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-blackwhite"></span>
                                              <small class="block mt5">B&amp;W</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="70">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-beige"></span>
                                              <small class="block mt5">Beige</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="55">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-black"></span>
                                              <small class="block mt5">Black</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="30">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-blue"></span>
                                              <small class="block mt5">Blue</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="71">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-brown"></span>
                                              <small class="block mt5">Brown</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="66">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-garnet"></span>
                                              <small class="block mt5">Burgundy</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="118">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-fuchsia"></span>
                                              <small class="block mt5">Fuchsia</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="90">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-golden"></span>
                                              <small class="block mt5">Gold</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="36">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-green"></span>
                                              <small class="block mt5">Green</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="97">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-grey"></span>
                                              <small class="block mt5">Grey</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="65">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-orange"></span>
                                              <small class="block mt5">Orange</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="60">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-pink"></span>
                                              <small class="block mt5">Pink</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="68">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-purple"></span>
                                              <small class="block mt5">Purple</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="42">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-red"></span>
                                              <small class="block mt5">Red</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="139">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-silver"></span>
                                              <small class="block mt5">Silver</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="12">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-white"></span>
                                              <small class="block mt5">White</small>
                                           </li>
                                           <li class="pure-u-1-5 app-tools-perfil-boda-layer" data-id="69">
                                              <span class="app-perfil-show icon-wedding-color icon-wedding-color-yellow"></span>
                                              <small class="block mt5">Yellow</small>
                                           </li>
                                        </ul>
                                     </div>
                                  </div>
                                  <div class="profile-aboutwedding-content">
                                     <span class="profile-aboutwedding-title">Colour</span>
                                     <span class="profile-aboutwedding-label" data-grupo="1">...</span>
                                     <span></span>
                                  </div>
                               </div>
                            </li>
                            <li class="pure-u-1-5">
                               <div class="box app-container">
                                  <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                     <div class="profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old">
                                        <i data-grupo="3" class="icon icon-miss"></i>
                                     </div>
                                     <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                     <div class="droplayer profile-aboutwedding-droplayer app-about-wedding-layer dnone text-center">
                                        <ul class="profile-aboutwedding-droplayer--content pure-g" data-grupo="3">
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="200">
                                              <span class="app-perfil-show icon-season icon-season-winter"></span>
                                              <small class=" block mt5">Winter</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="197">
                                              <span class="app-perfil-show icon-season icon-season-spring"></span>
                                              <small class=" block mt5">Spring</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="198">
                                              <span class="app-perfil-show icon-season icon-season-summer"></span>
                                              <small class=" block mt5">Summer</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="199">
                                              <span class="app-perfil-show icon-season icon-season-autumn"></span>
                                              <small class=" block mt5">Autumn</small>
                                           </li>
                                        </ul>
                                     </div>
                                  </div>
                                  <div class="profile-aboutwedding-content">
                                     <span class="profile-aboutwedding-title">Season</span>
                                     <span class="profile-aboutwedding-label" data-grupo="3">...</span>
                                     <span></span>
                                  </div>
                               </div>
                            </li>
                            <li class="pure-u-1-5">
                               <div class="box app-container">
                                  <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                     <div class="profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old">
                                        <i data-grupo="2" class="icon icon-miss"></i>
                                     </div>
                                     <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                     <div class="droplayer profile-aboutwedding-droplayer app-about-wedding-layer dnone text-center">
                                        <ul class="profile-aboutwedding-droplayer--content pure-g-r" data-grupo="2">
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="77">
                                              <span class="icon-style icon-style-beach"></span>
                                              <small class="block mt5">Beach</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="32">
                                              <span class="icon-style icon-style-country"></span>
                                              <small class="block mt5">Countryside</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="204">
                                              <span class="icon-style icon-style-elegant"></span>
                                              <small class="block mt5">Elegant</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="107">
                                              <span class="icon-style icon-style-modern"></span>
                                              <small class="block mt5">Modern</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="63">
                                              <span class="icon-style icon-style-night"></span>
                                              <small class="block mt5">Night</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="5">
                                              <span class="icon-style icon-style-park"></span>
                                              <small class="block mt5">Open air</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="19">
                                              <span class="icon-style icon-style-wood"></span>
                                              <small class="block mt5">Rustic</small>
                                           </li>
                                           <li class="pure-u-1-4 app-tools-perfil-boda-layer" data-id="24">
                                              <span class="icon-style icon-style-vintage"></span>
                                              <small class="block mt5">Vintage</small>
                                           </li>
                                        </ul>
                                     </div>
                                  </div>
                                  <div class="profile-aboutwedding-content">
                                     <span class="profile-aboutwedding-title">Style</span>
                                     <span class="profile-aboutwedding-label" data-grupo="2">...</span>
                                     <span></span>
                                  </div>
                               </div>
                            </li>
                            <li class="pure-u-1-5">
                               <div class="box app-container">
                                  <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                     <div class="app-com-icon-about profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old" data-group="designer">
                                        <i class="icon icon-miss"></i>
                                     </div>
                                     <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                     <div class="droplayer profile-aboutwedding-droplayer app-about-wedding-layer dnone">
                                        <div class="profile-aboutwedding-droplayer--content">
                                           <p class="strong text-left">Designer's Name</p>
                                           <div class="input-group contest-box-add-designer-option-search">
                                              <input type="hidden" class="app-suggest-designer" id="suDesigner_id-default" name="app-suggest-designer-input-id-default" value="default">
                                              <input id="default" type="text" autocomplete="off" class="app-suggest-designer-input fs12" placeholder="Enter a designer" onkeyup="" value="">
                                           </div>
                                           <div class="app-suggest-designer-div droplayer-scroll dnone"></div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="profile-aboutwedding-content">
                                     <span class="profile-aboutwedding-title">Dress</span>
                                     <span class="profile-aboutwedding-label app-name-designer" data-grupo="designer">...</span>
                                  </div>
                               </div>
                            </li>
                            <li class="pure-u-1-5">
                               <div class="box app-container">
                                  <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                     <div class="app-com-icon-about profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old" data-group="honeymoon">
                                        <i class="icon icon-miss"></i>
                                     </div>
                                     <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                     <div class="droplayer profile-aboutwedding-droplayer app-about-wedding-layer dnone">
                                        <div class="profile-aboutwedding-droplayer--content">
                                           <p class="strong text-left">Honeymoon Destination</p>
                                           <div class="input-group contest-box-add-honeymoon-option-search">
                                              <input type="hidden" class="app-suggest-honeymoon" id="suHoneymoon_id-default" name="app-suggest-designer-input-id-default" value="default">
                                              <input id="default" type="text" autocomplete="off" class="app-suggest-honeymoon-input fs12" placeholder="Enter a Honeymoon destination" onkeyup="" value="">
                                           </div>
                                           <div class="app-suggest-honeymoon-div droplayer-scroll dnone"></div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="profile-aboutwedding-content">
                                     <span class="profile-aboutwedding-title">Honeymoon</span>
                                     <span class="profile-aboutwedding-label app-name-honeymoon" data-grupo="honeymoon">...</span>
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </div>
                   </div> -->
                   <p class="dash-title mb20 mt30">Recent discussions</p>
                   <!-- <div class="dash-community-new">
                      <form action="/community-discussions-create.php" method="post">
                         <div class="dash-community-new-avatar">
                            <div class="avatar  ">
                               <div class="avatar-alias size-avatar-large ">
                                  <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                     <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                     <text transform="translate(100,130)" y="0">
                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">M</tspan>
                                     </text>
                                  </svg>
                               </div>
                            </div>
                         </div>
                         <div class="dash-community-new-comment">
                            <input type="text" class="dash-community-new-input" name="message" placeholder="Questions? Create a new discussion!">
                         </div>
                         <input class="dash-community-new-button btn-flat red" type="submit" value="Send">
                      </form>
                   </div> -->

                   <!-- Recent community -->

                   @if(count($data['discusstion']) > 0)
                   <div class="pure-g">
                      @foreach($data['discusstion'] as $discusstion)
                      <div class="pure-u-1-3 dash-community-item-box">
                         <div class="dash-community-item">
                            <div class="dash-community-item-content">
                               <div class="dash-community-item-avatar">
                                  <div class="avatar  ">
                                    @if(!empty($discusstion->userinfo['profile_image']))
                                       <figure>
                                          <img class="avatar-thumb" src="{{ url('public/storage') }}/USER_{{ $discusstion->userinfo['id'] }}/{{ $discusstion->userinfo['profile_image'] }}" width="" alt="User Images">
                                       </figure>
                                     @else
                                        <div class="avatar-alias size-avatar-large ">
                                          <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                             <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                             <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ $discusstion->userinfo['name'][0] }}</tspan>
                                             </text>
                                          </svg>
                                       </div>
                                     @endif
                                  </div>
                               </div>
                               <a class="dash-community-item-title" href="{{ url('community/forums').'/'.$discusstion->discussion_slug }}">
                               {{ str_limit( $discusstion->discussion_title, 20)  }}</a>
                               <p class="dash-community-item-description">
                                 {{ str_limit( strip_tags ( $discusstion->discussions_text ), 150) }}
                               </p>
                            </div>
                            <footer class="dash-community-item-footer">
                               <a class="subtitle" href="{{ url('community/forums').'/'.$discusstion->discussion_slug }}">View discussion</a>
                            </footer>
                         </div>
                      </div>
                      @endforeach
                    </div>
                   @endif
                   <div class="text-right mt20">
                      <a href="{{ url('community') }}" class="link--primary"> Go to the PerfectWedding Community <i class="icon icon-arrow-right-red icon-right"></i>
                      </a>
                   </div>
                </div>
             </div>
             <div class="pure-u-3-10 mt10">
                <div class="cardPromo cardPromo--wedsites app-link app-ua-track-event" data-track-c="PlanningToolsAuthed" data-track-a="a-click" data-track-l="d-desktop+s-home_cards_share_website" data-track-v="0" data-track-ni="0" data-href="/website#opentab-ShareWebsite">
                   <div class="pure-g">
                      <div class="pure-u-2-3 pr20">
                         <p class="cardPromo__title">Wedding Website</p>
                         <span class="cardPromo__counter strong">8</span>
                         <p class="cardPromo__description">visits</p>
                         <a class="link--primary small upper strong" href="https://www.weddingwire.ca/website/home#opentab-ShareWebsite">Share website</a>
                      </div>
                      <div class="pure-u-1-3">
                         <img class="block" width="200%" src="https://cdn1.weddingwire.ca/assets/img/wedsites/thumbs/en/thumb_big_landscape_9.png">
                      </div>
                   </div>
                </div>
                <div class="cardPromo cardPromo--wedshoots app-link app-ua-track-event" data-track-c="PlanningToolsAuthed" data-track-a="a-click" data-track-l="d-desktop+s-home_cards_share_album_wedshoots" data-track-v="0" data-track-ni="0" data-href="/album-BuscarInvitados.php?origen=1&amp;idAlbum=22115">
                   <p class="cardPromo__title">Invite your guests</p>
                   <p class="cardPromo__description">Guests can like, comment on, and share photos and videos</p>
                   <a class="link--primary small upper strong" href="/album-BuscarInvitados.php?origen=1&amp;idAlbum=22115">Share</a>
                </div>

                <div class="cardPromo cardPromo--app">
                   <img class="mb10" width="65" src="https://cdn1.weddingwire.ca/assets/img/dropdown/app.png" srcset="https://cdn1.weddingwire.ca/assets/img/dropdown/app.png 1x, https://cdn1.weddingwire.ca/assets/img/dropdown/app@2x.png 2x">
                   <p class="cardPromo__title">Get the PerfectWeddingday app</p>
                   <p class="cardPromo__description">Easily plan your wedding anytime, anywhere with the PerfectWedding app</p>
                   <a class="mr10 app-ua-track-event" data-track-c="PlanningToolsAuthed" data-track-a="a-click" data-track-l="d-desktop+s-home_cards_download_app_ios" data-track-v="0" data-track-ni="0" href="https://app.appsflyer.com/id1066371932?pid=WP-iOS-CA&amp;c=WP-CA-LANDINGS&amp;s=ca">
                   <img height="45" src="https://cdn1.weddingwire.ca/assets/img/store/btn-appstore_en.svg">
                   </a>
                   <a class="app-ua-track-event" data-track-c="PlanningToolsAuthed" data-track-a="a-click" data-track-l="d-desktop+s-home_cards_download_app_android" data-track-v="0" data-track-ni="0" href="https://app.appsflyer.com/ca.weddingwire.launcher?pid=WP-Android-CA&amp;c=WP-CA-LANDINGS">
                   <img height="45" src="https://cdn1.weddingwire.ca/assets/img/store/btn-gplay_en.svg">
                   </a>
                </div>
             </div>
          </div>
        </div>  
          <!-- ends -->


<!--           <div class="upcoming-task-wrap">
              <div class="pure-g">
                    <div class="pure-u-7-10">
                        <div class="mr40">
                          <p class="dash-title">
                            <span class="dash-checklist-complete dash-subtitle fright">{{$data['listData']['complete'] ?? 0}} of {{$data['listData']['total'] ?? 0}} completed</span>
                            <a href="#" class="dash-checklist-title dash-title">Upcoming tasks </a>
                          </p>
                    <div class="dash-checklist checklist-tasks">
                        <ul>
                            @if(isset($data['listData']['pending_task']) && !empty($data['listData']['pending_task']))
                              @foreach($data['listData']['pending_task'] as $pendingD)
                              <li class="checklist-tasks-item app-link">
                                  <div class="checklist-tasks-item-checkBox">
                                    <a><i class="icon-tools icon-tools-checkbox-grey"></i></a>
                                  </div>
                                  <div class="checklist-tasks-item-description">
                                      <p class="checklist-tasks-item-title"><a href="{{url('tools/todolist-task-details?taskid=')}}{{$pendingD['list_id']}}">{{$pendingD['title']}}</a></p>
                                      <span class="checklist-tasks-item-tag">{{$pendingD['category']}}</span>
                                  </div>
                              </li>
                              @endforeach
                            @endif 
                        </ul>
                    </div>
                    <div class="dash-checklist-footer">
                        <a href="{{url('tools/to-do-list')}}" class="app-icon-hover" data-icon-old="icon-arrow-right" data-icon-new="icon-arrow-right-red">
                            {{$data['listData']['pending'] ?? 0}} pending tasks <i class="icon icon-arrow-right icon-right"></i>
                        </a>
                    </div> -->

                     <!--  <p class="dash-title mb20 mt30">Wedding Style</p>
                        <div class="dash-wedding mb40">
                                  <div id="misTags">
                          <ul class="profile-aboutwedding pure-g row profile-aboutwedding-editprofile">
                                      <li class="pure-u-1-3">
                                    <div class="box app-container">
                                        <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                                          <div class="pt5">
                                                            <i data-grupo="1" class="app-perfil-show icon icon-about-color-purple"></i>
                                              </div>
                                                            <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                        </div>
                                        <div class="profile-aboutwedding-content">
                                            <span class="color-grey">Colour</span>
                                            <span class="profile-aboutwedding-label" data-grupo="1">Purple</span>
                                                            <a href="#">1,672 couples</a>
                                                      </div>
                                    </div>
                                </li>
                                      <li class="pure-u-1-3">
                                    <div class="box app-container">
                                        <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                            <div class="profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old">
                                                <i data-grupo="3" class="icon icon-miss"></i>
                                            </div>
                                            <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                        </div>
                                        <div class="profile-aboutwedding-content">
                                            <span class="color-grey">Season</span>
                                            <span class="profile-aboutwedding-label" data-grupo="3">...</span>
                                            <span></span>
                                        </div>
                                    </div>
                                </li>
                                      <li class="pure-u-1-3">
                                    <div class="box app-container">
                                        <div class="profile-aboutwedding-icon app-aboutwedding-show">
                                            <div class="profile-aboutwedding-icon-miss profile-aboutwedding-icon-miss-old">
                                                <i data-grupo="2" class="icon icon-miss"></i>
                                            </div>
                                            <i class="profile-aboutwedding-edit app-perfil-show icon icon-edit-red"></i>
                                        </div>
                                        <div class="profile-aboutwedding-content">
                                            <span class="color-grey">Style</span>
                                            <span class="profile-aboutwedding-label" data-grupo="2"> ... </span>
                                            <span></span>
                                        </div>
                                    </div>
                                </li>
                                </ul>
                            </div>
                        </div> -->
                  <!-- <p class="dash-title mb20 mt30">My Community</p>
                  <div class="dash-community-new">
                      <form action="" method="post">
                          <div class="dash-community-new-avatar">
                              <div class="avatar">
                                <div class="avatar-alias size-avatar-large ">
                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                    <text transform="translate(100,130)" y="0">
                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">D</tspan>
                                    </text>
                                </svg>
                            </div>
                        </div>
                          </div>
                          <div class="dash-community-new-comment">
                              <input type="text" class="dash-community-new-input" name="message" placeholder="Questions? Create a new discussion!">
                          </div>
                          <input class="dash-community-new-button btn-flat red" type="submit" value="Send">
                      </form>
                  </div> -->

                 <!--  <div class="pure-g hide">
                          <div class="pure-u-1-3 dash-community-item-box">
                            <div class="dash-community-item">
                                <div class="dash-community-item-content">
                                    <div class="dash-community-item-avatar">
                                        <div class="avatar  ">
                                          <figure>
                                            <img class="avatar-thumb" src="{{url('public/images/utmr_230916.jpg')}}" alt="">
                                </figure>
                            </div>
                                    </div>
                                    <a class="dash-community-item-title" href="#">Lorem ipsum dolor</a>
                                    <p class="dash-community-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate<span class="app-common-ellipsis">...</span></p>
                                </div>
                                <footer class="dash-community-item-footer">
                                    <a class="subtitle" href="#">
                                        View discussion                    </a>
                                </footer>
                            </div>
                      </div>
                              <div class="pure-u-1-3 dash-community-item-box">
                              <div class="dash-community-item">
                                  <div class="dash-community-item-content">
                                      <div class="dash-community-item-avatar">
                                        <div class="avatar  ">
                                          <figure>
                                            <img class="avatar-thumb" src="{{url('public/images/community-img.jpg')}}" alt="">
                                </figure>
                            </div>
                                    </div>
                                      <a class="dash-community-item-title" href="#">Lorem ipsum dolor</a>
                                    <p class="dash-community-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate<span class="app-common-ellipsis">...</span></p>
                                  </div>
                                  <footer class="dash-community-item-footer">
                                      <a class="subtitle" href="#">
                                          View discussion                    </a>
                                  </footer>
                              </div>
                          </div>
                              <div class="pure-u-1-3 dash-community-item-box">
                              <div class="dash-community-item">
                                  <div class="dash-community-item-content">
                                      <div class="dash-community-item-avatar">
                                          <div class="avatar  ">
                                            <figure>
                                            <img class="avatar-thumb" src="{{url('public/images/wedding-pic.jpg')}}" alt="">
                                </figure>
                            </div>
                                      </div>
                                     <a class="dash-community-item-title" href="#">Lorem ipsum dolor</a>
                                    <p class="dash-community-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate<span class="app-common-ellipsis">...</span></p>
                                  </div>
                                  <footer class="dash-community-item-footer">
                                      <a class="subtitle" href="#">
                                          View discussion                    </a>
                                  </footer>
                              </div>
                          </div>
                      </div> -->
<!--                 </div>
            </div>

        </div>
        </div> -->
        </div>
      </div>
</section>
<style type="text/css">
    .icon-tools-search::before {
        background-position: -76px -76px;
        height: 17px;
        width: 17px;
    }
</style>
<?php  /* @include('includes.hot-deal') */ ?> 
<!-- / END Dashboard SECTION-->
@include('includes.search_vendor_popup')
<!-- Add Vendor Modal -->
@include('includes.my_wedding_popup')
@include('includes.crop_popup')
@include('includes.modal_Init_planner')
<script src="{{ URL::asset('public/js/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('public/js/croppie.js') }}"></script>
<script src="{{ URL::asset('public/js/custom-crop.js') }}"></script>
<script>
        $(document).ready(function(){
            CustomeCrop.init();
        });
</script>
<script src="{{ URL::asset('public/js/jquery.cropit.js') }}"></script>
<script>
          $('.image-editor').cropit({
              exportZoom: 1.25,
              imageBackground: true,
              imageBackgroundBorderWidth: 20,
              'minZoom': 2,
            'allowDragNDrop': false,
            'smallImage': 'allow',
            'maxZoom' : 5
          });   

          $('.profileImage-save').click(function() {
              var imageData = $('.image-editor').cropit('export');
              $('#imageData').val(imageData);
              $('#formAddProfilePic').submit();

          });

          $('.profileImage').click(function(){
             $('.author-image a').parent().hide();
             $('.image-editor').fadeIn('slow');
             $('.cropit-image-input').click();
          });

          $('.profileImage-cancel').click(function(){
              $('.image-editor').hide();
              $('.author-image a').parent().fadeIn();
              
          });

          var weddingDate = '<?php echo isset($user_partner[0]["wedding_date"])?date("M d, Y",strtotime($user_partner[0]["wedding_date"])):"0"; ?>';
          var countDownDate = new Date(weddingDate+" 00:00:00").getTime();
              // Update the count down every 1 second
              var x = setInterval(function() {
                  // Get todays date and time
                  var now = new Date().getTime();                  
                  // Find the distance between now an the count down date
                  var distance = countDownDate - now;                  
                  // Time calculations for days, hours, minutes and seconds
                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                  // Output the result in an element with id="defaultCountdown"
                  document.getElementById("defaultCountdown").innerHTML = "<span><small>days!</small>" + days + "</span> <span><small>hours</small>" + hours + "</span> <span><small>min.</small>"
                  + minutes + "</span>  <span><small>sec.</small>" + seconds + "</span> ";
                  // If the count down is over, write some text 
                  if (distance < 0) {
                      clearInterval(x);
                      document.getElementById("defaultCountdown").innerHTML = "";
                  }
              }, 1000);

        $('document').ready(function() {
            var showPlanner = '{{$showPlanner}}';
            if(showPlanner == '1'){
               $('#initPlanner').modal('show'); 
            }
         });
</script>
  <script>
  $( function() {
      var availableTags = <?php echo  json_encode($data['vendorSearch']) ?>;

    var $elem = $("#suProvider-add-vendor").autocomplete({ 
        source: availableTags,
        select: function( event, ui ) {
          $( "#suProvider-add-vendor" ).val( ui.item.value );
          $( "#suProvider_id-add-vendor" ).val( ui.item.key );
          return false;
        } 
      }),
    elemAutocomplete = $elem.data("ui-autocomplete") || $elem.data("autocomplete");
    if (elemAutocomplete) {
        elemAutocomplete._renderItem = function (ul, item) {
            ul.addClass('sharereview');
            var newText = String(item.value).replace(
                    new RegExp(this.term, "gi"),
                    "<span class='ui-state-highlight'>$&</span>");

            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<div>" + newText + "</div>")
                .appendTo(ul);
        };
    }


  } );
  </script>
@include('includes.footer')
@endsection       
