<?php

class FormMantenimientoPersona {

    /**
     * @autor anunez
     * @since si se llama a este metodo es por un acceso externo independiente de la tabla de listado de personas
     * @param type $arrayPersona
     * @param type $arrayTipoDocumento
     * @param type $indicadorAccesoExterno
     */
    public function mostrarFormMantenimientoPersona($arrayPersona, $arrayTipoDocumento) {
        $this->mostrarFormMantenimientoPersonaExterno($arrayPersona, $arrayTipoDocumento,'');
    }

    /**
     * @author anunez
     * @since si se llama a este metodo es porque viene de la tabla de listado de personas
     * @param type $arrayPersona
     * @param type $arrayTipoDocumento
     */
    public function mostrarFormMantenimientoPersonaExterno($arrayPersona, $arrayTipoDocumento, $indicadorAccesoExterno) {
        ?>
        <!DOCTYPE html>
        <html >
            <head>
                <meta charset="UTF-8">
                <title>Mantenimiento de Personas</title>
                <script src="../../js/modernizr.js" type="text/javascript"></script>
                <script src="../../js/envioFormulario.js" type="text/javascript"></script>
                <link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
                <link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

                <link rel="stylesheet" href="../../css/styleForm.css">

            </head>

            <body>
                <div class="container">

                    <form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoPersona.php" method="post"  name="formEnvio" id="formEnvio">
                        <input type="hidden" name="validatorForm" id="validatorForm">

                        <fieldset>

                            <!-- Form Name -->
                            <?php
                            if (count($arrayPersona) == 0) {
                                ?>
                                <legend align="center">Registrar Nueva Persona</legend>
                                <?php
                            } else {
                                ?>
                                <legend align="center">Actualizar Persona</legend>
                                <?php
                            }
                            ?>

                            <input type="hidden" name="codigo" id="codigo" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][0]; ?>"<?php } ?> >
                            <!-- datos de personas-->
                            <?php
                            if (count($arrayPersona) > 0) {
                                ?>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-warning" onclick="mostrarAdicional('D');">Direcciones <span class="glyphicon glyphicon-send"></span></button>
                                        <button type="submit" class="btn btn-warning" onclick="mostrarAdicional('T');">Telefonos <span class="glyphicon glyphicon-send"></span></button>
                                        <button type="submit" class="btn btn-warning" onclick="mostrarAdicional('C');">Clase <span class="glyphicon glyphicon-send"></span></button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombres</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="nombres" id="nombres" placeholder="Nombre Persona" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][3]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Apellido Paterno</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="apePat" id="apePat" placeholder="Apellido Paterno" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][1]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Apellido Materno</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="apeMat" id="apeMat" placeholder="Apellido Materno" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][2]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de Documento</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="TipoDocumento" id="TipoDocumento" class="form-control selectpicker" >
                                            <option value="" >Selecciona Tipo de Documento</option>
                                            <?php
                                            for ($i = 0; $i < count($arrayTipoDocumento); $i++) {
                                                ?>
                                                <option value="<?php echo $arrayTipoDocumento[$i][0]; ?>" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][10] == $arrayTipoDocumento[$i][0]) { ?> selected <?php } ?> > <?php echo $arrayTipoDocumento[$i][1]; ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Número de Documento</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="NumeroDocumento" id="NumeroDocumento" placeholder="Número de Documento" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][5]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de Persona</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="tipoPersona" id="tipoPersona" class="form-control selectpicker" onChange="mostrarOcultarRazonSocial(this.value);">
                                            <option value="" >Selecciona tipo de Persona</option>
                                            <option value="N" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][6] == 'N') { ?> selected <?php } ?> >Natural</option>
                                            <option value="J" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][6] == 'J') { ?> selected <?php } ?> >Jurídica</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="oculto" style='display:none;'>
                                <label class="col-md-4 control-label">Razón Social</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="razonSocial" id="razonSocial" placeholder="Razón Social" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo $arrayPersona[0][4]; ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sexo</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="sexo" id="sexo" class="form-control selectpicker" >
                                            <option value="" >Selecciona sexo</option>
                                            <option value="M" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][7] == 'M') { ?> selected <?php } ?> >Masculino</option>
                                            <option value="F" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][7] == 'F') { ?> selected <?php } ?> >Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Nacimiento</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  name="fecNac" id="fecNac" placeholder="DD/MM/YYYY" class="form-control" type="text" <?php if (count($arrayPersona) > 0) { ?> value="<?php echo date_format(date_create($arrayPersona[0][8]), 'd/m/Y'); ?>"<?php } ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Estado Civil</label>
                                <div class="col-md-4 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select name="estadoCivil" id="estadoCivil" class="form-control selectpicker" >
                                            <option value="" >Selecciona Estado civil</option>
                                            <option value="S" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][9] == 'S') { ?> selected <?php } ?> >Soltero</option>
                                            <option value="C" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][9] == 'C') { ?> selected <?php } ?> >Casado</option>
                                            <option value="D" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][9] == 'D') { ?> selected <?php } ?> >Divorciado</option>
                                            <option value="V" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][9] == 'V') { ?> selected <?php } ?> >Viudo</option>
                                            <option value="N" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][9] == 'N') { ?> selected <?php } ?> >Conviviente</option>
                                        </select>
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
                                            <option value="S" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][12] == 'S') { ?> selected <?php } ?> >Vigente</option>
                                            <option value="N" <?php if (count($arrayPersona) > 0 && $arrayPersona[0][12] == 'N') { ?> selected <?php } ?> >No Vigente</option>
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
                                    if (count($arrayPersona) == 0) {
                                        if ($indicadorAccesoExterno == 'W'){
                                            echo "envioDatosFormulario('W')";//esto hara que al retornar no desvie el formulario a la tabla.
                                        }else{
                                            echo "envioDatosFormulario('N')";
                                        }
                                    } else {
                                        echo "envioDatosFormulario('M')";
                                    }
                                    ?>">Registrar <span class="glyphicon glyphicon-send"></span></button>
                                    <?php
                                    if ($indicadorAccesoExterno != 'W'){
                                    ?><button type="submit" class="btn btn-warning" onclick="volver();">Volver <span class="glyphicon glyphicon-send"></span></button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <script src='../../js/jquery.min.form.js'></script>
                <script src='../../js/bootstrap.min.js'></script>
                <script src='../../js/bootstrapvalidator.min.js'></script>
                <script src="../../js/indexForm.js"></script>
                <script type="text/javascript">
                    function mostrarOcultarRazonSocial(valor) {
                        if (valor == 'N') {
                            document.getElementById('oculto').style.display = 'none';
                        } else {
                            document.getElementById('oculto').style.display = 'block';
                        }
                    }

                    function mostrarAdicional(valor) {
                        document.getElementById('validatorForm').value = valor;
                    }
                </script>
            </body>
        </html>
        <?php
    }

};
?>