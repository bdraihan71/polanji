<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $is_anonymous = $request->get('is_anonymous') ? 1 : 0;
        $comment = new Comment([
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
            'source' => $request->get('source'),
            'is_anonymous' =>  $is_anonymous,
            'post_id' => $request->get('post_id'),
        ]);
        $comment->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}
