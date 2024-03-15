<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posmaz;
use App\Models\Likmaz;

class LikeMazController extends Controller
{
    // like or unlike
    public function likeOrUnlike($id)
    {
        $post = Posmaz::find($id);

        if(!$post)
        {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        $like = $post->likesmaz()->where('user_id', auth()->user()->id)->first();

        // if not liked then like
        if(!$like)
        {
            Likmaz::create([
                'posmaz_id' => $id,
                'user_id' => auth()->user()->id
            ]);

            return response([
                'message' => 'Liked'
            ], 200);
        }
        // else dislike it
        $like->delete();

        return response([
            'message' => 'Disliked'
        ], 200);
    }
}
