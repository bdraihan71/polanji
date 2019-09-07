@extends('layouts.app')

@section('content')
<div class="container infinite-scroll mt-5">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class=" text-danger mb-2">{{$error}}</div>
                @endforeach
            @endif
            @if(session('message'))
                <div class="text-success">{{session('message')}}</div>
            @endif
            {{-- create post --}}
            @if(Auth::check())
                <div class="card mb-3 card-1">
                    <div class="card-header">Create Post</div>
                    <div class="card-body">
                        <form  method="post" action="{{ route('post.store') }}"  class="text-muted">
                            @csrf
                            <input type="hidden" name="source" value="web">
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                            </div>
                            <div class="form-inline float-right">
                                <div class="form-check mr-2">
                                    <input type="checkbox" name="is_anonymous" value="1" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label text-dark" for="exampleCheck1">Hide My Name</label>
                                </div>
                                <button class="btn btn-success ripple ">Submit Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            {{-- end of create post --}}
            {{-- all post --}}
            @php
            $count = 0;
            $replycount = 0;
            @endphp
            @foreach ($posts as $post)
                <div class="card mb-2 card-2">
                        <div class="card-body" id="myanchorid{{ $count }}">
                            <div class="cardinfo mb-3">
                                <img src="{{ $post->is_anonymous == 1 ? '/img/anonymous.png' : ($post->user->gender == 'female' ? '/img/female.png' : ($post->user->gender == 'male' ? '/img/male.png' : '/img/other.png'))}}" class="float-left" >
                                <p class="d-inline ml-2">{{  $post->is_anonymous == 0 ? $post->user->f_name .' '.$post->user->l_name : 'Anonymous ' }}</p><br>
                                <p class="d-inline ml-2">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <h5 class="mp-5 ">{{ $post->body }}</h5>
                            <hr>
                            @if(Auth::check())
                                <span>{{ $post->postLikes->count() }}</span>
                                <form method="post" action="{{ route('postlike.update', $post->id) }}"  class="d-inline ">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" value="1" name="is_liked">
                                    <input type="hidden" name="post_id" value="#myanchorid{{ $count}}">
                                    <button class="btn btn-white"><a style=" text-decoration: none !important; color:black" ><i class="far fa-thumbs-up"></i>
                                        like
                                    </a></button>
                                </form>
                                <button onclick="myFunction({{ $count }}, 'comment', 'reply', {{ $replycount }})" class="btn btn-white"><i class="far fa-comment"></i> Comment</button>
                                <button class="btn btn-white"><a style=" text-decoration: none !important; color:black" href="#"><i class="fas fa-share"></i>
                                    <div class="fb-share-button"
                                    data-href="http://13.229.230.79/post/{{ $post->id }}"
                                    data-layout="button_count">
                                  </div>
                                </a></button>
                            @else
                                <button class="btn btn-white"><a style=" text-decoration: none !important; color:black" href="{{ route('login') }}"><i class="far fa-thumbs-up"></i> Like</a></button>
                                <button class="btn btn-white"><a style=" text-decoration: none !important; color:black" href="{{ route('login') }}"><i class="far fa-comment"></i> Comment</a></button>
                                <button class="btn btn-white"><a style=" text-decoration: none !important; color:black" href="{{ route('login') }}"><i class="fas fa-share"></i> Share</a></button>
                            @endif
                            @if(Auth::check() && Auth::id() == $post->user->id)
                                <form action="{{ route('post.destroy', $post->id)}}" onclick="return confirm('Are you sure, you want to delete this post?')" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="#myanchorid{{ $count}}">
                                    <button class="btn btn-white text-danger">Delete</button>
                                </form>
                            @endif
                            <hr>
                            {{-- commet --}}
                            <div class="container mb-5" id="myDIVcomment{{ $count }}reply{{ $replycount }}" style="display:none">
                                <form  method="post" action="{{ route('comment.store') }}"  class="text-muted m-2">
                                    @csrf
                                    <input type="hidden" name="source" value="web">
                                    <input type="hidden" name="post_id" value= {{ $post->id }}>
                                    <input type="hidden" name="id" value="#myanchorid{{ $count}}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" id="body" rows="2"></textarea>
                                    </div>
                                    <div class="form-inline float-right ">
                                        <div class="form-check mr-2">
                                            <input type="checkbox" name="is_anonymous" value="1" class="form-check-input" id={{ $post->id }} checked>
                                            <label class="form-check-label text-dark" for={{ $post->id }}>Hide My Name</label>
                                        </div>
                                        <button class="btn btn-success ripple ">Submit Comment</button>
                                    </div>
                                </form>
                            </div><br>
                            <div>
                                @foreach ($post->comments as $comment)
                                        <div class="cardcomment row mb-3">
                                            <div class=" col-md-1">
                                                <img class="mr-2" src="{{ $comment->is_anonymous == 1 ? '/img/anonymous.png' : ($comment->user->gender == 'female' ? '/img/female.png' : ($comment->user->gender == 'male' ? '/img/male.png' : '/img/other.png'))}}" class="float-left" >
                                            </div>
                                            <div class="col-md-11 mt-2">
                                                <p class="d-inline commentbody"><b>{{  $comment->is_anonymous == 0 ? $comment->user->f_name .' '.$comment->user->l_name : 'Anonymous' }}</b>{{ '  '. $comment->body }}</p><br>
                                                @if(Auth::check())
                                                    <a  class="btn underline text-primary">Like</a>
                                                    <a onclick="myFunction({{ $count }}, 'comment', 'reply', {{ $comment->id }})" class="btn underline text-primary">Reply</a>
                                                @else
                                                    <a class="btn underline text-primary" style=" text-decoration: none !important; color:black" href="{{ route('login') }}">Like</a>
                                                    <a class="btn underline text-primary" style=" text-decoration: none !important; color:black" href="{{ route('login') }}">Reply</a>
                                                @endif
                                                @if(Auth::check() && Auth::id() == $comment->user->id)
                                                    <form action="{{ route('comment.destroy', $comment->id)}}" onclick="return confirm('Are you sure, you want to delete this comment?')" method="post" style="display: inline;">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="#myanchorid{{ $count}}">
                                                        <button class="btn btn-white text-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    {{-- replay --}}
                                    <div class="container col-md-11 mb-5" id="myDIVcomment{{ $count }}reply{{ $comment->id }}" style="display:none">
                                        <form  method="post" action="{{ route('reply.store') }}"  class="text-muted m-2">
                                            @csrf
                                            <input type="hidden" name="source" value="web">
                                            <input type="hidden" name="post_id" value= {{ $post->id }}>
                                            <input type="hidden" name="comment_id" value= {{ $comment->id }}>
                                            <input type="hidden" name="id" value="#myanchorid{{ $count}}">
                                            <div class="form-group">
                                                <textarea class="form-control" name="body" id="body" rows="2"></textarea>
                                            </div>
                                            <div class="form-inline float-right ">
                                                <div class="form-check mr-2">
                                                    <input type="checkbox" name="is_anonymous" value="1" class="form-check-input" id={{ $post->id }}>
                                                    <label class="form-check-label" for={{ $post->id }}>Hide My Name</label>
                                                </div>
                                                <button class="btn btn-success ripple ">Submit Reply</button>
                                            </div>
                                        </form>

                                    </div><br>
                                    @foreach ($comment->replies as $reply)
                                        <div class="ml-5">
                                            <div class="cardreply row">
                                                <div class=" col-md-1">
                                                    <img class="mr-2 " src="{{ $reply->is_anonymous == 1 ? '/img/anonymous.png' : ($reply->user->gender == 'female' ? '/img/female.png' : ($reply->user->gender == 'male' ? '/img/male.png' : '/img/other.png'))}}" class="float-left" >
                                                </div>
                                                <div class="col-md-11">
                                                    <p class=" d-inline "><b>{{  $reply->is_anonymous == 0 ? $reply->user->f_name .' '.$reply->user->l_name : 'Anonymous' }}</b>{{ '  '. $reply->body }}</p><br>
                                                    @if(Auth::check())
                                                        <a  class="btn underline text-primary">Like</a>
                                                    @else
                                                        <a class="btn underline text-primary" style=" text-decoration: none !important; color:black" href="{{ route('login') }}">Like</a>
                                                    @endif
                                                    @if(Auth::check() && Auth::id() == $reply->user->id)
                                                        <form action="{{ route('reply.destroy', $reply->id)}}" onclick="return confirm('Are you sure, you want to delete this Reply?')" method="post" style="display: inline;">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="id" value="#myanchorid{{ $count}}">
                                                            <button class="btn btn-white text-danger ">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- end of replay --}}
                                @endforeach
                            </div>
                            {{-- end of commet --}}
                            @php
                                $count++
                            @endphp
                        </div>
                    </div>
            @endforeach
            {{-- {{ $posts->links() }} --}}
            {{-- end of all post --}}
        </div>
    </div>
</div>
<div id="fb-root"></div>
@endsection

<script>
    function myFunction(count, comment, reply, replycount) {
    var x = document.getElementById("myDIV"+ comment + count + reply +replycount);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    }
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
