<?php
class TablaMantenimientoPersona {

    public function mostrarTablaMantenimientoPersona($htmlTabla,
                            $nombre,
                            $numeroDocumento,
                            $estadoRegistro,
                            $tipo,
                            $clase,
                            $pagina,
                            $cantPaginas) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Personas</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
                <script type="text/javascript" src="../../js/functions.js"></script>
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <link rel="stylesheet" type="text/css" href="../../css/screen.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleGrilla.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />


            </head>

            <body>

                <div id ="block"></div>
                <div class="container">
                    <h1 class="titulo" align="center">Lista de Personas Registradas en el Sistema</h1>
                    <form action="../../view/mantenimientos/GetEnvioMantenimientoPersona.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorTable" id="validatorTable">
                        <input type="hidden" name="direccion" id="direccion">

                        <div class="buttonwrapper">
                            <a class="ovalbutton" href="javascript:volverMenu();"><span>Volver al Menu</span></a>
                            <a class="ovalbutton" href="javascript:envioFormulario('');"><span>Nueva Persona</span></a>
                        </div>
                        <br>
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        <label>Nombre</label>
                                        <div >
                                            <input  name="nombre" placeholder="Nombre" type="text" size="40" value="<?php echo $nombre; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <label>N° de Doc</label>
                                        <div >
                                            <input  name="numeroDocumento" placeholder="N° Doc" type="text" size="20" value="<?php echo $numeroDocumento; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <label>Estado de Registro</label>
                                        <div class="input-group">
                                            <select name="estadoRegistro">
                                                <option value="" >Selecciona un Estado</option>
                                                <option value="S" <?php if ($estadoRegistro == 'S') {
            echo 'selected';
        } ?> >Vigente</option>
                                                <option value="N" <?php if ($estadoRegistro == 'N') {
            echo 'selected';
        } ?> >No Vigente</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label>Tipo de Persona</label>
                                        <div class="input-group">
                                            <select name="tipo">
                                                <option value="" >Selecciona un Tipo</option>
                                                <option value="N" <?php if ($tipo == 'N') {
            echo 'selected';
        } ?> >Natural</option>
                                                <option value="J" <?php if ($tipo == 'J') {
            echo 'selected';
        } ?> >Juridica</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <label>Clase de Persona</label>
                                        <div class="input-group">
                                            <select name="clase">
                                                <option value="" >Selecciona Clase Persona</option>
                                                <option value="P" <?php if ($clase == 'P') {
            echo 'selected';
        } ?> >Proveedor</option>
                                                <option value="C" <?php if ($clase == 'C') {
                        echo 'selected';
                    } ?> >Punto de Venta</option>
                                                <option value="E" <?php if ($clase == 'E') {
                        echo 'selected';
                    } ?> >Empleado</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>

                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <br>
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
                </div>
            </form>
        </body>
        <?php
        include('../generales/FooterFechaHora.php');
        ?>
        </html>
        <?php
    }
}
?>