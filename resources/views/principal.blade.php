@extends('layouts.layout')

@section('content')

<!-- MDBootstrap Datatables  -->

<div class="row">

        <div>&nbsp;</div>
        <a href="{{ route('porteros.ayuda') }}" class="btn btn-primary" style="float:right; margin-left: 1400px;" target="_blank" data-toggle="tooltip" data-placement="top" title="Presione para obtener ayuda">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
            </svg>
        </a>
</div>


<div class="container"> 
    
    
        <ol class="breadcrumb">
        <li><a href="{{ url('/') }} ">Menú Principal     </a></li>
                <p>       /  </p>
                <li class="active">    Administrar Porteros</li>
                
        </ol>
        
     
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <center>
                        <h1>Administrar Porteros</h1>
                    </center>                         
                    </div>
                    <div class="card-body">
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearPortero" data-toggle="tooltip" data-placement="top" title="Presione para crear portero">

                         


                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>


                            Crear Portero</button>
        
                            
                            
                        <table id="tablePorteros" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Cédula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



<!-- Esta tabla fue extraida de https://getbootstrap.com/docs/4.4/content/tables/ -->
<!-- Información de los data table aquí https://datatables.net/manual/styling/ -->