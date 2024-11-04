@extends('layouts.dash')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit tipo</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('tipo_ropas.index') }}"> Back</a>


            </div>

        </div>

    </div>



    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <form action="{{ route('tipo_ropas.update',$tipo_ropa->id) }}" method="POST">

        @csrf

        @method('PUT')


        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Tipo:</strong>

                    <input type="text" name="tipo" value="{{ $tipo_ropa->name }}" class="form-control" placeholder="Tipo">

                </div>

            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>


    </form>

@endsection
