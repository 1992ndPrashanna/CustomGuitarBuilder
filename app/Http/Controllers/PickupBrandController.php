<?php

namespace App\Http\Controllers;

use App\Models\PickupBrand;
use Illuminate\Http\Request;

class PickupBrandController extends Controller
{
    public function index(){
        $pickup_brands= PickupBrand::latest()->paginate(5);
        return view('admin.products.options.pickupbrand',compact('pickup_brands'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'brand' => ['required','max:50'],
            'brand_image'=>['required','image','mimes:jpg,jpeg,png,svg','max:257000' ]
        ],
        //custom error messages
        [
            'brand.required' => 'Please enter brand name!',
            'brand.max'=>'Brand name is too long!',
            'brand_image.required'=>'Brand must have a JPG,SVG or PNG image!',
            'brand_image.max'=>'Fize size too big, must be under 25MB'
        ]);

        $brand_image=$request->file('brand_image');
        $img_name_generator=hexdec(uniqid());   //generate new name for image file

        $img_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/pickup_brand_images/";
        $image_url = $upload_path.$image_name; 
        $brand_image->move('storage/pickup_brand_images/',$image_name);

        $pickup_brand= new PickupBrand;
        $pickup_brand->brand = ucwords(strtolower($request->brand));
        $pickup_brand->brand_image=$image_url;
        
        $pickup_brand->save();
        return Redirect()->back()->with('success','Pickup Brand Added Successfully!');
    }

    public function edit($id){
        $update = PickupBrand::find($id);
        return view('admin.products.options.editoptions',compact('update'))->with('category','brand');
    }

    public function update(Request $request,$id){
        $old_image_url = $request->old_image;

        $brand_image=$request->file('brand_image');
        if($brand_image){
            $random_name_generator=hexdec(uniqid());   //generate new name for image file

            $original_image_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
            $new_random_image_name=$random_name_generator.'.'.$original_image_extension; //new name = random name+ original extension
            //create generated name + original extension to make new file name
            $upload_location = "storage/pickup_brand_images/";
            $image_path_to_db = $upload_location.$new_random_image_name; 
            $brand_image->move('storage/pickup_brand_images/',$new_random_image_name);  //move brand image to path with new name
    
            //unlink the image
            
            unlink($old_image_url);
    
            $update_object = PickupBrand::find($id)->update([
                'brand'=> ucwords(strtolower($request->brand)),
                'brand_image'=>$image_path_to_db
            ]);
            return Redirect()->route('pickups.brands')->with('success','Pickup Brand Updated Successfully!');
        }

        else{
            $update_object = PickupBrand::find($id)->update([
                'brand'=> ucwords(strtolower($request->brand))
            ]);
            return Redirect()->route('pickups.brands')->with('success','Pickup Brand Updated Successfully!');
        }
    }


    public function trash($id){
        if (PickupBrand::onlyTrashed()->find($id)){
            $request=PickupBrand::onlyTrashed()->find($id);
            $image_path=$request->brand_image;
            $destory = PickupBrand::onlyTrashed()->find($id)->forceDelete();
            unlink($image_path);
            return Redirect()->back()->with('success','Data destoryed successfully');
        }
        else
            $trash = PickupBrand::find($id)->delete();
            return Redirect()->route('pickups.brands')->with('success','Pickup brand sent to trash!');
    }

    
    public function restore($id){
        $restore= PickupBrand::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Pickup brand restored!');

    }
}
