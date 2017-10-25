<?php
class TablaLoteRegistro {

    public function mostrarTablaLoteRegistro($htmlTabla,
                            $pagina,
                            $cantPaginas) {
        ?>
        <!DOCTYPE html>
        <html >

            <head>
                <title>Lista de Lotes</title>
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel=icon href='../../images/images.png' sizes="32x32" type="image/png">

                <script src="../../js/jquery-3.2.1.min.js" type="text/javascript"></script>

                <link rel="stylesheet" type="text/css" href="../../css/custom.css">
                <script type="text/javascript" src="../../js/envioFormulario.js"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>

                <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css" >
                <script src="../../js/jquery.min.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="../../css/bootstrap-datepicker.min.css" >
                <script src="../../js/bootstrap.min.js" type="text/javascript"></script>


            </head>

            <body>
                <div class="container">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <label><h3>Lista de Lotes Registrados en el Sistema</h3></label>
                            <form action="../../view/operaciones/GetEnvioLoteRegistro.php" method="POST" name="formEnvio" id="formEnvio">
                                <input type="hidden" name="validatorTable" id="validatorTable">
                                <input type="hidden" name="direccion" id="direccion">
                                <input type="hidden" name="codigoLoteReg" id="codigoLoteReg">
                                <div class="form-group row">
                                    <div class="panel-heading">
                                        <div class="btn-group pull-left">
                                            <button type="button" class="btn btn-default" onclick='javascript:volverMenu();'>
                                                <span ></span> Volver al Menu</button>
                                        </div>

                                        <div class="btn-group pull-left">
                                            <button type='button' class="btn btn-info" onclick='javascript:envioFormulario("");'>
                                                <span ></span> Nuevo Lote</button>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <?php
                                    echo $htmlTabla;
                                    ?>
                                    <tr>
                                    <input type="hidden" name="pagina" id="pagina" size="2" maxlength="2" readonly value="<?php echo $pagina; ?>">
                                    <input type="hidden" name="totPagina" id="totPagina" size="2" maxlength="2" readonly value="<?php echo $cantPaginas; ?>">
                                    <td colspan=6><span class="pull-right">
                                            <?php
                                            include('../../utility/Footer.php');
                                            echo paginacion($pagina,
                                                                    $cantPaginas);
                                            ?>

                                        </span></td>
                                    </tr>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </body>
            <script type="text/javascript">
                function cerrar(codLote) {
                    var confirmacion = confirm("¿Está Seguro de Cerrar este Lote?");
                    if (confirmacion == true) {
                        document.formEnvio.validatorTable.value = "C";
                        document.formEnvio.codigoLoteReg.value = codLote;
                        document.formEnvio.submit();
                    }
                }
            </script>
        </html>

        <?php
    }
}
?>