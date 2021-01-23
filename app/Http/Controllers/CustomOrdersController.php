<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shape;
use App\Models\Pickup;
use App\Models\Customer;
use App\Models\CustomOrder;
use App\Models\PickupBrand;
use Illuminate\Http\Request;
use App\Mail\NewOrderReceived;
use App\Mail\ToUserOrderReceived;
use App\Models\Guitar;
use App\Models\PaymentOption;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CustomOrdersController extends Controller
{
    public function index(){

    }

    public function createCustomOrder(Request $request){
        $customOrder=new CustomOrder();
        $customer=new Customer();

        // validate custom order   
        $validate=$request->validate([
            'model'=>['required'],
            'bodywood'=>['required'],
            'topwood'=>['required'],
            'neckattachment'=>['required'],
            'piece'=>['required'],
            'fretboardwood'=>['required'],
            'frettype'=>['required'],
            'inlay'=>['required'],
            // custominlay is optional!
            'bodyfinish'=>['required'],
            'topfinish'=>['required'],
            'neckfinish'=>['required'],
            'selectGuitarColor'=>['required'],
            'scalelength'=>['required'],
            'fretradius'=>['required'],
            'bridge'=>['required'],
            'pickupconfiguration'=>['required'],
            'electronics'=>['required'],
            'pickupselector'=>['required'],
            'nut'=>['required'],
            // customer info validation
            'firstname'=>['required'],
            'lastname'=>['required'],
            'country'=>['required'],
            'city'=>['required'],
            'fullstreetaddress'=>['required'],
            'postalcode'=>['required'],
            'email'=>['required'],
            'phone'=>['required']
        ],
        [
            'model.required'=>"Please select a guitar model!",
            'bodywood.required'=>"Please select body wood!",
            'topwood.required'=>"Please select top wood!",
            'piece.required'=>"Please select neck-pieces!",
            'neckattachment.required'=>'Please select neck attachment type!',
            'fretboardwood.required'=>"Please select fretboard wood!",
            'frettype.required'=>"Please select fret-wire type!",
            'inlay.required'=>"Please select inlay shape!",
            'bodyfinish.required'=>"Please choose the body finish!",
            'topfinish.required'=>"Please choose the top finish!",
            'neckfinish.required'=>"Please choose the finish for the back of the neck!",
            'selectGuitarColor.required'=>"You must select a guitar color or whether you want natural/clear finish!",
            'scalelength.required'=>"Please choose the scale length of your instrument!",
            'fretradius.required'=>"Please select the radius of fretboard!",
            'bridge.required'=>"Please choose a bridge for your guitar!",
            'pickupconfiguration.required'=>"Please select a pickup layout for your guitar!",
            'electronics.required'=>'Please select the electronics/controls for your guitar!',
            'pickupselector.required'=>'Please choose a pickup selector switch!',
            'nut.required'=>'Please choose the type of nut for your guitar!',
            // customer validation
            'firstname.required'=>'Please enter your first name!',
            'lastname.required'=>'Please enter your last name!',
            'country.required'=>'Please select your country!',
            'city.required'=>'Please enter a city name!',
            'fullstreetaddress.required'=>'Please enter your full street address for delivery!',
            'postalcode.required'=>'ZIP/Postal Code is required for shipping!',
            'email.required'=>'Email is required for communications with us!',
            'phone.required'=>'Please enter your phone number!'
        ]   
    );
        // customer info
        $customer->first_name=$request->firstname;
        $customer->last_name=$request->lastname;
        $customer->country=$request->country;
        $customer->city=$request->city;
        $customer->street_address=$request->fullstreetaddress;
        $customer->zip_postal_code=$request->postalcode;
        $customer->email=$request->email;
        $customer->phone=$request->phone;
    

        // orderinfo
        $customOrder->shape=$request->model;
        $customOrder->body_wood=$request->bodywood;
        $customOrder->top_wood=$request->topwood;
        $customOrder->neck_pieces=$request->piece;
        $customOrder->neck_woods=$request->neckwoods;
        $customOrder->fret_wood=$request->fretboardwood;
        $customOrder->frets_type=$request->frettype;
        $customOrder->inlays=$request->inlay;
        $customOrder->custom_inlay_option=$request->custominlay;
        $customOrder->fret_count= $request->frets;
        $customOrder->fret_radius=$request->fretradius;
        $customOrder->scale_length=$request->scalelength;
        $customOrder->pickup_configuration=$request->pickupconfiguration;
        $customOrder->neck_pickup=$request->neckpickup;
        $customOrder->neck_type=$request->neckattachment;
        $customOrder->pickup_selector=$request->pickupselector;
        $customOrder->middle_pickup=$request->middlepickup;
        $customOrder->bridge_pickup=$request->bridgepickup;
        $customOrder->bridge=$request->bridge;
        $customOrder->electronics=$request->electronics;
        $customOrder->nut=$request->nut;
        $customOrder->body_finish=$request->bodyfinish;
        $customOrder->top_finish=$request->topfinish;
        $customOrder->neck_finish=$request->neckfinish;
        $customOrder->standard_color=$request->standardcolor;
        $customOrder->translucent_color=$request->translucentcolor;
        $customOrder->natural_finish=$request->naturalfinish;

        //save data
        
        // creating a Universal Uniqued Idenification 
        $model=$customOrder->model->type;
        $date=str_replace("-","",date("Y-m-d"));
        $customOrder_no=sprintf('%04d',(sizeof(CustomOrder::all())+1));

        // **********************************************************************************
        // random generator Source: Stackoverflow        
        /**
         * Generate a random string, using a cryptographically secure 
         * pseudorandom number generator (random_int)
         * 
         * For PHP 7, random_int is a PHP core function
         * For PHP 5.x, depends on https://github.com/paragonie/random_compat
         * 
         * @param int $length      How many characters do we want?
         * @param string $keyspace A string of all possible characters
         *                         to select from
         * @return string
         */
        function random_str(
            int $length = 64,
            string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
            if ($length < 1) {
                throw new \RangeException("Length must be a positive integer");
            }
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces []= $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }
        // ****************************************************************************************

        $unique_suffix=random_str(8);

        $uuid=$date.$model.$customOrder_no.$unique_suffix;
        $customOrder->orderUUID=$uuid;
        $customer->orderUUID=$uuid;
        
        // for order table
        $order=new Order();

        $order->orderUUID=$uuid;
        $order->user_email=$request->email;
        $order->advanced_payment=0;

        // Mail
        $users_full_name=$request->firstname." ".$request->lastname;
        $guitar_model_name=$customOrder->model->type;
        Mail::to($request->email)->send(new ToUserOrderReceived($users_full_name,$request->email,$guitar_model_name,$uuid,date("Y-m-d")));
        $order->save();
        $customOrder->save();
        $customer->save();
        return Redirect()->back()->with('success','Order place succesfully, please check your email!');
    }


    public function viewCustomOrderButton($uuid){
        // for navbar
        $pickup_brands=PickupBrand::all();
        $pickups=Pickup::all();
        $models=Shape::all();

        // let user view their custom order with their UUID, through email
        
        try{
            $getOrder=Order::where('orderUUID',$uuid)->firstOrFail();
            if($getOrder!=""){
                $customOrder=CustomOrder::where('orderUUID',$uuid)->firstOrFail();
                $customer=Customer::where('orderUUID',$uuid)->firstOrFail();
                $order=Order::where('orderUUID',$uuid)->firstOrFail();
                return view('front.viewcustomorder',compact('customOrder','customer','order','pickups','pickup_brands','models'));
            }
        }

        catch(ModelNotFoundException $e){
            return Redirect()->route('/');
        }
        
    }

    // view order with email + UUID

    public function viewCustomOrder(Request $request){

        // for navbar
        $pickup_brands=PickupBrand::all();
        $pickups=Pickup::all();
        $models=Shape::all();

        // payment options
        $payment_options=PaymentOption::all();

        // validate
        $validate=$request->validate([
            'email'=>['required'],
            'orderUUID'=>['required']
        ],
        [
            'email.required'=>'Please enter your email!',
            'orderUUID.required'=>'Please enter your Order ID!'
        ]);
        
        try{
            $getOrder=Order::where([
                ['user_email','=',$request->email],
                ['orderUUID','=',$request->orderUUID]
            ])->firstOrFail();
            if($getOrder!=""){
                $customOrder=CustomOrder::where('orderUUID',$request->orderUUID)->firstOrFail();
                $customer=Customer::where('orderUUID',$request->orderUUID)->firstOrFail();
                $order=Order::where('orderUUID',$request->orderUUID)->firstOrFail();
                return view('front.viewcustomorder',compact('customOrder','customer','order','pickups','pickup_brands','models','payment_options'));
            }
        }

        catch(ModelNotFoundException $e){
            return Redirect()->back()->with('failure','Order not found, please check your credentials again!');
        }
        
    }

    public function paymentFinished(){
        // navbar variables
        $guitars=Guitar::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        $pickup_brands=PickupBrand::all();
        $orderUUID=$_GET['uuid'];
        $paid_amount=$_GET['paid'];
        $getOrder=Order::where('orderUUID',$orderUUID)->first();
        $getCustomer=Customer::where('orderUUID',$orderUUID)->first();
        $getCustomOrder=CustomOrder::where('orderUUID',$orderUUID)->first();
        

        if($_GET['due']==0){
            $getOrder->update([
                'advanced_payment'=>$getOrder->price,
                'due'=>0
            ]);
        }
        else{
            $getOrder->update([
                'advanced_payment'=>$paid_amount,
                'due'=>$_GET['due']
            ]);
        }

        return view('front.paymentdone',compact('guitars','pickups','models','pickup_brands','paid_amount','getOrder','getCustomer'));
        
    }
}
