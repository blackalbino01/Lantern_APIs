<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\Category;

class InterestController extends Controller
{

    /**
     * @OA\Get(
     * path="api/interests",
     * summary="Get interests",
     * description="Get all available interests",
     * operationId="interest",
     * tags={"Interest"},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Interest"),
     *       ),
     *    ),
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
        $interests = Interest::all();

        return Response()->json([
            'data' => $interests,
        ]);
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
     * @OA\Post(
     * path="api/category/{category}/interest",
     * summary="Store interests",
     * description="The user about to Store a new interest must be authenticated",
     * operationId="interest",
     * tags={"Interest"},
     * security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up interest",
     *    @OA\JsonContent(
     *       required={"name", "description", category_id"},
     *       @OA\Property(property="name", type="string", example="Blockchain"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *       @OA\Property(property="category_id", type="integer", example="4"),

     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Interest Created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Interest successfully Created."),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Interest"),
     *       ),
     *    ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated"),
     *    ),
     *  ),
     * )
     *
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Category $category)
    {
        $interest = $category->interests()->firstOrcreate([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $category->id
        ]);
        return Response()->json([
            'message' => 'Interest successfully created',
            'data' => $interest
        ]);
    }

    /**
     * @OA\Get(
     *  path="api/interests/{id}",
     *  summary="Get a interest by id",
     *  description="Get a particular interest by id",
     *  operationId="interest",
     *  tags={"Interest"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Interest"),
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
    public function show($id)
    {
        $interest = Interest::findorfail($id);

        return Response()->json($interest);
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
     *  path="api/interests/{id}",
     *  summary="Update a interest by its id",
     *  description="The user about to update a interest must be authenticated",
     *  operationId="interest",
     *  tags={"Interest"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name","description"},
     *       @OA\Property(property="name", type="string", example="Sport"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Interest"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when user is not authorized to access a resource he is trying to access",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Access denied"),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $interest = Interest::find($id);

        $interest->update($request->all());

        return Response()->json([
            'message' => 'Interest successfully updated',
            'data' => $interest
        ]);
    }

    /**
     * @OA\Delete(
     *  path="api/interests/{id}",
     *  summary="Delete a interest by its id",
     *  description="The user about to delete a interest must be authenticated",
     *  operationId="interest",
     *  tags={"Interest"},
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
     *       @OA\Property(property="message", type="string", example="Access denied"),
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
        $interest = Interest::findorfail($id);

        $interest->delete();

        return Response()->json([
            'message' => 'Interest successfully updated',200
        ]);

    }
}
