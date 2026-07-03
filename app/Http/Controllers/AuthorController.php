<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController
{
    /**
     * Display all authors.
     */
    public function index(): JsonResponse
    {
        $authors = Author::latest()->paginate(10);

        return response()->json($authors); // $authors is a paginator object and Laravel can automatically convert it to JSON.
    }

    /**
     * Store a new author.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Author $author): JsonResponse
    {
        return response()->json($author);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author): JsonResponse
    {
        $author->update($request->validated());

        return response()->json([
            'message'=> 'Author Updated Successfully',
            'data' => $author
        ]);
    }

    /**
     * Delete an author.
     */
    public function destroy(Author $author): JsonResponse
    {
        $author->delete();

        return response()->json([
            'message' => 'Author Deleted Successfully'
        ]);
    }
}
