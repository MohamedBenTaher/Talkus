<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
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
        }
    }



}
