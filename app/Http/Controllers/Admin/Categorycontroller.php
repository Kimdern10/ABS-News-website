<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Active Categories
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Trashed Categories
     */
public function trash()
{
    $trashedCategories = Category::onlyTrashed()
        ->latest('deleted_at')
        ->paginate(10);

    return view('admin.categories.trash', compact('trashedCategories'));
}

    /**
     * Create Form
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store Category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Edit Form
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update Category
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Move To Trash
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category moved to trash successfully.');
    }

    /**
     * Restore Category
     */
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->restore();

        return redirect()
            ->route('admin.categories.trash')
            ->with('success', 'Category restored successfully.');
    }

    /**
     * Permanently Delete Category
     */
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->forceDelete();

        return redirect()
            ->route('admin.categories.trash')
            ->with('success', 'Category permanently deleted.');
    }
}