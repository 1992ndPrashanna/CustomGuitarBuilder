<?php

namespace App\Http\Controllers;

use App\Models\ActivePassive;
use Illuminate\Http\Request;

class PickupActiveController extends Controller
{
    public function index(){
        $active_passives=ActivePassive::latest()->paginate(5);
        $trash = ActivePassive::onlyTrashed()->latest()->paginate(5);
        return view('admin.products.options.pickupactivepassive',compact('active_passives','trash'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:30'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Please enter active or passive pickup!'
            
        ]);

        $active_passive= new ActivePassive;
        $active_passive->type = ucwords(strtolower($request->type));
        $active_passive->description = $request->description;

        $active_passive->save();
        return Redirect()->back()->with('success','Pickup Active/Passive Added Successfully!');
    }

    public function edit($id){
        $update = ActivePassive::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','activepassive');
    }

    public function update(Request $request,$id){
        $update_object = ActivePassive::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description
        ]);
        return Redirect()->route('active.passive')->with('success','Pickup Active/Passive Updated Successfully!');
    }

    public function trash($id){
        if (ActivePassive::onlyTrashed()->find($id)){
            $destory = ActivePassive::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        $trash = ActivePassive::find($id)->delete();
        return Redirect()->back()->with('success','Pickup type sent to trash!');
    }

    public function restore($id){
        $restore= ActivePassive::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Active/Passive type restored!');

    }

    public static function getProductName(){
        $getName=new ActivePassive();
        return class_basename($getName);
    }



}
