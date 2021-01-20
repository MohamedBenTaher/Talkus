<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Signup(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'logged' => true,
            'id' => $user->id,
            'name' => $user->name,
            'created_at' => $user->created_at,
            'admin' => $user->isAdmin
        ]);
    }

    public function Login(Request $request){
        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        return response()->json([
            'logged' => true,
            'id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'created_at' => auth()->user()->created_at,
            'admin' => auth()->user()->isAdmin
        ]);
        return response()->json([
            'error' => "email ou mot de passe erroné"
        ]);
    }
}
