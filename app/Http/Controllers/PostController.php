<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use App\Like;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::latest()->paginate(2);
        $posts = Post::latest()->get();
        return view('post.index', compact('posts'));

    }

    public function ownPostIndex()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->paginate(2);
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('post.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:3|max:1000',
        ]);

        $is_anonymous = $request->get('is_anonymous') ? 1 : 0;
        $post = new Post([
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
            'source' => $request->get('source'),
            'is_anonymous' =>  $is_anonymous,
        ]);
        $post->save();
        return redirect()->back()->with('message','post create successfully');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return Redirect::to(URL::previous() . $request->id);
    }

}
