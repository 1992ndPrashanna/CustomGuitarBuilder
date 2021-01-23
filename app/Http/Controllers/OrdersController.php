<?php

namespace App\Http\Controllers;

use App\Mail\ToUserOrderPrice;
use App\Models\Customer;
use App\Models\Order;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function index(){   
        $orders = Order::latest()->paginate(5);
        return view('admin.products.guitaroptions.orders',compact('orders'));
    }
    
    public function addPrice(Request $request,$uuid){
        // from order table

        $order=Order::where('orderUUID',$uuid)->firstOrFail();

        // find custom guitar for invoice
        $customGuitar=CustomOrder::where('orderUUID',$uuid)->firstOrFail();
        // get guitar model name
        $guitar_model=$customGuitar->model->type;
        // find customer
        $customer=Customer::where('orderUUID',$uuid)->firstOrFail();
        // get email destination ie. customer's email
        $customer_email=$customer->email;
        // get full name
        $users_full_name=$customer->first_name." ".$customer->last_name;

        // set price in orders table
        $order->update([
            'price'=>$request->price
        ]);
        
        Mail::to($customer_email)->send(new ToUserOrderPrice($users_full_name,$order->email,$guitar_model,$uuid,date("Y-m-d"),$request->price));

        return Redirect()->back()->with('success','Order price added successfully');
    }

}
