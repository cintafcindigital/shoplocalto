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
            <div class="profile-header"><span class="tools-title"></span></div>
            @if(session()->has('message'))
               {!!session()->get('message')!!}
            @endif
            @if(isset($data['userEnquery']) && count($data['userEnquery']) >= 1)
               <form method="POST" id="inboxForm" name="inboxForm" action="{{url('delete-mailinbox')}}">
                  {{csrf_field()}}
                  <div class="filterList flex-va-center border-top border-bottom">
                     <ul class="app-mark-as filterList__actionBox filterList__actionBox--disabled" id="app-guest-mark-nav">
                        <li data-url="com-BuzonDelete.php" class="app-inbox-msg-delete">
                           <button data-icon-old="icon-tools-download-red" data-icon-new="icon-tools-download-white" class="btn-outline outline-red ml10 btn-md-icon app-icon-hover" type="submit">Delete</button>
                        </li>
                     </ul>               
                  </div>
                  <div class="inbox-messages-board app-inbox-messages-board">
                     @foreach($data['userEnquery'] as $enqdata)
                        <div class="inbox-messages-board app-inbox-messages-board">
                           <div id="mesaje2899721" class="inboxMessage app-inbox-msg-container">
                              <div>
                                 <div class="input-group-line inline inboxMessage__check"></div>
                              </div>
                              <a href="{{ url('/users-mailbox').'/'.Request::segment(2).'/'.$enqdata['id'] }}" class="app-inbox-goto-msg inboxMessage__anchor ">
                                 <div class="inboxMessage__avatarBlock  avatar">
                                    @if($enqdata['companyData']['vendor_data']['image_data'][0]['image'])
                                       <div class="ml20 avatar-vendor">
                                          <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$enqdata['companyData']['vendor_data']['vendor_id'].'/'.$enqdata['companyData']['vendor_data']['image_data'][0]['image'])}}" alt="User Image" width="64px" height="64px" style="height:50px;width:50px;">
                                       </div>
                                    @else
                                       <div class="avatar-alias size-avatar-medium fright">
                                          <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                             <circle fill="#C7C9C0" cx="100" cy="100" r="100"></circle>
                                             <text transform="translate(100,130)" y="0">
                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($enqdata['companyData']['vendor_data']['contact_person'][0]) }}</tspan>
                                             </text>
                                          </svg>
                                       </div>
                                    @endif
                                 </div>
                                 <div class="inboxMessage__nameBlock">
                                    <span class="inboxMessage__nameBlockVendor">Vendor</span>{{ $enqdata['companyData']['business_name'] }}<span>({{  count($enqdata['replies']) }})</span>
                                 </div>
                              @if( count($enqdata['replies']) > 0 )
                                 @foreach($enqdata['replies'] as $replysms)
                                    <div class="inboxMessage__previewBlock">
                                       <p class="inboxMessage__previewBlockTitle "></p>
                                       <p class="inboxMessage__previewBlockContent "> {!! str_limit(strip_tags($replysms['message']), 80,'....')  !!} </p>
                                    </div>
                                    <span class="inboxMessage__dateBlock"> {{ date('d/m/Y', strtotime($replysms['created_at'])) }} - {{ date('H:i A', strtotime($replysms['created_at'])) }}</span>
                                    @php break; @endphp
                                 @endforeach
                              @else 
                                 <div class="inboxMessage__previewBlock">
                                    <p class="inboxMessage__previewBlockTitle "></p>
                                    <p class="inboxMessage__previewBlockContent "> {!! str_limit(strip_tags($enqdata['comment']), 80,'....')  !!} </p>
                                 </div>
                                 <span class="inboxMessage__dateBlock"> {{ date('d/m/Y', strtotime($enqdata['created_at'])) }} - {{ date('H:i A', strtotime($enqdata['created_at'])) }}</span>
                              @endif
                              </a>
                           </div>
                           <div class="overflow brounded-box text-right app-inbox-paginator"></div>
                        </div>
                     @endforeach
                  </div>
               </form>
            @else
               <!-- <p class="inboxNoResults__text">You have not received any messages</p> -->
               <div class="inbox-messages-board app-inbox-messages-board">
                  <div class="app-inbox-no-results inboxNoResults">
                     <i class="icon-tools icon-tools-stats-invitation"></i>
                     <p class="inboxNoResults__text">You haven't received any messages yet ! </p>
                  </div>
               </div>
            @endif
         </div>
      </div>
   </div>
</section>
@include('includes.footer')
@endsection