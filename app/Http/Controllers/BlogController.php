<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BlogResource;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * @OA\Get(
     * path="api/blogs",
     * summary="Get blog",
     * description="Get all available blogs",
     * operationId="blog",
     * tags={"Blog"},
     *
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Blog"),
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
        $blog = Blog::orderBy('created_at', 'desc')->get();
        return response ([
            'data' => BlogResource::collection($blog)
        ]);
    }

/**
     * @OA\Post(
     *  path="api/blogs",
     *  summary="Create a new blog",
     *  description="The user about to submit a new blog must be authenticated",
     *  operationId="blog",
     *  tags={"Blog"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"title","body"},
     *       @OA\Property(property="title", type="string", example="Chukwudi"),
     *       @OA\Property(property="bodt", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Created successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Blog"),
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
        $authenticatedUser  = Auth::user();

        // Validating User input
        $blog = $authenticatedUser->blogs()->create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response ([
            'data' => new BlogResource($blog)
        ], 201);
    }

    /**
     * @OA\Get(
     *  path="api/blogs/{id}",
     *  summary="Get a blog by id",
     *  description="Get a particular blog post by id",
     *  operationId="blog",
     *  tags={"Blog"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Blog"),
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return new BlogResource($blog);
    }

    /**
     * @OA\Patch(
     *  path="api/blogs/{id}",
     *  summary="Update a blog post by its id",
     *  description="The user about to update a blog must be authenticated",
     *  operationId="blog",
     *  tags={"Blog"},
     *  security={ {"bearer": {} }},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"title","body"},
     *       @OA\Property(property="title", type="string", example="Chukwudi"),
     *       @OA\Property(property="bodt", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque accusantium consequuntur molestiae voluptates sit quae eum. Dolore quos quaerat recusandae voluptatem fugiat a iusto ducimus mollitia, reprehenderit similique eligendi cumque."),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=201,
     *     description="Updated successfully",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="updated successfully"),
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Blog"),
     *       ),
     *    ),
     *
     *  @OA\Response(
     *    response=403,
     *    description="Returns when user is not authorized to access a resource he is trying to access",
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $blog = Blog::find($id);

        // check for user access
        if ($user->id !== $blog->user_id) {
            return response([
                'message' => 'Access denied'
            ]);
        } else {
            $blog->update($request->all());
        };
        return response([
            'message' => 'Updated successfully',
            'data' => $blog
        ]);
    }

    /**
     * @OA\Delete(
     *  path="api/blogs/{id}",
     *  summary="Delete a blog post by its id",
     *  description="The user about to delete a blog must be authenticated",
     *  operationId="blog",
     *  tags={"Blog"},
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $blog = Blog::find($id);

        // check for user access
        if ($user->id !== $blog->user_id) {
            return response([
                'message' => 'Access denied'
            ]);
        } else {
            $blog->delete();
        };
        return response([
            'message' => 'Deleted successfully',
            'data' => null
        ]);
    }
}
