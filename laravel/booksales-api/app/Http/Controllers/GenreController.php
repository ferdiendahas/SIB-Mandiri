<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index(){
        // $data = new Genre();
        // $genres = $data->getGenres();
        $genres = Genre::all();
        
        if($genres->isEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'No resource found',
            ], 200);
        }


        return response()->json([
            'success' => true,
            'message' => 'Get all resource',
            'data' => $genres
        ], 200);
    }

    public function store(Request $request){
        // 1.validation
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        // 2. check if validation fails
        if($validator->fails()){
            return response()->json([  
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        // 3. insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 4. return response
        return response()->json([
            'success' => true,
            'message' => 'Resource created successfully',
            'data' => $genre
        ], 201);
    }

    public function show(string $id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $genre
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. find data
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // 2. validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
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
            'description' => $request->description,
        ];

        // 4. handle image upload
        // if($request->hasFile('cover_photo')){
        //     $image = $request->file('cover_photo');
        //     $image->store('genres', 'public');

        //     // Delete the old cover photo if exists
        //     if ($genre->cover_photo) {
        //         Storage::disk('public')->delete('genres/' . $genre->cover_photo);
        //     }

        //     $data['cover_photo'] = $image->hashName();
        // }

        // 5. update data to database
        $genre->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data' => $genre
        ], 200);

    }

    public function destroy(string $id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // if ($genre->cover_photo) {
        //     // Delete the cover photo file from storage
        //     Storage::disk('public')->delete('genres/' . $genre->cover_photo);
        // }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully',
        ],);
    }

}
