<!-- Modal -->
<form method="POST" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="modal fade" id="crearPortero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Portero</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div class="col-sm">
            <div class="form-group">
                <label for="codigo">Documento*</label>
                <input type="text" class="form-control" id="_documento" name="_documento" placeholder="Ingresa el documento" onkeypress="if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 13 || event.keyCode > 13)) event.returnValue = false " maxLength="10" required>
            </div>

            <div class="form-group">
                <label for="nombres">Nombres*</label>
                <input type="text" class="form-control" id="_nombres" name="_nombres" placeholder="Ingresa los nombres" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 13 || event.keyCode > 13) && (event.keyCode < 32 || event.keyCode > 32)) event.returnValue = false;" maxLength="30" required>                
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos*</label>
                <input type="text" class="form-control" id="_apellidos" name="_apellidos" placeholder="Ingresa los apellidos" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 13 || event.keyCode > 13) && (event.keyCode < 32 || event.keyCode > 32)) event.returnValue = false;" maxLength="30" required>
            </div> 

            <div class="form-group">
                <label for="apellidos">Dirección*</label>
                <input type="text" class="form-control" id="_direccion" name="_direccion" placeholder="Ingresa la dirección">
            </div>   

            <div class="form-group">
                <label for="apellidos">Teléfono*</label>
                <input type="text" class="form-control" id="_telefono" name="_telefono" placeholder="Ingresa el teléfono" onkeypress="if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 13 || event.keyCode > 13)) event.returnValue = false " maxlength="12" required>
            </div>            

            <div class="form-group">
                <label for="apellidos">Correo*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el correo">
            </div>            
        </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para cerrar">
            
             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
            </svg>

        Cerrar</button>
        <button id="registro" type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Presione para crear el portero">

          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
           <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
           </svg> 

        Crear Portero</button>
      </div>
    </div>
  </div>

 

</div>
 </form>

  <script>
    $(document).ready(function (){

      $('#_documento').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      });

      $('#_nombres').keyup(function (){
        this.value = (this.value + '').replace(/[^A-Za-z ñÑáéíóúÁÉÍÓÚ\s]+/g, '');
      });

    });
</script>


<!--Cedula:<input type="text" name="txtcedula" placeholder="Ingrese la cedula" onkeypress="if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 13 || event.keyCode > 13)) event.returnValue = false;" maxlength="12" required>

    Nombre:<input type="text" name="txttexto" placeholder=" Ingrese el nombre" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 13 || event.keyCode > 13) && (event.keyCode < 32 || event.keyCode > 32)) event.returnValue = false;" maxLength="30" required>-->