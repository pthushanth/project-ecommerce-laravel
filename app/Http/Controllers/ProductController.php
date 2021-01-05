<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        // $products = Product::with('category', 'brand')->get();
        // return view('admin.pages.product.index')->with('products', $products);

        return $dataTable->render('admin.pages.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.pages.product.create')->with(['categories' => $categories, 'brands' => $brands]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_category' => 'required',
            'product_price' => 'required',
            'product_name' => 'required|unique:App\Models\Product,name',
            'product_price' => 'required',
            'product_image' => 'required|array|min:1',
            'product_image.*' => 'image|nullable|max:1999',
            'short_description' => 'required',
            'long_description' => 'required',
            'specName' => 'required|array|min:1',
            'specValue' => 'required|array|min:1',

        ]);
        if ($request->hasFile('product_image')) {
            $imagesFileName = array();
            foreach ($request->file('product_image') as $file) {
                // 1 get file name with extension
                $fileNameWithExt = $file->getClientOriginalName();
                // 2 get just file name 
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // 3 get just file extension 
                $fileExtension = $file->getClientOriginalExtension();
                // 4 file name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtension;

                //upload image
                $path = $file->storeAs('public/product_images', $fileNameToStore);

                $imagesFileName[] =  $fileNameToStore;
            }
        } else {
            $imagesFileName[] = 'noImage.jpg';
        }

        $product = new Product();
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');

        $specs = array_combine($request->input('specName'), $request->input('specValue'));

        // Filtering the empty array
        $specs = array_diff($specs, array('', NULL));


        $product->spec = $specs;

        $product->image = $imagesFileName;
        $product->status = 1;
        $product->category_id = $request->input('product_category');
        $product->brand_id = $request->input('product_brand');
        $product->save();
    }
}
