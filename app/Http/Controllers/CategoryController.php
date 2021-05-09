<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * @OA\Get(
     * path="api/categories",
     * summary="Get categories",
     * description="Get all available categories",
     * operationId="category",
     * tags={"Category"},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Category"),
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
        $categories = Category::all();

         return Response()->json([
            'data' => $categories,
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
     * path="api/categories",
     * summary="Store categories",
     * description="The user about to Store a new category must be authenticated",
     * operationId="category",
     * tags={"Category"},
     * security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up category",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="Technology"),
     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Category Created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Category successfully Created."),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Category"),
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
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return Response()->json([
            'data' => $category,
        ]);
    }

    /**
     * @OA\Get(
     *  path="api/categories/{id}",
     *  summary="Get a category by id",
     *  description="Get a particular category by id",
     *  operationId="category",
     *  tags={"Category"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Category"),
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
        $category = Category::findorfail($id);

        return Response()->json([
            'data' => $category,
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
     *  path="api/categories/{id}",
     *  summary="Update a category by its id",
     *  description="The user about to update a category must be authenticated",
     *  operationId="category",
     *  tags={"Category"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="Business"),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Category"),
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
        $category = Category::findorfail($id);

        $category->update($request->all());

        return Response()->json([
            'data' => $category,
        ]);

    }

    /**
     * @OA\Delete(
     *  path="api/categories/{id}",
     *  summary="Delete a category by its id",
     *  description="The user about to delete a category must be authenticated",
     *  operationId="category",
     *  tags={"Category"},
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
        $category = Category::findorfail($id);

        $category->delete();

        return Response()->json([
            'message' => 'Category successfully deleted!',200
        ]);

    }
}
