<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $is_anonymous = $request->get('is_anonymous') ? 1 : 0;
        $reply = new Reply([
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
            'source' => $request->get('source'),
            'comment_id' => $request->get('comment_id'),
            'post_id' => $request->get('post_id'),
            'is_anonymous' =>  $is_anonymous,
        ]);
        $reply->save();
        return redirect()->back();
    }
    public function destroy($id)
    {
        $reply = Reply::find($id);
        $reply->delete();
        return redirect()->back();
    }
}
