<!-- Modal -->
<form method="POST" action="#">
@method('PATCH')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token1">
    <input type="hidden" name="idActualizar" value="" id="idActualizar">
    <div class="modal fade" id="updatePortero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Portero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="col-sm">

            <div class="form-group">
                <label for="nombres">Nombres*</label>
                <input type="text" class="form-control" id="nombres1" name="nombres" placeholder="Ingresa los nombres" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 13 || event.keyCode > 13) && (event.keyCode < 32 || event.keyCode > 32)) event.returnValue = false;" maxLength="30" required>                
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos*</label>
                <input type="text" class="form-control" id="apellidos1" name="_apellidos" placeholder="Ingresa los apellidos" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 13 || event.keyCode > 13) && (event.keyCode < 32 || event.keyCode > 32)) event.returnValue = false;" maxLength="30" required>
            </div> 

            <div class="form-group">
                <label for="apellidos">Dirección*</label>
                <input type="text" class="form-control" id="direccion1" name="_direccion" placeholder="Ingresa la dirección">
            </div>   

            <div class="form-group">
                <label for="apellidos">Teléfono*</label>
                <input type="text" class="form-control" id="telefono1" name="_telefono" placeholder="Ingresa el teléfono" onkeypress="if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 13 || event.keyCode > 13)) event.returnValue = false " maxlength="12" required>
            </div>            
        </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para cerrar">

            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
            </svg>

        Cerrar</button>
        <button id="registroUpdate" type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para actualizar el portero">

            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM6 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm6.854.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>

        Actualizar Portero</button>
      </div>
    </div>
  </div>
</div>
 </form>