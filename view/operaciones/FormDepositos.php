<?php

class FormDepositos {

    public function mostrarFormDepositos($arrayDepositoProducto,
            $arrayDeposito,
            $arrayEmpleados,
            $arrayPuntoVenta) {
        ?>
        <!DOCTYPE html>
        <html >
            <head>
                <meta charset="UTF-8">
                <title>Registro de Hojas de Deposito</title>
                <script src="../../js/modernizr.js" type="text/javascript"></script>
                <script src="../../js/envioFormulario.js" type="text/javascript"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
                <link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>
                <link rel="stylesheet" href="../../css/styleForm.css">
            </head>
            <body>
                <div class="container">
                    <form class="well form-horizontal" action="../../view/operaciones/GetDepositos.php" method="post"  name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorForm" id="validatorForm">
                        <fieldset>
                            <!-- Form Name -->
                            <?php
                            if (count($arrayDeposito) == 0) {
                                ?>
                                <legend align="center">Registrar Nueva Hoja de Deposito</legend>
                                <?php
                            } else {
                                ?>
                                <legend align="center">Actualizar Hoja de Deposito</legend>
            <?php
        }
        ?>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-warning" onclick="mostrarVentana();">Mostrar Especies Valoradas <span class="glyphicon glyphicon-send"></span></button>
                                </div>
                            </div>

                            <div class="form-group" <?php if (count($arrayDeposito) > 0) {
            echo "style='display:none;'";
        } ?> >
                                <label class="col-md-4 control-label">Método de Ingreso</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label>
                                            <input name='metodo' id='metodo' placeholder='Número' type='radio' value='I' checked="checked" onclick="mostrarOcultarcantidad(this.value)"> Individual
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name='metodo' id='metodo' placeholder='Número' type='radio' value='M' onclick="mostrarOcultarcantidad(this.value)"> Masivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- codigo Lote-->
                            <input type="hidden" name="codigo" id="codigo" <?php if (count($arrayDeposito) > 0) { ?> value="<?php echo $arrayDeposito[0][0]; ?>"<?php } ?>>
                            <!-- descripcion Lote-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Número de Serie</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="serie" id="serie" placeholder="Número de Serie de Hoja de Depósito" class="form-control" type="text" <?php if (count($arrayDeposito) > 0) { ?> value="<?php echo $arrayDeposito[0][1]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Número de Hoja de Depósito</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="numero" id="numero" placeholder="Número de Hoja de Depósito" class="form-control" type="text" <?php if (count($arrayDeposito) > 0) { ?> value="<?php echo $arrayDeposito[0][2]; ?>"<?php } ?> >
                                        <div class="input-group" id="oculto" style='display:none;'>
                                            <input  name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control" type="text" >
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Gestor de Campo</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="gestorCampo" id="gestorCampo" class="form-control selectpicker" >
                                            <option value="" >Selecciona gestor de Campo</option>
        <?php
        for ($i = 0; $i < count($arrayEmpleados); $i++) {
            ?>
                                                <option value="<?php echo $arrayEmpleados[$i][0]; ?>" <?php if (count($arrayDeposito) > 0) {
                if ($arrayEmpleados[$i][0] == $arrayDeposito[0][4]) {
                    echo 'selected';
                }
            } ?> ><?php echo $arrayEmpleados[$i][4]; ?></option>
            <?php
        }
        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- estado de registro-->

                            <div class="form-group">
                                <label class="col-md-4 control-label">Punto de Venta</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class='form-control' id='puntoVenta' name='puntoVenta'>
                                            <option value="">Selecciona Punto de Venta</option>
        <?php
        for ($i = 0; $i < count($arrayPuntoVenta); $i++) {
            ?>
                                                <option value="<?php echo $arrayPuntoVenta[$i][0]; ?>" <?php if (count($arrayDeposito) > 0) {
                if ($arrayPuntoVenta[$i][0] == $arrayDeposito[0][3]) {
                    echo 'selected';
                }
            } ?> ><?php echo $arrayPuntoVenta[$i][4]; ?></option>
            <?php
        }
        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- descripcion Lote-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Emisión</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="fecha" id="fecha" placeholder="DD/MM/YYYY" class="form-control" type="text" <?php if (count($arrayDeposito) > 0) { ?> value="<?php echo date_format(date_create($arrayDeposito[0][5]),
                    'd/m/Y'); ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Estado de Registro</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="estadoRegistro" id="estadoRegistro" class="form-control selectpicker" >
                                            <option value="" >Selecciona Estado de Registro</option>
                                            <option value="S" <?php if (count($arrayDeposito) > 0 && $arrayDeposito[0][6] == 'S') { ?> selected <?php } ?> >Vigente</option>
                                            <option value="N" <?php if (count($arrayDeposito) > 0 && $arrayDeposito[0][6] == 'N') { ?> selected <?php } ?> >No Vigente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Especies Valoradas</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <select multiple name="especiesValoradas[]" id="especiesValoradas" size="5" style="width: 250px;">
                                    <?php if (count($arrayDepositoProducto) > 0) {
                                        for ($i = 0; $i < count($arrayDepositoProducto); $i++) {
                                            ?>
                                                    <option value="<?php echo $arrayDepositoProducto[$i][0]; ?>"><?php echo $arrayDepositoProducto[$i][1]; ?></option>
                                        <?php }
                                    }
                                    ?>
                                        </select>
                                        <button type="button" class="btn btn-warning" onclick="quitarElementoSelect();">Quitar Elemento <span class="glyphicon glyphicon-send"></span></button>
                                    </div>
                                </div>
                            </div>
                            <!-- Success message -->
                            <div class="alert alert-success" role="alert" id="success_message">Correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por ponerse en contacto con nosotros, nos pondremos en contacto con usted en breve.</div>
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-warning" onclick="<?php
                            if (count($arrayDeposito) == 0) {
                                echo "seleccionarCamposSelect('N')";
                            } else {
                                echo "seleccionarCamposSelect('M')";
                            }
                            ?>">Registrar <span class="glyphicon glyphicon-send"></span></button>
                                    <button type="submit" class="btn btn-warning" onclick="volver();">Volver <span class="glyphicon glyphicon-send"></span></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form id="Form" method="post" action="../../view/operaciones/GetDetalleDeposito.php" target="TheWindow">
                        <input type="hidden" name="validatorTable" id="validatorTable">
                        <input type="hidden" name="especies[]" id="especies">
                    </form>
                </div>

            </body>
            <script src='../../js/jquery.min.form.js'></script>
            <script src='../../js/bootstrap.min.js'></script>
            <script src='../../js/bootstrapvalidator.min.js'></script>
            <script src="../../js/indexForm.js"></script>
            <script type="text/javascript">
                                                                        var popupWindow;

                                                                        function mostrarOcultarcantidad(valor) {
                                                                            if (valor == 'I') {
                                                                                document.getElementById('oculto').style.display = 'none';
                                                                            } else {
                                                                                document.getElementById('oculto').style.display = 'block';
                                                                            }
                                                                        }

                                                                        function validacionFormulario(tipo) {
                                                                            if (document.getElementById('serie').value == "") {
                                                                                alert("Debe ingresar numero de Serie");
                                                                                document.getElementById('serie').focus()
                                                                                return false;
                                                                            }

                                                                            if (document.getElementById('numero').value == "") {
                                                                                alert("Debe ingresar numero de Hoja de Deposito");
                                                                                document.getElementById('numero').focus()
                                                                                return false;
                                                                            }

                                                                            if (document.getElementById('gestorCampo').value == "") {
                                                                                alert("Debe Seleccionar Gestor de Campo");
                                                                                document.getElementById('gestorCampo').focus()
                                                                                return false;
                                                                            }

                                                                            if (document.getElementById('puntoVenta').value == "") {
                                                                                alert("Debe Seleccionar Punto de Venta");
                                                                                document.getElementById('puntoVenta').focus()
                                                                                return false;
                                                                            }

                                                                            if (document.getElementById('fecha').value == "") {
                                                                                alert("Debe ingresar Fecha de Emision de la Hoja de Deposito");
                                                                                document.getElementById('fecha').focus()
                                                                                return false;
                                                                            }

                                                                            if (!esFecha(document.getElementById('fecha').value)) {
                                                                                alert("Debe ingresar una Fecha Válida");
                                                                                document.getElementById('fecha').focus()
                                                                                return false;
                                                                            }

                                                                            if (document.getElementById('estadoRegistro').value == "") {
                                                                                alert("Debe Seleccionar Estado de Registro");
                                                                                document.getElementById('estadoRegistro').focus()
                                                                                return false;
                                                                            }

                                                                            envioDatosFormulario(tipo);
                                                                        }

                                                                        function mostrarVentana() {
                                                                            var f = document.getElementById('Form');

                                                                            var window_width = 1024;
                                                                            var window_height = 690;
                                                                            var newfeatures = 'scrollbars=no,resizable=no';
                                                                            var window_top = (screen.height - window_height) / 2;
                                                                            var window_left = (screen.width - window_width) / 2;
                                                                            popupWindow = window.open("", "TheWindow", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                                                                            f.submit();
                                                                        }

                                                                        function agregarOption(codProducto, numeroCertificado) {
                                                                            var select = document.getElementById("especiesValoradas");
                                                                            var option = document.createElement("option");

                                                                            option.text = numeroCertificado;
                                                                            option.value = codProducto;
                                                                            select.add(option, select[0]);

                                                                            var hidden = document.createElement("input");
                                                                            hidden.setAttribute("type", "hidden");
                                                                            hidden.setAttribute("name", "especies[]");
                                                                            hidden.setAttribute("id", "especies");
                                                                            hidden.setAttribute("value", numeroCertificado);
                                                                            document.getElementById("especies").appendChild(hidden);

                                                                            popupWindow.close();
                                                                        }

                                                                        function seleccionarCamposSelect(operacion) {
                                                                            var numvalores = document.getElementById("especiesValoradas").length;

                                                                            for (var i = 0; i < numvalores; i++) {
                                                                                document.getElementById("especiesValoradas")[i].selected = true;
                                                                            }

                                                                            validacionFormulario(operacion);
                                                                        }

                                                                        function quitarElementoSelect() {
                                                                            document.formEnvio.especiesValoradas.options[document.formEnvio.especiesValoradas.selectedIndex] = null;
                                                                        }
            </script>
        </html>
        <?php
    }

}
?>