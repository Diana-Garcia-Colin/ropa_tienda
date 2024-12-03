@extends('layouts.dash')

@section('content')
    <h1>Crear Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_ticket" class="form-label">Ticket</label>
            <select name="id_ticket" id="id_ticket" class="form-control">
                @foreach ($tickets as $ticket)
                    <option value="{{ $ticket->id_ticket }}">{{ $ticket->id_ticket }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto</label>
            <select name="id_producto" id="id_producto" class="form-control">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_asigt" class="form-label">Asignación Talla</label>
            <select name="id_asigt" id="id_asigt" class="form-control">
                @foreach ($asigTallas as $asigTalla)
                    <option value="{{ $asigTalla->id }}">{{ $asigTalla->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" step="0.01" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
