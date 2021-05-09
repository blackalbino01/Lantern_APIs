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
     *  @OA\Post(
     *  path="api/userprofile",
     *  summary="upload a new profile picture",
     *  description="The user about to upload a new profile picture must be authenticated",
     *  operationId="userprofile",
     *  tags={"UserProfile"},
     *  security={ {"bearer": {} }},
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required= {"profile__picture"},
     *       @OA\Property(property="profile__picture", type="string", readOnly="true", example="https://placeimg.com/400/300/any?31560"),
     * ),
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Uploaded successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/User_Profile"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
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
        $user = Auth::user();

        $user_profile = $user->user_profile()->create([
            'profile__picture' => $request->profile__picture,
        ]);

        return Response()->json([
            'data' => $user_profile,
        ]); 
    }

     /**
     * @OA\Get(
     *  path="api/userprofile/{id}",
     *  summary="Get a user by id",
     *  description="Get a particular user profile by id",
     *  operationId="user",
     *  tags={"UserProfile"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/User_Profile"),
     *       @OA\Property(property="follower", type="object", ref="#/components/schemas/User_Profile"),
     *       @OA\Property(property="following", type="object", ref="#/components/schemas/User_Profile"),
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
     * )
     */

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
     * @OA\Patch(
     *  path="api/userprofile/{id}",
     *  summary="Update by Id",
     *  description="Currently authenticated user can update their details in the Database",
     *  operationId="userprofile",
     *  tags={"UserProfile"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="'Userprofile updated successfully!"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/User_Profile"),
     *       ),
     *    ),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user_profile = User_Profile::find($id);
        $user_profile->update($request->all());

        return Response()->json([
            'message' => 'User successfully updated',
            'data' => $user_profile
        ]);
    }

    /**
     * @OA\Delete(
     *  path="api/userprofile/{id}",
     *  summary="Delete a user profile by its id",
     *  description="The user about to delete a profile must be authenticated",
     *  operationId="userprofile",
     *  tags={"UserProfile"},
     *  security={ {"bearer": {} }},
     *
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Deleted successfully"),
     *       @OA\Property(property="data", type="null"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when user is not authorized to access a resource",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Acess denied"),
     *    ),
     *  ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    ),
     *  ),
     *
     * )
     *
     */

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
