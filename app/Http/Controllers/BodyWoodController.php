<?php

namespace App\Http\Controllers;

use App\Models\BodyWood;
use App\Models\Wood;
use Illuminate\Http\Request;

class BodyWoodController extends Controller
{
    public function index(){
        $all_data=Wood::where('is_body','Yes')->paginate(5);
        
        $option_name="Body Wood";
        $info_array=['wood.create','body wood',$option_name];   //create route, type, options name
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function edit($id){
        $edit = Wood::find($id);
        $option_name="Body Wood";
        $info_array=['wood',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array'));
    }

    public function update(Request $request,$id){
        if($request->bodywood=="Yes"){
            $is_body="Yes";
        }
        else
            $is_body="No";

        //check top wood
        if($request->topwood=="Yes"){
            $is_top="Yes";
        }
        else
            $is_top="No";

        //check neck wood
        if($request->neckwood=="Yes"){
            $is_neck="Yes";
        }
        else
            $is_neck="No";

        //check freboard wood
        if($request->fretboardwood=="Yes"){
            $is_fretboard="Yes";
        }
        else
            $is_fretboard="No";
        
        $update_object = Wood::find($id)->update([
            'type'=> ucwords(strtolower($request->type)),
            'description'=>$request->description,
            'is_body'=>$is_body,
            'is_top'=>$is_top,
            'is_neck'=>$is_neck,
            'is_fretboard'=>$is_fretboard
        ]);

        return Redirect()-back()->with('success','Updated Successfully!');
        
    }

    public function delete($id){
        $destory = BodyWood::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
}

    
}
