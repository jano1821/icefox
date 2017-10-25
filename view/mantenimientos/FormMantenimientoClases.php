<?php
class FormMantenimientoClases{
	public function mostrarFormMantenimientoClases($arrayClases,$codigoPersona){
?>
<!DOCTYPE html>
<html >
<head>
  	<meta charset="UTF-8">
  	<title>Clases de Personas</title>
  	<script src="../../js/modernizr.js" type="text/javascript"></script>
  	<script src="../../js/envioFormulario.js" type="text/javascript"></script>
	<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

    <link rel="stylesheet" href="../../css/styleForm.css">

</head>

<body>
  	<div class="container">

	    <form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoClases.php" method="post"  name="formEnvio" id="formEnvio">
			<input type="hidden" name="validatorForm" id="validatorForm">
			<input type="hidden" name="exit" id="exit" value="N">
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigoPersona;?>" >

			<div class="form-group">
                <label class="col-md-4 control-label">Seleccionar Clase de Persona</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label>
                            <input type="checkbox" name="proveedor" id="proveedor" <?php if ($arrayClases[0][0]=='1'){echo 'checked';}?>> proveedor
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="checkbox" name="empleado" id="empleado" <?php if ($arrayClases[1][0]=='1'){echo 'checked';}?>> empleado
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="checkbox" name="cliente" id="cliente" <?php if ($arrayClases[2][0]=='1'){echo 'checked';}?>> cliente
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="checkbox" name="puntoVenta" id="puntoVenta" <?php if ($arrayClases[3][0]=='1'){echo 'checked';}?>> Punto de Venta
                        </label>
                    </div>
                </div>
            </div>

			<div class="form-group">
			  <label class="col-md-4 control-label"></label>
			  <div class="col-md-4">
			    <button type="submit" class="btn btn-warning" onclick="">Registrar <span class="glyphicon glyphicon-send"></span></button>

				<button type="submit" class="btn btn-warning" onclick="retornar();">Volver <span class="glyphicon glyphicon-send"></span></button>

			  </div>
			</div>

		</form>
	</div>
	<script src='../../js/jquery.min.form.js'></script>
	<script src='../../js/bootstrap.min.js'></script>
	<script src='../../js/bootstrapvalidator.min.js'></script>
    <script src="../../js/indexForm.js"></script>
    <script type="text/javascript">
    function retornar (){
    	document.getElementById('exit').value='S';
    }
    </script>


</body>
</html>

<?php
	}
}
?>