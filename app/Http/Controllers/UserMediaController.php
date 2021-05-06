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
     * @OA\Get(
     * path="api/media",
     * summary="Get a user's media file",
     * description="Get all media files belonging to a particular user",
     * operationId="media",
     * tags={"Media"},
     * security={ {"bearer": {} }},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/UserMedia"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     *
     */

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
     * @OA\Post(
     *  path="api/media",
     *  summary="Create a new media",
     *  description="The user about to submit a new media must be authenticated",
     *  operationId="media",
     *  tags={"Media"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"file"},
     *       @OA\Property(property="file", type="string", example="video.mp4"),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Created successfully",
     *     @OA\JsonContent(
     *         @OA\Property(property="id", type="integer", readOnly="true", example="51"),
     *         @OA\Property(property="user_id", type="integer", readOnly="true", example="7"),
     *         @OA\Property(property="file", type="string", readOnly="true", example="video.mp4"),
     *         @OA\Property(property="created_at", type="string", readOnly="true", example="2021-04-25 21:10:45"),
     *         @OA\Property(property="updated_at", type="string", readOnly="true", example="2021-04-25 21:10:45"),
     *     ),
     *   ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */


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
     * @OA\Get(
     *  path="api/media/{id}",
     *  summary="Get a media by id",
     *  description="Get a particular media post by id, the user about to access the specified resource must be authenticated and can only access media belonging to the user",
     *  operationId="media",
     *  tags={"Media"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/UserMedia"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=404,
     *    description="Returns when resource is not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="resource not found"),
     *    ),
     *  ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when resource is being accessed by a another user",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="You do not have authorisation to access this media"),
     *    ),
     *  ),
     *
     *  @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */

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
     * @OA\Patch(
     *  path="api/media/{id}",
     *  summary="Update a media by its id",
     *  description="The user about to update a blog must be authenticated. This can only be done by the user who initially created the media",
     *  operationId="media",
     *  tags={"Media"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials, one or all of the specified input can be sent via the request body",
     *    @OA\JsonContent(
     *       required={"file"},
     *       @OA\Property(property="file", type="string", example="video.mp4"),     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/UserMedia"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when user is not authorized to access a resource he is trying to access",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="You do not have authorisation to access this media"),
     *    ),
     *  ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     *
     */


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
     * @OA\Delete(
     *  path="api/media/{id}",
     *  summary="Delete a media by its id",
     *  description="The user about to delete a media must be authenticated. This can only be done by the user who initially created the media",
     *  operationId="media",
     *  tags={"Media"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="deleted successfully"),
     *       @OA\Property(property="data", type="null"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when user is not authorized to access a resource he is trying to access",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="You do not have authorisation to access this media"),
     *    ),
     *  ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     *
     */

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
