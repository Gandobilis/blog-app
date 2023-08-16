<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments')
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
            : redirect()->back());
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->back();
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
}
