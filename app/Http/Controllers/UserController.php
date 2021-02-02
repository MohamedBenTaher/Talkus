<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'department_id' => $user->department->id,
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
            'department_id' => auth()->user()->department->id,
            'created_at' => auth()->user()->created_at,
            'admin' => auth()->user()->isAdmin
        ]);
        return response()->json([
            'error' => "email ou mot de passe erroné"
        ]);
    }

    public function getUsersByDepartment($user_id,$department_id) {

        $users_rep = DB::table('user_contact')->where('user_id', $user_id)->select('contact_id')->get();
        $contacts_id = [];
        foreach($users_rep as $id){
            array_push($contacts_id,$id->contact_id);
        }
        array_push($contacts_id,$user_id);
        $users = User::where('department_id',$department_id)->whereNotIn('id',$contacts_id)->paginate(6);

        if($users->isEmpty()){
            return response()->json([
                'error' => 'Vous avez aucune suggestion (il se peut que vous avez ajoutez tous les contacts de votre departement)'
            ]);
        }

        return response()->json($users);
    }
}
