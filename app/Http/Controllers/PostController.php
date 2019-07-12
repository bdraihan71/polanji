<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index', compact('posts'));

    }

    public function ownPostIndex()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('post.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $is_anonymous = $request->get('is_anonymous') ? 1 : 0;
        $post = new Post([
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
            'source' => $request->get('source'),
            'is_anonymous' =>  $is_anonymous,
        ]);
        $post->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }

}
