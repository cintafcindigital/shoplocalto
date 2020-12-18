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
            <div class="pure-u-1-5"> @include('includes.supportsidebar') </div>
            <div class="pure-u-4-5">
                @include('includes.supportinnerboard')
                @if(isset($_GET['sn']) || isset($_GET['dfrom']) || isset($_GET['dend']))
                    <div class="adminFiltersQuery">
                        <span class="adminFiltersQuery__title">Results:</span>
                        <span>
                            @if( isset($_GET['sn']) && $_GET['sn'] !='' ) {{ $_GET['sn'] }} , @endif
                            @if( isset($_GET['dfrom']) && $_GET['dfrom'] != '' && isset($_GET['dend']) && $_GET['dend'] != '' )
                                (From {{ $_GET['dfrom'] }}, Until {{ $_GET['dend'] }})
                            @elseif( isset($_GET['dfrom']) && $_GET['dfrom'] != '' )
                                ( From  {{ $_GET['dfrom'] }} )
                            @elseif( isset($_GET['dend']) &&  $_GET['dend'] != '')
                                ( Until {{ $_GET['dend'] }} )
                            @endif
                        </span>
                        <a class="adminFiltersQuery__link" href="{{ url('supports/opened') }}">Delete</a>
                    </div>
                @endif
                @if(count($data['openTickets']) > 0)
                    <div class="messagecontent-wr">
                        <ul class="adminHomeSol">
                            @foreach($data['openTickets'] as $tckt)
                            <li class="app-vendor-message-{{$tckt->id}} adminHomeSol__item pure-g @if($tckt->is_read == '0') adminHomeSol__item--new @endif">
                                <div class="pure-u-7-10">
                                    <div class="pure-g">
                                        <div class="adminHomeSol__checkAvatar pure-u-2-12">
                                            <div class="adminHomeSol__avatar app-link">
                                                <a href="{{url('supports-details').'/'.$tckt->id}}">
                                                    @if(@$data['vendorData'][0]['image_data'][0]['image'])
                                                    <figure>
                                                        <img class="avatar-thumb" src="{{url('public/vendors/VENDOR_'.$data['vendorData'][0]['vendor_id'].'/'.$data['vendorData'][0]['image_data'][0]['image'])}}" alt="Profile" width="60" height="60">
                                                    </figure>
                                                    @else
                                                    <div class="avatar-alias size-avatar-medium ">
                                                        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                            <circle fill="#C097A0" cx="100" cy="100" r="100"></circle>
                                                            <text transform="translate(100,130)" y="0">
                                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ucfirst(substr($tckt->name, 0, 1))}}</tspan>
                                                            </text>
                                                        </svg>
                                                    </div>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pure-u-10-12">
                                            <a class="adminHomeSol__name" href="{{url('supports-details').'/'.$tckt->id}}">{{ $tckt->title }}</a>
                                            <div>
                                                @if($tckt->status == 0)
                                                    <span class="adminHomeSol__status adminHomeSol__status--pending">Open</span>
                                                @elseif($tckt->status == 1)
                                                    <span class="adminHomeSol__status adminHomeSol__status--info">{{$tckt->awaiting_vendor}}</span>
                                                @elseif($tckt->status == 2)
                                                    <span class="adminHomeSol__status adminHomeSol__status--success">Closed</span>
                                                @endif
                                                <time class="adminHomeSol__date">{{date('d/M/Y', strtotime($tckt->created_at))}} at {{date('H:i', strtotime($tckt->created_at))}}</time>
                                            </div>
                                            <p class="adminHomeSol__description">
                                                {{ str_limit(strip_tags($tckt->comments), $limit = 150, $end = '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pure-u-3-10">
                                    <div clas="pure-g">
                                        <div class="adminHomeSol__info cmn_date_wrp pure-u-1-2">
                                            <p>( {{count($tckt->tickets_replies)}} )</p>
                                            <span class="adminHomeSol__icon adminHomeSol__icon--envelope"></span>
                                            <time class="adminHomeSol__info-number">{{date('d',strtotime($tckt->created_at))}}{{date('M',strtotime($tckt->created_at))}} <span class="adminHomeSol__info-extra">{{date('Y',strtotime($tckt->created_at)) }}</span></time>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div> <!-- End "messagecontent-wr-->
                    <div class="mb20">
                        {!! $data['openTickets']->appends(Input::except('page'))->render() !!}
                    </div>
                @else
                    <div class="adminEmpty">
                        <i class="adminEmpty__icon adminEmpty__icon--solic"></i>
                        <p class="adminEmpty__description">No tickets have been found in this folder</p>
                    </div>
                @endif
            </div> <!-- End pure-u-4-5-->
        </div>
    </div> <!-- End wrapper-->
</section>
@include('vendor.ExportLeads.exportleads_popup')
@include('includes.footer')
@endsection