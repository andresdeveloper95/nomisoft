<!-- Modal -->
<form method="POST" action="" id="deleteForm">
        @method('DELETE')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" name="idEliminar" value="" id="idEliminarHorario">
        
<div class="modal" id="modalHorario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <p>¿Seguro deseas eliminar este Horario ?</p>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button id="btn-eliminarHorario" type="button" class="btn btn-primary" data-dismiss="modal">Eliminar Horario</button>
      </div>
    </div>
  </div>
</div>
 </form>

<!-- Este modal fue extraido de esta https://getbootstrap.com/docs/4.0/components/modal/-->
