<?php

namespace App\Http\Controllers;

use App\Models\UserMedia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserMediaResource;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;


class UserMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_media = $user->userMedia()->get();
        return Response()->json([
            'data' => $user_media
        ]) ;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authenticatedUser  = Auth::user();
        // Validating User input

        $userMedia = $authenticatedUser->userMedia()->create([
            'file' => $request->input('file'),
        ]);

        return Response()->json($userMedia);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $userMedia = UserMedia::find($id);

        // check for user access
        if ($user->id !== $userMedia->user_id) {
            return response([
                'message' => 'You do not have authorisation to access this media'
            ]);
        };

        return Response()->json([
            'data' => $userMedia,
        ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $userMedia = UserMedia::find($id);

        // check for user access
        if ($user->id !== $userMedia->user_id) {
            return response([
                'message' => 'You do not have authorisation to access this media'
            ]);
        } else {
            $userMedia->update($request->all());
        };
        return response([
            'message' => 'Updated successfully',
            'data' => $userMedia
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMedia  $userMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $userMedia = UserMedia::find($id);

        // check for user access
        if ($user->id !== $userMedia->user_id) {
            return response([
                'message' => 'You do not have authorisation to access this media'
            ]);
        } else {
            $userMedia->delete();
        };
        return response([
            'message' => 'Deleted successfully',
            'data' => null
        ]);
    }
}
