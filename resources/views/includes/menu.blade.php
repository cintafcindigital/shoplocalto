<!-- HEADER START -->

@php

   $vendorId = 0;

   $userId = 0;

   $proImagePath = url('public/storage/no-image.png');

@endphp

@if(Auth::user())

   @php

      $vendorId = \Auth::user()->vendor_id;

      $userId = \Auth::user()->id;

      if(isset($data['vendorData'][0]['image_data'][0]) && !empty($data['vendorData'][0]['image_data'])) {

         $proImagePath = url('public/vendors/VENDOR_'.$vendorId.'/'.$data['vendorData'][0]['image_data'][0]['image']);

      }

   @endphp

@endif

<section id="navbar-main">

   @if( (!$vendorId) && (!$userId) )

      <!-- <div class="menutopheader-wr">

         <div class="container clearfix">

            <div class="menu-top menu-top-inner clearfix">

               <a href="{{url('dasboard')}}" rel="nofollow" class="menu-top-access">

                  <i class="svgIcon svgIcon__briefcase " style="display:inline-block;vertical-align:top;margin-right:5px;"><svg viewBox="0 0 48 41"><path d="M44.3 27.917h.933V13.925c0-1.46-1.199-2.86-3.057-3.625H5.825c-1.859.766-3.058 2.164-3.058 3.625v13.992h14.866V24.39a1 1 0 0 1 1-1h10.734a1 1 0 0 1 1 1v3.527H44.3zm-2.133 2h-11.8v.51a1 1 0 0 1-1 1H18.633a1 1 0 0 1-1-1v-.51h-11.8v8.564h36.334v-8.564zM14.567 8.3v-.51c0-3.797 2.855-7.035 6.533-7.035h5.8c3.68 0 6.533 3.236 6.533 7.036V8.3h8.935a1 1 0 0 1 .358.066c2.655 1.02 4.507 3.115 4.507 5.559v14.992a1 1 0 0 1-1 1h-2.066v9.564a1 1 0 0 1-1 1H4.833a1 1 0 0 1-1-1v-9.564H1.767a1 1 0 0 1-1-1V13.925c0-2.445 1.852-4.54 4.509-5.559a1 1 0 0 1 .358-.066h8.933zm13.8 21.126V25.39h-8.734v4.036h8.734zm3.066-21.635c0-2.747-2.018-5.036-4.533-5.036h-5.8c-2.513 0-4.533 2.29-4.533 5.036V8.3h14.866v-.51z" fill-rule="nonzero"></path></svg></i> ARE YOU A VENDOR?

               </a>

            </div>

         </div>

      </div> -->

   @endif

   <!-- FIXED NAVBAR -->

   <div class="navbar navbar-default navbar-fixed-top">

      <div class="container clearfix">

         <!-- LOGO -->

         <div class="navbar-header leftheader">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

               <span class="icon-bar"></span>

               <span class="icon-bar"></span>

               <span class="icon-bar"></span>

            </button>

            <a class="" href="{{url('/')}}">

               <div class="logo">

                  <img src="{{ asset('public/images/logo.jpg') }}" alt="">

               </div>

            </a>

         </div><!-- / END LOGO -->

         @if(@$data['vendorData'][0]['contact_person'] || @$data['vendor']->contact_person)

            <span class="hidden-xs"><span style="font-size:20px;margin-left: 15%;margin-top: 4%;display: inline-block;"><b>Welcome @if(@$data['vendorData'][0]['contact_person']) {{@$data['vendorData'][0]['contact_person']}} @else {{@$data['vendor']->contact_person}}! @endif</b></span></span>

            <!-- <h1>Welcome @if(@$data['vendorData'][0]['contact_person']) {{@$data['vendorData'][0]['contact_person']}} @else {{@$data['vendor']->contact_person}}! @endif</h1> -->

         @endif

         <div class="right-header">

            <div class="navbar-collapse collapse">

               @if(Auth::user())

                  @php

                     $userId = \Auth::user()->id;

                     $profileImage = \Auth::user()->profile_image;

                     if(isset($profileImage) && !empty($profileImage)) {

                        $proImagePath = url('public/storage/USER_'.$userId.'/'.$profileImage);

                     }

                  @endphp

                  @if($userId)

                  <div class="header-joined">

                     <a class="header-joined-inbox" href="{{url('users-mailbox/inbox')}}">

                        <i class="icon-header icon-header-envelope-red"></i>

                        <!-- <span class="header-joined-inbox-counter app-header-inbox-counter"></span> -->

                     </a>

                     <div class="header-joined-container">

                        <div class="header-joined-avatar">

                           <div class="app-link">

                              <div class="avatar ">

                                 <div class="avatar-alias size-avatar-small">

                                    <a href="{{url('dashboard')}}">

                                       <img class="avatar-new" src="{{$proImagePath}}" alt="{{Auth::user()->name}}">

                                    </a>

                                 </div>

                              </div>

                           </div>

                        </div>

                        <div class="app-dropdown-toggle header-joined-bars">

                           <i class="fa fa-angle-down" aria-hidden="true"></i>

                        </div>

                        <div class="app-dropdown-toggle-layer header-joined-drop" data-ajax="#" style="">

                           <header class="header-joined-drop-info"><meta charset="gb18030">

                              <a href="{{url('user-settings')}}" class="header-joined-drop-settings icon-header icon-header-gear"></a>

                              <span class="header-joined-drop-user">{{Auth::user()->name}}</span>

                              <span class="header-joined-drop-status"></span>

                              <div class="header-joined-drop-options">

                                 <a href="{{url('tools/my-wedding')}}"> View profile </a>

                                 <span>·</span>

                                 <a href="{{url('/logout')}}">Log Out</a>

                              </div>

                           </header>

                           <ul class="header-joined-drop-tabs hidden">

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/to-do-list')}}">

                                    <i class="icon-header icon-header-tasklist"></i> Checklist

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/vendors')}}">

                                    <i class="icon-header icon-header-vendors"></i> Vendors

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/guests')}}">

                                    <i class="icon-header icon-header-guests"></i> Guests

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/seating_chart')}}">

                                    <i class="icon-header icon-header-dropdown-tables"></i> Seating Chart

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/budget')}}">

                                    <i class="icon-header icon-header-budget"></i> Budget

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/dresses')}}">

                                    <i class="icon-header icon-header-dresses"></i> Dresses

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/wedding-website')}}">

                                    <i class="icon-header icon-header-web"></i> Website

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('tools/wedshoots')}}">

                                    <i class="icon-header icon-header-wedshoots"></i> WedShoots

                                 </a>

                              </li>

                           </ul>

                           <div class="header-joined-concierge btn-menu app-user-logged-menu-chat text-center" style="cursor: auto;" data-totype="concierge" data-toid="admin" data-toname="Dev test" data-toavatar="">

                              <div class="header-joined-concierge-content">

                                 <i class="icon-header icon-header-concierge pt5 fleft"></i>

                                 <div class="overflow pl10">

                                    <p class="text-left mb0">

                                       <span class="color-grey">Can we help you find vendors?</span>

                                       <span class="header-joined-concierge-title"><a href="{{url('contact')}}">My Health Squad Support</a></span>

                                    </p>

                                 </div>

                              </div>

                           </div>

                           <footer class="header-joined-drop-footer">

                              <a class="header-joined-drop-footer-link" href="{{url('tools/my-wedding')}}">

                                 Go To My Planner <i class="icon-header icon-header-arrow-right-red"></i>

                              </a>

                           </footer>

                        </div>

                        <div class="app-dropdown-toggle-layer header-joined-drop" data-ajax="/user-LoggedMenuAjax.php" style="display:none;"></div>

                     </div>

                  </div><!-- Dashboard Right -->

                  @endif

                  @if($vendorId)

                  <div class="header-joined">

                     <div class="headerEmp__contact">

                        <a href="{{url('ticket-support-add')}}">

                           <i class="fa fa-envelope-o" aria-hidden="true"></i>

                        </a>

                        <strong class="headerEmp__contactPhone ml5"></strong>

                     </div>

                     <div class="header-joined-container fright">

                        <div class="header-joined-avatar">

                           <div class="app-link">

                              <div class="avatar">

                                 <div class="avatar-alias size-avatar-small">

                                    <a href="{{url('dashboard')}}">

                                       <img class="avatar-new" src="{{$proImagePath}}" alt="{{Auth::user()->contact_person}}">

                                    </a>

                                 </div>

                              </div>

                           </div>

                        </div>

                        <div class="app-dropdown-toggle header-joined-bars">

                           <i class="fa fa-angle-down" aria-hidden="true"></i>

                        </div>

                        <div class="app-dropdown-toggle-layer header-joined-drop" data-ajax="#" style="">

                           <header class="header-joined-drop-info">

                              <a href="{{url('vendor-settings')}}" class="header-joined-drop-settings icon-header icon-header-gear"></a>

                              <span class="header-joined-drop-user">{{Auth::user()->contact_person}}</span>

                              <span class="header-joined-drop-status"></span>

                              <div class="header-joined-drop-options">

                                 <a href="{{url('dashboard')}}"> Vendor Dashboard </a>

                                 <span>·</span>

                                 <a href="{{url('logout')}}">Log Out</a>

                              </div>

                           </header>

                           <ul class="header-joined-drop-tabs">

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('storefront')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-storefront"></span>

                                    <span class="adminNav__itemText"> Profile </span>

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('messages')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-inbox"></span>

                                    <span class="adminNav__itemText">Messages</span>

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('reviews')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-reviews"></span>

                                    <span class="adminNav__itemText">Reviews </span>

                                 </a>

                              </li>

                              <!--<li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('invoices')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>

                                    <span class="adminNav__itemText">Billing</span>

                                 </a>

                              </li> -->

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('vendor-settings')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>

                                    <span class="adminNav__itemText">Settings</span>

                                 </a>

                              </li>

                              <li class="header-joined-drop-tabs-item">

                                 <a class="header-joined-drop-tabs-link" href="{{url('blogs')}}">

                                    <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>

                                    <span class="adminNav__itemText">Blogs</span>

                                 </a>

                              </li>

                           </ul>

                        </div>

                        <div class="app-dropdown-toggle-layer header-joined-drop" data-ajax="" style="display:none;"></div>

                     </div>

                  </div><!-- Dashboard Right -->

                  @endif

               @endif



               @if(!$vendorId)

               <ul class="nav navbar-nav navbar-right hidden-xs">

                  <!-- <li> <a href="{{url('/')}}" class="active">Home</a></li> -->

                  <!-- <li class="dropdown">-->

                  <!--@if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )-->

                  <!--  <a href="{{url('website').'/planning-tools-page'}}" class="app-header-tab show-caret plaining_tool_page">Planning Tools</a>-->

                  <!--@else-->

                  <!--  <a href="{{url('tools/my-wedding')}}" class="app-header-tab show-caret plaining_tool_page">Planning Tools</a>-->

                  <!--@endif-->

                  <!-- </li>-->

                  @if(isset($category) && is_array($category) && count($category) > 0)

                  @foreach($category as $cats)

                     <li class="dropdown">

                        <a href="{{url('search?category='.$cats['slug'])}}" class="hidden-xs app-header-tab show-caret {{$cats['slug']}}">{{$cats['title']}}</a>

                        <a href="#" class="visible-xs app-header-tab show-caret {{$cats['slug']}}">{{$cats['title']}}</a>

                     </li>

                  @endforeach

                  @endif

                  <!--<li><a href="{{url('/wedding-dress')}}" class="wedding_dress_page">Dresses</a></li>-->

                  <!--<li><a href="{{url('/wedding-ideas')}}" class="wedding_ideas_page">Wedding Ideas</a></li>-->

                  <li class="blog_page"><a href="{{url('blog')}}">Blog</a></li>

                  <!--<li class="blog_page visible-xs"><a href="#">Blog</a></li>-->

                  <!-- <li class="blog_page visible-xs"><a href="#">Blog</a></li> -->

                  <li class="hidden-xs"><a href="{{url('community')}}" class="community_page">Community</a></li>

                  <li class="visible-xs"><a href="#" class="community_page">Community</a></li>

                  @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                  <!--<li><a href="{{url('/login')}}" class="link">Login</a></li>-->

                  <!--<li><a href="{{url('/register')}}" class="link">Sign Up</a></li>-->

                  <li><a href="{{url('/login')}}" class="link">Login</a></li>

                  <li><a href="{{url('/register')}}" class="link">Sign Up</a></li>

                  @endif

               </ul>

               @else

                  <!--<div class="headerEmp__contact">-->

                  <!--   <i class="icon icon-phone mt10 mr10 fleft"></i>Customer service:-->

                  <!--   <strong class="headerEmp__contactPhone">1-866-548-3241</strong>-->

                  <!--</div>-->

               @endif

               

               <div class="mobile-menu visible-xs">

                   <ul class="nav navbar-nav navbar-right">

                      @if(isset($category) && is_array($category) && count($category) > 0)

                      @foreach($category as $cats)

                         <li class="dropdown main-category-mobile">

                            <a href="{{url('search?category='.$cats['slug'])}}" class="show-caret mobile-{{$cats['slug']}}">{{$cats['title']}}</a>

                            <ul class="pure-g sub-category-mobile">

                               @if(isset($cats['child']) && !empty($cats['child']))

                                  @foreach($cats['child'] as $ch0)

                                  <li class="pure-u-1-2">

                                     <a class="tabsHeaderList__item" rel="nofollow" href="{{url('search?category='.$ch0['slug'])}}"><!-- <img src="{{url('public/images/mental-health.png')}}" class="img-responsive" style="width: 8%;"> --><span>{{$ch0['title']}}</span></a>

                                  </li>

                                  @endforeach

                               @else

                                  <li class="pure-u-1-2">

                                     <a class="tabsHeaderList__item" rel="nofollow" href="#">Coming Soon</a>

                                  </li>

                               @endif

                            </ul>

                         </li>

                      @endforeach

                      @endif

                      <li><a href="{{url('blog')}}">Blog</a></li>

                      <li class="main-mobile-commmunity">

                          <a href="{{url('community')}}">Community</a>

                         <ul class="pure-g sub-mobile-community">

                             @if(isset($blogCategory))

                                @foreach($blogCategory as $cat)

                                <li class="pure-u-1-3">

                                   <a class="tabsHeaderList__item" rel="nofollow" href="{{url('community').'/'.$cat->slug}}">{{$cat->name}}</a>

                                </li>

                                @endforeach

                             @endif

                             <li class="pure-u-1-3">

                                <a class="tabsHeaderList__item" rel="nofollow" href="{{url('testimonial')}}">Testimony</a>

                             </li>

                          </ul>

                      

                      </li>

                      @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                      <li><a href="{{url('/login')}}" class="link">Login</a></li>

                      <li><a href="{{url('/register')}}" class="link">Sign Up</a></li>

                      @endif

                    </ul>

               </div>

            </div>

         </div><!-- End of right header -->

      </div><!-- End container -->

   </div><!-- End navbar-fixed-top-->

   <div class="plaining-tool-pwd">

      <div class="tabsHeader app-common-header-dropdown plaining-tool-after-hover" style="display:none;"><!-- Planning Tools Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-1">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeader__title" href="{{url('website').'/planning-tools-page'}}">Planning Tools</a>

                        @else

                            <a class="tabsHeader__title" href="{{url('tools/my-wedding')}}">Planning Tools</a>

                        @endif

                  <ul class="pure-g tabsHeaderListIcons__content pr20">

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('website').'/checklist-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/to-do-list')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-task tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Checklist</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-Guests" href="{{url('website').'/guest-list-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/guests')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-guest tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Guests</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-Tables" href="{{url('website').'/seating-chart-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/seating_chart')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-tables tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Seating Chart</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-Budget" href="{{url('website').'/budget-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/budget')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-budget tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Budget</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-MyVendors" href="{{url('website').'/vendor-manager-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/vendors')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-vendors tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Wedding Vendors</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link" href="{{url('website').'/dresses-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/dresses')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-dress tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Dresses</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link testing-nav-planning-Wedsite" href="{{url('website').'/wedding-website-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('tools/wedding-website')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-wedsite tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Wedding Website</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        @if( ( (Auth::guest()) || (!$vendorId) && (!$userId) ) )

                            <a class="tabsHeaderListIcons__link" href="{{url('website').'/community-page'}}">

                        @else

                            <a class="tabsHeaderListIcons__link testing-nav-planning-CheckList" href="{{url('/community')}}">

                        @endif

                           <i class="icon-header icon-header-dropdown-community tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Community</span>

                        </a>

                     </li>

                     <!-- <li class="pure-u-1-5">

                        <a class="tabsHeaderListIcons__link" href="javascript:;">

                           <i class="icon-header icon-header-dropdown-contest tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Contest</span>

                        </a>

                     </li>

                     <li class="pure-u-1-5">

                        <a class="tabsHeaderListIcons__link hbooks app-ua-track-event" data-track-c="Home" data-track-a="click" data-track-l="d-desktop+s-hotel-blocks" data-track-v="0" data-track-ni="0" href="javascript:;">

                           <i class="icon-header icon-header-dropdown-hotelblocks tabsHeaderListIcons__item"></i>

                           <span class="tabsHeaderListIcons__text">Hotel Blocks</span>

                        </a>

                     </li> -->

                  </ul>

               </div>

               <!-- <div class="pure-u-1-2">

                  <div class="pure-g">

                     <div class="pure-u-1-2 border-left">

                        <div class="p30 pt15">

                           <img class="block mb20 app-link" src="{{ url('/public/images/PWD_img.jpg') }}" width="48">

                           <span class="tabsHeader__subtitle tabsHeader__subtitle--link app-link" data-href="https://www.weddingwire.ca/app-weddings">Get the WeddingWire app</span>

                           <p class="tabsHeader__description">Download the PerfectWeddingDay app to plan anytime, anywhere</p>

                           <a class="tabsHeader__link mt5" href="javascript:;"> iPhone </a>

                           <a class="tabsHeader__link mt5 ml20" href="javascript:;"> Android </a>

                        </div>

                     </div>

                     <div class="pure-u-1-2">

                        <div class="p30 pr50 pt15">

                           <i class="icon-header icon-header-wedshoot block mb20 app-link"></i>

                           <span class="tabsHeader__subtitle tabsHeader__subtitle--link app-link">WedShoots</span>

                           <p class="tabsHeader__description">Easily collect all of your guests' photos in one album!</p>

                           <a class="tabsHeader__link mt5" href="{{url('website').'/wedding-website-page'}}"> Create your wedding album </a>

                        </div>

                     </div>

                  </div>

               </div> -->

            </div>

         </div>

      </div>

      <div class="tabsHeader app-common-header-dropdown wedding-venues-after-hover" style="display:none;"><!-- Wedding Venues Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-3-4">

                  <div class="pure-g">

                     <div class="pure-u-1-2 pure-u-2-3">

                        <a class="tabsHeader__title" href="{{url('services/'.$category[1]['slug'])}}">{{$category[1]['title']}}</a>

                        <ul class="pure-g">

                           @if(isset($category[1]['child']) && !empty($category[1]['child']))

                              @foreach($category[1]['child'] as $ch0)

                              <li class="pure-u-1-2">

                                 <a class="tabsHeaderList__item" rel="nofollow" href="{{url('services/'.$category[1]['slug'])}}/{{$ch0['slug']}}">{{$ch0['title']}}</a>

                              </li>

                              @endforeach

                           @endif

                        </ul>

                     </div>

                  </div>

               </div>

               <div class="pure-u-1-4 tabsHeaderBanner__container">

                  <div class="tabsHeaderBannerPromo mb20 app-link">

                     <div class="tabsHeaderBannerPromo__content">

                        <p class="tabsHeaderBannerPromo__title">Deals</p>

                        <p class="tabsHeaderBannerPromo__subtitle">Don't miss out on these amazing local deals</p>

                     </div>

                     <i class="icon-header icon-header-discount"></i>

                  </div>

                  <div class="tabsHeaderBanner tabsHeaderBanner--contest app-link">

                     <img class="tabsHeaderBanner__image" src="https://cdn1.weddingwire.ca/assets/img/dropdown/contest.jpg" alt="">

                     <div class="tabsHeaderBanner__content">

                        <p class="tabsHeaderBanner__title">Win $1,000</p>

                        <p class="tabsHeaderBanner__subtitle">Earn entries and participate in our monthly contest.</p>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      @foreach($category as $cats)

      <div class="tabsHeader app-common-header-dropdown {{$cats['slug']}}-after-hover" style="display:none;"><!-- {{$cats['slug']}} Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-1">

                  <div class="pure-g">

                     <div class="pure-u-1">

                        <a class="tabsHeader__title" href="@if(isset($cats['child']) && !empty($cats['child'])) {{url('search?category='.$cats['slug'])}} @else # @endif"><!-- <img src="{{url('public/images/mental-health.png')}}" class="img-responsive" style="width: 8%;"> --><span>{{$cats['title']}}</span></a>

                        <ul class="pure-g">

                           @if(isset($cats['child']) && !empty($cats['child']))

                              @foreach($cats['child'] as $ch0)

                              <li class="pure-u-1-5">

                                 <a class="tabsHeaderList__item" rel="nofollow" href="{{url('search?category='.$ch0['slug'])}}"><!-- <img src="{{url('public/images/mental-health.png')}}" class="img-responsive" style="width: 8%;"> --><span>{{$ch0['title']}}</span></a>

                              </li>

                              @endforeach

                           @else

                              <li class="pure-u-1-2">

                                 <a class="tabsHeaderList__item" rel="nofollow" href="#">Coming Soon</a>

                              </li>

                           @endif

                        </ul>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      @endforeach

      

      <div class="tabsHeader app-common-header-dropdown wedding-dress-after-hover" style="display:none;"><!-- Wedding Dress Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-1-2">

                  <a class="tabsHeader__title" href="{{url('/wedding-dress')}}">Browse the latest wedding looks</a>

                  <ul class="pure-g tabsHeaderListIcons__content mt10 pr50">

                     <li class="pure-u-1-4">

                        <a data-id-tipo="1" class="app-dress-tipo-nav tabsHeaderListIcons__link" rel="nofollow" href="{{url('/wedding-dress')}}">

                           <i class="svgIcon svgIcon__bride-dress tabsHeaderListIcons__item--medium">

                              <svg viewBox="0 0 119 123">

                                 <path d="M50.641 43.557l-.102.047c-.312.143-.677.318-1.09.524a61.419 61.419 0 0 0-3.942 2.162 70.869 70.869 0 0 0-12.005 8.963C24.896 63.25 18.978 72.896 16.928 84.28c-1.143 6.34-2.492 11.86-4.007 16.615-1.772 5.565-3.682 9.829-5.608 12.963-.333.54-.648 1.02-.942 1.443a332.904 332.904 0 0 0 106.276 0c-.3-.435-.622-.931-.962-1.492-1.924-3.172-3.831-7.486-5.6-13.115-1.483-4.716-2.808-10.175-3.935-16.433-2.052-11.384-7.97-21.029-16.574-29.027a70.871 70.871 0 0 0-12.005-8.964 61.418 61.418 0 0 0-3.943-2.162 39.215 39.215 0 0 0-1.166-.56 1.686 1.686 0 0 1-.406-.038h-1.503a34.262 34.262 0 0 1 3.413 3.62c3.19 3.916 5.466 8.455 6.42 13.61l-2.95.546c-.855-4.625-2.906-8.714-5.796-12.262a31.05 31.05 0 0 0-4.307-4.34 24.526 24.526 0 0 0-1.539-1.174h-4.877a23.202 23.202 0 0 0-1.445 1.111 31.48 31.48 0 0 0-4.333 4.363c-2.914 3.57-4.98 7.673-5.836 12.302l-2.95-.546c.955-5.161 3.247-9.715 6.462-13.653a34.68 34.68 0 0 1 3.368-3.577H50.98a1.504 1.504 0 0 1-.339.046zm20.797-5.813l-1.017 3.413a64.404 64.404 0 0 1 4.683 2.536 73.845 73.845 0 0 1 12.514 9.345c9.049 8.41 15.307 18.61 17.484 30.692 1.106 6.137 2.4 11.473 3.844 16.065 1.7 5.407 3.51 9.501 5.304 12.459.613 1.011 1.176 1.806 1.671 2.406.276.333.453.517.518.574l2.354 2.078-3.096.526a335.906 335.906 0 0 1-111.007.229l-4.524-.748 2.403-2.092c.064-.055.242-.237.517-.566.495-.591 1.057-1.375 1.67-2.373 1.795-2.92 3.606-6.962 5.307-12.302 1.473-4.628 2.792-10.021 3.913-16.237 2.176-12.083 8.434-22.283 17.484-30.694a73.843 73.843 0 0 1 12.514-9.344 64.405 64.405 0 0 1 4.569-2.48l-1.588-4.543h.001L38.87 13.538 34.987 3.392 44.149.73l3.543 9.79h.115c4.582 0 9.389 2.438 11.793 6.287 2.575-3.878 7.153-6.288 11.593-6.288h.054L74.79.73l9.162 2.663-3.314 8.66.024.007-9.224 25.685zm-2.337-2.366l7.584-21.119-4.352-.715a26.317 26.317 0 0 0-1.14-.025c-4.315 0-8.9 3.004-10.267 7.402L59.2 26.473l-1.175-5.694c-.863-4.18-5.714-7.26-10.218-7.26-.41 0-.817.01-1.224.029l-4.287.705 7.403 21.19c6.718-1.996 13.452-1.986 19.402-.065zM44.615 10.83l-2.33-6.436-3.332.968 2.304 6.02 3.358-.552zm35.37-5.468l-3.332-.968-2.329 6.436 3.358.552 2.304-6.02zM67.558 40.511l.763-2.23c-5.36-1.75-11.32-1.614-17.531.283l.68 1.947h16.088z" fill-rule="nonzero"></path>

                              </svg>

                           </i>

                           <span class="tabsHeaderListIcons__text">Bride</span>

                        </a>

                     </li>

                     <li class="pure-u-1-4">

                        <a data-id-tipo="2" class="app-dress-tipo-nav tabsHeaderListIcons__link" rel="nofollow" href="{{url('/party-dresses')}}">

                           <i class="svgIcon svgIcon__dress tabsHeaderListIcons__item--medium">

                              <svg viewBox="0 0 48 106">

                                 <path d="M44.061 65.173c-1.67 5.094-4.672 10.8-8.684 16.915a144.257 144.257 0 0 1-9.24 12.495 43.928 43.928 0 0 0 4.475 3.79c2.054 1.509 4.175 2.771 6.353 3.775 2.418-6.315 4.4-13.41 5.669-20.201 1.21-6.48 1.714-12.375 1.427-16.774zm1.438-8.726a38.173 38.173 0 0 1 1.484 7.616c.443 4.788-.065 11.286-1.4 18.435-1.318 7.047-3.38 14.404-5.902 20.943-.637 1.663-2.42 2.149-3.91 1.46-2.385-1.093-4.7-2.47-6.936-4.11a46.913 46.913 0 0 1-4.753-4.021c-3.661 3.43-7.761 6.22-11.872 8.114-1.515.696-3.292.258-3.944-1.44-2.524-6.542-4.586-13.899-5.903-20.947C1.028 75.35.519 68.85.963 64.063c.442-4.768 1.576-8.485 3.61-12.933.252-.55.448-.967.896-1.911 1.88-3.958 2.43-5.526 2.43-7.573 0-3.211-.506-5.35-1.894-9.133l-.168-.454c-2.13-5.777-2.818-8.973-2.534-14.68.124-2.487.335-4.875.643-7.195A69.426 69.426 0 0 1 5.25 3.103 2.78 2.78 0 0 1 7.99.8h4.32c.241 0 .448.016.645.06a2.772 2.772 0 0 1 2.162 3.285c-.356 1.69-.618 3.469-.817 5.445a91.636 91.636 0 0 0-.3 3.78c2.218 1.112 4.27 2.258 6.115 3.428a43.895 43.895 0 0 1 3.857 2.734 43.707 43.707 0 0 1 3.859-2.735c1.848-1.173 3.9-2.319 6.112-3.428a91.668 91.668 0 0 0-.3-3.782 51.789 51.789 0 0 0-.79-5.312A2.78 2.78 0 0 1 35.547.8h4.365c1.288 0 2.442.86 2.74 2.13A69.694 69.694 0 0 1 44 10.184c.309 2.328.52 4.72.64 7.194.287 5.723-.475 8.95-2.815 14.79l-.198.495c-1.499 3.761-2.05 5.915-2.05 9.1 0 1.393.518 2.69 2.237 6.001 1.684 3.228 2.845 5.903 3.685 8.683zm-6.346-7.297c-1.966-3.788-2.576-5.315-2.576-7.387 0-3.643.636-6.127 2.263-10.21l.2-.5c2.193-5.475 2.865-8.318 2.604-13.526a83.865 83.865 0 0 0-.618-6.948 66.85 66.85 0 0 0-1.25-6.778H35.82a55.04 55.04 0 0 1 .81 5.484c.149 1.452.257 2.942.368 4.904l.056.995-.896.438c-2.46 1.2-4.723 2.444-6.717 3.708-1.722 1.096-3.227 2.196-4.481 3.288l-.984.855-.984-.855c-1.26-1.093-2.765-2.193-4.484-3.287-1.99-1.261-4.25-2.504-6.72-3.71l-.895-.437.056-.995c.111-1.962.22-3.452.369-4.902.198-1.97.458-3.767.809-5.486H8.168a66.43 66.43 0 0 0-1.248 6.778 84.995 84.995 0 0 0-.621 6.949c-.26 5.228.35 8.061 2.353 13.494l.169.458c1.5 4.085 2.078 6.531 2.078 10.166 0 2.652-.646 4.492-2.72 8.86-.441.93-.634 1.34-.877 1.872C5.396 56.543 4.357 59.95 3.95 64.34c-.414 4.471.074 10.71 1.362 17.606 1.27 6.792 3.25 13.886 5.67 20.202 4.182-1.932 8.386-4.886 12.044-8.528.153-.156 1.666-1.976 3.057-3.753a139.076 139.076 0 0 0 6.785-9.424c5.992-9.134 9.609-17.283 9.694-23.341-.774-2.501-1.848-4.96-3.41-7.952z" fill-rule="nonzero"></path>

                              </svg>

                           </i>

                           <span class="tabsHeaderListIcons__text">Bridesmaid</span>

                        </a>

                     </li>

                  </ul>

               </div>

               <div class="pure-u-1-2 border-left pl20">

                  <p class="tabsHeader__subtitle tabsHeader__subtitle--link app-link" data-href="{{url('/wedding-dress')}}">Featured designers</p>

                  <div class="pure-g mt5 row">

                     @if(isset($weddingdressDesigner)) 

                        @foreach($weddingdressDesigner as $designer)



                           @if($designer->type_id == '1')

                              @php $slugcat = 'wedding-dress' @endphp

                           @else

                              @php $slugcat = 'party-dresses' @endphp

                           @endif

                           <div class="pure-u-1-5">

                              <a href="{{ url('/') }}/{{ $slugcat.'/'.$designer->slug }}"><div class="tabsHeaderGallery__item img-zoom">

                                 <img class="tabsHeaderGallery__image" title="Wedding Dresses Sincerity Bridal" src="{{ url('public') }}/weddingdresses/designer/{{ $designer->picture }}" alt="Wedding Dresses Designer">

                              </div>

                              <div class="tabsHeaderGallery__caption">

                                 <p class="tabsHeaderGallery__vendorName">{{ $designer->name }}</p>

                              </div></a>

                           </div>

                        @endforeach

                     @endif

                  </div>

               </div>

            </div>

         </div>

      </div>

      <div class="tabsHeader app-common-header-dropdown wedding-ideas-after-hover" style="display:none;"><!-- Wedding Ideas Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-1-2 mb20">

                  <a href="{{url('/wedding-ideas')}}" class="tabsHeader__title">Wedding inspiration and ideas</a>

                  <ul class="pure-g">

                     @if(isset($weddingideasCategory))

                        @foreach($weddingideasCategory as $wic)

                        <li class="pure-u-1-2">

                           <a class="tabsHeaderList__item" rel="nofollow" href="{{url('wedding-ideas').'/'.$wic->slug}}">{{$wic->title}}</a>

                        </li>

                        @endforeach

                     @endif

                  </ul>

               </div>

               <div class="pure-u-1-2">

                  <div class="pure-g">

                     <div class="pure-u-1-2"></div>

                     <div class="pure-u-1-2 border-left pl25">

                        <span class="tabsHeader__subtitle tabsHeader__subtitle--link app-link">Real Weddings</span>

                        <img class="mb5 mt5 app-link" src="https://cdn1.weddingwire.ca/assets/img/gen_tabs-rw.png" alt="Find wedding inspiration that fits your style with photos from real couples." width="100%">

                        <p class="tabsHeader__description">Find wedding inspiration that fits your style with photos from real couples.</p>

                        <a class="tabsHeader__link mt5" rel="nofollow" href="javascript:;">

                           <span>Browse Real Weddings</span>

                        </a>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      <div class="tabsHeader app-common-header-dropdown blogs-after-hover" style="display:none;"><!-- Community Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-3-4 mb30">

                  <a href="{{url('/blog')}}" class="tabsHeader__title">Blog</a>

                  <!-- <ul class="pure-g">

                     @if(isset($blogCategory))

                        @foreach($blogCategory as $cat)

                        <li class="pure-u-1-3">

                           <a class="tabsHeaderList__item" rel="nofollow" href="{{url('blog').'/'.$cat->slug}}">{{$cat->name}}</a>

                        </li>

                        @endforeach

                     @endif

                  </ul> -->

               </div>

               <div class="pure-u-1-4 border-left pl25 hidden">

                  <a class="tabsHeader__subtitle tabsHeader__subtitle--link app-link" data-href="{{url('/community')}}">View the latest</a>

                  <div class="pure-g mt25">

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/community')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-community tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Discussions</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/photos')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-photos tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Photos</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/videos')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-video tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Videos</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/forums')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-users tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Members</span>

                        </a>

                     </div>

                  </div>

                  <a class="btn-outline outline-red btn-full app-link" style="text-align: center;" href="{{url('/community')}}">Start new discussion</a>

               </div>

            </div>

         </div>

      </div>

      <div class="tabsHeader app-common-header-dropdown community-after-hover" style="display:none;"><!-- Community Page -->

         <div class="wrapper wrapper--blood">

            <div class="pure-g">

               <div class="pure-u-1 mb30">

                  <a href="{{url('/community')}}" class="tabsHeader__title">Community</a>

                  <ul class="pure-g">

                     @if(isset($blogCategory))

                        @foreach($blogCategory as $key => $cat)

                        <li class="pure-u-1-5">

                           <a class="tabsHeaderList__item" rel="nofollow" href="{{url('community').'/'.$cat->slug}}">{{$cat->name}}</a>

                        </li>

                        @php if($key > 3) break; @endphp

                        @endforeach

                     @endif

                     <li class="pure-u-1-5">

                        <a class="tabsHeaderList__item" rel="nofollow" href="{{url('testimonial')}}">Testimony</a>

                     </li>

                  </ul>

               </div>

               <div class="pure-u-1-4 border-left pl25 hidden">

                  <a class="tabsHeader__subtitle tabsHeader__subtitle--link app-link" data-href="{{url('/community')}}">View the latest</a>

                  <div class="pure-g mt25">

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/community')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-community tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Discussions</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/photos')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-photos tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Photos</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/videos')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-video tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Videos</span>

                        </a>

                     </div>

                     <div class="pure-u-1-2">

                        <a class="tabsHeaderListIcons__link" href="{{url('/forums')}}" rel="nofollow">

                           <i class="icon-header icon-header-filled-users tabsHeaderListIcons__item tabsHeaderListIcons__item--small"></i>

                           <span class="tabsHeaderListIcons__text">Members</span>

                        </a>

                     </div>

                  </div>

                  <a class="btn-outline outline-red btn-full app-link" style="text-align: center;" href="{{url('/community')}}">Start new discussion</a>

               </div>

            </div>

         </div>

      </div>

   </div>

</section>

<script>

$(document).ready(function()

{

   <?php foreach($category as $cats){ ?>

      $(".{{$cats['slug']}}, .{{$cats['slug']}}-after-hover").hover(function() {

         $('.{{$cats['slug']}}-after-hover').css('display','block');

      }, function() {

         $('.{{$cats['slug']}}-after-hover').css('display','none');

      });

   <?php } ?>

   $(".plaining_tool_page, .plaining-tool-after-hover").hover(function() {

      $('.plaining-tool-after-hover').css('display','block');

   }, function() {

      $('.plaining-tool-after-hover').css('display','none');

   });

   $(".wedding_venues_page, .wedding-venues-after-hover").hover(function() {

      $('.wedding-venues-after-hover').css('display','block');

   }, function() {

      $('.wedding-venues-after-hover').css('display','none');

   });

   $(".wedding_vendors_page, .wedding-vendors-after-hover").hover(function() {

      $('.wedding-vendors-after-hover').css('display','block');

   }, function() {

      $('.wedding-vendors-after-hover').css('display','none');

   });

   $(".wedding_dress_page, .wedding-dress-after-hover").hover(function() {

      $('.wedding-dress-after-hover').css('display','block');

   }, function() {

      $('.wedding-dress-after-hover').css('display','none');

   });

   $(".wedding_ideas_page, .wedding-ideas-after-hover").hover(function() {

      $('.wedding-ideas-after-hover').css('display','block');

   }, function() {

      $('.wedding-ideas-after-hover').css('display','none');

   });

   $(".community_page, .community-after-hover").hover(function() {

      $('.community-after-hover').css('display','block');

   }, function() {

      $('.community-after-hover').css('display','none');

   });

   /*$(".blog_page, .blogs-after-hover").hover(function() {

      $('.blogs-after-hover').css('display','block');

   }, function() {

      $('.blogs-after-hover').css('display','none');

   });*/

   ////// Click event on .app-link......

   $('body').on('click', '.app-link', function() {

      var curUrl = $(this).attr('data-href');

      window.location.href = curUrl;

   });

});

$(window).scroll(function() {

   if($(this).scrollTop() > 0) {

      $('.plaining-tool-after-hover').css('display','none');

      $('.wedding-venues-after-hover').css('display','none');

      $('.wedding-vendors-after-hover').css('display','none');

      $('.wedding-dress-after-hover').css('display','none');

      $('.wedding-ideas-after-hover').css('display','none');

      $('.community-after-hover').css('display','none');

   }

});

</script>



<script>

    $('.sub-category-mobile').css('display','none');

   $(".main-category-mobile").hover(function(e) {

      $(this).find('.sub-category-mobile').css('display','block');

   }, function() {

      $(this).find('.sub-category-mobile').css('display','none');

   });

    $('.sub-mobile-community').css('display','none');

   $(".main-mobile-commmunity").hover(function() {



      $(this).find('.sub-mobile-community').css('display','block');

   }, function() {

      $(this).find('.sub-mobile-community').css('display','none');

   });



</script>













<style type="text/css">

   .section-padding .dashboard-wrap{

      padding: 0 !important;

      margin-top: 0 !important;

   }

   @media only screen and (max-width: 479px){

      .section-padding {

         padding: 0 !important;

         margin-top: 0 !important;

      }

      .dashboard-wrap {

         padding: 0 !important;

         margin-top: 0 !important;

      }

   }

</style>