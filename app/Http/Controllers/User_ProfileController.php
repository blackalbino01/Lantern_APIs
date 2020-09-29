<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_Profile;
use App\Models\User;
use App\Models\Relationship;
use Illuminate\Support\Facades\Auth;

class User_ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $user = Auth::user();

        $user_profile = $user->user_profile()->create([
            'profile__picture' => $request->profile__picture,
        ]);

        return Response()->json($user_profile); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, User $user, User_Profile $profile)
    {
        $user_profile = $user->find($id)->user_profile;
        $user_profile->user;
        $follower = $user->find($id)->followers;
        $following = $user->find($id)->following;

        return Response()->json([
            'data' => $user_profile,
            'follower' => $follower,
            'following' => $following
        ]);
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
        $user = Auth::user();

        $user_profile = $user->find($id)->user_profile;
        $user_profile->user;
        $user_profile->update($request->all());

        return Response()->json([
            'message' => 'User successfully updated',
            'updated' => $user_profile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user_profile = $user->user_profile;
        $user_profile->user;
        $user_profile->delete();

        return Response()->json([
            'message' => 'User profile successfully deleted!!', 200
        ]);
    }
}
