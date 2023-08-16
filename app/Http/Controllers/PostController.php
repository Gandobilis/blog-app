<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments', 'likes')
            ->orderByDesc('created_at')
            ->paginate(12);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $postData = $request->validated();
        auth()->user()->posts()->create($postData);

        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()
                ->orderByDesc('created_at')
                ->paginate(10)
        ]);
    }

    public function edit(Post $post)
    {
        return ($post->user_id === auth()->id()
            ? view('posts.edit', compact('post'))
            : back());
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id === auth()->id())
            $post->update($request->validated());

        return back();
    }

    public function destroy(Post $post)
    {
        if ($post->user_id === auth()->id()) {
            $post->delete();
            return redirect()->route('post.index');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function toggleLike(Post $post)
    {
        $post->likes->contains(auth()->id()) ?
            $post->likes()->detach(auth()->id()) :
            $post->likes()->attach(auth()->id());

        return back();
    }
}
