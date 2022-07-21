@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi una nuova categoria</h1>
        <form action="{{route('admin.categories.store')}}" method="Post">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control @error('name') is invalid @enderror" id="name" name="name" value="{{old('name')}}">
                @error('name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-5">Crea categoria</button>
        </form>
    </div>
    
@endsection