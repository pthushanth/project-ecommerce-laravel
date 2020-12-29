<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products')->with('products', $products);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.product.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_category' => 'required',
            'product_price' => 'required',
            'product_name' => 'required|unique:App\Models\Product,name',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999',
            'short_description' => 'required',
            'long_description' => 'required',
            'spec' => 'required',

        ]);
        if ($request->hasFile('product_image')) {
            // 1 get file name with extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            // 2 get just file name 
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3 get just file extension 
            $fileExtension = $request->file('product_image')->getClientOriginalExtension();
            // 4 file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtension;

            //upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }

        $product= new Product();
        $product->name=$request->input['product_name'];
        $product->price=$request->input['product_price'];
        $product->short_description=$request->input['short_description'];
        $product->long_description=$request->input['long_description'];
        $product->spec=$fileNameToStore;
        $product->image=$request->input['spec'];
        $product->status=1;

        $product->table;
        $categoryId=$request->input['category'];
        $product->categories()->attach($categoryId);
    }
}
