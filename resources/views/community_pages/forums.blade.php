@extends('layouts.default')
@section('meta_title',$pageData->meta_title)
@section('meta_keyword',$pageData->meta_keyword)
@section('meta_description',$pageData->meta_description)
@section('content')
@include('includes.menu')

    <div class="community-fourms-wr community-single-wr">
        <div class="container">
			<div class="pure-g">
				<div class="pure-u-3-4">
					<div class="pure-u-s">
						<div class="com-hero-bg" style="background-image:url('{{ url('public/sliders')}}/{{ $pageData["image"]  }}')">
								<h1 class="com-hero-bg-title color-white">Wedding {{ $pageData['title'] }}</h1>
								<p class="com-hero-bg-subtitle color-white"> {!! $pageData['description'] !!} </p>
						</div>
						<div class="pure-g discussion-header-title border-bottom">
							<div class="pure-u-1-2">
								<h2 class="mt10">Latest discussions posted</h2>
							</div>
						</div>

						@if(count($forumsDiscussion) > 0)
		                    <div class="discussion-posts">
		                        <div class="discussion-post-item discussion-top">
		                            @foreach( $forumsDiscussion as $alldiscussion )

		                                <div class="row cm-gp-ds-wr">
		                                    <div class="col-xs-12 col-sm-12 col-md-2">
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
		                                    <div class="col-xs-12 col-sm-12 col-md-10">
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
		                                                    <ul class="avatar-group avatar-group-small mr10">
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
		                                                            <span> {{ date('l', strtotime($alldiscussion['discussion_comment'][0]['comment_users']['created_at']) ) }} &nbsp; at &nbsp; {{ date('H:i', strtotime($alldiscussion['discussion_comment'][0]['comment_users']['created_at']) ) }} </span></span>
		                                                    @endif
		                                                    <i class="icon icon-comment-red icon-left ml10"></i> <b> {{ count($alldiscussion['discussion_comment']) }}</b> &nbsp; <span class="notablet">messages</span>
		                                                    <span class="ml10 color-grey"><i class="icon icon-eye-grey icon-left"></i> {{ count($alldiscussion['discussion_views']) }} </span>
		                                                </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            @endforeach
		                        </div>
		                    </div>
		                @endif
					</div> <!--pure-u-s-->
				</div> <!-- end pure-u-3-4 -->

				<div class="content pure-u-1-4">

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
		                        <img style="max-width: 100%; height: auto;" src="{{ url('public/images') }}/app.jpg" border="0">
		                    </a>
		                </div>
		            </div>

				</div> <!-- content pure-u-1-4 -->
			</div> <!--pure-g-->
        </div> <!--container-->
    </div> <!--community-fourms-wr-->

@include('includes.footer')
@endsection