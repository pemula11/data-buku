<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $categories = Category::get();
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $data->paginate(10)
        // ]);
        return view('category.index', [
            "tittle" => "Book",
            "active" => "book",
            'category' => $categories,
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
            'name' => 'required|string',
            
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> 'error',
                'data' => $validator->errors()
            ], 404);
        }

        Category::create($data);
      
        return redirect('/category')->with('success', 'New Category Has Been Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        $categories = Category::find($category)->first();
        if (!$categories){
            return response()->json([
                'status'=> 'error',
                'message'=> "category not found"
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail Data category',
            'data'    => $categories  
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $rules = [
            'name' => 'required|string',
            
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if (!$category){
            return response()->json([
                'status' => 'error',
                'message' => 'book not found'
            ], 404);
             }
            $category->update($data);
            $category->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diudapte!',
                'data' => $data
            ]);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        if (!$category){
            return response()->json([
                'status' => 'error',
                'message' => 'book not found'
            ], 404);
        }

        $category = Category::find($category->id);

        try {
            $category->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect('/category')->with('failed', 'Resource cannot be deleted due to existence of related resources.');
                
            }
        }

        return redirect('/category')->with('success', ' Post Has Been Deleted');

    }
}
