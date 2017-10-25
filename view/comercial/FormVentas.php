<?php
class FormVentas {

    public function mostrarFormVentas() {
        ?>
        <!DOCTYPE html>
        <!-- FormVentas.php -->
        <div class="modal fade" id="venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registrar Venta</h4>
                    </div>

                    <form class="form-horizontal" method="post" id="guardar_venta" name="guardar_venta">
                        <div class="modal-body">
                            <input type="hidden" id="codigoVenta" name="codigoVenta">
                            <input type="hidden" id="codigoLiquidacion" name="codigoLiquidacion">
                            <input type="hidden" id="codigoProducto" name="codigoProducto">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Fecha Venta</label>
                                <div class="col-sm-8">
                                    <div class="controls input-append date form_date" data-date-end-date="0d" data-date-format="dd/mm/yyyy" data-link-field="dtp_input1">
                                        <input name="fechaVenta" type="text" class="form-control" value="" placeholder="Fecha de Venta" readonly required="">
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" /><br/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Desde</label>
                                <div class="col-sm-8">
                                    <div class="controls input-append date form_date" data-date-end-date="0d" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2">
                                        <input name="fechaDesde" type="text" class="form-control" value="" placeholder="Fecha de Vigencia Desde" readonly required="" onchange="calcularDias(this.value);">
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input2" value="" /><br/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Hasta</label>
                                <div class="col-sm-8">
                                    <div class="controls input-append date form_date" data-date-end-date="0d" data-date-format="dd/mm/yyyy" data-link-field="dtp_input3">
                                        <input name="fechaHasta" type="text" class="form-control" value="" placeholder="Fecha de Vigencia Hasta" readonly required="">
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input3" value="" /><br/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Hora</label>
                                <div class="col-sm-8">
                                    <div class="controls input-append date form_time" data-date-end-date="0d" data-date-format="hh:ii" data-link-field="dtp_input4">
                                        <input name="hora" type="text" class="form-control" value="" placeholder="Hora" readonly required="">
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input4" value="" /><br/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Cliente</label>
                                <div class="col-sm-8">
                                    <div class='input-group search'>
                                        <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre de Cliente" maxlength="50" required readonly='true'>
                                        <input type="text" class="form-control" id="nroDocumento" name="nroDocumento" placeholder="N° Doc" maxlength="11" required>
                                        <span class="input-group-addon">
                                            <a href="#" onClick="abrirBusquedaCliente();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>

                                        </span>

                                        <input class="form-control" name="codigoCliente" id="codigoCliente" type="hidden" value="">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Vehiculo</label>
                                <div class="col-sm-8">
                                    <div class='input-group search'>
                                        <input type="text" class="form-control" id="vehiculo" name="vehiculo" placeholder="Placa del Vehiculo" maxlength="6" required>
                                        <span class="input-group-addon">
                                            <a href="#" onClick="abrirBusquedaVehiculo();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
                                        </span>
                                        <input class="form-control" name="codigoVehiculo" id="codigoVehiculo" type="hidden" value="">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Comprobante</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Comprobante" required maxlength="50">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Comision</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="comision" name="comision" placeholder="Comision" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="5" onFocus="this.select();" onBlur="this.value=redondearFormato(this.value,2);">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Monto de Venta</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="montoVenta" name="montoVenta" placeholder="Monto de Venta" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="6" onFocus="this.select();" onBlur="this.value=redondearFormato(this.value,2);">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        function calcularDias(fechaInicial) {
                            var cantidadDias = 365;
                            if (esFecha(fechaInicial)){
                                document.guardar_venta.fechaHasta.value = _sumarRestarDias(parseDate(fechaInicial), parseInt(cantidadDias));
                            }
                        }
                        
                        function guardarVenta(){
                            var confirmacion = confirm("¿Está Seguro de Registrar esta Venta?");
                                    if (confirmacion == true) {

                                        var params = "?validatorForm=N";
                                        params += "&codigoVenta=" + document.guardar_venta.codigoVenta.value;
                                        params += "&fechaVenta=" + document.guardar_venta.fechaVenta.value;
                                        params += "&fechaDesde=" + document.guardar_venta.fechaDesde.value;
                                        params += "&fechaHasta=" + document.guardar_venta.fechaHasta.value;
                                        params += "&hora=" + document.guardar_venta.hora.value;
                                        params += "&codigoCliente=" + document.guardar_venta.codigoCliente.value;
                                        params += "&codigoVehiculo=" + document.guardar_venta.codigoVehiculo.value;
                                        params += "&comprobante=" + document.guardar_venta.comprobante.value;
                                        params += "&comision=" + document.guardar_venta.comision.value;
                                        params += "&codigoProducto=" + document.guardar_venta.codigoProducto.value;

                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function () {
                                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                var myObj = JSON.parse(xmlhttp.responseText);
                                                if (myObj[0] == '0') {
                                                    alert("Hubo una Dificultad al Registrar la Venta, Comuníquese con Sistemas e Inténtelo mas Tarde");
                                                } else {
                                                    alert("Se Registró Venta Existosamente!");
                                                    $('#venta').modal('hide');
                                                }
                                            }
                                        };

                                        xmlhttp.open("GET", "../../view/mantenimientos/GetVentas.php" + params, false);
                                        xmlhttp.send();
                                    }
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php
    }
}
?>