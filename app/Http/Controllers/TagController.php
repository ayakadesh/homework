<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tag::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tag has been created successfully"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => false,
                'message' => "Tag not found"
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "Operation successful",
            'data' => ['tag' => new TagResource($tag)]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => false,
                'message' => "Tag not found"
            ], 404);
        }

        $tag->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tag updated successfully",
            'data' => ['tag' => new TagResource($tag)]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => false,
                'message' => "Tag not found"
            ], 404);
        }

        $tag->delete();

        return response()->json([
            'status' => true,
            'message' => "Tag deleted successfully"
        ], 200);
    }
}
