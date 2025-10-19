<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function show(string $id){
        $author = Author::find($id);

        if(!$author){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get resource detail',
            'data' => $author
        ], 200);
    }    

    public function update(string $id, Request $request){
        // 1. find data
        $author = Author::find($id);

        if(!$author){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // 2. validation
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'photo' => 'nullabe|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([  
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. update data
        $data = [
            'name' => $request->name,
            'bio' => $request->bio,
        ];

        // 4. handle image upload
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $image ->store('authors','public');

            // delete old image
            if($author->photo){
                Storage::disk('public')->delete('authors/' . $author->photo);
            }
            
            $data['photo'] = $image->hashName();
        }
    

        // 5. return data to database
        $author->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data' => $author
        ], 200);
    }
    
    public function destroy(string $id){
        $author = Author::find($id);

        if(!$author){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        if ($author->photo) {
            // Delete the photo file from storage
            Storage::disk('public')->delete('authors/' . $author->photo);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully',
        ], 200);
    }

}   
