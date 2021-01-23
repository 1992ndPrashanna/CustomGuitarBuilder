<?php

namespace App\Http\Controllers;

use App\Models\BridgeScale;
use Illuminate\Http\Request;

class BridgeScaleController extends Controller
{
    public function index(){
        $all_data=BridgeScale::latest()->paginate(5);
        $option_name="Bridge Scale";
        $info_array=['bridgescale.create','bridge scale',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:bridge_scales']
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new BridgeScale();
        $create->type = ucwords(strtolower($request->type));

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=BridgeScale::find($id);
        $option_name="Bridge Scale";
        $type="bridge scale";
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
        
        $update=BridgeScale::find($id)->update([
            "type"=>$request->type
        ]);

        return Redirect()->route('guitar.bridgescale')->with('success','Updated Successfully!');
    }


    public function delete($id){
        $destory = BridgeScale::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
