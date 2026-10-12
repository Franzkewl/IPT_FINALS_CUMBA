<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('equipment')->orderBy('category_name')->paginate(10);
            return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'category_name' => ['required', 'string', 'max:100', 'unique:categories,category_name'],
        'description'   => ['nullable', 'string', 'max:500'],
        'is_active'     => ['required', 'boolean'],
        ]);

        Category::create($data);
        
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        $category->load('equipment');
        return view('categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

    return view('categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Category $category)
    {
    $data = $request->validate([
        'category_name' => ['required', 'string', 'max:100',
            Rule::unique('categories', 'category_name')->ignore($category->category_id, 'category_id')],
        'description'   => ['nullable', 'string', 'max:500'],
    ]);

    $category->update($data);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->equipment()->exists()) {
            return back()->with('error', 'Cannot delete: this category still has equipment.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
