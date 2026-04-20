@extends('layouts.app')

@section('title', 'Dashboard - NexoDesk')
@section('page_heading')Dashboard de incidencias@endsection
@section('page_subheading')Resumen general de actividad y acceso rapido a la gestion de casos.@endsection

@section('content')
    <section class="stack">
        <div class="grid">
            <article class="card">
                <p class="meta">Total de incidencias</p>
                <h2 style="margin:6px 0 0;">{{ $totalReportes }}</h2>
            </article>
            <article class="card">
                <p class="meta">Con adjunto</p>
                <h2 style="margin:6px 0 0;">{{ $conImagen }}</h2>
            </article>
        </div>

        <article class="panel">
            <div class="actions" style="margin-bottom:10px;">
                <a class="btn btn-primary" href="/reportes/create">Crear incidencia</a>
                <a class="btn" href="/reportes">Ver todas</a>
            </div>

            <h3 style="margin-top:0;">Ultimas incidencias</h3>

            @if($ultimos->isEmpty())
                <div class="card">
                    <p class="meta">No hay incidencias registradas aun.</p>
                </div>
            @endif

            @foreach($ultimos as $item)
                <article class="card" style="margin-bottom:10px;">
                    <p class="meta">Incidencia #{{ $item->id }}</p>
                    <h4 style="margin:6px 0;">{{ $item->titulo }}</h4>
                    <p>{{ $item->descripcion }}</p>
                    <div class="actions">
                        <a class="btn" href="/reportes/{{ $item->id }}">Ver detalle</a>
                        <a class="btn" href="/reportes/{{ $item->id }}/edit">Editar</a>
                    </div>
                </article>
            @endforeach
        </article>
    </section>
@endsection
