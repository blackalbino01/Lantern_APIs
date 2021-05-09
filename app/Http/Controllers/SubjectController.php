<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Category;

class SubjectController extends Controller
{

    /**
     * @OA\Get(
     * path="api/subjects",
     * summary="Get subjects",
     * description="Get all available subjects",
     * operationId="subject",
     * tags={"Subject"},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Subject"),
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
        $subjects = Subject::all();

        return Response()->json([
            'data' => $subjects,
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
     * path="api/category/{category}/subject",
     * summary="Store subjects",
     * description="The user about to Store a new subject must be authenticated",
     * operationId="subject",
     * tags={"Subject"},
     * security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up subject",
     *    @OA\JsonContent(
     *       required={"name", "description", "category_id"},
     *       @OA\Property(property="name", type="string", example="mathematics"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *       @OA\Property(property="category_id", type="integer", example="4"),

     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Subject Created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Subject successfully Created."),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Subject"),
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
    public function store(Request $request, Category $category)
    {

        $subject = $category->subjects()->firstOrcreate([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $category->id
        ]);
        return Response()->json([
            'message' => 'Subject successfully created',
            'data' => $subject
        ]);
    }

    /**
     * @OA\Get(
     *  path="api/subjects/{id}",
     *  summary="Get a subject by id",
     *  description="Get a particular subject by id",
     *  operationId="subject",
     *  tags={"Subject"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Subject"),
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
        $subject = Subject::findorfail($id);

        return Response()->json([
            'data' => $subject,
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
     *  path="api/subjects/{id}",
     *  summary="Update a subject by its id",
     *  description="The user about to update a subject must be authenticated",
     *  operationId="subject",
     *  tags={"Subject"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name","description"},
     *       @OA\Property(property="name", type="string", example="mathematics"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Subject"),
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

        $subject = Subject::find($id);
        $subject->update($request->all());

        return Response()->json([
            'message' => 'Subject successfully updated',
            'data' => $subject
        ]);
    }

    /**
     * @OA\Delete(
     *  path="api/subjects/{id}",
     *  summary="Delete a subject by its id",
     *  description="The user about to delete a subject must be authenticated",
     *  operationId="subject",
     *  tags={"Subject"},
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
        $subject = Subject::findorfail($id);

        $subject->delete();

        return Response()->json([
            'message' => 'Subject successfully deleted!',200
        ]);
    }
}
