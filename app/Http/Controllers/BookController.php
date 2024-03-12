<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = Book::with('category')->get();
        $categories = Category::pluck('name', 'id');
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $data->paginate(10)
        // ]);
        return view('book.index', [
            "tittle" => "Book",
            "active" => "book",
            'buku' => $data,
            "category" => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        return redirect('/book')->with('success', 'New Category Has Been Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        $books = Book::find($book);
        if (!$books){
            return response()->json([
                'status'=> 'error',
                'message'=> "recipe not found"
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail Data book',
            'data'    => $book  
        ]); 
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
    public function update(Request $request, Book $book )
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
            return response()->json($validator->errors(), 422);
        }

       
       if (!$book){
        return response()->json([
            'status' => 'error',
            'message' => 'book not found'
        ], 404);
         }
        $book->update($data);
        $book->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Book $book){
       

        if (!$book){
            return response()->json([
                'status' => 'error',
                'message' => 'book not found'
            ], 404);
        }

        Book::destroy($book->id);

        return redirect('/book')->with('success', ' Post Has Been Deleted');
    }
}
