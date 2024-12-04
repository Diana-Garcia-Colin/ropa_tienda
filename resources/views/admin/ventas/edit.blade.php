@extends('layouts.dash')

@section('content')
    <h1>Editar Venta</h1>
    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Selección del ticket --}}
        <div class="mb-3">
            <label for="id_ticket" class="form-label">Ticket</label>
            <select name="id_ticket" id="id_ticket" class="form-control">
                @foreach ($tickets as $ticket)
                    <option value="{{ $ticket->id_ticket }}" {{ $venta->id_ticket == $ticket->id_ticket ? 'selected' : '' }}>
                        {{ $ticket->id_ticket }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Selección del producto (muestra el tipo de ropa) --}}
        <div class="mb-3">
            <label for="id_producto" class="form-label">Producto (Tipo de Ropa)</label>
            <select name="id_producto" id="id_producto" class="form-control">
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $venta->id_producto == $producto->id ? 'selected' : '' }}>
                        {{ $producto->tipoRopa->tipo ?? 'Sin tipo de ropa' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Selección de asignación de talla --}}
        <div class="mb-3">
            <label for="id_asigt" class="form-label">Asignación Talla</label>
            <select name="id_asigt" id="id_asigt" class="form-control">
                @foreach ($asigTallas as $asigTalla)
                    <option value="{{ $asigTalla->id }}" {{ $venta->id_asigt == $asigTalla->id ? 'selected' : '' }}>
                        {{ $asigTalla->talla->talla ?? 'Sin talla definida' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Campo para la cantidad --}}
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $venta->cantidad }}" required>
        </div>

        {{-- Campo para el subtotal --}}
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" step="0.01" class="form-control" value="{{ $venta->subtotal }}" required>
        </div>

        {{-- Botones de acción --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection