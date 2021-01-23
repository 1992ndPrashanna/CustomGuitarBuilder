<?php

namespace App\Http\Controllers;

use App\Models\TranslucentColor;
use Illuminate\Http\Request;

class TranslucentColorController extends Controller
{
    public function index(){
        $all_data=TranslucentColor::latest()->paginate(5);
        $option_name="Translucent Color";
        $info_array=['transcolor.create','translucent color',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:fretboard_radii'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new TranslucentColor();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=TranslucentColor::find($id);
        $option_name="Standard Colors";
        $type="color";
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
        
        $update=TranslucentColor::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.transcolor')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = TranslucentColor::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
