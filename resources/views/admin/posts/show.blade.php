@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{$post->title}}</h1>
        <div class="card-body">
            {{$post->content}}
            <div>
                <a href="{{route('admin.posts.index')}}"><button class="btn btn-primary mt-5">Torna ai posts</button></a>
            </div>
        </div>
</div>
@endsection