<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function apiIndex(Request $request) {
        $comments = Comment::where('post_id', $request->id)->with('user')->get();

        return $comments;
    }

    public function apiStore(Request $request) {
        $comment = new Comment;

        $validatedData = $request->validate([
            'content' => 'required|max:100',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        $comment->content = $validatedData['content'];
        $comment->user_id = $validatedData['user_id'];
        $comment->post_id = $validatedData['post_id'];
        $comment->save();

        $commentToReturn = Comment::where('id', $comment->id)->with('user')->get();
        return $commentToReturn;
    }

    public function apiDestroy(Request $request) {
        $commentToDelete = Comment::where('id', $request->id)->get()->first();
        
        // dd(Comment::where('post_id', $request->post_id)->with('user')->get());
        $commentToDelete->delete();

        $comments = Comment::where('post_id', $request->post_id)->with('user')->get();

        return $comments;
    }

    public function apiEdit(Request $request) {
        
    }

    public function apiUpdate(Request $request) {
        
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
