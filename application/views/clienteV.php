<?php $this->load->helper("ajax_cliente") ?>
<body>

  <button type="button" class="btn btn-success" id="nueCli">Nuevo</button>

  <table border="1" class="table table-dark">
   <thead>
    <tr>
     <td>N°</td>
     <td>Nombre</td>
     <td>Apellido</td>
     <td>Suscripcion</td>
     <td>Genero</td>
     <td>Eliminar</td>
     <td>Editar</td>
   </tr>
 </thead>
 <tbody id="tabla_cliente">

 </tbody>

</table>

<div class="modal" tabindex="-1" role="dialog" id="modalBorrar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmacion de Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Realmente desea eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnBorrar">Si, borrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> 


<!-- The Modal -->
  <div class="modal fade" id="cliente">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="font-family: 'Montserrat', cursive; color: #a8834c;"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="formCliente" action="cliente" method="POST" style="font-family: 'Montserrat', cursive; color: #46281e;">
            <input type="hidden" name="id_cliente" id="id" value="0">
            <div class="row">
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" ><i class="fa fa-tags" >&nbsp</i>Nombre</span>
                  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="nombre" id="nombre">
                </div>
              </div>
          
            </div>

             <div class="row">
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" ><i class="fa fa-tags" >&nbsp</i>Apellido</span>
                  <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="apellido" id="apellido">
                </div>
              </div>
          
            </div>

            <div class="row my-3">
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" ><i class="fa fa-tags" >&nbsp</i>Suscripcion</span>
                  <select name="suscripcion" id="suscripcion" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    <option value="">-- Seleccione  Suscripcion--</option>
                  </select>
                </div>
              </div>
            
            </div>

             <div class="row my-3">
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text" ><i class="fa fa-tags" >&nbsp</i>Genero</span>
                  <select name="genero" id="genero" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    <option value="">-- Seleccione  Genero--</option>
                  </select>
                </div>
              </div>
            
            </div>
          </form>             
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>  


