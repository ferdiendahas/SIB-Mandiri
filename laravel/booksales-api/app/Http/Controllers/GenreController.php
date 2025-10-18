<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
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
}
