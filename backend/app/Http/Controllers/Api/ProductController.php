<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {try {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'available' => 'nullable|boolean',
            'rate' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'sellerProduct' => 'nullable|exists:users,id',
            'img2' => 'nullable|string',
            'img3' => 'nullable|string',
            'img4' => 'nullable|string',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'description' => 'string',
            'available' => 'boolean',
            'rate' => 'nullable|integer',
            'createdAt' => 'date',
            'quantity' => 'nullable|integer',
            'sellerProduct' => 'exists:users,id',
            'img2' => 'string',
            'img3' => 'string',
            'img4' => 'string',
            'updatedAt' => 'date',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
