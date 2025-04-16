<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('Backend.subcategory.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Backend.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'category_id');

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/subcategories'), $fileName);
            $data['picture'] = 'uploads/subcategories/' . $fileName;
        }

        SubCategory::create($data);

        return redirect()->route('sub-category.index')->with('success', 'SubCategory created.');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('Backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|max:2048',
        ]);

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;

        if ($request->hasFile('picture')) {
            $subcategory->picture = uploadImage($request->file('picture'), 'uploads/subcategories');
        }


        $subcategory->save();

        return redirect()->route('sub-category.index')->with('success', 'SubCategory updated.');
    }

    public function delete($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('sub-category.index')->with('success', 'SubCategory deleted.');
    }
}
