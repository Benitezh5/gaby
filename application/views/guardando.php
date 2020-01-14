
<!-- Modal -->
<div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" id="formCliente" action="cliente">
          <input type="hidden" name="id_cliente" id="id_cliente">
          <center>




            <td>Nombre</td>
            <input type="text" name="nombre" id="nombre">

            <br>
            <br>


            <td>Apellido</td>
            <input type="text" name="apellido" id="apellido">
            
            <br>
            <br>

            <td>Suscripcion</td>
            <select name="suscripcion" id="suscripcion">
              <option value=''>Seleccione Suscripcion</option>

            </select>
            <br>
            <br>

            <td>Genero</td>
            <select name="genero" id="genero">
              <option value=''>Seleccione Genero</option>

            </select>

          </center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
