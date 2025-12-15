{{--
    articles/create.blade.php

    Formulario para crear o editar artículos.
    Reutilizo la misma vista para ambas acciones: si existe $article,
    se muestran sus datos y el formulario envía a 'update'; si no, a 'store'.
--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1>{{ isset($article) ? 'Editar Artículo' : 'Crear Nuevo Artículo' }}</h1>

            <!-- Mostrar errores de validación si existen -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mostrar mensaje de error si existe -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulario reutilizado para crear o editar (requiere estar autenticado) -->
            <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="POST">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif

                <!-- Campo Título -->
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                          <input type="text" 
                              class="form-control @error('title') is-invalid @enderror" 
                              id="title" 
                              name="title" 
                              value="{{ old('title', $article->title ?? '') }}" 
                              required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo Autor -->
                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                          <input type="text" 
                              class="form-control @error('author') is-invalid @enderror" 
                              id="author" 
                              name="author" 
                              value="{{ old('author', $article->author ?? '') }}" 
                              required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo Contenido (body) -->
                <div class="mb-3">
                    <label for="body" class="form-label">Contenido</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" 
                              id="body" 
                              name="body" 
                              rows="8" 
                              required>{{ old('body', $article->body ?? '') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo Fecha -->
                <div class="mb-3">
                    <label for="date" class="form-label">Fecha</label>
                          <input type="date" 
                              class="form-control @error('date') is-invalid @enderror" 
                              id="date" 
                              name="date" 
                              value="{{ old('date', isset($article) ? $article->date : '') }}" 
                              required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Guardar cambios' : 'Crear Artículo' }}</button>
                    <a href="/articles" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
