<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::withCount('comments')
                ->orderByDesc('created_at')
                ->paginate(12)
        ]);
    }

    public function create()
    {
        return auth()->id() ? view('posts.create') : back();
    }

    public function store(PostRequest $request)
    {
        auth()->user()->posts()->create($request->validated());
        return redirect()->route('post.index');
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
        $post->update($request->validated());
        return redirect("/post/" . $post->id);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id === auth()->id())
            $post->delete();
        return back();
    }
}
