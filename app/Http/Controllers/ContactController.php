<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{   public function index($id){
    $users_rep = DB::table('user_contact')->where('user_id', $id)->select('contact_id')->get();
    if($users_rep->isEmpty()){  return response()->json([
        'error' =>"Votre liste de contacts est vide. "
    ]);
    }
    else{
        $contacts_id = [];
        foreach($users_rep as $id){
            array_push($contacts_id,$id->contact_id);
        }
        $contacts = User::whereIn('id',$contacts_id)->select('id','name','email','phone','image')->get();
        return response()->json($contacts);
    }

    }
    public function add(Request $request)
    {
        $data = $request->input();
        if (isset($data)) {
            $users = DB::table('users')->where('phone', $data['data'])->orWhere('email', $data['data'])->get();
            $users = $users->keyBy('id');
            if (!empty($users->first()->id)) {
                if ($users->first()->id == Auth::id()) {
                    return response()->json([
                        'error' =>"Vous ne pouvez pas vous ajouter."
                    ]);

                } else {
                    $repertories = DB::table('repertories')->where('contact_id', $users->first()->id)->get();
                    if ($repertories->isNotEmpty()) {
                        return response()->json([
                            'error' =>"Le contact est déjà dans votre liste de contacts."
                        ]);
                    } else {
                        if (DB::table('user_contact')->where('user_id', Auth::id())->count() >= 200) {
                            return response()->json([
                                'error' =>"Vous avez atteint le nombre maximum de contacts dans votre liste de contacts."
                            ]);
                        } else {
                            DB::table('user_contact')->insert(['user_ind' => Auth::id(), 'contact_id' => $users->first()->id]);
                            return response()->json([
                                'success' =>"Le contact a bien été ajouté dans votre liste de contacts."
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'error' =>"Celui que vous cherchez à ajouter n'existe pas"
                ]);
            }
        }
        return response()->json([
        'error' =>"Les informations n'ont pas pu être collectées"
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->input();

        if (isset($data)) {

            DB::table('user_contact')->where('user_id', Auth::id())->where('contact_id', $data['id'])->delete();
            return response()->json([
                    'success' => 'Le contact a bien été supprimé'
                ]
            );
        }
        return response()->json([
        'error' =>"Une erreur est survenue"
        ]);
    }
}
