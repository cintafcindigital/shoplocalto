<?php
namespace App\Http\Controllers;

use View;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBlogPublishResponderMail;
use App\Vendor;
use App\BlogCategory;
use App\BlogPost;
use App\BlogPostComment;
use App\User;

class BlogPostController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->where('freelisting','No')->count();
        View::share('slideBar',$data);
    }

	public function index($slug = null)
	{
		$blogs = BlogPost::with('categories')->where('vendor_id');
        if($slug == 'active')
            $blogs->where('approved',1);
        elseif($slug == 'pendig')
            $blogs->where('approved','!=',1);
        elseif(!empty($slug))
            return redirect('admin/community');
        $blogs = $blogs->get();
		return view('admin.blog.list',['blogs' => $blogs]);
	}

	public function addPost()
	{
		$cats = BlogCategory::all();
		// dd($cats);
		return view('admin.blog.add',['cats' => $cats]);
	}

	public function editView($id)
	{
		$blog = BlogPost::with('categories')->where('id',$id)->first();
		// dd($blog);
		$cats = BlogCategory::all();
		return view('admin.blog.edit',['blog' => $blog,'cats' => $cats]);
	}

	public function savePost($id = null,Request $request)
	{
		$this->validate($request, [
                'name' => 'required|string',
                'picture' => 'required',
                'excerpt' => 'required|string',
                'body' => 'required|string',
                'category_id' => 'required|integer',
                'meta_title' => 'required|string',
                'meta_keywords' => 'required|string',
                'meta_descr' => 'required|string',
                'pdf' => 'max:2048'
            ],
            [ 
            	'name.required' => 'Blog name or title field is required.',
            	'picture.required' => 'Picture is required.',
            	'excerpt.required' => 'Brief body is required.',
            	'body.required' => 'Post body is required.',
                'meta_title.required' => 'Meta title field is required.',
                'meta_keywords.required' => 'Meta Keyword field is required.',
                'meta_descr.required' => 'Meta Description field is required.',
            	'category_id.required' => 'Category is required.',
            ]
        );
        /*$categories = $request->input('categories');
        if(!is_array($categories) && empty($categories))
        	return redirect()->back()->with('error','Atleast one category to be add !!');*/
        if($id == null)
	    	$blogPost = new BlogPost;
        else
        	$blogPost = BlogPost::find($id);
        if($request->file('picture') != null) {
            $image = $request->file('picture');
            $input['image'] = time().'_'.rand(1000,9999).'_mhs_content.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $blogPost->picture = $input['image'];
        }
        if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_'.rand(1000,9999).'_mhs_content' . '.png';
                $path = public_path() . '/images/blogs';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $blogPost->picture = $image_name;
            }
        }
        if($request->file('pdf') != null) {
            $image = $request->file('pdf');
            $input['image'] = time().'_'.rand(100,999).'_mhs_content_pdf.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $blogPost->pdf = $input['image'];
        }
        
        if($id == null)
	        $blogPost->slug = $this->createSlug($request->name);
	    else
	        if($blogPost->name != $request->name)
	            $blogPost->slug = $this->createSlug($request->name);
	    $detail = $request->body;
	    libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $featurImgArray = array();
        foreach($images as $k => $img) {
            $data = $img->getattribute('src');
            if(preg_match('/data:image/', $data)) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time().$k.'mhs.png';
                $path = public_path() .'/images/blogs/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $imagUrl = url('/images/blogs').'/'.$image_name;
                $img->setattribute('src', $imagUrl);
                array_push($featurImgArray, $image_name);
            } else {
                $imageUrl = $img->getattribute('src');
                array_push($featurImgArray, $imageUrl);
            }
        }
        
	    $blogPost->name = $request->name;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->body = $dom->saveHTML();;
        $blogPost->blog_category_id = $request->category_id;
        $userData = $request->session()->get('adminData')[0];
        $blogPost->user_id = $userData['id'];
        $blogPost->published = $request->published;
        $blogPost->approved = 1;
        $blogPost->meta_title = $request->input('meta_title');
        $blogPost->meta_keywords = $request->input('meta_keywords');
        $blogPost->meta_description = $request->input('meta_descr');
        $data = $blogPost->save();
        $message = 'added';
        if($data){
            $vendors = DB::select("SELECT vendors.* FROM vendors WHERE verified = 1 AND status = 1");
            $vendorEmails = array_map(function($emails){
                return $emails->email;
            },$vendors);
            // to($vendorEmails)->
            foreach($vendorEmails as $key => $email){
                // Mail::to($email)->send(new NewBlogPublishResponderMail('',['email' => $email,'link' => url('blog-single/'.$blogPost->slug)]));
            }
            return redirect('admin/blog')->with('success',"Blog $message successfully !!");
        }
        else
        	return redirect('admin/blog')->with('error','Something went wrong. Please try again later !!');
	}
    public function updatePost($id,Request $request)
    {
        $this->validate($request, [
                'name' => 'required|string',
                // 'picture' => 'required|max:2048',
                'excerpt' => 'required|string',
                'body' => 'required|string',
                'category_id' => 'required|integer',
                'meta_title' => 'required|string',
                'meta_keywords' => 'required|string',
                'meta_descr' => 'required|string',
                'pdf' => 'max:2048'
            ],
            [ 
                'name.required' => 'Blog name or title field is required.',
                // 'picture.required' => 'Picture is required.',
                'excerpt.required' => 'Brief body is required.',
                'body.required' => 'Post body is required.',
                'meta_title.required' => 'Meta title field is required.',
                'meta_keywords.required' => 'Meta Keyword field is required.',
                'meta_descr.required' => 'Meta Description field is required.',
                'category_id.required' => 'Category is required.',
            ]
        );
        /*$categories = $request->input('categories');
        if(!is_array($categories) && empty($categories))
            return redirect()->back()->with('error','Atleast one category to be add !!');*/
        $blogPost = BlogPost::find($id);
        if($request->file('picture') != null) {
            $image = $request->file('picture');
            $input['image'] = time().'_'.rand(1000,9999).'_mhs_content.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
            $blogPost->picture = $input['image'];
        }
        if(!empty($request->input('picture')) && strlen($request->input('picture')) > 6) {
            $featuredImage = $request->input('picture');
            if(preg_match('/data:image/', $featuredImage)) {
                @unlink(public_path() . '/images/blogs'.@$blogPost->picture);
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time().'_'.rand(1000,9999).'_mhs_content' . '.png';
                $path = public_path() . '/images/blogs';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path. '/' . $image_name, $featuredImage);
                $blogPost->picture = $image_name;
            }
        }
        if($request->file('pdf') != null) {
            $image = $request->file('pdf');
            $input['image'] = time().'_'.rand(100,999).'_mhs_content_pdf.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/blogs');
            $image->move($destinationPath, $input['image']);
	        $blogPost->pdf = $input['image'];
        }
        if($blogPost->name != $request->name){
            $blogPost->slug = $this->createSlug($request->name);
        }
        $detail = $request->body;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $featurImgArray = array();
        foreach($images as $k => $img) {
            $data = $img->getattribute('src');
            if(preg_match('/data:image/', $data)) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time().$k.'mhs.png';
                $path = public_path() .'/images/blogs/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $imagUrl = url('/images/blogs').'/'.$image_name;
                $img->setattribute('src', $imagUrl);
                array_push($featurImgArray, $image_name);
            } else {
                $imageUrl = $img->getattribute('src');
                array_push($featurImgArray, $imageUrl);
            }
        }
        
        $blogPost->name = $request->name;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->body = $dom->saveHTML();
        $blogPost->blog_category_id = $request->category_id;
        $userData = $request->session()->get('adminData')[0];
        $blogPost->user_id = $userData['id'];
        $blogPost->published = $request->published;
        $blogPost->approved = 1;
        $blogPost->meta_title = $request->input('meta_title');
        $blogPost->meta_keywords = $request->input('meta_keywords');
        $blogPost->meta_description = $request->input('meta_descr');
        $data = $blogPost->save();
        $message = 'updated';
        if($data)
            return redirect('admin/blog')->with('success',"Blog $message successfully !!");
        else
            return redirect('admin/blog')->with('error','Something went wrong. Please try again later !!');
    }
	public function createSlug($name)
	{
		$slug = str_slug($name,'-');
		$post = BlogPost::select(DB::raw("count(*) as cnt"))->where('slug',$slug)->first();
		$slug = $slug.(isset($post->cnt) && $post->cnt > 0 ? "$post->cnt" : "");
		return $slug;
	}
    public function approveBlog($id,$status)
    {
        $blog = BlogPost::find($id);
        $blog->approved = $status;
        $data = $blog->save();
        $message = $status == 1 ? 'approved' : 'disapproved';
        if($data)
            return redirect()->back()->with('success',"Blog $message successfully !!");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }
    public function publishBlog($id,$status)
    {
        $blog = BlogPost::find($id);
        $blog->published = $status;
        $data = $blog->save();
        $message = $status == 1 ? 'published' : 'unpublished';
        if($data)
            return redirect()->back()->with('success',"Blog $message successfully !!");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }
    public function deleteBlog($id)
    {
        $blog = BlogPost::find($id);
        $data = $blog->delete();
        $message = 'deleted';
        if($data)
            return redirect()->back()->with('success',"Blog $message successfully !!");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }

    public function get_vendor_post($slug = null)
    {
        $blogs = BlogPost::with(['categories','vendor'])->where('user_id');
        if($slug == 'active')
            $blogs->where('approved',1);
        elseif($slug == 'pending')
            $blogs->where('approved','!=',1);
        elseif(!empty($slug))
            return redirect('admin/community');
        $blogs = $blogs->get();
        return view('admin.blog.list',['blogs' => $blogs]);
    }

    public function get_post_comments($slug = null)
    {
        $comments = BlogPostComment::with(['vendor','blog']);
        if($slug == 'approved')
            $comments->where('approved',1);
        elseif($slug == 'pending')
            $comments->where('approved',0);
        elseif(!empty($slug))
            return redirect('admin/community-comments');
        $comments = $comments->get();
        // dd($comments);
        return view('admin.blog.comments',['comments' => $comments]);
    }

    public function approve_comments($id,$status)
    {
        $comment = BlogPostComment::find($id);
        $comment->approved = $status;
        $message = $status == 1 ? 'approved' : 'disapproved';
        if($comment->save())
            return redirect()->back()->with('success',"Comment $message successfully !!");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }

    public function delete_comments($id)
    {
        $comment = BlogPostComment::find($id);
        $message = 'deleted';
        if($comment->delete())
            return redirect()->back()->with('success',"Comment $message successfully !!");
        else
            return redirect()->back()->with('error','Something went wrong. Please try again later !!');
    }

    public function viewBlogPost($id)
    {
        $data['blog'] = BlogPost::where('id',$id)->with('categories')->first();
        if(!isset($data['blog']->name)) return redirect()->back();
        return view('admin.blog.view',$data);
    }
    
    public function deleteBlogPdf($id){
        $blog = BlogPost::find($id);
        @unlink(public_path('images/blogs/'.$blog->pdf));
        $blog->pdf = null;
        $blog->save();
        return redirect()->back()->with('success',"Pdf deleted successfully successfully !!");
    }
}