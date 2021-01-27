<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // cette fonction retourne le profile d'un utilisateur selon son id 
    public function userProfile($id){
        $user = User::find($id);
        if($user){
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'image' => $user->image,
                'department' => $user->department
            ]);
        }
         return response()->json([
            'error' => "404 | UTILISATEUR INTROUVABLE"
        ]);
    }

    public function Signup(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->password)
        ]);

   
        return response()->json([
            'logged' => true,
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'department' => $user->department->name,
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
