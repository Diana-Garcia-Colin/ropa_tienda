@extends('layouts.dash')

@section('content')
    <style>



        .card {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            background: #f6f2d7;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            height: 70px;
            border: 2px solid #5074dc;
            border-bottom: 2px dotted #5074dc;
            border-radius: 10px 10px 0 0;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #5074dc;
            font-weight: bold;
            font-size: 1.2em;
            color: white;
        }
        .card-header:before, .card-header:after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 100%;
            bottom: -12px;
            border: 2px solid #5074dc;
            box-sizing: border-box;
        }
        .card-header:before {
            left: -13px;
        }
        .card-header:after {
            right: -13px;
        }
        .card-body {
            padding: 15px;
            height: auto;
            border: 2px solid #5074dc;
            border-top: none;
            border-radius: 0 0 10px 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9em;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        .card-body .title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-footer {
            text-align: center;
            padding: 10px;
            background: #4b6cce;
            border-top: 2px dotted #5074dc;
            color: white;

        }
        .card-footer a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            border-radius: 10px;
        }
        .card-footer a:hover {
            text-decoration: underline;
        }

        .tickets-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 20px;
            margin-left: 20px;
            margin-right: 10px;
        }

        .tickets-container .col-md-6 {
            max-width: 350px;
            width: 100%;
        }

        .borde{
            border-radius: 10px;
        }
    </style>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Lista de Tickets</h2>
                <a class="btn btn-success" href="{{ route('tickets.create') }}">Crear Nuevo Ticket</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="tickets-container">
        @foreach ($tickets as $ticket)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="mb-0">Fashion Store</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha de Venta:</strong> {{ $ticket->fecha_ventas }}</p>
                        <p><strong>Cliente:</strong> {{ $ticket->cliente->user->name }} {{ $ticket->cliente->user->ap }} {{ $ticket->cliente->user->am }}</p>
                        <p><strong>Empleado:</strong> {{ $ticket->empleado->user->name }} {{ $ticket->empleado->user->ap }} {{ $ticket->empleado->user->am }}</p>
                        <p><strong>Total:</strong> ${{ $ticket->total }}</p>

                        <hr>
                        <h6><strong>Productos Vendidos:</strong></h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($ticket->ventas as $venta)
                                <li class="list-group-item" style="border: none; padding: 10px 0;">
                                    <strong>Producto:</strong> {{ $venta->producto->tipoRopa->tipo ?? 'Sin tipo' }} <br>
                                    <strong>Cantidad:</strong> {{ $venta->cantidad }} <br>
                                    <strong>Subtotal:</strong> ${{ $venta->subtotal }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn btn-primary btn-sm" href="{{ route('tickets.edit', $ticket->id_ticket) }}">Editar</a>
                        <form action="{{ route('tickets.destroy', $ticket->id_ticket) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm borde" onclick="return confirm('¿Estás seguro de eliminar este ticket?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {!! $tickets->links() !!}
    </div>
@endsection
