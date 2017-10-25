<?php
class FormLoteRegistro{
	public function mostrarFormLoteRegistro($arrayLote){
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<title>Mantenimiento de Lotes</title>
		<script src="../../js/modernizr.js" type="text/javascript"></script>
		<script src="../../js/envioFormulario.js" type="text/javascript"></script>
		<script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
		<link rel='stylesheet prefetch' href='../../css/bootstrap.min.css'>
		<link rel='stylesheet prefetch' href='../../css/bootstrap-theme.min.css'>
		<link rel='stylesheet prefetch' href='../../css/bootstrapValidator.min.css'>
		<link rel="stylesheet" href="../../css/styleForm.css">
	</head>
	<body>
		<div class="container">
			<form class="well form-horizontal" action="../../view/operaciones/GetEnvioLoteRegistro.php" method="post"  name="formEnvio" id="formEnvio">
				<input type="hidden" name="validatorForm" id="validatorForm">
				<fieldset>
					<!-- Form Name -->
					<?php
					if (count($arrayLote)==0){
					?>
					<legend align="center">Registrar Nuevo Lote</legend>
					<?php
					}else{
					?>
					<legend align="center">Actualizar Lote</legend>
					<?php
					}
					?>
					<!-- codigo Lote-->
					<input type="hidden" name="codigo" id="codigo" <?php if (count($arrayLote)>0){ ?> value="<?php echo $arrayLote[0][0];?>"<?php }?>>
					<!-- descripcion Lote-->
					<div class="form-group">
						<label class="col-md-4 control-label">Lote</label>
						<div class="col-md-4 inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input  name="descripcionLote" id="descripcionLote" placeholder="Descripcion" class="form-control" type="text" <?php if (count($arrayLote)>0){ ?> value="<?php echo $arrayLote[0][1];?>"<?php }?> >
							</div>
						</div>
					</div>
					<!-- fecha Registro Lote-->
					<div class="form-group">
						<label class="col-md-4 control-label">Fecha de Alta</label>
						<div class="col-md-4 inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
								<input  name="fechaRegistro" id="fechaRegistro" placeholder="dd/mm/yyyy" class="form-control" onblur="validarFecha('fechaRegistro');" type="text" <?php if (count($arrayLote)>0){ ?> value="<?php echo date_format(date_create($arrayLote[0][2]),'d/m/Y');?>"<?php }?> >
								<?php
								if (count($arrayLote)==0){
								?>
								<input  name="cantidad" id="cantidad" placeholder="Cantidad de días" class="form-control" type="text" onblur="calcularDias();">
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<!-- fecha de vencimiento-->
					<div class="form-group">
						<label class="col-md-4 control-label">Fecha de Vencimiento</label>
						<div class="col-md-4 inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
								<input  name="fechaVencimiento" id="fechaVencimiento" placeholder="dd/mm/yyyy" class="form-control" onblur="validarFecha('fechaVencimiento');" type="text" <?php if (count($arrayLote)>0){ ?> value="<?php echo date_format(date_create($arrayLote[0][3]),'d/m/Y');?>"<?php }?> >
							</div>
						</div>
					</div>
					<!-- estado de cierre-->
					<div class="form-group">
						<label class="col-md-4 control-label">Estado de Actividad</label>
						<div class="col-md-4 selectContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
								<select name="estadoActividad" id="estadoActividad" class="form-control selectpicker" >
									<option value="" >Selecciona un Estado</option>
									<option value="V" <?php if (count($arrayLote)>0 && $arrayLote[0][4]=='V'){ ?> selected <?php }?> >Vigente</option>
									<option value="C" <?php if (count($arrayLote)>0 && $arrayLote[0][4]=='C'){ ?> selected <?php }?> >Cerrado</option>
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
								<select name="estadoLote" class="form-control selectpicker" >
									<option value="" >Selecciona un Estado</option>
									<option value="S" <?php if (count($arrayLote)>0 && $arrayLote[0][5]=='S'){ ?> selected <?php }?> >Vigente</option>
									<option value="N" <?php if (count($arrayLote)>0 && $arrayLote[0][5]=='N'){ ?> selected <?php }?> >No Vigente</option>
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
							if (count($arrayLote)==0){
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
		<script type="text/javascript">
			function calcularDias(){
				var fechaInicial = document.getElementById('fechaRegistro').value;
				var cantidadDias = document.getElementById('cantidad').value;
				if (!isEmpty(fechaInicial) && !isEmpty(cantidadDias)){
					document.getElementById('fechaVencimiento').value=_sumarRestarDias(parseDate(fechaInicial),parseInt(cantidadDias));
				}
			}
		</script>
	</body>
</html>
<?php
	}
}
?>