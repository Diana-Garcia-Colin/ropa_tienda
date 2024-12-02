@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Ticket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Regresar</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> Hay problemas con los campos ingresados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.update', $ticket->id_ticket) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Campo Fecha de Venta -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Venta:</strong>
                    <input type="date" name="fecha_ventas" value="{{ $ticket->fecha_ventas }}" class="form-control" required>
                </div>
            </div>

            <!-- Selección de Cliente -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cliente:</strong>
                    <select name="id_cliente" class="form-control" required>
                        <option value="">Seleccione un Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $ticket->id_cliente ? 'selected' : '' }}>
                                {{ $cliente->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Selección de Empleado -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Empleado:</strong>
                    <select name="id_empleado" class="form-control" required>
                        <option value="">Seleccione un Empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id_empleado }}" {{ $empleado->id_empleado == $ticket->id_empleado ? 'selected' : '' }}>
                                {{ $empleado->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Campo Total -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total:</strong>
                    <input type="number" name="total" value="{{ $ticket->total }}" step="0.01" min="0" class="form-control" required>
                </div>
            </div>

            <!-- Botón Guardar -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </form>
@endsection
