<?php

namespace App\Http\Controllers;

use App\Models\Nut;
use Illuminate\Http\Request;

class NutController extends Controller
{
    public function index(){
        $all_data=Nut::latest()->paginate(5);
        $option_name="Nut";
        $info_array=['nut.create','nut',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:nuts'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new Nut();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Nut::find($id);
        $option_name="Nut";
        $type="nut";
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
        
        $update=Nut::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.nut')->with('success','Updated Successfully!');
    }
    
    public function delete($id){
        $destory = Nut::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
