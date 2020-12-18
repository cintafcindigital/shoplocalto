<div class="pure-u-2-7">
	         <div class="mr40">
	            <div class="adminAsideStorefront">
	            	 <header class="adminAsideStorefront__header" style="background:url('{{ $data['vendor']->profile ? asset('vendors/VENDOR_'.$data['vendor']->vendor_id.'/'.$data['vendor']->profile) : (isset($vendor_img->image_data[0]->image)?asset('vendors/'.$vendor_img->image_data[0]->vendor_folder.'/'.$vendor_img->image_data[0]->image):'')}}') no-repeat scroll 50% 50% transparent;background-size:cover;">
	                  <span class="adminAsideStorefront__label">{{$data['vendor']->contact_person}}</span>
	               </header>
	               
	               <a class="adminAsideStorefront__footer" href="{{url('vendor')}}/{{$vendor_slug->company_data->business_name_slug}}" target="_blank">
	               View Profile</a>
	            </div>
	            <nav class="adminAside">
	               <a class="adminAside__item {{ Request::is('storefront')?'active':'' }}" href="{{url('storefront')}}">
	                  <i class="svgIcon svgIcon__gen adminAside__icon">
	                     <svg viewBox="0 0 17 18">
	                        <path d="M1 1v16h15V1H1zm0-1h15a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm3.5 5V4h10v1h-10zm-1 3.5v-1h11v1h-11z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Business Information                    
	               </a>
	               <a class="adminAside__item {{ Request::is('storefront-map')?'active':'' }}" href="{{url('storefront-map')}}">
	                  <i class="svgIcon svgIcon__map adminAside__icon">
	                     <svg viewBox="0 0 20 20">
	                        <path d="M12.76 14.65a.528.528 0 0 1 .586 0l5.287 3.525V5.193l-5.58-3.72L7.24 5.35a.528.528 0 0 1-.585 0L1.367 1.825v12.982l5.58 3.72 5.814-3.877zm.294 1.074L7.239 19.6a.528.528 0 0 1-.585 0L.547 15.528a.528.528 0 0 1-.235-.439V.84c0-.421.47-.673.82-.439l5.814 3.876L12.761.4a.528.528 0 0 1 .585 0l6.107 4.072a.528.528 0 0 1 .235.439v14.25c0 .421-.47.673-.82.439l-5.814-3.876zm-5.58 3.437a.528.528 0 0 1-1.055 0V4.91a.528.528 0 1 1 1.055 0v14.25zm6.107-4.072a.528.528 0 0 1-1.055 0V.84a.528.528 0 1 1 1.055 0v14.25z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  <!--Location and Map                    -->
	                  Address
	               </a>
	               <!-- <a class="adminAside__item {{ Request::is('storefront-faqs')?'active':'' }}" href="{{url('storefront-faqs')}}">
	                  <i class="svgIcon svgIcon__faqs adminAside__icon">
	                     <svg viewBox="0 0 21 20">
	                        <path d="M6.6 18.205l3.705-3.405H19.1V1.7h-18v13.1h5.5v3.405zm-.138.127c-.027.026-.035.033.014.008.076-.037.103-.04.124-.04h-.104l-.034.032zm.692.722c-.114.113-.137.134-.23.18a.581.581 0 0 1-.324.066h-.318l-.106-.053A1.048 1.048 0 0 1 5.6 18.3v-2.5H1.1c-.576 0-1-.424-1-1V1.7c0-.576.424-1 1-1h18c.576 0 1 .424 1 1v13.1c0 .576-.424 1-1 1h-8.405l-3.541 3.254zM10.1 12.6a.7.7 0 1 0 0-1.4.7.7 0 0 0 0 1.4zm0-2.7c-.3 0-.5-.2-.5-.5v-.7c0-.3.2-.5.5-.5.9 0 1.6-.7 1.6-1.5s-.7-1.5-1.6-1.5c-.9 0-1.6.7-1.6 1.5 0 .3-.2.5-.5.5s-.6-.2-.6-.5c0-1.4 1.1-2.5 2.6-2.5s2.6 1.1 2.6 2.5c0 1.2-.9 2.2-2.1 2.5v.2c.1.3-.1.5-.4.5z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Frequently Asked Questions                                                    
	               </a> -->
	             
	              <!--  <a class="adminAside__item {{ Request::is('promociones') || Request::is('promocionesnew') || (request()->segment(2)!='null' && request()->segment(2)=='promocionesedit')?'active':'' }}" href="{{url('promociones')}}">
	                  <i class="svgIcon svgIcon__promos adminAside__icon">
	                     <svg viewBox="0 0 20 20">
	                        <path d="M18.295 7.642a.5.5 0 0 0 .067.25l.783 1.357a1.5 1.5 0 0 1 0 1.499l-.782 1.355a.5.5 0 0 0-.067.25v1.565a1.5 1.5 0 0 1-.75 1.3L16.19 16a.5.5 0 0 0-.183.183l-.776 1.344a1.5 1.5 0 0 1-1.291.75l-1.583.009a.5.5 0 0 0-.247.067l-1.358.785a1.5 1.5 0 0 1-1.502 0l-1.353-.783a.5.5 0 0 0-.25-.068H6.076a1.5 1.5 0 0 1-1.298-.749l-.784-1.355A.5.5 0 0 0 3.812 16l-1.357-.784a1.5 1.5 0 0 1-.75-1.299v-1.564a.5.5 0 0 0-.066-.25l-.783-1.356a1.5 1.5 0 0 1 0-1.5l.783-1.356a.5.5 0 0 0 .067-.25V6.076a1.5 1.5 0 0 1 .75-1.3l1.356-.783a.5.5 0 0 0 .183-.183l.784-1.355a1.5 1.5 0 0 1 1.298-.749h1.568a.5.5 0 0 0 .25-.067L9.25.856a1.5 1.5 0 0 1 1.5 0l1.356.783a.5.5 0 0 0 .25.067h1.569a1.5 1.5 0 0 1 1.299.75l.782 1.354a.5.5 0 0 0 .183.183l1.357.784a1.5 1.5 0 0 1 .75 1.299v1.566zm-1 0V6.076a.5.5 0 0 0-.25-.433l-1.357-.784a1.5 1.5 0 0 1-.549-.549l-.782-1.354a.5.5 0 0 0-.433-.25h-1.569a1.5 1.5 0 0 1-.75-.201l-1.355-.783a.5.5 0 0 0-.5 0l-1.354.783a1.5 1.5 0 0 1-.751.201H6.077a.5.5 0 0 0-.433.25L4.861 4.31a1.5 1.5 0 0 1-.548.547l-1.358.785a.5.5 0 0 0-.25.433v1.566a1.5 1.5 0 0 1-.2.75l-.783 1.356a.5.5 0 0 0 0 .5l.782 1.355a1.5 1.5 0 0 1 .202.75v1.565a.5.5 0 0 0 .25.433l1.356.784a1.5 1.5 0 0 1 .549.548l.783 1.356a.5.5 0 0 0 .433.25h1.568c.264 0 .523.069.751.201l1.354.783a.5.5 0 0 0 .5 0l1.358-.785a1.5 1.5 0 0 1 .743-.201l1.582-.009a.5.5 0 0 0 .43-.25l.777-1.344a1.5 1.5 0 0 1 .55-.55l1.356-.783a.5.5 0 0 0 .25-.433v-1.565c0-.263.07-.521.2-.75l.783-1.355a.5.5 0 0 0 0-.5l-.783-1.357a1.5 1.5 0 0 1-.201-.75zM6.963 13.744a.5.5 0 0 1-.676-.738l6.75-6.187a.5.5 0 1 1 .676.737l-6.75 6.188zm5.677.412a.953.953 0 1 1 0-1.906.953.953 0 0 1 0 1.906zM7.015 8.127a.953.953 0 1 1 0-1.906.953.953 0 0 1 0 1.906z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Deals   <span class="adminAside__counter">{{ isset($deals) && $deals>0?$deals:''}}</span>

	               </a> -->
	               <a class="adminAside__item {{ Request::is('gallery')?'active':'' }}" href="{{url('gallery')}}">
	                  <i class="svgIcon svgIcon__photos adminAside__icon">
	                     <svg viewBox="0 0 20 16">
	                        <path d="M18.7 14.7c.17 0 .3-.12.3-.3V4.3c0-.17-.12-.3-.3-.3H1.5c-.17 0-.3.12-.3.3v10.1c0 .17.12.3.3.3h17.2zM5.158 3h1.655l.713-1.958C7.702.512 8.169.3 8.8.3h2.5c.597 0 1.1.32 1.267.822L13.283 3H18.7c.753 0 1.3.597 1.3 1.3v10.1c0 .753-.597 1.3-1.3 1.3H1.5c-.753 0-1.3-.597-1.3-1.3V4.3c0-.732.564-1.27 1.242-1.299A.498.498 0 0 1 1.4 2.8c0-.676.524-1.2 1.2-1.2H4c.676 0 1.2.524 1.2 1.2a.498.498 0 0 1-.042.2zm-.916 0a.498.498 0 0 1-.042-.2c0-.124-.076-.2-.2-.2H2.6c-.124 0-.2.076-.2.2a.498.498 0 0 1-.042.2h1.884zm3.635 0h4.336l-.587-1.542c-.03-.09-.138-.158-.326-.158H8.8c-.25 0-.316.03-.33.07L7.877 3zM10.1 14.2a4.6 4.6 0 1 1 0-9.2 4.6 4.6 0 0 1 0 9.2zm0-1a3.6 3.6 0 1 0 0-7.2 3.6 3.6 0 0 0 0 7.2zm3.6-5.3a.5.5 0 1 1 0-1h5.6a.5.5 0 1 1 0 1h-5.6zM.8 7.9a.5.5 0 0 1 0-1h5.6a.5.5 0 0 1 0 1H.8z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Photos <span class="adminAside__counter">{{ isset($photos) && $photos>0?$photos:''}}</span>
	               </a>
	               <a class="adminAside__item {{ Request::is('videos')?'active':'' }}" href="{{url('videos')}}">
	                  <i class="svgIcon svgIcon__videos adminAside__icon">
	                     <svg viewBox="0 0 20 20">
	                        <path d="M10.1 19.3C5 19.3.8 15.1.8 10 .8 4.9 5 .7 10.1.7c5.1 0 9.3 4.2 9.3 9.3 0 5.1-4.3 9.3-9.3 9.3zm0-1c4.484 0 8.3-3.788 8.3-8.3 0-4.548-3.752-8.3-8.3-8.3-4.548 0-8.3 3.752-8.3 8.3 0 4.548 3.752 8.3 8.3 8.3zM6.7 15c-.1 0-.2 0-.3-.1-.1-.1-.2-.3-.2-.4V5.8c0-.2.1-.3.2-.4.1-.1.3-.1.5 0l8.7 4.4c.2.1.3.3.3.4 0 .1-.1.4-.3.4l-8.7 4.3c0 .1-.1.1-.2.1zm.5-8.328v6.964l6.964-3.442L7.2 6.672z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Videos <span class="adminAside__counter">{{ isset($videos) && $videos>0?$videos:''}}</span>                                       
	               </a>
	               <!-- <a class="adminAside__item " href="javascript:;">
	                  <i class="svgIcon svgIcon__reals adminAside__icon">
	                     <svg viewBox="0 0 20 14">
	                        <path d="M7 13.5a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13zm0-1a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm6 1a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13zm0-1a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Real Weddings                            
	               </a> -->
	               <!-- <a class="adminAside__item {{ Request::is('availability')?'active':'' }}" href="{{url('availability')}}">
	                  <i class="svgIcon svgIcon__calendar adminAside__icon">
	                     <svg viewBox="0 0 20 16">
	                        <path d="M1.5 1v14h17V1h-17zm0-1h17a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-17a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1zm0 4V3h18v1h-18zm3.64 7.608c.198-.472.667-.971 1.406-1.499.641-.459 1.056-.787 1.245-.986.29-.31.435-.648.435-1.016 0-.3-.083-.548-.25-.747-.165-.198-.403-.298-.712-.298-.424 0-.712.158-.865.474-.087.182-.14.472-.156.87H4.891c.022-.603.131-1.09.327-1.46.37-.707 1.03-1.06 1.977-1.06.749 0 1.345.207 1.787.622.443.415.664.965.664 1.648 0 .524-.156.99-.468 1.397-.205.27-.542.571-1.011.903l-.557.396c-.348.247-.586.426-.715.537-.129.11-.237.239-.325.385h3.091V13H4.813c.013-.508.122-.972.327-1.392zm6.115-3.49V7.17c.44-.02.747-.049.923-.088.28-.062.508-.186.683-.371.12-.127.212-.296.274-.508.036-.127.053-.221.053-.283h1.158V13H12.92V8.117h-1.665z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Availability                        
	               </a> -->
	               <!--<a class="adminAside__item {{ Request::is('events')?'active':'' }}" href="{{url('events')}}">
	                  <i class="svgIcon svgIcon__events adminAside__icon">
	                     <svg viewBox="0 0 18 17">
	                        <path d="M1 3v13h16V3H1zm0-1h16a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zM2.5.5a.5.5 0 0 1 1 0v3a.5.5 0 0 1-1 0v-3zm4 0a.5.5 0 0 1 1 0v3a.5.5 0 0 1-1 0v-3zm4 0a.5.5 0 1 1 1 0v3a.5.5 0 1 1-1 0v-3zm4 0a.5.5 0 1 1 1 0v3a.5.5 0 1 1-1 0v-3z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Events  <span class="adminAside__counter">{{ isset($events) && $events>0?$events:''}}</span>                                          
	               </a>-->
	               <!-- <a class="adminAside__item " href="javascript:;">
	                  <i class="svgIcon svgIcon__endorsement adminAside__icon">
	                     <svg viewBox="0 0 20 19">
	                        <path d="M17.37 9.335c-.167 3.633-2.642 6.798-6.175 7.691a.5.5 0 1 1-.245-.969c3.055-.773 5.214-3.49 5.413-6.636a2.44 2.44 0 1 1 1.006-.086zM4.146 15.8C1.282 13.64.07 9.863 1.274 6.457a.5.5 0 1 1 .943.333c-1.042 2.948-.019 6.22 2.43 8.133a2.44 2.44 0 1 1-.5.877zm1.64-14.228C8.57.356 11.827.72 14.208 2.566a.5.5 0 1 1-.613.79c-2.051-1.591-4.856-1.928-7.282-.922a2.44 2.44 0 1 1-.528-.862zM5.454 3.25a1.435 1.435 0 0 0-1.44-1.44 1.44 1.44 0 1 0 1.44 1.44zm2.457 13.293a1.44 1.44 0 1 0-2.88 0 1.44 1.44 0 0 0 2.88 0zM18.102 7a1.44 1.44 0 1 0-2.88 0 1.44 1.44 0 0 0 2.88 0z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Preferred Vendors                                            
	               </a> -->
	               <a class="adminAside__item {{ Request::is('owners')?'active':'' }}" href="{{url('owners')}}">
	                  <i class="svgIcon svgIcon__owners adminAside__icon">
	                     <svg viewBox="0 0 40 40">
	                        <path d="M36.9 27.9l-4-2.4v-1.9c1.6-1.6 2.7-4.1 2.7-6.9 0-4.8-3.1-8.8-7-8.8-3.8 0-7 3.9-7 8.8 0 3 1.2 5.6 3 7.2v1.5L22 27l-4.7-2.8v-2.1c1.9-1.8 3.2-4.7 3.2-8 0-5.5-3.6-10-7.9-10-4.4 0-7.9 4.5-7.9 10 0 3.5 1.4 6.6 3.6 8.4v1.7L3.5 27C1.3 28.1 0 30.2 0 32.5v3.6h40v-3.3c0-2.3-1.7-4.1-3.1-4.9zm-8.4-17.8c2.1 0 3.8 1.8 4.5 4.3-1 .1-1.8-.2-2.7-1.9-.2-.4-.6-.6-.9-.6-.4 0-.8.2-.9.6-.4.9-2 1.8-3.3 1.8-.4 0-.8-.1-1.2-.2.8-2.3 2.5-4 4.5-4zm-4.8 6.7v-.6c.5.1 1 .2 1.6.2 1.5 0 3-.7 4.1-1.6.7.9 1.8 1.7 3.4 1.7h.6v.3c0 3.7-2.2 6.6-4.9 6.6s-4.8-3-4.8-6.6zM12.6 6.3c2.5 0 4.7 2.2 5.5 5.3-1.3.2-2.4-.2-3.5-2.2-.2-.4-.6-.6-.9-.6-.4 0-.8.2-.9.6-.5 1.1-2.4 2.1-4 2.1-.6 0-1.1-.1-1.6-.3.8-2.9 2.9-4.9 5.4-4.9zm-5.9 7.9v-.9c.6.2 1.3.3 2 .3 1.7 0 3.6-.8 4.8-2 .8 1.1 2 2.1 3.9 2.1.3 0 .6 0 .9-.1v.5c0 4.4-2.6 7.9-5.8 7.9-3.2.1-5.8-3.5-5.8-7.8zM23.4 34H2.1v-1.5c0-1.5.9-2.9 2.4-3.6l5.8-3.4v-1.7c.7.3 1.5.4 2.3.4.9 0 1.8-.2 2.7-.6v1.9l5.7 3.4c1.2.7 2.5 2.1 2.5 3.6V34zm14.5 0H25.5v-1.5c0-1.6-.8-3-1.7-4.1l2.9-1.7v-1.6c.6.2 1.2.3 1.8.3.8 0 1.5-.2 2.2-.5v1.7l5.1 3c1 .6 2.1 1.8 2.1 3.1V34z"></path>
	                     </svg>
	                  </i>
	                  Meet the Team                        
	               </a>
	               <a class="adminAside__item {{ Request::is('sociales')?'active':'' }}" href="{{url('sociales')}}">
	                  <i class="svgIcon svgIcon__social adminAside__icon">
	                     <svg viewBox="0 0 19 20">
	                        <path d="M6.86 11.517a3.5 3.5 0 1 1 .24-3.642l5.078-2.77a3.5 3.5 0 1 1 .45.894L7.435 8.833a3.518 3.518 0 0 1-.117 1.782l5.106 3.713A3.5 3.5 0 0 1 19 16a3.5 3.5 0 1 1-6.931-.695l-5.208-3.788zM4 12a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm11.5-5.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 12a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" fill-rule="nonzero"></path>
	                     </svg>
	                  </i>
	                  Social Media                    
	               </a>
	            </nav>
	         </div>
	      </div>