<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\product;
use App\Services\WebScraper;

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
    public function store(StoreproductRequest $request)
    {
        $data = $request->validated();
        $product = product::create($data);
        return response()->json([
            'is_scucess' => true,
            'message'=> 'category created scucessfully',

        ],200);
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
    public function update(UpdateproductRequest $request, product $product)
    {
        //
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
