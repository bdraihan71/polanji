<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function index()
    {
        $totallike = Like::where('type', 'post')->count();
        dd($totallike);
        return view('post.index', compact('totallike'));
    }
}
