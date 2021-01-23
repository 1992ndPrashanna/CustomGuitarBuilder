<?php
namespace App\Http\Controllers;
use App\Models\ActivePassive;
use App\Models\MagnetMaterial;
use App\Models\PickupBrand;
use App\Models\PickupCovering;
use App\Models\PickupType;
use App\Models\PickupPosition;
use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupsController extends Controller
{
    public function index(){
        $pickups = Pickup::latest()->paginate(3);
        return view('admin.products.pickups',compact('pickups'));
    }

    public function createPickupForm(){
        $brands=PickupBrand::all();
        $types=PickupType::all();
        $positions=PickupPosition::all();
        $activepassives=ActivePassive::all();
        $coverings=PickupCovering::all();
        $magnets=MagnetMaterial::all();
        

        return view('admin.products.options.addpickup',compact('brands','types','positions','activepassives','coverings','magnets'));
    }

    public function createPickup(Request $request){

        $validatedData = $request->validate([
            'name' => ['required']
            // 'images'=>['required','image','mimes:jpg,jpeg,png,svg','max:257000' ]
        ],
        [
            'name.required' => 'Please enter pickup  name!'
        //     'images.required'=>'Please upload at least one image!'

        ]);

        


        //store multiple images in single array separated by commas, explode with separator comma when reading

        $pickup_images=$request->file('images');
        $image_array="";


        foreach ($pickup_images as $pickup_image){
        $img_name_generator=hexdec(uniqid());   //generate new name for image file
        $img_extension=strtolower($pickup_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/pickup_images/";
        $image_url = $upload_path.$image_name; 
        $pickup_image->move('storage/pickup_images/',$image_name);
        $image_array.=$image_url.",";   //append, not replace
        }

        $pickup= new Pickup; 
        $pickup->name=$request->name;
        $pickup->brand=$request->brand;
        $pickup->position=$request->position;
        $pickup->type=$request->type;
        $pickup->active_passive=$request->activepassive;
        $pickup->conductors=$request->conductors;
        $pickup->magnet_material=$request->magnet;
        $pickup->strings=$request->strings;
        $pickup->covering=$request->covering;
        $pickup->price=$request->price;
        $pickup->description=$request->description;
        $pickup->image_urls=$image_array;
        $pickup->signatures_series=$request->signature;
        $pickup->signature_artist=ucwords($request->artists);
        $pickup->website=$request->website;
        $pickup->stock=$request->stock;
        $pickup->save();
        return Redirect()->back()->with('success','Pickup added successfully!');
    }

    public function edit($id){
        $brands=PickupBrand::all();
        $types=PickupType::all();
        $positions=PickupPosition::all();
        $activepassives=ActivePassive::all();
        $coverings=PickupCovering::all();
        $magnets=MagnetMaterial::all();
        $edit=Pickup::find($id);
        return view('admin.products.options.editpickup',compact('edit','brands','types','positions','activepassives','coverings','magnets'));
    }


    public static function getProductName(){
        $getName=new Pickup();
        return class_basename($getName);
    }


    public function removeImage(Request $request){
        $id=$request->id;
        $get_pickup = Pickup::find($id);
        $old_img_urls=$get_pickup->image_urls;
        $remove_url=$request->url;
        unlink($remove_url);
        $remove_url.=",";
        $new_img_urls=str_replace($remove_url,"",$old_img_urls);

        $update_object = Pickup::find($id)->update([
            'image_urls'=>$new_img_urls
        ]);
        return Redirect()->back()->with('success','The image has been removed');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => ['required'],
            // 'images'=>['required','image','mimes:jpg,jpeg,png,svg','max:257000' ]
        ],
        [
            'name.required' => 'Please enter pickup  name!',
        //     'images.required'=>'Please upload at least one image!'

        ]);
        $pickup=Pickup::find($id);
        $old_image_urls=$pickup->image_urls;
        


        //store multiple images in single array separated by commas, explode with separator comma when reading
            $pickup_images=$request->file('images');
            $image_array="";
            if($pickup_images!=""){
                


                foreach ($pickup_images as $pickup_image){
                    $img_name_generator=hexdec(uniqid());   //generate new name for image file
                    $img_extension=strtolower($pickup_image->getClientOriginalExtension());  //get original file extension
                    $image_name=$img_name_generator.'.'.$img_extension; 
                    //create generated name + original extension to make new file name
                    $upload_path = "storage/pickup_images/";
                    $image_url = $upload_path.$image_name; 
                    $pickup_image->move('storage/pickup_images/',$image_name);
                    $image_array.=$image_url.",";   //append, not replace
                }
            }
        $image_array= $image_array.$old_image_urls;
        $update_object = Pickup::find($id)->update([
            'name'=>$request->name,
            'brand'=>$request->brand,
            'position'=>$request->position,
            'type'=>$request->type,
            'active_passive'=>$request->activepassive,
            'conductors'=>$request->conductors,
            'magnet_material'=>$request->magnet,
            'strings'=>$request->strings,
            'covering'=>$request->covering,
            'price'=>$request->price,
            'description'=>$request->description,
            'image_urls'=>$image_array,
            'signatures_series'=>$request->signature,
            'signature_artist'=>ucwords($request->artists),
            'website'=>$request->website,
            'stock'=>$request->stock
        ]);

        return Redirect()->back()->with('success','Pickup Updated successfully!');
    }
    
    public function trash($id){
        if (Pickup::onlyTrashed()->find($id)){
            $request=Pickup::onlyTrashed()->find($id);
            
            $image_path=$request->image_urls;
            $image_path_array=explode(",",$image_path);
            
            for($i=0;$i<sizeof($image_path_array)-1;$i++){
                unlink($image_path_array[$i]);
            }
            $destory = Pickup::onlyTrashed()->find($id)->forceDelete();
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        else
            $trash = Pickup::find($id)->delete();
            return Redirect()->route('products.pickups')->with('success','Pickup sent to trash!');
    }

    public function restore($id){
        $restore= Pickup::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup restored!');

    }
    
}
