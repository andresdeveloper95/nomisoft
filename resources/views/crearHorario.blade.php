<!-- Modal -->
<form method="POST" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="tokenHorario">
    <div class="modal fade bd-example-modal-lg" id="createHorario" tabindex="-1" role="dialog" 
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">     
        <h5 class="modal-title" id="exampleModalLabel">Crear Horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <label for="porteros">Porteros*</label>
                <select name="idporteros" id="idporteros" class="form-control is-valid" style="width 2px;">
                <option value='-1'disabled selected>Portero</option>; 
                    @foreach ($porteros as $portero)
                        <option value="{{ $portero['id'] }}">{{ $portero['name'] }}</option>
                    @endforeach 
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="sede">Sede*</label>
                <select name="idsede" id="idsede" class="form-control is-valid">
                        <option value="SD"disabled selected>Sede</option>
                        <option value="María Inmaculada">María Inmaculada</option>
                        <option value="Valle del Cauca">Valle del Cauca</option>
                </select>
            </div>

             <div class="col-md-6">
                <label for="mes">Mes*</label>
                <select name="idmes" id="idmes" class="form-control is-valid">
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
                    <select name="idturno" id="idprimero" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
  
                <div class="col-md-4">
                    <label for="turnos">2*</label>
                    <select name="idturno" id="idsegundo" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
                
                <div class="col-md-4">   
                    <label for="turnos">3*</label>
                    <select name="idturno" id="idtercero" class="form-control is-valid">
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
                    <select name="idturno" id="idcuarto" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">5*</label>
                    <select name="idturno" id="idquinto" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">6*</label>
                    <select name="idturno" id="idsexto" class="form-control is-valid">
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
                    <select name="idturno" id="idseptimo" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">8*</label>
                    <select name="idturno" id="idoctavo" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="turnos">9*</label>
                    <select name="idturno" id="idnoveno" class="form-control is-valid">
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
                    <select name="idturno" id="iddecimo" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
            
                <div class="col-md-4">
                    <label for="turnos">11*</label>
                    <select name="idturno" id="idonce" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">12*</label>
                    <select name="idturno" id="iddoce" class="form-control is-valid">
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
                    <select name="idturno" id="idtrece" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">14*</label>
                    <select name="idturno" id="idcatorce" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="turnos">15*</label>
                    <select name="idturno" id="idquince" class="form-control is-valid">
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
                    <select name="idturno" id="iddieciseis" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">17*</label>
                    <select name="idturno" id="iddiecisiete" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">18*</label>
                    <select name="idturno" id="iddiesocho" class="form-control is-valid">
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
                    <select name="idturno" id="iddiecinueve" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">20*</label>
                    <select name="idturno" id="idveinte" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div> 
            
                <div class="col-md-4">
                    <label for="turnos">21*</label>
                    <select name="idturno" id="idveintiuno" class="form-control is-valid">
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
                    <select name="idturno" id="idveintidos" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">23*</label>
                    <select name="idturno" id="idveintitres" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">24*</label>
                    <select name="idturno" id="idveinticuatro" class="form-control is-valid">
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
                    <select name="idturno" id="idveinticinco" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">26*</label>
                    <select name="idturno" id="idveintiseis" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">27*</label>
                    <select name="idturno" id="idveintisiete" class="form-control is-valid">
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
                    <select name="idturno" id="idveintiocho" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">29*</label>
                    <select name="idturno" id="idveintinueve" class="form-control is-valid">
                    <option value='-1'disabled selected>Turno</option>; 
                        @foreach ($turnos as $turno)
                            <option value="{{ $turno['codigo'] }}">{{ $turno['codigo'] }}</option>
                        @endforeach 
                    </select>
                </div>   

                <div class="col-md-4">
                    <label for="turnos">30*</label>
                    <select name="idturno" id="idtreinta" class="form-control is-valid">
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
                    <select name="idturno" id="idtreintayuno" class="form-control is-valid">
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
        <button id="agregarHorario" type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para crear el horario">

            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journal-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
              <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
              <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            
        Crear Horario</button>
      
    </div>
  </div>
</div>
 </form>

 
