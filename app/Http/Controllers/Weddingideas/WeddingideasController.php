<?php
namespace App\Http\Controllers\Weddingideas;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Event;
use App\Page;
use App\Vendor;
use App\WeddingideasPost;
use App\WeddingideasCategory;

class WeddingideasController extends Controller
{
	public function index()
	{
		$data = array();
		$data['pageData'] = Page::where('id', 22)->first();
		$data['weddingideascategory'] = WeddingideasCategory::with(['subCategories' => function($q) {
				$q->where('status', 1);
			}])->where('status', 1)->where('is_parent', 1)->get();
        $data['weddingPost'] = WeddingideasPost::with('parentCategory','subCategory')->where('status','1')->orderBy('id','DESC')->paginate(16);
        $data['weddingPostRand'] = WeddingideasPost::with('parentCategory','subCategory')->where('status','1')->inRandomOrder()->limit(5)->get();
		// echo "<pre>"; print_r($data['weddingPostRand']); die();
        return view('wedding_ideas.wedding_ideas', ['data' => $data]);
    }

    public function get_search($search=null)
    {
    	$htmls = "";
    	if($search == 'is_blank') {
    		$weddingideascategory = WeddingideasCategory::with(['subCategories' => function($q) {
				$q->where('status', 1);
			}])->where('status', 1)->where('is_parent', 1)->get();
    		$htmls .= "<ul class='ui-autocomplete ui-front ui-menu ui-widget ui-widget-content ui-corner-all' style='width:330px;'><span class='ui-menu-item box-scroll jspScrollable' style='overflow:hidden;padding:0px;width:308px;' tabindex='0'><div class='jspContainer' style='width:308px;height:350px;'><div class='jspPane' style='padding:0px;top:0px;position:absolute;width:294px;'>";
    		foreach($weddingideascategory as $wic) {
    			$htmls .= "<li class='suggest-navigation pure-g suggest-item-navigation-".$wic->id."'><a href='".url('/community').'/'.$wic->slug."'><div class='ui-item-image pure-u-1-10'><span class='icon-articles-categories-suggest icon-articles-categories-suggest-".$wic->icon_class."' style='display:block;'></span></div><div class='ui-item-description pure-u-9-10 pl15'><span class='ui-item-title'>".$wic->title."</span></div></a></li>";
    		}
    		$htmls .= "</div></div> <div class='jspVerticalBar'><div class='jspCap jspCapTop'></div><div class='jspTrack' style='height:356px;'><div class='jspDrag' style='height:285px;'><div class='jspDragTop'></div><div class='jspDragBottom'></div></div></div><div class='jspCap jspCapBottom'></div></div> </div></span></ul>";
    	} else {
    		$weddingPost = WeddingideasPost::with('parentCategory','subCategory')->where('status','1')->where('post_title','LIKE','%'.$search.'%')->get();
            // dd(WeddingideasPost::with('parentCategory','subCategory')->where('status','1')->where('post_title','LIKE','%'.$search.'%')->toSql());
            $htmls .= "<ul class='ui-autocomplete ui-front ui-menu ui-widget ui-widget-content ui-corner-all' style='width:330px;'><span class='ui-menu-item box-scroll jspScrollable' style='overflow:hidden;padding:0px;width:308px;' tabindex='0'><div class='jspContainer' style='width:308px;height:350px;'><div class='jspPane' style='padding:0px;top:0px;position:absolute;width:294px;'>";
            foreach($weddingPost as $knm => $wp) {
				if($wp->feature_image != NULL && strpos($wp->feature_image, '/') != false) {
					$imgs = "<img src='".$wp->feature_image."' alt='Wedding Ideas'>";
				} else if($wp->feature_image != NULL) {
					$imgs = "<img src='".url('/public/weddingideas/').'/'.$wp->feature_image."' alt='Wedding Ideas'>";
				} else {
					$imgs = "<img src='".url('/public/weddingideas')."/vintage-wedding-ideas-meme.jpg' alt='Wedding Ideas'>";
				}
                $htmls .= "<li class='suggest-navigation pure-g suggest-item-navigation-".$wp->id."'><div class='ui-item-image pure-u-2-10'><a href='".url('/community-post').'/'.$wp->slug."'>".$imgs."</a></div><div class='ui-item-description pure-u-8-10 pl15'><a class='ui-item-title' href='".url('/wedding-ideas-post').'/'.$wp->slug."'>".$wp->post_title."</a><a class='ui-item-subtitle' href='".url('/community-post').'/'.$wp->slug."'>".$wp->parentCategory->title.' / '.$wp->subCategory->title."</a></div></li>";
            }
            if(!count($weddingPost) > 0) {
            	$htmls .= "<div class='column-container suggest-message-no-results'>No matches have been found</div>";
            }
            $htmls .= "</div> <div class='jspVerticalBar'><div class='jspCap jspCapTop'></div><div class='jspTrack' style='height:356px;'><div class='jspDrag' style='height:93px;'><div class='jspDragTop'></div><div class='jspDragBottom'></div></div></div><div class='jspCap jspCapBottom'></div></div> </div></span></ul>";
    	}
    	return $htmls;
    }

    public function getweddingideasMainCategory($slug)
    {
		$data = array();
		$subCatCount = array();
		$data['pageData'] = WeddingideasCategory::where('slug', $slug)->where('is_parent',1)->first(); //Main category page data
		$data['weddingideascategory'] = WeddingideasCategory::where('status',1)->where('is_parent',1)->get(); //Get all parent category
		$data['subcategories'] = WeddingideasCategory::where('parent_id',$data['pageData']->id)->where('status',1)->get(); //get all sub categories
		foreach($data['subcategories'] as $sbct) {
			$subCatCount[] = WeddingideasPost::where('parent_cat_id',$data['pageData']->id)->where('sub_cat_id',$sbct->id)->where('status','1')->count();
		}
		$data['subCatCount'] = $subCatCount;
		$data['weddingPostCount'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['pageData']->id)->where('status','1')->orderBy('id','DESC')->get();
        $data['weddingPost'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['pageData']->id)->where('status','1')->orderBy('id','DESC')->paginate(16);
        $data['weddingPostRand'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['pageData']->id)->where('status','1')->inRandomOrder()->limit(2)->get();
		return view('wedding_ideas.WI_main_category', ['data' => $data]);
    }

    public function getweddingideasSubCategory($parentSlug, $subSlug)
    {
		$data = array();
		$subCatCount = array();
		$data['pageData'] = WeddingideasCategory::where('slug', $subSlug)->first(); //Sub category page data
    	$data['parentCatdata'] = WeddingideasCategory::where('slug', $parentSlug)->where('is_parent', 1)->first(); //Main category page data
		$data['weddingideascategory'] = WeddingideasCategory::where('status',1)->where('is_parent',1)->get(); //Get all parent category
		$data['subcategories'] = WeddingideasCategory::where('parent_id',$data['parentCatdata']->id)->where('status',1)->get(); //get all sub categories
		foreach($data['subcategories'] as $sbct) {
			$subCatCount[] = WeddingideasPost::where('parent_cat_id',$data['parentCatdata']->id)->where('sub_cat_id',$sbct->id)->where('status','1')->count();
		}
		$data['subCatCount'] = $subCatCount;
		$data['weddingPostCount'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['parentCatdata']->id)->where('status','1')->orderBy('id','DESC')->get();
        $data['weddingPost'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['parentCatdata']->id)->where('sub_cat_id',$data['pageData']->id)->where('status','1')->orderBy('id','DESC')->paginate(16);
        $data['weddingPostRand'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['parentCatdata']->id)->where('sub_cat_id',$data['pageData']->id)->where('status','1')->inRandomOrder()->limit(1)->get();
    	return view('wedding_ideas.WI_sub_category', ['data' => $data]);
    }

    public function get_weddingIdeaspost($slug)
    {
        $data = array();
        $data['postData'] = WeddingideasPost::with('parentCategory','subCategory')->where('slug', $slug)->where('status','1')->first();
        $data['pageData'] = WeddingideasCategory::where('id',$data['postData']->sub_cat_id)->first(); //Sub category page data
        $data['parentCatdata'] = WeddingideasCategory::where('id',$data['postData']->parent_cat_id)->where('is_parent', 1)->first(); //Main category page data
        $data['weddingideascategory'] = WeddingideasCategory::where('status',1)->where('is_parent',1)->get(); //Get all parent category
        $data['subcategories'] = WeddingideasCategory::where('parent_id',$data['parentCatdata']->id)->where('status',1)->get(); //get all sub categories
        $data['vendorData'] = Vendor::with('social_details','image_data')->where('vendors.vendor_id',$data['postData']->vendor_id)->first();
        $data['relatedWeddingPosts'] = WeddingideasPost::with('parentCategory','subCategory')->where('parent_cat_id',$data['postData']->parent_cat_id)->where('sub_cat_id',$data['postData']->sub_cat_id)->where('status','1')->where('id','!=',$data['postData']->id)->limit(4)->get();
        return view('wedding_ideas.wedding_ideas_post', ['data' => $data]);
    }
}