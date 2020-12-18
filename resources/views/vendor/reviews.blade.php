@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap review_main_wrp dash_main_sect">
    @include('vendor.tools_nav')
    <div class="wrapper">
       <div class="pure-g">
          <div class="pure-u-2-7">
             <div class="mr40">
                <nav class="adminAside review_list">
                   <a class="adminAside__item active" href="{{url('reviews')}}">
                      <i class="svgIcon svgIcon__gear adminAside__icon">
                         <svg viewBox="0 0 18 20">
                            <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                         </svg>
                      </i> REVIEW REQUEST
                   </a>
                   <a class="adminAside__item " href="{{url('/reviews-list')}}">
                      <i class="svgIcon svgIcon__note adminAside__icon">
                         <svg viewBox="0 0 18 19">
                            <path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
                         </svg>
                      </i> REVIEWS
                   </a>
                   <a class="adminAside__item " href="{{url('/reviews-sellos')}}">
                      <i class="svgIcon svgIcon__seals adminAside__icon">
                         <svg viewBox="0 0 19 18">
                            <path d="M17.488 16.895h-.067c-.006.021.02.014.078.006l-.01-.006zm-.218 0V1h-16v15.895h16zm.33 1H.653c-.192 0-.383-.19-.383-.476V.476C.27.286.461 0 .749 0H17.79c.192 0 .479.19.479.476v16.943c-.191.285-.383.476-.67.476zm-2.007-7.03a.5.5 0 0 1-.393.809h-12a.5.5 0 0 1-.393-.81l1.33-1.69-1.33-1.691a.5.5 0 0 1 .393-.81h12a.5.5 0 0 1 .393.81l-1.33 1.69 1.33 1.692zm-2.358-1.382a.5.5 0 0 1 0-.618l.936-1.191H4.229l.936 1.19a.5.5 0 0 1 0 .619l-.936 1.19h9.942l-.936-1.19z" fill-rule="nonzero"></path>
                         </svg>
                      </i> MHS ALL STAR TEAM™
                   </a>
                   <a class="adminAside__item " href="{{url('/reviews-widget')}}">
                      <i class="svgIcon svgIcon__gear adminAside__icon">
                         <svg viewBox="0 0 18 20">
                            <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
                         </svg>
                      </i> REVIEWS WIDGET
                   </a>
                </nav>
             </div>
          </div>

          <div class="pure-u-5-7">
             <h1 class="adminTitle">
                Review Request            
             </h1>
             <div class="adminAlert adminAlert--flex">
                <i class="icon-vendors-admin-alerts icon-vendors-admin-alerts-reviews"></i>
                <div>
                   <p class="adminAlert__title review_count">
                      You have received {{ (count($data['ratingData']) - count($data['pendingRequest'])) }} reviews                        
                   </p>
                   <p class="adminReviewsSummary reivew_summ_text">
                      <i class="adminReviewsSummary__icon icon-vendor icon-vendor-send"></i>{{ count($data['ratingData']) }} request sent
                   </p>
                   <p class="adminReviewsSummary reivew_summ_text">
                      <i class="adminReviewsSummary__icon icon icon-tooltip-clock"></i>{{ count($data['pendingRequest']) }} not replied to
                   </p>
                   <p class="adminReviewsSummary reivew_summ_text">
                      <i class="adminReviewsSummary__icon icon icon-tooltip"></i>{{ count($data['withoutPicRequest']) }} without a photo
                   </p>
                </div>
             </div>
              @if (Session::has('message'))
              <div id="app-alert-no-leida" class="app-alert adminAlert adminAlert--success" style="">
                  <p> {{ Session::get('message') }} </p>
              </div>
              @endif
              <form class="pure-form mb20" id="reviewrequestSend" name="reviewrequestSend" method="post" action="{{ url('/send-reviews-request') }}">
                {{ csrf_field() }}
                <div class="border p30 review_reci_frm">
                   <div class="pb5 reviewCollector__addUsers collector_wrp">
                      <p class="adminSubtitle">Recipients</p>
                      <p class="adminSubtitleText">Edit and send this message to request reviews from your clients. You will also receive a copy of the email.</p>
                      <div class="mb10 app-va-reviews-dest">
                         <div class="pure-u-1-16 mt10" style="width:5%;">
                            <strong>To:</strong>
                         </div>
                          <div class="pure-u-15-16">
                              <ul class="app-cloneBox bubbler importClients"></ul> <!-- importClients.html() is used to get data -->
                          </div>
                      </div>
                      <div class="mb10 app-review-collector-templates-user-form">
                          <div class="pure-u-1-3 drop-wrapper">
                              <input class="reviewCollector__addUsers__input app-review-collector-templates-users-input name-search-input" placeholder="Name" name="nombres" type="text" autocomplete="address-level4">
                              <ul id="name_datalist"></ul>
                              <span id="nombres_err" style="color:#ff3535;font-size:18px;display:none;">Minimum 3 characters</span>
                          </div>
                          <div class="pure-u-1-2 ml10 drop-wrapper">
                              <input class="reviewCollector__addUsers__input app-review-collector-templates-users-input email-search-input" placeholder="Email" name="mails" type="text" autocomplete="address-level4">
                              <ul id="email_datalist"></ul>
                              <span id="mails_err" style="color:#ff3535;font-size:18px;display:none;">Minimum 3 characters</span>
                              <span id="invalidMails_err" style="color:#ff3535;font-size:16px;display:none;">The e-mail is missing and/or invalid.</span>
                          </div>
                          <div class="pure-u-1-16 ml10 pt5">
                              <span class="reviewCollector__addButton btnFlat btnFlat--primary btnFlat--small app-reviews-add-user" role="button"> Add </span>
                          </div>
                      </div>
                   </div>
                   <div class="mb10 app-va-reviews-dest">
                      <div class="rct-actions-container import_client_wrp">
                         <a class="link--primary pointer" role="button" onclick="va_opinionesImportModal();">
                         <i class="icon icon-tools icon-tools-import-red icon-left"></i>Import clients </a>
                         <label for="import-csv" class="pull-left" style="cursor:pointer;">
                            <i class="icon icon-tools icon-tools-import-red icon-left"></i>Import CSV
                            <input type="file" class="hidden" id="import-csv" name="import_csv">
                         </label>
                      </div>
                      <div class="mt20 cc_detail_wrp">
                         <strong>CC:</strong> {{ $data['vendorData'][0]['email'] }}
                      </div>
                   </div>
                   <div class="mt30 relative collector_wrp">
                      <div class="app-va-template-selector reviewCollector__templatesSelector">
                         <div class="app-ui-dropdown">
                            <span class="template_head">Template</span> <i class="icon icon-arrow-down"></i>
                            <input type="hidden" name="template_id" />
                            <ul class="app-ui-dropdown-layer adminFiltersBox__dropdown reviewCollector__dropdown app-va-select-template-dropdown template-dropdown template_list" style="display:none;">
                              <li>
                                  <a class="" href="{{url('/reviews-templates')}}">
                                     <span class="reviewCollector__pencil">
                                        <i class="svgIcon svgIcon__pencil ml5">
                                           <svg viewBox="0 0 18 18">
                                              <path d="M16.007 3.679a1.063 1.063 0 0 0 0-1.533 1.064 1.064 0 0 0-1.533 0L2.723 13.896l-.657 2.19 2.19-.656 11.75-11.751zM4.664 16.35l-3.2.96a.5.5 0 0 1-.623-.622l.96-3.2a.5.5 0 0 1 .125-.21l11.84-11.84a2.064 2.064 0 0 1 2.948 0 2.063 2.063 0 0 1 0 2.947l-11.84 11.84a.5.5 0 0 1-.21.125zM15.754 4.64a.5.5 0 0 1-.708.707l-2.24-2.24a.5.5 0 0 1 .708-.707l2.24 2.24zm-10.88 10.88a.5.5 0 0 1-.708.707l-2.24-2.24a.5.5 0 0 1 .708-.707l2.24 2.24z" fill-rule="nonzero"></path>
                                           </svg>
                                        </i>
                                     </span>
                                     Manage templates
                                  </a>
                              </li>
                              @foreach($data['reviewTemplate'] as $rt)
                              <li>
                                  <a class="app-choose-review-template strong" href="javascript:void(0)" onclick="fetchTemplate('{{ $rt->id }}')">{{ $rt->name }}</a>
                              </li>
                              @endforeach
                            </ul>
                         </div>
                      </div>
                      <p class="adminSubtitle">Message</p>
                      <p class="color-grey">Dear [Name]</p>
                      <textarea class="adminTextarea reviews-textarea app-reviews-textarea" name="review_message" rows="10" data-allow-enter="true">It was a privilege to provide you with our health service and we hope we can see you again if you need further service or treatment.
                      If you have a few moments, could you provide a review of our services on My Health Squad. These reviews help us build a better and healthier community.
                      
Thank you in advance for your feedback. We greatly appreciate your help!</textarea>
                      <small class="color-grey mt10 block">Note: a link to write a review directly on your Profile will be included in the email. [Link]</small>
                      <div class="mt10">
                        <div class="savetemplatereview" style="display: inline-block;">
                             <div class="icheckbox_minimal" style="position: relative;"><input type="checkbox" id="SaveAsTemplate" name="saveAsTemplate" class="app-save-as-template" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             <label for="SaveAsTemplate" class="save_label">Save as template</label>
                        </div>
                        <div class="reviewCollector__templateDetails app-template-details mt10 reviewappshow" style="display:none;">
                            <input type="text" maxlength="100" name="templateName" placeholder="Template name" class="reviewCollector__templateName" style="width: 100%">
                            <div class="set-as-default mt5">
                                <div class="satasdefaultcls">
                                  <div class="icheckbox_minimal" style="position: relative;">
                                      <input type="checkbox" id="SetAsDefault" name="setAsDefault" class="app-set-as-default reviewCollector__setAsDefault" style="opacity: 0;">
                                  </div>
                                  <label for="SetAsDefault">Set as default</label>
                                </div>
                            </div>
                        </div>
                      </div>
                       <input class="pure-u-1" name="reviewrequesturl" type="hidden" value="{{ url('/vendor/'.$data['venderPageslug'][0]->business_name_slug) }}">
                       <input class="btnFlat btnFlat--primary mt15 app-submit-review-request send_btn disabled" type="submit" name="submit" value="Send">
                   </div>
                </div>
             </form>
             <p class="mt30 send_text">Send this personalized URL to your past clients and patients for a quick way to receive reviews for your services.</p>
             <div class="mb40 share_detail_wrp">
                <div class="box p30">
                   <p class="adminSubtitle">Share your personalized review URL</p>
                   <div class="pure-form">
                      <input class="pure-u-1" type="text" onclick="this.focus();this.select();" readonly="readonly" value="{{ url('/vendor').'/'.$data['venderPageslug'][0]->business_name_slug }}">
                   </div>
                   <div class="mt15">
                      <!--<span rel="nofollow" class="mr10 btnOutline btnOutline--grey icon icon-facebook" onclick="common_social_share_opinion_fb('https://www.PerfectWedding.ca/shared/rate/17879','17879', );"></span>-->
                      <!--<span rel="nofollow" class="btnOutline btnOutline--grey icon icon-twitter" onclick="common_social_share_opinion_twitter('https://www.PerfectWedding.ca/shared/rate/17879','','17879', );"></span>-->
                   </div>
                </div>
             </div>
             <h2 class="adminTitle">Review requests sent</h2>
             <ul class="adminFilters review_request_list">
                <li class="adminFilters__item">
                   <a role="button" class="adminFilters__link adminFilters__link--current app-change-filter-recomendaciones all_review" onclick="show_reviews('All');"> All </a>
                </li>
                <!--<li class="adminFilters__item">
                   <a role="button" class="adminFilters__link app-change-filter-recomendaciones pending_review" data-filter="noAtendidas" onclick="show_reviews('Pending');"> Pending </a>
                </li>-->
             </ul>
             <div class="app-container-recomendaciones all_reviews">
                <form name="frmAdminReviews" id="frmAdminReviews" onsubmit="adminReviewsChange();return false;">
                   <input type="hidden" id="filter" name="filter" value="">
                   <input type="hidden" id="NumPage" name="NumPage" value="1">
                </form>
                <div class="pure-g row">
                  <?php $allReview = 0; ?>
                  @foreach($data['reviewRequest'] as $rqst)
                    @php
                      $allReview++;
                      $shortName = str_replace(substr($rqst->requester_name, 1),'',$rqst->requester_name);
                    @endphp
                    <div class="pure-u-1-2">
                      <div class="admin-reviews-minibox box">
                         <div class="pure-g admin-reviews-minibox-content">
                            <div class="pure-u-1-6">
                               <div class="avatar  ">
                                  <div class="avatar-alias size-avatar-xmedium ">
                                     <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                        <circle fill="#EAD6C3" cx="100" cy="100" r="100"></circle>
                                        <text transform="translate(100,130)" y="0">
                                           <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ strtoupper($shortName) }}</tspan>
                                        </text>
                                     </svg>
                                  </div>
                               </div>
                            </div>
                            <div class="pure-u-5-6 pl15">
                               <a class="admin-reviews-minibox-name" rel="nofollow" href="javascript:;"> {{ $rqst->requester_name }} </a>
                               <p class="admin-reviews-minibox-date">
                                  @if($rqst->request_status == 1)
                                    Received on {{ date_format(date_create($rqst->created_at),'d/m/Y') }}<br/>
                                    @if($rqst->profile_pic == '1')
                                      <span class="admin-reviews-minibox-tag success" style="cursor:not-allowed;">Asked for a profile picture </span>
                                    @else
                                      <span class="admin-reviews-minibox-tag addProfile" onclick="addProfilePictureModal('{{ $rqst->id }}','{{ $rqst->requester_name }}');" style="cursor:pointer;">Asked for a profile picture </span>
                                    @endif
                                  @else
                                    Sent on {{ date_format(date_create($rqst->created_at),'d/m/Y') }}<br/>
                                    <span class="block app-info-recomendaciones-send">{{ $rqst->request_count }} sent </span>
                                  @endif
                               </p>
                            </div>
                          </div>
                          <?php
                            $timestamp1 = strtotime($rqst->created_at);
                            $timestamp2 = strtotime(date('Y-m-d H:i:s'));
                            $dayDiff = round((($timestamp2 - $timestamp1)/ 3600 )/ 24);
                          ?>
                          <footer class="admin-reviews-minibox-footer disabled app-btn-recomendacion review_send_btn">
                            @if($rqst->request_status == 0 && $dayDiff >= 15)
                            <span class="admin-reviews-minibox-action disabled" disabled="">
                                <a href="javascript:void(0)" onclick="sendRequestAgain('{{ $rqst->id }}')"><i class="icon icon-envelope-grey"></i> Send request again </a>
                            </span>
                            @elseif($rqst->request_status == 1)
                            <a class="admin-reviews-minibox-action" href="javascript:void(0)" onclick="view_reviews('{{ $rqst->id }}','{{ $rqst->requester_name }}');">
                                <i class="icon icon-eye-grey"></i> View review
                            </a>
                            @else
                            <span class="admin-reviews-minibox-action disabled" disabled="">
                                <i class="icon icon-envelope-grey"></i> Send request again
                                <span class="admin-reviews-minibox-tooltip review_send_detail" style="display:none;"> This client has already received a request in the last 15 days. You must wait {{ 15-$dayDiff }} days before asking them for a review. </span>
                            </span>
                            @endif
                          </footer>
                      </div>
                   </div>
                  @endforeach
                  @if($allReview == 0)
                    <div class="pure-u-1-2">
                      <div class="admin-reviews-minibox box">
                         <div class="admin-reviews-minibox-content">
                            <h3>No Request Found !!</h3>
                         </div>
                      </div>
                    </div>
                  @endif
                </div>
             </div>
             <div class="app-container-recomendaciones pending_reviews" style="display:none;">
                <div class="pure-g row">
                  <?php $pendReview = 0; ?>
                  @foreach($data['reviewRequest'] as $rqst)
                    @if($rqst->request_status == 0)
                    @php
                        $pendReview++;
                        $shortName = str_replace(substr($rqst->requester_name, 1),'',$rqst->requester_name);
                    @endphp
                    <div class="pure-u-1-2">
                      <div class="admin-reviews-minibox box">
                         <div class="pure-g admin-reviews-minibox-content">
                            <div class="pure-u-1-6">
                               <div class="avatar  ">
                                  <div class="avatar-alias size-avatar-xmedium ">
                                     <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                        <circle fill="#EAD6C3" cx="100" cy="100" r="100"></circle>
                                        <text transform="translate(100,130)" y="0">
                                           <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ strtoupper($shortName) }}</tspan>
                                        </text>
                                     </svg>
                                  </div>
                               </div>
                            </div>
                            <div class="pure-u-5-6 pl15">
                               <a class="admin-reviews-minibox-name" rel="nofollow" href="javascript:;"> {{ $rqst->requester_name }} </a>
                               <p class="admin-reviews-minibox-date">
                                  @if($rqst->request_status == 1)
                                    Received on {{ date_format(date_create($rqst->created_at),'d/m/Y') }}<br/>
                                    @if($rqst->profile_pic == '1')
                                      <span class="admin-reviews-minibox-tag success" style="cursor:not-allowed;">Asked for a profile picture </span>
                                    @else
                                      <span class="admin-reviews-minibox-tag addProfile" onclick="addProfilePictureModal('{{ $rqst->id }}','{{ $rqst->requester_name }}');" style="cursor:pointer;">Asked for a profile picture </span>
                                    @endif
                                  @else
                                    Sent on {{ date_format(date_create($rqst->created_at),'d/m/Y') }}<br/>
                                    <span class="block app-info-recomendaciones-send">{{ $rqst->request_count }} sent </span>
                                  @endif
                               </p>
                            </div>
                          </div>
                          <?php
                            $timestamp1 = strtotime($rqst->created_at);
                            $timestamp2 = strtotime(date('Y-m-d H:i:s'));
                            $dayDiff = round((($timestamp2 - $timestamp1)/ 3600 )/ 24);
                          ?>
                          <footer class="admin-reviews-minibox-footer disabled app-btn-recomendacion review_send_btn">
                            @if($rqst->request_status == 0 && $dayDiff >= 15)
                            <span class="admin-reviews-minibox-action disabled" disabled="">
                                <a href="javascript:void(0)" onclick="sendRequestAgain('{{ $rqst->id }}')"><i class="icon icon-envelope-grey"></i> Send request again </a>
                            </span>
                            @elseif($rqst->request_status == 1)
                            <a class="admin-reviews-minibox-action" href="javascript:void(0)" onclick="view_reviews('{{ $rqst->id }}','{{ $rqst->requester_name }}');">
                                <i class="icon icon-eye-grey"></i> View review
                            </a>
                            @else
                            <span class="admin-reviews-minibox-action disabled" disabled="">
                                <i class="icon icon-envelope-grey"></i> Send request again
                                <span class="admin-reviews-minibox-tooltip review_send_detail" style="display:none;"> This client has already received a request in the last 15 days. You must wait {{ 15-$dayDiff }} days before asking them for a review. </span>
                            </span>
                            @endif
                          </footer>
                      </div>
                   </div>
                   @endif
                  @endforeach
                  @if($pendReview == 0)
                    <div class="pure-u-1-2">
                      <div class="admin-reviews-minibox box">
                         <div class="admin-reviews-minibox-content">
                            <h3>No Pending Request Found !!</h3>
                         </div>
                      </div>
                    </div>
                  @endif
                </div>
             </div>
          </div>
       </div>
    </div>
</section>
<!-- View review modal -->
<div id="app-common-layer" class="viewReview modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-extralarge">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="adminModalTitle"></h2>
            </div>
            <div class="adminReviewsItem admin-reviews-item-modal"></div>
        </div>
    </div>
</div>
<!-- Reply on review modal -->
<div id="reply-common-layer" class="viewReview modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog">
        <div class="modal__content">
            <div class="modal__header flex">
                <button type="button" class="close app-review-close-modal" data-dismiss="modal" aria-hidden="true">
                    <svg class="close__icon" x="0px" y="0px" width="15px" height="15px">
                        <line x1="0" y1="15" x2="15" y2="0"></line>
                        <line x1="15" y1="15" x2="0" y2="0"></line>
                    </svg>
                </button>
                <div class="modalReviewBox__avatar">
                    <div class="avatar  ">
                        <div class="avatar-alias size-avatar-xlarge ">
                            <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                <circle fill="#BCB0B5" cx="100" cy="100" r="100"></circle>
                                <text transform="translate(100,130)" y="0">
                                    <tspan font-size="90" class="shortName" fill="rgba(0,0,0,0.3)" text-anchor="middle"></tspan>
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="fullName"></h3>
                    <small class="color-grey mt5 block">Write at least 30 characters about your experience. Include any details that will help other couples make their hiring decision.</small>
                </div>
            </div>
            <form class="app-review-reply-form" action="{{ url('saveReviewReply') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal__body">
                    <div class="app-review-form">
                        <input type="hidden" name="reqId" id="reqId">
                        <input type="hidden" name="rateId" id="rateId">
                        <p class="mb20">It is very important to personalize each review reply. It will be displayed on your Storefront, and past and future couples will be able to see it.</p>
                        <label class="strong" for="respuesta">Reply:</label>
                        <textarea id="reply_text" name="reply_text" class="border pure-u-1 mt5" rows="5" placeholder="Enter your reply"></textarea>
                    </div>
                    <div class="app-review-photo-upload" style="display: none;">
                        <p class="mb20">Include photos with your review to give other couples additional examples of this vendor’s past work.</p>
                        <label id="app-upload-droparea" for="reply_image">
                            <div id="app-upload-click" class="modalReviewUpload">
                                <div>
                                    <i class="icon-vendor icon-vendor-camera"></i>
                                    <span class="block mt15">Drag and drop photos here or <span class="link">upload from your device</span></span>
                                    <input type="file" id="reply_image" name="reply_image" style="display:none;">
                                </div>
                            </div>
                        </label>
                        <div class="app-review-image-container pure-g modalReviewBox">
                            <img id="reply_image_preview" src="#" alt="your image" style="display:none;height:100px;width:100px;object-fit:contain;border:1px solid grey;"/>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="modal__footer text-center">
                        <button class="app-review-next-step btnFlat btnFlat--primary nextBTN" type="button" onclick="review_next_step();"> Next </button>
                        <button class="app-review-previous-step btnOutline btnOutline--primary goBackBTN dnone" type="button" onclick="review_previous_step();"> Go back </button>
                        <button class="btnFlat btnFlat--primary app-review-submit-step replyBTN dnone" type="submit"> Reply </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Import Clients -->
<div id="app-va-modal" class="modal fade dnone" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-large">
        <div class="modal-content app-review-request-importer" data-check-selector="icon-tools-checkbox-grey" data-check-selector-green="icon-tools-checkbox-green">
            <button type="button" class="close close-white" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="adminModalImport__title"><h3>Add from bookings</h3></div>
            <div class="adminModalImport__search app-import-booking-search">
                <i class="svgIcon svgIcon__search import-search-input-icon"><svg viewBox="0 0 74 77"><path d="M49.35 48.835l23.262 23.328a2.316 2.316 0 1 1-3.28 3.27L45.865 51.901a28.534 28.534 0 0 1-17.13 5.683C12.867 57.584.014 44.7.014 28.8.014 12.896 12.865.015 28.735.015 44.593.015 57.446 12.9 57.446 28.8a28.728 28.728 0 0 1-8.097 20.035zM52.813 28.8c0-13.345-10.782-24.153-24.079-24.153-13.31 0-24.089 10.805-24.089 24.153 0 13.344 10.782 24.152 24.09 24.152 13.294 0 24.078-10.811 24.078-24.152z" fill-rule="nonzero"></path></svg></i>            <input class="search-box-input" type="text" placeholder="Search" clients...="">
            </div>
            <div class="adminModalImport__tabs app-admin-modal-import-tabs mt15 mb20">
                <span class="app-admin-modal-import-tabs-all selected_all selected mr10" data-selected="true" data-booked="false">ALL</span>
                <span class="app-admin-modal-import-tabs-booked selected_booked ml10" data-selected="false" data-booked="true">BOOKED</span>
            </div>
            <!-- For All -->
            <div class="border-top rctChecklistTasks all-solicitudes lazyLoad-effect" data-booked="false">
                @foreach($data['allData'] as $ad)
                <div class="importBookingRow app-import-booking-row rctChecklistTasks__item pt10 pb10">
                    <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox">
                        <a class="rctChecklistTasks__checkBoxLink" data-name="{{ $ad->name }}" data-mail="{{ $ad->email }}">
                            <i class="icon-tools icon-tools-checkbox-grey"></i>
                        </a>
                    </div>
                    <div class="rctChecklistTasks__description">
                        <p class="rctChecklistTasks__title"> {{ $ad->name }} </p>
                        <span class="rctChecklistTasks__tag"> {{ $ad->email }} </span>
                    </div>
                    <div class="importBookingRow__date"> {{ date('d/m/Y', strtotime($ad->created_at)) }} </div>
                </div>
                @endforeach
                <div class="app-review-request-loader adminModalImport__loader flex flex-center p20 dnone" style="display: none;">
                    <span class="loader loader-small loader--inline in"></span>
                </div>
            </div>
            <!-- For Booked -->
            <div class="rctChecklistTasks booked-solicitudes lazyLoad-effect dnone" data-booked="true">
                @foreach($data['bookData'] as $bd)
                <div class="importBookingRow app-import-booking-row rctChecklistTasks__item pt10 pb10">
                    <div class="app-checklist-tasks-item-checkBox rctChecklistTasks__checkBox">
                        <a class="rctChecklistTasks__checkBoxLink" data-name="{{ $bd->name }}" data-mail="{{ $bd->email }}">
                            <i class="icon-tools icon-tools-checkbox-grey"></i>
                        </a>
                    </div>
                    <div class="rctChecklistTasks__description">
                        <p class="rctChecklistTasks__title"> {{ $bd->name }} </p>
                        <span class="rctChecklistTasks__tag"> {{ $bd->email }} </span>
                    </div>
                    <div class="importBookingRow__date"> Wedding: {{ date('d/m/Y', strtotime($bd->event_date)) }} </div>
                </div>
                @endforeach
            </div>
            <!-- For Search Result -->
            <div class="rctChecklistTasks searched-solicitudes lazyLoad-effect dnone" data-searched="true"></div>
            <!-- For No-Result -->
            <div class="app-review-requests-import-no-results adminModalImport__noResults mt10 mb10"> No results </div>
            <div class="app-import-spinner-template dnone">
                <div class="app-review-request-loader adminModalImport__loader flex flex-center p20">
                    <span class="loader loader-small loader--inline in"></span>
                </div>
            </div>
            <div class="adminModalImport__actions p20 mt5">
                <div class="btnFlat btnFlat--primary import-submit-button app-review-request-import-submit" onclick="importClients();">Import clients</div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Add Profile Picture -->
<div id="add-pro-pic" class="modal fade dnone" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
    <div class="modal-dialog modal-large">
        <div class="modal-content app-review-request-importer" data-check-selector="icon-tools-checkbox-grey" data-check-selector-green="icon-tools-checkbox-green">
            <button type="button" class="close close-white" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="adminModalImport__title"><h3></h3></div>
            <div class="border-top lazyLoad-effect" data-booked="false">
                <div style="padding:5px;">
                  <input type="hidden" name="userId" id="userId">
                  <textarea class="adminTextarea reviews-textarea app-reviews-textarea" name="userMessage" rows="15" data-allow-enter="true" style="border:2px solid grey;">Thank you so much for leaving us a review on Perfect Wedding Day. Your opinion helps us improve and grow our business each day.

We would like to ask you a favour about the review you left us recently. We noticed that you did not add a profile photo to your account, and the truth is that having a profile picture makes your review much more credible to other couples.

If you could just log in to your account and add a profile picture, we would really appreciate it - all you have to do is click this link.

Thank you in advance! </textarea>
                </div>
            </div>
            <div class="adminModalImport__actions p20 mt5">
                <div class="btnFlat btnFlat--primary import-submit-button app-review-request-import-submit" onclick="addProfilePicture();">Add profile picture</div>
            </div>
        </div>
    </div>
</div>
<style>
    #name_datalist .name_email, #email_datalist .name_email{
        text-overflow: ellipsis;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
    }
    #name_datalist .name_email {
        width: 229px;
    }
    #email_datalist .name_email {
        width: 350px;
    }
    #name_datalist, #email_datalist {
        border:1px solid grey;
        padding:10px;
        overflow-y:scroll;
        height:auto;
        display: none;
        max-height: 300px;
    }
    .drop-wrapper ul li b {
        display: inline-block;
        text-overflow: ellipsis;
        /*width: 110px;*/
        overflow: hidden;
        white-space: nowrap;
        vertical-align: top;
    }
</style>
@include('includes.footer')
<script type="text/javascript">
    function show_reviews(vals) {
        if(vals == 'All') {
            $('.pending_review').removeClass('adminFilters__link--current');
            $('.all_reviews').css('display','block');
            $('.pending_reviews').css('display','none');
            $('.all_review').addClass('adminFilters__link--current');
        } else {
            $('.all_review').removeClass('adminFilters__link--current');
            $('.all_reviews').css('display','none');
            $('.pending_reviews').css('display','block');
            $('.pending_review').addClass('adminFilters__link--current');
        }
    }
    $('.review_send_btn').hover(function() {
        $(this).find('.review_send_detail').toggle();
    });
    $('.template_head').click(function() {
        $('.template_list').toggle();
    });
    function fetchTemplate(id)
    {
        if(id) {
            $.ajax({
                url: "{{ url('getTemplate').'/' }}"+id,
                type: "GET",
                data: '',
                success: function (response) {
                    // console.log(response);
                    $("input[name=template_id]").val(response.id);
                    $("input[name=templateName]").val(response.name);
                    $("textarea[name=review_message]").val(response.message);
                    $('.template_list').toggle();
                }
            });
        }
    }
    $(".name-search-input").keyup(function() {
        /*var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchNameEmail').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == '') {
                        $("#name_datalist").hide();
                    } else {
                        $("#name_datalist").show();
                        $("#email_datalist").hide();
                        $("#name_datalist").html(response);
                    }
                }
            });
        }*/
    });
    $(".email-search-input").keyup(function() {
        /*var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchNameEmail').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == '') {
                        $("#email_datalist").hide();
                    } else {
                        $("#name_datalist").hide();
                        $("#email_datalist").show();
                        $("#email_datalist").html(response);
                    }
                }
            });
        }*/
    });
    $('body').on('click', '.name_email', function() {
        var nameEmail = $(this).attr('data-value');
        var namel = nameEmail.split('--');
        $('.name-search-input').val(namel[0]);
        $('.email-search-input').val(namel[1]);

    });
    $('body').on('click','.wrapper', function(e){
        if($(e.target).attr('class') != 'reviewCollector__addUsers__input app-review-collector-templates-users-input name-search-input' || $(e.target).attr('class') != 'name_email') {
            $('#name_datalist').hide();
        }
        if($(e.target).attr('class') != 'reviewCollector__addUsers__input app-review-collector-templates-users-input email-search-input' || $(e.target).attr('class') != 'name_email') {
            $('#email_datalist').hide();
        }
    });
    $(".search-box-input").keyup(function() {
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url: "{{ url('getSearchClients').'/' }}"+search,
                type: "GET",
                data: '',
                success: function (response) {
                    // console.log(response);
                    $(".all-solicitudes").hide();
                    $(".booked-solicitudes").hide();
                    $(".searched-solicitudes").show();
                    $(".selected_all").addClass('selected');
                    $(".selected_booked").removeClass('selected');
                    $(".searched-solicitudes").html(response);
                    if(response == ''){
                        $('.adminModalImport__noResults').show();
                    } else {
                        $('.adminModalImport__noResults').hide();
                    }
                }
            });
        } else {
            $(".searched-solicitudes").hide();
            $(".booked-solicitudes").hide();
            $(".all-solicitudes").show();
            $(".selected_all").addClass('selected');
            $(".selected_booked").removeClass('selected');
            $('.adminModalImport__noResults').hide();
        }
    });
    var importClientDetail = [];
    $("body").on('click', '.importBookingRow', function() {
        var aval = $(this).find('i').hasClass('icon-tools-checkbox-grey');
        var name = $(this).find('.rctChecklistTasks__checkBoxLink').data('name');
        var mail = $(this).find('.rctChecklistTasks__checkBoxLink').data('mail');
        if(aval == true) {
            importClientDetail.push(name+'--'+mail);
            $(this).find('i').addClass('icon-tools-checkbox-green');
            $(this).find('i').removeClass('icon-tools-checkbox-grey');
        } else {
            for(var i = 0; i < importClientDetail.length; i++) {
                if(importClientDetail[i] === name+'--'+mail) {
                    importClientDetail.splice(i, 1); 
                }
            }
            $(this).find('i').addClass('icon-tools-checkbox-grey');
            $(this).find('i').removeClass('icon-tools-checkbox-green');
        }
    });
    function importClients()
    {
        var htmls = '';
        if(importClientDetail.length > 0) {
            for(var i = 0; i < importClientDetail.length; i++) {
                var vals = importClientDetail[i].split('--');
                var names = vals[0];
                var mails = vals[1];
                if(htmls == '') {
                    htmls = "<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                } else {
                    htmls = htmls+"<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                }
            }
        }
        if(htmls != '') {
        } else {
            $(".app-submit-review-request").addClass('disabled');
        }
            $(".app-submit-review-request").removeClass('disabled');
        $("#app-va-modal").modal('hide');
        $(".importClients").html(htmls);
        $('.rctChecklistTasks').find('i').addClass('icon-tools-checkbox-grey');
        $('.rctChecklistTasks').find('i').removeClass('icon-tools-checkbox-green');
    }
    $("body").on('click', '.removeImportClient', function() {
        var remVal = $(this).data('value');
        if(remVal != '') {
            for(var i = 0; i < importClientDetail.length; i++) {
                if(importClientDetail[i] === remVal) {
                    importClientDetail.splice(i, 1); 
                }
            }
            importClients();
        }
    });
    $(".reviewCollector__addButton").click(function() {
        var nombres = $('input[name=nombres]').val();
        var mails = $('input[name=mails]').val();
        if(nombres.length < 3 && mails.length < 3){
            $("#nombres_err").show();
            $("#mails_err").show();
            return false;
        } else
        if(nombres.length < 3){
            $("#nombres_err").show();
            $("#mails_err").hide();
            return false;
        } else
        if(mails.length < 3){
            $("#nombres_err").hide();
            $("#mails_err").show();
            return false;
        } else {
            $("#nombres_err").hide();
            $("#mails_err").hide();
            if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mails))
            {
                $("#invalidMails_err").hide();
                importClientDetail.push(nombres+'--'+mails);
                $('input[name=nombres]').val('');
                $('input[name=mails]').val('');
                importClients();
            } else {
                $("#invalidMails_err").show();
                return false;
            }
        }
    });
    $(".selected_all").click(function() {
        $(".searched-solicitudes").hide();
        $(".booked-solicitudes").hide();
        $(".all-solicitudes").show();
        $(".selected_all").addClass('selected');
        $(".selected_booked").removeClass('selected');
        var allCount = "{{ count($data['allData']) }}";
        if(allCount < 1) {
            $('.adminModalImport__noResults').show();
        } else {
            $('.adminModalImport__noResults').hide();
        }
    });
    $(".selected_booked").click(function() {
        $(".searched-solicitudes").hide();
        $(".all-solicitudes").hide();
        $(".booked-solicitudes").show();
        $(".selected_all").removeClass('selected');
        $(".selected_booked").addClass('selected');
        var arrCount = "{{ count($data['bookData']) }}";
        if(arrCount < 1) {
            $('.adminModalImport__noResults').show();
        } else {
            $('.adminModalImport__noResults').hide();
        }
    });
    function va_opinionesImportModal()
    {
        $("#app-va-modal").modal('show');
    }
    function common_disableEnterKey()
    {
        // nothing...
    }
    $(document).ready(function() {
        $('.savetemplatereview').on('click', function() {
          if(!$('#SaveAsTemplate').is(":checked")) {
              $(this).find('.icheckbox_minimal').addClass('checked');
              $('#SaveAsTemplate').prop('checked', true);
              $('.reviewappshow').show();
          } else {
              $(this).find('.icheckbox_minimal').removeClass('checked');
              $('#SaveAsTemplate').prop('checked', false);
              $('.reviewappshow').hide();
          }
        });
        $('.satasdefaultcls').on('click', function() {
          if(!$('#SetAsDefault').is(":checked")) {
              $(this).find('.icheckbox_minimal').addClass('checked');
              $('#SetAsDefault').prop('checked', true);
          } else {
              $(this).find('.icheckbox_minimal').removeClass('checked');
              $('#SetAsDefault').prop('checked', false);
          }
        });
    });
    function sendRequestAgain(id)
    {
        if(id) {
            $.ajax({
                url: "{{ url('sendRequestAgain').'/' }}"+id,
                type: "GET",
                data: '',
                success: function (response) {
                    if(response == 'done'){
                        location.reload();
                    }
                }
            });
        }
    }
    function addProfilePictureModal(id,name)
    {
        $("#add-pro-pic").modal('show');
        $("#userId").val(id);
        $(".adminModalImport__title").html("<h3> "+name+"'s profile picture </h3>");
    }
    function addProfilePicture()
    {
        var id = $("#userId").val();
        var msgs = $("textarea[name=userMessage]").val();
        if(id != '' && msgs != '') {
            $.ajax({
                url: "{{ url('addProfilePicture') }}",
                type: "POST",
                data: "id="+id+"&msgs="+msgs,
                success: function (response) {
                    if(response == 'done'){
                        location.reload();
                    }
                }
            });
        }
    }
    function view_reviews(id,name)
    {
        if(id != '' && name != '') {
            $.ajax({
                url: "{{ url('view_reviews') }}/"+id,
                type: "GET",
                data: "",
                success: function (response) {
                    if(response != '') {
                        $(".adminModalTitle").html(name+"'s Review");
                        $(".admin-reviews-item-modal").html(response);
                        $('#app-common-layer').modal('show');
                    }
                }
            });
        }
    }
    function replyOnReview(reqId,rateId,shortName,fullName)
    {
        $('#reqId').val(reqId);
        $('#rateId').val(rateId);
        $('.shortName').val(shortName);
        $('.fullName').val(fullName);
        $('#app-common-layer').modal('hide');
        $('#reply-common-layer').modal('show');
    }
    function review_next_step()
    {
        var reply_text = $("#reply_text").val();
        if(reply_text.length > 30) {
            $('.nextBTN').hide();
            $('.goBackBTN').show();
            $('.replyBTN').show();
            $(".app-review-form").hide();
            $(".app-review-photo-upload").show();
        } else {
            $('.goBackBTN').hide();
            $('.replyBTN').hide();
            $('.nextBTN').show();
            $(".app-review-photo-upload").hide();
            $(".app-review-form").show();
        }
    }
    function review_previous_step()
    {
        $('.goBackBTN').hide();
        $('.replyBTN').hide();
        $('.nextBTN').show();
        $(".app-review-photo-upload").hide();
        $(".app-review-form").show();
    }
    function readURL(input)
    {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#reply_image_preview').show();
                $('#reply_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#reply_image").change(function(){
        readURL(this);
    });
    /*function processData(allText) {
        var htmls = '';
        var record_num = 2;  // or however many elements there are in each row
        var allTextLines = allText.split(/\r\n|\n/);
        var entries = allTextLines[0].split(',');
        var lines = [];
    
        var headings = entries.splice(0,record_num);
        while (entries.length>0) {
            var tarr = [];
            for (var j=0; j<record_num; j++) {
                tarr.push(headings[j]+":"+entries.shift());
            }
            if(htmls == '') {
                    htmls = "<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                } else {
                    htmls = htmls+"<li class='bubbler__bubble'><span class='review-collector-templates-user'> "+names+" <span class='review-collector-templates-user--user-email'> "+mails+" </span><input type='hidden' name='nombre[]' value='"+names+"'><input type='hidden' name='mail[]' value='"+mails+"'></span><i class='svgIcon svgIcon__close app-bubbler-bubble-close app-bubbler-svg-clone bubbler__svgIcon'><svg viewBox='0 0 32 32' width='16' height='16' class='removeImportClient' data-value='"+importClientDetail[i]+"'><use xlink:href='#svg-_common-close'><svg id='svg-_common-close' viewBox='0 0 26 26'><path d='M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z' fill-rule='nonzero'></path></svg></use></svg></i></li>";
                }
            lines.push(tarr);
        }
        // alert(lines);
    }*/
    var fileInput = document.getElementById("import-csv"),
    readFile = function () {
        var reader = new FileReader();
        reader.onload = function () {
            // document.getElementById('out').innerHTML = reader.result;
            processData(reader.result);
        };
        // start reading the file. When it is done, calls the onload event defined above.
        reader.readAsBinaryString(fileInput.files[0]);
    };
    fileInput.addEventListener('change', readFile);
    function processData(allText) {
        var htmls = '';
        var allTextLines = allText.split(/\r\n|\n/);
        var headers = allTextLines[0].split(',');
        var lines = [];
        importClientDetail = [];
        for (var i=1; i<allTextLines.length; i++) {
            var data = allTextLines[i].split(',');
            if (data.length == headers.length) {
                var tarr = [];
                for (var j=0; j<headers.length; j++) {
                    tarr.push(headers[j]+":"+data[j]);
                    importClientDetail[i-1] = headers[j]+'--'+data[j];
                }
                lines.push(tarr);
            }
        }
        importClients();
    }
</script>
@endsection