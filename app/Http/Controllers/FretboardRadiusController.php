<?php

namespace App\Http\Controllers;

use App\Models\FretboardRadius;
use Illuminate\Http\Request;

class FretboardRadiusController extends Controller
{
    public function index(){
        $all_data=FretboardRadius::latest()->paginate(5);
        $option_name="Radius";
        $info_array=['radius.create','radius',$option_name];
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

        $create= new FretboardRadius();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=FretboardRadius::find($id);
        $option_name="Fretbord Radius";
        $type="radius";
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
        
        $update=FretboardRadius::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.radius')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = FretboardRadius::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
