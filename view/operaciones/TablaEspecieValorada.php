<?php
class TablaEspecieValorada {

    public function mostrarTablaEspecieValorada($htmlTabla,
                            $arrayProveedores,
                            $numeroCertificado,
                            $lote,
                            $tipo,
                            $proveedor,
                            $estadoRegistro,
                            $pagina,
                            $cantPaginas) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Especies Valoradas</title>
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
                <script type="text/javascript" src="../../js/functions.js"></script>
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../css/screen.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleGrilla.css" />
                <link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />

            </head>

            <body>

                <div id ="block"></div>
                <div class="container">
                    <h1 class="titulo" align="center">Lista de Especies Valoradas Registrados en el Sistema</h1>
                    <form action="../../view/operaciones/GetEnvioEspeciesValoradas.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorTable" id="validatorTable">
                        <input type="hidden" name="direccion" id="direccion">

                        <div class="buttonwrapper">
                            <a class="ovalbutton" href="javascript:volverMenu();"><span>Volver al Menu</span></a>
                            <a class="ovalbutton" href="javascript:envioFormulario('');"><span>Nueva Especie Valorada</span></a>
                        </div>
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
                                        <label>Lote</label>
                                        <div >
                                            <input  name="lote" placeholder="Lote" type="text" size="20" value="<?php echo $lote; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <label>Tipo Especie Valorada</label>
                                        <div class="input-group">
                                            <select name="tipo">
                                                <option value="" >Selecciona Tipo de EV</option>
                                                <option value="W" <?php if ($tipo == 'W') {
            echo 'selected';
        } ?> >Web</option>
                                                <option value="M" <?php if ($tipo == 'M') {
            echo 'selected';
        } ?> >Manual</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label>Proveedor</label>
                                        <div >
                                            <div class="input-group">
                                                <select name="proveedor" id="proveedor">
                                                    <option value="" >Selecciona Proveedor</option>
        <?php
        for ($i = 0; $i < count($arrayProveedores); $i++) {
            ?>
                                                        <option value="<?php echo $arrayProveedores[$i][0]; ?>" <?php if ($proveedor == $arrayProveedores[$i][0]) {
                echo 'selected';
            } ?> ><?php echo $arrayProveedores[$i][4]; ?></option>
            <?php
        }
        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </th>
                                    <th>
                                        <label>Estado</label>
                                        <div class="input-group">
                                            <select name="estadoRegistro">
                                                <option value="" >Selecciona Estado de EV</option>
                                                <option value="S" <?php if ($estadoRegistro == 'S') {
            echo 'selected';
        } ?> >Vigente</option>
                                                <option value="N" <?php if ($estadoRegistro == 'N') {
                        echo 'selected';
                    } ?> >No Vigente</option>
                                                <option value="V" <?php if ($estadoRegistro == 'V') {
                        echo 'selected';
                    } ?> >Vencido</option>
                                                <option value="R" <?php if ($estadoRegistro == 'R') {
                        echo 'selected';
                    } ?> >Recogido</option>
                                                <option value="O" <?php if ($estadoRegistro == 'O') {
                        echo 'selected';
                    } ?> >Devuelto</option>
                                                <option value="A" <?php if ($estadoRegistro == 'A') {
                        echo 'selected';
                    } ?> >Anulado</option>
                                            </select>
                                        </div>
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

                    </form>
                </div>
        <?php
        include('../generales/FooterFechaHora.php');
        ?>
            </body>
        </html>
        <?php
    }
}
?>