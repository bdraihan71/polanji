<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:3|max:1000',
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
        return Redirect::to(URL::previous() . $request->id);
    }
    public function destroy(Request $request, $id)
    {
        $reply = Reply::find($id);
        $reply->delete();
        return Redirect::to(URL::previous() . $request->id);
    }
}
