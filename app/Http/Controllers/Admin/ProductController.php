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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        $products = Product::with('category', 'brand')->get();
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
            // 'image' => 'required|array|min:1',
            'image' => 'array',
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
        $product->slug = Str::slug($product->name);
        $product->price = $request->input('price');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');

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
        if (!empty($request->input('attribute_id'))) {

            for ($i = 0; $i < count($request->input('attribute_id')); $i++) {

                $sync_data[$request->input('attribute_id')[$i]] = ['value' => $request->input('attribute_value')[$i]];
            }
        }

        $product->attributes()->attach($sync_data);
        return back()->with('status', 'Le produit ' . $product->name . ' a été crée avec succès.');
    }


    public function edit($slug)
    {

        $product = Product::with('category', 'brand', 'attributes', 'stock')->where('slug', $slug)->first();
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

    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $validated = $request->validate([
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'name' => 'required|unique:App\Models\Product,name,' . $product->id,
            // 'image' => 'required|array|min:1',
            'image.*' => 'image|nullable|max:1999',
            'short_description' => 'required',
            'long_description' => 'required',
            'specName' => 'array|min:1',
            'specValue' => 'array|min:1',
            'stock' => 'numeric',
        ]);
        $product = Product::where('slug', $slug)->first();

        $product->name = $request->input('name');
        $product->slug = Str::slug($product->name);
        $product->price = $request->input('price');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');

        if ($request->hasFile('image')) {
            $this->deleteImages($product->image);
            $imagesFileName = array();
            foreach ($request->file('image') as $file) {
                $imagesFileName[] = $this->saveImages($file);
            }
        }

        // $category = Category::find($inputs['id']);
        // $category->update($inputs);
        return back()->with('status', 'Le produit ' . $product->name . ' a été mis à jour avec succès.');
    }

    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->first();
        foreach ($product->image as $file) {
            $this->deleteImages($file);
        }
        $product->delete();
        return back()->with('status', 'Le produit ' . $product->name . ' a été supprimée avec succès.');
    }

    public function activateProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product->status = 1;
        $product->save();
        return back()->with('status', 'Le product ' . $product->name . ' a été activé avec succès.');
    }

    public function desactivateProduct($slug)
    {
        $product = Product::find($slug);
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


    public function findAutocomplete(Request $request)
    {
        // $term = trim($request->q);

        // if (empty($term)) {
        //     return Response::json([]);
        // }

        // $products = Product::search($term)->limit(5)->get();

        // $formatted_products = [];

        // foreach ($products as $product) {
        //     $formatted_products[] = ['id' => $product->id, 'text' => $product->name];
        // }
        // // dd(Response::json($formatted_products));
        // return Response::json($formatted_products);

        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Product::select("slug", "id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
