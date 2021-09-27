<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        // Validate errors (StoreCommentRequest validated)
        $comment = Comment::create([
            'article_id' => $request->article_id,
            'user_id' => $request->user_id,
            'content' => $request->content
        ]);
        $comment = $comment->load('user');

        return $comment;
    }
}
