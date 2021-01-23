<?php

namespace App\Http\Controllers;

use App\Models\OrderRule;
use Illuminate\Http\Request;

class OrderRuleController extends Controller
{
    public function index(){
        $all_data=OrderRule::latest()->paginate(5);
        $option_name="Rules";
        $info_array=['rules.create','order rules',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:order_rules'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new OrderRule();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=OrderRule::find($id);
        $option_name="Rules";
        $type="order rules";
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
        
        $update=OrderRule::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.rules')->with('success','Updated Successfully!');
    }
    

    public function delete($id){
        $destory = OrderRule::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
