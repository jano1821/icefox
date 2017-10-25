<?php
class FormMantenimientoOpcionesPorPerfil{
	public function mostrarFormMantenimientoOpcionesPorPerfil($arrayGrupos,$arraySubgrupos,$arrayMenu,$arrayMenuAsignado,$codigoPerfil,$descripcionPerfil){
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

    <script type="text/javascript">
		function grupo(cual, estado) {
			for (var i = 1; i < 6; i ++){
				document["forms"]["prueba"][cual + i]["checked"] = estado;
			}
		}
	</script>

</head>

<body>
  	<div class="container">

	    <form class="well form-horizontal" action="../../view/mantenimientos/GetEnvioMantenimientoOpcionesPorPerfil.php" method="post"  name="formEnvio" id="formEnvio">
			<input type="hidden" name="validatorForm" id="validatorForm">

			<fieldset>

			<!-- Form Name -->

			<div  align="center"><FONT SIZE=6><label>Opciones del Perfil</label></FONT></div><br>

			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigoPerfil;?>">


			<div class="form-group">
			  <label class="col-md-4 control-label"></label>
			  <div class="col-md-4" align="center">
			    <button type="submit" class="btn btn-warning" onclick="envioDatosFormulario('M')">Registrar <span class="glyphicon glyphicon-send"></span></button>
			    <button type="submit" class="btn btn-warning" onclick="volver();">Volver <span class="glyphicon glyphicon-send"></span></button>

			  </div>
			</div>

			<!-- radio checks -->
			<div >

				<FONT SIZE=5 COLOR=#0000FF><label>Perfil: <?php echo $descripcionPerfil;?></label><br></FONT><br>
				<?php
				for($grupos=0;$grupos<count($arrayGrupos);$grupos++){
				?>
				<FONT SIZE=4 COLOR=#585858><label>Grupo: <?php echo $arrayGrupos[$grupos][1]; ?></label><br></FONT>
				<?php
					for ($subgrupo=0;$subgrupo<count($arraySubgrupos);$subgrupo++){
						if ($arraySubgrupos[$subgrupo][2] == $arrayGrupos[$grupos][0]){
						?>
							<FONT SIZE=3 COLOR=#2E9AFE><label>Sub Grupo:   <?php echo $arraySubgrupos[$subgrupo][1]; ?></label><br></FONT>
							<?php
							for($menu=0;$menu<count($arrayMenu);$menu++){
								if($arrayMenu[$menu][4]==$arraySubgrupos[$subgrupo][0]){
									$contador=0;
							?>
									<div class="checkbox">
							            <label>
							                <?php
							                for ($indexAsignado=0;$indexAsignado<count($arrayMenuAsignado);$indexAsignado++){

			 									//echo count($arrayMenuAsignado);
							                	if ($arrayMenuAsignado[$indexAsignado][0]==$arrayMenu[$menu][0]){
							                		$contador++;
							                ?>

							                		<input type="checkbox" name="hosting[]" value="<?php echo $arrayMenu[$menu][0]; ?>" checked/>
							                <?php   echo $arrayMenu[$menu][1];
							                	}
											}
											if ($contador == 0){?>
													<input type="checkbox" name="hosting[]" value="<?php echo $arrayMenu[$menu][0]; ?>" /> <?php echo $arrayMenu[$menu][1];
											}
											?>

							            </label>
							        </div>
							<?php
								}
							}
						}
					}
					echo "<br>";
				}
				?>
			</div>


			<!-- Success message -->
			<div class="alert alert-success" role="alert" id="success_message">Correcto <i class="glyphicon glyphicon-thumbs-up"></i> Gracias por ponerse en contacto con nosotros, nos pondremos en contacto con usted en breve.</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label"></label>
			  <div class="col-md-4" align="center">
			    <button type="submit" class="btn btn-warning" onclick="envioDatosFormulario('M')">Registrar <span class="glyphicon glyphicon-send"></span></button>
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
};
?>