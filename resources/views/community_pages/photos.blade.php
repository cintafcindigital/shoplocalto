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
								<h1 class="com-hero-bg-title color-white">Get inspired with {{ $pageData['title'] }} in the community </h1>
								<p class="com-hero-bg-subtitle color-white"> {!! $pageData['description'] !!} </p>
						</div>
						<div class="pure-g discussion-header-title border-bottom">

							<div class="pure-u-1-2" style="margin-bottom: 20px;">
								<h2 class="mt10"> Recently added photos </h2>
							</div>

							@if(count($forumsImages) > 0)
		                        <ul class="pure-g row mb20">
		                            @foreach( $forumsImages as $images )
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
		                            @endforeach
		                        </ul>
		                    @endif
						</div>


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
<link rel="stylesheet" href="{{ url('public/css') }}/jquery.fancybox.min.css" />
<script src="{{ url('public/js') }}/jquery.fancybox.min.js"></script>
@endsection