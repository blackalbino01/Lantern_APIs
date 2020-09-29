<?php

namespace App\Http\Controllers;

use App\Models\UserMedia;
use Illuminate\Http\Request;
use App\Models\User;

class UserMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $user->userMedia;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $media =UserMedia::find($userMedia);
        $data = $media;
        return response([
            "data" => $data
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMedia $userMedia)
    {
        //
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
