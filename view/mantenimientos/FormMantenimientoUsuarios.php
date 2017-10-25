<?php
class FormMantenimientoUsuarios{
	public function mostrarFormMantenimientoUsuarios($arrayUsuario,$arrayComboPerfiles){
?>
<!DOCTYPE html>
<html >
<head>
  	<meta charset="UTF-8">
  	<title>Mantenimiento de Usuarios</title>
  	<script src="../../js/modernizr.js" type="text/javascript"></script>
  	<script src="../../js/envioFormulario.js" type="text/javascript"></script>
	<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
	<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

    <link rel="stylesheet" href="../../css/styleForm.css">

</head>

<body>
  	<div class="container">

	    <form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoUsuarios.php" method="post"  name="formEnvio" id="formEnvio">
			<input type="hidden" name="validatorForm" id="validatorForm">

			<fieldset>

			<!-- Form Name -->
			<?php
			if (count($arrayUsuario)==0){
			?>
			<legend align="center">Registrar Nuevo Usuario</legend>
			<?php
			}else{
			?>
			<legend align="center">Actualizar Usuario</legend>
			<?php
			}
			?>
			<!-- usuario-->

			<div class="form-group">
			  <label class="col-md-4 control-label">Usuario</label>
			  <div class="col-md-4 inputGroupContainer">
			  	<div class="input-group">
			  		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			  		<input  name="usuario" placeholder="Usuario" class="form-control" type="text" <?php if (count($arrayUsuario)>0){ ?> value="<?php echo $arrayUsuario[0][0];?>"<?php }?> >
			    </div>
			  </div>
			</div>

			<!-- estado de bloqueo-->

			<div class="form-group">
			  <label class="col-md-4 control-label">Estado de BLoqueo</label>
			    <div class="col-md-4 selectContainer">
			    <div class="input-group">
			        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
			    <select name="estadoBloqueo" class="form-control selectpicker" >
			      <option value="" >Selecciona un Estado</option>
			      <option value="V" <?php if (count($arrayUsuario)>0 && $arrayUsuario[0][1]=='V'){ ?> selected <?php }?> >Vigente</option>
			      <option value="B" <?php if (count($arrayUsuario)>0 && $arrayUsuario[0][1]=='B'){ ?> selected <?php }?> >Bloqueado</option>
			    </select>
			  </div>
			</div>
			</div>

			<!-- cantidad de intentos-->
			<div class="form-group">
			  <label class="col-md-4 control-label">Cantidad de Intentos</label>
			    <div class="col-md-4 inputGroupContainer">
			    <div class="input-group">
			        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
			  <input name="intentos" placeholder="Cantidad de Intentos" class="form-control"  type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="1" <?php if (count($arrayUsuario)>0){ ?> value="<?php echo $arrayUsuario[0][2];}?>" >
			    </div>
			</div>
			</div>


			<!-- estado del usuario-->

			<div class="form-group">
			  <label class="col-md-4 control-label">Estado del Usuario</label>
			    <div class="col-md-4 selectContainer">
			    <div class="input-group">
			        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
			    <select name="estadoUsuario" class="form-control selectpicker" >
			      <option value="" >Selecciona un Estado</option>
			      <option value="S" <?php if (count($arrayUsuario)>0 && $arrayUsuario[0][3]=='S'){ ?> selected <?php }?> >Vigente</option>
			      <option value="N" <?php if (count($arrayUsuario)>0 && $arrayUsuario[0][3]=='N'){ ?> selected <?php }?> >No Vigente</option>
			    </select>
			  </div>
			</div>
			</div>

			<!-- perfil del usuario-->
			<div class="form-group">
			  <label class="col-md-4 control-label">Perfil del Usuario</label>
			    <div class="col-md-4 selectContainer">
			    <div class="input-group">
			        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
			    <select name="perfilUsuario" class="form-control selectpicker" >
			      <option value="" >Selecciona un Perfil</option>
			      	<?php
			      	for ($i=0;$i<count($arrayComboPerfiles);$i++){
			      	?>
			      		<option value="<?php echo $arrayComboPerfiles[$i][0];?>" <?php if (count($arrayUsuario)>0 && $arrayUsuario[0][4]==$arrayComboPerfiles[$i][0]){?> selected <?php };?> ><?php echo $arrayComboPerfiles[$i][1];?></option>
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
			if (count($arrayUsuario)==0){
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