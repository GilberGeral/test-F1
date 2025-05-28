<div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title fs-5" id="accion_titulo">Crear nuevo registro</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <form id="formCreation">

        <div class="mb-3">
          <label for="IdInFile" class="form-label">Id</label>
          <input type="number" min="0" step="1" class="form-control" id="IdInFile" name="IdInFile" aria-describedby="emailHelp" required>          
        </div>

        <div class="mb-3">
          <label for="Nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="Nombre" name="Nombre" required>
        </div>

        <div class="mb-3">
          <label for="Descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="Descripcion" name="Descripcion" rows="3" required></textarea>
        </div>
       
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="cerrarModalAccion()">Aceptar</button>
      </div>
    </div>
  </div>
</div>