<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve all users along with their products
            $usersWithProducts = User::with('products')->get();

            // Check if any users are found
            if ($usersWithProducts->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No users found',
                    'data' => null // No data to return if no users are found
                ], 404);
            }

            // Iterate over each user to check if they have any products
            $responseData = [];
            foreach ($usersWithProducts as $user) {
                // Check if the user has products
                if (!$user->products->isEmpty()) {
                    // Construct user data with associated products
                    $userData = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'products' => $user->products
                    ];
                    $responseData[] = $userData;
                }
            }

            // Check if any users with products are found after filtering
            if (empty($responseData)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No users with products found',
                    'data' => null // No data to return if no users with products are found
                ], 404);
            }

            // Return a successful response with the list of users and their products
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $responseData
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'nullable|numeric',
                'description' => 'nullable|string',
                'available' => 'nullable|boolean',
                'rate' => 'nullable|integer',
                'quantity' => 'nullable|integer',
                'seller_id' => 'nullable|exists:users,id',
                'img2' => 'nullable|string',
                'img3' => 'nullable|string',
                'img4' => 'nullable|string',
            ]);

            $product = Product::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Product retrieved successfully',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $request->validate([
                'name' => 'string|max:255',
                'price' => 'numeric',
                'description' => 'string',
                'available' => 'boolean',
                'rate' => 'nullable|integer',
                'quantity' => 'nullable|integer',
                'seller_id' => 'exists:users,id',
                'img2' => 'string',
                'img3' => 'string',
                'img4' => 'string',
            ]);

            $product->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
