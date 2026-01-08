<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\product;
use App\Services\WebScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    // public function store(StoreproductRequest $request)
    // {
    //     $data = $request->validated();
    //     $product = product::create($data);
    //     return response()->json([
    //         'is_scucess' => true,
    //         'message'=> 'category created scucessfully',

    //     ],200);
    // }

public function store(Request $request)
{
    $validated = $request->validate([
        'name'                  => 'required|string|max:255',
        'description'           => 'nullable|string',

        'weight'                => 'required|numeric|min:0.01',
        'karat'                 => 'required|in:24,22,21,18,14,12,10,9',
        'type'                  => 'nullable|string|max:100',

        'gold_price_per_gram'   => 'required|numeric|min:0',
        'making_fee'            => 'nullable|numeric|min:0',

        'stock'                 => 'required|integer|min:0',
        'category_id'           => 'nullable|exists:categories,id',

        'images'                => 'nullable|array',
        'images.*'              => 'image|mimes:jpg,jpeg,png,webp|max:2048',

        'is_store_own'          => 'required|boolean',
        'is_active'             => 'sometimes|boolean',
    ]);

    return DB::transaction(function () use ($validated, $request) {

        /* ---------------------------
        Price calculation
        ---------------------------- */
        $goldValue  = $validated['weight'] * $validated['gold_price_per_gram'];
        $makingFee  = $validated['making_fee'] ?? 0;
        $totalPrice = $goldValue + $makingFee;

        /* ---------------------------
        Image upload
        ---------------------------- */
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        /* ---------------------------
        Ownership logic
        ---------------------------- */
        $userId = null;

        if ($validated['is_store_own'] === false) {
            // product belongs to user (consignment)
            $userId = auth()->id();
        }

        /* ---------------------------
           Create product
        ---------------------------- */
        $product = Product::create([
            'name'                => $validated['name'],
            'description'         => $validated['description'] ?? null,

            'weight'              => $validated['weight'],
            'karat'               => $validated['karat'],
            'type'                => $validated['type'] ?? null,

            'gold_price_per_gram' => $validated['gold_price_per_gram'],
            'making_fee'          => $makingFee,
            'total_price'         => $totalPrice,

            'stock'               => $validated['stock'],
            'category_id'         => $validated['category_id'] ?? null,

            'images'              => $imagePaths ?: null,
            'is_store_own'        => $validated['is_store_own'],
            'user_id'             => $userId,

            'is_active'           => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product,
        ], 201);
    });
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
