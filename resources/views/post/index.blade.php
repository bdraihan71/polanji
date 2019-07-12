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
            @php
            $count = 0;
            @endphp
            @foreach ($posts as $post)
                <div class="card mb-2">
                        <div class="card-body">
                            <p>{{  $post->is_anonymous == 0 ? $post->user->f_name .' '.$post->user->l_name : 'Anonymous ' }}</p>
                            <h4>{{ $post->body }}</h4>
                            <hr>
                            @if(Auth::check())
                                <button onclick="myFunction({{ $count }})" class="btn default">Comment</button>
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
                            {{-- commet --}}
                            <div class="container" id="myDIV{{ $count }}" style="display:none">
                                <form  method="post" action="{{ route('comment.store') }}"  class="text-muted m-2">
                                    @csrf
                                    <input type="hidden" name="source" value="web">
                                    <input type="hidden" name="post_id" value= {{ $post->id }}>
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" id="body" rows="2"></textarea>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" name="is_anonymous" value="1" class="form-check-input" id={{ $post->id }}>
                                        <label class="form-check-label" for={{ $post->id }}>Hide My Name</label>
                                    </div>
                                    <button class="btn btn-outline-success btn-block">Submit Comment</button>
                                </form>
                            </div>
                            <div class="mt-3">
                                @foreach ($post->comments as $comment)
                                    <h6>
                                        <div class="mb-2 d-inline"><b><i>{{  $comment->is_anonymous == 0 ? $comment->user->f_name .' '.$comment->user->l_name : 'Anonymous' }}</i> </b>{{ '  '. $comment->body }}</div>
                                        @if(Auth::check())
                                            <button onclick="myFunction({{ $count }})" class="btn default">Reply</button>
                                        @else
                                            <button class="btn default"><a style=" text-decoration: none !important; color:black" href="{{ route('login') }}">Reply</a></button>
                                        @endif
                                        @if(Auth::check() && Auth::id() == $comment->user->id)
                                            <form action="{{ route('comment.destroy', $comment->id)}}" onclick="return confirm('Are you sure, you want to delete this comment?')" method="post" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </h6>
                                @endforeach
                            </div>
                            {{-- end of commet --}}
                            @php
                                $count++
                            @endphp
                        </div>
                    </div>
            @endforeach
            {{-- end of all post --}}
        </div>
    </div>
</div>
@endsection

<script>
    function myFunction(count) {
    var x = document.getElementById("myDIV"+count);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    }
</script>
