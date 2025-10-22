<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('author', 'genre')->get();
        
        if($books->isEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'No resource found',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all resource',
            'data' => $books
        ], 200);
    }

    public function store(Request $request){
        // 1.validation
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|integer',
            'author_id' => 'required|integer',
        ]);

        // 2. check if validation fails
        if($validator->fails()){
            return response()->json([  
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        // 3.upload image
        $image = $request->file('cover_photo');
        $image ->store('books','public');

        // 4. insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);

        // 5.response
        return response()->json([
            'success' => true,
            'message' => 'Resource created successfully',
            'data' => $book
        ], 201);
    }

    public function show(string $id){
        $book = Book::find($id);

        if(!$book){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get resource',
            'data' => $book
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. find data
        $book = Book::find($id);

        if(!$book){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // 2. validation
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|integer',
            'author_id' => 'required|integer',
        ]);

        // 3. update data
        $data = [  
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ];

        // 4. handle image upload
        if($request->hasFile('cover_photo')){
            $image = $request->file('cover_photo');
            $image ->store('books','public');

            // delete old image
            if($book->cover_photo){
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->hashName();
        }

        // 7. return response to database
        $book->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data' => $book
        ], 200);
    }

    public function destroy(string $id){
        $book = Book::find($id);

        if(!$book){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // delete cover photo
        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully',
        ], 200);
    }
}