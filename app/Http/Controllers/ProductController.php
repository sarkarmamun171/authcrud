<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        return view('Backend.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Backend.product.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount ?? 0;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $fileName);
            $product->image = 'uploads/products/' . $fileName;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('Backend.product.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $fileName);
            $product->image = 'uploads/products/' . $fileName;
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted.');
    }
}
?>
