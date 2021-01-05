<?php

namespace App\Http\Controllers;

use App\DataTables\BrandsDataTable;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index(BrandsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.brand.index');
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.pages.brand.edit')->with(['brand' => $brand]);
    }

    public function store(Request $request)
    {
        $inputs = $this->getInputs($request);
        Brand::create($inputs);
        return back()->with('status', 'La catégorie ' . $inputs['name'] . ' a été inséré avec succès.');
    }

    public function update($request)
    {
        $inputs = $this->getInputs($request);

        if ($request->has('image')) {
            $this->deleteImages($inputs['image']);
        }

        $brand = Brand::find($inputs['id']);
        $brand->update($inputs);
        return back()->with('status', 'La catégorie ' . $brand->name . ' a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $this->deleteImages($brand->image);
        $brand->delete();
        return back()->with('status', 'La catégorie ' . $brand->name . ' a été supprimée avec succès.');
    }

    protected function getInputs($request)
    {
        $request->validate([
            'name' => 'required|unique:App\Models\Brand,name',
            'image' => 'image|nullable|max:1999',

        ]);
        $inputs = $request->except(['image']);

        // $inputs['status'] = $request->has('active');

        if ($request->hasFile('image')) {
            $inputs['image'] = $this->saveImages($request);
        } else {

            $inputs['image'] = 'noImage.jpg';
        }

        return $inputs;
    }
    protected function saveImages($request)
    {
        // 1 get file name with extension
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        // 2 get just file name 
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // 3 get just file extension 
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        // 4 file name to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtension;

        //upload image
        $path = $request->file('image')->storeAs('public/brand_images', $fileNameToStore);

        return $fileNameToStore;
    }

    protected function deleteImages($name)
    {
        File::delete([
            public_path('public/brand_images') . $name
        ]);
    }
}
