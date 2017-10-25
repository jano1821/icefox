<?php
class FormMantenimientoVehiculo {

    /**
     * @autor anunez
     * @since si se llama a este metodo es por un acceso externo independiente de la tabla de listado de vehiculos
     * @param type $arrayVehiculo
     * @param type $arrayMarca
     * @param type $arrayClaseVehiculo,
     * @param type $indicadorAccesoExterno
     */
    public function mostrarFormMantenimientoVehiculo($arrayVehiculo,
                            $arrayMarca,
                            $arrayClaseVehiculo,
                            $indicadorAccesoExterno) {
        ?>
        <!DOCTYPE html>
        <!-- FormMantenimientoVehiculo.php -->
        <div class="modal fade" id="formNuevoVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                        if (count($arrayVehiculo) == 0) {
                            ?>
                            <h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i> Registrar Vehiculo</h4>
                            <?php
                        }else {
                            ?>
                            <h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i> Actualizar Vehiculo</h4>
                            <?php
                        }
                        ?>

                    </div>
                    <form class="form-horizontal" action="../../view/mantenimientos/GetEnvioVehiculo.php" method="post"  name="formEnvioVehiculo" id="formEnvioVehiculo">
                        <input type="hidden" name="validatorForm" id="validatorForm">

                        <input type="hidden" name="codigo" id="codigo" <?php if (count($arrayVehiculo) > 0) { ?> value="<?php echo $arrayVehiculo[0][0]; ?>"<?php } ?> >

                        <div class="form-group">
                            <label class="col-sm-3 control-label">N° de Asientos</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='nroAsientos' name='nroAsientos' placeholder="N° de Asientos" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">N° Serie Motor</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='nroSerieMotor' name='nroSerieMotor' placeholder="N° de Serie del Motor" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">N° de Ruedas</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='nroRuedas' name='nroRuedas' placeholder="N° de Ruedas" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">N° de Puertas</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='nroPuertas' name='nroPuertas' placeholder="N° de Puertas" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Uso del Vehiculo</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="usoVehiculo" name="usoVehiculo" required>
                                    <option value="">Selecciona Uso Vehiculo</option>
                                    <option value="P">Particular</option>
                                    <option value="U">Público</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Año Fabricación</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='anioFabricacion' name='anioFabricacion' placeholder="Año de Fabricacion" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Clase de Vehiculo</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="claseVehiculo" name="claseVehiculo" required>
                                    <option value="">Selecciona Clase Vehiculo</option>
                                    <?php
                                    for ($i = 0; $i < count($arrayClaseVehiculo); $i++) {
                                        $catalogoConstraintBean = $arrayClaseVehiculo[$i];
                                        ?>
                                        <option value="<?php echo $catalogoConstraintBean->getValor(); ?>" <?php if (count($arrayVehiculo) > 0 && $arrayVehiculo[0][5] == $catalogoConstraintBean->getValor()) { ?> selected <?php } ?> ><?php echo $catalogoConstraintBean->getDescripcion(); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">N° de Placa</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type='text' class="form-control" id='nroPlaca' name='nroPlaca' placeholder="Numero de Placa" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-compressed"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Marca</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="marcaVehiculo" name="marcaVehiculo" required onchange="obtenerModelos(this.value);">
                                    <option value="">Selecciona Marca Vehiculo</option>
                                    <?php
                                    for ($i = 0; $i < count($arrayMarca); $i++) {
                                        ?>
                                        <option value="<?php echo $arrayMarca[$i][0]; ?>" <?php if (count($arrayVehiculo) > 0 && $arrayVehiculo[0][5] == $arrayMarca[$i][0]) { ?> selected <?php } ?> ><?php echo $arrayMarca[$i][1]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="modeloVehiculo">
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Estado de Registro</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="estadoRegistro" name="estadoRegistro" required>
                                    <option value="">Selecciona Estado de Vehiculo</option>
                                    <option value="S" selected>Vigente</option>
                                    <option value="N">No Vigente</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <?php
                            if ($indicadorAccesoExterno != 'W') {
                                ?>
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="volver();">Cerrar</button>
                                <?php
                            }
                            ?>
                            <button type="button" class="btn btn-primary" id="guardar_datos" onclick="<?php
                                    if (count($arrayVehiculo) == 0) {
                                        if ($indicadorAccesoExterno == 'W') {
                                            echo "enviarFormularioVehiculo('W')"; //esto hara que al retornar no desvie el formulario a la tabla.
                                        }else {
                                            echo "enviarFormularioVehiculo('N')";
                                        }
                                    }else {
                                        echo "enviarFormularioVehiculo('M')";
                                    }
                                    ?>">Registrar</button>
                                    <?php
                                    if ($indicadorAccesoExterno == 'W') {
                                        ?>
                                <label>Se Tomará al Cliente Seleccionado en la Venta como Dueño del Vehiculo.</label>
                                <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
                                function obtenerModelos(codMarca) {
                                    var codigoSeleccion;
        <?php if (count($arrayVehiculo) > 0) { ?>
                                        codigoSeleccion = '<?php echo $arrayVehiculo[0][4]; ?>';
        <?php }else { ?>
                                        codigoSeleccion = '';
        <?php } ?>

                                    if (isEmpty(codMarca)) {
                                        return false;
                                    }

                                    if (window.XMLHttpRequest) {
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }

                                    xmlhttp.onreadystatechange = function () {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	//4=se recibieron todos los datos de la respuesta del servidor /
                                            //200=respuesta correcta
                                            document.getElementById("modeloVehiculo").innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    xmlhttp.open("GET", "../../view/mantenimientos/GetEnvioVehiculo.php?codMarca=" + codMarca + "&codigoSeleccion=" + codigoSeleccion, false);
                                    xmlhttp.send();
                                }

                                function enviarFormularioVehiculo() {
                                    var confirmacion = confirm("¿Está Seguro de Registrar este Vehiculo?");
                                    if (confirmacion == true) {

                                        var params = "?validatorForm=W";
                                        params += "&codigo=" + document.getElementById('codigo').value;
                                        params += "&nroAsientos=" + document.getElementById('nroAsientos').value;
                                        params += "&nroSerieMotor=" + document.getElementById('nroSerieMotor').value;
                                        params += "&nroRuedas=" + document.getElementById('nroRuedas').value;
                                        params += "&nroPuertas=" + document.getElementById('nroPuertas').value;
                                        params += "&usoVehiculo=" + document.getElementById('usoVehiculo').value;
                                        params += "&anioFabricacion=" + document.getElementById('anioFabricacion').value;
                                        params += "&claseVehiculo=" + document.getElementById('claseVehiculo').value;
                                        params += "&nroPlaca=" + document.getElementById('nroPlaca').value;
                                        params += "&modeloVehiculo=" + document.getElementById('modeloVehiculoCombo').value;
                                        params += "&persona=" + document.guardar_venta.codigoCliente.value;
                                        params += "&estadoRegistro=" + document.getElementById('estadoRegistro').value;

                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function () {
                                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                var myObj = JSON.parse(xmlhttp.responseText);
                                                if (myObj[0] == '0') {
                                                    alert("Hubo una Dificultad al Registrar el Vehículo, Comuníquese con Sistemas e Inténtelo mas Tarde");
                                                } else {
                                                    alert("Se Registró el Vehiculo Existosamente!");
                                                    $('#formNuevoVehiculo').modal('hide');
                                                    document.guardar_venta.vehiculo.value = document.getElementById('nroPlaca').value;
                                                }
                                            }
                                        };

                                        xmlhttp.open("GET", "../../view/mantenimientos/GetEnvioVehiculo.php" + params, false);
                                        xmlhttp.send();
                                    }
                                }
        </script>
        <?php
    }
}
;
?>