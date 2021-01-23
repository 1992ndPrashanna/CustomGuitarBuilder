<?php

namespace App\Http\Controllers;

use App\Models\NeckShape;
use Illuminate\Http\Request;

class NeckShapeController extends Controller
{
    //soft C, D, etc etc
    public function index(){
        $all_data=NeckShape::latest()->paginate(5);
        $option_name="Neck Shape";
        $info_array=['neckshape.create','neck shape',$option_name];
        return view('admin.products.guitaroptions.optionslanding',compact('all_data','info_array'));
    }

    public function delete($id){
        $destory = NeckShape::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
