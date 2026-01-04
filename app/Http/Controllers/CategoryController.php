<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return response()->json([
        'data' => $data
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     */
    // public function edit(category $category)
    // {

    // }

    /**
     * Update the specified resource in storage.
     */
//  public function update(UpdateCategoryRequest $request, Category $category)
// {
//     $category->update($request->validated());

//     return response()->json([
//         'is_success' => true,
//         'message' => 'Category updated successfully',
//         'data' => $category
//     ], 200);
// }


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
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json([
            "is_scucess" =>true,
            "message" => "category deleted sucsessfuly"
        ]);
    }
}
