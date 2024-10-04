<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\category;


class CategoryController extends Controller
{
    
    public function index()
    {
        return  CategoryResource::collection(Category::all());
    }

   
   
     public function store(Request $request){

        $category =  Category::create($request->all());
         return response()->json(
             
                
                $category
 
             
             );
     }

    
    public function show(Request $request, Category $category)
    {
        $data=$category->load('products') ;
        return new CategoryResource($data);
    }

     public function update( Request $request,$id){
 
        $category =  Category::find($id);
        if (!$category){
         return response()->json(
             [
                 "message" => "category not found",
                
             ],
             404
             );
     }
 
     $category->update($request->all());
     return response()->json(
         $category
            
     
         
         );
     }
     public function destroy($id){

        $category =  Category::find($id);
        if (!$category){
         return response()->json(
             [
                 "message" => "category not found",
                
             ],
             404
             );
     }
 
     $category->delete();
     return response()->json(
         [
            
             "message" => "category successfuly deleted"
 
         ]
         );
     }
 }
 
