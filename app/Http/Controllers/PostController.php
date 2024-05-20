<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    function fetchPost(Request $request , Post $post){

        $post = $post->find( $request->id);

        /** use the policy verifier for check the access. **/
        //  Policy return access response error 403 code , that is not good. So Policy Response is
        //  better option to manage this.
        //  $this->authorize('view' , $post);

        /**
         *  To control the error response of policy we used Policy Response.
         *  in this we can inspect the outcome response as own way.
         */
        $response = Gate::inspect('update', $post);

        if ($response->allowed()) {
            return response()->json(['data'=> $post ,'message'=>'']);
        }

        // apply gates for verify the user access.
        if( Gate::allows('post-view', $post ) ){
            return response()->json(['data'=>$post,'message'=>'']);
        }
        return response()->json(['data'=>[],'message'=>'you have no access of this post!']);
    }


    function deletePost(Request $request){
        $post =  Post::where('id' , $request->id)->first();

        if( Gate::allows('post-view', $post) ){

            $post->delete();

            return response()->json(['data'=>[],'message'=>'post is deleted.']);
        }
        else{
            return response()->json(['data'=>[],'message'=>'you have no access of this post!']);
        }

    }


}
