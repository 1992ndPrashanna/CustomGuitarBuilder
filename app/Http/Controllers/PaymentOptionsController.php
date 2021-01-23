<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PaymentOption;
use Illuminate\Support\Facades\Redirect;

class PaymentOptionsController extends Controller
{
    public function index(){
        $all_data=PaymentOption::latest()->paginate(5);
        $option_name="Payment Option";
        $info_array=['paymentoptions.create','payment options',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:scale_lengths'],
            'description' => [''],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique'=>'Type already exists!'
        ]);

        $create= new PaymentOption();
        $create->type = ucwords(strtolower($request->type));
        $create->description = $request->description;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function edit($id){
        $edit=PaymentOption::find($id);
        $option_name="Payment Options";
        $type="payment options";
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
        
        $update=PaymentOption::find($id)->update([
            "type"=>$request->type,
            "description"=>$request->description
        ]);

        return Redirect()->route('guitar.paymentoptions')->with('success','Updated Successfully!');
    }
    

    public function delete($id){
        $destory = PaymentOption::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
    }


    // actual payment functions
    // paypal
    public function finishPayment(){
        return view('front.paymentcomplete');
    }

}
