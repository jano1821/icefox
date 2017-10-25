<?php
class TablaDepositos {

    public function mostrarTablaDepositos($htmlTabla,
                            $arrayEmpleados,
                            $arrayPuntoVenta,
                            $serie,
                            $numero,
                            $empleado,
                            $puntoVenta,
                            $pagina,
                            $cantPaginas) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Depositos</title>
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
                    <h1 class="titulo" align="center">Lista de Hojas de Deposito</h1>
                    <form action="../../view/operaciones/GetDepositos.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorTable" id="validatorTable">
                        <input type="hidden" name="direccion" id="direccion">

                        <div class="buttonwrapper">
                            <a class="ovalbutton" href="javascript:volverMenu();"><span>Volver al Menu</span></a>
                            <a class="ovalbutton" href="javascript:envioFormulario('');"><span>Nuevo Deposito</span></a>
                        </div>
                        <br>
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        <label>Serie</label>
                                        <div >
                                            <input  name="serie" placeholder="Serie" type="text" size="20" value="<?php echo $serie; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <label>Numero de Hoja de Deposito</label>
                                        <div >
                                            <input  name="numero" placeholder="Numero" type="text" size="20" value="<?php echo $numero; ?>">
                                        </div>
                                    </th>
                                    <th>
                                        <label>Gestor de Campo</label>
                                        <div class="input-group">
                                            <select name="empleado" id="empleado">
                                                <option value="" >Selecciona Gestor</option>
        <?php
        for ($i = 0; $i < count($arrayEmpleados); $i++) {
            ?>
                                                    <option value="<?php echo $arrayEmpleados[$i][0]; ?>" <?php if ($empleado == $arrayEmpleados[$i][0]) {
                echo 'selected';
            } ?> ><?php echo $arrayEmpleados[$i][4]; ?></option>
            <?php
        }
        ?>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <label>Punto de Venta</label>
                                        <div class="input-group">
                                            <select name="puntoVenta" id="puntoVenta">
                                                <option value="" >Selecciona Punto de Venta</option>
        <?php
        for ($i = 0; $i < count($arrayPuntoVenta); $i++) {
            ?>
                                                    <option value="<?php echo $arrayPuntoVenta[$i][0]; ?>" <?php if ($puntoVenta == $arrayPuntoVenta[$i][0]) {
                echo 'selected';
            } ?> ><?php echo $arrayPuntoVenta[$i][4]; ?></option>
            <?php
        }
        ?>
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

                    </form>
                </div>
            </body>
        </html>
        <?php
    }
}
?>