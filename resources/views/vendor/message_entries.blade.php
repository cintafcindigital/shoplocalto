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
	           <div class="mr40">
	              <p class="adminAsideTitle">Folders</p>
	              <nav class="adminAside app-va-folders-side-nav folder_list">
	                 <a class="adminAside__item" href="{{url('messages')}}">
	                 Inbox                        <span class="adminAside__counter">31</span>
	                 </a>
	                 <div class="relative">
	                    <a class="adminAside__item" href="{{url('messages-unread')}}">
	                    Unread                            <span class="adminAside__counter">0</span>
	                    </a>
	                 </div>
	                 <a class="adminAside__item" href="{{url('messages-read')}}">
	                 Read                        <span class="adminAside__counter">31</span>
	                 </a>
	                 <a class="app-va-folders-side-status adminAside__item adminBullet--double active" href="{{url('messages-pending')}}" data-status="0">
	                 <i class="adminBullet adminBullet--orange"></i>
	                 Pending                        <span class="adminAside__counter app-va-folders--counter">4</span>
	                 </a>
	                 <a class="app-va-folders-side-status adminAside__item adminBullet--double" href="{{url('messages-replied')}}" data-status="2">
	                 <i class="adminBullet adminBullet--blue"></i>
	                 Replied                        <span class="adminAside__counter app-va-folders--counter">25</span>
	                 </a>
	                 <a class="app-va-folders-side-status adminAside__item adminBullet--double" href="{{url('messages-booked')}}" data-status="3">
	                 <i class="adminBullet adminBullet--green"></i>
	                 Booked                        <span class="adminAside__counter app-va-folders--counter">0</span>
	                 </a>
	                 <a class="app-va-folders-side-status adminAside__item adminBullet--double" href="{{url('messages-discarded')}}" data-status="4">
	                 <i class="adminBullet adminBullet--red"></i>
	                 Discarded                        <span class="adminAside__counter app-va-folders--counter">2</span>
	                 </a>
	              </nav>
	              <hr class="adminAsideSeparator">
	              <p class="adminAsideTitle">Contest</p>
	              <nav class="adminAside contest_list">
	                 <a class="adminAside__item active" href="{{url('entries')}}">
	                    <i class="svgIcon svgIcon__contest adminAside__icon">
	                       <svg viewBox="0 0 20 13">
	                          <path d="M3.5 13a.5.5 0 0 1-.5-.5v-2A3.86 3.86 0 0 1 .2 6.8a3.83 3.83 0 0 1 2.763-3.68L3.1 3.1c-.08 0-.1.023-.1 0v-2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v2a3.86 3.86 0 0 1 2.8 3.7 3.83 3.83 0 0 1-2.763 3.68l-.137.02c.08 0 .1-.023.1 0v2a.5.5 0 0 1-.5.5h-13zM16 12v-1.5c0-.512.347-.946.812-.995A2.83 2.83 0 0 0 18.8 6.8c0-1.265-.84-2.377-2.124-2.753C16.3 3.86 16 3.51 16 3.1V1.6H4v1.5c0 .512-.347.946-.812.995A2.83 2.83 0 0 0 1.2 6.8c0 1.265.84 2.377 2.124 2.753.376.188.676.538.676.947V12h12zm-9.6-1.8a.5.5 0 0 1-.5-.5V3.6a.5.5 0 0 1 .5-.5h7.2a.5.5 0 0 1 .5.5v6.1a.5.5 0 0 1-.5.5H6.4zm.5-1h6.2V4.1H6.9v5.1z" fill-rule="nonzero"></path>
	                       </svg>
	                    </i>
	                    Entries                            <span class="adminAside__counter">0</span>
	                 </a>
	              </nav>
	              <hr class="adminAsideSeparator">
	              <p class="adminAsideTitle">Tools</p>
	              <nav class="adminAside tools_list">
	                 <a class="adminAside__item " href="{{url('messages-setting')}}">
	                    <i class="svgIcon svgIcon__gear adminAside__icon">
	                       <svg viewBox="0 0 18 20">
	                          <path d="M5.98 16.179a.653.653 0 0 0-.822-.472l-1.76.504c-.856.244-1.883-.17-2.325-.94l-.601-1.04C.027 13.46.18 12.365.82 11.745l1.317-1.272a.657.657 0 0 0 0-.95L.824 8.252C.183 7.634.029 6.54.473 5.769l.6-1.04c.443-.771 1.47-1.185 2.325-.94l1.76.504a.656.656 0 0 0 .823-.474l.443-1.776C6.64 1.18 7.511.5 8.4.5h1.2c.889 0 1.76.68 1.975 1.542l.444 1.775c.092.366.46.577.823.474l1.76-.504c.855-.245 1.88.17 2.324.94l.602 1.041c.443.772.29 1.865-.35 2.482L15.86 9.524a.653.653 0 0 0 0 .948l1.318 1.273c.64.619.792 1.712.348 2.484l-.6 1.04c-.442.77-1.469 1.185-2.325.94l-1.761-.504a.654.654 0 0 0-.82.474l-.445 1.778C11.36 18.82 10.489 19.5 9.6 19.5H8.4c-.89 0-1.76-.68-1.975-1.543l-.446-1.778zm1.415 1.536c.104.417.575.785 1.005.785h1.2c.43 0 .901-.368 1.005-.785l.445-1.778a1.653 1.653 0 0 1 2.067-1.193l1.76.504c.415.119.97-.105 1.184-.478l.6-1.04c.215-.375.132-.966-.177-1.266l-1.318-1.273a1.653 1.653 0 0 1 .001-2.387l1.316-1.273c.31-.3.393-.89.178-1.264l-.601-1.04c-.215-.373-.77-.597-1.183-.479l-1.76.504a1.656 1.656 0 0 1-2.068-1.192l-.444-1.776C10.501 1.868 10.03 1.5 9.6 1.5H8.4c-.43 0-.901.368-1.005.785L6.95 4.062a1.657 1.657 0 0 1-2.068 1.193l-1.76-.504c-.415-.12-.97.105-1.184.477l-.6 1.04c-.215.374-.132.966.178 1.265l1.316 1.272a1.658 1.658 0 0 1 0 2.387l-1.317 1.273c-.31.3-.393.892-.178 1.265l.602 1.042c.213.372.768.596 1.183.477l1.759-.503a1.652 1.652 0 0 1 2.067 1.19l.446 1.779zM9 8.1a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8zm0-1a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z" fill-rule="nonzero"></path>
	                       </svg>
	                    </i>
	                    Settings                    
	                 </a>
	                 <a class="adminAside__item " href="{{url('messages-templates')}}">
	                    <i class="svgIcon svgIcon__note adminAside__icon">
	                       <svg viewBox="0 0 18 19">
	                          <path d="M16.636.87a.5.5 0 0 1 .5.5v11.087a.5.5 0 0 1-.143.35l-5.091 5.174a.5.5 0 0 1-.357.15H1.364a.5.5 0 0 1-.5-.5V1.37a.5.5 0 0 1 .5-.5h15.272zm-.5 1H1.864v15.26h9.472l4.8-4.878V1.87zm-4.09 15.76a.5.5 0 1 1-1 0v-5.173a.5.5 0 0 1 .5-.5h5.09a.5.5 0 0 1 0 1h-4.59v4.673zM4 6.5a.5.5 0 0 1 0-1h9a.5.5 0 1 1 0 1H4zm0 3a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1H4z" fill-rule="nonzero"></path>
	                       </svg>
	                    </i>
	                    Templates                    
	                 </a>
	                 <a class="adminAside__item adminAside__item--pretitle export_lead_btn" href="javascript:;">
	                    <i class="svgIcon svgIcon__tagPremium adminAside__icon mt5">
	                       <svg viewBox="0 0 19 21">
	                          <path d="M12.57 1.87H3.388v5.532a.502.502 0 0 1-.01.098h8.44c.666 0 1.206.54 1.206 1.206v5.588c0 .667-.54 1.207-1.206 1.207h-8.43v4.368H17.66V7.044H13.07a.5.5 0 0 1-.5-.5V1.869zm1 .667v3.507h3.68l-3.68-3.507zm5.09 3.996a.51.51 0 0 1 0 .02V20.37a.5.5 0 0 1-.5.5H2.887a.5.5 0 0 1-.5-.5v-4.868H1.23c-.666 0-1.206-.54-1.206-1.207V8.706c0-.667.54-1.205 1.206-1.205h1.167a.502.502 0 0 1-.01-.1V1.37a.5.5 0 0 1 .5-.5H13.07a.5.5 0 0 1 .345.138l5.091 4.852a.5.5 0 0 1 .155.362v.312zM1.23 8.501a.205.205 0 0 0-.206.205v5.588c0 .114.092.207.206.207h10.588a.206.206 0 0 0 .206-.207V8.706a.205.205 0 0 0-.206-.205H1.23zm7.794 1.387a1.77 1.77 0 0 1 .68-.122c.224 0 .445.032.664.098.219.066.414.154.586.265l-.267.573a2.504 2.504 0 0 0-.547-.25 1.647 1.647 0 0 0-.491-.089.693.693 0 0 0-.376.089.275.275 0 0 0-.138.244c0 .096.032.175.096.239a.779.779 0 0 0 .242.157c.097.04.231.085.399.134.233.07.426.137.575.206.15.068.277.17.383.304.106.134.158.31.158.529a.9.9 0 0 1-.17.546c-.114.155-.27.274-.47.356a1.787 1.787 0 0 1-.684.122c-.27 0-.534-.049-.79-.149a2.22 2.22 0 0 1-.673-.4l.277-.558c.174.16.37.286.587.377.218.092.421.138.609.138.184 0 .329-.035.435-.106a.328.328 0 0 0 .157-.287.332.332 0 0 0-.095-.242.733.733 0 0 0-.245-.154 4.227 4.227 0 0 0-.406-.133 5.222 5.222 0 0 1-.573-.2 1.012 1.012 0 0 1-.38-.297.817.817 0 0 1-.159-.521c0-.2.054-.375.162-.523.107-.149.258-.264.454-.346zM5.839 9.82h.662v2.837h1.492v.594H5.839V9.82zm-1.393 0h.785L4.07 11.461l1.26 1.79h-.795l-.885-1.226-.875 1.226h-.776l1.246-1.76L2.079 9.82h.776l.795 1.127.796-1.127z" fill-rule="nonzero"></path>
	                       </svg>
	                    </i>
	                    <span class="adminAside__itemContent ml5">
	                    <span class="adminAside__tag">PREMIUM</span>
	                    <span class="adminAside__itemLabel">Export leads</span>
	                    </span>
	                 </a>
	              </nav>
	           </div>
	      </div>
	      <div class="pure-u-4-5 entries_wrp">
	         <h1 class="adminTitle">Manage contest entries</h1>
	         <div class="adminTicketsBanner">
	            <h2 class="adminTicketsBanner__title">Each month couples have the chance to win $1,000 by planning their wedding on PerfectWedding</h2>
	            <p class="adminTicketsBanner__description">Couples receive contest entries by messaging, booking and reviewing PerfectWedding vendors.</p>
	            <a class="adminTicketsBanner__link text-underline" href="javascript:;" target="_blank">Learn more</a>
	         </div>
	         <p class="mb20 color-grey">Questions? Email <a class="color-grey text-underline" href="javascript:;">contests@PerfectWedding.ca</a></p>
	         <h2 class="adminTitleSection">PerfectWedding contest entry requests</h2>
	         <ul class="pure-g adminTicketsSummary message_list_link">
	            <li class="pure-u-1-4 adminTicketsSummary__item">
	               <span class="adminTicketsSummary__icon adminTicketsSummary__icon--requests"></span>
	               <p class="adminTicketsSummary__description">
	                  <span class="adminTicketsSummary__number">0</span>
	                  Requests            
	               </p>
	            </li>
	            <li class="pure-u-1-4 adminTicketsSummary__item">
	               <span class="adminTicketsSummary__icon adminTicketsSummary__icon--accepted"></span>
	               <p class="adminTicketsSummary__description">
	                  <span class="adminTicketsSummary__number" id="app-num-boletos-aceptados">0</span>
	                  Accepted            
	               </p>
	            </li>
	            <li class="pure-u-1-4 adminTicketsSummary__item">
	               <span class="adminTicketsSummary__icon adminTicketsSummary__icon--rejected"></span>
	               <p class="adminTicketsSummary__description">
	                  <span class="adminTicketsSummary__number" id="app-num-boletos-descartados">0</span>
	                  Discarded            
	               </p>
	            </li>
	            <li class="pure-u-1-4 adminTicketsSummary__item">
	               <span class="adminTicketsSummary__icon adminTicketsSummary__icon--pending"></span>
	               <p class="adminTicketsSummary__description">
	                  <span class="adminTicketsSummary__number" id="app-num-boletos-pendientes">0</span>
	                  Pending            
	               </p>
	            </li>
	         </ul>
	         <div>
	            <ul class="adminHomeSol">
	               <li class="adminHomeSol__item relative">
	                  <div class="admin-tickets-list-blockImg">
	                     <div class="avatar  ">
	                        <div class="avatar-alias size-avatar-medium ">
	                           <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
	                              <circle fill="#E5CCCC" cx="100" cy="100" r="100"></circle>
	                              <text transform="translate(100,130)" y="0">
	                                 <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">K</tspan>
	                              </text>
	                           </svg>
	                        </div>
	                     </div>
	                  </div>
	                  <div class="admin-tickets-list-blockInfo">
	                     <a class="admin-tickets-list-name" rel="nofollow" href="javascript:;" target="_blank">
	                     Kristin Mcbain                        </a>
	                     <div class="color-grey small">
	                        <i class="svgIcon svgIcon__contest adminAside__icon">
	                           <svg viewBox="0 0 20 13">
	                              <path d="M3.5 13a.5.5 0 0 1-.5-.5v-2A3.86 3.86 0 0 1 .2 6.8a3.83 3.83 0 0 1 2.763-3.68L3.1 3.1c-.08 0-.1.023-.1 0v-2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v2a3.86 3.86 0 0 1 2.8 3.7 3.83 3.83 0 0 1-2.763 3.68l-.137.02c.08 0 .1-.023.1 0v2a.5.5 0 0 1-.5.5h-13zM16 12v-1.5c0-.512.347-.946.812-.995A2.83 2.83 0 0 0 18.8 6.8c0-1.265-.84-2.377-2.124-2.753C16.3 3.86 16 3.51 16 3.1V1.6H4v1.5c0 .512-.347.946-.812.995A2.83 2.83 0 0 0 1.2 6.8c0 1.265.84 2.377 2.124 2.753.376.188.676.538.676.947V12h12zm-9.6-1.8a.5.5 0 0 1-.5-.5V3.6a.5.5 0 0 1 .5-.5h7.2a.5.5 0 0 1 .5.5v6.1a.5.5 0 0 1-.5.5H6.4zm.5-1h6.2V4.1H6.9v5.1z" fill-rule="nonzero"></path>
	                           </svg>
	                        </i>
	                        Got married in april, 2018                                                    
	                     </div>
	                     <p class="admin-tickets-list-action">
	                        Booked in January 2018                        
	                     </p>
	                  </div>
	                  <div class="admin-tickets-list-blockStatus">
	                  </div>
	               </li>
	               <li class="adminHomeSol__item relative">
	                  <div class="admin-tickets-list-blockImg">
	                     <div class="avatar">
	                        <figure>
	                           <img class="avatar-thumb" src="https://cdn0.weddingwire.ca/usr/1/0/8/7/utmp_321087.jpg?r=91490" width="" alt="Tracy">
	                        </figure>
	                     </div>
	                  </div>
	                  <div class="admin-tickets-list-blockInfo">
	                     <a class="admin-tickets-list-name" rel="nofollow" href="javascript:;" target="_blank">
	                     Tracy Brown                        </a>
	                     <div class="color-grey small">
	                        <i class="svgIcon svgIcon__contest adminAside__icon">
	                           <svg viewBox="0 0 20 13">
	                              <path d="M3.5 13a.5.5 0 0 1-.5-.5v-2A3.86 3.86 0 0 1 .2 6.8a3.83 3.83 0 0 1 2.763-3.68L3.1 3.1c-.08 0-.1.023-.1 0v-2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v2a3.86 3.86 0 0 1 2.8 3.7 3.83 3.83 0 0 1-2.763 3.68l-.137.02c.08 0 .1-.023.1 0v2a.5.5 0 0 1-.5.5h-13zM16 12v-1.5c0-.512.347-.946.812-.995A2.83 2.83 0 0 0 18.8 6.8c0-1.265-.84-2.377-2.124-2.753C16.3 3.86 16 3.51 16 3.1V1.6H4v1.5c0 .512-.347.946-.812.995A2.83 2.83 0 0 0 1.2 6.8c0 1.265.84 2.377 2.124 2.753.376.188.676.538.676.947V12h12zm-9.6-1.8a.5.5 0 0 1-.5-.5V3.6a.5.5 0 0 1 .5-.5h7.2a.5.5 0 0 1 .5.5v6.1a.5.5 0 0 1-.5.5H6.4zm.5-1h6.2V4.1H6.9v5.1z" fill-rule="nonzero"></path>
	                           </svg>
	                        </i>
	                        Got married in august, 2018                                                    
	                     </div>
	                     <p class="admin-tickets-list-action">
	                        Booked in November 2017                        
	                     </p>
	                  </div>
	                  <div class="admin-tickets-list-blockStatus">
	                  </div>
	               </li>
	            </ul>
	         </div>
	      </div>
	   </div>
	</div>
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
@endsection 