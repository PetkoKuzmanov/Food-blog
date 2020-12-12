<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function apiIndex(Request $request) {

        // dd($request);

        // $comments = [];
        // $allComments = Comment::all();
        
        // foreach ($allComments as $comment) {
        //     if ($comment->post->post_id === $request->post_id) {
        //         $comments[] = $comment;
        //     }
        // }

        $comments = Post::all()->find($request->post_id)->comments;

        return $comments;
    }

    public function apiStore(Request $request) {
        $comment = new Comment;

        dd($request);
        $validatedData = $request->validate([
            'content' => 'required|max:100',
            'post_id' => 'required',
        ]);

        $comment->content = $validatedData['content'];
        $comment->user_id = Auth::id();
        $comment->post_id = $validatedData['post_id'];
        $comment->save();

        return $comment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
