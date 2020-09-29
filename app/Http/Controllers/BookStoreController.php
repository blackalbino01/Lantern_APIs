<?php

namespace App\Http\Controllers;

use App\Models\Book_Store;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book_Store::all();
        return $books;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating User input

        $validatedData = $request->validate($request, [
            'author' => 'required',
            'title' => 'required',
            'price' => 'required|min:10|max:1999',
            'category' => 'required'

        ]);
            // Creating new Book
        $book = new Book_Store;
        $book->author = $request->input('author');
        $book->title = $request->input('title');
        $book->price = $request->input('price');
        $book->category = $request->input('category');
        $book->save();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function show(Book_Store $book_Store, Request $request)
    {
        return $book_Store;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function edit(Book_Store $book_Store,  $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book_Store $book_Store)
    {
        $book_Store->update($request->all());
        return response([
            'message' => 'Updated successfully'
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book_Store  $book_Store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book_Store $book_Store)
    {
        $book_Store->delete();
        // return response(null, 204);
    }
}
