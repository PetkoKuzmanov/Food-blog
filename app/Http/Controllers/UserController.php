<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\ProfilePicture;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function chefs()
    {
        //
        $users = User::all();
        $chefs = [];

        foreach ($users as $user) {
            if ($user->role == "chef") {
                $chefs[] = $user;
            }
        }
        return view('users.index', ['users' => $chefs]);
    }

    /**
     * Display a listing of the posts of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function posts(User $user)
    {
        //
        $posts = $user->posts;
        return view('users.posts', ['posts' => $posts]);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validatedData = $request->validate([
            'profilePicture' => 'required',
            'name' => 'required',
        ]);

        $user->name = $validatedData['name'];
        $user->save();

        $file = $request->file('profilePicture');

        $profilePicture = new ProfilePicture();
        $imageName = time().'.'.$file->extension(); 
        $profilePicture->url = $imageName;
        $file->move(public_path('profilePictures'), $imageName);

        $user->profilePicture()->delete();
        $user->profilePicture()->save($profilePicture);
        
        session()->flash('message', 'Your profile was updated');
        return redirect()->route('users.show', ['user' => $user]);
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
