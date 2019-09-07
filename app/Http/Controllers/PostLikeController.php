<?php

namespace App\Http\Controllers;

use App\PostLike;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class PostLikeController extends Controller
{
    public function update(Request $request, $id)
    {

    $existing_like = PostLike::withTrashed()->wherePostId($id)->whereUserId(Auth::id())->first();

    if (is_null($existing_like)) {
        PostLike::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'is_liked' => $request->get('is_liked'),
        ]);
    } else {
        if (is_null($existing_like->deleted_at)) {
            $existing_like->delete();
        } else {
            $existing_like->restore();
        }
    }
        return Redirect::to(URL::previous() . $request->post_id);
    }
}
