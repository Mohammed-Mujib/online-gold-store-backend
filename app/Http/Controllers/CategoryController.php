<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.-------------------------------------------------------------------
     */
    public function index()
    {
        $data = Category::all();
        return response()->json([
        'data' => $data
        ]);
    }
    /**
     * Store a newly created resource in storage.-----------------------------------------------------------
     */
    public function store(StorecategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return response()->json([
            'is_scucess' => true,
            'message'=> 'category created scucessfully',

        ],200);
    }

    /**
     * Display the specified resource.-----------------------------------------------------------------------
     */
    public function show(Category $category)
    {
        return response()->json([
            'is_success' => true,
            'message' => 'Category retrieved successfully',
            'data' => $category
        ], 200);
    }

    /**
     *Update the specified resource in storage.-----------------------------------------------------------------------
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $category->update($data);

        return response()->json([
            'is_success' => true,
            'message' => 'Category updated successfully',
            'data' => $category,
        ], 200);
    }

    /**
     * Remove the specified resource from storage. -------------------------------------------------------
     */
    public function destroy(Category $category)
    {
        // Ensure the category exists before trying to delete it
        if (!$category) {
            return response()->json([
                'is_success' => false,
                'message' => 'Category not found'
            ], 404);  // Return 404 if category doesn't exist
        }

        // Perform the deletion
        $category->delete();

        return response()->json([
            'is_success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

}
