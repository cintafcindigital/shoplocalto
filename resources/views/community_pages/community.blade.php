@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')
<style>
.error-text{ color: #F11D1D;
    font-size: 14px;
}
</style>
<div class="community-group-wr community-single-wr">
    <div class="container">
        <div class="cm-page-title">
            <div class="common-header service-header text-center"><h2>Join Our Community Groups</h2></div>
        </div>
        @if(count($sliderUser) > 0)
            <div id="comGrupoHeader" class="pure-g homepageslidersection">
                <div class="pure-u-3-10">
                    <ul class="com-hero-slide">
                        <li class="app-slider-position" data-position="0">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[0]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[0]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[0]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[0]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[0]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[0]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[0]['userinfo']['id'] }}/{{ $sliderUser[0]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[0]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="app-slider-position" data-position="1">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[2]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[2]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[2]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[2]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[2]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[2]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[2]['userinfo']['id'] }}/{{ $sliderUser[2]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[2]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="app-slider-position" data-position="3">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[4]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[4]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[4]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[4]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[4]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[4]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[4]['userinfo']['id'] }}/{{ $sliderUser[4]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[4]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="pure-u-4-10">
                    <div class="com-home-hero-header">
                        <img src="https://cdn1.weddingwire.ca/assets/img/community/com-hero-US.png" alt="">
                        <div class="com-home-hero-header-text">
                            <h1>Community</h1>
                            <p>Let's talk! What tips and tricks have you learned so far? What are you still looking so far? What are you still looking for? Ask questions and help other couples on our community boards.</p>
                            <div class="searchbox">
                                <form class="app-community-searchbox" name="frmSearchCom" method="get" action="#">
                                    <div class="search">
                                        <input type="text" name="txtSearch" class="app-community-searchbox-input" id="txtDebatesSearch" data-suffix="default" autocomplete="off" placeholder="Search for">
                                        <button type="button" class="icon icon-search-white"></button>
                                    </div>
                                    <div id="StrDebates" class="app-suggest-debates-div-default droplayer droplayer-scroll text-left desplegable-comSearch-categ" style="width:350px;display:none;">
                                        <div class="column-container">
                                            <ul class="box-scroll jspScrollable" style="max-height: 350px; overflow: hidden; padding: 0px; width: 330px;" tabindex="0">
                                                <div class="jspContainer" style="width: 330px; height: 308px;overflow-y: scroll;">
                                                    <div class="jspPane" style="padding: 0px; width: 310px; top: 0px;">
                                                        @foreach($communitygroup as $num => $group)
                                                        <li class="com-suggest-group-item app-mirror-link app-com-suggest-item app-suggest-item-navigation-{{$num + 1}}">
                                                            <i class="icon-community-group icon-community-group-{{$num + 1}} fleft mr10"></i>
                                                            <div class="overflow">
                                                                <a class="widget-list-name" href="{{ url('community') }}/{{ str_slug($group->group_title, '-') }}">{{$group->group_title}}</a>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- <li class="app-com-suggest-item com-suggest-group-item app-suggest-item-navigation-1">
                                                            <div class="com-suggest-group-content app-link" data-href="/community-discussions-search.php?txtSearch=wedding">
                                                                <a class="com-suggest-group-item-title" href="/community-discussions-search.php?txtSearch=wedding">14,914 discussions about wedding</a>
                                                                <small class="color-grey">View all results</small>
                                                            </div>
                                                        </li>
                                                        <li class="app-com-suggest-item com-suggest-group-item app-suggest-item-navigation-2">
                                                            <span rel="nofollow" class="app-link app-community-profile-layer avatar " data-id-user="695063" data-href="https://www.weddingwire.ca/megan--u695063">
                                                                <figure class="fleft">
                                                                    <img class="avatar-thumb" src="https://cdn0.weddingwire.ca/usr/5/0/6/3/utmp_695063.jpg?r=90115" loading="lazy" alt="Megan" width="">
                                                                </figure>
                                                            </span>
                                                            <div class="com-suggest-group-content app-link" data-href="https://www.weddingwire.ca/forums/wedding-bands--t36219">
                                                                <a class="com-suggest-group-item-title" href="https://www.weddingwire.ca/forums/wedding-bands--t36219">
                                                                    <strong>Wedding</strong> bands
                                                                </a>
                                                                <small class="color-grey">
                                                                    <span class="ico tip-date">yesterday at 17:52</span>
                                                                    <span class="color-grey"> | 12 comments</span>
                                                                </small>
                                                            </div>
                                                        </li> -->
                                                    </div>
                                                    <div class="jspPane newjspPane" style="padding: 0px; width: 310px; top: 0px;"></div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- searchbox -->
                        </div>
                    </div>
                </div>
                <div class="pure-u-3-10">
                    <ul class="com-hero-slide">
                        <li class="app-slider-position" data-position="4">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[1]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[1]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[1]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[1]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[1]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[1]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[1]['userinfo']['id'] }}/{{ $sliderUser[1]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[1]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="app-slider-position" data-position="5">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[3]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[3]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[3]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[3]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[3]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[3]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[3]['userinfo']['id'] }}/{{ $sliderUser[3]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[3]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="app-slider-position" data-position="6">
                            <div class="app-lnkrelHomeSlider-31047" style="position: relative; cursor: pointer; opacity: 1; top: 0px;">
                                <div class="pure-g">
                                    <div class="pure-u-7-10">
                                        <div class="com-hero-slide-content">
                                            <a class="com-hero-slide-title app-lnkHomeSlider" href="{{ url('community/forums') }}/{{ $sliderUser[5]['discussion_slug'] }}">
                                                {{ substr( $sliderUser[5]['discussion_title'], 0, 30)  }}...
                                            </a>
                                            <div class="com-hero-slide-caption pr20">
                                                <p class="com-hero-slide-author">{{ $sliderUser[5]['userinfo']['name'] }}</p>
                                                <span class="count">{{ date('d-F-Y', strtotime( $sliderUser[5]['created_at'] ) ) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pure-u-3-10">
                                        @if($sliderUser[5]['userinfo']['profile_image'] != '')
                                            <img alt="{{ $sliderUser[5]['userinfo']['name'] }}" src="{{  url('storage/USER_') }}{{ $sliderUser[5]['userinfo']['id'] }}/{{ $sliderUser[5]['userinfo']['profile_image'] }}" style="width:100%">
                                        @else
                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                    <text transform="translate(100,130)" y="0">
                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst( $sliderUser[5]['userinfo']['name'][0]) }}</tspan>
                                                    </text>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div><!--community-group-wr-->
@if( count($communitygroup) > 0)
    <div class="app-com-groups-slider com-home-groups text-center grey mb30">
        <div class="wrapper text-center">
            <div class="swiper-container swiper-container-horizontal app-com-swiper-grupos">
                <div class="swiper-wrapper com-home-swiper">
                    @foreach($communitygroup as $group)
                        <figure class="com-group-item app-mirror-link pointer">
                            <div class="swiper-slide photo-zoom swiper-slide-active" onclick="window.location.href='{{ url('community') }}/{{ str_slug($group->group_title, '-') }}'">
                                <a href="{{ url('community') }}/{{ str_slug($group->group_title, '-') }}">
                                    <img class="app-link" alt="{{ $group->group_title }}" src="{{url('public/community_images')}}/{{ $group->thumb_image }}">
                                </a>
                                <figcaption>
                                    <a class="ellipsis com-group-item-nolink" href="{{ url('community') }}/{{ str_slug($group->group_title, '-') }}">{{$group->group_title}}</a>
                                </figcaption>
                            </div>
                        </figure>
                    @endforeach
                </div>
                <div class="icon-com icon-com-slide-next com-home-swiper-nav-right app-home-swiper-nav-next"></div>
                <div class="icon-com icon-com-slide-prev com-home-swiper-nav-left app-home-swiper-nav-prev"></div>
            </div>
        </div>
    </div>
@endif
<div class="wrapper community-responsive-wrcls">
    <div class="pure-g">
        <div class="pure-u-3-4">
            <div class="pure-u-s">
                <div class="discussion-header-title border-bottom">
                    <div class="pure-g">
                        <div class="pure-u-2-3"><h2>Recent discussions</h2></div>
                    </div>
                </div>
                <div class="border-bottom pt10 pb10">
                    <span>Kindness matters - please take a moment to review our Community Guidelines.</span>
                </div>
                @if(count($groupDiscussion) > 0)
                    <div class="discussion-posts">
                        <div class="discussion-post-item discussion-top">
                            @foreach( $groupDiscussion as $alldiscussion )
                                <div class="row cm-gp-ds-wr">
                                    <div class="col-xs-12 col-sm-2 col-md-2">
                                        <a rel="nofollow" class="app-community-profile-layer avatar avatar-top " data-id-user="430427" href="javascript:;">
                                            @if($alldiscussion['userinfo']['profile_image'])
                                                <figure class="mt10">
                                                    <img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $alldiscussion['userinfo']['id'] }}/{{ $alldiscussion['userinfo']['profile_image'] }}" alt="Becky">
                                                    <i class="icon-com icon-com-user-star avatar-ribbon"></i>
                                                </figure>
                                            @else
                                                <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
                                                    <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                        <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                        <text transform="translate(100,130)" y="0">
                                                            <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($alldiscussion['userinfo']['name'][0]) }}</tspan>
                                                        </text>
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-10 col-md-10">
                                        <div class="cm-ds-content-show-wr">
                                            <h3>
                                                <a class="discussion-post-item-title" href="{{ url('community/forums') }}/{{ str_slug($alldiscussion['discussion_title']) }}">{{ $alldiscussion['discussion_title'] }}</a>
                                            </h3>
                                            <div class="discussion-post-item-summary mb5">
                                                <a rel="nofollow" href="javascript:;">{{ $alldiscussion['userinfo']['name'] }}</a>, On {{ date('d/F/Y', strtotime($alldiscussion['created_at']) ) }} at {{ $time = date('H:i', strtotime($alldiscussion['created_at'])) }}
                                            </div>
                                            <div class="discussion-post-item-content">
                                                <p>{{ strip_tags(mb_strimwidth($alldiscussion['discussions_text'], 0, 200, '...')) }}</p>
                                            </div>
                                            <div class="discussion-post-item-meta">
                                                @if(count( $alldiscussion['discussion_comment']) > 0)
                                                    <ul class="avatar-group avatar-group-small mr10 clearfix">
                                                        @php $profileCount = 1; $showunique = array(); @endphp
                                                        @foreach($alldiscussion['discussion_comment'] as $commentsData)
                                                            @if($commentsData['comment_users']['profile_image'] != '')
                                                                @if($profileCount > 5)
                                                                    @php break; @endphp
                                                                @endif
                                                                @if(!in_array($commentsData['comment_users']['profile_image'], $showunique))
                                                                    <li class="avatar-group-item">
                                                                        <div class="avatar">
                                                                            <figure>
                                                                                <img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $commentsData['comment_users']['id'] }}/{{ $commentsData['comment_users']['profile_image'] }}" alt="">
                                                                            </figure>
                                                                        </div>
                                                                    </li>
                                                                    @php
                                                                        array_push($showunique, $commentsData['comment_users']['profile_image'])
                                                                    @endphp
                                                                @endif
                                                                @php $profileCount++; @endphp
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @if(count($alldiscussion['discussion_comment']) > 0)
                                                    <span class="color-grey">
                                                        {{ $alldiscussion['discussion_comment'][0]['comment_users']['name'] }}, &nbsp;
                                                        <span> {{ date('l', strtotime($alldiscussion['discussion_comment'][0]['comment_users']['created_at']) ) }} &nbsp; at &nbsp; {{ date('H:i', strtotime($alldiscussion['discussion_comment'][0]['comment_users']['created_at']) ) }} </span>
                                                    </span>
                                                @endif
                                                <i class="icon icon-comment-red icon-left ml10"></i>
                                                <b>{{ count($alldiscussion['discussion_comment']) }}</b> &nbsp; <span class="notablet">messages</span>
                                                <span class="ml10 color-grey">
                                                    <i class="icon icon-eye-grey icon-left"></i> {{ count($alldiscussion['discussion_views']) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="text-right" style="margin-top: 20px">
                    <a class="btn-outline outline-red" href="{{ url('/') }}/forums">View discussions</a>
                </div>
                <div class="app-community-box-groups">
                    <div class="discussion-header-title">
                        <h2>Recently added photos</h2>
                    </div>
                    @if(count($communityImages) > 0)
                        <ul class="pure-g row mb20">
                            @php $count = 0; @endphp
                            @foreach( $communityImages as $images )
                                @if($count == 7 )
                                    @php break; @endphp
                                @endif
                                <li class="pure-u-1-4 discussion-grid">
                                    <div class="discussion-grid-picture unit">
                                        <figure>
                                            <a class="photo-zoom app-com-media-item-layer" data-fancybox="gallery" href="{{ url('/public/discussion_group_images') }}/{{ $images['community_image'] }}" >
                                                <img alt="{{$images['community_image']}}" src="{{url('public/imagecrop/timthumb.php') }}?src={{ url('/public/discussion_group_images') }}/{{ $images['community_image'] }}&h=200&w=200&zc=1" style="width:100%;">
                                            </a>
                                            <figcaption class="discussion-picture-meta" style="height: auto;">
                                                <div class="pure-g">
                                                    <div class="pure-u-1">
                                                        <a class="discussion-picture-title app-com-media-item-layer" href="javascript:;">
                                                            By {{ $images['user']['name'] }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                                @php $count++; @endphp
                            @endforeach
                            <li class="pure-u-1-4 discussion-grid discussion-grid-more">
                                <div class="discussion-grid-overlay discussion-grid-picture unit discussion-grid-more-photo">
                                    <figure>
                                        <a rel="nofollow" class="photo-zoom app-com-media-item-layer" href="{{ url('/') }}/photos">
                                            <img alt="{{$communityImages[7]['community_image']}}" src="{{url('public/imagecrop/timthumb.php') }}?src={{ url('/public/discussion_group_images') }}/{{ $communityImages[7]['community_image'] }}&h=200&w=200&zc=1" style="width:100%;">
                                        </a>
                                    </figure>
                                    <div class="discussion-grid-more-info">
                                        <a rel="nofollow" class="" href="{{ url('/') }}/photos">
                                            <i class="icon-com icon-com-more-photo-white discussion-grid-overlay-element"></i>
                                        </a>
                                        <a rel="nofollow" class="discussion-grid-more-info-btn btn-outline outline-white discussion-grid-overlay-element" href="{{ url('/') }}/photos">View more photos</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endif
                    <div class="discussion-header-title">
                        <h2>Recently added videos</h2>
                    </div>
                    @if(count($communityVideos) > 0)
                        <ul class="pure-g row mb20">
                            @php $vcount = 0; @endphp
                            @foreach($communityVideos as $videos)
                                @if($vcount == 7 )
                                    @php break; @endphp
                                @endif
                                <li class="pure-u-1-4 discussion-grid">
                                    <div class="discussion-grid-video unit">
                                        <figure>
                                            <a class="photo-zoom app-com-media-item-layer" data-fancybox="gallery" href="{{ $videos['community_video'] }}">
                                                <img src="{{ url('public/community_images') }}/videologo.jpg" alt="" style="width:100%;">
                                            </a>
                                        </figure>
                                        <figcaption class="discussion-picture-meta" style="height: auto;">
                                            <div class="pure-g">
                                                <div class="pure-u-1">
                                                    <a class="discussion-picture-title app-com-media-item-layer" href="javascript:;">
                                                        By {{ $videos['user']['name'] }}
                                                    </a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </div>
                                </li>
                                @php $vcount++; @endphp
                            @endforeach
                            <li class="pure-u-1-4 discussion-grid discussion-grid-more">
                                <div class="discussion-grid-overlay discussion-grid-picture unit discussion-grid-more-video">
                                    <figure>
                                        <a rel="nofollow" class="photo-zoom app-com-media-item-layer" href="{{ url('/') }}/videos">
                                            <img src="{{ url('public/community_images') }}/videologo.jpg" alt="" style="width:100%;">
                                        </a>
                                    </figure>
                                    <div class="discussion-grid-more-info">
                                        <a rel="nofollow" class="" href="{{ url('/') }}/videos">
                                            <i class="icon-com icon-com-more-video-white discussion-grid-overlay-element"></i>
                                        </a>
                                        <a rel="nofollow" class="discussion-grid-more-info-btn btn-outline outline-white discussion-grid-overlay-element" href="{{ url('/') }}/videos">See more videos</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endif
                    <div class="discussion-header-title">
                        <h2>Active users</h2>
                    </div>
                    @if(count($activeUsers) > 0)
                        <ul class="pure-g row users-active">
                            @foreach($activeUsers as $user)
                                @if(count($user['all_comments']) > 0)
                                    <li class="pure-u-1-5">
                                        <div class="com-user-active box app-mirror-link">
                                            @if($user['profile_image'] != '')
                                                <a class="app-community-profile-layer avatar" href="javascript:;">
                                                    <figure class="center">
                                                        <img class="avatar-thumb" src="{{url('public/imagecrop/timthumb.php') }}?src={{  url('storage/USER_') }}{{ $user['id'] }}/{{ $user['profile_image'] }}&h=150&w=150&zc=1" alt="{{ $user['user'] }}">
                                                    </figure>
                                                </a>
                                            @else
                                                <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar" style="height: 57px;width: auto;margin: 28px auto;">
                                                    <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                        <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                        <text transform="translate(100,130)" y="0">
                                                            <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($user['name'][0]) }}</tspan>
                                                        </text>
                                                    </svg>
                                                </div>
                                            @endif
                                            <a class="com-user-active-name" rel="nofollow" href="javascript:;">{{ $user['name'] }}</a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div><!-- app-community-box-groups -->
            </div>
        </div>
        <div class="pure-u-1-4">
            <div class="pure-u-1 content-banner overflow">
                <div style="min-height:190px;" class="app-DFP">
                    <a  href="{{ url('/') }}">
                        <img style="max-width: 100%; height: auto;" src="{{ url('public/images') }}/add_image.jpg" border="0">
                    </a>
                </div>
            </div>
            <p class="widget-community-header"> Groups </p>
            @if(count( $communitygroup ) > 0)
                <div class="widget-cm-home-list">
                    <ul class="widget-list pb0 mb10">
                        @foreach($communitygroup as $group)
                            <li class="pointer app-mirror-link">
                                <i class="icon-community-group icon-community-group-{{ $group['id'] }} fleft mr10"></i>
                                <div class="overflow">
                                    <a class="widget-list-name mt5" href="{{ url('community') }}/{{ $group['slug'] }}">{{ $group['group_title'] }}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content-banner overflow mt5 mb20">
                <div style="min-height:190px;" class="app-DFP">
                    <a href="javascript:;">
                        <img style="max-width:100%;height:auto;" src="{{ url('public/images') }}/app.jpg" border="0">
                    </a>
                </div>
            </div>
        </div>
    </div><!-- pure-g-->
</div><!-- warpper -->
@include('includes.footer')
<script src="{{ url('/public/js') }}/jquery.bxslider.js"></script>
<link rel="stylesheet" href="{{ url('public/css') }}/jquery.fancybox.min.css" />
<script src="{{ url('public/js') }}/jquery.fancybox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.swiper-wrapper').bxSlider({
        minSlides: 1,
        maxSlides: 6,
        slideWidth: 180,
        slideMargin: 20,
        pager: false,
        touchEnabled: false,
    });
});
$('.app-home-swiper-nav-next').on('click', function() {
    $('.bx-next').trigger('click');
});
$('.app-home-swiper-nav-prev').on('click', function() {
    $('.bx-prev').trigger('click');
});
$('#txtDebatesSearch').on('click', function() {
    var vals = $(this).val();
    if(vals.length <= 2) {
        $('.desplegable-comSearch-categ').show();
        $('.jspPane').show();
        $(".newjspPane").html('');
    } else {
        $('.desplegable-comSearch-categ').show();
        $('.jspPane').hide();
        $.ajax({
            url: "{{url('community/search')}}/"+vals,
            type: "GET",
            success: function(response) {
                // console.log(response);
                $(".newjspPane").show();
                $(".newjspPane").html(response);
            }
        });
    }
});
$('body').on('click', function(e){  
    if($(e.target).attr('class') != 'app-community-searchbox-input') {
        $('.desplegable-comSearch-categ').hide();
    }
});
$('#txtDebatesSearch').keyup(function() {
    var vals = $(this).val();
    $('.desplegable-comSearch-categ').show();
    if(vals != '' && vals.length > 2) {
        $('.jspPane').hide();
        $.ajax({
            url: "{{url('community/search')}}/"+vals,
            type: "GET",
            success: function(response) {
                // console.log(response);
                $(".newjspPane").show();
                $(".newjspPane").html(response);
            }
        });
    } else {
        $('.jspPane').show();
        $('.newjspPane').hide();
        $(".newjspPane").html('');
    }
});
$('body').on('click','.app-link', function() {
    var curUrl = $(this).attr('data-href');
    window.location.href = curUrl;
});
</script>
@endsection