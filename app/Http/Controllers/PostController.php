<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::with('user')
                ->orderByDesc('created_at')
                ->paginate(10)
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string',
            'img_path' => 'nullable|string',
        ]);
        $post['user_id'] = auth()->id();
        Post::create($post);

        return redirect('/');
    }

    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::get($id),
            'comments' => Comment::where('post_id', $id)
        ]);
    }

    public function edit(Post $post)
    {
        return $post->user->id === auth()->id()
            ? view('posts.edit', ['post' => $post])
            : redirect()->back();
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string',
            'img_path' => 'nullable|string',
        ]));

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id === auth()->id()) {
            $post->delete();
            return redirect('/');
        }
        return redirect()->back();
    }
}
