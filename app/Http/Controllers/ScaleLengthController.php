<?php

namespace App\Http\Controllers;

use App\Models\ScaleLength;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScaleLengthController extends Controller
{
    public function index(){
        $all_data=ScaleLength::latest()->paginate(5);
        $option_name="Scale Length";
        $info_array=['scalelength.create','scale length',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:scale_lengths'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new ScaleLength();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=ScaleLength::find($id);
        $option_name="Scale Length";
        $type="scale length";
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
        
        $update=ScaleLength::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.scalelength')->with('success','Updated Successfully!');
    }
    

    public function delete($id){
        $destory = ScaleLength::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
