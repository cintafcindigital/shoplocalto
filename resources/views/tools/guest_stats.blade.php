@extends('layouts.default')
@section('meta_title',$data['titleData']->meta_title)
@section('meta_keyword',$data['titleData']->meta_keyword)
@section('meta_description',$data['titleData']->meta_description)
@section('content')
@include('includes.menu')
<?php
    $idEvent = @Request::get('idEvent');
    $guestsTitle = 'Overview';
    if($idEvent) {
        $guestsTitle = $data['current_event']->event_name;
    }
?>
<section class="section-padding-ex dashboard-wrap-ex">
    @include('tools.tools_nav')
    <div class="wrapper guest-desgin">
        <div class="mb20 text-center">
            <div class="text-center" data-where="">
                <div class="inline-block tools-toggle">
                    <span class="tools-toggle-item @if(!$idEvent) active @endif app-event-change" data-href="{{url('/tools/guests')}}">Overview</span>
                    @foreach($data['guests_event'] as $ge)
                        <span class="tools-toggle-item @if($idEvent == $ge->id) active @endif app-event-change" data-href="{{url('/tools/guests/stats')}}?idEvent={{$ge->id}}">{{$ge->event_name}}</span>
                    @endforeach
                    <a class="tools-toggle-item small " href="{{url('/tools/guests/eventForm')}}"><i class="icon-tools icon-tools-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-2">
                <span class="tools-header-title pointer app-link inline-block" data-href="{{url('/tools/guests')}}?idEvent={{$idEvent}}">
                    <i class="icon-header icon-header-arrow-left mr10"></i> Guest List
                </span>
                <h1 class="mt20">{{$guestsTitle}}</h1>
            </div>
        </div>
        <hr class="mb25">
        <div class="pure-g">
            <div class="statpg-wed pure-u-2-3 guests-statsRight">
                <h3 class="guests-stats-title guests-stats-title--small text-left">Guests</h3>
                <div class="guests-statsRight-section">
                    <div class="mt10">
                        <?php
                            $menCount = 0;
                            $femaleCount = 0;
                            $childrenCount = 0;
                            $babiesCount = 0;
                            $notSpecifiedCount = 0;
                            $totalCount = 0;
                            foreach($data['guestListData'] as $gtl) {
                                if($gtl->age_type == 'Adult') {
                                    if($gtl->gender == 'Male') {
                                        $menCount++;
                                    } elseif($gtl->gender == 'Female') {
                                        $femaleCount++;
                                    }
                                } elseif($gtl->age_type == 'Child') {
                                    $childrenCount++;
                                } elseif($gtl->age_type == 'Baby') {
                                    $babiesCount++;
                                } else {
                                    $notSpecifiedCount++;
                                }
                                $totalCount++;
                            }
                            $menPer = $femalePer = $childrenPer = $babiesPer = $notSpecifiedPer = 0;
                            if($totalCount > 0) {
                                $menPer = round((100 / $totalCount)* $menCount);
                                $femalePer = round((100 / $totalCount)* $femaleCount);
                                $childrenPer = round((100 / $totalCount)* $childrenCount);
                                $babiesPer = round((100 / $totalCount)* $babiesCount);
                                $notSpecifiedPer = round((100 / $totalCount)* $notSpecifiedCount);
                            }
                        ?>
                        <div class="pure-g guests-stats-horizontal-progress">
                            <div class="pure-u-1-4"><strong>{{$menCount}}</strong> Men </div>
                            <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                <span class="percent-legend">{{$menPer}}%</span>
                                <span class="percent" style="width:{{$menPer}}%;background:#70c9a9;"></span>
                            </div>
                        </div>
                        <div class="pure-g guests-stats-horizontal-progress">
                            <div class="pure-u-1-4"><strong>{{$femaleCount}}</strong> Female </div>
                            <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                <span class="percent-legend">{{$femalePer}}%</span>
                                <span class="percent" style="width:{{$femalePer}}%;background:#0fadc3;"></span>
                            </div>
                        </div>
                        <div class="pure-g guests-stats-horizontal-progress">
                            <div class="pure-u-1-4"><strong>{{$childrenCount}}</strong> Children </div>
                            <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                <span class="percent-legend">{{$childrenPer}}%</span>
                                <span class="percent" style="width:{{$childrenPer}}%;background:#e2b960;"></span>
                            </div>
                        </div>
                        <div class="pure-g guests-stats-horizontal-progress">
                            <div class="pure-u-1-4"><strong>{{$babiesCount}}</strong> Babies </div>
                            <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                <span class="percent-legend">{{$babiesPer}}%</span>
                                <span class="percent" style="width:{{$babiesPer}}%;background:#8c3d52;"></span>
                            </div>
                        </div>
                        <div class="pure-g guests-stats-horizontal-progress">
                            <div class="pure-u-1-4"><strong>{{$notSpecifiedCount}}</strong> Not specified </div>
                            <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                <span class="percent-legend">{{$notSpecifiedPer}}%</span>
                                <span class="percent" style="width:{{$notSpecifiedPer}}%;background:#ea8a96;"></span>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('tools/guests').'?idEvent='.$idEvent.'&tab=4&viewGrid=1'}}" class="btn-outline outline-red inline-block mt20">Manage guests</a>
                </div>
                <div class="guests-statsRight-section">
                    <div class="pure-g">
                        <div class="pure-u-1-2">
                            <h3 class="guests-stats-title">Invitations</h3>
                            <div class="pure-g">
                                <div class="pure-u-1-2 guests-stats-ostatics-box">
                                    <p class="guests-stats-ostatics-box-number">
                                        <i class="icon-tools icon-tools-checkbox icon-left"></i> 0
                                    </p>
                                    <p class="guests-stats-ostatics-box-text">Invitations sent</p>
                                </div>
                                <div class="pure-u-1-2 guests-stats-ostatics-box">
                                    <p class="guests-stats-ostatics-box-number">
                                        <i class="icon-tools icon-tools-clock-orange icon-left"></i> 6
                                    </p>
                                    <p class="guests-stats-ostatics-box-text">Not sent</p>
                                </div>
                            </div>
                            <a href="{{url('tools/guests/onlineInvitation').'?idEvent='.$idEvent}}" class="btn-outline outline-red inline-block mt15">Send invitations</a>
                        </div>
                        <div class="pure-u-1-2">
                            <h3 class="guests-stats-title">Seating Chart</h3>
                            <div class="pure-g">
                                <div class="pure-u-1-2 guests-stats-ostatics-box">
                                    <p class="guests-stats-ostatics-box-number">
                                        <i class="icon-tools-navigation icon-tools-navigation-tables icon-left"></i> {{$data['seatingTable']}}
                                    </p>
                                    <p class="guests-stats-ostatics-box-text">Tables added</p>
                                </div>
                                <div class="pure-u-1-2 guests-stats-ostatics-box">
                                    <p class="guests-stats-ostatics-box-number">
                                        <i class="icon-tools-navigation icon-tools-navigation-guests icon-left"></i> {{$data['seatingGuest']}}
                                    </p>
                                    <p class="guests-stats-ostatics-box-text">Seated guests</p>
                                </div>
                            </div>
                            <a href="{{url('tools/seating_chart').'?idEvent='.$idEvent}}" class="btn-outline outline-red inline-block mt15">Create Seating Chart</a>
                        </div>
                    </div>
                </div>
                <div class="guests-statsRight-section">
                    <h3 class="guests-stats-title">Groups</h3>
                    <div class="mt30">
                        @php $totGuestCount = 0; @endphp
                        @if(isset($data['guestsCat']))
                          @foreach($data['guestsCat'] as $totGcat)
                            @php $totGuestCount += $totGcat->groupCount; @endphp
                          @endforeach
                          @foreach($data['guestsCat'] as $num => $gcat)
                            <div class="pure-g guests-stats-horizontal-progress">
                                <div class="pure-u-1-4 text-left">
                                    <strong>{{$gcat->title}}</strong>
                                    <p><span class="color-grey"> {{$gcat->groupCount}} guests </span></p>
                                </div>
                                @php $guestCount = 0; if($totGuestCount > 0) { $guestCount = ((100 / $totGuestCount)* $gcat->groupCount); }
                                    $guestColor = '#70c9a9'; if($num == 1){ $guestColor = '#0fadc3'; }elseif($num == 2){ $guestColor = '#e2b960'; }elseif($num == 3){ $guestColor = '#8c3d52'; }elseif($num == 4){ $guestColor = '#ea8a96'; }elseif($num == 5){ $guestColor = '#ec505c'; }elseif($num == 6){ $guestColor = '#93ccc7'; }elseif($num == 7){ $guestColor = '#feb7a6'; }elseif($num == 8){ $guestColor = '#c91545'; }elseif($num == 9){ $guestColor = '#158ac9'; }elseif($num == 10){ $guestColor = '#9e15c9'; }elseif($num == 11){ $guestColor = '#98db16'; }elseif($num == 12){ $guestColor = '#099b62'; }elseif($num == 13){ $guestColor = '#9b7009'; }elseif($num == 14){ $guestColor = '#69008a'; }elseif($num > 14){ $guestColor = '#699b09'; }
                                @endphp
                                <div class="pure-u-3-4 guests-stats-horizontal-progress-bar mt5">
                                    <span class="percent" style="width:{{$guestCount}}%;background-color:{{$guestColor}};"></span>
                                </div>
                            </div>
                          @endforeach
                        @endif
                    </div>
                    <a href="{{url('tools/guests').'?idEvent='.$idEvent.'&tab=1&viewGrid=1'}}" class="btn-outline outline-red inline-block mt20">Manage groups</a>
                </div>
                @if($data['current_event']->menu_types)
                <div class="guests-statsRight-section">
                    <div class="mt40">
                        <h3 class="guests-stats-title">Menu</h3>
                        <div class="pure-g mt30">
                            @foreach($data['menu_types'] as $ky => $vls)
                                <div class="pure-u-1-4 guests-stats-ostatics-box">
                                    <p class="guests-stats-ostatics-box-number"><i class="icon-tools icon-tools-mark-menu icon-left"></i>{{$vls}}</p>
                                    <p class="guests-stats-ostatics-box-text subtitle">{{$ky}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{url('tools/guests').'?idEvent='.$idEvent.'&tab=2&viewGrid=1'}}" class="btn-outline outline-red inline-block mt20">Manage menus</a>
                </div>
                @endif
            </div>
            <div class="statpg-wed-left pure-u-1-3">
                <div class="guests-statsLeft">
                    <h3 class="guests-stats-title mt20">Attendance</h3>
                    <p>Who's coming to our wedding?</p>
                    <?php $confrm = $pendng = $cancld = $totals = 0;
                        foreach($data['guests_event'] as $num => $vals) {
                            foreach ($vals->guestsInvitationCount as $nm => $vls) {
                                if($vls->invited_for == $idEvent) {
                                    if($vls->attendances == 'confirmed') {
                                        $confrm++;
                                    } elseif($vls->attendances == 'pending') {
                                        $pendng++;
                                    } elseif($vls->attendances == 'cancelled') {
                                        $cancld++;
                                    }
                                    $totals++;
                                }
                            }
                        }
                        $confrmPer = $pendngPer = $cancldPer = 0;
                        if($totals > 0) {
                            $confrmPer = round((100 / $totals)* $confrm);
                            $pendngPer = round((100 / $totals)* $pendng);
                            $cancldPer = round((100 / $totals)* $cancld);
                        }
                        $conStroke = ((741.4158 * $confrmPer)/ 100);
                        $conStroke = (741.4158 - $conStroke);
                        $penStroke = ((867.0795 * $pendngPer)/ 100);
                        $penStroke = (867.0795 - $penStroke);
                        $canStroke = ((992.7432 * $cancldPer)/ 100);
                        $canStroke = (992.7432 - $canStroke);
                    ?>
                    <div class="guests-statsLeft-box">
                        <svg class="guests-stats-progress guests-stats-progress-one app-circle-stats" data-pct="{{$confrmPer}}" preserveAspectRatio="xMidYMin slice" viewBox="0 0 400 400">
                            <circle class="guests-stats-progress-meter" cx="50%" cy="50%" r="118" stroke-width="10"></circle>
                            <circle class="app-progress-value guests-stats-progress-value" style="stroke:rgb(58, 156, 136);stroke-dashoffset:{{$conStroke}}px;" cx="50%" cy="50%" r="118" stroke-width="10"></circle>
                        </svg>
                        <svg class="guests-stats-progress guests-stats-progress-two app-circle-stats" data-pct="{{$pendngPer}}" preserveAspectRatio="xMidYMin slice" viewBox="0 0 400 400">
                            <circle class="guests-stats-progress-meter" cx="50%" cy="50%" r="138" stroke-width="10"></circle>
                            <circle class="app-progress-value guests-stats-progress-value" style="stroke:rgb(225, 170, 84);stroke-dashoffset:{{$penStroke}}px;" cx="50%" cy="50%" r="138" stroke-width="10"></circle>
                        </svg>
                        <svg class="guests-stats-progress guests-stats-progress-three app-circle-stats" data-pct="{{$cancldPer}}" preserveAspectRatio="xMidYMin slice" viewBox="0 0 400 400">
                            <circle class="guests-stats-progress-meter" cx="50%" cy="50%" r="158" stroke-width="10"></circle>
                            <circle class="app-progress-value guests-stats-progress-value" style="stroke:rgb(215, 216, 220);stroke-dashoffset:{{$canStroke}}px;" cx="50%" cy="50%" r="158" stroke-width="10"></circle>
                        </svg>
                        <div class="guests-stats-progress-center">
                            <span class="strong">Total</span>
                            <p class="guests-stats-progress-center-number">{{$totals}}</p>
                            <p class="mt10">Guests</p>
                        </div>
                    </div>
                    <div class="guests-statsLeft-box-legend">
                        <div class="pure-u-1-4 mb15">
                            <span class="guests-statsLeft-mark turquoise"><span class="guests-stats-percent">{{$confrmPer}}%</span></span>
                            <p class="guests-stats-number">{{$confrm}}</p>
                            <p> Confirmed </p>
                        </div>
                        <div class="pure-u-1-4 mb15">
                            <span class="guests-statsLeft-mark orange"><span class="guests-stats-percent">{{$pendngPer}}%</span></span>
                            <p class="guests-stats-number">{{$pendng}}</p>
                            <p> Pending </p>
                        </div>
                        <div class="pure-u-1-4 mb15">
                            <span class="guests-statsLeft-mark grey"><span class="guests-stats-percent">{{$cancldPer}}%</span></span>
                            <p class="guests-stats-number">{{$cancld}}</p>
                            <p> Cancelled </p>
                        </div>
                    </div>
                    <a href="{{url('tools/guests/requestRSVP').'?idEvent='.$idEvent}}" class="btn-outline outline-red inline-block mt10">Request RSVP</a>
                </div>
            </div>
        </div><!-- end here -->
    </div>
</section>
@include('includes.footer')
<script>
$(document).ready(function(){
    $('body').on('click','.app-event-change', function(){
        var curUrl = $(this).attr('data-href');
        window.location.href = curUrl;
    });
    $('body').on('click','.app-link', function(){
        var curUrl = $(this).attr('data-href');
        window.location.href = curUrl;
    });
});
</script>
@endsection