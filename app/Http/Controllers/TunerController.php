<?php

namespace App\Http\Controllers;

use App\Models\Tuner;
use App\Models\TunerBrand;
use Illuminate\Http\Request;

class TunerController extends Controller
{
    public function index(){
        $all_data=Tuner::latest()->paginate(5);
        $option_name="Tuner";
        $brands=TunerBrand::all();
        $info_array=['tuners.create','tuners',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array','brands'));
    }

    public function create(Request $request){
        $create= new Tuner();
        $create->type = ucwords(strtolower($request->type));
        $create->brand= $request->brand;
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=Tuner::find($id);
        $option_name="Tuners";
        $brands=TunerBrand::all();
        $info_array=['tuners',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array','brands'));
    }
            
    public function delete($id){
            $destory = Tuner::find($id)->forceDelete();
            return Redirect()->back()->with('success','Deleted Permanently');
    }

}
