<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\CommentLike;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $data = [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->validated('content')
        ];
        Comment::create($data);

        return back();
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $newData = [
            'content' => $request->validated('content')
        ];
        if ($comment->user_id === auth()->id())
            $comment->update($newData);

        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->id())
            $comment->delete();

        return back();
    }

    public function toggleLike(Comment $comment)
    {

        if (!$comment->likes->contains(auth()->id()))
            $comment->likes()->attach(auth()->id());
        else
            $comment->likes()->detach(auth()->id());

        return back();
    }
}
