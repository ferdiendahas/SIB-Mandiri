<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        // $data = new Author();
        // $authors = $data->getAuthors();
        $authors = Author::all();
        
        if($authors->isEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'No resource found',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all resource',
            'data' => $authors
        ], 200);    
    }

    public function store(Request $request){
        // 1.validation
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'required',
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
        $image = $request->file('photo');
        $image ->store('authors','public');

        // 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio,
        ]);

        // 5. return response
        return response()->json([
            'success' => true,
            'message' => 'Resource created successfully',
            'data' => $author
        ], 201);
    }
}
