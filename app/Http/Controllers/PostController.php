<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\NutritionalInfo;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('posts.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
            'tags' => 'required',
            'images' => 'required',
            'servingSize' => 'required',
            'calories' => 'required|integer',
        ]);

        //Create the post
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->save();

        //Add the images
        foreach ($request->file('images') as $index => $file) {
            $image = new Image;
            $imageName = time() . $index . '.' . $file->extension();
            $image->url = $imageName;

            $post->images()->save($image);
            $file->move(public_path('images'), $imageName);
        }

        //Add the tags
        foreach ($request->tags as $tag_id) {
            $tag = Tag::All()->find($tag_id);
            $tag->posts()->attach($post);
        }

        //Add the nutritional info
        $nutritionalInfo = new NutritionalInfo;
        $nutritionalInfo->servingSize = $post->id;
        $nutritionalInfo->servingSize = $validatedData['servingSize'];
        $nutritionalInfo->calories = $validatedData['calories'];
        $post->nutritionalInfo()->save($nutritionalInfo);

        session()->flash('message', 'Post was created');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $users = User::all();
        return view('posts.show', ['post' => $post, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('posts.edit', ['post' => $post], ['tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:150',
            'content' => 'required',
            'tags' => 'required',
            'images' => 'nullable',
            'servingSize' => 'required',
            'calories' => 'required|integer',
        ]);

        //Create the post
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->user_id = Auth::id();
        $post->save();

        if ($request->file('images') != null) {
            //Delete the old images
            foreach ($post->images()->get() as $image) {
                $oldProfilePictureName = $image->url;
                File::delete('images/' . $oldProfilePictureName);
            }

            $post->images()->delete();

            //Add the new images
            foreach ($request->file('images') as $index => $file) {
                $image = new Image;
                $imageName = time() . $index . '.' . $file->extension();
                $image->url = $imageName;

                $post->images()->save($image);
                $file->move(public_path('images'), $imageName);
            }
        }

        //Change the tags
        $post->tags()->detach();
        foreach ($request->tags as $tag_id) {
            $tag = Tag::All()->find($tag_id);
            $tag->posts()->attach($post);
        }

        //Change the nutritional info
        $post->nutritionalInfo()->delete();
        $nutritionalInfo = new NutritionalInfo;
        $nutritionalInfo->servingSize = $post->id;
        $nutritionalInfo->servingSize = $validatedData['servingSize'];
        $nutritionalInfo->calories = $validatedData['calories'];
        $post->nutritionalInfo()->save($nutritionalInfo);

        session()->flash('message', 'Post was updated');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        foreach ($post->images()->get() as $image) {
            $oldProfilePictureName = $image->url;
            File::delete('images/' . $oldProfilePictureName);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post was deleted');
    }
}
