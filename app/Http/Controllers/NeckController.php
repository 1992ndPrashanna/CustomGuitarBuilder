<?php

namespace App\Http\Controllers;

use App\Models\Neck;
use App\Models\Wood;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\Looping;
use Illuminate\Support\Facades\Redirect;

class NeckController extends Controller
{
    public function index(){
        $all_data=Neck::latest()->paginate(5);
        $option_name="Neck";
        $neck_woods=Wood::where('is_neck','Yes')->get();

        $info_array=['neck.create','neck',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array','neck_woods'));
    }

    public function create(Request $request){


        $pieces=$request->looper;

        $neck= new Neck();
        if($pieces==1){
            $neck->neck_woods=$request->piece_1;
        }

        if($pieces==3){
            $neck->neck_woods=$request->piece_1." &mdash; ".$request->piece_2." &mdash; ".$request->piece_3;
        }
        if($pieces==5){
            $neck->neck_woods=$request->piece_1." &mdash; ".$request->piece_2." &mdash; ".$request->piece_3." &mdash; ".$request->piece_4." &mdash; ".$request->piece_5;
        }
        
        //if query for neck piece combination returns true
        $search=Neck::where('neck_woods',$neck->neck_woods)->get();
        if(!$search->isEmpty()){
            return Redirect()->back()->with('failure','Error! Wood combiation already exists!');
        }
        
        $neck->piece=$request->piece;
        $neck->save();
        return Redirect()->back()->with('success','Neck option created successfully!');
    }

    public function edit($id){
        $edit = Neck::find($id);
        $option_name=class_basename($edit);
        $info_array=['neck',$option_name];
        $neck_woods=Wood::where('is_neck','Yes')->get();
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array','neck_woods'));
    }

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'piece' => ['required']
        ],
    [
        'piece.required'=>'Neck piece cannot be empty'
    ]);
        $neck_woods="";
        $pieces=$request->looper;

        $neck= Neck::find($id);
        if($pieces==1){
            $neck_woods=$request->piece_1;
        }

        if($pieces==3){
            $neck_woods=$request->piece_1." &mdash; ".$request->piece_2." &mdash; ".$request->piece_3;
        }
        if($pieces==5){
            $neck_woods=$request->piece_1." &mdash; ".$request->piece_2." &mdash; ".$request->piece_3." &mdash; ".$request->piece_4." &mdash; ".$request->piece_5;
        }

        $update_object = Neck::find($id);

        $search=Neck::where('neck_woods',$neck_woods)->get();
        if(!$search->isEmpty()){
            return Redirect()->back()->with('failure','Error! Wood combiation already exists!');
        }

        // if(Neck::where('neck_woods',$neck_woods)->get() && $neck_woods!=$update_object->neck_woods){
        //     return Redirect()->back()->with('failure','Error! Wood combiation already exists!');
        // }
        
        $update_object = Neck::find($id)->update([
            'piece'=>$pieces,
            'neck_woods'=>$neck_woods
        ]);
        return Redirect()->route('guitar.neck')->with('success','Updated Successfully!');

    }

     


    public function delete($id){
        $destory = Neck::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }

    
}
