<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SomeController extends Controller
{
    public function adminMethod()
    {
        
        return response()->json(['message' => 'Admin method accessed']);
    }

    public function createPost(Request $request)
    {
        
        return response()->json(['message' => 'Post created successfully']);
    }
}

