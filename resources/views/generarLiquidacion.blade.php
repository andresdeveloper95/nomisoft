@extends('layouts.layout')

@section('title','Generar Liquidación')
@section('content') 
<!-- MDBootstrap Datatables  -->
<div class="row">

        <div>&nbsp;</div>
        <a href="{{ route('ayuda.liquidacion') }}" class="btn btn-primary" style="float:right; margin-left: 1400px;" target="_blank" data-placement="top" title="Presione para obtener ayuda">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
            </svg>
        </a>
</div>

<div class="container">
<ol class="breadcrumb">
            <li><a href="{{ url('/') }} ">Menú Principal     </a></li>
            <p>       /</p>
            <li class="active">  Generar Liquidación  </li>
</ol>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <center><h1>
                    Generar Liquidación
                    </h1></center>
                    </div>
                    <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</i>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <form class="needs-validation" novalidate method="POST" action="{{ route('recargos.generar') }}">
                        @csrf
        
                            <div class="row">

                                <div class="col">
                                    
                                    <label for="porteros">Porteros*</label>
                                    <select name="idporteros" id="idporteros"  class="col-sm-30" style="width 20 px;">
                                    <option value='-1'disabled selected>Seleccione el portero</option>; 
                                        @foreach ($porteros as $portero)
                                            <option value="{{ $portero['id'] }}">{{ $portero['name'] }}</option>
                                        @endforeach 
                                    </select>
                                    <div>&nbsp;</div>
                                </div>
            
                                <div class="col">
                                    <label for="calendario">Fecha de inicio*</label>
                                    <input type="text" class="datepicker-here calender"  name="fechaInicio"
                                     data-language="es" required readonly="readonly"/>
                                     <div>&nbsp;</div>
                                </div>
                                
                                 <div class="col">
                                    <label for="calendario">Fecha de fin*</label>
                                    <input type="text" class="datepicker-here calender" name="fechaFin"
                                     data-language="es" required readonly="readonly"/>
                                </div>
                                <div class="col">
                                    <div>&nbsp;</div>
                                    <button id="msj" type="submit"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Presione para generar liquidación">
                                
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-spreadsheet" 
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1H4zm9
                                       6h-3v2h3V7zm0 3h-3v2h3v-2zm0 3h-3v2h2a1 1 0 0 0 1-1v-1zm-4 2v-2H6v2h3zm-4 0v-2H3v1a1 1 0 0 0 1 
                                       1h1zm-2-3h2v-2H3v2zm0-3h2V7H3v2zm3-2v2h3V7H6zm3 3H6v2h3v-2z"/>
                                    </svg>
                                
                                Generar Liquidación</button>
                                </div>

                                <div class="col">
                                    <div>&nbsp;</div>
                                    <a href="{{ route('recargos.dataTable') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Presione para mostrar recargo">
                                    
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-data" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 
                                      1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                      <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 
                                      6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                      <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                                    </svg>
                                    
                                    Mostrar Recargos</a>
                                </div>
                            </div>                         
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>