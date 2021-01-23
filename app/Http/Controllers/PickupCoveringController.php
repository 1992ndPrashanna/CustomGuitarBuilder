<?php

namespace App\Http\Controllers;

use App\Models\PickupCovering;
use Illuminate\Http\Request;

class PickupCoveringController extends Controller
{
    public function index(){
        $pickup_coverings=PickupCovering::latest()->paginate(5);
        return view('admin.products.options.pickupcovering',compact('pickup_coverings'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:30'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Please enter pickup position!'
            
        ]);

        $pickup_coverings= new PickupCovering;
        $pickup_coverings->type = ucwords(strtolower($request->type));
        $pickup_coverings->description = $request->description;

        $pickup_coverings->save();
        return Redirect()->back()->with('success','Pickup Covering Added Successfully!');
    }

    public function edit($id){
        $update = PickupCovering::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','covering');
    }

    public function update(Request $request,$id){
        $update_object = PickupCovering::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description
        ]);
        return Redirect()->route('pickups.coverings')->with('success','Pickup Covering Updated Successfully!');
    }

    public function trash($id){
        if (PickupCovering::onlyTrashed()->find($id)){
            $destory = PickupCovering::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        $trash = PickupCovering::find($id)->delete();
        return Redirect()->back()->with('success','Pickup type sent to trash!');
    }

    
    public function restore($id){
        $restore= PickupCovering::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup covering type restored!');

    }

    public static function getProductName(){
        $getName=new PickupCovering();
        return class_basename($getName);
    }
}
