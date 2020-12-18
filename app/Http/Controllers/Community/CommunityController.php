<?php
namespace App\Http\Controllers\Community;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Page;
use App\CommunityGroup;
use App\User;
use App\JoinCommunity;
use App\CommunityDiscussion;
use App\CommunityImage;
use App\CommunityVideo;
use App\DiscussionComment;
use App\DiscussionView;
use DB;

class CommunityController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
	
	/*
    *
    * Display the Community page.
    *
    */
    protected function index()
    {
        // Page data 
        $page = Page::where('id', 18)->first();
        // Discussion user for slider
        $sliderUser = CommunityDiscussion::with(['userinfo'])->orderBy('created_at', 'desc')->take(6)->get();
        // All group data
        $communitygroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        // all discussion data
        $groupDiscussion = CommunityDiscussion::with(['images','videos', 'userinfo', 'discussion_views', 'discussion_comment' => function($q){
                $q->with('comment_users')->orderBy('created_at', 'desc');
            }])->orderBy('created_at', 'desc')->take(6)->get();
        // all Photos data
        $communityImages = CommunityImage::with('user')->orderBy('created_at', 'desc')->take(8)->get();
        // all Videos data
        $communityVideos = CommunityVideo::with('user')->orderBy('created_at', 'desc')->take(8)->get();
        // all active(comment user)
        $activeUsers = User::with('all_comments')->get();
        return view('community_pages/community',['pageData'=>$page, 'sliderUser' => $sliderUser, 'communitygroup' => $communitygroup, 'groupDiscussion' => $groupDiscussion, 'communityImages' => $communityImages, 'communityVideos' => $communityVideos, 'activeUsers' => $activeUsers]);
    }

    public function get_search_community($vals=null)
    {
        $groupDiscussion = CommunityDiscussion::with(['userinfo', 'discussion_comment' => function($q) {
            $q->with('comment_users')->orderBy('created_at', 'desc');
        }])->where('discussion_title','LIKE','%'.$vals.'%')->orderBy('created_at', 'desc')->get();
        $htmls = '';
        foreach($groupDiscussion as $nm => $gd) {
            $htmls .= "<li class='app-com-suggest-item com-suggest-group-item app-suggest-item-navigation-".$nm."'><span rel='nofollow' class='app-link app-community-profile-layer avatar ' data-href='".url('community/forums/').'/'.$gd->discussion_slug."'><figure class='fleft'><img class='avatar-thumb' src='".url('/')."/storage/USER_".$gd->userinfo->id."/".$gd->userinfo->profile_image."' loading='lazy' alt='User icon' width=''></figure></span><div class='com-suggest-group-content app-link' data-href='".url('community/forums/').'/'.$gd->discussion_slug."'><a class='com-suggest-group-item-title' href='".url('community/forums/').'/'.$gd->discussion_slug."'>".$gd->discussion_title."</a><small class='color-grey'><span class='ico tip-date'>".date('d/F/Y', strtotime($gd->created_at) )."</span><span class='color-grey'> | ".count($gd->discussion_comment)." comments</span></small></div></li>";
        }
        echo $htmls;
    }

    /*
    *
    * Display the Community Forums page.
    *
    */
    protected function community_forums()
    {
        // Page data 
        $page = Page::where('id', 19)->first();
        // all discussion data
        $forumsDiscussion = CommunityDiscussion::with(['images','videos', 'userinfo', 'discussion_views', 'discussion_comment' => function($q){
        $q->with('comment_users')->orderBy('created_at', 'desc');
        }])->orderBy('created_at', 'desc')->take(10)->get();
        // All group data
        $communitygroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        return view('community_pages/forums',['pageData'=>$page, 'forumsDiscussion' => $forumsDiscussion, 'communitygroup' => $communitygroup ]);
    }

    /*
    *
    * Display the Community Forums Photos page.
    *
    */
    protected function community_photos()
    {
        // Page data 
        $page = Page::where('id', 20)->first();
        // All group data
        $communitygroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        // all Photos data
        $forumsImages = CommunityImage::with('user')->orderBy('created_at', 'desc')->get();
        return view('community_pages/photos',['pageData'=>$page,'communitygroup'=>$communitygroup,'forumsImages'=>$forumsImages]);
    }

    /*
    *
    * Display the Community Forums Videos page.
    *
    */
    protected function community_videos()
    {
        // Page data 
        $page = Page::where('id', 21)->first();
        // All group data
        $communitygroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        // all Photos data
        $forumsVideos = CommunityVideo::with('user')->orderBy('created_at', 'desc')->get();
        return view('community_pages/videos',['pageData'=>$page,'communitygroup'=>$communitygroup,'forumsVideos'=>$forumsVideos]);
    }

    /*
    *
    * Display the Community Guoup page.
    *
    */
    protected function community_groups($slug)
    {
    	$communityData = CommunityGroup::with('joinedUsers', 'userData', 'groupImages', 'groupVideos')->where('slug', $slug)->first();
        $group_id = $communityData['id'];
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get(); // All group for sidebar
        $joinGroupChecker = false;
        if(\Auth::check()) {
            $userId = \Auth::user()->id;
            if (JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
                $joinGroupChecker =  true;
            } else {
                $joinGroupChecker = false;
            }
        }
        // DB::enableQueryLog();
        $groupDiscussion = CommunityDiscussion::with(['images', 'videos', 'userinfo', 'discussion_views', 'discussion_comment' => function($q) {
                $q->with('comment_users')->orderBy('created_at', 'desc');
            }])->where('group_id', $group_id)->orderBy('created_at', 'desc')->get();
        // dd(DB::getQueryLog());
        // echo "<pre>";
        // print_r($groupDiscussion);
        // die();
    	return view('community_pages/group',['communityData' => $communityData, 'communityGroup' => $communityGroup, 'joinGroupChecker' => $joinGroupChecker, 'groupDiscussion' => $groupDiscussion]);
    }

    /*
    *
    * Join group callback
    *
    */
    protected function join_leave_group($group_id)
    {
        if(! \Auth::check()) {
            $responce['error'] = true;
            return json_encode($responce);
        }
        $userId =  \Auth::user()->id;
        $returnData = false;
        if(JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
            $query = JoinCommunity::where('group_id', $group_id)->where('user_id', $userId);
            $query->delete();
            $returnData = true;
        } else {
            $objCommunity = new JoinCommunity;
            $objCommunity->group_id = $group_id;
            $objCommunity->user_id = $userId;
            $savedata = $objCommunity->save();
            $returnData = true;
        }
        if($returnData) {
            $responce['success'] = true;
            return json_encode($responce);
        }
    }

    /*
    *
    *   Check user login and group join
    *
    */
    protected function join_login_check($group_id)
    {
        if(! \Auth::check()) {
            $responce['loginerror'] = true;
            return json_encode($responce);
        }
        $userId =  \Auth::user()->id;
        $returnData = false;
        if (JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
            $returnData = true;
        }
        $responce['joinsuccess'] = $returnData;
        return json_encode($responce);
    }

    /*
    *
    *   Create discussion by user
    *
    */
    protected function create_discussion(Request $request)
    {
        $this->validate($request, [
            'discussion_title' => 'required|string',
            'discussion_description' => 'string',
        ],[ 'discussion_title.required' => 'Discussion Title field is required.',
            'discussion_description.required' => 'Discussion Description field is required.']);
        $userId =  \Auth::user()->id;
        $group_id = $request->group_id;
        $discussionObj = new CommunityDiscussion;
        $discussionObj->group_id = $group_id;
        $discussionObj->user_id = $userId;
        $discussionObj->discussion_slug = str_slug( $request->input('discussion_title') );
        $discussionObj->discussion_title = $request->input('discussion_title');
        $discussionObj->discussions_text = $request->input('discussion_description');
        $save = $discussionObj->save();
        if($save) {
            if( count($request->file('discussion_image')) > 0 ) {
                foreach ($request->file('discussion_image') as $key => $imagevalue) {
                    $image = $imagevalue;
                    $input['image'] = $key.'DS_GP_'.$request->group_id.'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/discussion_group_images');
                    $image->move($destinationPath, $input['image']);
                    $imageObj = new CommunityImage;
                    $imageObj->group_id = $group_id;
                    $imageObj->user_id = $userId;
                    $imageObj->discussion_id = $discussionObj->id;  // save discussion id with image
                    $imageObj->community_image = $input['image'];
                    $imageObj->save();
                }
            }
            if( !empty( $request->input('discussion_video')) ) {
                $videoObj = new CommunityVideo;
                $videoObj->group_id = $group_id;
                $videoObj->user_id = $userId;
                $videoObj->discussion_id = $discussionObj->id;
                $videoObj->community_video = $request->input('discussion_video');
                $videoObj->save();
            }
            return Redirect::back()->with('success', 'Discussion Added Successfully.');
        } else {
            return Redirect::back()->with('datasavingerror', 'There were some problems with data Saving');
        }
    }

    /*
    *
    *  Get single Discussion Page
    *
    */
    protected function get_discussion_data($slug)
    {
        $singleDiscussion = CommunityDiscussion::with('images', 'videos', 'userinfo', 'groupinfo')->where('discussion_slug', '=', $slug)->first();
        $joinloginCheck = false;
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        if(\Auth::check()) {
            $userId = \Auth::user()->id;
            if(JoinCommunity::where('group_id', $singleDiscussion['groupinfo']['id'])->where('user_id', $userId)->exists()) {
                $joinloginCheck = true;
            }
        }
        if($joinloginCheck) {
            if(! DiscussionView::where('discussion_id', $singleDiscussion['id'])->where('view_user_id', $userId)->exists()) {
                $userId =  \Auth::user()->id;
                $viewObj = new DiscussionView;
                $viewObj->group_id = $singleDiscussion['groupinfo']['id'];
                $viewObj->discussion_id = $singleDiscussion['id'];
                $viewObj->view_user_id = $userId;
                $viewObj->save();
            }
        }
        $discussionComments = DiscussionComment::with('comment_users', 'comment_images', 'comment_videos')->where('group_id', $singleDiscussion['groupinfo']['id'])->where('discussion_id', $singleDiscussion['id'])->orderBy('created_at', 'desc')->get();
        return view('community_pages/discussion',['singleDiscussion' => $singleDiscussion, 'communityGroup' => $communityGroup, 'joinloginCheck' => $joinloginCheck, 'discussionComments' => $discussionComments]);
    }

    /*
    *
    *  Add comment on discussions 
    *
    */
    protected function add_discussion_comment(Request $request)
    {
        $this->validate($request, [
            'discussiom_comment' => 'required|string',
        ],[ 'discussiom_comment.required' => 'Discussion Comment field is required.' ]);
        $userId =  \Auth::user()->id;
        $group_id = $request->group_id;
        $discussion_id = $request->discussion_id;
        $commentObj = new DiscussionComment;
        $commentObj->group_id = $request->group_id;
        $commentObj->user_id = $userId;
        $commentObj->discussion_id = $request->discussion_id;
        $commentObj->comment = $request->discussiom_comment;
        $savecomment = $commentObj->save();
        if($savecomment) {
            if(count($request->file('comment_image')) > 0) {
                foreach ($request->file('comment_image') as $key => $imagevalue) {
                    $image = $imagevalue;
                    $input['image'] = $key.'DS_GP_'.$request->group_id.'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/discussion_group_images');
                    $image->move($destinationPath, $input['image']);
                    $imageObj = new CommunityImage;
                    $imageObj->group_id = $group_id;
                    $imageObj->user_id = $userId;
                    $imageObj->discussion_id = $discussion_id;  // save discussion id with image
                    $imageObj->comment_id = $commentObj->id;
                    $imageObj->community_image = $input['image'];
                    $imageObj->save();
                }
            }
            if(!empty( $request->input('comment_video'))) {
                $videoObj = new CommunityVideo;
                $videoObj->group_id = $group_id;
                $videoObj->user_id = $userId;
                $videoObj->discussion_id = $discussion_id;
                $videoObj->comment_id = $commentObj->id;
                $videoObj->community_video = $request->input('comment_video');
                $videoObj->save();
            }
        }
        return Redirect::back()->with('success', 'Comment Added Successfully.');
    }

    /*
    *
    *  get all discussion
    *
    */
    protected function all_discussion($slug)
    {
        $communityData = CommunityGroup::with('joinedUsers', 'userData', 'groupImages', 'groupVideos')->where('slug', $slug)->first();
        $group_id = $communityData['id'];
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get();
        $joinGroupChecker = false;
        if(\Auth::check()) {
            $userId = \Auth::user()->id;
            if (JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
                $joinGroupChecker =  true;
            } else {
                $joinGroupChecker = false;
            }
        }
        $groupDiscussion = CommunityDiscussion::with(['images','videos', 'userinfo', 'discussion_comment' => function($q){
            $q->with('comment_users')->orderBy('created_at', 'desc');
        }])->where('group_id', $group_id)->orderBy('created_at', 'desc')->get();
        return view('community_pages/alldiscussion',['communityData' => $communityData, 'communityGroup' => $communityGroup, 'joinGroupChecker' => $joinGroupChecker, 'groupDiscussion' => $groupDiscussion]);
    }

    /*
    *
    *  get all Photos
    *
    */
    protected function all_photos( $slug )
    {
        $communityData = CommunityGroup::with(['joinedUsers', 'userData', 'groupVideos', 'groupImages' => function($q) {
            $q->with('group', 'discussion', 'user')->orderBy('created_at', 'desc');
        } ])->where('slug', $slug)->first();
        $group_id = $communityData['id'];
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get(); // sidebar for all group show
        $joinGroupChecker = false;
        if(\Auth::check()) {
            $userId =  \Auth::user()->id;
            if (JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
                $joinGroupChecker =  true;
            } else {
                $joinGroupChecker = false;
            }
        }
        $groupDiscussion = CommunityDiscussion::where('group_id', $group_id)->orderBy('created_at', 'desc')->get();
        return view('community_pages/allphotos',['communityData' => $communityData, 'communityGroup' => $communityGroup, 'joinGroupChecker' => $joinGroupChecker, 'groupDiscussion' => $groupDiscussion]);
    }

    /*
    *
    *  get all Videos
    *
    */
    protected function all_videos( $slug )
    {
        $communityData = CommunityGroup::with(['joinedUsers', 'userData', 'groupImages', 'groupVideos' => function($q) {
            $q->with('group', 'discussion', 'user')->orderBy('created_at', 'desc');
        } ])->where('slug', $slug)->first();
        $group_id = $communityData['id'];
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get(); // sidebar for all group show
        $joinGroupChecker = false;
        if( \Auth::check()) {
            $userId =  \Auth::user()->id;
            if (JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
                $joinGroupChecker =  true;
            } else {
                $joinGroupChecker = false;
            }
        }
        $groupDiscussion = CommunityDiscussion::where('group_id', $group_id)->orderBy('created_at', 'desc')->get();
        return view('community_pages/allvideos',['communityData' => $communityData, 'communityGroup' => $communityGroup, 'joinGroupChecker' => $joinGroupChecker, 'groupDiscussion' => $groupDiscussion]);
    }

    /*
    *
    * Add Videos for group from group pages
    *
    */
    protected function add_group_videos(Request $request)
    {
        $responce = array();
        if(!\Auth::check()) {
            $responce['info'] = 'Please Login First..';
            return json_encode($responce);
        } else {
            $userId =  \Auth::user()->id;
            if(!JoinCommunity::where('group_id', $request->groupid)->where('user_id', $userId)->exists()) {
                $responce['info'] = 'Please Join Group First..';
                return json_encode($responce);
            } else {
                $videoObj = new CommunityVideo;
                $videoObj->group_id = $request->groupid;
                $videoObj->user_id = $userId;
                $videoObj->community_video = $request->videoURL;
                $groupSave = $videoObj->save();
                if($groupSave) {
                    $responce['success'] = 'Videos Added Successfully.';
                    return json_encode($responce);
                }
            }
        }
    }

    /*
    *
    * Add Images for group from group pages
    *
    */
    protected function add_group_images(Request $request)
    {
        $responce = array();
        if( ! \Auth::check()) {
            $responce['info'] = 'Please Login First..';
            return json_encode($responce);
        } else {
            $userId =  \Auth::user()->id;
            if(!JoinCommunity::where('group_id', $request->groupid)->where('user_id', $userId)->exists()) {
                $responce['info'] = 'Please Join Group First..';
                return json_encode($responce);
            } else {
                if( count($request->file('groupImage')) > 0 ) {
                    foreach ($request->file('groupImage') as $key => $imagevalue) {
                        $image = $imagevalue;
                        $input['image'] = $key.'DS_GP_'.$request->group_id.'_'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/discussion_group_images');
                        $image->move($destinationPath, $input['image']);
                        $imageObj = new CommunityImage;
                        $imageObj->group_id = $request->groupid;
                        $imageObj->user_id = $userId;
                        $imageObj->community_image = $input['image'];
                        $groupSave = $imageObj->save();
                    }
                }
                $responce['success'] = 'Images are Uploaded Successfully.';
                return json_encode($responce);
            } // end inner else
        } // end main else
    }

    /*
    *
    * Add Member of group
    *
    */
    protected function all_members( $slug )
    {
        $communityData = CommunityGroup::with(['joinedUsers', 'groupImages', 'groupVideos', 'userData' => function($q) {
            $q->with('all_discussions', 'all_comments', 'all_videos', 'all_images');
        }])->where('slug', $slug)->first();
        $group_id = $communityData['id'];
        $communityGroup = CommunityGroup::orderBy('created_at', 'asc')->get(); // All group for sidebar
        $joinGroupChecker = false;
        if(\Auth::check()) {
            $userId =  \Auth::user()->id;
            if(JoinCommunity::where('group_id', $group_id)->where('user_id', $userId)->exists()) {
                $joinGroupChecker =  true;
            } else {
                $joinGroupChecker = false;
            }
        }
        $groupDiscussion = CommunityDiscussion::where('group_id', $group_id)->orderBy('created_at', 'desc')->get();
        return view('community_pages/allmembers',['communityData' => $communityData, 'communityGroup' => $communityGroup, 'joinGroupChecker' => $joinGroupChecker, 'groupDiscussion' => $groupDiscussion]);
    }

}
?>