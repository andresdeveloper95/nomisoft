<!-- Modal -->
<form method="POST" action="#">
@method('PATCH')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token3">
    <input type="hidden" name="idActualizarTurno" value="" id="idActualizarTurno">
    <div class="modal fade" id="updateTurno1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Turno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="col-sm">

            <div class="form-group">
                <label for="name">Hora de inicio*</label>
                <input type="text" class="form-control" id="inicio1" name="nombres" placeholder="Ingresa la hora">                
            </div>

            <div class="form-group">
                <label for="apellidos">Hora de fin*</label>
                <input type="text" class="form-control" id="fin1" name="_apellidos" placeholder="Ingresa la hora">
            </div> 
            </div>
     </div>

     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para cerrar">

         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
        </svg>

       Cerrar</button>
       <button id="registroUpdateTurno" type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para actualizar el turno">

        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar2-check-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm-2 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-1zm8.854 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
      </svg>

       Actualizar Turno</button>
     </div>
   </div>
 </div>
</div>
</form>