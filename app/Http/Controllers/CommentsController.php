<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Comment;
use App\Video;
use Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request,$id) 
    {

        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'commentable_type' => 'App\Post',
            'commentable_id' => $id,
        ]);
        return redirect()->back();
    }
}
