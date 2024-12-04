@extends('layouts.dash')

@section('content')
    <h1>Listado de Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Crear Venta</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ticket</th>
            <th>Producto</th>
            <th>Talla</th> {{-- Cambiado a Talla --}}
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->ticket->id_ticket }}</td>
                <td>{{ $venta->producto->tipoRopa->tipo ?? 'Sin tipo definido' }}</td>
                <td>{{ $venta->asigTalla->talla->talla ?? 'Sin talla definida' }}</td> {{-- Mostrar el nombre de la talla --}}
                <td>{{ $venta->cantidad }}</td>
                <td>${{ number_format($venta->subtotal, 2) }}</td>
                <td>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection