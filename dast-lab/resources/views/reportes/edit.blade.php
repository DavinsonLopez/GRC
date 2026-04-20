@extends('layouts.app')

@section('title', 'Editar Incidencia - NexoDesk')
@section('page_heading')Actualizar incidencia@endsection
@section('page_subheading')Modifica datos del caso y mantelo al dia con nueva informacion.@endsection

@section('content')
    <section class="panel" style="max-width:760px; margin:0 auto;">
        <h2 style="margin-top:0;">Editar incidencia #{{ $reporte->id }}</h2>
        <p class="meta">Actualiza campos clave para mantener el historial del caso.</p>

        <form action="/reportes/{{ $reporte->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label>Titulo</label>
                <input type="text" name="titulo" value="{{ $reporte->titulo }}">
            </div>

            <div class="field">
                <label>Descripcion</label>
                <textarea name="descripcion">{{ $reporte->descripcion }}</textarea>
            </div>

            <div class="field">
                <label>Reemplazar adjunto</label>
                <input type="file" name="imagen">
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">Actualizar</button>
                <a class="btn" href="/reportes/{{ $reporte->id }}">Ver detalle</a>
                <a class="btn" href="/reportes">Volver</a>
            </div>
        </form>
    </section>
@endsection
