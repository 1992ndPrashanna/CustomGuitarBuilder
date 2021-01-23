<?php

namespace App\Http\Controllers;

use App\Models\CustomInlay;
use App\Models\GuitarModel;
use App\Models\Shape;
use Illuminate\Http\Request;

class CustomInlayController extends Controller
{
    public function index(){
        $all_data=CustomInlay::latest()->paginate(5);
        $option_name="Custom Inlay";
        $guitar_models=Shape::all();
        $info_array=['custominlay.create','custom inlay',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array','guitar_models'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'type' => ['required', 'max:50','unique:custom_inlays'],
        ],
        //custom error messages
        [
            'type.required' => 'Type cannot be empty!',
            'type.unique:custom_inlays'=>'Type already exists!'
        ]);

        $brand_image=$request->file('images');
        if($brand_image){                    
            $img_name_generator=hexdec(uniqid());   //generate new name for image file

            $img_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
            $image_name=$img_name_generator.'.'.$img_extension; 
            //create generated name + original extension to make new file name
            $upload_path = "storage/custom_inlay_images/";
            $image_url = $upload_path.$image_name; 
            $brand_image->move('storage/custom_inlay_images/',$image_name);
        }

        $create= new CustomInlay();
        $create->type = ucwords(strtolower($request->type));
        $create->model=$request->guitar_model;
        $create->description = $request->description;
        $create->images=$image_url;

        $create->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    
    public function edit($id){
        $edit=CustomInlay::find($id);
        $option_name="Custom Inlay";
        $type="custom inlay";
        $guitar_models=GuitarModel::all();
        $info_array=[$type,$option_name,$guitar_models];
        return view('admin.products.guitaroptions.editoptions',compact('edit','info_array','guitar_models'));
    }

    public function update(Request $request,$id){
        $old_image_url = $request->old_image;

        $brand_image=$request->file('images');
        if($brand_image!=""){
            $random_name_generator=hexdec(uniqid());   //generate new name for image file

            $original_image_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
            $new_random_image_name=$random_name_generator.'.'.$original_image_extension; //new name = random name+ original extension
            //create generated name + original extension to make new file name
            $upload_location = "storage/pickup_brand_images/";
            $image_path_to_db = $upload_location.$new_random_image_name; 
            $brand_image->move('storage/pickup_brand_images/',$new_random_image_name);  //move brand image to path with new name
    
            //unlink the image
            
            unlink($old_image_url);
    
            $update_object = CustomInlay::find($id)->update([
                'type'=> $request->type,
                'model'=>$request->guitar_model,
                'images'=>$image_path_to_db,
                'description'=>$request->description
            ]);
            return Redirect()->route('guitar.custominlay')->with('success','Pickup Brand Updated Successfully!');
        }

        else{
            $update_object = CustomInlay::find($id)->update([
                'type'=> $request->type,
                'model'=>$request->guitar_model,
                'description'=>$request->description
            ]);
            return Redirect()->route('guitar.custominlay')->with('success','Pickup Brand Updated Successfully!');
        }
    }

    public function removeImage($id){
        $removeImage=CustomInlay::find($id);
        $image_link=$removeImage->images;
        unlink($image_link);
        $image_link="";
        $removeImage->update([
            'images'=>$removeImage
        ]);

        return Redirect()->back()->with('success','Image removed!');
    }
    

    public function delete($id){
        $destory = CustomInlay::find($id)->forceDelete();
        return Redirect()->back()->with('success','Deleted Permanently');
}
}
