<?php

namespace App\Http\Controllers;

use App\Models\PickupSelector;
use Illuminate\Http\Request;

class PickupSelectorController extends Controller
{
    public function index(){
        $all_data=PickupSelector::latest()->paginate(5);
        $option_name="Pickup Selector Switch";
        $info_array=['pickupselector.create','pickup selector',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:scale_lengths'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new PickupSelector();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=PickupSelector::find($id);
        $option_name="Pickup Selector";
        $type="pickup selector";
        $info_array=[$type,$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'type' => ['required','max:50']
        ],
        [
            'type.required' => 'Type cannot be empty'
        ]);
        
        $update=PickupSelector::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.scalelength')->with('success','Updated Successfully!');
    }


    public function delete($id){
        $destory = PickupSelector::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
