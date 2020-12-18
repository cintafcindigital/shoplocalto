<html prefix="og: http://ogp.me/ns#" lang="en-CA"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{{config('app.name','My Health Squad')}}</title>
<meta name="robots" content="all">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="pbdate" content="4:56:36 10/09/2019">


<link rel="stylesheet" href="{{ url('public/css') }}/base.css">
<link rel="stylesheet" href="{{ url('public/css') }}/vendor.css">

</head>

<body cz-shortcut-listen="true">
    
<div class="pt20 pb20 pr20 pl20 border-bottom">
    <div class="pure-g-r">
        <div class="pure-u-1-4">
            <div class="logo">
                <img class="mt10" src="{{ url('public/images') }}/logo.png" alt="Logo">
            </div>
        </div>
        <div class="pure-u-3-4">
            <a class="pure-u fright btn-flat red" href="javascript:void(0);" onclick="window.print();">Print</a>
        </div>
    </div>
</div>


<div class="pt10 pb10 pl20 pr20 border-bottom pure-g-r">
    <div class="pure-u-1">
        <h1 class="pure-u strong">Lead</h1>
        <strong class="pure-u fright mt15">
            @if($data['message_details']->reply_status == 0)
                <i class="adminBullet adminBullet--orange"></i>Pending
            @elseif($data['message_details']->reply_status == 1)
                <i class="mr5 adminBullet adminBullet--blue"></i>Replied
            @elseif($data['message_details']->reply_status == 2)
                <i class="adminBullet adminBullet--red"></i>Discarded
            @elseif($data['message_details']->reply_status == 3)
                 <i class="mr5 adminBullet adminBullet--green"></i>Booked
            @endif
        </strong>
    </div>
</div>

<div class="p20">
    <div class="pure-g-r mt15">
        <ul class="pure-u-1 box">
            <li class="p10 border-bottom">
                <strong>From:</strong> <span>{{ $data['message_details']->name }}</span>
                <span class="fright">Received on {{ date('d/M/Y', strtotime($data['message_details']->created_at)) }} at {{ date('H:i', strtotime($data['message_details']->created_at)) }}</span>
            </li>

            <li class="p10 border-bottom">
                <strong>Telephone</strong>
                {{ $data['message_details']->name }}
            </li>
                            
            <li class="p10 border-bottom">
                <strong>Email:</strong>
                {{ $data['message_details']->email }}
            </li>
                            
            <li class="p10 border-bottom">
                <strong>Date&nbsp;Send:</strong>
                {{ date('d/m/Y', strtotime($data['message_details']->created_at)) }}
            </li>
            
            <li class="p10 border-bottom">
                <strong>Searching:</strong>
                {{ $data['vendorData'][0]['category_data']['title'] }} in {{ $data['vendorData'][0]['company_data']['province'] }}
            </li>
            
            <li class="p10 border-bottom">
                <p>{!! $data['message_details']->comment !!}</p>
            </li>
        </ul>
    </div>

    @if(count($data['reply']) > 0)
        <div class="pure-g-r mt10">
            <h3 class="mb15 pure-u">Messages</h3>
            
            <ul class="pure-u-1 box">
                
                @foreach( $data['reply'] as $smsreply )

                    @if($smsreply['reply_by'] == $smsreply['user_id'] && $smsreply['message_type'] == 'replies')

                        <li class="p10 border-bottom-dotted">
                            <strong><i class="fa fa-mail-reply color-green mr5"></i>{{ ucfirst($smsreply['user']['name']) }}</strong> has sent:
                            <span class="fright">on {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }}</span>
                        </li>

                        <li class="p10 border-bottom">
                            {!! $smsreply['message'] !!}
                        </li>

                    @elseif($smsreply['reply_by'] == $data['vendorData'][0]['vendor_id'] && $smsreply['message_type'] == 'replies')

                        <li class="p10 border-bottom-dotted">
                            <strong><i class="fa fa-mail-forward color-blue mr5"></i>{{ $data['vendorData'][0]['category_data']['title'] }}</strong> sent to user:
                            <span class="fright">
                             @if($smsreply['is_read'])
                                Read by client
                            @else
                                Delivered to client
                            @endif
                            on {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }}</span>
                        </li>

                        <li class="p10 border-bottom">
                            {!! $smsreply['message'] !!}
                        </li>

                    @elseif($smsreply['reply_by'] == $data['vendorData'][0]['vendor_id'] && $smsreply['message_type'] == 'notes')
                    
                        <li class="p10 border-bottom-dotted">
                            <strong><i class="fa fa-file-text-o color-orange mr5"></i>{{ $data['vendorData'][0]['category_data']['title'] }}</strong> note:
                            <span class="fright">on {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }}</span>
                        </li>

                        <li class="p10 border-bottom">{!! $smsreply['message'] !!}</li>

                    @elseif($smsreply['reply_by'] == $smsreply['user_id'] && $smsreply['message_type'] == 'notes')

                        <li class="p10 border-bottom-dotted">
                            <strong><i class="fa fa-file-text-o color-orange mr5"></i>{{ ucfirst($smsreply['user']['name']) }}</strong> note:
                            <span class="fright">on {{ date('d/M/Y', strtotime($smsreply['created_at'])) }} at {{ date('H:i', strtotime($smsreply['created_at'])) }}</span>
                        </li>

                        <li class="p10 border-bottom">{!! $smsreply['message'] !!}</li>

                    @endif

                @endforeach

            </ul>
        </div>
    @endif
</div>
</body>
</html>