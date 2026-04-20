@extends('layouts.app')

@section('title', 'Nueva Incidencia - NexoDesk')
@section('page_heading')Registrar nueva incidencia@endsection
@section('page_subheading')Documenta el contexto del caso y adjunta evidencia para el equipo.@endsection

@section('content')
    <section class="grid">
        <article class="panel">
            <h2 style="margin-top:0;">Nueva incidencia</h2>
            <p class="meta">Completa la informacion del caso para iniciar seguimiento.</p>

            <form action="/reportes" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label>Titulo</label>
                    <input type="text" name="titulo" placeholder="Error al iniciar sesion en portal interno">
                </div>

                <div class="field">
                    <label>Descripcion</label>
                    <textarea name="descripcion" placeholder="Describe lo ocurrido, impacto y pasos para reproducir..."></textarea>
                </div>

                <div class="field">
                    <label>Adjunto (opcional)</label>
                    <input type="file" name="imagen">
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Guardar incidencia</button>
                    <a class="btn" href="/reportes">Volver al listado</a>
                </div>
            </form>
        </article>

        <aside class="panel">
            <h3 style="margin-top:0;">Buenas practicas de registro</h3>
            <ol class="meta" style="line-height:1.6;">
                <li>Define un titulo claro.</li>
                <li>Describe el contexto funcional.</li>
                <li>Adjunta evidencia visual.</li>
                <li>Comparte actualizaciones en comentarios.</li>
            </ol>
            <p class="meta">Un buen registro acelera la resolucion del equipo.</p>
        </aside>
    </section>
@endsection
