@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica il post</h1>
        <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input required type="text" class="form-control @error('title') is invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
                @error('title')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea redquired rows="5" class="form-control @error('content') is invalid @enderror" id="content" name="content">{{old('content', $post->content)}}</textarea>
                @error('content')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="custom-select @error('category_id') is invalid @enderror" name="category_id">
                    <option value="">Seleziona la categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id', $post->category_id)==$category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input @error('public') is invalid @enderror" id="public" name="public">
                <label class="form-check-label" for="public">Pubblica</label>
                @error('public')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica post</button>
        </form>
    </div>
    
@endsection