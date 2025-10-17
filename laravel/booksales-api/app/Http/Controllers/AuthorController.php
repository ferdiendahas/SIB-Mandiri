<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        // $data = new Author();
        // $authors = $data->getAuthors();
        $authors = Author::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Get all resource',
            'data' => $authors
        ], 200);    
    }
}
