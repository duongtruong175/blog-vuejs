<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class BackendCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data
        $comments = Comment::with(['user', 'article'])->paginate(request('length') ? request('length') : 5);

        $viewdata = [
            'comments' => $comments
        ];

        return response()->json($viewdata);
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
        $comment = Comment::findOrFail($id);

        $comment->forceDelete();

        return $comment;
    }
}
