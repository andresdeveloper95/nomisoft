<!-- Modal -->
<form method="POST" action="" id="deleteForm">
        @method('DELETE')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" name="idEliminar" value="" id="idEliminarTurno">
        
<div class="modal" id="deleteTurno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Turno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <p>¿Seguro deseas eliminar este Turno ?</p>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button id="eliminaTurno-btn" type="button" class="btn btn-primary" data-dismiss="modal">Eliminar Turno</button>
      </div>
    </div>
  </div>
</div>
 </form>

<!-- Este modal fue extraido de esta https://getbootstrap.com/docs/4.0/components/modal/-->
