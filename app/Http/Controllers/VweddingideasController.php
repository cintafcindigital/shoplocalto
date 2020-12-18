<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangePassword;
use App\Mail\EnquiryReply;
use App\Page;
use App\Vendor;
use App\VendorDeal;
use App\VendorImage;
use App\VendorVideo;
use App\VendorFaq;
use App\ReviewRequest;
use App\WeddingideasCategory;
use App\WeddingideasPost;
use App\BlogCategory;
use App\BlogPost;
use Auth;
use View;

class VweddingideasController extends Controller
{
    public $vendor_img;
    public $deals;
    public $photos;
    public $videos;
    public $vendor_id;
    public $vendor_progress_percentage;
    public $vendor_progress_basic;
    public $vendor_progress_images;
    public $vendor_progress_tenHDimages;
    public $vendor_progress_videos;
    public $vendor_progress_deals;
    public $vendor_progress_faqs;
    public $vendor_progress_reviewAsk;
    public $vendor_progress_address;
    public function __construct()
    {
        $this->middleware('auth:vendor');
        $this->middleware(function (Request $request, $next) {
            $this->vendor_id = Auth::id(); // you can access user id here
            $this->vendor_progress_percentage = 10;
            $this->vendor_img = Vendor::with(['image_data'=>function($q) { $q->where(['is_logo'=>1,'status'=>1]); }])->where('vendors.vendor_id',$this->vendor_id)->first();
           $this->deals = VendorDeal::join('deal_types','deal_types.id','=','vendor_deals.deal_type_id')
                                          ->select('vendor_deals.id','vendor_deals.name as deal_name','vendor_deals.photo','vendor_deals.status','deal_types.name as type','vendor_deals.expiry_date as end_date')
                                          ->where('vendor_id',$this->vendor_id)->count();
            $this->photos = VendorImage::where(['status'=>1,'vendor_id'=>$this->vendor_id])->orderBy('is_logo','asc')->count();
            $this->videos = VendorVideo::where('vendor_id',$this->vendor_id)->orderBy('sort_order','asc')->count();
            $query=Vendor::with(['company_data'])->where('vendors.vendor_id',$this->vendor_id);
            $category_data = $query->with(['category_data'=>function($q) {
                            $q->select('categories.id','categories.slug','cat.slug as parent_slug','cat.title as parent_title','categories.title','categories.parent_id','categories.meta_title','categories.meta_keyword','categories.meta_description')
                                ->join('categories AS cat', 'cat.id', '=', 'categories.parent_id');
                            }])
                        ->first();
            ////// Vendor Progressive Bar Start from here...
            $vendor_faqs = VendorFaq::where('vendor_id',$this->vendor_id)->count();
            $vendor_reviewAsk = ReviewRequest::where('vendor_id',$this->vendor_id)->count();
            //// for vendor progress basic info....
            if($this->vendor_img->contact_person != '' && $this->vendor_img->email != '' && $this->vendor_img->step_completed == '4') {
                $this->vendor_progress_basic = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_basic = 'no';
            }
            //// for vendor uploaded pics info....
            if(count($this->vendor_img->image_data) > 4) {
                $this->vendor_progress_images = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_images = 'no';
            }
            //// for vendor high-quality pics info....
            if($this->photos > 9) {
                $this->vendor_progress_tenHDimages = 'yes';
                $this->vendor_progress_percentage += 20;
            } else {
                $this->vendor_progress_tenHDimages = 'no';
            }
            //// for vendor videos info....
            if($this->videos > 0) {
                $this->vendor_progress_videos = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_videos = 'no';
            }
            //// for vendor deal info....
            if($this->deals > 0) {
                $this->vendor_progress_deals = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_deals = 'no';
            }
            //// for vendor faq's info....
            if($vendor_faqs > 0) {
                $this->vendor_progress_faqs = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_faqs = 'no';
            }
            //// for vendor faq's info....
            if($vendor_reviewAsk > 0) {
                $this->vendor_progress_reviewAsk = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_reviewAsk = 'no';
            }
            //// for vendor business address info....
            if($category_data->company_data->business_address != '') {
                $this->vendor_progress_address = 'yes';
                $this->vendor_progress_percentage += 10;
            } else {
                $this->vendor_progress_address = 'no';
            }
            View::share ( 'vendor_progress_percentage', $this->vendor_progress_percentage);
            View::share ( 'vendor_progress_basic', $this->vendor_progress_basic);
            View::share ( 'vendor_progress_images', $this->vendor_progress_images);
            View::share ( 'vendor_progress_tenHDimages', $this->vendor_progress_tenHDimages);
            View::share ( 'vendor_progress_videos', $this->vendor_progress_videos);
            View::share ( 'vendor_progress_deals', $this->vendor_progress_deals);
            View::share ( 'vendor_progress_faqs', $this->vendor_progress_faqs);
            View::share ( 'vendor_progress_reviewAsk', $this->vendor_progress_reviewAsk);
            View::share ( 'vendor_progress_address', $this->vendor_progress_address);
            return $next($request);
        });
    }

    public function index()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['weddingPost'] = WeddingideasPost::with('parentCategory', 'subCategory')->where('vendor_id', $vendorId)->get();
        return view('vendor.wedding_ideas',['data'=>$data]);
    }

    public function add_weddingIdeas()
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['parentCategory'] = WeddingideasCategory::where('status', 1)->where('is_parent', 1)->get();
        $data['blogCategory'] = BlogCategory::all();
        return view('vendor.add_wedding_ideas',['data'=>$data]);
    }

    public function edit_weddingIdeas($id)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $data['vendorData'] = Vendor::with('company_data', 'category_data', 'image_data')->where('vendors.vendor_id',$vendorId)->get()->toArray();
        $data['parentCategory'] = WeddingideasCategory::where('status', 1)->where('is_parent', 1)->get();
        $data['weddingPost'] = WeddingideasPost::with('parentCategory', 'subCategory')->where('vendor_id', $vendorId)->where('id', $id)->get();
        return view('vendor.edit_wedding_ideas',['data'=>$data]);
    }

    public function get_subcategory($id)
    {
        $subCate = WeddingideasCategory::where('status', 1)->where('parent_id', $id)->get();
        $data = array();
        $html = '<option value="0">-- Select Category --</option>';
        if(count($subCate) > 0) {
            foreach ($subCate as $key => $subCateval) {
               $html .= '<option value="'.$subCateval->id.'">'.$subCateval->title.'</option>';
            }
        }
        $data['html'] = $html;
        return json_encode($data);
    }

    public function save_weddingIdeas(Request $request)
    {
        $vendorId =  \Auth::user()->vendor_id;
        $this->validate($request, [
            'widdingIdeastitle' => 'required',
            'widdingIdeasSubtitle' => 'required',
            'WIparentCatgories' => 'required|not_in:0',
            // 'WIparentSubCatgories' => 'required|not_in:0',
            'weddingideastext' => 'required',
        ], [
            'widdingIdeastitle.required' => 'Please add Wedding Ideas Title.',
            'widdingIdeasSubtitle.required' => 'Please add Wedding Ideas subtitle.',
            'WIparentCatgories.required|not_in:0' => 'Please select valid Category.',
            // 'WIparentSubCatgories.required|not_in:0' => 'Please select valid sub Category.',
            'weddingideastext.required' => 'Please enter post content.',
        ]);
        $detail = $request->weddingideastext;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        $featurImgArray = array();
        foreach($images as $k => $img) {
            $data = $img->getattribute('src');
            if(preg_match('/data:image/', $data)) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time().$k.'perfectWeddingday.png';
                $path = public_path() .'/weddingideas/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $imagUrl = url('/weddingideas').'/'.$image_name;
                $img->setattribute('src', $imagUrl);
                array_push($featurImgArray, $image_name);
            } else {
                $imageUrl = $img->getattribute('src');
                array_push($featurImgArray, $imageUrl);
            }
        }
        if($request->idx != '') {
            $weddingideasPostObj = WeddingideasPost::find($request->idx);
            $msgs = 'Your Wedding Idea updated successfully.';
        } else {
            $weddingideasPostObj = new WeddingideasPost();
            $msgs = 'Your Wedding Idea added successfully.';
        }
        $weddingideasPostObj->vendor_id = $vendorId;
        $weddingideasPostObj->parent_cat_id = $request->WIparentCatgories;
        $weddingideasPostObj->sub_cat_id = $request->WIparentSubCatgories;
        $weddingideasPostObj->post_title = $request->widdingIdeastitle;
        $weddingideasPostObj->slug       = str_ireplace(' ', '-', strtolower($request->widdingIdeastitle));
        $weddingideasPostObj->post_sub_title = $request->widdingIdeasSubtitle;
        $weddingideasPostObj->content = $dom->saveHTML();
        if(count($featurImgArray) > 0) {
            $weddingideasPostObj->feature_image = $featurImgArray[0];
        }
        $weddingideasPostObj->save();
        return redirect()->back()->with('message', $msgs);
    }

    public function delete_weddingIdeas($id=null)
    {
        $ideaPost = WeddingideasPost::where('id',$id)->delete();
        return redirect('blogs')->with('message', 'Your Wedding Idea deleted successfully.');
    }
}