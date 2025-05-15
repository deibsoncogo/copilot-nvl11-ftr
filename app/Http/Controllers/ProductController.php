<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(["message" => "No products found"], 404);
        }

        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "description" => "required|string",
                "price" => "required|numeric",
                "stock" => "required|integer",
            ]);

            $product = Product::create($validatedData);

            return response()->json($product, 201);
        } catch (ValidationException $e) {
            return response()->json(["errors" => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(["error" => "Product not found"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $validatedData = request()->validate([
                "name" => "sometimes|required|string|max:255",
                "description" => "sometimes|required|string",
                "price" => "sometimes|required|numeric",
                "stock" => "sometimes|required|integer",
            ]);

            $product->update($validatedData);

            return response()->json($product, 200);
        } else {
            return response()->json(["error" => "Product not found"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();

            return response()->json(null, 204);
        } else {
            return response()->json(["error" => "Product not found"], 404);
        }
    }
}
