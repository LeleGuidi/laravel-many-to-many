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
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$category['id']}}</th>
                            <td>{{$category['name']}}</td>
                            <td>{{$category['slug']}}</td>
                            <td>
                                <a href="{{route('admin.categories.show', $category->id)}}"><button class="btn btn-primary">Visualizza</button></a>
                                <a href="{{route('admin.categories.edit', $category->id)}}"><button class="btn btn-secondary">Modifica</button></a>
                                <form action="{{route('admin.categories.destroy', $category->id)}}" method="Post"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <input type="submit" class="btn btn-danger" value="Cancella">
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
              </table>
            <a href="{{route('admin.categories.create')}}"><button class="btn btn-primary mt-5">Crea nuova categoria</button></a>
        </div>
    </div>
@endsection