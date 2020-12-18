<?php
namespace App\Http\Controllers\Weddingdresses;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Page;
use App\WeddingdressTypes;
use App\WeddingdressProduct;
use App\WeddingdressDesigner;
use App\WeddingdressCollections;
use App\WeddingdressAddToFavourites;
use Auth;
use DB;

class WeddingdressesController extends Controller
{
   protected function index(Request $request)
   {
      $user_id = @Auth::user()->id;
      $type = $request->type ? : '1';
      $data['type'] = $type;
      $neckline = $request->neckline ? : '';
      $data['neckline'] = $neckline;
      $silhouette = $request->silhouette ? : '';
      $data['silhouette'] = $silhouette;
      $length = $request->length ? : '';
      $data['length'] = $length;
      $season = $request->season ? : '';
      $data['season'] = $season;
      $designer = $request->designer ? : '';
      $data['designer'] = $designer;
      $data['designer_name'] = '';
      if($designer) {
         $getDesignerName = WeddingdressDesigner::where('id',$designer)->where('status','1')->first();
         $data['designer_name'] = $getDesignerName->name;
      }
      $page = Page::where('id', 23)->first(); /// for Wedding Dresses
      $data['wedTypes'] = WeddingdressTypes::where('type_id',$type)->where('status','1')->with('neckProductData')->withCount('neckProductData')->with('silhProductData')->withCount('silhProductData')->get();
      $data['wedDesignerLimit'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->limit(15)->get();
      $data['wedDesignerCount'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->with('productData')->withCount('productData')->get();
      $data['wedNeckline'] = WeddingdressProduct::select('neckline_type')->where('type_id',$type)->where('status','1')->groupBy('neckline_type')->get();
      $data['wedSilhouette'] = WeddingdressProduct::select('silhouette_type')->where('type_id',$type)->where('status','1')->groupBy('silhouette_type')->get();
      $data['wedProductLength'] = WeddingdressProduct::select('length')->where('type_id',$type)->where('status','1')->groupBy('length')->get();
      $data['wedProductYears'] = WeddingdressProduct::select('*',DB::raw('COUNT(season_year) as product_count'))->where('type_id',$type)->where('status','1')->orderBy('season_year','DESC')->groupBy('season_year')->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $wedProductCount = WeddingdressProduct::where('type_id',$type);
                        if($neckline) {   $wedProductCount->where('neckline_type',$neckline); }
                        if($silhouette) { $wedProductCount->where('silhouette_type',$silhouette); }
                        if($length) {     $wedProductCount->where('length',$length); }
                        if($season) {     $wedProductCount->where('season_year',$season); }
                        if($designer) {   $wedProductCount->where('designer_id',$designer); }
      $data['wedProductCount'] = $wedProductCount->where('status','1')->get();
      $wedProducts = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('type_id',$type);
                     if($neckline) {   $wedProducts->where('neckline_type',$neckline); }
                     if($silhouette) { $wedProducts->where('silhouette_type',$silhouette); }
                     if($length) {     $wedProducts->where('length',$length); }
                     if($season) {     $wedProducts->where('season_year',$season); }
                     if($designer) {   $wedProducts->where('designer_id',$designer); }
      $data['wedProducts'] = $wedProducts->where('status','1')->orderBy('is_top','DESC')->orderBy('season_year','DESC')->paginate(20);
      $data['quizProducts'] = WeddingdressProduct::with('imageData','designerData')->where('type_id',$type)->where('status','1')->inRandomOrder()->limit(3)->get();
      // echo '<pre>'; print_r($data['wedProducts']); die;
      return view('wedding_dresses.wedding_dress',['pageData' => $page, 'data' => $data]);
   }

   public function get_wedding_designers(Request $request, $d_slug=null)
   {
      $user_id = @Auth::user()->id;
      $type = $request->type ? : '1';
      $data['type'] = $type;
      $neckline = $request->neckline ? : '';
      $data['neckline'] = $neckline;
      $silhouette = $request->silhouette ? : '';
      $data['silhouette'] = $silhouette;
      $length = $request->length ? : '';
      $data['length'] = $length;
      $season = $request->season ? : '';
      $data['season'] = $season;
      $collection = $request->collection ? : '';
      $data['collection'] = $collection;
      $designer = $request->designer ? : '';
      $data['designer'] = $designer;
      $page = Page::where('id', 23)->first(); /// for Wedding Dresses
      $data['wedTypes'] = WeddingdressTypes::where('type_id',$type)->where('status','1')->get();
      $data['wedDesigner'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->get();
      $data['designerData'] = WeddingdressDesigner::where('slug',$d_slug)->where('type_id',$type)->where('status','1')->with('productData')->withCount('productData')->first();
      $data['wedNeckline'] = WeddingdressProduct::select('neckline_type')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->groupBy('neckline_type')->get();
      $data['wedSilhouette'] = WeddingdressProduct::select('silhouette_type')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->groupBy('silhouette_type')->get();
      $data['wedProductLength'] = WeddingdressProduct::select('length')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->groupBy('length')->get();
      $data['wedProductYears'] = WeddingdressProduct::select('*',DB::raw('COUNT(season_year) as product_count'))->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->orderBy('season_year','DESC')->groupBy('season_year')->get();
      $data['wedProductCollection'] = WeddingdressProduct::select('*',DB::raw('COUNT(collection_id) as product_count'))->with('collectionData')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->where('collection_id','!=','')->orderBy('season_year','DESC')->groupBy('collection_id','season_year')->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $wedProducts = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('designer_id',$data['designerData']->id)->where('type_id',$type);
                     if($neckline) {   $wedProducts->where('neckline_type',$neckline); }
                     if($silhouette) { $wedProducts->where('silhouette_type',$silhouette); }
                     if($length) {     $wedProducts->where('length',$length); }
                     if($season) {     $wedProducts->where('season_year',$season); }
                     if($collection) { $wedProducts->where('collection_id',$collection); }
      $data['wedProducts'] = $wedProducts->where('status','1')->orderBy('is_top','DESC')->orderBy('season_year','DESC')->paginate(20);
      $data['quizProducts'] = WeddingdressProduct::with('imageData','designerData')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->inRandomOrder()->limit(3)->get();
      return view('wedding_dresses.wedding_dress_designer',['pageData' => $page, 'data' => $data]);
   }

   public function get_wedding_designers_product($d_slug=null, $p_slug=null)
   {
      $user_id = @Auth::user()->id;
      $page = Page::where('id', 23)->first(); /// for Wedding Dressess
      $data['designerData'] = WeddingdressDesigner::where('slug',$d_slug)->where('type_id','1')->where('status','1')->with('productData')->withCount('productData')->first();
      $data['wedProducts'] = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('designer_id',$data['designerData']->id)->where('slug',$p_slug)->where('type_id','1')->where('status','1')->first();
      $data['wedMoreProducts'] = WeddingdressProduct::with('imageData')->where('designer_id',$data['designerData']->id)->where('id','!=',$data['wedProducts']->id)->where('type_id','1')->where('status','1')->limit(6)->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $data['favouritesDressCount'] = WeddingdressAddToFavourites::where('dress_id',$data['wedProducts']->id)->where('status','1')->count();
      ////// For next & Previous buttons......
      $data['productNum1'] = WeddingdressProduct::where('id','<',$data['wedProducts']->id)->where('type_id','1')->where('status','1')->count();
      $data['productNum2'] = WeddingdressProduct::where('designer_id',$data['designerData']->id)->where('type_id','1')->where('status','1')->count();
      $data['prevProduct'] = WeddingdressProduct::select('slug')->where('id','<',$data['wedProducts']->id)->where('type_id','1')->where('status','1')->orderBy('id','DESC')->first();
      $data['nextProduct'] = WeddingdressProduct::select('slug')->where('id','>',$data['wedProducts']->id)->where('type_id','1')->where('status','1')->orderBy('id','ASC')->first();
      return view('wedding_dresses.designer_dress_details',['pageData' => $page, 'data' => $data]);
   }

   public function party_index(Request $request)
   {
      $user_id = @Auth::user()->id;
      $type = $request->type ? : '2';
      $data['type'] = $type;
      $length = $request->length ? : '';
      $data['length'] = $length;
      $season = $request->season ? : '';
      $data['season'] = $season;
      $designer = $request->designer ? : '';
      $data['designer'] = $designer;
      $data['designer_name'] = '';
      if($designer) {
         $getDesignerName = WeddingdressDesigner::where('id',$designer)->where('status','1')->first();
         $data['designer_name'] = $getDesignerName->name;
      }
      $page = Page::where('id', 24)->first(); /// for Bridesmaid Dresses
      $data['wedDesigner'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->limit(15)->get();
      $data['wedDesignerCount'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->with('productData')->withCount('productData')->get();
      $data['wedProductLength'] = WeddingdressProduct::select('length',DB::raw('COUNT(length) as product_count'))->where('type_id',$type)->where('status','1')->groupBy('length')->get();
      $data['wedProductYears'] = WeddingdressProduct::select('*',DB::raw('COUNT(season_year) as product_count'))->where('type_id',$type)->where('status','1')->orderBy('season_year','DESC')->groupBy('season_year')->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $wedProductCount = WeddingdressProduct::where('type_id',$type);
                        if($length) {   $wedProductCount->where('length',$length); }
                        if($season) {   $wedProductCount->where('season_year',$season); }
                        if($designer) { $wedProductCount->where('designer_id',$designer); }
      $data['wedProductCount'] = $wedProductCount->where('status','1')->get();
      $wedProducts = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('type_id',$type);
                     if($length) {     $wedProducts->where('length',$length); }
                     if($season) {     $wedProducts->where('season_year',$season); }
                     if($designer) {   $wedProducts->where('designer_id',$designer); }
      $data['wedProducts'] = $wedProducts->where('status','1')->orderBy('is_top','DESC')->orderBy('season_year','DESC')->paginate(20);
      return view('wedding_dresses.party_dresses',['pageData' => $page, 'data' => $data]);
   }

   public function get_party_designers(Request $request, $d_slug=null)
   {
      $user_id = @Auth::user()->id;
      $type = $request->type ? : '2';
      $data['type'] = $type;
      $length = $request->length ? : '';
      $data['length'] = $length;
      $season = $request->season ? : '';
      $data['season'] = $season;
      $collection = $request->collection ? : '';
      $data['collection'] = $collection;
      $designer = $request->designer ? : '';
      $data['designer'] = $designer;
      $page = Page::where('id', 24)->first(); /// for Bridesmaid Dressess
      $data['wedDesigner'] = WeddingdressDesigner::where('type_id',$type)->where('status','1')->get();
      $data['designerData'] = WeddingdressDesigner::where('slug',$d_slug)->where('type_id',$type)->where('status','1')->with('productData')->withCount('productData')->first();
      $data['wedProductLength'] = WeddingdressProduct::select('length')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->groupBy('length')->get();
      $data['wedProductYears'] = WeddingdressProduct::select('*',DB::raw('COUNT(season_year) as product_count'))->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->orderBy('season_year','DESC')->groupBy('season_year')->get();
      $data['wedProductCollection'] = WeddingdressProduct::select('*',DB::raw('COUNT(collection_id) as product_count'))->with('collectionData')->where('designer_id',$data['designerData']->id)->where('type_id',$type)->where('status','1')->where('collection_id','!=','')->orderBy('season_year','DESC')->groupBy('collection_id','season_year')->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $wedProducts = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('designer_id',$data['designerData']->id)->where('type_id',$type);
                     if($length) {     $wedProducts->where('length',$length); }
                     if($season) {     $wedProducts->where('season_year',$season); }
                     if($collection) { $wedProducts->where('collection_id',$collection); }
      $data['wedProducts'] = $wedProducts->where('status','1')->orderBy('is_top','DESC')->orderBy('season_year','DESC')->paginate(20);
      return view('wedding_dresses.party_dresses_designer',['pageData' => $page, 'data' => $data]);
   }

   public function get_party_designers_product($d_slug=null, $p_slug=null)
   {
      $user_id = @Auth::user()->id;
      $page = Page::where('id', 24)->first(); /// for Bridesmaid Dressess
      $data['designerData'] = WeddingdressDesigner::where('slug',$d_slug)->where('type_id','2')->where('status','1')->with('productData')->withCount('productData')->first();
      $data['wedProducts'] = WeddingdressProduct::with('imageData','designerData','collectionData','necklineData','silhouetteData')->where('designer_id',$data['designerData']->id)->where('slug',$p_slug)->where('type_id','2')->where('status','1')->first();
      $data['wedMoreProducts'] = WeddingdressProduct::with('imageData')->where('designer_id',$data['designerData']->id)->where('id','!=',$data['wedProducts']->id)->where('type_id','2')->where('status','1')->limit(6)->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      $data['favouritesDressCount'] = WeddingdressAddToFavourites::where('dress_id',$data['wedProducts']->id)->where('status','1')->count();
      return view('wedding_dresses.designer_dress_details',['pageData' => $page, 'data' => $data]);
   }

   public function all_designers(Request $request)
   {
      $user_id = @Auth::user()->id;
      if($request->type == 1) {
         $page = Page::where('id', 23)->first();
      } elseif($request->type == 2) {
         $page = Page::where('id', 24)->first();
      } else {
         return back();
      }
      $data['designerData'] = WeddingdressDesigner::where('type_id',$request->type)->where('status','1')->get();
      $data['addToFavourites'] = WeddingdressAddToFavourites::where('user_id',$user_id)->where('status','1')->get();
      return view('wedding_dresses.all_designers',['pageData' => $page, 'data' => $data]);
   }

   public function add_to_quiz($quizArr=null, $idx=null)
   {
      $nxtPro = WeddingdressProduct::with('imageData','designerData')->where('type_id','1')->whereNotIn('id',[$quizArr])->inRandomOrder()->first();
      $htmls = "<input type='hidden' name='quizArr[]' value='".$nxtPro->id."'><figure><img class='dressQuizContent__image app-dress-quiz-content-item-img animated' src='".url('/public/weddingdresses/products').'/'.$nxtPro->imageData[0]->image."' data-index='0' data-url='".url('wedding-dress').'/'.$nxtPro->designerData->slug.'/'.$nxtPro->slug."'><figcaption class='dressQuizContent__actions'><i class='svgIcon svgIcon__timesCircle app-dress-quiz-icon-dislike dressQuizContent__action dressQuizContent__action--dislike' data-id='".@$idx."'><svg viewBox='0 0 92 92'><path d='M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm17.6 60.1c1 1 1 2.6 0 3.5-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7L46 49.5 31.9 63.6c-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7c-1-1-1-2.6 0-3.5L42.5 46 28.4 31.9c-1-1-1-2.6 0-3.5 1-1 2.6-1 3.5 0L46 42.5l14.1-14.1c1-1 2.6-1 3.5 0 1 1 1 2.6 0 3.5L49.5 46l14.1 14.1z'></path></svg></i><i class='svgIcon svgIcon__checkCircle app-dress-quiz-icon-like dressQuizContent__action dressQuizContent__action--like' data-id='".@$idx."' data-proId='".$nxtPro->id."'><svg viewBox='0 0 92 92'><path d='M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm20.1 36.3L45 59.7c-.5.6-1.3 1-2.1 1h-.1c-.8 0-1.5-.3-2.1-.9L26 45.3c-1.2-1.2-1.2-3.1 0-4.2 1.2-1.2 3.1-1.2 4.2 0l12.4 12.3 19.1-21c1.1-1.2 3-1.3 4.2-.2 1.3 1 1.4 2.9.2 4.1z'></path></svg></i></figcaption></figure>";
      return $htmls;
   }

   public function remove_to_quiz($quizArr=null, $idx=null)
   {
      $nxtPro = WeddingdressProduct::with('imageData','designerData')->where('type_id','1')->whereNotIn('id',[$quizArr])->inRandomOrder()->first();
      $htmls = "<input type='hidden' name='quizArr[]' value='".$nxtPro->id."'><figure><img class='dressQuizContent__image app-dress-quiz-content-item-img animated' src='".url('/public/weddingdresses/products').'/'.$nxtPro->imageData[0]->image."' data-index='0' data-url='".url('wedding-dress').'/'.$nxtPro->designerData->slug.'/'.$nxtPro->slug."'><figcaption class='dressQuizContent__actions'><i class='svgIcon svgIcon__timesCircle app-dress-quiz-icon-dislike dressQuizContent__action dressQuizContent__action--dislike' data-id='".$idx."'><svg viewBox='0 0 92 92'><path d='M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm17.6 60.1c1 1 1 2.6 0 3.5-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7L46 49.5 31.9 63.6c-.5.5-1.1.7-1.8.7s-1.3-.2-1.8-.7c-1-1-1-2.6 0-3.5L42.5 46 28.4 31.9c-1-1-1-2.6 0-3.5 1-1 2.6-1 3.5 0L46 42.5l14.1-14.1c1-1 2.6-1 3.5 0 1 1 1 2.6 0 3.5L49.5 46l14.1 14.1z'></path></svg></i><i class='svgIcon svgIcon__checkCircle app-dress-quiz-icon-like dressQuizContent__action dressQuizContent__action--like' data-id='".$idx."'><svg viewBox='0 0 92 92'><path d='M46 0C20.6 0 0 20.6 0 46s20.6 46 46 46 46-20.6 46-46S71.4 0 46 0zm20.1 36.3L45 59.7c-.5.6-1.3 1-2.1 1h-.1c-.8 0-1.5-.3-2.1-.9L26 45.3c-1.2-1.2-1.2-3.1 0-4.2 1.2-1.2 3.1-1.2 4.2 0l12.4 12.3 19.1-21c1.1-1.2 3-1.3 4.2-.2 1.3 1 1.4 2.9.2 4.1z'></path></svg></i></figcaption></figure>";
      return $htmls;
   }

   public function get_search_filters($quizArr=null)
   {
   	$defIdArr = array();
   	$qzarr = explode(',',$quizArr);
   	for($nm = 1; $nm < count($qzarr); $nm++) {
   		$defIds = explode('=',$qzarr[$nm]);
   		if(!in_array($defIds[1],$defIdArr)) {
   			$defIdArr[] = $defIds[1];
   		}
   	}
   	$lengthArr = array();
   	$necklineArr = array();
   	$silhouetteArr = array();
   	$searchPro = WeddingdressProduct::where('type_id','1')->whereIn('id',$defIdArr)->get();
   	foreach($searchPro as $sp) {
	   	$lengthArr[] = $sp->length;
	   	$necklineArr[] = $sp->neckline_type;
	   	$silhouetteArr[] = $sp->silhouette_type;
   	}
   	////// Get Length Value......
   	$newLengthArr = array_count_values($lengthArr);
   	arsort($newLengthArr); // $lenOccurences = reset($newLengthArr); ///count of common values
		$len_key_val = key($newLengthArr);
		if($len_key_val == 1) {
			$lengthType = 'Short';
		} else if($len_key_val == 2) {
			$lengthType = 'Long';
		} else if($len_key_val == 3) {
			$lengthType = 'Medium';
		}
   	////// Get Neckline Value......
   	$newNecklineArr = array_count_values($necklineArr);
   	arsort($newNecklineArr); // $neckOccurences = reset($newNecklineArr); ///count of common values
		$neck_key_val = key($newNecklineArr);
		$neckData = WeddingdressTypes::where('id',$neck_key_val)->first();
   	////// Get Silhouette Value......
   	$newSilhouetteArr = array_count_values($silhouetteArr);
   	arsort($newSilhouetteArr); // $silOccurences = reset($newSilhouetteArr); ///count of common values
		$sil_key_val = key($newSilhouetteArr);
		$silhData = WeddingdressTypes::where('id',$sil_key_val)->first();
		$htmls = "<span class='app-dress-tags-filter dressQuizContent__resultTag' data-name='silhouette' data-id='".$silhData->id."'>".$silhData->child_name."<i class='icon icon-grey-times-small icon-right'></i></span><span class='app-dress-tags-filter dressQuizContent__resultTag' data-name='neckline' data-id='".$neckData->id."'>".$neckData->child_name."<i class='icon icon-grey-times-small icon-right'></i></span><span class='app-dress-tags-filter dressQuizContent__resultTag' data-name='length' data-id='".$len_key_val."'>".$lengthType."<i class='icon icon-grey-times-small icon-right'></i></span>";
		echo $htmls;
   }

   public function add_to_favourites($idx=null)
   {
      $user_id = @Auth::user()->id;
      if($user_id) {
         $status = '1';
         $exIdx = explode('_',$idx);
         $dress_id = $exIdx[1];
         $designer_id = $exIdx[0];
         $addToFav = WeddingdressAddToFavourites::where('user_id',$user_id)->where('designer_id',$designer_id)->where('dress_id',$dress_id)->first();
         if(@$addToFav->id) {
            if($addToFav->status == 0) {
               $status = '1';
            } else {
               $status = '0';
            }
            $addToFavs = WeddingdressAddToFavourites::find($addToFav->id);
         } else {
            $addToFavs = new WeddingdressAddToFavourites;
         }
         $addToFavs->user_id     = $user_id;
         $addToFavs->designer_id = $designer_id;
         $addToFavs->dress_id    = $dress_id;
         $addToFavs->status      = $status;
         $addToFavs->save();
         if($addToFavs->id) {
            echo 'done';
         }
      } else {
         return url('/login');
      }
   }
}
?>