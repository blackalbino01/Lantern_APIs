<?php

namespace App\Http\Controllers;

use App\Models\Book_Store;
use Illuminate\Http\Request;
use App\Http\Resources\BookStoreResource;

class BookStoreController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // return new BookStoreResource($book_Store);
        $book = Book_Store::find($id);
        return new BookStoreResource($book);
        // return $book;
    }

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
