<?php
class TablaMantenimientoPerfiles {

    public function mostrarTablaMantenimientoPerfiles($htmlTabla) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Perfiles</title>
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
                    <h1 class="titulo" align="center">Lista de Perfiles Registrados en el Sistema</h1>
                    <form action="../../view/mantenimientos/GetEnvioMantenimientoPerfiles.php" method="POST" name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorTable" id="validatorTable">

                        <div class="buttonwrapper">
                            <a class="ovalbutton" href="javascript:volverMenu();"><span>Volver al Menu</span></a>
                            <a class="ovalbutton" href="javascript:envioFormulario('');"><span>Nuevo Perfil</span></a>
                        </div>

                        <br>
                        <div id="content">
                            <?php
                            echo $htmlTabla;
                            ?>
                        </div>
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