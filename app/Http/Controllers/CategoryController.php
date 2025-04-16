<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('Backend.category.index',[
            'categories' => $categories
        ]);
    }
    public function create(){

        return view('Backend.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('picture')) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/categories'), $fileName);
            $data['picture'] = 'uploads/categories/' . $fileName;
        }

        Category::create($data);

        return redirect()->route('category.index')->with('status', 'Category created successfully!');
    }
        public function edit($id)
        {
            $category = Category::findOrFail($id);
            return view('Backend.category.edit', compact('category'));
        }
        public function update(Request $request, $id)
            {
                $category = Category::findOrFail($id);

                $request->validate([
                'name' => 'required',
                'picture' => 'nullable|image|max:2048',
            ]);

            $category->name = $request->name;

            if ($request->hasFile('picture')) {
                $fileName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('uploads/categories'), $fileName);
                $data['picture'] = 'uploads/categories/' . $fileName;
            }

            $category->save();

            return redirect()->route('category.index')->with('success', 'Category updated.');
        }
        public function delete($id)
        {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('category.index')->with('success', 'Category deleted.');
        }
}
