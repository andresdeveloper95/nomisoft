@extends('layouts.layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Porteros registrados</div>
                    <div class="card-body">

                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearPortero">Crear Portero</button>

                    <table id="tablePorteros" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Cédula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->cedula }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->apellidos }}</td>
                                    <td>{{ $usuario->direccion }}</td>
                                    <td>{{ $usuario->telefono }}</td>
                                    <td>{{ $usuario->email }}</td>
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





