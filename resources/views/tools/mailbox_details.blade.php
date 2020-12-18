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
            <div class="inbox-sidebar">
               <p class="tools-filters-title mt10">Folders</p>
               <ul class="tools-filters tools-filters--separator app-sidebar-folders-inbox">
                  <li class="app-inbox-filters-item tools-filters-item" data-folder="9">
                     <a href="javascript:;">
                        <span class="tools-filters-item-name">Unread</span>
                        <span class="app-inbox-filter-item-count count">0</span>
                     </a>
                  </li>
                  @if(Request::segment(2) == 'inbox')
                  <li class="app-inbox-filters-item tools-filters-item current" data-folder="1">
                  @else
                  <li class="app-inbox-filters-item tools-filters-item " data-folder="1">
                  @endif
                     <a href="{{url('users-mailbox/inbox')}}">
                        <span class="tools-filters-item-name">Inbox</span>
                        <span class="app-inbox-filter-item-count count">({{count($data['userEnquery'])}})</span>
                     </a>
                  </li>
               </ul>
               <ul class="tools-filters tools-filters--separator">
                  @if(Request::segment(2) == 'vendors')
                  <li class="app-inbox-filters-item tools-filters-item current" data-folder="16">
                  @else
                  <li class="app-inbox-filters-item tools-filters-item " data-folder="16">
                  @endif
                     <a href="{{url('users-mailbox/vendors')}}">
                        <span class="tools-filters-item-name">Vendor messages</span>
                     </a>
                  </li>
                  <li class="app-inbox-filters-item tools-filters-item" data-folder="3">
                     <a href="javascript:;">
                        <span class="tools-filters-item-name">Private messages</span>
                     </a>
                  </li>
                  <li class="app-inbox-filters-item tools-filters-item" data-folder="2">
                     <a href="javascript:;">
                        <span class="tools-filters-item-name">Notifications</span>
                     </a>
                  </li>
                  @if(Request::segment(2) == 'administrator')
                  <li class="app-inbox-filters-item tools-filters-item current" data-folder="4">
                  @else
                  <li class="app-inbox-filters-item tools-filters-item " data-folder="4">
                  @endif
                     <a href="{{url('users-mailbox/administrator')}}">
                        <span class="tools-filters-item-name">Admin messages</span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="pure-u-4-5">
            @if (\Session::has('message'))
               <div class="app-hide-alert">
                  <div class="adminAlert adminAlert--success">
                     <p>{!! \Session::get('message') !!}</p>
                  </div>
               </div>
            @endif
            <div class="pure-g">
               <div class="pure-u-5-7">
                  <a id="redactar"></a>
                  <div id="app-new-inbox-message-request" class="inbox-message-request inbox-message-request-user" style="padding-right: 0">
                     <div class="pure-g">
                        <div class="pure-u-1-9">
                           @if($data['userEnquery'][0]['user']['profile_image'])
                              <div class="avatar-vendor">
                                 <img class="avatar-thumb" src="{{ url('storage/USER_').$data['userEnquery'][0]['user']['id'] }}/{{ $data['userEnquery'][0]['user']['profile_image'] }}" alt="User Image" width="64px" height="64px" style="height:60px;width:60px">
                              </div>
                           @else
                              <div class="avatar-alias size-avatar-medium">
                                 <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                    <text transform="translate(100,130)" y="0">
                                       <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($data['userEnquery'][0]['user']['name'][0]) }}</tspan>
                                    </text>
                                 </svg>
                              </div>
                           @endif
                        </div>
                        <div class="pure-u-8-9">
                           <div class="tools-inbox-message-reply">
                              <form class="app-vendors-solicitudes-response-form" action="{{ url('users-mailbox/reply') }}" name="frmToolLayer" id="frmToolLayer" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                 <div class="box inbox-message-request__requestBox">
                                    <input type="hidden" id="is_template" name="is_template" value="">
                                    <input type="hidden" id="enqury_id" name="enqury_id" value="{{ $data['userEnquery'][0]->id }}">
                                    <input type="hidden" id="enqury_user_id" name="enqury_user_id" value="{{ $data['userEnquery'][0]->user_id }}">
                                    <input type="hidden" id="enq_name" name="enq_name" value="{{ $data['userEnquery'][0]->name }}">
                                    <input type="hidden" id="enq_email" name="enq_email" value="{{ $data['userEnquery'][0]->email }}">
                                    <input type="hidden" id="enq_vendor_id" name="enq_vendor_id" value="{{ $data['userEnquery'][0]['companyData']->vendor_data->vendor_id }}">
                                    <input type="hidden" id="enq_vendor_email" name="enq_vendor_email" value="{{ $data['userEnquery'][0]['companyData']->vendor_data->email }}">
                                    <div class="hidenfilesarray" style="display: none;"></div>
                                    <textarea id="app-trumbowyg-editor-va-chat" name="reply_message" class="app-trumbowyg-editor-va-chat trumbowyg-textarea" cols="65" rows="6" placeholder="Write a message" tabindex="-1" style="min-height: 158px; max-height: 408px;"></textarea>
                                    <div id="ficheroSubido" class=""></div>
                                    <div class="app-va-hot-btn-wrapper inbox-message-hot">
                                       <button class="app-ureq-hot-btn inbox-message-hot__btn" data-message="Thank you for your response! We'll review your information and let you know if we have any questions.">Not ready yet</button>
                                       <button class="app-ureq-hot-btn inbox-message-hot__btn" data-message=" Thanks for your response! We no longer have a need for your services, but we appreciate your time.">Not Interested</button>
                                    </div>
                                    <div class="inbox-message-reply-footer">
                                       <button class="inbox-message-reply-footer__upload icon icon-clip icon-left app-va_solis-upload-file">Attach files</button>
                                       <input class="dnone app-va-input-upload-file" name="fileupload" id="fileupload" type="file" accept=".jpg, .jpeg, .gif, .png, .doc, .docx, .pdf, .ppt, .pptx, .pps, .xls, .xlsx">
                                       <input class="btnFlat btnFlat--primary app-va-solic-chat-submit-btn" type="submit" value="Reply">
                                    </div>
                                 </div>
                              </form>
                              @if (\Session::has('reply'))
                                 <div class="app-hide-alert">
                                    {!! \Session::get('reply') !!}
                                 </div>
                              @endif
                              @if ($errors->any())
                                 <div class="alert alert-danger">
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
                  @if(count($data['userEnquery'][0]['replies']) > 0)
                     @foreach($data['userEnquery'][0]['replies'] as $smsreply )
                        @if($smsreply['reply_by'] == $data['userEnquery'][0]['companyData']->vendor_id && $smsreply['message_type'] == 'replies')
                           <div class="app-sol-reply inbox-message-request inbox-message-request-vendor received-by-user">
                              <div class="pure-g">
                                 <div class="pure-u-8-9">
                                    <div class="tools-inbox-message inbox-message-content-vendor">
                                       <div class="tools-inbox-message__header">
                                          <p class="strong" style="margin-bottom: 10px"><b style="font-size: 15px">{{ ucfirst($data['userEnquery'][0]['companyData']->vendor_data->contact_person) }}</b></p>
                                       </div>
                                       {!! $smsreply['message'] !!}
                                       @if(count($smsreply['reply_images']) > 0)
                                          @foreach( $smsreply['reply_images'] as $replyimagesv)
                                             <div class="box-sol-reply-links mb20">
                                                <a style="background-color: #fff" class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{ url('replyimages') }}/{{ $replyimagesv['image_name'] }}">{{ $replyimagesv['original_name'] }}</a>
                                             </div>
                                          @endforeach
                                       @endif
                                       <time> On {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }} </time>
                                    </div>
                                 </div>
                                 <div class="pure-u-1-9">
                                    @if($data['userEnquery'][0]['companyData']->vendor_data->image_data[0]['image'])
                                       <div class="avatar-vendor fright">
                                          <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['userEnquery'][0]['companyData']->vendor_id.'/'.$data['userEnquery'][0]['companyData']->vendor_data->image_data[0]['image'])}}" alt="User Image" width="64px" height="64px" style="height:64px;width:64px">
                                       </div>
                                    @else
                                       <div class="avatar-alias size-avatar-medium fright">
                                          <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                             <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                             <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($data['userEnquery'][0]['companyData']->vendor_data->contact_person[0]) }}</tspan>
                                             </text>
                                          </svg>
                                       </div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        @elseif($smsreply['reply_by'] == $data['userEnquery'][0]['companyData']->vendor_id && $smsreply['message_type'] == 'notes')
                           <div class="app-sol-reply inbox-message-request inbox-message-request-note" >
                              <div class="pure-g">
                                 <div class="pure-u-8-9">
                                    <div class="tools-inbox-message  inbox-message-content-note" style="background-color: #fffaed">
                                       <b>Note : </b> &nbsp; {!! $smsreply['message'] !!}
                                       <time> On {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }} </time>
                                    </div>
                                 </div>
                                 <div class="pure-u-1-9"></div>
                              </div>
                           </div>
                        @elseif($smsreply['reply_by'] == $smsreply['user_id'] && $smsreply['message_type'] == 'replies')
                           <div class="app-sol-reply inbox-message-request inbox-message-request-user send-by-vendor" style="padding: 0">
                              <div class="pure-g">
                                 <div class="pure-u-1-9">
                                    @if($smsreply['user']['profile_image'])
                                       <figure class="">
                                          <img class="avatar-thumb" src="{{ url('storage/USER_').$smsreply['user']['id'] }}/{{ $smsreply['user']['profile_image'] }}" alt="User Image" width="64px" height="64px" style="height: 64px; width: 64px">
                                       </figure>
                                    @else
                                       <div class="avatar-alias size-avatar-medium ">
                                          <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                             <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                             <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($smsreply['user']['name'][0]) }}</tspan>
                                             </text>
                                          </svg>
                                       </div>
                                    @endif
                                 </div>
                                 <div class="pure-u-8-9">
                                    <div class="tools-inbox-message  inbox-message-content-user box">
                                       <!-- <div class="tools-inbox-message__header">
                                          <p class="strong" style="margin-bottom: 10px"><b style="font-size: 15px">{{ ucfirst($smsreply['user']['name']) }}</b></p>
                                       </div> -->
                                       {!! $smsreply['message'] !!} 
                                       @if(count($smsreply['reply_images']) > 0)
                                          @foreach( $smsreply['reply_images'] as $replyimagesv)
                                             <div class="box-sol-reply-links mb20">
                                                <a style="background-color: #fff" class="inbox-message-link icon icon-clip icon-left" target="blank" href="{{ url('replyimages') }}/{{ $replyimagesv['image_name'] }}">{{ $replyimagesv['original_name'] }}</a>
                                             </div>
                                          @endforeach
                                       @endif
                                       <time> On {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }} </time>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @elseif($smsreply['reply_by'] == $smsreply['user_id'] && $smsreply['message_type'] == 'notes')
                           <div class="app-sol-reply inbox-message-request inbox-message-request-note" >
                              <div class="pure-g">
                                 <div class="pure-u-1-9"></div>
                                 <div class="pure-u-8-9">
                                    <div class="tools-inbox-message  inbox-message-content-note" style="background-color: #fffaed">
                                       <div class="tools-inbox-message__header">
                                          <p class="strong">{{ ucfirst($smsreply['user']['name']) }}</p>
                                       </div>
                                       <b>Note : </b> &nbsp; {!! $smsreply['message'] !!}
                                       <time> On {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }} </time>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif
                     @endforeach
                  @endif
                  <div class="app-sol-reply">
                     <div class="inbox-message-request-sent">
                        <span class="inbox-message-request-sent__title">Request sent {{ date('d/M/Y', strtotime($data['userEnquery'][0]->created_at)) }} at {{ date('H:i', strtotime($data['userEnquery'][0]->created_at)) }}</span>
                     </div>
                     <div class="pure-g">
                        <div class="pure-u-1-9">
                           @if($data['userEnquery'][0]->user->profile_image)
                              <figure class="">
                                 <img class="avatar-thumb" src="{{ url('storage/USER_').$data['userEnquery'][0]->user->id }}/{{ $data['userEnquery'][0]->user->profile_image }}" alt="User Image" width="64px" height="64px">
                              </figure>
                           @else
                              <div class="avatar-alias size-avatar-medium">
                                 <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                    <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                    <text transform="translate(100,130)" y="0">
                                       <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($data['userEnquery'][0]->user->name[0]) }}</tspan>
                                    </text>
                                 </svg>
                              </div>
                           @endif
                        </div>
                        <div class="pure-u-8-9">
                           <div class="tools-inbox-message inbox-message-content-user">
                              <!-- <span class="inbox-message-content-userName" style="font-size:15px"><b>{{ $data['userEnquery'][0]->user->name }}</b></span> -->
                              <div class="inbox-message-request-details">
                                 <span><i class="inbox-vendor-profileList__icon icon-vendor icon-vendor-phone"></i> Phone number: {{ $data['userEnquery'][0]->phone }}</span>
                                 <span><i class="inbox-vendor-profileList__icon icon-vendor icon-vendor-email"></i> Email: {{ $data['userEnquery'][0]->email }}</span>
                              </div>
                              <hr class="mb20">
                              {!! $data['userEnquery'][0]->comment !!}
                              <time>On {{ date('d/M/Y', strtotime($data['userEnquery'][0]->created_at)) }}</time>
                           </div>
                        </div>
                     </div>
                  </div> <!-- End of app-sol-reply -->
               </div> <!-- End of pure-u-5-7 -->
               <div class="pure-u-2-7">
                  <div class="ml30">
                     <div class="box">
                        <div class="inbox-vendor-profile">
                           @php $imgCount = 0; @endphp
                           @foreach($data['userEnquery'][0]['companyData']->vendor_data->image_data as $vim)
                              @if($vim->is_logo == '1')
                                 @php $imgCount++; @endphp
                                 <img class="inbox-vendor-profile__img block" src="{{ url('/').'/vendors/'.$vim->vendor_folder.'/'.$vim->image }}">
                              @endif
                           @endforeach
                           @if($imgCount == '0')
                              <img class="inbox-vendor-profile__img block" src="https://cdn0.weddingwire.ca/emp/fotos//7/8/7/9/t10_pic-4_50_17879.jpg">
                           @endif
                           <div class="inbox-vendor-profile__content">
                              <span class="block mb5 upper">{{ $data['category']->title }}</span>
                              <a class="inbox-vendor-profile-title" href="javascript:void(0)">
                                 {{ $data['userEnquery'][0]['companyData']->vendor_data->contact_person }}
                              </a>
                              <p class="mt5">{{ $data['userEnquery'][0]['companyData']->address.' '.$data['userEnquery'][0]['companyData']->city }} ({{ $data['userEnquery'][0]['companyData']->province }})</p>
                              <a class="inbox-vendor-profile__link" href="{{ url('wedding-venues').'/'.$data['category']->slug.'/'.$data['userEnquery'][0]['companyData']->business_name_slug }}">Learn more</a>
                           </div>
                        </div>
                        <div class="inbox-vendor-status app-tools-ureq-vendors-info">
                           <div class="vendorsItemStatus pure-g text-center color-grey">
                              <?php
                              $rejActv = '';
                              $bkdActv = '';
                              if(@$data['addVendor']->status == '0') {
                                 $rejActv = 'active';
                              } else
                              if(@$data['addVendor']->status == '1') {
                                 $bkdActv = 'active';
                              }
                              ?>
                              <div class="app-ureq-vendor-change-status pure-u-1-2 vendorsItemStatus__item" data-status="2">
                                 <i class="svgIcon svgIcon__timesCircle app-ureq-vendor-icon-status vendorsItemStatus__icon vendorsItemStatus__icon--times {{$rejActv}}">
                                    <svg viewBox="0 0 92 92">
                                       <path d="M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm17.6 60.1c1 1 1 2.6 0 3.5-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7L46 49.5 31.9 63.6c-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7c-1-1-1-2.6 0-3.5L42.5 46 28.4 31.9c-1-1-1-2.6 0-3.5 1-1 2.6-1 3.5 0L46 42.5l14.1-14.1c1-1 2.6-1 3.5 0 1 1 1 2.6 0 3.5L49.5 46l14.1 14.1z"></path>
                                    </svg>
                                 </i>
                                 <span class="vendorsItemStatus__label">Rejected</span>
                              </div>
                              <div class="app-ureq-vendor-change-status pure-u-1-2 vendorsItemStatus__item" data-status="6" data-show-profile-layer-enabled="1">
                                 <i class="svgIcon svgIcon__checkCircle app-ureq-vendor-icon-status vendorsItemStatus__icon vendorsItemStatus__icon--check {{$bkdActv}}">
                                    <svg viewBox="0 0 92 92">
                                       <path d="M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm20.1 36.3L45 59.7c-.5.6-1.3 1-2.1 1h-.1c-.8 0-1.5-.3-2.1-.9L26 45.3c-1.2-1.2-1.2-3.1 0-4.2 1.2-1.2 3.1-1.2 4.2 0l12.4 12.3 19.1-21c1.1-1.2 3-1.3 4.2-.2 1.3 1 1.4 2.9.2 4.1z"></path>
                                    </svg>
                                 </i>
                                 <span class="vendorsItemStatus__label">Booked</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="box app-vendors-container inbox-vendor-rating">
                        <p class="input-group-line-label block ellipsis"><span class="app-tools-vendors-rating-text">Your Rating</span></p>
                        <div class="star-holder">
                           <div class="writeRatig" data-score="{{@$data['addVendor']->rating}}"></div>
                        </div><br/>
                        <div class="app-tools-vendors-change-price app-tools-vendors-modif vendors-item-price">
                           <p><span class="input-group-line-label">Price</span></p>
                           <span class="vendors-item-price-currency">C$</span>
                           <input class="app-vendors-item-price-edit vendors-item-price-edit" placeholder="0" value="{{@$data['addVendor']->price}}" type="text" name="prices" style="width:80px;">
                        </div><br/>
                        <div class="app-vendors-tooltip vendors-item-note-tooltip form-line dnone">
                           <textarea name="notes" class="app-vendors-tooltip-textarea" placeholder="Add comments about this vendor...">{!! @$data['addVendor']->notes !!}</textarea>
                           <span class="app-vendors-note-close fleft pointer mt25"><i class="fa fa-angle-left mr5"></i>Go back </span>
                        </div>
                        <div class="app-vendors-note-main vendors-item-note">
                           @if(@$data['addVendor']->notes)
                              <p class="app-vendors-note app-vendors-note-snippet vendors-item-note-content">{!!@$data['addVendor']->notes!!}</p>
                           @else
                              <p class="app-vendors-note app-vendors-note-snippet vendors-item-note-content dnone"></p>
                           @endif
                           @if(@$data['addVendor']->notes == '' || @$data['addVendor']->notes == null)
                              <span class="app-vendors-note app-vendors-note-add vendors-item-note-empty ">
                                 <i class="icon-tools icon-tools-note mr10"></i><span class="input-group-line-label">Add note</span>
                              </span>
                           @else
                              <span class="app-vendors-note app-vendors-note-add vendors-item-note-empty dnone">
                                 <i class="icon-tools icon-tools-note mr10"></i><span class="input-group-line-label">Add note</span>
                              </span>
                           @endif
                        </div>
                        <div id="app-emp-phone-17879" class="vendors-item-dropdown"></div>
                     </div>
                  </div>
               </div>                        
            </div> <!-- End of pure-g inner --> 
         </div>
      </div> <!-- End of pure-g -->
   </div> <!-- End of wrapper -->
</section>
<div id="app-common-layer" class="modal fade dnone in" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;z-index:1040;">
   <div class="modal-dialog">
      <div class="modal-content modal-vendors modal-vendor-addProfile">
         <div class="modal-header modal-headerTools">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               <i class="svgIcon svgIcon__close ">
                  <svg viewBox="0 0 26 26">
                     <path d="M12.983 10.862L23.405.439l2.122 2.122-10.423 10.422 10.423 10.422-2.122 2.122-10.422-10.423L2.561 25.527.439 23.405l10.423-10.422L.439 2.561 2.561.439l10.422 10.423z" fill-rule="nonzero"></path>
                  </svg>
               </i>
            </button>
            <p class="modal-headerTools-title">Do you want to add this vendor to your profile?</p>
         </div>
         <div class="text-center p20">
            <div class="avatar-box">
               <div class="avatar">
                  <figure>
                     @php $imgCount = 0; @endphp
                     @foreach($data['userEnquery'][0]['companyData']->vendor_data->image_data as $vim)
                        @if($vim->is_logo == '1')
                           @php $imgCount++; @endphp
                           <img src="{{ url('/').'/vendors/'.$vim->vendor_folder.'/'.$vim->image }}" style="object-fit:cover;width:123px;">
                        @endif
                     @endforeach
                     @if($imgCount == '0')
                        <img src="https://cdn0.weddingwire.ca/emp/fotos//7/8/7/9/t10_pic-4_50_17879.jpg" style="object-fit:cover;width:123px;">
                     @endif
                  </figure>
                  <input type="hidden" name="addVendorId" id="addVendorId" value="{{@$data['addVendor']->id}}">
                  <input type="hidden" name="addProfileStatus" id="addProfileStatus" value="{{@$data['addVendor']->add_profile}}">
                  <div class="mt10 strong font-hero"> {{ $data['userEnquery'][0]['companyData']->vendor_data->contact_person }} </div>
               </div>
            </div>
            <p class="modal-vendor-addProfile-text">Add this vendor to your profile so others can see who you've hired for your wedding.</p>
            <div class="pure-u-1">
               <button type="button" data-dismiss="modal" class="btn-flat red" onclick="add_vendor_to_profile();">Add vendor</button>
               <div class="pure-u-1 mt15">
                  <span class="app-stop-layer-publish-btn modal-vendor-addProfile-cancel">Do not add this time</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
.inbox-vendor-profile {
   text-align: center;
}
.inbox-vendor-profile__link {
   color: #19b5bc;
}
.font-hero {
   font-size: 18px;
   line-height: 28px;
}
.strong {
   font-weight: 600;
}
.app-vendors-tooltip.vendors-item-note-tooltip.form-line {
   position: inherit;
   padding: 0px;
   margin-top: 10px;
}
</style>
@include('includes.footer')
<script src="https://cdn.tiny.cloud/1/08cq8y02kwr759p88hfbo9ym579ceup2a7x2vebx42n6ceee/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
   selector:'#app-trumbowyg-editor-va-chat',
   width: 570,
   height: 300
});
$(document).ready(function()
{
   //default message
   $('.inbox-message-hot__btn').on('click', function() {
      var messagesDefault = $(this).attr('data-message');
      //alert(messagesDefault);
      tinymce.get("app-trumbowyg-editor-va-chat").setContent(messagesDefault);
      $('.app-va-hot-btn-wrapper').hide();
      return false;
   });
   ////// Reject Vendor button......
   $('body').on('click', '.svgIcon__timesCircle', function() {
      var enqury_id      = $('#enqury_id').val();
      var enqury_user_id = $('#enqury_user_id').val();
      var enq_vendor_id  = $('#enq_vendor_id').val();
      var status         = 'times';
      if($('.svgIcon__timesCircle').hasClass('active')) {
         var btnStatus = 'active';
      } else {
         var btnStatus = 'inactive';
      }
      if(enqury_id != '' && enqury_user_id != '' && enq_vendor_id != '') {
         $.ajax({
            type:'POST',
            url: "{{ url('users-mailbox/add-vendors') }}",
            data: "enqId="+enqury_id+"&userId="+enqury_user_id+"&vendorId="+enq_vendor_id+"&status="+status+"&btnStatus="+btnStatus,
            success:function(data) {
               if(data != '') {
                  if(btnStatus == 'active') {
                     $('.vendorsItemStatus__icon').removeClass('active');
                  } else {
                     $('#addProfileStatus').val('No');
                     $('.vendorsItemStatus__icon').removeClass('active');
                     $('.svgIcon__timesCircle').addClass('active');
                  }
               }
            }
         });
      }
   });
   ////// Booked Vendor button......
   $('body').on('click', '.svgIcon__checkCircle', function() {
      var profileStatus  = $('#addProfileStatus').val();
      var enqury_id      = $('#enqury_id').val();
      var enqury_user_id = $('#enqury_user_id').val();
      var enq_vendor_id  = $('#enq_vendor_id').val();
      var status         = 'check';
      if($('.svgIcon__checkCircle').hasClass('active')) {
         var btnStatus = 'active';
      } else {
         var btnStatus = 'inactive';
      }
      if(enqury_id != '' && enqury_user_id != '' && enq_vendor_id != '') {
         $.ajax({
            type:'POST',
            url: "{{ url('users-mailbox/add-vendors') }}",
            data: "enqId="+enqury_id+"&userId="+enqury_user_id+"&vendorId="+enq_vendor_id+"&status="+status+"&btnStatus="+btnStatus,
            success:function(data) {
               if(data != '') {
                  if(btnStatus == 'active') {
                     $('.vendorsItemStatus__icon').removeClass('active');
                  } else {
                     $('.vendorsItemStatus__icon').removeClass('active');
                     $('.svgIcon__checkCircle').addClass('active');
                     if(profileStatus != 'Yes') {
                        $('#app-common-layer').modal('show');
                        $('#addVendorId').val(data);
                     }
                  }
               }
            }
         });
      }
   });
   $('body').on('click', '.modal-vendor-addProfile-cancel', function() {
      $('#app-common-layer').modal('hide');
   });
   // file upload click
   $('.inbox-message-reply-footer__upload').on('click', function() {
      $('#fileupload').trigger('click');
      return false;
   });
   // upload file ajax
   $("#fileupload").change(function(e) {
      //Here is where you will make your AJAX call
      var fileobj = e.target.files[0];
      var formData = new FormData();
      formData.append("fileobj", fileobj);
      $.ajax({
         type:'POST',
         url: "{{ url('users-mailbox/reply-fileupload') }}",
         data:formData,
         cache:false,
         contentType: false,
         processData: false,
         success:function(data) {
            var data = JSON.parse(data);
            if(data.html != 'yes') {
               $('.hidenfilesarray').append('<input id="'+data.id+'" type="hidden" name="inputFiles[]" value="'+data.fileid+'" />');
               $('#ficheroSubido').addClass('app-inbox-upload-attachments');
               $('#ficheroSubido').append(data.html);
            }
         },
         error: function(data) {
            console.log("error");
            console.log(data);
         }
      });
   });
   ////// Remove image from upload......
   $('body').on('click', '.inbox-message-link__remove', function() {
      var removeid = $(this).attr('data-remove');
      // alert(removeid);
      $('body .hidenfilesarray').find('#'+removeid).remove();
      $(this).parents('.inbox-message-link').remove();
   });
   ////// Rating Section......
   $('body').on('click', '.star-holder', function() {
      var enqury_id      = $('#enqury_id').val();
      var enqury_user_id = $('#enqury_user_id').val();
      var enq_vendor_id  = $('#enq_vendor_id').val();
      var userRating     = $('input[name=score]').val();
      if(enqury_id != '' && enqury_user_id != '' && enq_vendor_id != '') {
         $.ajax({
            type:'POST',
            url: "{{ url('users-mailbox/add-userRating') }}",
            data: "enqId="+enqury_id+"&userId="+enqury_user_id+"&vendorId="+enq_vendor_id+"&userRating="+userRating,
            success:function(data) {
               if(data != '') {
                  $('input[name=score]').val(data);
               }
            }
         });
      }
   });
   ////// Price Section......
   $('body').on('change', '.app-vendors-item-price-edit', function() {
      var enqury_id      = $('#enqury_id').val();
      var enqury_user_id = $('#enqury_user_id').val();
      var enq_vendor_id  = $('#enq_vendor_id').val();
      var prices         = $('input[name=prices]').val();
      if(enqury_id != '' && enqury_user_id != '' && enq_vendor_id != '') {
         $.ajax({
            type:'POST',
            url: "{{ url('users-mailbox/add-userPrice') }}",
            data: "enqId="+enqury_id+"&userId="+enqury_user_id+"&vendorId="+enq_vendor_id+"&prices="+prices,
            success:function(data) {
               if(data != '') {
                  $('input[name=prices]').val(data);
               }
            }
         });
      }
   });
   ////// Notes Section......
   $('body').on('change', '.app-vendors-tooltip-textarea', function() {
      var enqury_id      = $('#enqury_id').val();
      var enqury_user_id = $('#enqury_user_id').val();
      var enq_vendor_id  = $('#enq_vendor_id').val();
      var notes         = $('textarea[name=notes]').val();
      if(enqury_id != '' && enqury_user_id != '' && enq_vendor_id != '') {
         $.ajax({
            type:'POST',
            url: "{{ url('users-mailbox/add-userNote') }}",
            data: "enqId="+enqury_id+"&userId="+enqury_user_id+"&vendorId="+enq_vendor_id+"&notes="+notes,
            success:function(data) {
               if(data != '') {
                  $('textarea[name=notes]').val(data);
                  $('.app-vendors-note-snippet').html(data);
                  $('.app-vendors-note-add').addClass('dnone');
               }
            }
         });
      }
   });
   ////// Add Note Section......
   $('body').on('click', '.vendors-item-note', function() {
      $('.vendors-item-note-empty').addClass('dnone');
      $('.app-vendors-note-snippet').addClass('dnone');
      $('.app-vendors-tooltip').removeClass('dnone');
   });
   $('body').on('click', '.app-vendors-note-close', function() {
      var notes = $('textarea[name=notes]').val();
      if(notes.length > 0) {
         $('.app-vendors-note-add').addClass('dnone');
         $('.app-vendors-note-snippet').removeClass('dnone');
      } else {
         $('.app-vendors-note-add').removeClass('dnone');
         $('.app-vendors-note-snippet').addClass('dnone');
      }
      $('.app-vendors-tooltip').addClass('dnone');
   });
});
function add_vendor_to_profile()
{
   var addVendorId = $('#addVendorId').val();
   if(addVendorId != '') {
      $.ajax({
         type:'POST',
         url: "{{ url('users-mailbox/add-vendor-to-profile') }}",
         data: "addVendorId="+addVendorId,
         success:function(data) {
            if(data == 'done') {
               $('#addProfileStatus').val('Yes');
               $('#app-common-layer').modal('hide');
            }
         }
      });
   }
}
</script>
@endsection