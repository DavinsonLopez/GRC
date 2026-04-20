@extends('layouts.app')

@section('title', 'Detalle de Incidencia - NexoDesk')
@section('page_heading')Detalle de incidencia@endsection
@section('page_subheading')Consulta contexto, evidencia y actualizaciones del caso en un solo lugar.@endsection

@section('content')
    <section class="stack">
        <article class="panel">
            <p class="meta">Incidencia #{{ $reporte->id }}</p>
            <h2 style="margin-top:0;">{{ $reporte->titulo }}</h2>
            <p>{{ $reporte->descripcion }}</p>

            @if($reporte->imagen)
                <p><img src="{{ $reporte->imagen }}"></p>
            @endif

            <div class="actions">
                <a class="btn" href="/reportes/{{ $reporte->id }}/edit">Editar</a>
                <a class="btn" href="/reportes">Volver al listado</a>
            </div>
        </article>

        <article class="panel">
            <h3 style="margin-top:0;">Comentarios</h3>
            <p class="meta">Comparte avances, preguntas o evidencia adicional.</p>

            <form action="/reportes/{{ $reporte->id }}/comentarios" method="POST">
                @csrf
                <div class="field">
                    <label>Comentario libre</label>
                    <textarea name="contenido" placeholder="Ejemplo: Se replico el error y se envio al equipo de soporte."></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Publicar comentario</button>
            </form>
        </article>

        @foreach($comentarios as $comentario)
            <article class="card">
                <p class="meta">Actualizacion #{{ $comentario->id }}</p>
                <div>{{ $comentario->contenido }}</div>
            </article>
        @endforeach
    </section>
@endsection
