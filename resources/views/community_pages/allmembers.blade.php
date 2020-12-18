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
                                            @if($count != 5 && $userdata->profile_image != '') 
                                                @php  $userImgURl = url('storage/USER_'.$userdata->id.'/'.$userdata->profile_image); @endphp
                                                    <li class="avatar-group-item">
                                                        <div class="avatar  ">
                                                            <figure><img class="avatar-thumb" src="{{$userImgURl}}" alt=""></figure>
                                                        </div>
                                                    </li>
                                                @php $count++; @endphp
                                            @endif
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
                                    <a class="navbar-tab-item" href="{{ url('/community') }}/{{ $communityData['slug'] }}">All </a>
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

                        @if(count($communityData['userData']) > 0)
                            <div class="create-cm-gp-di-wr clearfix">
                                <div class="discussion-header-title border-bottom">
                                    <h2>All Members</h2>
                                </div>
                                <p class="strong" style="margin-bottom: 10px">Results: <b>{{ count($communityData['userData']) }}</b> Members</p>
                                <div class="all-members-dis-wr">
                                     <div class="all-members-disinner-wr">
                                        <div class="pure-g-r row mb10 app-community-search-users-spinner relative">
                                            @foreach($communityData['userData'] as $memberdata )
                                                <div class="pure-u-1-2" id="app-user-card-{{ $memberdata['id'] }}">
                                                    <div class="com-user-card unit">
                                                        <div class="pure-g com-user-card-header">
                                                            <div class="pure-u-3-12 ">
                                                                @if($memberdata['profile_image'] != '')
                                                                    <a rel="nofollow" class="app-community-profile-layer avatar" href="javascript:;">
                                                                    <figure>
                                                                        <img class="avatar-thumb" src="{{  url('storage/USER_') }}{{ $memberdata['id'] }}/{{ $memberdata['profile_image'] }}" alt="{{ $memberdata['name'] }}">
                                                                    </figure>
                                                                    </a>
                                                                @else
                                                                    <div class="avatar-alias size-avatar-medium app-discussion-comment-avatar" style="margin: 0 auto">
                                                                        <svg class="avatar-generic" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="xMidYMin slice">
                                                                            <circle fill="#9AAAB0" cx="100" cy="100" r="100"></circle>
                                                                            <text transform="translate(100,130)" y="0">
                                                                                <tspan font-size="90" class="" fill="rgba(0,0,0,0.3)" text-anchor="middle">{{ ucfirst($memberdata['name'][0]) }}</tspan>
                                                                            </text>
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="com-user-card-content pure-u-9-12">
                                                                <a class="com-user-card-name link" rel="nofollow" href="javascript:;" title="">{{ $memberdata['name'] }}</a>
                                                                <p>
                                                                    <span class=" user-rank user-rank-level9 icon-community-rank icon-community-rank-level9 icon-left">Marriage Date: </span>
                                                                    <span>{{ date('d-M-Y', strtotime($memberdata['event_date']) ) }}</span>
                                                                </p>
                                                                <p>Profile role: {{ $memberdata['event_role'] }} </p>
                                                                <p>Address: {{ $memberdata['address'] }}</p>
                                                            </div>
                                                        </div>

                                                        <ul class="com-user-card-summary pure-g">
                                                            <li class="pure-u-1-4">
                                                                <a class="" rel="nofollow" href="javascript:;" title="Messages"><span class="count">{{ count($memberdata['all_comments']) }}</span>Messages</a>
                                                            </li>
                                                            <li class="pure-u-1-4">
                                                                <a class="" rel="nofollow" href="javascript:;"><span class="count">{{ count($memberdata['all_discussions']) }}</span>Discussions</a>
                                                            </li>
                                                            <li class="pure-u-1-4">
                                                                <a class="" rel="nofollow" href="javascript:;" title="Photos"><span class="count">{{ count($memberdata['all_images']) }}</span>Photos</a>
                                                            </li>
                                                            <li class="pure-u-1-4">
                                                                <a class="" rel="nofollow" href="javascript:;" title="Friends"><span class="count">{{ count($memberdata['all_videos']) }}</span>Viedos</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                     </div>
                                </div>
                            </div>
                        @endif
 
                        
                    </div>
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
                </div>
            </div>
           
        </div>
    </div>
    
@include('includes.footer')
<script src="{{ url('/') }}/assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

    CKEDITOR.replace('description');

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
</script>


@endsection