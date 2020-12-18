        <div class="row visible-xs">
            <div class="col-sm-2">
                        <a class="adminNav__item {{Request::is('dashboard')?'adminNav__item--current':''}} {{Request::is('dashboard')?'adminNav__item--current':''}}" href="{{url('dashboard')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-business"></span>
                            <span class="adminNav__itemText">Home</span>
                        </a>
</div>
                    <div class="col-sm-2">
                        <a class=" adminNav__item {{Request::is('storefront') || Request::is('storefront-map') || Request::is('storefront-faqs') || Request::is('promociones') || Request::is('promocionesnew') || Request::is('gallery') || Request::is('videos') || Request::is('availability') || Request::is('events') || Request::is('eventsnew') || Request::is('owners') || Request::is('ownersnew') || Request::is('sociales')?'adminNav__item--current':''}} {{Request::is('storefront')?'adminNav__item--current':''}}" href="{{url('storefront')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-storefront"></span>
                            <span class="adminNav__itemText">Profile</span>
                        </a>
                    </div>
                    <div class="col-sm-2 app-vendor-menu-requests">
                        <a class="adminNav__item {{Request::is('messages') || Request::is('messages-unread') || Request::is('messages-read') || Request::is('messages-pending') || Request::is('messages-replied') || Request::is('messages-booked') || Request::is('messages-discarded') || Request::is('entries') || Request::is('messages-setting') || Request::is('messages-templates')?'adminNav__item--current':''}} {{Request::is('message-details/*')?'adminNav__item--current':''}}" href="{{url('messages')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-inbox">
                                @if(isset($messageCount['unread']))
                                    <span class="adminNav__itemCount app-vendors-admin-nav-item-count">{{ $messageCount['unread'] }}</span>
                                @endif
                            </span>
                            <span class="adminNav__itemText">Messages</span>
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a class="adminNav__item {{Request::is('reviews') || Request::is('reviews-list') || Request::is('reviews-sellos') || Request::is('reviews-widget') || Request::is('reviews-templates')?'adminNav__item--current':''}}" href="{{url('reviews')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-reviews"></span>
                            <span class="adminNav__itemText">Reviews</span>
                        </a>
                    </div>
                    <!--<div class="col-sm-2">
                        <a class="adminNav__item {{Request::is('invoices') || Request::is('bills') || Request::is('payment-method') || Request::is('add-payment-method')?'adminNav__item--current':''}} {{Request::is('invoices')?'adminNav__item--current':''}}" href="{{url('invoices')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>
                            <span class="adminNav__itemText">Billing</span>
                        </a>
                    </div>-->
                    <div class="col-sm-2">
                        <a class="adminNav__item {{Request::is('account-settings') || Request::is('profile-settings') || Request::is('employees') || Request::is('vendor-settings') || Request::is('image-settings') || Request::is('question-settings') ? 'adminNav__item--current':'' }}" href="{{url('profile-settings')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-account"></span>
                            <span class="adminNav__itemText">Settings</span>
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a class="adminNav__item {{(Request::is('supports/opened') || Request::is('supports/awaiting-replies') || Request::is('supports/closed') || Request::is('supports/customer-service') || Request::is('supports/sales-support') || Request::is('supports/technical-support') || Request::is('ticket-support-add')?'adminNav__item--current':'')}} {{Request::is('supports-details/*')?'adminNav__item--current':''}}" href="{{url('supports/customer-service')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor icon-vendor-nav-support"></span>
                            <span class="adminNav__itemText">Support</span>
                        </a>
                    </div>
                    @if(@$data['vendorData'][0]['weddingidea_permission'] == 1 || @$data['vendor']->weddingidea_permission == 1)
                        <div class="col-sm-2">
                            <a class="adminNav__item {{(Request::is('blogs') || Request::is('add-blogs') || Request::is('edit-wedding-ideas')?'adminNav__item--current':'') }}" href="{{url('blogs')}}">
                                <span class="adminNav__itemIcon icon-vendor icon-vendor-weddingidea"></span>
                                <span class="adminNav__itemText">Wedding Ideas</span>
                            </a>
                        </div>
                    @endif
                    <div class="col-sm-2">
                        <nav class="navbar navbar-expand-md navbar-light bg-light btco-hover-menu">
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdownMenuLink" class="dropdown-toggle adminNav__item {{(Request::is('supports/opened') || Request::is('supports/awaiting-replies') || Request::is('supports/closed') || Request::is('supports/customer-service') || Request::is('supports/sales-support') || Request::is('supports/technical-support') || Request::is('ticket-support-add')?'adminNav__item--current':'')}} {{Request::is('supports-details/*')?'adminNav__item--current':''}}" href="javascript:;" data-toggle="dropdown" style="padding-bottom:12px !important;">
                                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-support"></span>
                                            <span class="adminNav__itemText" style="padding-top: 4px !important;">Support</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{url('supports/customer-service')}}">Customer Service</a></li>
                                            <li><a class="dropdown-item" href="{{url('supports/sales-support')}}">Sales / Billing Support</a></li>
                                            <li><a class="dropdown-item" href="{{url('supports/technical-support')}}">Technical Support</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
        </div>
<div class="tools-navigation hidden-xs">
    <div class="container">
        <div class="pure-g">
            <div class="pure-u-3-4">
                <ul class="pure-g">
                    <li class="pure-u-1-7">
                        <a class="adminNav__item {{Request::is('dashboard')?'adminNav__item--current':''}} {{Request::is('dashboard')?'adminNav__item--current':''}}" href="{{url('dashboard')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-business"></span>
                            <span class="adminNav__itemText">Home</span>
                        </a>
                    </li>
                    <li class="pure-u-1-7">
                        <a class=" adminNav__item {{Request::is('storefront') || Request::is('storefront-map') || Request::is('storefront-faqs') || Request::is('promociones') || Request::is('promocionesnew') || Request::is('gallery') || Request::is('videos') || Request::is('availability') || Request::is('events') || Request::is('eventsnew') || Request::is('owners') || Request::is('ownersnew') || Request::is('sociales')?'adminNav__item--current':''}} {{Request::is('storefront')?'adminNav__item--current':''}}" href="{{url('storefront')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-storefront"></span>
                            <span class="adminNav__itemText">Profile</span>
                        </a>
                    </li>
                    <li class="pure-u-1-7 app-vendor-menu-requests">
                        <a class="adminNav__item {{Request::is('messages') || Request::is('messages-unread') || Request::is('messages-read') || Request::is('messages-pending') || Request::is('messages-replied') || Request::is('messages-booked') || Request::is('messages-discarded') || Request::is('entries') || Request::is('messages-setting') || Request::is('messages-templates')?'adminNav__item--current':''}} {{Request::is('message-details/*')?'adminNav__item--current':''}}" href="{{url('messages')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-inbox">
                                @if(isset($messageCount['unread']))
                                    <span class="adminNav__itemCount app-vendors-admin-nav-item-count">{{ $messageCount['unread'] }}</span>
                                @endif
                            </span>
                            <span class="adminNav__itemText">Messages</span>
                        </a>
                    </li>
                    <li class="pure-u-1-7">
                        <a class="adminNav__item {{Request::is('reviews') || Request::is('reviews-list') || Request::is('reviews-sellos') || Request::is('reviews-widget') || Request::is('reviews-templates')?'adminNav__item--current':''}}" href="{{url('reviews')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-reviews"></span>
                            <span class="adminNav__itemText">Reviews</span>
                        </a>
                    </li>
                    <!--<li class="pure-u-1-7">
                        <a class="adminNav__item {{Request::is('invoices') || Request::is('bills') || Request::is('payment-method') || Request::is('add-payment-method')?'adminNav__item--current':''}} {{Request::is('invoices')?'adminNav__item--current':''}}" href="{{url('invoices')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>
                            <span class="adminNav__itemText">Billing</span>
                        </a>
                    </li>-->
                    <li class="pure-u-1-7">
                        <a class="adminNav__item {{Request::is('account-settings') || Request::is('profile-settings') || Request::is('employees') || Request::is('vendor-settings') || Request::is('image-settings') || Request::is('question-settings') ? 'adminNav__item--current':'' }}" href="{{url('profile-settings')}}">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-account"></span>
                            <span class="adminNav__itemText">Settings</span>
                        </a>
                    </li>
                    @if(@$data['vendorData'][0]['weddingidea_permission'] == 1 || @$data['vendor']->weddingidea_permission == 1)
                        <li class="pure-u-1-7">
                            <a class="adminNav__item {{(Request::is('blogs') || Request::is('add-blogs') || Request::is('edit-wedding-ideas')?'adminNav__item--current':'') }}" href="{{url('blogs')}}">
                                <span class="adminNav__itemIcon icon-vendor icon-vendor-weddingidea"></span>
                                <span class="adminNav__itemText">Wedding Ideas</span>
                            </a>
                        </li>
                    @endif
                    <li class="pure-u-1-7">
                        <nav class="navbar navbar-expand-md navbar-light bg-light btco-hover-menu">
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdownMenuLink" class="dropdown-toggle adminNav__item {{(Request::is('supports/opened') || Request::is('supports/awaiting-replies') || Request::is('supports/closed') || Request::is('supports/customer-service') || Request::is('supports/sales-support') || Request::is('supports/technical-support') || Request::is('ticket-support-add')?'adminNav__item--current':'')}} {{Request::is('supports-details/*')?'adminNav__item--current':''}}" href="javascript:;" data-toggle="dropdown" style="padding-bottom:12px !important;">
                                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-support"></span>
                                            <span class="adminNav__itemText" style="padding-top: 4px !important;">Support</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{url('supports/customer-service')}}">Customer Service</a></li>
                                            <li><a class="dropdown-item" href="{{url('supports/sales-support')}}">Sales / Billing Support</a></li>
                                            <li><a class="dropdown-item" href="{{url('supports/technical-support')}}">Technical Support</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </li>
                </ul>
            </div>
            <div class="pure-u-1-4">
                <div class="adminPercent fright app-link">
                    <a href="{{url('vendor-checklist')}}">
                        <p class="adminPercent__title">
                            Complete your professional profile <small class="adminPercent__count">{{$vendor_progress_percentage}}%</small>
                        </p>
                        <span class="adminPercent__bar adminPercent__bar--{{$vendor_progress_percentage}}">
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                            <span class="adminPercent__barItem"></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Tools Navigation -->
<style type="text/css">
    .bottom-menu{
        /*overflow-x: auto;*/
        /*white-space: nowrap;*/
        width: 100%;
        padding: 5%;
    }
    .bottom-menu a {
        padding: 2%;
        font-size: 14px;
    }
    .bottom-menu div {
        width: 14.28571428571429%;
    }
</style>
<div class="hidden" style="overflow: hidden;background-color: #333;position: fixed;bottom: 0;width: 100%;background: #fff;z-index: 999;">
    <div class="bottom-menu">
        <!-- <div>
           <a href="">Home</a>
        </div>
        <div>
        </div> -->
           <a href="" class="adminNav__item">
                            <span class="adminNav__itemIcon icon-vendor icon-vendor-nav-finances"></span>
           Home</a>
           <a href="">Profile</a>
           <a href="">Messages</a>
           <a href="">Reviews</a>
           <a href="">Billing</a>
           <a href="">Settings</a>
           <a href="">Support</a>
    </div>
</div>