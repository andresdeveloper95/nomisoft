@extends('layouts.layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Turnos registrados</div>
                    <div class="card-body">

                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearTurno">
                        Crear Turno</button>

                    <table id="tableTurnos" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Código</th>
                                <th>Hora de inicio</th>
                                <th>Hora de fin</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($turnos as $turno)
                                <tr>
                                    <td>{{ $turno->id }}</td>
                                    <td>{{ $turno->codigo }}</td>
                                    <td>{{ $turno->horaInicio }}</td>
                                    <td>{{ $turno->horaFin }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
