<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;


class GuestPolicy
{
   // use HandlesAuthorization;


    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    function edit($user , $post){
        return  Auth::id() === $post->user_id;
    }

    function view($user , $post):Response{
        return  $user->id === $post->user_id
            ? Response::allow()
            : Response::deny ('not allowed');
    }

    function delete($user , $post){
        return  Auth::id() === $post->user_id;
    }



}
