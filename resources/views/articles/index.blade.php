{{--
    articles/index.blade.php

    Vista principal de artículos.
    Muestra el listado de artículos del usuario autenticado con opciones
    para crear, editar y eliminar (solo si está logueado).
--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Artículos</h1>
                <div>
                    <!-- Mostrar nombre de usuario si está autenticado -->
                    {{-- Muestro nombre y botón de crear solo si el usuario está autenticado --}}
                    @auth
                        <span class="me-3">Hola, <strong>{{ Auth::user()->name }}</strong></span>
                        <!-- Enlace para crear nuevo artículo -->
                        <a href="{{ route('articles.create') }}" class="btn btn-primary">Nuevo artículo</a>
                    @endauth
                    
                    {{-- Si es invitado, solo muestro acceso a login --}}
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar sesión</a>
                    @endguest
                </div>
            </div>

            <!-- Mensajes de feedback de éxito/error al crear/eliminar -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Listado de artículos (público) -->
            @foreach($articles as $article)
                <div class="article-item mb-3 pb-2 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <!-- Título como link a la ruta articles.show -->
                        <a href="{{ route('articles.show', $article->id) }}">
                            {{ $article->title }}
                        </a>
                        
                        <!-- Fecha del artículo -->
                        <small class="text-muted d-block">
                            {{ $article->created_at->format('d/m/Y') }}
                        </small>
                    </div>
                    
                    <!-- Formulario para eliminar artículo (solo usuarios autenticados) -->
                    @auth
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-secondary btn-sm me-2">Editar</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este artículo?')">
                                Eliminar
                            </button>
                        </form>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
