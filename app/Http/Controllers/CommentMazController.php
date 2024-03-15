<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posmaz;
use App\Models\Commenmaz;

class CommentMazController extends Controller
{
    // get all comments of a post
    public function index($id)
    {
        $post = Posmaz::find($id);

        if(!$post)
        {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        return response([
            'commentsmaz' => $post->commentsmaz()->with('user:id,name,image')->get()
        ], 200);
    }

    // create a comment
    public function store(Request $request, $id)
    {
        $post = Posmaz::find($id);

        if(!$post)
        {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'commenmaz' => 'required|string'
        ]);

        Commenmaz::create([
            'commenmaz' => $attrs['commenmaz'],
            'posmaz_id' => $id,
            'user_id' => auth()->user()->id
        ]);

        return response([
            'message' => 'Comment created.'
        ], 200);
    }

    // update a comment
    public function update(Request $request, $id)
    {
        $comment = Commenmaz::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'Comment not found.'
            ], 403);
        }

        if($comment->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'commenmaz' => 'required|string'
        ]);

        $comment->update([
            'commenmaz' => $attrs['commenmaz']
        ]);

        return response([
            'message' => 'Comment updated.'
        ], 200);
    }

    // delete a comment
    public function destroy($id)
    {
        $comment = Commenmaz::find($id);

        if(!$comment)
        {
            return response([
                'message' => 'Comment not found.'
            ], 403);
        }

        if($comment->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $comment->delete();

        return response([
            'message' => 'Comment deleted.'
        ], 200);
    }
}
