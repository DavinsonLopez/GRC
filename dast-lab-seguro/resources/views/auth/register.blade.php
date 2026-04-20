@extends('layouts.app')

@section('title', 'Registro - NexoDesk')
@section('page_heading')Crea tu cuenta de trabajo@endsection
@section('page_subheading')Configura acceso para comenzar a registrar incidencias.@endsection

@section('content')
    <section class="panel" style="max-width:560px; margin:0 auto;">
        <h2 style="margin-top:0;">Registro</h2>
        <p class="meta">Completa tus datos para habilitar tu espacio.</p>

        <form action="/register" method="POST">
            @csrf
            <div class="field">
                <label>Nombre</label>
                <input type="text" name="name" placeholder="Nombre y apellido">
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="usuario@empresa.com">
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Crea una contrasena">
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a class="btn" href="/login">Ya tengo cuenta</a>
            </div>
        </form>
    </section>
@endsection
