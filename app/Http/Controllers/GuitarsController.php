<?php

namespace App\Http\Controllers;

use App\Models\Bridge;
use App\Models\CustomInlay;
use App\Models\DefaultOption;
use App\Models\Electronic;
use App\Models\Extra;
use App\Models\Finish;
use App\Models\Fret;
use App\Models\FretboardRadius;
use App\Models\Guitar;
use App\Models\Inlay;
use App\Models\Neck;
use App\Models\NeckType;
use App\Models\Nut;
use App\Models\Pickup;
use App\Models\PickupConfiguration;
use App\Models\PickupSelector;
use App\Models\ScaleLength;
use App\Models\Shape;
use App\Models\StandardColor;
use App\Models\TranslucentColor;
use App\Models\Tuner;
use App\Models\Wood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GuitarsController extends Controller
{
    public function index(){
        $all_guitars=Guitar::all();
        $shapes=Shape::all();
        $guitars_sorted_by_shape=array();

        foreach($shapes as $shape){
            $id=$shape->id;
            $guitars=Guitar::where('shape',$id)->paginate(3);
            $guitars_sorted_by_shape[$shape->type]=$guitars;
        }
        return view('admin.products.guitars',compact('all_guitars','shapes','guitars_sorted_by_shape'));
    }

    public function getCreateForm(){
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
               if(strcasecmp($pickup->pickupType->type,"Humbucker")== 0 && (strcasecmp($pickup->pickupPosition->type,"bridge position")==0 ||
                    strcasecmp($pickup->pickupPosition->type,"bridge")==0  ||                   
                   strcasecmp($pickup->pickupPosition->type,"Neck and Bridge Position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"Bridge and Neck position")==0)){
                   $bridgeHumbuckers[$pickup->id]=$pickup->name;
               }               

               if(strcasecmp($pickup->pickupPosition->type,"neck position")==0 && 
                   strcasecmp($pickup->pickupType->type,"Humbucker") ==0 ||
                   (strcasecmp($pickup->pickupPosition->type,"Neck And Bridge Position")==0 ||
                   strcasecmp($pickup->pickupPosition->type,"Bridge and Neck position")==0) ){
                   $neckHumbuckers[$pickup->id]=$pickup->name;
               }

               if(strcasecmp($pickup->pickupType->type,"Single Coil") == 0 &&
                   (strcasecmp($pickup->pickupPosition->type,"bridge position")==0 || strcasecmp($pickup->pickupPosition->type,"Neck, Bridge, And Middle Position")==0 || strcasecmp($pickup->pickupPosition->type,"Neck and Bridge Position")==0 || strcasecmp($pickup->pickupPosition->type,"Bridge and Neck Position")==0)){
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

        return view('admin.products.guitaroptions.createguitar',compact('shapes','body_woods','top_woods','neck_woods','fretboard_woods','necks',
        'finishes','fret_types','fretboard_radii','scale_lengths','inlays','pickups','bridges','electronics','nuts','tuners','extras',
        'default_options','neck_types','custom_inlays','pickup_selectors','one_piece_necks','three_piece_necks','five_piece_necks',
        'standard_color','translucent_color','pickup_configurations','one_piece_neck_array','three_piece_neck_array','five_piece_neck_array','bridgeHumbuckers','neckHumbuckers',
        'bridgeSingleCoils','middleSingleCoils','neckSingleCoils','shape_frets_array','standard_color_array','translucent_color_array'));
    }

    public function edit($id){
            // selected neck woods
            
            $editGuitar=Guitar::find($id);
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
    
                   if((strcasecmp($pickup->pickupPosition->type,"neck position")==0 ||
                        strcasecmp($pickup->pickupPosition->type,"neck")==0 )&& 
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
    
            return view('admin.products.guitaroptions.editguitar',compact('editGuitar','shapes','body_woods','top_woods','neck_woods','fretboard_woods','necks',
            'finishes','fret_types','fretboard_radii','scale_lengths','inlays','pickups','bridges','electronics','nuts','tuners','extras',
            'default_options','neck_types','custom_inlays','pickup_selectors','one_piece_necks','three_piece_necks','five_piece_necks',
            'standard_color','translucent_color','pickup_configurations','one_piece_neck_array','three_piece_neck_array','five_piece_neck_array','bridgeHumbuckers','neckHumbuckers',
            'bridgeSingleCoils','middleSingleCoils','neckSingleCoils','shape_frets_array','standard_color_array','translucent_color_array'));
        
    }
    

    public function create(Request $request){       
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
            'images'=>['required']
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
            'images.required'=>'Please upload at least one image!'
        ]
    );

        $create = new Guitar();
        $create->shape=$request->model;
        $create->body_wood=$request->bodywood;
        $create->top_wood=$request->topwood;
        $create->neck_pieces=$request->piece;
        $create->neck_woods=$request->neckwoods;
        $create->fret_wood=$request->fretboardwood;
        $create->frets_type=$request->frettype;
        $create->inlays=$request->inlay;
        $create->custom_inlay_option=$request->custominlay;
        $create->fret_count= $request->frets;
        $create->fret_radius=$request->fretradius;
        $create->scale_length=$request->scalelength;
        $create->pickup_configuration=$request->pickupconfiguration;
        $create->neck_pickup=$request->neckpickup;
        $create->neck_type=$request->neckattachment;
        $create->pickup_selector=$request->pickupselector;
        $create->middle_pickup=$request->middlepickup;
        $create->bridge_pickup=$request->bridgepickup;
        $create->bridge=$request->bridge;
        $create->electronics=$request->electronics;
        $create->nut=$request->nut;
        $create->body_finish=$request->bodyfinish;
        $create->top_finish=$request->topfinish;
        $create->neck_finish=$request->neckfinish;
        $create->standard_color=$request->standardcolor;
        $create->translucent_color=$request->translucentcolor;
        $create->natural_finish=$request->naturalfinish;

        // images
        $guitar_images=$request->file('images');
        $image_array="";

        foreach ($guitar_images as $guitar_image){
        $img_name_generator=hexdec(uniqid());   //generate new name for image file
        $img_extension=strtolower($guitar_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/guitar_images/";
        $image_url = $upload_path.$image_name; 
        $guitar_image->move('storage/guitar_images/',$image_name);
        $image_array.=$image_url.",";   //append, not replace
        }

        $create->image_urls=$image_array;

        $create->save();
        return Redirect()->back()->with('success','Guitar added successfully!');
    }

    public function update(Request $request, $id){
        $update=Guitar::find($id);
        $standard_color=$update->standard_color;
        $natural_finish=$update->natural_finish;
        $translucent_color=$update->translucent_color;
        $bridge_pickup=$update->bridge_pickup;
        $middle_pickup=$update->middle_pickup;
        $neck_pickup=$update->neck_pickup;

        if($request->selectGuitarColor!=""){
            $standard_color=$request->standardcolor;
            $natural_finish=$request->naturalfinish;
            $translucent_color=$request->translucentcolor;
        }

        if($request->pickupconfiguration!=""){
            $bridge_pickup=$request->bridgepickup;
            $middle_pickup=$request->middlepickup;
            $neck_pickup=$request->neckpickup;
        }

        // add images
        $old_image_urls=$update->image_urls;
        


        //store multiple images in single array separated by commas, explode with separator comma when reading
            $guitar_images=$request->file('images');
            $image_array="";
            if($guitar_images!=""){           
                foreach ($guitar_images as $guitar_image){
                    $img_name_generator=hexdec(uniqid());   //generate new name for image file
                    $img_extension=strtolower($guitar_image->getClientOriginalExtension());  //get original file extension
                    $image_name=$img_name_generator.'.'.$img_extension; 
                    //create generated name + original extension to make new file name
                    $upload_path = "storage/guitar_image/";
                    $image_url = $upload_path.$image_name; 
                    $guitar_image->move('storage/guitar_image/',$image_name);
                    $image_array.=$image_url.",";   //append, not replace
                }
            }

        $image_array= $old_image_urls.$image_array;
        $update->update([
            'shape'=>$request->model,
            'body_wood'=>$request->bodywood,
            'top_wood'=>$request->topwood,
            'neck_pieces'=>$request->piece,
            'neck_woods'=>$request->neckwoods,
            'fret_wood'=>$request->fretboardwood,
            'frets_type'=>$request->frettype,
            'inlays'=>$request->inlay,
            'custom_inlay_option'=>$request->custominlay,
            'fret_count'=> $request->frets,
            'fret_radius'=>$request->fretradius,
            'scale_length'=>$request->scalelength,
            'pickup_configuration'=>$request->pickupconfiguration,
            'neck_pickup'=>$request->neckpickup,
            'neck_type'=>$request->neckattachment,
            'pickup_selector'=>$request->pickupselector,
            'middle_pickup'=>$request->middlepickup,
            'bridge_pickup'=>$request->bridgepickup,
            'bridge'=>$request->bridge,
            'nut'=>$request->nut,
            'electronics'=>$request->electronics,
            'body_finish'=>$request->bodyfinish,
            'top_finish'=>$request->topfinish,
            'neck_finish'=>$request->neckfinish,
            'standard_color'=>$request->standardcolor,
            'translucent_color'=>$request->translucentcolor,
            'natural_finish'=>$request->naturalfinish,
            'image_urls'=>$image_array
        ]);
    
        return Redirect()->route('products.guitars')->with('success','Guitar Updated Successfully!');

    }

    // remove individual images
    public function removeImage(Request $request){
        $id=$request->id;
        $get_guitar = Guitar::find($id);
        $old_img_urls=$get_guitar->image_urls;
        $remove_url=$request->url;
        unlink($remove_url);
        $remove_url .= ",";
        $new_img_urls=str_replace($remove_url,"",$old_img_urls);
        
        $update_object = Guitar::find($id)->update([
            'image_urls'=>$new_img_urls
        ]);
        return Redirect()->back()->with('success','The image has been removed');
    }

    public function delete($id){
        $deleteThis=Guitar::find($id);
        $all_images=$deleteThis->image_urls;
        $image_array=explode(",",$all_images);
        for($i=0;$i<sizeof($image_array)-1;$i++){
            unlink($image_array[$i]);
        }
        $deleteThis->forceDelete();
        return Redirect()->route('products.guitars');
    }        

    //get modal's name

    public static function getProductName(){
    $getName=new guitar();
        return class_basename($getName);
    }
}
