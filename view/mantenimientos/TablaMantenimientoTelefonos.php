<?php
class TablaMantenimientoTelefonos {

    public function mostrarTablaMantenimientoTelefonos($htmlTabla,
                            $codigoPersona) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista Telefonos</title>
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
                    <h1 class="titulo" align="center">Lista de Telefonos</h1>
                    <form action="../../view/mantenimientos/GetEnvioMantenimientoTelefonos.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="exit" id="exit" value="N">
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigoPersona; ?>">
                        <input type="hidden" name="validatorTable" id="validatorTable" >
                        <div class="buttonwrapper">
                            <a class="ovalbutton" href="javascript:retornar();"><span>Volver</span></a>
                            <a class="ovalbutton" href="javascript:envioFormulario('');"><span>Nuevo Telefono</span></a>
                        </div>

                        <br>
                        <div id="content">
                            <?php
                            echo $htmlTabla;
                            ?>
                        </div>
                </div>
            </form>
            <script type="text/javascript">
                function retornar() {
                    document.getElementById('exit').value = 'S';
                    document.formEnvio.submit();
                }


            </script>
        </body>
        <?php
        include('../generales/FooterFechaHora.php');
        ?>
        </html>
        <?php
    }
}
;
?>