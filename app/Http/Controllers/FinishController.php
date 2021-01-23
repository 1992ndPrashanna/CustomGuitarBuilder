<?php

namespace App\Http\Controllers;

use App\Models\Finish;
use Illuminate\Http\Request;

class FinishController extends Controller
{
    public function index(){
        $all_data=Finish::latest()->paginate(5);
        $option_name="Finish";
        $info_array=['finish.create','finish',$option_name];
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

        $create= new Finish();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Finish::find($id);
        $option_name="Finish";
        $type="finish";
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
        
        $update=Finish::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.finish')->with('success','Updated Successfully!');
    }

    public function delete($id){
        $destory = Finish::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
}

}
