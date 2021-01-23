<?php

namespace App\Http\Controllers;

use App\Models\DefaultOption;
use Illuminate\Http\Request;

class DefaultsController extends Controller
{
    public function index(){
        $all_data=DefaultOption::latest()->paginate(5);
        $option_name="Default Options";
        $info_array=['defaults.create','defaults',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:default_options'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new DefaultOption();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=DefaultOption::find($id);
        $option_name="Default Options";
        $type="defaults";
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
        
        $update=DefaultOption::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.defaults')->with('success','Updated Successfully!');
    }
    

    public function delete($id){
        $destory = DefaultOption::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
