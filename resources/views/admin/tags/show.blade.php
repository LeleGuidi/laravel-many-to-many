@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{$category->name}}</h1>
            <div>
                <a href="{{route('admin.categories.index')}}"><button class="btn btn-primary">Torna ai posts</button></a>
            </div>
</div>
@endsection