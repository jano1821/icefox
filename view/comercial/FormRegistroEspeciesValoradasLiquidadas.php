<?php
class FormRegistroEspeciesValoradasLiquidadas{
	public function mostrarFormRegistroEspeciesValoradasLiquidadas(){
?>
		<!DOCTYPE html>
		<html >
		<head>
			<meta charset="UTF-8">
			<title>Registro de Ventas</title>
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
				<form class="well form-horizontal" action="../../view/comercial/GetVentas.php" method="post"  name="formEnvio" id="formEnvio">
					<input type="hidden" name="validatorForm" id="validatorForm">
					<fieldset>
						<legend align="center">Registrar Venta</legend>

						<!-- codigo venta-->
						<input type="hidden" name="codigo" id="codigo" >
						<!-- descripcion Lote-->
						<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Venta</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="fechaVenta" id="fechaVenta" placeholder="DD/MM/YYYY" class="form-control" type="text" >

								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Vigencia Desde</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="fechaVigenciaDesde" id="fechaVigenciaDesde" placeholder="DD/MM/YYYY" class="form-control" type="text" >

								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Vigencia Hasta</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="fechaVigenciaHasta" id="fechaVigenciaHasta" placeholder="DD/MM/YYYY" class="form-control" type="text" >

								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Hora de Venta</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="hora" id="hora" placeholder="HH:MM" class="form-control" type="text" >

								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Vehiculo</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="placa" id="placa" placeholder="Placa" class="form-control" type="text" >
									<input  name="codigoVehiculo" id="codigoVehiculo" type="hidden" >

								</div>
							</div><a href="#" onClick="busquedaVehiculo();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Especie Valorada</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="producto" id="producto" placeholder="Número de Certificado" class="form-control" type="text" >
									<input  name="codigoProducto" id="codigoProducto" type="hidden" >

								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Comprobante de Pago</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="comprobante" id="comprobante" placeholder="Comprobante" class="form-control" type="text" >

								</div>
							</div>
						</div>

						<!-- Success message -->
						<div class="alert alert-success" role="alert" id="success_message">Correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por ponerse en contacto con nosotros, nos pondremos en contacto con usted en breve.</div>
						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-4">
								<button type="submit" class="btn btn-warning" onclick="">Registrar <span class="glyphicon glyphicon-send"></span></button>
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
		function busquedaVehiculo(){
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
		  	xmlhttp.open("GET","../../view/mantenimientos/GetEnvioVehiculo.php?numeroPlaca="+document.getElementById("placa").value,false);
		  	xmlhttp.send();
		}
		</script>
		</html>
<?php
	}
};
?>