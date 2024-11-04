@extends('layouts.dash')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Empresa</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('empresas.create') }}"> Crear nueva empresa</a>
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @php
        $i = 0; // Inicializar la variable $i
    @endphp

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre empresa</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($empresas as $empresa)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $empresa->nom_e }}</td>
                <td>
                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('empresas.show', $empresa->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('empresas.edit', $empresa->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $empresas->links() !!}

@endsection
