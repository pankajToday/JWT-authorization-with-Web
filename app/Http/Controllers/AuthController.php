<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        // except accept that method name that should be guard with this middleware.
        //$this->middleware('auth:api', ['except' => ['login','register','refresh','logout']]);

    }


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('api')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        Auth::guard('web')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();

        setcookie('auth_token', $token,'','/'); // 86400 = 1 day


        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }

    public function webLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        Auth::guard('web')->attempt($credentials);
        $token = Auth::guard('api')->attempt($credentials);

        setcookie('auth_token', $token,'','/'); // 86400 = 1 day

        return redirect('/home');

    }


    public function logout(Request $request)
    {
        if( $request->expectsJson() ){
            Auth::guard('api')->logout();
            setcookie("auth_token", "", time() - 3600);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
                'user' => Auth::user()?Auth::user():""
            ]);
        }
        else{
            Auth::guard('web')->logout();
            setcookie("auth_token", "", time() - 3600);

            return redirect('/login');
        }
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
            'authorisation' => [
                'token' => Auth::guard('api')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    function profile(){
        return   response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
        ]);
    }



}