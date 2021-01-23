<?php

namespace App\Http\Controllers;
use App\Models\PickupType;
use Illuminate\Http\Request;

class PickupTypeController extends Controller
{
    public function index(){
        $pickup_types= PickupType::latest()->paginate(5);
        return view('admin.products.options.pickuptype',compact('pickup_types'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => 'required|max:30',           
        ],
        //custom error messages
        [
            'type.required' => 'Please enter pickup type!'
        ]);

        $pickup_type= new PickupType;
        $pickup_type->type = ucwords(strtolower($request->type));
        $pickup_type->description = $request->description;

        $pickup_type->save();
        return Redirect()->back()->with('success','Pickup Type Added Successfully!');
    }

    public function edit($id){
        $update = PickupType::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','type');
    }

    public function update(Request $request,$id){
        $update_object = PickupType::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description
        ]);
        return Redirect()->route('pickups.type')->with('success','Pickup Type Updated Successfully!');
    }
    
    public function trash($id){
        if (PickupType::onlyTrashed()->find($id)){
            $destory = PickupType::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        $trash = PickupType::find($id)->delete();
        return Redirect()->back()->with('success','Pickup type sent to trash!');
    }

    
    public function restore($id){
        $restore= PickupType::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup type restored!');

    }

    //following function returns model name associated with controller
    public static function getProductName(){
        $getName=new PickupType();
        return class_basename($getName);
    }


}
