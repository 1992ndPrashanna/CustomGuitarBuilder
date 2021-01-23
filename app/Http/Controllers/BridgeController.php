<?php

namespace App\Http\Controllers;

use App\Models\Bridge;
use App\Models\BridgeBrand;
use App\Models\BridgeColor;
use App\Models\BridgeScale;
use App\Models\BridgeType;
use Illuminate\Http\Request;

class BridgeController extends Controller
{
    public function index(){
        $all_data=Bridge::latest()->paginate(5);
        $option_name="Bridge";
        $brands=BridgeBrand::all();
        $color=BridgeColor::all();
        $scale=BridgeScale::all();
        $type=BridgeType::all();
        $info_array=['bridge.create','bridge',$option_name,$color,$type,$scale];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array','brands'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => 'required',
            'strings'=>'required',
            'color'=>'required',
            'brand'=>'required',
            'scale'=>'required'           
        ],
        //custom error messages
        [
            'type.required' => 'Please select bridge type!',
            'strings.required'=>'Please select number of strings!',
            'color.required'=>'Please select bridge color!',
            'brand.required'=>'Please select bridge brand!',
            'scale.required'=>'Please select bridge scale!'
        ]);


        $create= new Bridge();
        $create->type=$request->type;
        $create->strings=$request->strings;
        $create->color=$request->color;
        $create->brand=$request->brand;
        $create->scale=$request->scale;
        $create->description = $request->description;
        // search if the bridge combination already exists
        $search=Bridge::where([
            ['type',$request->type],
            ['strings',$request->strings],
            ['color',$request->color],
            ['description',$request->description]
        ])->get();

        if(!$search->isEmpty()){
            return Redirect()->back()->with('failure','Error! Bridge already exists!');
        }
        else{
            $create->save();
            return Redirect()->back()->with('success','Added Successfully!');
        }
    }

    public function edit($id){
        $edit=Bridge::find($id);
        $option_name="Bridge";
        $brands=BridgeBrand::all();
        $color=BridgeColor::all();
        $scale=BridgeScale::all();
        $type=BridgeType::all();
        $info_array=['bridge',$option_name,$color,$type,$scale];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array','brands'));
    }

    public function update(Request $request, $id){
        
            $update=Bridge::find($id)->update([
                'type' => $request->type,
                'strings'=>$request->strings,
                'color'=>$request->color,
                'brand'=>$request->brand,
                'scale'=>$request->scale,
                'description' => $request->description
            ]);

            return Redirect()->route('guitar.bridge')->with('success','Updated Successfully!');
        
    }


    public function delete($id){
        $destory = Bridge::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
}
}
