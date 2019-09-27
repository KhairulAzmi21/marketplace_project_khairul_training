<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        Comment::create([
            'product_id' => $id,
            'user_id'    => auth()->user()->id,
            'body'       => $request->body
        ]);

        // store a session for flash message.

        return back();
    }
}
