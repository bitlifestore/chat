<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller {

    public function index(Request $request) {
        $products = Product::query()
            ->when($request->search, fn($q) => $q->search($request->search))
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->when($request->status === 'active', fn($q) => $q->active())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        Product::create($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully!');
    }

    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product) {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted!');
    }
}
