<?php

namespace App\Http\Controllers;

use App\Models\Shape;
use Illuminate\Http\Request;

class ShapeController extends Controller
{
    public function index(){
        $all_data=Shape::latest()->paginate(5);
        $option_name="Guitar Models";
        $info_array=['shape.create','shape',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:fretboard_radii'],
            'frets'=>['required'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Cannot have an empty model!',
            'type.unique'=>'Guitar model already exists!',
            'frets.required'=>'Please select number of frets on this model!'
        ]);

        $create= new Shape();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;
        $create->frets=$request->frets;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Shape::find($id);
        $option_name="Guitar Model";
        $type="shape";
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
        
        $update=Shape::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.shape')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = Shape::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
