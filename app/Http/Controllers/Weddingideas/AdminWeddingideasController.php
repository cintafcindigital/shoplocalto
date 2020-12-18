<?php

namespace App\Http\Controllers\Weddingideas;
use App\Http\Controllers\Controller as Controller; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryReply;
use DB;
use View;
use App\WeddingideasCategory;


class AdminWeddingideasController extends Controller
{
    /*
    * -------------------------------------------------------------
    * Working On Wedding Ideas Module
    * -------------------------------------------------------------
    */
    public function index(Request $request) {

        $query = WeddingideasCategory::orderBy('created_at', 'asc');
        if ($request->input('search') != null) {
            $query->where('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('slug', 'like', '%'.$request->input('search').'%');
        }
        $weddingideas = $query->get();
        return view('admin/weddingideas/list', ['weddingideas' => $weddingideas]);

    }
    public function pending_wedding_ideas(Request $request) {

        $query = WeddingideasCategory::orderBy('created_at', 'asc')
                  ->where('status', 0);
        if ($request->input('search') != null) {
            $query->where('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('slug', 'like', '%'.$request->input('search').'%');
        }
        $weddingideas = $query->get();
        return view('admin/weddingideas/pending-list', [
            'weddingideas' => $weddingideas
        ]);

    }
    public function active_wedding_ideas(Request $request) {

        $query = WeddingideasCategory::orderBy('created_at', 'asc')
                    ->where('status', 1);
        if ($request->input('search') != null) {
            $query->where('title', 'like', '%'.$request->input('search').'%');
            $query->orWhere('description', 'like', '%'.$request->input('search').'%');
            $query->orWhere('slug', 'like', '%'.$request->input('search').'%');
        }
        $weddingideas = $query->get();
        return view('admin/weddingideas/active-list', [
            'weddingideas' => $weddingideas
        ]);

    }

    public function add_weddingideas() {

        $cats = WeddingideasCategory::where('is_parent', 1)->get()->toArray();
        return view('admin/weddingideas/add', [
            'cats' => $cats
        ]);

    }

    public function save_weddingideas(Request $request) {

        $catObj = new WeddingideasCategory;
         $this->validate($request, [
             'title' => 'required|string',
             'meta_title' => 'required|string',
             'meta_description' => 'required|string',
             'meta_keyword' => 'required|string',
         ],['title.required'=>'Title field is required.',
         'meta_title.required' => 'Meta Title field is required.',
         'meta_description.required' => 'Meta Description field is required.',
         'meta_keyword.required' => 'Meta Keywords field is required.',]);
        $catObj->title = $request->input('title');
        $catObj->description = $request->input('description');
        $catObj->slug = str_slug($request->input('title'),'-');
        $catObj->meta_title = $request->input('meta_title');
        $catObj->meta_description = $request->input('meta_description');
        $catObj->meta_keyword = $request->input('meta_keyword');
        $catObj->icon_class  = $request->input('icon_class');
        if($request->input('parent_id') != ''){
           $catObj->parent_id = $request->input('parent_id');
        }
        if($request->input('is_parent') != ''){
           $catObj->is_parent = $request->input('is_parent');
        }
        $catObj->status = 1;

        $catObj->save();
        return redirect('/admin/weddingideas')->with('success', 'Wedding Ideas Category Added Successfully.');

    }

    public function edit_weddingideas($id) {
        $cats = WeddingideasCategory::where('is_parent', 1)->get()->toArray();
        $catData = WeddingideasCategory::where('id', $id)->first()->toArray();
        return view('admin/weddingideas/edit', [
            'cats' => $cats,
            'cat_data'=>$catData,
        ]);
    }

    protected function status_weddingideas($id,$status)
    {
        $faqObj = WeddingideasCategory::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data){
          return redirect()->back()->with('success', 'Category status has been updated.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function update_weddingideas(Request $request) {

        $this->validate($request, [
             'title' => 'required|string',
             'meta_title' => 'required|string',
             'meta_description' => 'required|string',
             'meta_keyword' => 'required|string',
         ],['title.required'=>'Title field is required.',
         'meta_title.required' => 'Meta Title field is required.',
         'meta_description.required' => 'Meta Description field is required.',
         'meta_keyword.required' => 'Meta Keywords field is required.',]);
        $catObj = WeddingideasCategory::find($request->input('cat_id'));
        $catObj->title = $request->input('title');
        $catObj->description = $request->input('description');
        $catObj->meta_title = $request->input('meta_title');
        $catObj->meta_description = $request->input('meta_description');
        $catObj->meta_keyword = $request->input('meta_keyword');
        $catObj->slug = str_slug($request->input('title'),'-');
        if($request->input('parent_id') != ''){
           $catObj->parent_id = $request->input('parent_id');
        }else{
            $catObj->parent_id = null;
        }
        if($request->input('is_parent') != ''){
           $catObj->is_parent = $request->input('is_parent');
        }else{
            $catObj->is_parent = '0';
        }
        $catObj->icon_class  = $request->input('icon_class');
        $data = $catObj->save();
        if($data){
          return redirect()->back()->with('success', 'Category Updated Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }


}

?>