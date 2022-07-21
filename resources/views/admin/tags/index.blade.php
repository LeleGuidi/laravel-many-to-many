@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Azione</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <th scope="row">{{$tag['id']}}</th>
                            <td>{{$tag['name']}}</td>
                            <td>{{$tag['slug']}}</td>
                            <td>
                                <a href="{{route('admin.tags.show', $tag->id)}}"><button class="btn btn-primary">Visualizza</button></a>
                                <a href="{{route('admin.tags.edit', $tag->id)}}"><button class="btn btn-secondary">Modifica</button></a>
                                <form action="{{route('admin.tags.destroy', $tag->id)}}" method="Post"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <input type="submit" class="btn btn-danger" value="Cancella">
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
              </table>
            <a href="{{route('admin.tags.create')}}"><button class="btn btn-primary mt-5">Crea nuovo Tag</button></a>
        </div>
    </div>
@endsection