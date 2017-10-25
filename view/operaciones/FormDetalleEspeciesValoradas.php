<?php

class FormDetalleEspeciesValoradas {

    public function mostrarFormDetalleEspeciesValoradas($especies,
            $htmlTabla,
            $numeroCertificado,
            $pagina,
            $cantPaginas,
            $resultadoCarga) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Especies Valoradas</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
                <script type="text/javascript" src="../../js/functions.js"></script>
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../css/screen.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleGrilla.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />

            </head>

            <body onload="load();">

                <div id ="block"></div>
                <div class="container">
                    <h1 class="titulo" align="center">Lista de Especies Valoradas Registrados en el Sistema</h1>
                    <form action="../../view/operaciones/GetDetalleDeposito.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorTable" id="validatorTable">
                        <input type="hidden" name="direccion" id="direccion">
        <?php
        for ($i = 0; $i < count($especies); $i++) {
            echo "<input type='hidden' name='especies[]' id='especies' value='" . $especies[$i] . "'>";
        }
        ?>
                        <br>
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        <label>Numero de Certificado</label>
                                        <div >
                                            <input  name="numeroCertificado" placeholder="Número de Certificado" type="text" size="20" value="<?php echo $numeroCertificado; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <div>
                            <a class="ovalbutton" href="javascript:enviarTodos();"><span>Enviar Seleccionados</span></a>
                            <br>
                        </div>

                        <div id="content">

        <?php
        echo $htmlTabla;
        ?>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        Página
                                        <input type="text" name="pagina" id="pagina" size="2" maxlength="2" readonly value="<?php echo $pagina; ?>"> de <input type="text" name="totPagina" id="totPagina" size="2" maxlength="2" readonly value="<?php echo $cantPaginas; ?>">
                                        <a class="ovalbutton" href="javascript:direccion('-1');"><span><</span></a>
                                        <a class="ovalbutton" href="javascript:direccion('1');"><span>></span></a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                    <form name ="formBusquedaPuntoVenta" id="formBusquedaPuntoVenta" method="post" action="../../view/generales/GetBusqueda.php" target="TheWindowChild">
                        <input  name="action" id="action" type="hidden" value="BUSQUEDA_PUNTO_VENTA">
                        <input  name="valor" id="valor" type="hidden" >
                    </form>
                </div>
            </body>
            <script type="text/javascript">
                var popupWindow;
                function load() {
                    var variableCarga = "<?php echo $resultadoCarga ?>";
                    if (variableCarga == "F") {
                        setTimeout(window.opener.cerrarChild(), 1000);
                    }
                }

                function enviarTodos() {
                    document.getElementById('validatorTable').value = 'T';
                    document.getElementById('formEnvio').submit();
                }
                function envioFormulario(codProducto, numeroCertificado) {
                    window.opener.agregarOption(codProducto, numeroCertificado);
                }

                function abrirBusquedaPuntoVenta() {
                    var f = document.getElementById('formBusquedaPuntoVenta');

                    document.getElementById('valor').value = document.getElementById('puntoVenta').value;

                    var window_width = 500;
                    var window_height = 350;
                    var newfeatures = 'scrollbars=no,resizable=no,menubar=no,location=no';
                    var window_top = (screen.height - window_height) / 2;
                    var window_left = (screen.width - window_width) / 2;
                    popupWindow = window.open("", "TheWindowChild", "_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
                    f.submit();
                }

                function insertarPuntoVenta(codigo, descripcion) {
                    document.getElementById('codigoPuntoVenta').value = codigo;
                    document.getElementById('puntoVenta').value = descripcion;

                    popupWindow.close();
                }
            </script>
        </html>
        <?php
    }

}
?>