<?php

class BusquedaCNTR {

    public function mostrarBusquedaCNTR($comboBusqueda, $codCombo, $valor, $action) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Busqueda</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
                <script type="text/javascript" src="../../js/functions.js"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>

                <link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />
                <link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>

            </head>

            <body onload="onLoadTabla();">

                <div id ="block"></div>
                <div class="container">
                    <h1 class="titulo" align="center">Búsqueda</h1>

                    <form action="../../view/generales/GetBusqueda.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorForm" id="validatorForm">
                        <input type="hidden" name="direccion" id="direccion">
                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">

                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        <div class="input-group">
                                            <select name="tipo" id="tipo" class="form-control selectpicker">
                                                <?php
                                                for ($i = 0; $i < count($comboBusqueda); $i++) {
                                                    ?>
                                                    <option value="<?php echo $comboBusqueda[$i][0]; ?>" <?php if ($comboBusqueda[$i][0] == $codCombo) {
                                            echo 'selected';
                                        } ?> ><?php echo $comboBusqueda[$i][1]; ?></option>
            <?php
        }
        ?>
                                            </select>
                                        </div>
                                    </th>

                                    <th>
                                        <div >
                                            <input  name="valor" id="valor" placeholder="Introduzca Valor de Búsqueda" type="text" size="20" class="form-control" value="<?php echo $valor; ?>">
                                        </div>
                                    </th>

                                    <th>
                                        <a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div id="content">
                            <iframe height="200px" width="480px" id="my_frame" name="my_frame" frameborder="0">

                            </iframe>
                        </div>
                    </form>
                    <form name="formOpcion" id="formOpcion" method="POST" target="my_frame" action="../../view/generales/GetBusqueda.php">
                        <input type="hidden" name="actionTable" id="actionTable"  value="<?php echo $action; ?>">
                        <input type="hidden" name="valorOpcion" id="valorOpcion">
                    </form>
                </div>
            </body>
            <script type="text/javascript">
                function envioFormulario(codProducto, numeroCertificado) {
                    //window.opener.agregarOption(codProducto,numeroCertificado);
                }

                function direccion(direccion) {
                    var f = document.getElementById('formEnvio');
                    f.submit();
                }

                function buscar() {
                    var f = document.getElementById('formEnvio');
                    f.submit();
                }

                function onLoadTabla() {
                    var f = document.getElementById('formOpcion');

                    f.valorOpcion.value = document.getElementById("valor").value;

                    var url = '../../view/generales/GetBusqueda.php';
                    document.my_frame.location.replace(url);
                    f.submit();
                }

                function agregarAnterior(codigo, descripcion) {
                    var action = "<?php echo $action; ?>";
                    if (action == "BUSQUEDA_PUNTO_VENTA") {
                        window.opener.insertarPuntoVenta(codigo, descripcion);
                    }
                    if (action == "BUSQUEDA_PUNTO_VENTA_LIQUIDADOS") {
                        window.opener.insertarPuntoVenta(codigo, descripcion);
                    }
                    if (action == "BUSQUEDA_VEHICULOS") {
                        window.opener.insertarPuntoVenta(codigo, descripcion);
                    }
                    if (action == "BUSQUEDA_CLIENTES") {
                        window.opener.insertarCliente(codigo, descripcion);
                    }
                }
            </script>
        </html>
        <?php
    }

}
?>