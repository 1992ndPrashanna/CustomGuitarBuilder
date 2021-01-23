<?php

namespace App\Http\Controllers;

use App\Models\Fret;
use App\Models\FretBrand;
use Illuminate\Http\Request;

class FretsController extends Controller
{
    public function index(){
        $all_data=Fret::latest()->paginate(5);
        $option_name="Fret";
        $brands=FretBrand::all();
        $info_array=['frets.create','frets',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array','brands'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:fretboard_radii'],
            'description' => [''],
            'brand'=>['required']
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'brand.required'=>'Please select a brand!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new Fret();
        $create->type = ucwords(strtolower($request->type));
        $create->brand= $request->brand;
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Fret::find($id);
        $option_name="Fret";
        $brands=FretBrand::all();
        $info_array=['frets',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array','brands'));
    }

    public function update(Request $request, $id){
        
            $update=Fret::find($id)->update([
                'type' => $request->type,
                'brand'=>$request->brand,
                'description' => $request->description
            ]);

            return Redirect()->route('guitar.frets')->with('success','Updated Successfully!');
        
    }

            
    public function delete($id){
            $destory = Fret::find($id)->forceDelete();
            return Redirect()->back()->with('success','Deleted Permanently');
    }

    
}
