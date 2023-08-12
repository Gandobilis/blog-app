<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        Comment::create($request->validated());
        return back();
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->id())
            $comment->delete();
        return back();
    }
}
