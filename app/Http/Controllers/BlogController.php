<?php
namespace App\Http\Controllers;

use View;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\BlogCategory;
use App\BlogPost;
use App\BlogPostComment;
use App\Vendor;

class BlogController extends Controller
{
	public function __construct()
	{
		$categories = BlogCategory::with('posts')->get();
		View::share('categories', $categories);
	}
	public function index($cat_slug = null)
	{
		$blogs = BlogPost::select('blog_posts.*',DB::raw("DATE_FORMAT(blog_posts.created_at,'%d') AS day"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%M') AS month"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%d, %Y') AS display_dates"),'blog_categories.name as category','blog_categories.slug as category_slug');
		$blogs->with('user');
		$blogs->where('vendor_id');
		$blogs->join('blog_categories',function($query)use($cat_slug){
			$query->on('blog_categories.id','=','blog_posts.blog_category_id');
			if($cat_slug != null)
				$query->where('blog_categories.slug','=',$cat_slug);
		});
		$blogs->where('approved',1);
		$blogs->where('published',1);
		$blogs = $blogs->paginate(10);
		$blogCategory = BlogCategory::where('slug',$cat_slug)->first();
		return view('blogs.list',['blogs' => $blogs,'url' => url('blog'),'single_url' => url('blog-single'),'slug' => $cat_slug,'title' => 'Blogs','blogCat' => $blogCategory]);
	}
	public function withVendors($cat_slug = null)
	{
		$blogs = BlogPost::select('blog_posts.*',DB::raw("DATE_FORMAT(blog_posts.created_at,'%d') AS day"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%M') AS month"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(blog_posts.created_at,'%d, %Y') AS display_dates"),'blog_categories.name as category','blog_categories.slug as category_slug');
		$blogs->with('user');
		$blogs->with('vendor');
		$blogs->join('blog_categories',function($query)use($cat_slug){
			$query->on('blog_categories.id','=','blog_posts.blog_category_id');
			if($cat_slug != null)
				$query->where('blog_categories.slug','=',$cat_slug);
		});
		$blogs->where('approved',1);
		$blogs->where('published',1);
		$blogs = $blogs->paginate(10);
		$blogCategory = BlogCategory::where('slug',$cat_slug)->first();
		return view('blogs.list',['blogs' => $blogs,'url' => url('community'),'single_url' => url('community-post'),'slug' => $cat_slug,'title' => 'Community','blogCat' => $blogCategory]);
	}
	public function singleView($slug)
	{
		$blogs = BlogPost::select('*',DB::raw("DATE_FORMAT(created_at,'%d') AS day"),DB::raw("DATE_FORMAT(created_at,'%M') AS month"),DB::raw("DATE_FORMAT(created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(created_at,'%d, %Y') AS display_dates"))->with('categories','user')->where('vendor_id')->where('published',1)->limit(3)->inRandomOrder()->get();
		$blog = BlogPost::select('*',DB::raw("DATE_FORMAT(created_at,'%d') AS day"),DB::raw("DATE_FORMAT(created_at,'%M') AS month"),DB::raw("DATE_FORMAT(created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(created_at,'%d, %Y') AS display_dates"))->with('categories','user','vendor')->where('slug',$slug)->where('published',1)->first();
		if(!isset($blog->id)) return redirect()->back();
		return view('blogs.single',['blog' => $blog,'blogs' => $blogs,'url' => url('blog'),'single_url' => url('blog-single'),'title' => 'Blogs | '.$blog->name]);
	}
	public function singleViewCommunity($slug)
	{
		$blogs = BlogPost::select('*',DB::raw("DATE_FORMAT(created_at,'%d') AS day"),DB::raw("DATE_FORMAT(created_at,'%M') AS month"),DB::raw("DATE_FORMAT(created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(created_at,'%d, %Y') AS display_dates"))->with('categories','user','vendor')->where('approved',1)->limit(3)->inRandomOrder()->get();
		$blog = BlogPost::select('*',DB::raw("DATE_FORMAT(created_at,'%d') AS day"),DB::raw("DATE_FORMAT(created_at,'%M') AS month"),DB::raw("DATE_FORMAT(created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(created_at,'%d, %Y') AS display_dates"))->with('categories','user','vendor')->where('slug',$slug)->where('published',1)->where('approved',1)->first();
		if(!isset($blog->id)) return redirect()->back();
		$blogComments = BlogPostComment::where('blog_post_id',$blog->id)->where('approved',1)->latest()->get();
		$user_id = Auth::guard('vendor')->check() ? Auth::guard('vendor')->id() : null;
		return view('blogs.single',['blog' => $blog,'blogs' => $blogs,'url' => url('community'),'single_url' => url('community-post'),'title' => 'Community | '.$blog->name,'comments' => $blogComments,'user_id' => $user_id]);
	}
	public function communityComments($slug,Request $request)
	{
		if(Auth::guard('vendor')->check())
			$vendorId = Auth::guard('vendor')->id();
		$comment = new BlogPostComment;
		if(isset($vendorId)){
			$this->validate($request, [
	                'body' => 'required|string|max:255',
	            ],[ 
	                'body.required' => 'Comment body is required.',
	        ]);
			$comment->vendor_id = $vendorId;
			$vendorData = Vendor::where('vendor_id',$vendorId)->first();
			$comment->email = $vendorData->email;
			$comment->name = $vendorData->username;
		} else {
			$this->validate($request, [
	                'name' => 'required|string',
	                'email' => 'required|string|email',
	                'body' => 'required|string|max:255',
	            ],[ 'name.required' => ' Name field is required.',
	                'email.required' => ' E-mail field is required.',
	                'body.required' => ' Comment body is required.',
	        ]);
			$comment->email = $request->email;
			$comment->name = $request->name;
		}
		$blog = BlogPost::where('slug',$slug)->first();
		$comment->body = $request->body;
		$comment->blog_post_id = $blog->id;
		if($comment->save())
			return redirect()->back()->with('success','Successfully submitted your comment to admin !!!');
		else
			return redirect()->back()->with('error','Something went wrong. Please try again later !!!');
	}
	public function blogExample($page)
	{
		$blogs = BlogPost::select('*',DB::raw("DATE_FORMAT(created_at,'%d') AS day"),DB::raw("DATE_FORMAT(created_at,'%M') AS month"),DB::raw("DATE_FORMAT(created_at,'%Y') AS year"),DB::raw("DATE_FORMAT(created_at,'%d, %Y') AS display_dates"))->with('categories','user','vendor')->limit(3)->inRandomOrder()->get();
		$blogComments = BlogPostComment::where('blog_post_id',0)->where('approved',1)->latest()->get();
		$user_id = Auth::guard('vendor')->check() ? Auth::guard('vendor')->id() : null;
		if($page == 'example-1')
			$setPage = 'example_1';
		if($page == 'example-2')
			$setPage = 'example_2';
		if($page == 'example-3')
			$setPage = 'example_3';
		if(!isset($setPage)) return redirect('/');
		return view('blogs.'.$setPage,['blogs' => $blogs,'url' => url('community'),'single_url' => url('community-post'),'title' => 'Community | '.$page,'comments' => $blogComments,'user_id' => $user_id]);
	}
}