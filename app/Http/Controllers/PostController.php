<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth:api',['expect'=>['fetchPosts']]);
    }

    function fetchPosts(){
        return response()->json([
            'status' => 'success',
            'data' =>Post::get(),
            'user_id' =>Auth::guard('api')->user(),
        ]);
    }


}
