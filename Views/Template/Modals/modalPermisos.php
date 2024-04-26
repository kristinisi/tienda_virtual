<!-- Modal para mostrar los permisos -->
<div class="modal fade modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Permisos Roles de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                // dep($data);
                ?>
                <div class="col-md-12">
                    <div class="tile">
                        <form action="" id="formPermisos" name="formPermisos">
                            <!-- Almacenamos el id del rol que queremos darle permisos por el medio del valor que vamos a tener en el data de la fila de abajo -->
                            <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?> " required>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Módulo</th>
                                            <th>Ver</th>
                                            <th>Crear </th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $modulos = $data["modulos"]; //guardamos en la variable todos los modulos
                                        for ($i = 0; $i < count($modulos); $i++) { //recorremos los modulos
                                            $permisos = $modulos[$i]["permisos"]; //extraemos los permisos
                                            $rCheck = $permisos["r"] == 1 ? " checked " : "";
                                            $wCheck = $permisos["w"] == 1 ? " checked " : "";
                                            $uCheck = $permisos["u"] == 1 ? " checked " : "";
                                            $dCheck = $permisos["d"] == 1 ? " checked " : "";

                                            $idmod = $modulos[$i]["idmodulo"];

                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                    <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                                                </td>
                                                <td>
                                                    <?= $modulos[$i]['titulo']; ?>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <!-- [r] hace referencia a que va a ser un array al momento de enviarlo para almacenar los datos -->
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php
                                            $no++;
                                        } //cerramos la llave del for para que todos los datos en la tabla hayan cogido los valores indicados
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-check"></i> Guardar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Salir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>