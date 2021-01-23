<?php

namespace App\Http\Controllers;

use App\Models\Inlay;
use Illuminate\Http\Request;

class InlayController extends Controller
{
    public function index(){
        $all_data=Inlay::latest()->paginate(5);
        $option_name="Inlay";
        $info_array=['inlay.create','inlay',$option_name];
        return view('admin.products.guitaroptions.optionslanding',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:inlays'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new Inlay();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Inlay::find($id);
        $option_name="Inlay";
        $type="inlay";
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
        
        $update=Inlay::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.inlay')->with('success','Updated Successfully!');
    }


    public function delete($id){
        $destory = Inlay::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
