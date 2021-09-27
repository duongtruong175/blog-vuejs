<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class BackendTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $tags = Tag::paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'tags' => $tags
        ];

        return response()->json($viewdata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        // Validate errors (StoreTagRequest validated)
        $request->name = trim($request->name);
        $name = preg_replace('/\s\s+/', ' ', $request->name);
        $tag = Tag::create([
            'name' => $name
        ]);

        return $tag;
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
        $tag = Tag::findOrFail($id);

        $viewdata = [
            'tag' => $tag
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
    public function update(StoreTagRequest $request, $id)
    {
        //
        $tag = Tag::findOrFail($id);
        $name = preg_replace('/\s\s+/', ' ', $request->name);
        $tag->name = $name;

        $tag->save();

        return $tag;
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
        $tag = Tag::findOrFail($id);

        // Detach all relationships
        $tag->articles()->detach();
        $tag->forceDelete();

        return $tag;
    }
}
