<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\DataTables\CategoriesDataTable;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(CategoriesDataTable $dataTable)
    {

        return $dataTable->render('admin.pages.category.index');
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.category.create')->with(['category' => $category]);
    }

    public function store(Request $request)
    {
        // $inputs = $request->input();
        $inputs = $this->getInputs($request);
        $category = Category::create($inputs);
        return back()->with('status', 'La catégorie ' .  $category->name . ' a été inséré avec succès.');
    }

    public function update(Request $request)
    {
        // $inputs = $this->getInputs($request);
        // $category = Category::find($inputs['id']);
        $request->validate([
            'name' => 'required',
            'image' => 'image|nullable|max:1999',

        ]);
        $category = Category::find($request->input('id'));
        $inputs = $request->except(['image']);
        if ($request->hasFile('image')) {
            $this->deleteImages($category->image);
            $inputs['image'] = $this->saveImages($request);
        } else {
            $inputs['image'] = 'noImage.jpg';
        }
        $category->update($inputs);
        return back()->with('status', 'La catégorie ' . $category->name . ' a été mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $this->deleteImages($category->image);
        $category->delete();
        return back()->with('status', 'La catégorie ' . $category->name . ' a été supprimée avec succès.');
    }

    protected function getInputs($request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|nullable|max:1999',

        ]);
        $inputs = $request->except(['image']);

        if ($request->hasFile('image')) {
            $this->deleteImages($request->input('image'));
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
        $path = $request->file('image')->storeAs('public/category_images', $fileNameToStore);

        return $fileNameToStore;
    }

    protected function deleteImages($name)
    {
        if (Storage::exists('public/category_images/' . $name))
            Storage::delete('public/category_images/' . $name);
        // File::delete([
        //     public_path('public/category_images' . $name)
        // ]);
    }
}
