<?php

namespace App\Http\Controllers;

use App\Models\Guitar;
use App\Models\Pickup;
use App\Models\PickupBrand;
use App\Models\Shape;
use App\Models\Bridge;
use App\Models\Country;
use App\Models\CustomInlay;
use App\Models\CustomShopGalleryImage;
use App\Models\DefaultOption;
use App\Models\Electronic;
use App\Models\Extra;
use App\Models\Finish;
use App\Models\Fret;
use App\Models\FretboardRadius;
use App\Models\Inlay;
use App\Models\Neck;
use App\Models\NeckType;
use App\Models\Nut;
use App\Models\OrderRule;
use App\Models\PickupConfiguration;
use App\Models\PickupSelector;
use App\Models\ScaleLength;
use App\Models\StandardColor;
use App\Models\TranslucentColor;
use App\Models\Tuner;
use App\Models\Wood;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function welcome(){
        $pickups=Pickup::all();
        $pickup_brands=PickupBrand::all();
        $models=Shape::all();
        return view('front.welcome',compact('pickups','pickup_brands','models'));
    }

    public function showAllPickups(){
        $all_pickups=Pickup::all();
        $pickup_brands=PickupBrand::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        return view('front.allpickups',compact('all_pickups','pickup_brands','models','pickups'));
    }
    public function aboutus(){
        return view('front.aboutus');
    }

    public function products(){
        return view('front.products');
    }

    public function gallery(){
        return view('front.gallery');
    }

    public function artists(){
        return view('front.artists');
    }

    public function viewGuitarModel($modelName){
        $idResult=Shape::select('id','type')->where('type',$modelName)->first();
        $modelName=$idResult->type;
        $id=$idResult->id;
        
        $thisGuitarModel=Guitar::where('shape',$id)->get();  
        // for navigation bar
        $guitars=Guitar::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        $pickup_brands=PickupBrand::all();

        return view('front.guitars',compact('thisGuitarModel','guitars','models','pickups','modelName','pickup_brands'));
    }

    public function viewGuitar($guitarModel, $guitarId){
        $viewGuitar=Guitar::find($guitarId);

        // for navigation bar
        $guitars=Guitar::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        $pickup_brands=PickupBrand::all();
        
        return view('front.viewguitar',compact('viewGuitar','guitars','models','pickups','guitarModel','pickup_brands'));
    }

    public function viewPickup($pickupName, $id){
        $guitars=Guitar::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        $viewPickup = Pickup::find($id);
        $pickup_brands=PickupBrand::all();
        return view('front.viewsinglepickup',compact('viewPickup','pickups','pickup_brands','models','guitars'));
    }

    public function customShop(){
        //gallyer images
        $gallery_images=CustomShopGalleryImage::all();
        // countries for user addresses
        $all_countries=Country::all();

        // rules for ordering
        $order_rules=OrderRule::all()->sortBy('id');

        // for navigation bar
        $guitars=Guitar::all();
        $pickups=Pickup::all();
        $models=Shape::all();
        $pickup_brands=PickupBrand::all();

        // load custom shop page
        $shapes=Shape::all();
        $body_woods=Wood::where('is_body','Yes')->get();
        $top_woods=Wood::where('is_top','Yes')->get();
        $neck_woods=Wood::where('is_neck','Yes')->get();
        $fretboard_woods=Wood::where('is_fretboard','Yes')->get();
        $necks=Neck::orderBy('piece')->get();
        $one_piece_necks=Neck::where('piece','1')->get();
        $three_piece_necks=Neck::where('piece','3')->get();
        $five_piece_necks=Neck::where('piece','5')->get();
        $neck_types=NeckType::all();
        $finishes=Finish::all();
        $fret_types=Fret::all();
        $fretboard_radii=FretboardRadius::orderBy('type')->get();
        $scale_lengths=ScaleLength::orderBy('type')->get();             
        $inlays=Inlay::all();
        $custom_inlays=CustomInlay::all();
        $pickups=Pickup::all();
        $bridges=Bridge::orderBy('strings')->get();
        $electronics=Electronic::all();
        $nuts=Nut::all();
        $tuners=Tuner::all();
        $extras=Extra::all();
        $default_options=DefaultOption::all();
        $pickup_selectors=PickupSelector::all();
        $standard_color=StandardColor::all();
        $translucent_color=TranslucentColor::all();
        $pickup_configurations=PickupConfiguration::all();

        // newly added
        //color options

        $standard_color_array=array();
        $translucent_color_array=array();
        foreach($standard_color as $color){
            $standard_color_array[$color->id]=$color->type;
        }

        foreach($translucent_color as $trans_color){
            $translucent_color_array[$trans_color->id]=$trans_color->type;
        }


                //Neck selection options
   $one_piece_neck_array=array();
   foreach ($one_piece_necks as $one_piece_neck) {
       $one_piece_neck_array[$one_piece_neck->id]=$one_piece_neck->neck_woods;
   }

   $three_piece_neck_array=array();
   foreach($three_piece_necks as $three_piece_neck){
       $three_piece_neck_array[$three_piece_neck->id]=$three_piece_neck->neck_woods;
   }

    
  $five_piece_neck_array=array();
   foreach ($five_piece_necks as $five_piece_neck) {
   $five_piece_neck_array[$five_piece_neck->id]=$five_piece_neck->neck_woods;
   }



   $customInlayId=array();
   $modelId=array();
   $inlayName=array();
   $i=0;
   $num_of_shapes=sizeof($shapes);
   foreach ($custom_inlays as $custom_inlay) {
       $modelId[$i]=$custom_inlay->model;
       $inlayName[$i]=$custom_inlay->type;
       $customInlayId[$i]=$custom_inlay->id;
       $i++;
   }

    //create array with model Id and number of frets
   $shape_frets_array=array();
    foreach ($shapes as $shape){
        $shape_frets_array[$shape->id]=$shape->frets;
   }

   //pickup configuation options
   
   $neck_pickups=array();
   $middle_pickups=array();
   $bridge_pickups=array();
   $single_coil_pickups=array();
   $humbucker_pickups=array();

   foreach($pickups as $pickup){
       if($pickup->pickupType->type=="Single Coil"){
           $single_coil_picksup[$pickup->id]=$pickup->name;
       }
       else{
           $humbucker_pickups[$pickup->id]=$pickup->name;
       }
   }

       // function to get all bridge humbuckers
       $bridgeHumbuckers=array();
       $neckHumbuckers=array();
       $bridgeSingleCoils=array();
       $middleSingleCoils=array();
       $neckSingleCoils=array();

           foreach ($pickups as $pickup) {
               if((strcasecmp($pickup->pickupPosition->type,"bridge position")==0 ||
                    strcasecmp($pickup->pickupPosition->type,"bridge")==0 ) &&
                    strcasecmp($pickup->pickupType->type,"Humbucker")==0 ||
                   (strcasecmp($pickup->pickupPosition->type,"Neck and Bridge Position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"Bridge and Neck position")==0) ){
                   $bridgeHumbuckers[$pickup->id]=$pickup->name;
               }

               if(strcasecmp($pickup->pickupPosition->type,"neck position")==0 && 
                   strcasecmp($pickup->pickupType->type,"Humbucker") ==0 ||
                   (strcasecmp($pickup->pickupPosition->type,"Neck And Bridge Position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"Bridge and Neck position")==0) ){
                   $neckHumbuckers[$pickup->id]=$pickup->name;
               }

               if(strcasecmp($pickup->pickupType->type,"Single Coil") == 0 &&
                   ( strcasecmp($pickup->pickupPosition->type,"bridge position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"Neck, Bridge, And Middle Position")==0) ){
                   $bridgeSingleCoils[$pickup->id]=$pickup->name;
               }

               if($pickup->pickupType->type=="Single Coil" && 
                   (strcasecmp($pickup->pickupPosition->type,"Neck, Bridge, And Middle Position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"middle position")==0)){
                   $middleSingleCoils[$pickup->id]=$pickup->name;
               }

               if(strcasecmp($pickup->pickupType->type,"Single Coil")==0 && 
                   (strcasecmp($pickup->pickupPosition->type,"neck position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"neck,bridge and middle position")==0 || 
                   strcasecmp($pickup->pickupPosition->type,"Neck, Bridge, And Middle Position")==0)){
                   $neckSingleCoils[$pickup->id]=$pickup->name;
               }
           }
        //    end newly added

        return view('front.customshop',compact('shapes','body_woods','top_woods','neck_woods','fretboard_woods','necks',
        'finishes','fret_types','fretboard_radii','scale_lengths','inlays','pickups','bridges','electronics','nuts','tuners','extras',
        'default_options','neck_types','custom_inlays','pickup_selectors','one_piece_necks','three_piece_necks','five_piece_necks',
        'standard_color','translucent_color','pickup_configurations','one_piece_neck_array','three_piece_neck_array','five_piece_neck_array','bridgeHumbuckers','neckHumbuckers',
        'bridgeSingleCoils','middleSingleCoils','neckSingleCoils','shape_frets_array','standard_color_array','translucent_color_array',
        'guitars','pickups','models','pickup_brands','order_rules','gallery_images','all_countries'));
    }

    

}
