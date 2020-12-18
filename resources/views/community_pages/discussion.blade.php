@extends('layouts.default')
@section('content')
@include('includes.menu')
@php
function getId($url) {
    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
    $matchYoutube = preg_match_all($regExp, $url);

    $vimeoRegex = '/(?:vimeo)\.com.*(?:videos|video|channels|)\/([\d]+)/i';
    $matchVimeo = preg_match_all($vimeoRegex, $url);
   
    if ($matchYoutube) {
    	$urlArray = explode('=', $url);
    	$videoURL = '//www.youtube.com/embed/'.$urlArray[1];
    	return $videoURL;
    } else if($matchVimeo) {
        $urlArray = explode('com/', $url);
    	$videoURL = '//player.vimeo.com/video/'.$urlArray[1];
    	return $videoURL;
    }
}
@endphp
<div class="discussion-single-wr community-single-wr">
	<div class="discussion-single-inner-wr">
		<div class="container">
			<div class="row">
				<div class="discussion-single-left col-xs-12 col-sm-12 col-md-9">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-xs-12 col-sm-12 col-md-2 com-post-header-author">
							@if($singleDiscussion['userinfo']['profile_image'] != '')
					        <a rel="nofollow" class="app-community-profile-layer avatar avatar-top" data-id-user="278429" href="javascript:;">
					            <figure>
					        		<img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $singleDiscussion['userinfo']['id'] }}/{{ $singleDiscussion['userinfo']['profile_image'] }}" alt="{{ $singleDiscussion['userinfo']['name'] }}">
					            </figure>
						    </a>
						    @else
							<div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
							    <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
							        <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
							        <text transform="translate(100,130)" y="0">
							            <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($singleDiscussion['userinfo']['name'][0]) }}</tspan>
							        </text>
							    </svg>
							</div>
							@endif
					        <div class="discuss-post-comment-author">
					            <span class=" user-rank user-rank-level12 icon-community-rank icon-community-rank-level12 ">{{$singleDiscussion['userinfo']['name']}}</span>
					            <small class="block color-grey mt5"> {{ date('F Y', strtotime($singleDiscussion['userinfo']['created_at']) ) }}</small>
					            <small class="block color-grey">{{ $singleDiscussion['userinfo']['address'] }}</small>
					        </div>
					    </div>
						<div class="col-xs-12 col-sm-12 col-md-10 discuss-post-comment">
							<div class="discussion-message-globe ">
							    <h1>{{ $singleDiscussion['discussion_title'] }}</h1>
								<div class="pure-g inner-dis-pure-g">
								    <div class="pure-u-6-10 com-post-header-meta">
								        <span class="com-post-header-meta-date">
								            <a rel="nofollow" href="javascript:;">{{ $singleDiscussion['userinfo']['name'] }}</a>, on {{ date('d/F/Y', strtotime($singleDiscussion['created_at']) ) }} at {{ $time = date('H:i', strtotime($singleDiscussion['created_at'])) }} </span> Posted in <a href="{{ url('/community') }}/{{ $singleDiscussion['groupinfo']['slug'] }}">{{ ucfirst($singleDiscussion['groupinfo']['group_title']) }}</a>
								    </div>
								    <div class="pure-u-4-10 text-right">
								        <span class="app_scroll_to_replies com-post-header-replies icon icon-comment-grey icon-left link pointer" style="margin-right: 10px">{{ count($discussionComments) }}</span>
								        <a href="#commentreply" class="app-tiny-focus btn-flat red" data-id-focus="Texto">Reply</a>
							            <div class="dropmenu text-left ml15">
							                <!-- <span class="dropmenu-label"><i class="icon icon-arrow-down"></i></span> -->
							                <!-- <div class="dropmenu-content">
							                    <ul>
							                    	<li>
							            				<a class="dropmenu-item" href="javascript:void(0)" onclick="community_denunciar(5,'31477')">Dispute</a>
							       					</li>
							    				</ul>
							                </div> -->
							            </div>
								    </div>
								</div>
								<div class="com-post-content ">
								    {!! $singleDiscussion['discussions_text'] !!}
								    @if(count($singleDiscussion['images']) > 0)
								    	@foreach($singleDiscussion['images'] as $groupimagesshow)
								    		@if($groupimagesshow->comment_id == '')
										    <div class="dis-image-wr">
										    	<img src="{{ url('public/discussion_group_images') }}/{{ $groupimagesshow->community_image }}" alt="">
										    </div>
										    @endif
									    @endforeach
									@endif
									@if(count($singleDiscussion['videos']) > 0)
								    	@foreach($singleDiscussion['videos'] as $groupvideosshow)
								    		@if($groupvideosshow->comment_id == '')
										    <div class="dis-image-wr">
										    	@php $videoURL = getId($groupvideosshow->community_video); @endphp
												<iframe width="100%" height="315" src="{{ $videoURL }}" frameborder="0" allowfullscreen></iframe>
										    </div>
										    @endif
									    @endforeach
									@endif
								</div>
							    <div class="app-discussions-poll app-textfield-validate relative" data-redesign="redesign"></div>
								<div class="dropmenu-content">
								    <ul>
								    	<li>
								            <a class="dropmenu-item" href="javascript:void(0)" onclick="community_denunciar(5,'31477')">Dispute</a>
								        </li>
								    </ul>
								</div>
							</div>
						</div>
					</div>
					<div class="discussion-header-title border-bottom"><h2>Comment</h2></div>
					<div class="dis-comment-res-wr" id="commentreply">
						@if(session()->has('success'))
	                    <div class="alert alert-info">
	                        {{ session()->get('success') }}
	                    </div>
	                    @endif
	                    @if (count($errors) > 0)
	                    <div class="alert alert-danger">
	                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
	                        <ul>
	                            @foreach ($errors->all() as $error)
	                                <li>{{ $error }}</li>
	                            @endforeach
	                        </ul>
	                    </div>
	                    @endif 
						<div class="dis-innercomment-res-wr">
							<form class="discussion-write pure-g app-trumbowyg-hide mt10 app-com-message-form" action="{{ url('community/add-discussion-conmment') }}" method="post" enctype="multipart/form-data">
								 {{csrf_field()}}
		                        <div class="pure-u-1-12">
		                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar">
								        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
								            <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
								            <text transform="translate(100,130)" y="0">
								                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($singleDiscussion['userinfo']['name'][0]) }}</tspan>
								            </text>
								        </svg>
								    </div>
		                        </div>
		                        <div class="pure-u-11-12 pl20 app-form-tema">
		                        	<small>Write Comment here...</small>
		                            <textarea id="comment" name="discussiom_comment"></textarea>
		                            <div class="comment-upload-img row">
	                                    <div class="col-md-3">
	                                   		<small>Upload Images</small>
	                                        <div class="upl-foto app-photo-1 hide">
	                                            <input id="photo_1" type="file" name="comment_image[]" accept="image/*" multiple="multiple" hidden="">
	                                        </div>
	                                        <label for="photo_1" class="pointer frame-inputFile btn-outline outline-red">Upload Images</label>
	                                    </div>
	                                    <div class="col-md-9 commentvideobix">
	                                    	<small>Add Video URL</small>
	                                        <div class="input-group-line input-group-line-naked" style="margin-bottom: 0">
	                                            <input class="dis-video-url" type="text" name="comment_video" placeholder="https://www.youtube.com/watch?v=8BB2VFhLe_Y; https://vimeo.com/91246;">
	                                        </div>
	                                    </div>
	                                </div>
		                            <div class="text-right fright clearfix comment-btn">
										@if(!$joinloginCheck)
			                            	<span class="jlcheker"><a href="{{ url('/login') }}">Login</a> and Join group for reply.</span>
			                            @endif
		                            	<input type="hidden" value="{{ $singleDiscussion['groupinfo']['id'] }}" name="group_id" />
		                            	<input type="hidden" value="{{ $singleDiscussion['id'] }}" name="discussion_id" />
		                                <input type="submit" class="btn-flat red @if(!$joinloginCheck) loginfalse @endif" value="Reply">
		                            </div>
		                        </div>
		                    </form>
						</div>
					</div>
					@if(count($discussionComments) > 0)
					<div class="discussion-comment-wr">
						<div class="discussion-header-title border-bottom">
		                    <h2>({{ count($discussionComments) }}) Comments</h2>
		                </div>
		                <div class="all-dis-comment-wr">
		                	<ul class="discuss-post-comments">
			                	@foreach($discussionComments as $commentdata)
									<li class="pure-g discuss-post-comment">
										<div class="pure-u-1-9">
											@if($commentdata['comment_users']['profile_image'] != '')
											<a rel="nofollow" class="app-community-profile-layer avatar" href="javascript:;">
												<figure>
													<img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $commentdata['comment_users']['id'] }}/{{ $commentdata['comment_users']['profile_image'] }}" alt="Allison">
												</figure>
											</a>
											@else
											<div class="avatar-alias size-avatar-medium app-discussion-comment-avatar avternot-dis-img">
										        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
										            <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
										            <text transform="translate(100,130)" y="0">
										                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($commentdata['comment_users']['name'][0]) }}</tspan>
										            </text>
										        </svg>
										    </div>
											@endif
											<div class="discuss-post-comment-author">
												<span class=" user-rank user-rank-level9 icon-community-rank icon-community-rank-level9 icon-left">Master</span> 
												<small class="block color-grey mt5">  {{ date('F Y', strtotime($commentdata['comment_users']['event_date']) ) }}  </small>
												<small class="block color-grey">{{ $commentdata['comment_users']['address'] }}</small>
											</div>
										</div>
										<div class="pure-u-8-9">
											<div class="discussion-message-globe dis-commeent">
												<div class="discuss-post-comment-header">
													<a rel="nofollow" href="javascript:;">{{ $commentdata['comment_users']['name'] }}</a>
													<span class="color-grey"> ·</span>
													<time>{{ date('l Y', strtotime($commentdata['created_at']) ) }} at {{ date('H:i', strtotime($commentdata['created_at']) ) }}</time>
												</div>
												<div class="com-discuss discuss-post-comment-content comment-item-comment ">
													<div class="app-citado">
														 {!! $commentdata['comment'] !!}
													</div>
													@if(count($commentdata['comment_images']) > 0)
														<ul class="comment-image-wrdis">
															@foreach($commentdata['comment_images'] as $commentimages)
																<li class="comment-image-wrdis-image pure-u-1-2">
																	<img src="{{ url('public/discussion_group_images') }}/{{ $commentimages['community_image'] }}" alt="{{ $commentimages['community_image'] }}">
																</li>
															@endforeach
														</ul>
													@endif
													@if(count($commentdata['comment_videos']) > 0)
														<div class="comment-videos-wrdis">
															@foreach($commentdata['comment_videos'] as $commentvideos)
																<div class="comment-videos-wrdis-videos">
																	@php $videourl = getId($commentvideos['community_video']); @endphp
																		<iframe width="100%" height="315" src="{{ $videourl }}" frameborder="0" allowfullscreen></iframe>
																</div>
															@endforeach
														</div>
													@endif
												</div>
												<div class="pure-g discuss-post-comment-footer">
													<ul class="pure-u-1-2 text-left">
														<li class="pure-u">
															<a href="javascript:void(0)" onclick="community_citar('Allison', '381349', '358119') ">
															<i class="icon icon-quote-red icon-left"></i> Reply                                </a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</li>
								@endforeach
                			</ul>
		                </div>
					</div>
					@endif
				</div>
				<div class="discussion-single-right col-xs-12 col-sm-12 col-md-3 cm-gp-right">
					<div class="discussion-header-title border-bottom">
					    <h2>All Community Groups</h2>
					</div>
					<div class="cm-widget">
					    <ul class="cm-widget-list">
					        @foreach($communityGroup as $groupdata)
					        <li class="cm-widget-link gp-ss-li">
					            <div class="overflow">
					                <i class="fa fa-users gp-ss-icon" aria-hidden="true"></i>
					                <a class="widget-list-name gp-ss-icon-txt" href="{{ url('community') }}/{{ $groupdata->slug }}">{{$groupdata->group_title}}</a>
					            </div>
					        </li>
					        @endforeach
					    </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.icon-quote-red::before {
    background-position: -70px -54px;
    height: 14px;
    width: 14px;
}
</style>
@include('includes.footer')
<script src="{{ url('/') }}/assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('comment');
</script>
@endsection