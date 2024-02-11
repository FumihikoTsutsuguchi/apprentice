<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    // コメントの投稿処理
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->article_id = $articleId;
        $comment->body = $request->body;
        $comment->user_id = \Auth::id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

}
