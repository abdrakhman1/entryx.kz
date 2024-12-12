<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
    public function index()
    {
        $properties = Property::paginate(20);
        return view('admin.properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        return view('admin.properties.show', compact('property'));
    }

    public function create()
    {
        return view('admin.properties.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        Property::create($request->all());

        return redirect()->route('admin.properties.index')
                         ->with('success', 'property created successfully.');
    }

    public function edit(Property $property)
    {
        $categories = Category::all();
        return view('admin.properties.edit', compact('property', 'categories'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $property->update([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}