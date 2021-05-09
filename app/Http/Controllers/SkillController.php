<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Category;

class SkillController extends Controller
{

    /**
     * @OA\Get(
     * path="api/skills",
     * summary="Get skills",
     * description="Get all available skills",
     * operationId="skill",
     * tags={"Skill"},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Skill"),
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
        $skills = Skill::all();

        return Response()->json([
            'data' => $skills,
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
     * path="api/category/{category}/skill",
     * summary="Store skills",
     * description="The user about to Store a new skill must be authenticated",
     * operationId="skill",
     * tags={"Skill"},
     * security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up skill",
     *    @OA\JsonContent(
     *       required={"name", "description", "category_id"},
     *       @OA\Property(property="name", type="string", example="Graphics Design"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *       @OA\Property(property="category_id", type="integer", example="4"),

     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Skill Created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Skill successfully Created."),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Skill"),
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
        $skill = $category->skills()->firstOrcreate([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $category->id
        ]);
        return Response()->json([
            'message' => 'Skill successfully created',
            'data' => $skill
        ]);
    }

    /**
     * @OA\Get(
     *  path="api/skills/{id}",
     *  summary="Get a skill by id",
     *  description="Get a particular skill by id",
     *  operationId="skill",
     *  tags={"Skill"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Skill"),
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
        $skill = Skill::findorfail($id);

        return Response()->json([
            'data' => $skill,
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
     *  path="api/skills/{id}",
     *  summary="Update a skill by its id",
     *  description="The user about to update a skill must be authenticated",
     *  operationId="skill",
     *  tags={"Skill"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name","description"},
     *       @OA\Property(property="name", type="string", example="Marketing"),
     *       @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Skill"),
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
        $skill = Skill::find($id);

        $skill->update($request->all());

        return Response()->json([
            'message' => 'Skill successfully updated',
            'data' => $skill
        ]);
    }

    /**
     * @OA\Delete(
     *  path="api/skills/{id}",
     *  summary="Delete a skill by its id",
     *  description="The user about to delete a skill must be authenticated",
     *  operationId="skill",
     *  tags={"Skill"},
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
        $skill = Skill::findorfail($id);

        $skill->delete();

        return Response()->json([
            'message' => 'Skill successfully deleted!',200
        ]);

    }
}
