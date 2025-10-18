<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        // $data = new Book();
        // $books = $data->getBooks();
        $books = Book::all();
        
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

}