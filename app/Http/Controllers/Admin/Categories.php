<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriesModel;
use Illuminate\Support\Str;

class Categories extends Controller
{
    public function index(){
        $categories = CategoriesModel::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function save(Request $request){
            $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required'
            ]);
            $slug = Str::slug($request->name);

            CategoriesModel::create([
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully');
    }
     public function edit($id)
    {
        $category = CategoriesModel::findOrFail(dcrypttId($id));
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CategoriesModel::findOrFail(dcrypttId($id));

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // auto update slug
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = CategoriesModel::findOrFail(dcrypttId($id));
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}