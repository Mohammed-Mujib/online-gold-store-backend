<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\product;
use App\Services\WebScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= product::all();
        return response()->json([
        'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreProductRequest $request)
{
    // Get validated data from Form Request
    $attr = $request->validated();

    // Create product first
    $product = Product::create($attr);

    $imagePaths = [];

    // Handle images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {

            $path = $image->store(
                "products/{$product->id}",
                'public'
            );

            $imagePaths[] = "storage/" . $path;
        }

        // Update product images
        $product->update([
            'images' => $imagePaths
        ]);
    }

    return response()->json($product, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json([
            'is_success' => true,
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(StoreProductRequest $request, Product $product)
{
    // Get validated data
    $attr = $request->validated();

    // Update basic product data
    $product->update($attr);

    // Get existing images (if any)
    $imagePaths = $product->images ?? [];

    // Handle new images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {

            $path = $image->store(
                "products/{$product->id}",
                'public'
            );

            $imagePaths[] = "storage/" . $path;
        }

        // Update images array
        $product->update([
            'images' => $imagePaths
        ]);
    }

    return response()->json($product);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
          // Ensure the category exists before trying to delete it
        if (!$product) {
            return response()->json([
                'is_success' => false,
                'message' => 'Product not found'
            ], 404);  // Return 404 if category doesn't exist
        }

        // Perform the deletion
        $product->delete();

        return response()->json([
            'is_success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
