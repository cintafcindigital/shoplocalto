<div class="mr40">
    <p class="adminAsideTitle">My Tickets</p>
    <nav class="adminAside app-va-folders-side-nav folder_list">
        <a class="adminAside__item {{ Request::is('supports/opened') ? 'active' : '' }}" href="{{url('supports/opened')}}">
            Opened <span class="adminAside__counter">{{ $ticketsCount['opened'] }}</span>
        </a>
        <a class="adminAside__item {{ Request::is('supports/awaiting-replies') ? 'active' : '' }}" href="{{url('supports/awaiting-replies')}}">
            Awaiting replies <span class="adminAside__counter">{{ $ticketsCount['awaiting'] }}</span>
        </a>
        <a class="adminAside__item {{ Request::is('supports/closed') ? 'active' : '' }}" href="{{url('supports/closed')}}">
            Closed <span class="adminAside__counter">{{ $ticketsCount['closed'] }}</span>
        </a>
    </nav>
    <hr class="adminAsideSeparator">
    <p class="adminAsideTitle">Categories</p>
    <nav>
        <a class="app-va-folders-side-status adminAside__item adminBullet--double {{Request::is('supports/customer-service')?'active':''}}" href="{{url('supports/customer-service')}}" data-status="0">
            Customer Service <span class="adminAside__counter app-va-folders--counter">{{ $ticketsCount['customer'] }}</span>
        </a>
        <a class="app-va-folders-side-status adminAside__item adminBullet--double {{Request::is('supports/sales-support')?'active':''}}" href="{{url('supports/sales-support')}}" data-status="1">
            Sales / Billing Support <span class="adminAside__counter app-va-folders--counter">{{ $ticketsCount['sales'] }}</span>
        </a>
        <a class="app-va-folders-side-status adminAside__item adminBullet--double {{Request::is('supports/technical-support')?'active':''}}" href="{{url('supports/technical-support')}}" data-status="2">
            Technical Support <span class="adminAside__counter app-va-folders--counter">{{ $ticketsCount['technical'] }}</span>
        </a>
    </nav>
</div>