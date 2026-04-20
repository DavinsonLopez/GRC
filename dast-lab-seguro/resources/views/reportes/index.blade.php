@extends('layouts.app')

@section('title', 'Incidencias - NexoDesk')
@section('page_heading')Panel de incidencias@endsection
@section('page_subheading')Consulta, prioriza y da seguimiento a los reportes del equipo.@endsection

@section('content')
    <section class="panel stack">
        <div class="actions">
            <a href="/reportes/create" class="btn btn-primary">Registrar incidencia</a>
            <a href="/api/users" class="btn">Directorio de usuarios</a>
        </div>

        @if($reportes->isEmpty())
            <div class="card">
                <h3 style="margin-top:0;">Sin incidencias registradas</h3>
                <p class="meta">Crea la primera incidencia para comenzar el seguimiento.</p>
            </div>
        @endif

        @foreach($reportes as $reporte)
            <article class="card">
                <p class="meta">Incidencia #{{ $reporte->id }}</p>
                <h3 style="margin-bottom:8px;">{{ $reporte->titulo }}</h3>
                <p>{{ $reporte->descripcion }}</p>

                @if($reporte->imagen)
                    <p><img src="{{ $reporte->imagen }}"></p>
                @endif

                <div class="actions">
                    <a class="btn" href="/reportes/{{ $reporte->id }}">Ver incidencia</a>
                    <a class="btn" href="/reportes/{{ $reporte->id }}/edit">Editar</a>
                    <form action="/reportes/{{ $reporte->id }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    </section>
@endsection
