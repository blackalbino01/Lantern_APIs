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
