<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class BackendCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $categories = Category::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'categories' => $categories
        ];

        return response()->json($viewdata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // Validate errors (StoreCategoryRequest validated)
        $category = Category::create([
            'name' => $request->name
        ]);

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get data and redict to edit form
        $category = Category::findOrFail($id);

        $viewdata = [
            'category' => $category
        ];

        return response()->json($viewdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->name = $request->name;

        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);

        // Detach all relationships
        $category->articles()->detach();
        $category->forceDelete();

        return $category;
    }
}
