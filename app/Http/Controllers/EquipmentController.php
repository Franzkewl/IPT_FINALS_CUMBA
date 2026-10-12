<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::with('category')->orderBy('equipment_name', 'asc')->paginate(10);
        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('equipment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'equipment_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'status' => ['required', 'in:available,borrowed,maintenance'],
        ]);

        Equipment::create($data);
        
        $equipment = Equipment::create($data);
        $equipment->category->refreshTotalItems();

        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        $thiscategories = Category::orderBy('category_name')->get();
        return view('equipment.edit', compact('equipment', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'equipment_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'status' => ['required', 'in:available,borrowed,maintenance'],
        ]);

        $equipment->update($data);

        $oldCategory = $equipment->category;
        $equipment->update($data);
        $oldCategory->refreshTotalItems();
        $equipment->refresh()->category->refreshTotalItems();


        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        $category = $equipment->category;
        $equipment->delete();
        $category->refreshTotalItems();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
    }
}
