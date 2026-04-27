<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function index(Request $request) {
        $products = Product::active()
            ->when($request->search, fn($q) => $q->search($request->search))
            ->paginate(15);

        return response()->json($products);
    }

    public function show(Product $product) {
        return response()->json($product);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        $product = Product::create($data);
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'stock'       => 'sometimes|required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'is_active'   => 'boolean',
        ]);
        $product->update($data);
        return response()->json($product);
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
