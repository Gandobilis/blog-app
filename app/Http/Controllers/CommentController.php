<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        Comment::create($request->validated());

        return redirect()->back();
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->validated()['content']
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }

        return redirect()->back();
    }
}
