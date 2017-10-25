<?php
class FormMantenimientoTelefonos{
	public function mostrarFormMantenimiento($codigoPersona,$arrayTelefonos,$arrayOperador){
		?>
		<!DOCTYPE html>
		<html >
		<head>
			<meta charset="UTF-8">
			<title>Mantenimiento de Telefonos</title>
			<script src="../../js/modernizr.js" type="text/javascript"></script>
			<script src="../../js/envioFormulario.js" type="text/javascript"></script>
			<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
			<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
			<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

			<link rel="stylesheet" href="../../css/styleForm.css">

		</head>

		<body>
			<div class="container">

				<form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoTelefonos.php" method="post"  name="formEnvio" id="formEnvio">
					<input type="hidden" name="validatorForm" id="validatorForm">
					<input type="hidden" name="exit" id="exit" value="N">
					<fieldset>
						<!-- Form Name -->
						<?php
						if (count($arrayTelefonos)==0){
							?>
							<legend align="center">Registrar Nuevo Telefono</legend>
							<?php
						}else{
							?>
							<legend align="center">Actualizar Telefono</legend>
							<?php
						}
						?>

						<input type="hidden" name="codigo" id="codigo" <?php if (count($arrayTelefonos)>0){ ?> value="<?php echo $arrayTelefonos[0][0];?>"<?php }else{ ?> value="<?php echo $codigoPersona;?> "<?php }?> />
						<input type="hidden" name="correlativo" id="correlativo" <?php if (count($arrayTelefonos)>0){ ?> value="<?php echo $arrayTelefonos[0][1];?>"<?php }?>>
						<!-- descripcion -->
						<div class="form-group">
							<label class="col-md-4 control-label">Numero de Telefono</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="numeroTelefono" id="numeroTelefono" placeholder="Numero de Telefono" class="form-control" type="text" <?php if (count($arrayTelefonos)>0){ ?> value="<?php echo $arrayTelefonos[0][2];?>"<?php }?> >
								</div>
							</div>
						</div>
						<!-- operador-->
						<div class="form-group">
							<label class="col-md-4 control-label">Operador</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="operador" id="operador" class="form-control selectpicker" >
										<option value="" >Selecciona Operador</option>
										<?php
										for ($i=0;$i<count($arrayOperador);$i++){
										?>
											<option value="<?php echo $arrayOperador[$i][0];?>" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][3]==$arrayOperador[$i][0]){ ?> selected <?php }?> ><?php echo $arrayOperador[$i][1];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<!-- estado de cierre-->
						<div class="form-group">
							<label class="col-md-4 control-label">Principal</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="principal" id="principal" class="form-control selectpicker" >
										<option value="" >Selecciona si es Principal</option>
										<option value="S" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][4]=='S'){ ?> selected <?php }?> >Principal</option>
										<option value="N" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][4]=='N'){ ?> selected <?php }?> >No Principal</option>
									</select>
								</div>
							</div>
						</div>
						<!-- estado de cierre-->
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Telefono</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="tipo" id="tipo" class="form-control selectpicker" >
										<option value="" >Selecciona un Tipo</option>
										<option value="F" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][5]=='F'){ ?> selected <?php }?> >Fijo</option>
										<option value="C" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][5]=='C'){ ?> selected <?php }?> >Celular</option>
									</select>
								</div>
							</div>
						</div>
						<!-- estado de registro-->
						<div class="form-group">
							<label class="col-md-4 control-label">Estado de Registro</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="estadoRegistro" class="form-control selectpicker" >
										<option value="" >Selecciona un Estado</option>
										<option value="S" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][6]=='S'){ ?> selected <?php }?> >Vigente</option>
										<option value="N" <?php if (count($arrayTelefonos)>0 && $arrayTelefonos[0][6]=='N'){ ?> selected <?php }?> >No Vigente</option>
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
								if (count($arrayTelefonos)==0){
									echo "guardar('N')";
								}else{
									echo "guardar('M')";
								}
								?>">Registrar <span class="glyphicon glyphicon-send"></span></button>
								<button type="submit" class="btn btn-warning" onclick="retornar();">Volver <span class="glyphicon glyphicon-send"></span></button>
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
				function retornar (){
					document.getElementById('exit').value='C';
				}

				function guardar(codigo){
					document.getElementById('validatorForm').value=codigo;
					document.getElementById('exit').value='G';
					document.formEnvio.submit();
				}
			</script>
		</body>
		</html>
		<?php
	}
};
?>