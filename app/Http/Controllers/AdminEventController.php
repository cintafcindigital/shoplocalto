<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use View;
use DB;
use File;
use App\VendorEvent;

class AdminEventController extends Controller
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
    public function index()
    {
        $events=VendorEvent::get();
        
        return view('admin/events',compact('events'));
    }
    public function addmenu()
    {
        $menus=Menu::where('level',0)->get();
        return view('admin/menu/add',compact('menus'));
    }
    public function savemenu(Request $request,$id=null)
    {
        
           $this->validate($request, [
            'name'   => 'required',
            'level'  =>'required|integer',
            'displayorder' => 'required|integer',
            'link'=>'required'
           ]);
           if($id)
           {
            $menu=Menu::find($id);
            $message="Updated";
            $message1="Updation";
           }
           else
           {
            $menu=new Menu;
            $message="Added";
            $message1="Insertion";
           }
           $menu->name=$request->name;
           $menu->parent_id=$request->parent_id;
           $menu->level=$request->level;
           $menu->display_order=$request->displayorder;
           $menu->link=$request->link;
           $menu->status=$request->status;
           try
           {
            $menu->save();
            return redirect('admin/manage-menus')->with('success',"Menu $message Successfully");
           }
           catch(\Exception $e)
           {
           return redirect('admin/manage-menus')->with('error',"Error in $message1");
           }
           
       

    }
    public function editmenu($id)
    {
        $menus=Menu::where('level',0)->where('id','!=',$id)->get();
        $menu=Menu::where('id',$id)->first();
        return view('admin/menu/add',compact('menus','menu'));
    }
    public function deletemenu($id)
    {
        try
        {
            Menu::where('id',$id)->delete();
            return redirect('admin/manage-menus')->with('success',"Menu Deleted Successfully");
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',"Error in Deletion");
        }
        
    }
}