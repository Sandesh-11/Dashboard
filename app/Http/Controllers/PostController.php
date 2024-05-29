<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Events\NewPostCreated;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::all();
    return view('posts.index', compact('posts'));
}

public function create()
{
    return view('posts.create');
}


public function store(Request $request)
{
    $request->validate([
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'nullable|string|max:255',
    ]);

    $post = new Post();
    $post->user_id = auth()->id();
    if ($request->hasFile('photo')) {
        $post->photo = $request->file('photo')->store('photos', 'public');
    }

    $post->status = $request->status;
    $post->save();


    broadcast(new NewPostCreated($post))->toOthers();
    

    return redirect()->route('posts.index');
}



public function edit(Post $post)
{
    if (auth()->id() != $post->user_id) {
        abort(403);
    }
    return view('posts.edit', compact('post'));
}


public function update(Request $request, Post $post)
{
    $request->validate([
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|string|max:255',
    ]);

    if ($request->hasFile('photo')) {
        // Delete the old photo if it exists
        if ($post->photo) {
            Storage::disk('public')->delete($post->photo);
        }
        $post->photo = $request->file('photo')->store('photos', 'public');
    }

    $post->status = $request->status;
    $post->save();

    return redirect()->route('posts.show', $post);
}



public function destroy(Post $post)
{
    if (auth()->id() != $post->user_id) {
        abort(403);
    }

    $post->delete();

    return redirect()->route('posts.index');
}
public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

}
