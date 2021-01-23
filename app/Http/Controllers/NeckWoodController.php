<?php

namespace App\Http\Controllers;

use App\Models\NeckWood;
use App\Models\Wood;
use Illuminate\Http\Request;

class NeckWoodController extends Controller
{
    public function index(){
        $all_data=Wood::where('is_neck','Yes')->paginate(5);
        $option_name="Neck Wood";
        $info_array=['wood.create','neck wood',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function edit($id){
        $edit = Wood::find($id);
        $option_name="Neck Wood";
        $info_array=['wood',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array'));
    }

    public function delete($id){
        $destory = Wood::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
