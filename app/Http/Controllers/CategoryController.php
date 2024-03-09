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
        $data = Category::query();
        $q = $request->query('name');
        $data->when($q, function($query) use ($q){
            return $query->whereRaw("name LIKE '%".strtolower($q)."%'");
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
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
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
    public function update(Request $request, Category $category, $id)
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

        $categorys = Category::find($id);
       if (!$categorys){
        return response()->json([
            'status' => 'error',
            'message' => 'category not found'
        ], 404);
         }
        $categorys->fill($data);
        $categorys->save();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        //
        $cat = Category::find($id);

        if (!$cat){
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        $cat->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'category delete'
        ]);
    }
}
