<?php

namespace App\Http\Controllers;

use App\Models\StandardColor;
use Illuminate\Http\Request;

class StandardColorController extends Controller
{
    public function index(){
        $all_data=StandardColor::latest()->paginate(5);
        $option_name="Standard Color";
        $info_array=['color.create','color',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:standard_colors'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new StandardColor();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=StandardColor::find($id);
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
        
        $update=StandardColor::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.color')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = StandardColor::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
