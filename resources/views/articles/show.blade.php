{{--
    articles/show.blade.php

    Vista de detalle de un artículo individual.
    Muestra título, autor, fecha y contenido completo.
--}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Título del artículo -->
            <h1>{{ $article->title }}</h1>
            
            <!-- Información del artículo (autor y fecha) -->
            <div class="article-meta text-muted">
                <small>
                    Por <strong>{{ $article->author }}</strong> | 
                    {{ $article->created_at->format('d/m/Y') }}
                </small>
            </div>
            
            <hr>
            
            <!-- Contenido del artículo -->
            <div class="article-content">
                {{ $article->body }}
            </div>
        </div>
    </div>
</div>
@endsection
