<?php

namespace App\Http\Controllers;

use App\Models\UserMedia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserMediaResource;

class UserMediaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');

    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        // return UserMediaResource::collection($user->userMedia);
        return UserMediaResource::collection(UserMedia::paginate(5));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $media = new UserMedia($request->all());
        $user->userMedia()->save($media);
        return response([
            'message' => 'Media saved successfully'
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, UserMedia $userMedia)
    {
        // $media =User::with('userMedia')->find($user);
        // $media = UserMedia::with('user')->find($userMedia);
        // foreach ($media as $userMedia => $userMedia) {
        //     return $userMedia;
        // }
        // $media = $user->userMedia()->findOrfail($userMedia);
        $media = UserMedia::find($userMedia->id);
        $media->$user;
        $data = $media;
        // dd($data);
        return response([
            "data" => $data
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMedia $userMedia)
    {
        $userMedia->update($request->all());
        return response('Media updated successfully', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMedia $userMedia)
    {
        $userMedia->delete();
        return response('Media deleted', 204);
    }
}
