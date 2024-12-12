<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function create_by_category(Category $category)
    {
        $properties = Property::where('category_id', $category->id)->get();
        return view('admin.products.create_by_category', compact('category', 'properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        // dd($request->all());
        $product = Product::create($request->all());

        if ($request->property) {
            foreach ($request->property as $key => $value) {
                PropertyValue::create([
                    'category_id' => $request->category_id,
                    'property_id' => $key,
                    'product_id' => $product->id,
                    'value' => $value,
                ]);
            }
        }
        

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $properties = $product->get_properties();
        return view('admin.products.show', compact('product', 'properties'));
    }

    public function edit(Product $product)
    {
        $all_properties = Property::where('category_id', $product->category_id)->get();
        $product_properties = $product->get_properties();
        return view('admin.products.edit', compact('product', 'product_properties', 'all_properties'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product->update($request->all());
        $properties = PropertyValue::where('product_id', $product->id)->delete();

        foreach($request->property as $key => $value){
            $prop_value = PropertyValue::create([
                'category_id' => $product->category_id,
                'property_id' => $key,
                'product_id' => $product->id,
                'value' => $value,
            ]);
        }

        return redirect()->route('admin.products.show', $product)
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function variants_create(Product $product)
    {
        return view('admin.products.variants_create', compact('product'));
    }

    public function variants_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product = Product::find($request->id);

        $variant = new ProductVariant([
            'title' => $request['title'],
            'price' => $request['price'],
            'product_id' => $request['id'],
            'quantity' => $request['quantity'],
        ]);

        $product->variants()->save($variant);

        return redirect()->route('admin.products.show', $product)
            ->with('success', 'Product variant added successfully.');
    }

    public function variants_edit(Product $product, ProductVariant $product_variant)
    {
        // $product_variant = ProductVariant::find()
        return view('admin.products.variants_edit', compact('product', 'product_variant'));
    }

    public function variants_update(Request $request, Product $product, ProductVariant $product_variant)
    {
        $request->validate([
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $product_variant->update($request->all());

        return redirect()->route('admin.products.show', $product)
            ->with('success', 'Product variant added successfully.');
    }

    public function variants_delete(Product $product, ProductVariant $product_variant)
    {
        $product_variant->delete();

        return redirect()->route('admin.products.show', $product)
            ->with('success', 'Product deleted successfully');
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->input('price_from'));
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->input('price_to'));
        }

        // Добавьте другие критерии фильтрации

        $products = $query->get();

        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }
}
