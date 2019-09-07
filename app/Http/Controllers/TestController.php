<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostLike;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
         $likes = PostLike::latest()->get();
        // $likes = Post::latest()->get();
        dd($likes);
    }
}
