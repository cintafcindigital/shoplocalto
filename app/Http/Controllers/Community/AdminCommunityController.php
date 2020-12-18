<?php

namespace App\Http\Controllers\Community;
use App\Http\Controllers\Controller as Controller; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryReply;
use DB;
use View;
use App\CommunityGroup;

class AdminCommunityController extends Controller
{

    /*
    * -------------------------------------------------------------
    * Working On Group Community Module
    * -------------------------------------------------------------
    */

	public function get_community_group_list(Request $request) {

		$query = CommunityGroup::orderBy('created_at', 'asc');
        if ($request->input('search') != null) {
            $query->where('group_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_keyword', 'like', '%'.$request->input('search').'%');
        }
        $community = $query->get();
        return view('admin/community/list', [
            'community' => $community
        ]);
	}

    public function pending_community_group_list(Request $request) {

        $query = CommunityGroup::orderBy('created_at', 'asc')
                    ->where('status', 0);
        if ($request->input('search') != null) {
            $query->where('group_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_keyword', 'like', '%'.$request->input('search').'%');
        }
        $community = $query->get();
        return view('admin/community/pending-list', [
            'community' => $community
        ]);
    }

    public function active_community_group_list(Request $request) {

        $query = CommunityGroup::orderBy('created_at', 'asc')
                    ->where('status', 1);
        if ($request->input('search') != null) {
            $query->where('group_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('meta_keyword', 'like', '%'.$request->input('search').'%');
        }
        $community = $query->get();
        return view('admin/community/active-list', [
            'community' => $community
        ]);
    }

	public function add_community_group() {
		 return view('admin/community/add');
	}

	public function save_community(Request $request) {

		 $groupObj = new CommunityGroup;

         $this->validate($request, [
             'title' => 'required|string',
             'description' => 'string',
             'meta_title' => 'required|string',
             'meta_description' => 'required|string',
             'meta_keyword' => 'required|string',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'thumb_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ],[
             'title.required' => 'Title field is required.',
             'description.required' => 'Description field is required.',
             'meta_title.required' => 'Meta Title field is required.',
             'meta_description.required' => 'Meta Description field is required.',
             'meta_keyword.required' => 'Meta Keywords field is required.',
             'image.required' => 'Group Banner image field is required.',
             'thumb_image.required' => 'Group Thumb image field is required.',
         ]);

        $image = $request->file('thumb_image');
        $input['thumb_image'] = 'thumb_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/community_images');
        $image->move($destinationPath, $input['thumb_image']);

        $image = $request->file('image');
        $input['image'] = 'banner_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/community_images');
        $image->move($destinationPath, $input['image']);

        $groupObj->group_title = $request->input('title');
        $groupObj->slug = str_slug($request->input('title'), '-');
        $groupObj->description = $request->input('description');
        $groupObj->meta_title = $request->input('meta_title');
        $groupObj->meta_description = $request->input('meta_description');
        $groupObj->meta_keyword = $request->input('meta_keyword');
        $groupObj->image = $input['image'];
        $groupObj->thumb_image = $input['thumb_image'];
        $groupObj->status = 1;
        $groupObj->save();
        return redirect('/admin/community')->with('success', 'Page Added Successfully.');
	}

    public function edit_community_group($id) {
        
        $dataVal = CommunityGroup::orderBy('created_at', 'asc')->where('id',$id)->first();
        if(isset($dataVal) && !empty($dataVal)){
            return view('admin/community/edit', [
                'data' => $dataVal->toArray(),
            ]);
        }else{
           return redirect('admin/community');
        }
    }

    public function update_community_group(Request $request) {

        $this->validate($request, [
         'title' => 'required|string',
         'description' => 'string',
         'meta_title' => 'required|string',
         'meta_description' => 'required|string',
         'meta_keyword' => 'required|string',
        ],[
         'title.required' => 'Title field is required.',
         'description.required' => 'Description field is required.',
         'meta_title.required' => 'Meta Title field is required.',
         'meta_description.required' => 'Meta Description field is required.',
         'meta_keyword.required' => 'Meta Keywords field is required.',
        ]);

        $groupobj = CommunityGroup::find($request->input('page_id'));

        if($request->file('image') !== null) {
            $image = $request->file('image');
            $input['image'] = 'banner_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/community_images');
            $image->move($destinationPath, $input['image']);
            $groupobj->image = $input['image'];
        }

         if($request->file('thumb_image') !== null) {
            $image = $request->file('thumb_image');
            $input['thumb_image'] = 'thumb_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/community_images');
            $image->move($destinationPath, $input['thumb_image']);
            $groupobj->thumb_image = $input['thumb_image'];
        }

        $groupobj->group_title = $request->input('title');
        $groupobj->slug = str_slug($request->input('title'), '-');
        $groupobj->description = $request->input('description');
        $groupobj->meta_title = $request->input('meta_title');
        $groupobj->meta_description = $request->input('meta_description');
        $groupobj->meta_keyword = $request->input('meta_keyword');
        $isSave = $groupobj->save();

        if($isSave){
          return redirect('admin/community')->with('success', 'Group Updated Successfully.');
        }else{
          return redirect('admin/community')->with('success', 'Something went wrong. Please try again.');
        }

    }

}

?>