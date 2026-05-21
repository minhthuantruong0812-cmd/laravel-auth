<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Danh sách category
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    // Form thêm category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Lưu category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Thêm category thành công');
    }

    // Form sửa
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect('/admin/categories')
            ->with('success', 'Cập nhật category thành công');
    }

    // Xóa category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/admin/categories')
            ->with('success', 'Xóa category thành công');
    }
}