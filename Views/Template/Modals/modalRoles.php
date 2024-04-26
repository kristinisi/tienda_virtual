<!-- Modales -->
<!-- Modal del formulario para nuevo rol y editar rol -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="title">
                    <div class="title-body">
                        <form id="formRol" name="formRol" class="needs-validation" novalidate>
                            <input type="hidden" id="idRol" name="idRol" value="">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del rol" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese un nombre válido.
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripción</label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del rol" required></textarea>
                                <div class="invalid-feedback">
                                    Por favor, ingrese una descripción válida.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Estado</label>
                                <select class="form-control" id="listStatus" name="listStatus" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un estado.
                                </div>
                            </div>
                            <div class="title-footer">
                                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa-solid fa-check"></i><span id="btnText"> Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa-solid fa-x"></i> Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>