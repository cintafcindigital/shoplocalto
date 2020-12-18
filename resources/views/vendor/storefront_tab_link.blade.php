<ul class="storefront-nav wrapper">
		<li class="storefront-nav-tab  app-general-item {{ count(request()->segments())==2?'current':'' }}">
			<a class="storefront-nav-item icon-vendor app-general-item-link " href="{{url('view_storefront/'.request()->segment(2))}}">Profile</a>
		</li>
		<li class="storefront-nav-tab app-general-item {{ request()->segment(3)=='faqs'?'current':'' }}">
			<a class="storefront-nav-item icon-vendor app-general-item-link" href="{{ url('view_storefront/'.request()->segment(2).'/faqs') }}">FAQs</a>
		</li>
		<li class="storefront-nav-tab app-general-item {{ request()->segment(3)=='photos'?'current':'' }}">
			<a class="storefront-nav-item icon-vendor app-general-item-link" href="{{ url('view_storefront/'.request()->segment(2).'/photos') }}">Photos</a>
			<span class="count storefront-nav-item-count app-general-item-linked" style="cursor: pointer;">{{$photos_count}}</span>
		</li>
		<li class="storefront-nav-tab app-general-item {{ request()->segment(3)=='videos'?'current':'' }}">
            <a class="storefront-nav-item icon-vendor app-general-item-link" href="{{ url('view_storefront/'.request()->segment(2).'/videos') }}">Videos </a>
            <span class="count storefront-nav-item-count app-general-item-linked" style="cursor: pointer;">{{$videos_count}}</span>
        </li>
        <li class="storefront-nav-tab app-general-item">
            <a class="storefront-nav-item icon-vendor app-general-item-link" href="#">Reviews</a>
            <span class="count storefront-nav-item-count app-general-item-linked" style="cursor: pointer;">1</span>
        </li>
        <li class="storefront-nav-tab app-general-item {{ request()->segment(3)=='deals' || request()->segment(3)=='promotions'?'current':'' }}">
            <a class="storefront-nav-item icon-vendor app-general-item-link" href="{{ url('view_storefront/'.request()->segment(2).'/deals') }}">Deals </a>
            <span class="count storefront-nav-item-count app-general-item-linked" style="cursor: pointer;">{{$deals_count}}</span>
        </li>
        <li class="storefront-nav-tab app-general-item {{ request()->segment(3)=='map'?'current':'' }}">
            <a class="storefront-nav-item icon-vendor app-general-item-link" href="{{ url('view_storefront/'.request()->segment(2).'/map') }}">Map</a>
        </li>
    </ul>