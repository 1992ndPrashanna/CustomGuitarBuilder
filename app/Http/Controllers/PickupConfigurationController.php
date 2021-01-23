<?php

namespace App\Http\Controllers;

use App\Models\PickupConfiguration;
use Illuminate\Http\Request;

class PickupConfigurationController extends Controller
{
    public function index(){
        $all_data=PickupConfiguration::latest()->paginate(5);
        $option_name="Pickup Configuration";
        $info_array=['pupconfig.create','pickup configuration',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:pickup_configurations'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new PickupConfiguration();
        $create->type = strtoupper($request->type);
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=PickupConfiguration::find($id);
        $option_name="Pickup Configuration";
        $type="pickup configuration";
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
        
        $update=PickupConfiguration::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.pupconfig')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = PickupConfiguration::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
