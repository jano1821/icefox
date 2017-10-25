<?php
class FormMantenimientoDirecciones{
	public function mostrarFormMantenimientoDirecciones($codigoPersona,$arrayDirecciones,$arrayDepartamentos){
		?>
		<!DOCTYPE html>
		<html >
		<head>
			<meta charset="UTF-8">
			<title>Mantenimiento de Direcciones</title>
			<script src="../../js/modernizr.js" type="text/javascript"></script>
			<script src="../../js/envioFormulario.js" type="text/javascript"></script>
			<script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
			<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
			<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
			<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>

			<link rel="stylesheet" href="../../css/styleForm.css">

		</head>

		<body onload="validarSeleccion();">
			<div class="container">

				<form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoDirecciones.php" method="post"  name="formEnvio" id="formEnvio">
					<input type="hidden" name="validatorForm" id="validatorForm">
					<input type="hidden" name="exit" id="exit" value="N">
					<fieldset>
						<!-- Form Name -->
						<?php
						if (count($arrayDirecciones)==0){
							?>
							<legend align="center">Registrar Nueva Direccion</legend>
							<?php
						}else{
							?>
							<legend align="center">Actualizar Direccion</legend>
							<?php
						}
						?>

						<input type="hidden" name="codigo" id="codigo" <?php if (count($arrayDirecciones)>0){ ?> value="<?php echo $arrayDirecciones[0][0];?>"<?php }else{ ?> value="<?php echo $codigoPersona;?> "<?php }?> />
						<input type="hidden" name="correlativo" id="correlativo" <?php if (count($arrayDirecciones)>0){ ?> value="<?php echo $arrayDirecciones[0][1];?>"<?php }?>>
						<!-- descripcion -->
						<div class="form-group">
							<label class="col-md-4 control-label">Direccion</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="direccion" id="direccion" placeholder="Direccion" class="form-control" type="text" <?php if (count($arrayDirecciones)>0){ ?> value="<?php echo $arrayDirecciones[0][2];?>"<?php }?> >
								</div>
							</div>
						</div>
						<!-- operador-->
						<div class="form-group">
							<label class="col-md-4 control-label">Departamento</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="departamento" id="departamento" class="form-control selectpicker" onchange="obtenerProvincias(this.value);">
										<option value="" >Selecciona Departamento</option>
										<?php
										for ($i=0;$i<count($arrayDepartamentos);$i++){
										?>
											<option value="<?php echo $arrayDepartamentos[$i][0];?>" <?php if (count($arrayDirecciones)>0 && $arrayDirecciones[0][5]==$arrayDepartamentos[$i][0]){ ?> selected <?php }?> ><?php echo $arrayDepartamentos[$i][1];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>

						<div id="cboProvincia">
						</div>

						<div id="cboDistrito">
						</div>

						<!-- estado de cierre-->
						<div class="form-group">
							<label class="col-md-4 control-label">Principal</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="principal" id="principal" class="form-control selectpicker" >
										<option value="" >Selecciona si es Principal</option>
										<option value="S" <?php if (count($arrayDirecciones)>0 && $arrayDirecciones[0][6]=='S'){ ?> selected <?php }?> >Principal</option>
										<option value="N" <?php if (count($arrayDirecciones)>0 && $arrayDirecciones[0][6]=='N'){ ?> selected <?php }?> >No Principal</option>
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
										<option value="S" <?php if (count($arrayDirecciones)>0 && $arrayDirecciones[0][7]=='S'){ ?> selected <?php }?> >Vigente</option>
										<option value="N" <?php if (count($arrayDirecciones)>0 && $arrayDirecciones[0][7]=='N'){ ?> selected <?php }?> >No Vigente</option>
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
								if (count($arrayDirecciones)==0){
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
				function validarSeleccion(){
					var codigoSeleccion;
					<?php if (count($arrayDirecciones)>0){?>
						codigoSeleccion = '<?php echo $arrayDirecciones[0][5];?>';
					<?php }else{?>
						codigoSeleccion = '';
					<?php }?>

					obtenerProvincias(codigoSeleccion);

					<?php if (count($arrayDirecciones)>0){?>
						codigoSeleccion = '<?php echo $arrayDirecciones[0][4];?>';
					<?php }else{?>
						codigoSeleccion = '';
					<?php }?>

					obtenerDistritos(codigoSeleccion);
				}
				function retornar (){
					document.getElementById('exit').value='C';
				}

				function guardar(codigo){
					document.getElementById('validatorForm').value=codigo;
					document.getElementById('exit').value='G';
					document.formEnvio.submit();
				}

				function obtenerProvincias(codDepartamento){
					var codigoSeleccion;
					<?php if (count($arrayDirecciones)>0){?>
						codigoSeleccion = '<?php echo $arrayDirecciones[0][4];?>';
					<?php }else{?>
						codigoSeleccion = '';
					<?php }?>

					if (isEmpty(codDepartamento)){
						return false;
					}

					if (window.XMLHttpRequest){
				  		xmlhttp=new XMLHttpRequest();
				  	}else{
				  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  	}

		  			xmlhttp.onreadystatechange=function(){
			  		if (xmlhttp.readyState==4 && xmlhttp.status==200){	//4=se recibieron todos los datos de la respuesta del servidor /
			  															//200=respuesta correcta
		  					document.getElementById("cboProvincia").innerHTML=xmlhttp.responseText;
		  				}
		  			}
		  			xmlhttp.open("GET","../../view/mantenimientos/GetEnvioMantenimientoDirecciones.php?codDepartamento="+codDepartamento+"&codigoSeleccion="+codigoSeleccion,false);
		  			xmlhttp.send();
				}

				function obtenerDistritos(codProvincia){
					var codigoSeleccion;
					<?php if (count($arrayDirecciones)>0){?>
						codigoSeleccion = '<?php echo $arrayDirecciones[0][3];?>';
					<?php }else{?>
						codigoSeleccion = '';
					<?php }?>

					if (isEmpty(codProvincia)){
						return false;
					}

					if (window.XMLHttpRequest){
				  		xmlhttp=new XMLHttpRequest();
				  	}else{
				  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  	}

		  			xmlhttp.onreadystatechange=function(){
			  		if (xmlhttp.readyState==4 && xmlhttp.status==200){	//4=se recibieron todos los datos de la respuesta del servidor /
			  															//200=respuesta correcta
		  					document.getElementById("cboDistrito").innerHTML=xmlhttp.responseText;
		  				}
		  			}
		  			xmlhttp.open("GET","../../view/mantenimientos/GetEnvioMantenimientoDirecciones.php?codProvincia="+codProvincia+"&codigoSeleccion="+codigoSeleccion,false);
		  			xmlhttp.send();
				}
			</script>
		</body>
		</html>
		<?php
	}
};
?>