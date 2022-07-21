@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{$tag->name}}</h1>
            <div>
                <a href="{{route('admin.tags.index')}}"><button class="btn btn-primary mt-5">Torna ai tags</button></a>
            </div>
</div>
@endsection