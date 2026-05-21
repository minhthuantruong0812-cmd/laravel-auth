<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Danh sách product
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    // Form thêm product
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.products.create', compact('categories'));
    }

    // Lưu product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/products'), $imageName);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/admin/products')
            ->with('success', 'Thêm product thành công');
    }

    // Form sửa
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status,
        ];

        // Nếu upload ảnh mới
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/products'), $imageName);

            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect('/admin/products')
            ->with('success', 'Cập nhật product thành công');
    }

    // Xóa product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/admin/products')
            ->with('success', 'Xóa product thành công');
    }

    // Frontend product list
    public function shop(Request $request)
    {
        $query = Product::where('status', 1);

        // Search product
        if ($request->search) {

            $query->where('name', 'LIKE', '%' . $request->search . '%');

        }

        // Filter category
        if ($request->category) {

            $query->where('category_id', $request->category);

        }

        $products = $query->latest()->get();

        $categories = Category::where('status', 1)->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    // Frontend product detail
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('frontend.products.detail', compact('product'));
    }
}

