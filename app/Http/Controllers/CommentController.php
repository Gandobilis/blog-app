<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = $request->validated();
        $comment['user_id'] = auth()->id();
        Comment::create($comment);
        return back();
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        if (auth()->id === $comment->user_id)
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
