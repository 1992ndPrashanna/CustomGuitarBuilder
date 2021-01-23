<?php

namespace App\Http\Controllers;

use App\Models\PickupPosition;
use Illuminate\Http\Request;

class PickupPositionController extends Controller
{
    public function index(){
        $pickup_positions = PickupPosition::latest()->paginate(5);
        return view('admin.products.options.pickupposition',compact('pickup_positions'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:100'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Please enter pickup position!'

        ]);

        $pickup_position= new PickupPosition;
        $pickup_position->type =ucwords(strtolower($request->type));
        $pickup_position->description = $request->description;

        $pickup_position->save();
        return Redirect()->back()->with('success','Pickup Position Added Successfully!');
    }

    public function edit($id){
        $update = PickupPosition::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','position');
    }

    public function update(Request $request,$id){
        $update_object = PickupPosition::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description
        ]);
        return Redirect()->route('pickups.position')->with('success','Pickup Type Updated Successfully!');
    }

    public function trash($id){
        if (PickupPosition::onlyTrashed()->find($id)){
            $destory = PickupPosition::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        $trash = PickupPosition::find($id)->delete();
        return Redirect()->back()->with('success','Pickup type sent to trash!');
    }

    
    public function restore($id){
        $restore= PickupPosition::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup position type restored!');

    }


    public static function getProductName(){
        $getName=new PickupPosition();
        return class_basename($getName);
    }
}
