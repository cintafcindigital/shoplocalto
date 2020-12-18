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
use App\WeddingdressDesigner;
use App\WeddingdressCollections;
use App\WeddingdressProduct;
use App\WeddingdressProductImages;

class AdminWeddingdressController extends Controller
{

   /*
    * -------------------------------------------------------------
    * Working On Wedding Dresses Module
    * -------------------------------------------------------------
    */


   /*
   *
   *  Wedding Dress Type Function
   *
   */

   protected function index(Request $request)
   {
       $query = WeddingdressTypes::orderBy('id', 'asc');

        if ($request->input('search') != null) {
            $query->where('child_name', 'like', '%'.$request->input('search').'%');
        }

        $weddingdress = $query->get();

        return view('admin/weddingdress/type/list', [
            'weddingdress' => $weddingdress
        ]);
   }


   public function add_weddingdress_type() {

        return view('admin/weddingdress/type/add');
   }

   public function save_weddingdress_type(Request $request) {

       $catObj = new WeddingdressTypes;

         $this->validate($request, [
             'title' => 'required|string',
             'type' => 'required|string',
             'parent_cat' => 'required|string',
             'icon_class' => 'required|string',
         ],['title.required'=>'Title field is required.',
         'type.required' => 'Parent Type field is required.',
         'parent_cat.required' => 'Parent Category field is required.',
         'icon_class.required' => 'Icon class field is required.',]);

        $catObj->child_name = $request->input('title');
        $catObj->type_id = $request->input('type');
        $catObj->parent_name = $request->input('parent_cat');
        $catObj->class_name  = $request->input('icon_class');
        $catObj->save();

        return redirect('/admin/weddingdress')->with('success', 'Wedding Dresses Type Added Successfully.');

   }

   public function status_weddingdress($id,$status) {

      $faqObj = WeddingdressTypes::find($id);
      $faqObj->status = $status;
      $data = $faqObj->save();
      if($data){
       return redirect()->back()->with('success', 'Status has been updated.');
      }else{
       return redirect()->back()->with('success', 'Something went wrong. Please try again.');
      }
   }

   public function edit_weddingdress($id) {

      $catData = WeddingdressTypes::where('id', $id)->first()->toArray();
      return view('admin/weddingdress/type/edit', [
         'cat_data'=>$catData,
      ]);
   }

   public function update_weddingdress(Request $request) {

        $this->validate($request, [
             'title' => 'required|string',
             'type' => 'required|string',
             'parent_cat' => 'required|string',
             'icon_class' => 'required|string',
         ],['title.required'=>'Title field is required.',
         'type.required' => 'Parent Type field is required.',
         'parent_cat.required' => 'Parent Category field is required.',
         'icon_class.required' => 'Icon class field is required.',]);

         $catObj = WeddingdressTypes::find($request->input('cat_id'));
         $catObj->child_name = $request->input('title');
         $catObj->type_id = $request->input('type');
         $catObj->parent_name = $request->input('parent_cat');
         $catObj->class_name  = $request->input('icon_class');
         $data = $catObj->save();

        if($data){
          return redirect()->back()->with('success', 'Wedding Dresses type Updated Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function delete_weddingdress($id) {
      $catObj = WeddingdressTypes::find($id);
      $data = $catObj->delete();

      if($data){
         return redirect('admin/weddingdress')->with('success', 'Wedding Dresses type Deleted Successfully.');
      } else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
      }
    }


    /*
    *
    *    Wedding Dress Designer function 
    *
    */

    public function get_designer(Request $request) {

        $query = WeddingdressDesigner::orderBy('id', 'asc');

        if ($request->input('search') != null) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }

        $weddingdress = $query->get();

        return view('admin/weddingdress/designer/list', [
            'weddingdress' => $weddingdress
        ]);
    }

    public function add_designer() {

         return view('admin/weddingdress/designer/add');
    }

    public function save_weddingdress_designer(Request $request) {
        
         $this->validate($request, [
             'designer_name' => 'required|string',
             'type' => 'required|string',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ],['designer_name.required'=>'Designer name field is required.',
         'type.required' => 'Designer Type field is required.',
         'image.required' => 'Picture field is required.',]);

          // dd($request->all());

         $image = $request->file('image');
         $input['image'] = time().'.'.$image->getClientOriginalExtension();
         $destinationPath = public_path('/weddingdresses/designer');
         $image->move($destinationPath, $input['image']);

         $designerObj = new WeddingdressDesigner;

         $designerObj->name = $request->input('designer_name');
         $designerObj->type_id = $request->input('type');
         $designerObj->slug = str_slug($request->input('designer_name'));
         $designerObj->picture  = $input['image'];
         $designerObj->website_url  = $request->input('website_url');
         $designerObj->retailers_url  = $request->input('retailers_url');
         $designerObj->is_top  = $request->input('is_top');
         
         $data = $designerObj->save();

        if($data){
          return redirect()->back()->with('success', 'Designer Added Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }

    }

    public function status_weddingdress_designer($id, $status) {

        $designerObj = WeddingdressDesigner::find($id);
        $designerObj->status = $status;
        $data = $designerObj->save();
        if($data){
         return redirect()->back()->with('success', 'Status has been updated.');
        }else{
         return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function edit_weddingdress_designer($id) {

       $catData = WeddingdressDesigner::where('id', $id)->first()->toArray();
        return view('admin/weddingdress/designer/edit', [
           'cat_data'=>$catData,
        ]);

    }

    public function update_weddingdress_designer(Request $request) {

          $this->validate($request, [
             'designer_name' => 'required|string',
             'type' => 'required|string',
         ],['designer_name.required'=>'Designer name field is required.',
         'type.required' => 'Designer Type field is required.',
          ]);

          // dd($request->all());

          if($request->file('image') != NULL) {
             $image = $request->file('image');
             $input['image'] = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/weddingdresses/designer');
             $image->move($destinationPath, $input['image']);
          }

         $designerObj = WeddingdressDesigner::find($request->input('cat_id'));

         $designerObj->name = $request->input('designer_name');
         $designerObj->type_id = $request->input('type');
         $designerObj->slug = str_slug($request->input('designer_name'));

        if($request->file('image') != NULL) {
            $designerObj->picture  = $input['image'];
        }

        $designerObj->website_url  = $request->input('website_url');
        $designerObj->retailers_url  = $request->input('retailers_url');
        $designerObj->is_top  = $request->input('is_top');
        
        $data = $designerObj->save();

        if($data){
          return redirect()->back()->with('success', 'Designer updated Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }

    }

    public function delete_weddingdress_designer($id) {

      $catObj = WeddingdressDesigner::find($id);
      $data = $catObj->delete();

      if($data){
         return redirect('admin/weddingdress-designer')->with('success', 'Wedding Dresses designer Deleted Successfully.');
      } else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
      }

    }

    /*
    *
    * Weddingdress collection section
    *
    */

    public function get_collections(Request $request) {

        $query = WeddingdressCollections::orderBy('id', 'asc');

        if ($request->input('search') != null) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }

        $weddingcollections = $query->get();

        return view('admin/weddingdress/collection/list', [
            'weddingcollections' => $weddingcollections
        ]);
    }

    public function add_collections() {

      return view('admin/weddingdress/collection/add');
    }

    public function save_weddingdress_collections(request $request) {

          $this->validate($request, [
             'collection_name' => 'required|string',
             'collection_year' => 'required|digits:4|integer|min:2015|max:'.(date('Y')+1),
         ],['collection_name.required'=>'Collection name field is required.',
         'collection_year.required' => 'Collection year field is required.',]);

          // dd($request->all());

         $designerObj = new WeddingdressCollections;
         $designerObj->name = $request->input('collection_name');
         $designerObj->year = $request->input('collection_year');
         
         $data = $designerObj->save();

        if($data){
          return redirect()->back()->with('success', 'Collection Added Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function status_weddingdress_collections($id, $status) {
        $faqObj = WeddingdressCollections::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data){
         return redirect()->back()->with('success', 'Status has been updated.');
        }else{
         return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function edit_weddingdress_collections($id) {

        $collectionData = WeddingdressCollections::where('id', $id)->first()->toArray();
        return view('admin/weddingdress/collection/edit', [
           'collectionData'=>$collectionData,
        ]);
    }

    public function update_weddingdress_collections(Request $request) {

       $this->validate($request, [
             'collection_name' => 'required|string',
             'collection_year' => 'required|digits:4|integer|min:2015|max:'.(date('Y')+1),
         ],['collection_name.required'=>'Collection name field is required.',
         'collection_year.required' => 'Collection year field is required.',]);

          // dd($request->all());

         $designerObj = WeddingdressCollections::find($request->collection_id);
         $designerObj->name = $request->input('collection_name');
         $designerObj->year = $request->input('collection_year');
         
         $data = $designerObj->save();

        if($data){
          return redirect()->back()->with('success', 'Collection Updated Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    /*
    *
    * Wedding Product Functions
    *
    */

    public function get_products(Request $request) {

        $query = WeddingdressProduct::orderBy('id', 'asc');

        if ($request->input('search') != null) {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }

        $WeddingdressProduct = $query->get();

        // echo "<pre>";
        // print_r($WeddingdressProduct);
        // die();

        return view('admin/weddingdress/products/list', [
            'WeddingdressProduct' => $WeddingdressProduct
        ]);
    }

    public function add_products() {

        $data = array();
        $data['collection'] = WeddingdressCollections::where('status', '1')->get();
        $data['neckline'] = WeddingdressTypes::where('parent_name', 'neckline')->get();
        $data['silhouette'] = WeddingdressTypes::where('parent_name', 'silhouette')->get();

        return view('admin/weddingdress/products/add', ['data' => $data]);
    }

    public function get_designerByajax($id) {

      $html = '<option value="">-- Select Desinger  --</option>';

      if($id != '') {
        $designerbyType = WeddingdressDesigner::where('type_id', $id)->get();
        foreach ($designerbyType as $key => $designertype) {
          $html .= '<option value="'.$designertype->id.'">'.$designertype->name.'</option>';
        }
      }
      return $html;
    }


    public function save_weddingdress_products(Request $request) {
     // dd($request->all());

       $this->validate($request, [
           'product_name' => 'required|string',
           'product_code' => 'required|string',
           'type' => 'required|string',
           'dress_designer' => 'required|string',
           'silhouette_type' => 'required|string',
           'neckline_type' => 'required|string',
           'season_year' => 'required|string',
           'collection_id' => 'required|string',
           'image' => 'required|max:2048',
       ],
       [  'product_name.required'=>'Product Name field is required.',
          'product_code.required' => 'Product Code field is required.',
          'type.required' => 'Wedding Dresses type field is required.',
          'dress_designer.required' => 'Wedding Designer field is required.',
          'silhouette_type.required' => 'Silhouette category field is required.',
          'neckline_type.required' => 'Neckline category field is required.',
          'season_year.required' => 'Season Year field is required.',
          'collection_id.required' => 'Collection field is required.',
          'image.required' => 'Please select at least one image',
       ]);

       $projectObj = new WeddingdressProduct;
       $projectObj->type_id = $request->input('type');
       $projectObj->designer_id = $request->input('dress_designer');
       $projectObj->name = $request->input('product_name');
       $projectObj->slug = str_slug($request->input('product_name'));
       $projectObj->code = $request->input('product_code');
       $projectObj->silhouette_type = $request->input('silhouette_type');
       $projectObj->neckline_type = $request->input('neckline_type');
       $projectObj->length = $request->input('dress_length');
       $projectObj->season_year = $request->input('season_year');
       $projectObj->collection_id = $request->input('collection_id');
       $projectObj->is_top = $request->input('is_top');
       $projectObj->save();

      if($projectObj->id) {

          $imagesArray = $request->file('image');
          

          foreach ($imagesArray as $key => $image) {
              $filename = $image->getClientOriginalName();
              $input['image'] = $filename.time().'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/weddingdresses/products');
              $image->move($destinationPath, $input['image']);

              $imageObj = new WeddingdressProductImages;
              $imageObj->product_id = $projectObj->id;
              $imageObj->image = $input['image'];
              $imageObj->save();
          }
      }

      if($projectObj->id){
          return redirect()->back()->with('success', 'Wedding Dresses Product Added Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
      }

    }

    public function status_weddingdress_products($id, $status) {
        $faqObj = WeddingdressProduct::find($id);
        $faqObj->status = $status;
        $data = $faqObj->save();
        if($data){
         return redirect()->back()->with('success', 'Status has been updated.');
        }else{
         return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    public function edit_weddingdress_products($id) {

      $productsData = WeddingdressProduct::with('imageData')->where('id', $id)->first()->toArray();

      $productDesigner = WeddingdressDesigner::where('type_id', $productsData['type_id'])->get();

      $silhouetteData =  WeddingdressTypes::where('parent_name', 'silhouette')->get();

      $necklineData = WeddingdressTypes::where('parent_name', 'neckline')->get();

      $collectionData = WeddingdressCollections::where('status', '1')->get();

      return view('admin/weddingdress/products/edit', [
        'productsData' => $productsData,
        'productDesigner' => $productDesigner,
        'silhouetteData' => $silhouetteData,
        'necklineData' => $necklineData,
        'collectionData' => $collectionData
      ]);
    }

    public function delete_productImages($id) {
        if($id) {
          $objImage = WeddingdressProductImages::find($id);
          $objImage->delete();
          return $id;
        }
    }

    public function update_weddingdress_products(Request $request) {

        $this->validate($request, [
           'product_name' => 'required|string',
           'product_code' => 'required|string',
           'type' => 'required|string',
           'dress_designer' => 'required|string',
           'silhouette_type' => 'required|string',
           'neckline_type' => 'required|string',
           'season_year' => 'required|string',
           'collection_id' => 'required|string',
           'image' => 'required|max:2048',
       ],
       [  'product_name.required'=>'Product Name field is required.',
          'product_code.required' => 'Product Code field is required.',
          'type.required' => 'Wedding Dresses type field is required.',
          'dress_designer.required' => 'Wedding Designer field is required.',
          'silhouette_type.required' => 'Silhouette category field is required.',
          'neckline_type.required' => 'Neckline category field is required.',
          'season_year.required' => 'Season Year field is required.',
          'collection_id.required' => 'Collection field is required.',
          'image.required' => 'Please select at least one image',
       ]);

       $projectObj = WeddingdressProduct::find($request->product_id);
       $projectObj->type_id = $request->input('type');
       $projectObj->designer_id = $request->input('dress_designer');
       $projectObj->name = $request->input('product_name');
       $projectObj->slug = str_slug($request->input('product_name'));
       $projectObj->code = $request->input('product_code');
       $projectObj->silhouette_type = $request->input('silhouette_type');
       $projectObj->neckline_type = $request->input('neckline_type');
       $projectObj->length = $request->input('dress_length');
       $projectObj->season_year = $request->input('season_year');
       $projectObj->collection_id = $request->input('collection_id');
       $projectObj->is_top = $request->input('is_top');
       $projectObj->save();

      if($projectObj->id) {

          $imagesArray = $request->file('image');
          
          foreach ($imagesArray as $key => $image) {
              $filename = $image->getClientOriginalName();
              $input['image'] = $filename.time().'.'.$image->getClientOriginalExtension();
              $destinationPath = public_path('/weddingdresses/products');
              $image->move($destinationPath, $input['image']);

              $imageObj = new WeddingdressProductImages;
              $imageObj->product_id = $projectObj->id;
              $imageObj->image = $input['image'];
              $imageObj->save();
          }
      }

      if($projectObj->id){
          return redirect()->back()->with('success', 'Wedding Dresses Product Added Successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
      }
    } 

    public function delete_weddingdress_products($id) {
        $catObj = WeddingdressProduct::find($id);
        $data = $catObj->delete();

        if($data){
           return redirect('admin/weddingdress-products')->with('success', 'Product Deleted Successfully.');
        } else{
            return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

}



?>