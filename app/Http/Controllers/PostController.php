<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);

        if (request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%');
        }

        return view('dashboard.index', ['posts' => $posts->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|unique:posts',
        //     'category_id' => 'required',
        //     'body' => 'required',
        // ]);

        Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:4|max:255',
            'category_id' => 'required',
            'body' => 'required|min:100',
        ], [], [
            'title' => 'Post Title',
            'category_id' => 'Post Category',
            'body' => 'Post Body',
        ])->validate();

        Post::create([
            'title' => $request->title,
            'slug' => str($request->title)->slug(),
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
            'body' => $request->body,
        ]);

        return redirect('/dashboard')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            'title' => 'required|min:4|max:255|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'body' => 'required|min:100',
        ], [], [
            'title' => 'Post Title',
            'category_id' => 'Post Category',
            'body' => 'Post Body',
        ])->validate();

        $post->update([
            'title' => $request->title,
            'slug' => str($request->title)->slug(),
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
            'body' => $request->body,
        ]);

        return redirect('/dashboard')->with('success', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with('success', 'Your post has been deleted!');
    }
}
