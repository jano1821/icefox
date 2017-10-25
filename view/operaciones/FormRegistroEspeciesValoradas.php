<?php

class FormRegistroEspeciesValoradas {

    public function mostrarFormRegistroEspeciesValoradas($arrayEspecieValorada,
            $arrayLotes,
            $arrayProveedores,
            $arrayClase) {
        ?>
        <!DOCTYPE html>
        <html >
            <head>
                <meta charset="UTF-8">
                <title>Registro de Especies Valoradas</title>
                <script src="../../js/modernizr.js" type="text/javascript"></script>
                <script src="../../js/envioFormulario.js" type="text/javascript"></script>
                <script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
                <link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>
                <link rel="stylesheet" href="../../css/styleForm.css">
            </head>
            <body onload="load();">
                <div class="container">
                    <form class="well form-horizontal" action="../../view/operaciones/GetEnvioEspeciesValoradas.php" method="post"  name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorForm" id="validatorForm">
                        <fieldset>
                            <!-- Form Name -->
                            <?php
                            if (count($arrayEspecieValorada) == 0) {
                                ?>
                                <legend align="center">Registrar Nueva Especie Valorada</legend>
                                <?php
                            } else {
                                ?>
                                <legend align="center">Actualizar Especie Valorada</legend>
            <?php
        }
        ?>
                            <div class="form-group" <?php if (count($arrayEspecieValorada) > 0) {
            echo "style='display:none;'";
        } ?> >
                                <label class="col-md-4 control-label">Método de ingreso</label>
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
                            <input type="hidden" name="codigo" id="codigo" <?php if (count($arrayEspecieValorada) > 0) { ?> value="<?php echo $arrayEspecieValorada[0][0]; ?>"<?php } ?>>
                            <!-- descripcion Lote-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Número Certificado</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="numero" id="numero" placeholder="Número de Certificado" class="form-control" type="text" <?php if (count($arrayEspecieValorada) > 0) { ?> value="<?php echo $arrayEspecieValorada[0][1]; ?>"<?php } ?> >
                                        <div class="input-group" id="oculto" style='display:none;'>
                                            <input  name="cantidad" id="cantidad" placeholder="Cantidad" class="form-control" type="text" >
                                        </div>
                                        <div class="input-group" id="poliza" style='display:none;'>
                                            <input  name="poliza" id="poliza" placeholder="Numero de Póliza" class="form-control" type="text" <?php if (count($arrayEspecieValorada) > 0) { ?> value="<?php echo $arrayEspecieValorada[0][6]; ?>"<?php } ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- fecha de vencimiento-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Lote</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="lote" id="lote" class="form-control selectpicker" >
                                            <option value="" >Selecciona Lote</option>
                                            <?php
                                            for ($i = 0; $i < count($arrayLotes); $i++) {
                                                ?>
                                                <option value="<?php echo $arrayLotes[$i][0]; ?>" <?php if (count($arrayEspecieValorada) > 0) {
                                                    if ($arrayLotes[$i][0] == $arrayEspecieValorada[0][3]) {
                                                        echo 'selected';
                                                    }
                                                } ?> ><?php echo $arrayLotes[$i][1]; ?></option>
            <?php
        }
        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- tipo de especie valorada-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class="form-control" id="tipo" name="tipo" onChange="mostrarOcultarNumeroPoliza(this.value);">
                                            <option value="">Selecciona</option>
                                            <option value="W" <?php if (count($arrayEspecieValorada) > 0) {
            if ($arrayEspecieValorada[0][2] == 'W') {
                echo 'selected';
            }
        } ?>>Web</option>
                                            <option value="M" <?php if (count($arrayEspecieValorada) > 0) {
                                        if ($arrayEspecieValorada[0][2] == 'M') {
                                            echo 'selected';
                                        }
                                    } ?>>Manual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- clase de especie valorada-->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Clase</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class="form-control" id="clase" name="clase" >
                                            <option value="">Selecciona Clase </option>
                                            <?php
                                            for ($i=0;$i<count($arrayClase);$i++){
                                            ?>    
                                                <option value="<?php echo $arrayClase[$i][0];?>" <?php if (count($arrayEspecieValorada) > 0) {
                                                    if ($arrayEspecieValorada[0][11] == $arrayClase[$i][0]) {
                                                        echo 'selected';
                                                    }
                                                } ?> ><?php echo $arrayClase[$i][1];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Proveedor</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class='form-control' id='proveedor' name='proveedor'>
                                            <option value="">Selecciona</option>
                                    <?php
                                    for ($i = 0; $i < count($arrayProveedores); $i++) {
                                        ?>
                                                <option value="<?php echo $arrayProveedores[$i][0]; ?>" <?php if (count($arrayEspecieValorada) > 0) {
                                if ($arrayProveedores[$i][0] == $arrayEspecieValorada[0][4]) {
                                    echo 'selected';
                                }
                            } ?> ><?php echo $arrayProveedores[$i][4]; ?></option>
            <?php
        }
        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Success message -->
                            <div class="alert alert-success" role="alert" id="success_message">Correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por ponerse en contacto con nosotros, nos pondremos en contacto con usted en breve.</div>
                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-warning" onclick="<?php
        if (count($arrayEspecieValorada) == 0) {
            echo "envioDatosFormulario('N')";
        } else {
            echo "envioDatosFormulario('M')";
        }
        ?>">Registrar <span class="glyphicon glyphicon-send"></span></button>
                                    <button type="submit" class="btn btn-warning" onclick="volver();">Volver <span class="glyphicon glyphicon-send"></span></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </body>
            <script src='../../js/jquery.min.form.js'></script>
            <script src='../../js/bootstrap.min.js'></script>
            <script src='../../js/bootstrapvalidator.min.js'></script>
            <script src="../../js/indexForm.js"></script>
            <script type="text/javascript">
                                            function load() {
                                                var valor;
        <?php if (count($arrayEspecieValorada) > 0) { ?>
                                                    valor = "<?php echo $arrayEspecieValorada[0][2]; ?>"
                                                    mostrarOcultarNumeroPoliza(valor);
        <?php } ?>
                                            }
                                            function mostrarOcultarNumeroPoliza(valor) {
                                                if (valor == 'M') {
                                                    document.getElementById('poliza').style.display = 'none';
                                                } else {
                                                    document.getElementById('poliza').style.display = 'block';
                                                }
                                            }

                                            function mostrarOcultarcantidad(valor) {
                                                if (valor == 'I') {
                                                    document.getElementById('oculto').style.display = 'none';
                                                } else {
                                                    document.getElementById('oculto').style.display = 'block';
                                                }
                                            }
            </script>
        </html>
        <?php
    }

}
?>