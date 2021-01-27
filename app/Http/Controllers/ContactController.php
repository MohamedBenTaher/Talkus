<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{   public function index($id){
    $users_rep = DB::table('user_contact')->where('user_id', $id)->select('contact_id')->get();
    if(!$users_rep) return response()->json([
        'error' =>"vouz n'avez pas encore d'amies sur notre platfrome "
    ]);
    else{ 
    
    $n = $users_rep->count();
    for ($i = 0; $i < $users_rep->count(); $i++) {
        foreach ($users_rep[$i] as $contact_id) {
            $users[$i] = DB::table('users')->where('id', $contact_id)->get();
        }
    }
    return response()->json(compact('users', 'n'));
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
                    return print_r('You are trying to add yourself');

                } else {
                    $repertories = DB::table('repertories')->where('contact_id', $users->first()->id)->get();
                    if ($repertories->isNotEmpty()) {
                        return print_r('Contact already on contact list');
                    } else {
                        if (DB::table('user_contact')->where('user_id', Auth::id())->count() >= 200) {
                            return print_r('You have reached the maximum list of contacts');
                        } else {
                            DB::table('user_contact')->insert(['user_ind' => Auth::id(), 'contact_id' => $users->first()->id]);
                            return print_r('Contact added');
                        }
                    }
                }
            } else {
                return print_r('Contact not found');
            }
        }
        return print_r('Data did not pass');
    }

    public function append(Request $request)
    {
        $user = Auth::user();
        $this->add($request);
        return response()->json(compact('user'));
        //return view('home',compact('user'));
    }

    public function display()
    {
        $users_rep = DB::table('user_contact')->where('user_id', Auth::id())->select('contact_id')->get();

        if ($users_rep->isNotEmpty()) {

            $n = $users_rep->count();
            for ($i = 0; $i < $users_rep->count(); $i++) {
                foreach ($users_rep[$i] as $contact_id) {
                    $users[$i] = DB::table('users')->where('id', $contact_id)->get();
                }
            }
            return response()->json(compact('users', 'n'));
            //return view('user.repertory', compact('users', 'n'));
        }
    }

    public function remove(Request $request)
    {
        $data = $request->input();

        if (isset($data)) {

            DB::table('user_contact')->where('user_id', Auth::id())->where('contact_id', $data['id'])->delete();
            return response()->json([
                    'success' => 'The Contact has been successfully removed'
                ]
            );
            //return redirect('repertory')->with('success');
        }
    }
}