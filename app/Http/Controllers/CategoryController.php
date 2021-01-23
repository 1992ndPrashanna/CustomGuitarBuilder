<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(){
        $categories= Category::latest()->paginate(5);
        return view('admin.category.index',compact('categories' ));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'category_name' => ['required', 'unique:categories', 'max:30'],
            'description' => [''],
        ],
        //custom error messages
        [
            'category_name.required' => 'Please enter category name!',
            'category_name.unique::categories'=>'Category already exists!'
        ]);

        $category= new Category;
        $category->category_name = ucfirst(strtolower($request->category_name));
        $category->description_tags = $request->description;

        $category->save();
        return Redirect()->back()->with('success','Category Added Successfully!');
    }

    
}
