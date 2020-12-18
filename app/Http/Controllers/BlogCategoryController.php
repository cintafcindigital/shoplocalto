<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use File;
use App\Vendor;
use App\BlogCategory;
use App\User;

class BlogCategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->where('freelisting','No')->count();
        View::share('slideBar',$data);
    }

	public function index()
	{
		$category = BlogCategory::all();
		return view('admin.blog_category.list',['category' => $category]);
	}

	public function addView()
	{
		$cats = BlogCategory::where("parent_id")->get();
		return view('admin.blog_category.add',['cats' => $cats]);
	}

	public function changeStatus($id,$status)
	{
        $category = BlogCategory::find($id);
		$category->status = $status;
		$data = $category->save();
		if($data)
			return redirect()->back()->with('success', "Category status changed Successfully.");
		else
			return redirect()->back()->with('error','Something went wrong. Please try again later !!');
	}

	public function editView($id)
	{
		$data = BlogCategory::where('id',$id)->first();
		$cats = BlogCategory::where("parent_id")->get();
		return view('admin.blog_category.edit',['cats' => $cats,'data' => $data]);
	}

	public function saveCategory(Request $request)
	{
		$this->validate($request, [
                'name' => 'required|string',
                'meta_title' => 'required|string',
                'meta_keywords' => 'required|string',
                'meta_descr' => 'required|string',
                'description' => 'required|string',
                'picture' => 'required',
            ], [ 
            	'name.required' => 'Blog category name field is required.',
            	'meta_title.required' => 'Meta title field is required.',
            	'meta_keywords.required' => 'Meta Keyword field is required.',
            	'meta_descr.required' => 'Meta Description field is required.',
            	'description.required' => 'Description field is required.',
            	'picture.required' => 'Picture field is required.',
        	]
    	);
        $category = new BlogCategory;
        /*if(!empty($request->input('is_parent')) && $request->input('is_parent') == '1')
        	$category->parent_id = null;
        else
        	$category->parent_id = $request->input('parent_id');*/
        if($request->file('picture') != null){
            $image = $request->file('picture');
            $input['image'] = time().'_'.rand(1000,9999).'_category.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $category->picture = $input['image'];
        }
        if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_category_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/images/blogs';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $category->picture = $image_name;
            }
        }
        $category->name = $request->input('name');
        $category->status = $request->input('is_active');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_descr');
        $category->description = $request->input('description');
        $category->slug = $this->createSlug($request->input('name'));
        $message = 'added';
        $data = $category->save();
		if($data)
			return redirect('admin/blog-category')->with('success', "Category $message Successfully.");
		else
			return redirect()->back()->with('error','Something went wrong. Please try again later !!');
	}

	public function updateCategory($id,Request $request)
	{
		$this->validate($request, [
                'name' => 'required|string',
                'meta_title' => 'required|string',
                'meta_keywords' => 'required|string',
                'meta_descr' => 'required|string',
                'description' => 'required|string',
                // 'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [ 
            	'name.required' => 'Blog category name field is required.',
            	'meta_title.required' => 'Meta title field is required.',
            	'meta_keywords.required' => 'Meta Keyword field is required.',
            	'meta_descr.required' => 'Meta Description field is required.',
            	'description.required' => 'Description field is required.',
            	// 'picture.required' => 'Picture field is required.',
        	]
    	);
        $category = BlogCategory::find($id);
        /*if(!empty($request->input('is_parent')) && $request->input('is_parent') == '1')
        	$category->parent_id = null;
        else
        	$category->parent_id = $request->input('parent_id');*/
        if($request->file('picture') != null){
            $image = $request->file('picture');
            $input['image'] = time().'_'.rand(1000,9999).'_category.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $category->picture = $input['image'];
        }
        if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_category_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '/images/blogs';
                @unlink($path.'/'.@$category->picture);
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $category->picture = $image_name;
            }
        }
        if($category->name != $request->input('name')){
        	$category->slug = $this->createSlug($request->input('name'));
        }
        $category->name = $request->input('name');
        $category->status = $request->input('is_active');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_descr');
        $category->description = $request->input('description');
        if(empty($category->slug) || $category->name != $request->input('name'))
	        $category->slug = $this->createSlug($request->input('name'));
        $message = 'updated';
        $data = $category->save();
		if($data)
			return redirect('admin/blog-category')->with('success', "Category $message Successfully.");
		else
			return redirect()->back()->with('error','Something went wrong. Please try again later !!');
	}

	public function createSlug($name)
	{
		$slug = str_slug($name,'-');
		$post = BlogCategory::select(DB::raw("count(*) as cnt"))->where('slug',$slug)->first();
		$slug = $slug.(isset($post->cnt) && $post->cnt > 0 ? "$post->cnt" : "");
		return $slug;
	}
    public function delete_category($id)
    {
        $cat = BlogCategory::find($id);
        if($cat->picture != '' && $cat->picture != null){
            File::delete('images/blogs/'.$cat->picture);
        }
        if($cat->delete())
            return redirect('admin/blog-category')->with('success', "Category deleted Successfully.");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }
}