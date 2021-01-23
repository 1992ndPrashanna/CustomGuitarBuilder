<?php

namespace App\Http\Controllers;

use App\Models\CustomShopGalleryImage;
use Illuminate\Http\Request;

class CustomShopGalleryImageController extends Controller
{
    public function index(){
        $all_data=CustomShopGalleryImage::withTrashed()->paginate(9);
        $option_name="Gallery Image";
        $info_array=['galleryimage.create','gallery image',$option_name];
        return view('admin.products.guitaroptions.optionslandingpage',compact('all_data','info_array'));
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'image' => ['required','mimes:jpg, jpeg, png, bmp, gif, svg,']
        ],
        //custom error messages
        [
            'image.required' => 'Please select an image!',
            'image.mimes'=>'Invalid file type!'
        ]);

        $brand_image=$request->file('image');
        $img_name_generator=hexdec(uniqid());   //generate new name for image file

        $img_extension=strtolower($brand_image->getClientOriginalExtension());  //get original file extension
        $image_name=$img_name_generator.'.'.$img_extension; 
        //create generated name + original extension to make new file name
        $upload_path = "storage/gallery_images/";
        $image_url = $upload_path.$image_name; 
        $brand_image->move('storage/gallery_images/',$image_name);

        $gallery_image= new CustomShopGalleryImage();
        $gallery_image->image_url=$image_url;
        $gallery_image->save();
        return Redirect()->back()->with('success','Added Successfully!');
    }

    public function hide($id){
        if(CustomShopGalleryImage::onlyTrashed()->find($id)){
            $show=CustomShopGalleryImage::onlyTrashed()->find($id);
            $show->restore();
            return Redirect()->back()->with('success','Image visible!');
        }        
        $hide = CustomShopGalleryImage::find($id);
        $hide->delete();
        return Redirect()->back()->with('success','Image hidden!');
    }

    public function delete($id){
        $delete=CustomShopGalleryImage::find($id)->forceDelete();
        return Redirect()->back()->with('success','Image removed permanently!');
    }
}
