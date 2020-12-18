<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use File;
use DB;
use App\Category;
use App\Vendor;
use App\VendorCompany;
use App\VendorImage;
use App\CategoryImages;
use App\ImportVendor;
use App\VendorCategoryRelation;

class AdminVendorImport extends Controller
{
	var $fields;
    var $separator      = ';';
    var $enclosure      = '"';
    var $max_row_size   = 20480; //4096 old
	var $checkValues = ['Name','Business','Address','City','Postal Code','phone'];

	public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function importVendors()
    {
        $categories = Category::where("status",1)->where("parent_id",'!=',0)->get();
        return view('admin.vendors.importvendor',['categories' => $categories]);
    }
    public function importVendorsData(Request $request)
    {
    	if($request->has('validate') && $request->input('validate') == '1'){
	        $request->validate([
	            'vendor_file' => 'required'
	        ]);
	        if($request->hasFile('vendor_file'))
	        {
	    		set_time_limit(0);
	        	$file = $request->file('vendor_file');
	        	$name = time().'_'.rand(100,999).'.'.$file->getClientOriginalExtension();
	        	$file->move(public_path('/import/csv'),$name);
	        	$dataCheck = $this->parse_file(public_path('/import/csv').'/'.$name);
	        	// dd($dataCheck);
	        	$saveFileInfo = new ImportVendor;
	        	$saveFileInfo->csv = $name;
	        	$saveFileInfo->save();
	        	// session(['file_id' => $saveFileInfo->id]);
	        	if($dataCheck == false){
		        	return redirect('admin/import-vendors')->with('error','Sorry, invalid format !!');
	        	}
	        	// if($da)
	        	return redirect('admin/import-vendors')->with('success','Import file verified successfully. We can import '.count((array) $dataCheck) .' vendors to the system.')->with('store_id',$saveFileInfo->id);
	        }
    	}elseif($request->has('import') && $request->input('import') == '1'){
    		set_time_limit(0);
    		$request->validate([
	            'category' => 'required',
	            'description' => 'required|array|min:1'
	        ]);
	        $description = $request->description;
	        $checkImages = ImportVendor::where('category_id',$request->category);
	        $getImportCsv = ImportVendor::where('id',$request->store_id)->count();
	        $imagesCount = $checkImages->count();
	        $request->merge(['images_count' => $imagesCount,'csv_file' => $getImportCsv]);
	        $request->validate([
	            'images_count' => 'required|int|min:5',
	            'csv_file' => 'required|int|min:1'
	        ]);
	        $checkImages = $checkImages->get();
	        $getImportCsv = ImportVendor::where('id',$request->store_id)->first();
	        $data = $this->parse_file(public_path('/import/csv').'/'.$getImportCsv->csv);
	        // echo "<pre>";
	        $imageMove = 0;
	        $descriptionMove = 0;
	        foreach ($data as $key => $value) {
	        	// print_r($value);
	        	if(!empty(trim($value['Name']))){
		        	$vendor = new Vendor;
		        	$vendor->username = $this->createUsername(trim($value['Name']));
		        	$vendor->contact_person = trim($value['Name']);
		        	$vendor->telephone = str_replace('-','',$value['phone']);
		        	$vendor->step_completed = 4;
		        	$vendor->verified = 1;
		        	$vendor->freelisting = 'Yes';
		        	$vendor->status = 1;
		        	$vendor->password = Hash::make('vendor123');
		        	if(isset($description[$descriptionMove]))
		        		$notes = $description[$descriptionMove];
		        	else{
		        		$descriptionMove = 0;
		        		$notes = $description[$descriptionMove];
		        	}
		        	$vendor->business_description = $notes;
		        	$vendor->save();
		        	// sleep(2);
		        	// print_r($vendor);
	        		// die('smdks');
		        	if(isset($vendor->vendor_id)){
		        		// $category = Category::where('title','like','%'.$value['Service'].'%')->first();
		        		$category = Category::where('id','=',$request->category)->first();
		        		$relation = new VendorCategoryRelation;
		        		$relation->category_id = $category->id;
		        		$relation->vendor_id = $vendor->vendor_id;
		        		$relation->save();
		        		$vendorCompany = new VendorCompany;
		        		$vendorCompany->vendor_id = $vendor->vendor_id;
		        		$vendorCompany->country = 'Canada';
		        		if(isset($value['Province']) && !empty($value['Province']))
			        		$vendorCompany->province = $value['Province'];
		        		$vendorCompany->city = $value['City'];
		        		$vendorCompany->address = $value['Address'];
		        		$vendorCompany->postal_code = str_replace(' ','',$value['Postal Code']);
		        		$vendorCompany->business_name = $value['Business'];
		        		$vendorCompany->business_name_slug = $this->createSlug($vendorCompany->business_name);
		        		$vendorCompany->business_detail = $notes;
		        		$vendorCompany->business_address = $value['Address'];
		        		$vendorCompany->save();
			        	if(isset($checkImages[$imageMove]))
			        		$image = $checkImages[$imageMove]->image;
			        	else {
			        		$imageMove = 0;
			        		$image = $checkImages[$imageMove]->image;
			        	}
			        	// sleep(2);
			        	if(isset($image) && $image != ''){
			        		if (! File::exists(base_path('public/vendors/VENDOR_'.$vendor->vendor_id)))
				        		File::makeDirectory(base_path('public/vendors/VENDOR_'.$vendor->vendor_id, $mode = 0777, true, true));
				        	File::copy(base_path('public/import/'.$image),base_path('public/vendors/VENDOR_'.$vendor->vendor_id.'/'.$image));
				        	$vendorImage = new VendorImage;
				        	$vendorImage->vendor_id = $vendor->vendor_id;
				        	$vendorImage->image = $image;
				        	$vendorImage->vendor_folder = 'VENDOR_'.$vendor->vendor_id;
				        	$vendorImage->save();
				        	$imageMove++;
			        	}
		        	}
		        	$descriptionMove++;
	        	}
	        }
	        return redirect('admin/import-vendors')->with('success','Successfully imported vendors')->with('last','success');
    	}

        return redirect('admin/import-vendors')->with('success','Some');
    }
    public function createSlug($name)
	{
		$slug = str_slug($name,'-');
		try {
			// $post = VendorCompany::whereRaw(DB::raw("MATCH(business_name_slug) AGAINST (? IN BOOLEAN MODE)"),[$slug])->count();
			$post = VendorCompany::where("business_name_slug",'like','%'.$slug.'%')->count();
			$slug = $slug.($post > 0 ? ($post+1)."" : "");
		} catch (Exception $e) {
			$slug = str_slug($name,'-');
		}
		return $slug;
	}
	public function createUsername($name)
	{
		$slug = str_slug($name,'_');
		try {
			// $post = Vendor::whereRaw(DB::raw("MATCH(username) AGAINST (? IN BOOLEAN MODE)"),[$slug])->count();
			$post = Vendor::where('username','like','%'.$slug.'%')->count();
			$slug = $slug.($post > 0 ? (((int) $post)+1) : "");
		} catch (Exception $e) {
			$slug = str_slug($name,'_');
		}
		return $slug;
	}
    public function getCategoryImages(Request $request)
    {
        /*$categories = Category::where('status',1);
        $categories->where('parent_id',$request->category)->orWhere('id',$request->category);
        $categories = $categories->get()->toArray();
        $catIds = array_map(function($result){
            return $result['id'];
        },$categories);
        $categoryImages = CategoryImages::whereIn('cat_id',$catIds)->get();
        return $categoryImages;*/
        $currentUploadedFiles = ImportVendor::where('category_id',$request->category)->get();
        return $currentUploadedFiles;
    }
    public function deleteRandomImages(Request $request)
    {
    	$importData = ImportVendor::find($request->id);
    	$file_path = public_path('/import').'/'.$importData->image;
    	File::delete($file_path);
    	return ['status' => $importData->delete()];
    }
    public function uploadRandomImages(Request $request)
    {
    	$rules = [
    		'images' => 'required|array|min:1'
    	];
    	$validator = Validator::make($request->all(), $rules);
    	if($validator->passes())
    	{
    		$files = $request->file('images');
    		$urls = [];
    		if($request->hasFile('images'))
			{
			    foreach ($files as $file) {
			        $name = time().'_'.rand(100,999).'.'.$file->getClientOriginalExtension();
			        $file->move(public_path('/import'),$name);
			        // array_push($urls,asset('public/temp').'/'.$name);
			        $saveImportFile = new ImportVendor;
			        $saveImportFile->category_id = $request->category;
			        $saveImportFile->image = $name;
			        $saveImportFile->save();
			    }
			}
			/*if(session()->has('temp_images')){
				$urls_old = session('temp_images');
				session(['temp_images' => array_merge($urls_old,$urls)]);
			} else session(['temp_images' => $urls]);*/
			$getImages = ImportVendor::where('category_id',$request->category)->get()->toArray();
			$urls = array_map(function($result){
				return url('public/import').'/'.$result['image'];
			},$getImages);
    		return response()->json(['urls' => $urls]);
    	} else {
    		return response()->json([
                'message'   => $validation->errors()->all(),
                'class_name'  => 'alert-danger'
            ]);
    	}
    }
    function parse_file($p_Filepath)
    {
    	ini_set('max_execution_time', 0);
        $dns=array("8.8.8.8","8.8.4.4");
        //var_export (dns_get_record ( "host.name.tld" ,  DNS_ALL , $dns ));
        $file           = fopen($p_Filepath, 'r');
        $this->fields   = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
        $keys_values    = explode(',',$this->fields[0]);
        //print_r($this->fields);
        //die();

        $content    = array();
        $keys       = $this->escape_string($keys_values);
        $match 		= [];
        foreach ($keys as $key => $value) {
        	/*foreach ($keys as $key2 => $value2) {
        		if($value2 == $value)
        	}*/
        	if(in_array($value,$this->checkValues))
	        	array_push($match,1);
        }
        if(count($this->checkValues) != count($match))
        {
	        // print_r($match);
        	return false;
        }

        $i = 1;
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false )
        {
            if($row != null)
            {
                $values =   explode(',',$row[0]);
                // if(count($keys) == count($values))
                if(true)
                {
                    $arr        =   array();
                    $new_values =   array();
                    $new_values =   $this->escape_string($values);
                    for($j=0;$j<count($keys);$j++)
                    {
                        if($keys[$j] != "")
                        {
                            $arr[$keys[$j]] = $new_values[$j];
                        }
                    }

                    $content[$i] = $arr;
	                $i++;
                } /*else {
                	$content[$i] = count($values);
                }*/
            }
        }
        fclose($file);
        return $content;
    }

    function escape_string($data){
        $result = array();
        foreach($data as $row)
        {
            $result[] = str_replace('"', '',$row);
        }
        return $result;
    }
}
