<?php

namespace App\Http\Controllers;

use App\Models\BridgeBrand;
use Illuminate\Http\Request;

class BridgeBrandController extends Controller
{
    public function index(){
        $all_data=BridgeBrand::latest()->paginate(5);
        $option_name="Bridge Brand";
        $info_array=['bridgebrand.create','bridge brand',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:50','unique:bridge_brands'],
            'brand_image' => [''],
        ],
        //custom error messages
        [
            'name.required' => 'Name cannot be empty!',
            'brand_image'=>['required','image','mimes:jpg,jpeg,png,svg','max:257000' ]
        ]);
        //image processing
        $brand_image=$request->file('brand_image');
        $img_name_generator=hexdec(uniqid());   //generate new name for image file

        $img_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/bridge_brand_images/";
        $image_url = $upload_path.$image_name; 
        $brand_image->move('storage/bridge_brand_images/',$image_name);
        

        //save
        $create= new BridgeBrand();
        $create->name = ucwords(strtolower($request->name));
        $create->image_urls=$image_url;
        

        $create->save();
        return Redirect()->back()->with('success','Brand added successfully!');
    }

    public function edit($id){
        $edit = BridgeBrand::find($id);
        $option_name="Bridge Brand";
        $info_array=['bridge brand',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array'));
    }

    public function removeImage(Request $request){
        $id=$request->id;
        $removeImage=BridgeBrand::find($id);
        $image_link=$removeImage->image_urls;
        unlink($image_link);
        $image_link="";
        $removeImage->update([
            'image_urls'=>$image_link
        ]);

        return Redirect()->route('guitar.bridgebrand')->with('success','Image removed!');
    }

    public function update(Request $request,$id){
        $old_image_url = $request->old_image;

        $brand_image=$request->file('brand_image');//new image
        if($brand_image){
            $random_name_generator=hexdec(uniqid());   //generate new name for image file

            $original_image_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
            $new_random_image_name=$random_name_generator.'.'.$original_image_extension; //new name = random name+ original extension
            //create generated name + original extension to make new file name
            $upload_location = "storage/bridge_brand_images/";
            $image_path_to_db = $upload_location.$new_random_image_name; 
            $brand_image->move('storage/bridge_brand_images/',$new_random_image_name);  //move brand image to path with new name
    
            //unlink the image
            
           if($old_image_url!=""){
            unlink($old_image_url);
           }
    
            $update_object = BridgeBrand::find($id)->update([
                'name'=> ucwords(strtolower($request->name)),
                'image_urls'=>$image_path_to_db
            ]);
            return Redirect()->route('guitar.bridgebrand')->with('success','Brand Updated Successfully!');
        }

        else{
            $update_object = BridgeBrand::find($id)->update([
                'name'=> ucwords(strtolower($request->name))
            ]);
            return Redirect()->route('guitar.bridgebrand')->with('success','Brand Updated Successfully!');
        }
    }

    public function delete($id){
        $destory = BridgeBrand::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
}
}
