<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return response()->json([
        'data' => Category::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

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
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return response()->json([
            'is_scucess' => true,
            'message'=> 'category updated scucessfully',
        ]);
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
