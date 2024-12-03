@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Tickets</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tickets.create') }}"> Crear Nuevo Ticket</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID Ticket</th>
            <th>Fecha de Venta</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id_ticket }}</td>
                <td>{{ $ticket->fecha_ventas }}</td>
                <td>
                    {{ $ticket->cliente->user->name }} 
                    {{ $ticket->cliente->user->ap }} 
                    {{ $ticket->cliente->user->am }}
                </td> <!-- Muestra el nombre completo del cliente -->
                <td>
                    {{ $ticket->empleado->user->name }} 
                    {{ $ticket->empleado->user->ap }} 
                    {{ $ticket->empleado->user->am }}
                </td> <!-- Muestra el nombre completo del empleado -->
                <td>{{ $ticket->total }}</td>
                <td>
                    <form action="{{ route('tickets.destroy', $ticket->id_ticket) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('tickets.edit', $ticket->id_ticket) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este ticket?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $tickets->links() !!}
@endsection