<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\District;
use App\Community;

class AdminLocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // die(Hash::make("ashiq123"));
        $this->middleware('auth:admin');
        
    }
    public function districts()
    {
        $districts=District::get();
        return view('admin/locations/districts',compact('districts'));
    }
    public function communities()
    {
        $communities=Community::select('locations.id','locations.name','districts.name AS district','locations.image')->with('children')->join('districts','districts.id','locations.district_id')->get();
        return view('admin/locations/communities',compact('communities'));
    }
    public function add_community()
    {
        $districts=District::get();
        return view('admin/locations/add-community',compact('districts'));
    }
    public function save_community(Request $request,$id=null)
    {
       $this->validate($request, [
            'name'   => 'required',
            'description' => 'required',
            
            'district'=>'required',
            // 'latitude'=>'required',
            // 'longitude'=>'required'

        ]);
       if($id)
       {
        $locations=Community::findOrFail($id);
        $message="Updated";
        $message1="Updation";
       } 
       else
       {
        $locations=new Community();
        $message="Added";
        $message1="Insertion";
       }
     
     $locations->name=$request->name;
     $locations->slug=str_slug($request->name, '-');
     $locations->description=$request->description;
     $locations->district_id=$request->district;
     $locations->display_home=$request->is_home;
     
     if(!empty($request->input('image')) && strlen($request->input('image')) > 6) {
            $featuredImage = $request->input('image');

            if(preg_match('/data:image/', $featuredImage)) {
                list($type, $featuredImage) = explode(';', $featuredImage);
                list(, $featuredImage)      = explode(',', $featuredImage);
                $featuredImage = base64_decode($featuredImage);
                $image_name = time() . '_location_'.mt_rand(1000,9999) . '.png';
                $path = public_path() . '\locations';
                if (!File::exists($path)){
                    File::makeDirectory($path, $mode = 0777, true, true);
                }
                file_put_contents($path.'/'.$image_name, $featuredImage);
            
            }
            if($locations->image)
             {
                unlink('locations/'.$locations->image);
             }
             $locations->image=$image_name;
             
        }
   $m=$this->autocomplete_latlong($request);
  
     $locations->latitude=$m[0];
     $locations->longitude=$m[1];
     try
     {
     $locations->save();
     return redirect('admin/communities')->with('success',"Community $message successfully !!");
     }
     catch(\Exception $e)
     {
     return redirect('admin/communities')->with('error',"Error in $message1 !!");
     }


    }
    public function edit_community($id)
    {
        $districts=District::get();
        $communities=Community::where('id',$id)->first();
        
        return view('admin/locations/add-community',compact('districts','communities'));
    }
    public function delete_community($id)
    {
        $locations=Community::findOrFail($id);
        @unlink('locations/'.$locations->image);
        $locations->delete();
        return redirect('admin/communities')->with('success','Community Deleted successfully');

    }
    public function autocomplete_latlong(Request $request)
    {
        $address = '';
        $evCity = $request->name;
        $evAddress = 'Toronto,Ontario';
        if($evAddress != '' && $evCity != '') {
            $address = $evAddress.', '.$evCity;
        } elseif($evCity != '') {
            $address = $evCity;
        }
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&key=".env('GMAP_API_KEY_NEW');
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        if(count($resp['results']) > 0 && $resp['status'] == 'OK') {
            $lat = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $lng = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            if($lat && $lng && $formatted_address) {
                $data_arr = array();
                array_push($data_arr,$lat,$lng,$formatted_address);
                return $data_arr;
            } else {
                return false;
            }
        } else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }
    

}