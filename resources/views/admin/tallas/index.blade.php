@extends('layouts.dash')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tallas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tallas.create') }}"> Crear nueva talla</a>
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
            <th>Talla</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($tallas as $talla)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $talla->talla }}</td>
                <td>
                    <form action="{{ route('tallas.destroy', $talla->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('tallas.show', $talla->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('tallas.edit', $talla->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $tallas->links() !!}

@endsection
