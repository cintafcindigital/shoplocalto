@extends('layouts.default')
@section('content')
@include('includes.menu')

@php $groupImage = url('public/community_images').'/'.$communityData['image']; @endphp

    <div class="community-group-wr community-single-wr">
        <div class="container">
            <div class="cm-page-title">
                <div class="common-header service-header text-center">
                    <h2>{{ $communityData['group_title'] }}</h2>                    
                </div>
            </div>
            <div class="group-info-wr">
                <div class="group-inner-wr">
                    <div class="no-margin col-xs-12 col-sm-12 col-md-9 cm-gp-left">
                        <div class="discussion-hero box">  
                            <div class="discussion-hero-header" style="background-image:url({{$groupImage}})">
                                <h1 class="discussion-hero-title">{{$communityData['group_title']}}</h1>
                                <a class="btn-outline outline-white" href="javascript:void(0);" onclick="join_leave_group({{ $communityData['id'] }})"> @if($joinGroupChecker) Leave group  @else  Join Group  @endif</a>
                            </div>
                            
                            <div class="discussion-hero-content row">
                                <div class="col-xs-12 col-sm-12 col-md-8 discussion-content">
                                    {{strip_tags($communityData['description'])}}
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <ul class="avatar-group avatar-group-small">
                                        @php $count = 1; @endphp
                                        @foreach($communityData['userData'] as $userdata)
                                        @php if($count != 5 && $userdata->profile_image != '') { 
                                        $userImgURl = url('storage/USER_'.$userdata->id.'/'.$userdata->profile_image) @endphp
                                        <li class="avatar-group-item">
                                            <div class="avatar  ">
                                                <figure><img class="avatar-thumb" src="{{$userImgURl}}" alt=""></figure>
                                            </div>
                                        </li>
                                        @php } $count++; @endphp
                                        @endforeach
                                        <li class="avatar-group-item">
                                           <i class="btn-more btn-more-small"></i>
                                        </li>
                                    </ul>
                                    <div class="discussion-hero-members">{{ count($communityData['joinedUsers']) }}<br>members</div>
                                </div>
                            </div>

                            <ul class="navbar border-top pl20">

                                <li class="navbar-tab app-mirror-link pointer {{ (collect(request()->segments())->last() == $communityData['slug']) ? 'current' : '' }}">
                                    <a class="navbar-tab-item" href="{{ url('/community') }}/{{ $communityData['slug'] }}"> All </a>
                                </li>

                               <li class="navbar-tab app-mirror-link pointer {{ (collect(request()->segments())->last() == 'forums') ? 'current' : '' }}">
                                    <a class="navbar-tab-item" href="{{ url('/community') }}/{{ $communityData['slug'] }}/forums">Discussions </a>
                                    <small class="navbar-tab-item-count count notablet">{{ count($groupDiscussion) }}</small>
                                </li>

                                <li class="navbar-tab app-mirror-link pointer {{ (collect(request()->segments())->last() == 'photos') ? 'current' : '' }} ">
                                    <a class="navbar-tab-item" rel="nofollow" href="{{ url('/community') }}/{{ $communityData['slug'] }}/photos"> Photos </a>
                                    <small class="navbar-tab-item-count count notablet">{{ count($communityData['groupImages']) }}</small>
                                </li>

                                <li class="navbar-tab app-mirror-link pointer {{ (collect(request()->segments())->last() == 'videos') ? 'current' : '' }} ">
                                    <a class="navbar-tab-item" rel="nofollow" href="{{ url('/community') }}/{{ $communityData['slug'] }}/videos">Videos</a>
                                    <small class="navbar-tab-item-count count notablet">{{ count($communityData['groupVideos']) }}</small>
                                </li>
                                
                                <li class="navbar-tab app-mirror-link pointer {{ (collect(request()->segments())->last() == 'members') ? 'current' : '' }} ">
                                    <a class="navbar-tab-item" rel="nofollow" href="{{ url('/community') }}/{{ $communityData['slug'] }}/members">Members</a>
                                    <small class="navbar-tab-item-count count notablet">{{ count($communityData['joinedUsers']) }}</small>
                                </li>
                            </ul>
                        </div>

                        <div class="create-cm-gp-di-wr clearfix">
                            <div class="discussion-header-title border-bottom">
                                <h2>Create Discussions</h2>
                            </div>
                            <div class="add-dis-checker row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                     <a class="add-dis-inner-checker" onclick="checkUserLoginJoin({{ $communityData['id'] }})" href="javascript:;">Create Discussions</a>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 text-right">
                                     <a class="add-dis-video-group" onclick="addgroupvideo({{ $communityData['id'] }})" href="javascript:;">Add Video</a>
                                </div>
                                   
                            </div>
                            <div id="app-message-error">
                                @if(session()->has('success'))
                                <div class="alert alert-info">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @if(session()->has('datasavingerror'))
                                <div class="alert alert-danger">
                                    {{ session()->get('datasavingerror') }}
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
                            </div>
                            <div class="create-cm-gp-di-inner-wr clearfix" style="display: none;">
                                <form class="app-discussion-form" method="post" action="{{url('community/create-discussion')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    
                                    <div class="dis-create-inner clearfix"> 
                                        <i class="app-discussion-icon app-discussion-open icon-tools icon-tools-plus-circle-outline-big fleft mr15 pointer"></i>
                                          <div class="overflow">
                                                <div class="input-group-line input-group-line-naked">
                                                  <input name="discussion_title" class="app-discussion-title" placeholder="Create a new discussion" data-msgerror="The title of the task must contain a minimum of four characters." type="text" value="{{old('discussion_title')}}" autofocus>
                                                </div>
                                                <div class="input-group-line app-discussion-description mt20">
                                                  <textarea id="description" name="discussion_description" placeholder="Description">{{old('discussion_description')}}</textarea>
                                                </div>
                                                <div class="dis-upload-img row">
                                                    <div class="col-md-3">
                                                        <div class="upl-foto app-photo-1 hide">
                                                            <input id="photo_1" type="file" name="discussion_image" accept="image/*" hidden="">
                                                        </div>
                                                        <label for="photo_1" class="pointer frame-inputFile btn-outline outline-red">Upload Images</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group-line input-group-line-naked">
                                                            <input class="dis-video-url" type="text" name="discussion_video" placeholder="https://www.youtube.com/watch?v=8BB2VFhLe_Y; https://vimeo.com/91246;" />
                                                        </div>
                                                    </div>
                                                </div>
                                          </div>
                                          
                                          <div class="checklist-boxNew-footer-submit clearix">
                                            <input type="hidden" name="group_id" value="{{ $communityData['id'] }}" />
                                            <input class="app-discussion-submit btn-flat red" type="submit" value="Create">
                                          </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                       @if( count($communityData['groupVideos']) > 0 )
                        <div class="discussion-header-title border-bottom">
                            <h2>Videos</h2>
                        </div>

                        <div class="cls-group-photos-wr">
                            <div class="cls-group-photos-inner-wr">
                                <div class="grid">
                                @foreach($communityData['groupVideos'] as $groupVideodata)
                                    <div class="grid-item pure-u-1-3">
                                        <div class="box">
                                            <figure>
                                                <a class="photo-zoom app-com-media-item-layer" data-fancybox="gallery" href="{{ $groupVideodata['community_video'] }}">
                                                    <img alt="videoimages" src="{{ url('public/community_images') }}/videologo.jpg ">
                                                </a>
                                            <figcaption class="discussion-picture-meta">
                                                <div class="pure-g">
                                                    <div class="pure-u-1-6">
                                                        @if($groupVideodata['user']['profile_image'] != '')
                                                            <a  class="app-community-profile-layer avatar" href="javascript:;">
                                                                <figure>
                                                                    <img class="avatar-thumb" src="{{ url('storage/USER_').$groupVideodata['user']['id'].'/'.$groupVideodata['user']['profile_image'] }}" alt="Seleena">
                                                                </figure>
                                                            </a>
                                                        @else
                                                            <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar">
                                                                <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                                    <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                                    <text transform="translate(100,130)" y="0">
                                                                        <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($groupVideodata['user']['name'][0]) }}</tspan>
                                                                    </text>
                                                                </svg>
                                                            </div>

                                                        @endif
                                                    </div>
                                                <div class="pure-u-5-6 pl10">
                                                    <a class="discussion-picture-title app-com-media-item-layer" href="{{ url('/community/forums') }}/{{ $groupVideodata['discussion']['discussion_slug'] }}">
                                                       {{ $groupVideodata['discussion']['discussion_title'] }}
                                                    </a>
                                                    <span class="discussion-picture-author">By {{ $groupVideodata['user']['name'] }}</span>
                                                </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        @endif

                    </div> <!-- cm-gp-left-->

                    <div class="no-margin col-xs-12 col-sm-12 col-md-3 cm-gp-right">
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
                    </div> <!--cm-gp-right -->
                    
                </div> <!--group-inner-wr-->
            </div> <!--group-info-wr -->
           
        </div> <!-- container-->
    </div> <!-- community-group-wr -->


@include('includes.add_video_popup')

<style type="text/css">
    .grid-item { width: 275px; text-align: left; }
</style>
    
@include('includes.footer')
<script src="{{ url('/') }}/assets/admin/plugins/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="{{ url('public/css') }}/jquery.fancybox.min.css" />
<script src="{{ url('public/js') }}/jquery.fancybox.min.js"></script>



<script type="text/javascript">

    CKEDITOR.replace('description');

    function addgroupvideo(group_id) {
        $('#videoGroupid').val(group_id);
        $('#addVideoPopup').modal('show');
    }

    function join_leave_group(group_id) {
        $.ajax({
            type:"GET",
            url:'{{ url('community/join-leave-group') }}/'+group_id,
            success: function(responce) {
                responce = JSON.parse(responce);
                if(responce.error) {
                    window.location.href = '{{ url('login') }}';
                }
                if(responce.success) {
                    location.reload();
                }
            }
        });
    }

    function checkUserLoginJoin(group_id) {
        $.ajax({
            type:"GET",
            url:'{{ url('community/join-login-check') }}/'+group_id,
            success: function(responce) {
                responce = JSON.parse(responce);
                if(responce.loginerror) {
                   $('.add-dis-checker').append('<p>Please Login... <a class="checklogin" href="{{ url('login') }}">Login</a></p>');
                }else if(responce.joinsuccess) {
                    $('.create-cm-gp-di-inner-wr').fadeIn();
                }else {
                   $('.add-dis-checker').append('<p>Join Group...</p>');
                }
            }
        })
    }

    $(document).ready(function() {

        $('body').on('click', '.group-video-save', function() {
            var videoURL = $('#group_viedo').val();
            var groupid = $('#videoGroupid').val();
            
            if(videoURL != '') {
                $.ajax({
                    type:'POST',
                    url: '{{ url("community/post-group-videos") }}',
                    data: {videoURL: videoURL, groupid: groupid},
                    success: function(responce) {
                      var responce = JSON.parse(responce);
                        if(responce.info) {
                            $('.response-sms').html('<div class="alert alert-info">'+ responce.info +'</div>');
                        }
                        if(responce.success) {
                            $('.response-sms').html('<div class="alert alert-success">'+ responce.success +'</div>');
                            setTimeout(function(){
                                 window.location.reload();
                            }, 1500);
                        }
                    }
                });
            }
           
        });
    });

    $(window).load(function() {
        // Masonry Grid
          $('.grid').masonry({
            itemSelector: '.grid-item',
          });
    });

</script>


@endsection