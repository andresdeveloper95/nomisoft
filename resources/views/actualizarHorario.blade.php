<!-- Modal -->
<form method="POST" action="#">
@method('PATCH')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token4">
    <input type="hidden" name="idActualizarHorario" value="" id="idActualizarHorario">
    <div class="modal fade bd-example-modal-lg" id="updateHorario1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="col-sm">

            <div class="row">
               <div class="col-md-6">
                <label for="sede">Sede*</label>
                <select name="idsede" id="idsede1" class="form-control is-valid">
                        <option value="SD"disabled selected>Sede</option>
                        <option value="María Inmaculada">María Inmaculada</option>
                        <option value="Valle del Cauca">Valle del Cauca</option>
                </select>
               </div>
            
            
               <div class="col-md-6">
                    <label for="mes">Mes*</label>
                    <select name="idmes" id="idmes1" class="form-control is-valid">
                        <option value="SD"disabled selected>Mes</option>
                        <option value="Enero">Enero</option>
                        <option value="Febrero">Febrero</option>
                        <option value="Marzo">Marzo</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Septiembre">Septiembre</option>
                        <option value="Octubre">Octubre</option>
                        <option value="Noviembre">Noviembre</option>
                        <option value="Diciembre">Diciembre</option>
                    </select>
                </div>
            </div>

           
           <div class="row">
                <div class="col-md-4">
                    <label for="turnos">1*</label>
                    <select name="idturno" id="idprimero1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
  
                <div class="col-md-4">
                    <label for="turnos">2*</label>
                    <select name="idturno" id="idsegundo1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
                
                <div class="col-md-4">   
                    <label for="turnos">3*</label>
                    <select name="idturno" id="idtercero1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">4*</label>
                    <select name="idturno" id="idcuarto1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">5*</label>
                    <select name="idturno" id="idquinto1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">6*</label>
                    <select name="idturno" id="idsexto1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">7*</label>
                    <select name="idturno" id="idseptimo1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">8*</label>
                    <select name="idturno" id="idoctavo1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">9*</label>
                    <select name="idturno" id="idnoveno1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">            
                    <label for="turnos">10*</label>
                    <select name="idturno" id="iddecimo1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            
                <div class="col-md-4">
                    <label for="turnos">11*</label>
                    <select name="idturno" id="idonce1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">12*</label>
                    <select name="idturno" id="iddoce1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>  
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">13*</label>
                    <select name="idturno" id="idtrece1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">14*</label>
                    <select name="idturno" id="idcatorce1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="turnos">15*</label>
                    <select name="idturno" id="idquince1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="row">  
                <div class="col-md-4">
                    <label for="turnos">16*</label>
                    <select name="idturno" id="iddieciseis1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">17*</label>
                    <select name="idturno" id="iddiecisiete1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">18*</label>
                    <select name="idturno" id="iddiesocho1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">19*</label>
                    <select name="idturno" id="iddiecinueve1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">20*</label>
                    <select name="idturno" id="idveinte1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            
                <div class="col-md-4">
                    <label for="turnos">21*</label>
                    <select name="idturno" id="idveintiuno1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">22*</label>
                    <select name="idturno" id="idveintidos1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">23*</label>
                    <select name="idturno" id="idveintitres1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">24*</label>
                    <select name="idturno" id="idveinticuatro1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>  
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">25*</label>
                    <select name="idturno" id="idveinticinco1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">26*</label>
                    <select name="idturno" id="idveintiseis1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">27*</label>
                    <select name="idturno" id="idveintisiete1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">28*</label>
                    <select name="idturno" id="idveintiocho1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">29*</label>
                    <select name="idturno" id="idveintinueve1" class="form-control is-valid">
                    <option value='-1'disabled selected>Seleccione el turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">30*</label>
                    <select name="idturno" id="idtreinta1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="turnos">31*</label>
                    <select name="idturno" id="idtreintayuno1" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            </div>

     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para cerrar">
       
       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
        </svg>
       
       Cerrar</button>
       <button id="registroUpdateHorario" type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para actualizar el horario">
       
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journal-text" fill="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 
        1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 
        0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
        <path fill-rule="evenodd" d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 
        1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
        </svg>
       
       Actualizar Horario</button>
     </div>
   </div>
 </div>
</div>
</form>