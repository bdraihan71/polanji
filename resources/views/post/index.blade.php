@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- create post --}}
            @if(Auth::check())
                <div class="card mb-2">
                    <div class="card-header">Create Post</div>
                    <div class="card-body">
                        <form  method="post" action="{{ route('post.store') }}"  class="text-muted">
                            @csrf
                            <input type="hidden" name="source" value="web">
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_anonymous" value="1" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Hide My Name</label>
                              </div>
                            <button class="btn btn-outline-info btn-block">Submit Question</button>
                        </form>
                    </div>
                </div>
            @endif
            {{-- end of create post --}}
            {{-- all post --}}
            @foreach ($posts as $post)
                <div class="card mb-2">
                        <div class="card-body">
                            <p>{{  $post->is_anonymous == 0 ? $post->user->f_name .' '.$post->user->l_name : 'Anonymous ' }}</p>
                            <h4>{{ $post->body }}</h4>
                            <hr>
                            @if(Auth::check())
                                <button class="btn default">Comment</button>
                            @else
                                <button class="btn default"><a style=" text-decoration: none !important; color:black" href="{{ route('login') }}">Comment</a></button>
                            @endif
                            @if(Auth::check() && Auth::id() == $post->user->id)
                                <form action="{{ route('post.destroy', $post->id)}}" onclick="return confirm('Are you sure, you want to delete this post?')" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                            <div class="mt-3">
                                @foreach ($post->comments as $comment)
                                    <h6 class="mb-2"><b><i>{{  $comment->is_anonymous == 0 ? $comment->user->f_name .' '.$comment->user->l_name : 'Anonymous' }}</i> </b>{{ '  '. $comment->body }}</h6>
                                @endforeach
                            </div>
                        </div>
                    </div>
            @endforeach
            {{-- end of all post --}}
        </div>
    </div>
</div>
@endsection
