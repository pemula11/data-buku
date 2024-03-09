<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = Book::query();
        $q = $request->query('title');
        $data->when($q, function($query) use ($q){
            return $query->whereRaw("title LIKE '%".strtolower($q)."%'");
        });
        return response()->json([
            'status' => 'success',
            'data' => $data->paginate(10)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $rules = [
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'publish_date' => 'required|date',
            'num_page' => 'required|integer',
            'category_id' => 'required'
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> 'error',
                'data' => $validator->errors()
            ], 404);
        }

        Book::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book,$id)
    {
        //
        $book = Book::find($id);
        if (!$book){
            return response()->json([
                'status'=> 'error',
                'message'=> "recipe not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book, $id)
    {
        //
        $rules = [
            'title' => 'string',
            'author' => 'string',
            'publisher' => 'string',
            'publish_date' => 'date',
            'num_page' => 'integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> 'error',
                'data' => $validator->errors()
            ], 404);
        }

       $books = Book::find($id);
       if (!$books){
        return response()->json([
            'status' => 'error',
            'message' => 'book not found'
        ], 404);
         }
        $books->fill($data);
        $books->save();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Request $request, $id){
        $book = Book::find($id);

        if (!$book){
            return response()->json([
                'status' => 'error',
                'message' => 'book not found'
            ], 404);
        }

        $book->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'books delete'
        ]);
    }
}
