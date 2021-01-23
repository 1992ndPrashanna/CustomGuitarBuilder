<?php

namespace App\Http\Controllers;

use App\Models\MagnetMaterial;
use Illuminate\Http\Request;

class PickupMagnetController extends Controller
{
    public function index(){
        $magnet_materials=MagnetMaterial::latest()->paginate(5);
        return view('admin.products.options.pickupmagnet',compact('magnet_materials'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!'
            
        ]);

        $magnet_material= new MagnetMaterial;
        $magnet_material->type = ucwords(strtolower($request->type));
        $magnet_material->description = $request->description;

        $magnet_material->save();
        return Redirect()->back()->with('success','Pickup Covering Added Successfully!');
    }

    public function edit($id){
        $update = MagnetMaterial::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','pickupmagnet');
    }

    public function update(Request $request,$id){
        $update_object = MagnetMaterial::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description
        ]);
        return Redirect()->route('pickups.magnets')->with('success','Pickup Magnet Updated Successfully!');
    }
    
    public function trash($id){
        if (MagnetMaterial::onlyTrashed()->find($id)){
            $destory = MagnetMaterial::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        $trash = MagnetMaterial::find($id)->delete();
        return Redirect()->back()->with('success','Pickup type sent to trash!');
    }

    
    public function restore($id){
        $restore= MagnetMaterial::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup magnet type restored!');

    }

    public static function getProductName(){
        $getName=new MagnetMaterial();
        return class_basename($getName);
    }
}
