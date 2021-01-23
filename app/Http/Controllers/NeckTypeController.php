<?php

namespace App\Http\Controllers;

use App\Models\NeckType;
use Illuminate\Http\Request;

class NeckTypeController extends Controller
{
    //bolt-on, neck through, set neck etc i.e. neck attachment
    public function index(){
        $all_data=NeckType::latest()->paginate(5);
        $option_name="Neck Attachment";
        $info_array=['necktype.create','neck type',$option_name];
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

        $create= new NeckType();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=NeckType::find($id);
        $option_name="Neck Attachment";
        $type="neck type";
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
        
        $update=NeckType::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.necktype')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = NeckType::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }

}
