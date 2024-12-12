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
        $products = Product::orderBy('id', 'desc')->paginate(20);
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
        $all_categories = Category::all();
        // dd($all_categories);
        $all_properties = Property::where('category_id', $product->category_id)->get();
        $product_properties = $product->get_properties();
        return view('admin.products.edit', compact('product', 'product_properties', 'all_properties', 'all_categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            // 'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $product->update($request->all());
        $properties = PropertyValue::where('product_id', $product->id)->delete();

        foreach ($request->property as $key => $value) {
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

    function set_visible(Product $product)
    {
        $product->visible = 1;
        $product->save();
        return back();
    }

    function set_hidden(Product $product)
    {
        $product->visible = 0;
        $product->save();
        return back();
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
            'article' => $request['article'],
            'store_place' => $request['store_place'],
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

    public function exist_properties()
    {
        $products = Product::all();
        $properties = Property::all();

        $properties_all_products = [];
        foreach ($products as $product) {
            // dd($product->get_properties());
            foreach ($product->get_properties() as $single_property) {
                // dd($single_property->property->title, $single_property->value);

                // $properties_all_products[$single_property->property->id][] = [
                //     'property_title' => $single_property->property->title,
                //     'property_value' => $single_property->value,
                // ];

                // $properties_all_products[$single_property->property->title][] = [
                //     'property_title' => $single_property->property->id,
                //     'property_value' => $single_property->value,
                // ];

                $properties_all_products[$single_property->property->title][] = $single_property->value;
            }
        }

        foreach ($properties_all_products as $key => $value) {
            $properties_all_products[$key] = array_unique($value);
        }

        // dd($properties_all_products);

        // $allPropertyValues = PropertyValue::pluck('value')->unique();
        // dd($allPropertyValues);

        $allPropertyValues = PropertyValue::with('property')->get();
        dd($allPropertyValues);

        return;
    }

    public function try_filter()
    {
        $propertyValuesGrouped = PropertyValue::with('property')
            ->get()
            ->groupBy('property_id')
            ->map(function ($values) {
                return $values->unique('value');
            });
        // dd($propertyValuesGrouped);
        // $allPropertyValues = PropertyValue::with('property')->get();
        return view('admin.products.filter', compact('propertyValuesGrouped'));
    }

    public function try_filter_submit(Request $request)
    {
        // $selectedPropertyValues = $request->input('property_values', []);

        // $filteredProductIds = PropertyValue::whereIn('id', $selectedPropertyValues)
        //     ->pluck('product_id')
        //     ->unique();

        // $filteredProducts = Product::whereIn('id', $filteredProductIds)->get();

        $selectedPropertyValues = $request->input('property_values', []);

        $productIds = PropertyValue::whereIn('id', $selectedPropertyValues)
            ->pluck('product_id')
            ->toArray();

        $filteredProductIds = [];

        foreach ($productIds as $productId) {
            $matchingPropertyValuesCount = PropertyValue::where('product_id', $productId)
                ->whereIn('id', $selectedPropertyValues)
                ->count();

            if ($matchingPropertyValuesCount === count($selectedPropertyValues)) {
                $filteredProductIds[] = $productId;
            }
        }

        $filteredProducts = Product::whereIn('id', $filteredProductIds)->get();


        return view('admin.products.filter_result', ['products' => $filteredProducts]);
    }

    public function try_filter2(Request $request)
    {
        // ищем где бренд MEGI DOORS

        $property_id = 4;
        $property_name = 'бренд';
        $property_value = 'MEGI DOORS';

        // начала получим все значения где value = MEGI DOORS

        $prop_values = PropertyValue::where('value', $property_value)->get();
        // dd($prop_values);

        // теперь получим все значения где property_name = бренд

        $properties = Property::where('title', $property_name)->get();
        // dd($properties);

        // теперь получим все значения где property_name = 4

        $properties = Property::where('id', $property_id)->get();
        // dd($properties);

        // теперь берем все свойства с id = 4 и значением MEGI DOORS

        $prop_values = PropertyValue::where('value', $property_value)->where('property_id', $property_id)->get();
        // dd($prop_values);
        $products = [];
        foreach ($prop_values as $prop_value) {
            $products[] = $prop_value->product;
        }
        dd($products);

        // !!! РАБОТАЕТ !!!
        // нужно использовать построитель запросов, новый запрос с каждому свойству
    }

}
