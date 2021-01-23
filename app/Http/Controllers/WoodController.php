<?php

namespace App\Http\Controllers;

use App\Models\Wood;
use Illuminate\Http\Request;

class WoodController extends Controller
{
    public function index(){
        $all_data = Wood::latest()->paginate(5);
        $option_name=class_basename(new Wood());
        $info_array=['wood.create','wood',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:wood'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);
        $create = new Wood();
        // for wood only
        $create->type= $request->type;
        $create->description=$request->description;

        //checkboxes
        //check body wood

        if($request->bodywood=="Yes"){
            $create->is_body="Yes";
        }
        else
            $create->is_body="No";

        //check top wood
        if($request->topwood=="Yes"){
            $create->is_top="Yes";
        }
        else
            $create->is_top="No";

        //check neck wood
        if($request->neckwood=="Yes"){
            $create->is_neck="Yes";
        }
        else
            $create->is_neck="No";

        //check freboard wood
        if($request->fretboardwood=="Yes"){
            $create->is_fretboard="Yes";
        }
        else
            $create->is_fretboard="No";

        $create->description=$request->description;

        $create->save();

        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit = Wood::find($id);
        $option_name=class_basename(new Wood());
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
            'is_fretboard'=>$is_fretboard,
        ]);

        return Redirect()->route('guitar.wood')->with('success','Updated Successfully!');
        
    }

    public function delete($id){
            $destory = Wood::find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        
    }
}
