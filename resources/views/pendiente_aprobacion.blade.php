<!-- resources/views/pendiente_aprobacion.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>Cuenta en Revisión</h2>
        <p>Tu cuenta está actualmente en espera de aprobación por parte del administrador.</p>
        <p>Te notificaremos cuando tu cuenta esté lista para ser utilizada. Gracias por tu paciencia.</p>

        @if (session('message'))
            <div class="alert alert-info mt-3">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ url('/home') }}" class="btn btn-primary mt-4">Volver a Inicio</a>
    </div>
@endsection
