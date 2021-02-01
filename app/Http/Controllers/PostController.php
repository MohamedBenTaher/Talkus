<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Contact;

class PostController extends Controller
{
    public function index()
    {
         //$id_contact=contact::get('id');
         $posts=post::latest()->paginate(8);
         return response()->json($posts);
    }

    public function create(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'created' => true,
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'user_id' => $post->user_id
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post)
        {
            if ($request->title)
            {
                Post::where('id', $id)->update($request->title);
            }
            if ($request->content)
            {
                Post::where('id', $id)->update($request->content);
            }
            return response()->json([
                'success' => "Le post a bien été modifié."
            ]);
        }
        return response()->json([
            'error' => "Le post est introuvable."
        ]);
    }

    public function find($id)
    {
        $post = Post::find($id);
        if ($post)
        {
            return response()->json([
                'success' => "Le post a bien été trouvé."
            ]);
        }
        return response()->json([
            'error' => "Le post est introuvable."
        ]);
    }

    public function destroy($id)
    {
        $post = Post::destroy($id);
        return response()->json([
            'success' => "Le post n'existe plus."
        ]);
    }
}
