@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Riassunto</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Pubblico</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Azione</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{$post['id']}}</th>
                            <td>{{$post['title']}}</td>
                            <td>{{substr($post['content'], 0, 20)}}</td>
                            <td>{{$post['slug']}}</td>
                            <td>{{$post->category['name']}}</td>
                            <td>@if ($post['public'] == 1) Si @else No @endif </td>
                            <td>
                                @foreach ($post->tags as $tag) 
                                    {{$tag['name']}} 
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('admin.posts.show', $post->id)}}"><button class="btn btn-primary">Visualizza</button></a>
                                <a href="{{route('admin.posts.edit', $post->id)}}"><button class="btn btn-secondary">Modifica</button></a>
                                <form action="{{route('admin.posts.destroy', $post->id)}}" method="Post"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <input type="submit" class="btn btn-danger" value="Cancella">
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
              </table>
            <a href="{{route('admin.posts.create')}}"><button class="btn btn-primary mt-5">Crea nuovo post</button></a>
        </div>
    </div>
@endsection