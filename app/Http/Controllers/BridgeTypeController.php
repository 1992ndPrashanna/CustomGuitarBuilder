<?php

namespace App\Http\Controllers;

use App\Models\BridgeType;
use Illuminate\Http\Request;

class BridgeTypeController extends Controller
{
    public function index(){
        $all_data=BridgeType::latest()->paginate(5);
        $option_name="Bridge";
        $info_array=['bridgetype.create','bridge type',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:bridge_types']
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new BridgeType();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function delete($id){
        $destory = BridgeType::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
    
}
