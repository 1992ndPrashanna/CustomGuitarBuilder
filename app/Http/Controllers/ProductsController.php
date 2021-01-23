<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products= Product::latest()->paginate(5);
        $categories=Category::get();
        return view('admin.products.index',compact('products','categories'));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:products', 'max:30'],
            'description' => [''],
        ],
        //custom error messages
        [
            'name.required' => 'Please enter product name!',
            'name.unique::categories'=>'Product already exists!'
        ]);

        $product= new Product;
        $product->name = ucwords(strtolower($request->name));
        $product->description = $request->description;
        $product->category=$request->category;

        $product->save();
        return Redirect()->back()->with('success','Product Added Successfully!');
    }

}
