<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\DataTables\ProductsDataTable;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        $products = Product::with('category', 'brand')->get();
        // return view('admin.pages.product.index')->with('products', $products);
        // $product = Product::find(51);
        // $res = "";
        // foreach ($product->image as $image) {
        //     $res .= "***" . $image;
        // }
        // dd($res);
        return $dataTable->render('admin.pages.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        return view('admin.pages.product.create')
            ->with([
                'categories' => $categories,
                'brands' => $brands,
                'attributes' => $attributes
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'name' => 'required|unique:App\Models\Product,name',
            'image' => 'required|array|min:1',
            'image.*' => 'image|nullable|max:1999',
            'short_description' => 'required',
            'long_description' => 'required',
            'specName' => 'array|min:1',
            'specValue' => 'array|min:1',
            'stock' => 'numeric',


        ]);
        if ($request->hasFile('image')) {
            $imagesFileName = array();
            foreach ($request->file('image') as $file) {
                $imagesFileName[] = $this->saveImages($file);
            }
        } else {
            $imagesFileName[] = 'noImage.jpg';
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');

        // $specs = array_combine($request->input('specName'), $request->input('specValue'));
        // // Filtering the empty array
        // $specs = array_diff($specs, array('', NULL));
        // $product->spec = $specs;

        // if (!$product->attributes()->attach($request->input('attribute_id'), ['value' => $request->input('attribute_value')])) {

        //     // throw new FailedJobCreateException;
        //   }

        $product->spec = "";

        //$product->attributes()->attach($request->input('attribute_id'), ['value' => $request->input('attribute_value')]);
        $product->image = $imagesFileName;
        $product->status = 1;
        $product->category_id = $request->input('category');
        $product->brand_id = $request->input('brand');

        // $stock = new Stock(['stock' => $request->input('stock'), 'low_stock_amount' => 5]);
        // $product->stock()->save($stock);

        $product->save();
        $stock = $product->stock()->create(['stock' => $request->input('stock'), 'low_stock_amount' => 5]);

        $sync_data = [];
        for ($i = 0; $i < count($request->input('attribute_id')); $i++)
            $sync_data[$request->input('attribute_id')[$i]] = ['value' => $request->input('attribute_value')[$i]];

        $product->attributes()->attach($sync_data);
    }


    public function edit($id)
    {

        $product = Product::with('category', 'brand', 'attributes', 'stock')->find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        return view('admin.pages.product.edit')
            ->with([
                'product' => $product,
                'categories' => $categories,
                'brands' => $brands,
                'attributes' => $attributes
            ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'name' => 'required|unique:App\Models\Product,name',
            'image' => 'required|array|min:1',
            'image.*' => 'image|nullable|max:1999',
            'short_description' => 'required',
            'long_description' => 'required',
            'specName' => 'array|min:1',
            'specValue' => 'array|min:1',
            'stock' => 'numeric',


        ]);
        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');
        $product->spec = "";

        if ($request->has('image')) {
            $this->deleteImages($request->input('image'));
        }

        // $category = Category::find($inputs['id']);
        // $category->update($inputs);
        // return back()->with('status', 'La catégorie ' . $category->name . ' a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        foreach ($product->image as $file) {
            $this->deleteImages($file);
        }
        $product->delete();
        return back()->with('status', 'Le produit ' . $product->name . ' a été supprimée avec succès.');
    }

    public function activateProduct($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return back()->with('status', 'Le product ' . $product->name . ' a été activé avec succès.');
    }

    public function desactivateProduct($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        return back()->with('status', 'Le product ' . $product->name . ' a été desactivé avec succès.');
    }

    protected function saveImages($file)
    {
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

        return $fileNameToStore;
    }

    protected function deleteImages($name)
    {
        if (Storage::exists('public/product_images/' . $name)) {

            Storage::delete('public/product_images/' . $name);
        }
    }
}