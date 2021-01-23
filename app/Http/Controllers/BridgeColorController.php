<?php

namespace App\Http\Controllers;

use App\Models\BridgeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BridgeColorController extends Controller
{
    public function index(){
        $all_data=BridgeColor::latest()->paginate(5);
        $option_name="Bridge Color";
        $info_array=['bridgecolor.create','bridge color',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required','unique:bridge_colors','max:30']
            ],
            [
                'type.required'=>'Color cannot be empty!',
                'type.unique'=>'Color already exists!'
            ]
        );

        $create = new BridgeColor();
        $create->type=$request->type;

        $create->save();

        return Redirect()->route('guitar.bridgecolor')->with('success','Color added succesfully!');
    }

    public function edit($id){
        $edit=BridgeColor::find($id);
        $option_name="Bridge Color";
        $type="bridge color";
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
        
        $update=BridgeColor::find($id)->update([
            "type"=>$request->type
        ]);

        return Redirect()->route('guitar.bridgecolor')->with('success','Updated Successfully!');
    }
    

    public function delete($id){
        $destory = BridgeColor::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }



}
