<?php

namespace App\Http\Controllers;

use App\Models\Book_Store;
use Illuminate\Http\Request;
use App\Http\Resources\BookStoreResource;

class BookStoreController extends Controller
{
    /**
     * @OA\Get(
     * path="api/books",
     * summary="Get books",
     * description="Get all available books",
     * operationId="books",
     * tags={"Book"},
     *
     * @OA\Response(
     *    response=422,
     *    description="Wrong URL or URL not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="You might have made a mistake in your URL")
     *        ),
     *     ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Book_Store"),
     *         @OA\Property(property="path", type="string", readOnly="true", example="http://localhost:8000/api/books"),
     *         @OA\Property(property="per_page", type="integer", readOnly="true", example="20"),
     *         @OA\Property(property="to", type="integer", readOnly="true", example="20"),
     *         @OA\Property(property="total", type="integer", readOnly="true", example="50"),
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
        $books = Book_Store::paginate(20);
        return BookStoreResource::collection($books);
    }

    /**
     * @OA\Post(
     * path="api/books",
     * summary="Store books",
     * description="Store a new book",
     * operationId="books",
     * tags={"Book"},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to set up advert",
     *    @OA\JsonContent(
     *       required={"author", "title", "price", "category"},
     *       @OA\Property(property="author", type="string", example="Reece James"),
     *       @OA\Property(property="title", type="string", example="Football greatest"),
     *       @OA\Property(property="price", type="string", example="400"),
     *       @OA\Property(property="category", type="string", example="fiction"),

     *    ),
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Book Created",
     *    @OA\JsonContent(
     *         @OA\Property(property="data", type="object", ref="#/components/schemas/Book_Store"),
     *       ),
     *    ),
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
        // Validating User input

        $validatedData = $request->validate([
            'author' => 'required',
            'title' => 'required',
            'price' => 'required|min:1|max:1999',
            'category' => 'required'
        ]);
            // Creating new Book
        $book = Book_Store::create($validatedData);
        return response([
            'data' => new BookStoreResource($book)
        ], 201);
    }

/**
     * @OA\Get(
     *  path="api/books/{id}",
     *  summary="Get a book by id",
     *  description="Get a particular book by id",
     *  operationId="book",
     *  tags={"Book"},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="data", type="object", ref="#/components/schemas/Book_Store"),
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
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // return new BookStoreResource($book_Store);
        $book = Book_Store::find($id);
        // if($book = null) {
        //     return response([
        //         'message' => 'resource not found'
        //     ]);
        // } else {
        //     return new BookStoreResource($book);
        // }
        return new BookStoreResource($book);
    }

    /**
     * @OA\Patch(
     *  path="api/books/{id}",
     *  summary="Update a book by id",
     *  description="Update a particular book by id",
     *  operationId="book",
     *  tags={"Book"},
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass data required to update advert, all Input field must not be specified",
     *    @OA\JsonContent(
     *       required={"author", "title", "price", "category"},
     *       @OA\Property(property="author", type="string", example="Reece James"),
     *       @OA\Property(property="title", type="string", example="Football greatest"),
     *       @OA\Property(property="price", type="string", example="400"),
     *       @OA\Property(property="category", type="string", example="fiction"),
     *    ),
     * ),
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *      @OA\Property(property="id", type="integer", readOnly="true", example="3"),
     *      @OA\Property(property="author", type="string", readOnly="true", example="Reece James"),
     *      @OA\Property(property="title", type="string", readOnly="true", example="Football greatness"),
     *      @OA\Property(property="price", type="string", example="400"),
     *      @OA\Property(property="category", type="string", readOnly="true", example="fiction"),
     *       ),
     *    ),
     *
     * )
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $book_Store->update($request->all($id));
        $newBook = Book_Store::find($id);
        $newBook->update($request->all());
        return response([
            'data' => new BookStoreResource($newBook)
        ], 201);

    }

    /**
     * @OA\Delete(
     *  path="api/books/{id}",
     *  summary="Delete a book by id",
     *  description="Delete a particular book by id",
     *  operationId="book",
     *  tags={"Book"},
     *
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *      @OA\Property(property="message", type="string", readOnly="true", example="Book deleted successfully"),
     *       ),
     *    ),
     *
     * )
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    Public function destroy($id)
    {
        $book = Book_Store::find($id);
        $book->delete();
        return response([
            'message' => 'Book deleted successfully'
        ], 204);
    }

}
