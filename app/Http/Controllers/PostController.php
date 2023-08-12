<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $post = $request->validated();
        $post['user_id'] = auth()->id();
        Post::create($post);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->orderByDesc('created_at')->paginate(25);

        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id === auth()->id())
            return view('posts.edit', compact('post'));

        return redirect()->back();
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id === auth()->id())
            $post->delete();

        return redirect()->back();
    }
}
