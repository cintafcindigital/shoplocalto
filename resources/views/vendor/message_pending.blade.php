@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<section class="section-padding dashboard-wrap message_main_wrp dash_main_sect">
     @include('vendor.tools_nav')
     <div class="wrapper">
	   <div class="pure-g">
	     	<div class="pure-u-1-5">
	     		@include('includes.messagesidebar')
	      	</div>
	      	<div class="pure-u-4-5">
	 			@include('includes.messageinnerboard')

	 				@if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']) || isset($_GET['leadby']))
		            	<div class="adminFiltersQuery">
		                    <span class="adminFiltersQuery__title">Results:</span>
		                    <span>

		                    	@if( isset($_GET['sn']) && $_GET['sn'] !='' ) {{ $_GET['sn'] }} , @endif

		                    	@if(isset($_GET['leadby']))

		                    		@if( $_GET['leadby'] != '' &&  $_GET['leadby'] == 1 ) Lead date @else Wedding date @endif

		                    	@endif

		                    	@if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != '' ) 

		                    		(From {{ $_GET['dfrom'] }}, Until {{ $_GET['dend'] }}) 

		                    	@elseif( isset($_GET['dfrom']) && $_GET['dfrom'] != '' )

		                    		( From  {{ $_GET['dfrom'] }} )

		                    	@elseif( isset($_GET['dend']) &&  $_GET['dend'] != '')

		                    		( Until {{ $_GET['dend'] }} )

		                    	@endif
		                    </span>
		                    <a class="adminFiltersQuery__link" href="{{ url('messages-pending') }}">Delete</a>
		                </div>
		            @endif

		            @if(count($data['pendingMessage']) > 0)

		                <div class="messagecontent-wr">
		                  	<form id="frmGestorSolicitudes" name="frmGestorSolicitudes" action="{{ url('messages-status') }}" method="post">
		                        {{ csrf_field() }}
		                        <input id="statusAction" type="hidden" name="action" value="" />
		                        <input id="statusVal" type="hidden" name="actionvalue" value="" />

					            <ul class="adminHomeSol">
					            	@foreach($data['pendingMessage'] as $pending)
				                        <li class="app-vendor-message-{{$pending->id}} adminHomeSol__item pure-g @if(!$pending->read_status) adminHomeSol__item--new @endif">
				                              <div class="pure-u-7-10">
				                                 <div class="pure-g">
				                                    <div class="adminHomeSol__checkAvatar pure-u-2-12">
				                                       <div class="adminHomeSol__check fleft">
				                                          <div class="icheckbox_minimal single_icheckbox_minimal" style="position: relative;"><input class="app-solicitudes-check dnone" type="checkbox" name="messageids[]" id="messageids{{ $pending->id }}" value="{{ $pending->id }}" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
				                                          </div>
				                                       </div>
				                                       <div class="adminHomeSol__avatar app-link">
				                                          @if($pending->user['profile_image'])
				                                              <figure>
				                                                  <img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $pending->user['id'] }}/{{ $pending->user['profile_image'] }}" alt="Emily" width="60" height="60">
				                                              </figure>
				                                            @else
				                                              <div class="avatar-alias size-avatar-medium ">
				                                                 <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
				                                                    <circle fill="#C097A0" cx="100" cy="100" r="100"></circle>
				                                                    <text transform="translate(100,130)" y="0">
				                                                       <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($pending->user['name'][0]) }}</tspan>
				                                                    </text>
				                                                 </svg>
				                                              </div>
				                                          @endif
				                                       </div>
				                                    </div>
				                                    <div class="pure-u-10-12">
				                                      <a class="adminHomeSol__name" href="{{ url('message-details') }}/{{ $pending->id }}">
				                                      {{ $pending->name }} <span>{{ count($pending->replies) }}</span> </a>
				                                      <div>
				                                          @if($pending->reply_status == 0)
				                                            <span class="adminHomeSol__status adminHomeSol__status--pending">Pending</span>
				                                          @elseif($pending->reply_status == 1)
				                                            <span class="adminHomeSol__status adminHomeSol__status--info">Replied</span>
				                                          @elseif($pending->reply_status == 2)
				                                            <span class="adminHomeSol__status adminHomeSol__status--discarded">Discarded</span>
				                                          @elseif($pending->reply_status == 3)
				                                            <span class="adminHomeSol__status adminHomeSol__status--success">Booked</span>
				                                         @endif
				                                            <time class="adminHomeSol__date">
				                                               {{ date('d/M/Y', strtotime($pending->created_at)) }} at {{ date('H:i', strtotime($pending->created_at)) }} 
				                                            </time>
				                                      </div>
				                                      <p class="adminHomeSol__description"> 
				                                        {{ str_limit(strip_tags($pending->comment), $limit = 150, $end = '...') }}
				                                      </p>
				                                    </div>
				                                 </div>
				                              </div>
				                              <div class="pure-u-3-10">
				                                <div clas="pure-g">
				                                   <div class="adminHomeSol__info cmn_date_wrp pure-u-1-2">
				                                      <span class="adminHomeSol__icon adminHomeSol__icon--envelope"></span>
				                                      <time class="adminHomeSol__info-number"> {{ date('d', strtotime($pending->created_at)) }} {{ date('M', strtotime($pending->created_at)) }} <span class="adminHomeSol__info-extra">{{ date('Y', strtotime($pending->created_at)) }}</span></time>
				                                   </div>
				                                </div>
				                             </div>
				                        </li>
				                    @endforeach
					            </ul>
					        </form>
					    </div> <!-- End messagecontent -->
				        <div class="mb20">
				        	{!! $data['pendingMessage']->appends(Input::except('page'))->render() !!}
				        </div>
				    @else 
				    	<div class="adminEmpty">
                    		<i class="adminEmpty__icon adminEmpty__icon--solic"></i>
                    		<p class="adminEmpty__description">No messages have been found in this folder</p>
                        </div>
				    @endif
	      	</div>
	   </div>
	</div>
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
@endsection  