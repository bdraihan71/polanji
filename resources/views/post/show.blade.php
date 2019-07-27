@extends('layouts.app')

@section('content')
<div class="container infinite-scroll mt-5">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <h3>{{ $post->body }}</h3>
        </div>
    </div>
</div>
@endsection
