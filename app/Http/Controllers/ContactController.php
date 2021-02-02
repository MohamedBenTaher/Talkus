<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
<<<<<<< HEAD
{   
    
    public function index($id){
        $users_rep = DB::table('user_contact')->where('user_id', $id)->select('contact_id')->get();
        if($users_rep->isEmpty()){  return response()->json([
            'error' =>"vouz n'avez pas encore d'amies sur notre platfrome "
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


    public function addContact(Request $request)
    {
        $newContact = DB::table('user_contact')->insert(['user_id'=>$request->user_id,'contact_id'=>$request->contact_id]);
        if(!$newContact){
            return response()->json([
                'error' => "une erreur est produite lors de l'ajout"
            ]);
        }   
        return response()->json($newContact);
    }

    public function removeContact(Request $request)
    {
        $removed_contact = DB::table('user_contact')
        ->where('user_id',$request->user_id)
        ->where('contact_id',$request->contact_id)
        ->delete();

        if(!$removed_contact){
            return response()->json(['err' => "une erreur est produite lors de la suppression"]);
        }
        else{
            return response()->json($removed_contact);
=======
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
>>>>>>> 8d026f3025bcba8f7bb178569f88f0a572da191f
        }
        return response()->json([
        'error' =>"Les informations n'ont pas pu être collectées"
        ]);
    }



<<<<<<< HEAD
=======
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
>>>>>>> 8d026f3025bcba8f7bb178569f88f0a572da191f
}
