<?php
class FormMantenimientoPerfiles{
	public function mostrarFormMantenimientoPerfiles($arrayPerfil){
?>
<!DOCTYPE html>
<html >
<head>
  	<meta charset="UTF-8">
  	<title>Mantenimiento de Perfiles</title>
  	<script src="../../js/modernizr.js" type="text/javascript"></script>
  	<script src="../../js/envioFormulario.js" type="text/javascript"></script>
	<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

    <link rel="stylesheet" href="../../css/styleForm.css">

</head>

<body>
  	<div class="container">

	    <form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoPerfiles.php" method="post"  name="formEnvio" id="formEnvio">
			<input type="hidden" name="validatorForm" id="validatorForm">

			<fieldset>

			<!-- Form Name -->
			<?php
			if (count($arrayPerfil)==0){
			?>
			<legend align="center">Registrar Nuevo Perfil</legend>
			<?php
			}else{
			?>
			<legend align="center">Actualizar Perfil</legend>
			<?php
			}
			?>

			<input type="hidden" name="codigo" id="codigo" <?php if (count($arrayPerfil)>0){ ?> value="<?php echo $arrayPerfil[0][0];?>"<?php }?>>
			<!-- descripcion perfil-->
			<div class="form-group">
			  <label class="col-md-4 control-label">Perfil</label>
			  <div class="col-md-4 inputGroupContainer">
			  	<div class="input-group">
			  		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			  		<input  name="perfil" placeholder="Perfil" class="form-control" type="text" <?php if (count($arrayPerfil)>0){ ?> value="<?php echo $arrayPerfil[0][1];?>"<?php }?> >
			    </div>
			  </div>
			</div>

			<!-- estado del perfil-->

			<div class="form-group">
			  <label class="col-md-4 control-label">Estado del Perfil</label>
			    <div class="col-md-4 selectContainer">
			    <div class="input-group">
			        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
			    <select name="estadoPerfil" class="form-control selectpicker" >
			      <option value="" >Selecciona un Estado</option>
			      <option value="S" <?php if (count($arrayPerfil)>0 && $arrayPerfil[0][2]=='S'){ ?> selected <?php }?> >Vigente</option>
			      <option value="N" <?php if (count($arrayPerfil)>0 && $arrayPerfil[0][2]=='N'){ ?> selected <?php }?> >No Vigente</option>
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
			if (count($arrayPerfil)==0){
			echo "envioDatosFormulario('N')";
			}else{
			echo "envioDatosFormulario('M')";
			}
			?>">Registrar <span class="glyphicon glyphicon-send"></span></button>

			<button type="submit" class="btn btn-warning" onclick="volver();">Volver <span class="glyphicon glyphicon-send"></span></button>

			  </div>
			</div>

			</fieldset>
		</form>
	</div>
  	<script src='../../js/jquery.min.form.js'></script>
	<script src='../../js/bootstrap.min.js'></script>
	<script src='../../js/bootstrapvalidator.min.js'></script>
    <script src="../../js/indexForm.js"></script>
</body>
</html>

<?php
	}
}
?>