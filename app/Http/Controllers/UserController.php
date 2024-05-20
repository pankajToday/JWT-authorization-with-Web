<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function fetchUsers(){
        $users = User::Paginate(5);

        return view('users',['users'=>$users]);
    }
}
