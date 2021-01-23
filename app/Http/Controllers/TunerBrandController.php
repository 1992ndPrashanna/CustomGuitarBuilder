<?php

namespace App\Http\Controllers;

use App\Models\TunerBrand;
use Illuminate\Http\Request;

class TunerBrandController extends Controller
{
    public function index(){
        $all_data=TunerBrand::latest()->paginate(5);
        $option_name="Tuner Brand";
        $info_array=['tunersbrand.create','tuners brand',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }

    public function create(Request $request){

        //image processing
        $brand_image=$request->file('brand_image');
        $img_name_generator=hexdec(uniqid());   //generate new name for image file

        $img_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/tuner_brand_images/";
        $image_url = $upload_path.$image_name; 
        $brand_image->move('storage/tuner_brand_images/',$image_name);
        

        //save
        $create= new TunerBrand();
        $create->name = ucwords(strtolower($request->name));
        $create->image_urls=$image_url; 
        

        $create->save();
        return Redirect()->back()->with('success','Brand added successfully!');
    }

    public function edit($id){
        $edit = TunerBrand::find($id);
        $option_name="Tuner Brand";
        $info_array=['tuners brand',$option_name];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array'));
    }

    public function update(Request $request,$id){
        $old_image_url = $request->old_image;

        $brand_image=$request->file('brand_image');//new image
        if($brand_image){
            $random_name_generator=hexdec(uniqid());   //generate new name for image file

            $original_image_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
            $new_random_image_name=$random_name_generator.'.'.$original_image_extension; //new name = random name+ original extension
            //create generated name + original extension to make new file name
            $upload_location = "storage/tuner_brand_images/";
            $image_path_to_db = $upload_location.$new_random_image_name; 
            $brand_image->move('storage/tuner_brand_images/',$new_random_image_name);  //move brand image to path with new name
    
            //unlink the image
            
           if($old_image_url!=""){
            unlink($old_image_url);
           }
    
            $update_object = TunerBrand::find($id)->update([
                'name'=> ucwords(strtolower($request->name)),
                'image_urls'=>$image_path_to_db
            ]);
            return Redirect()->route('guitar.tunersbrand')->with('success','Brand Updated Successfully!');
        }

        else{
            $update_object = TunerBrand::find($id)->update([
                'name'=> ucwords(strtolower($request->name))
            ]);
            return Redirect()->route('guitar.tunersbrand')->with('success','Brand Updated Successfully!');
        }
    }

    public function removeImage($id){
        $removeImage=TunerBrand::find($id);
        $image_link=$removeImage->image_urls;
        unlink($image_link);
        $image_link="";
        $removeImage->update([
            'image_urls'=>""
        ]);

        return Redirect()->back()->with('success','Image removed!');
    }

    public function delete($id){
        $destory = TunerBrand::find($id)->forceDelete();
        unlink($destory->image_url);
        return Redirect()->back()->with('success','Deleted Permanently');
    }
}
