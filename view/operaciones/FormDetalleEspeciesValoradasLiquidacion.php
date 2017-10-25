<?php
class FormDetalleEspeciesValoradasLiquidacion{
	public function mostrarFormDetalleEspeciesValoradas($especies,$htmlTabla,$puntoVenta,$resultadoCarga,$codigoPuntoVenta){
		?>
		<!DOCTYPE html>
		<html >

		<head>
			<title>Lista de Especies Valoradas</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
			<script type="text/javascript" src="../../js/functions.js"></script>
			<script type="text/javascript" src="../../js/envioFormulario.js"></script>
			<script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
			<link rel="stylesheet" type="text/css" href="../../css/screen.css" />
			<link rel="stylesheet" type="text/css" href="../../css/styleGrilla.css" />
			<link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />

		</head>

		<body onload="load();">

			<div id ="block"></div>
			<div class="container">
				<h1 class="titulo" align="center">Lista de Especies Valoradas Registrados en el Sistema</h1>
				<form action="../../view/operaciones/GetDetalleLiquidaciones.php" method="POST" name="formEnvio" id="formEnvio">
					<input type="hidden" name="validatorTable" id="validatorTable">
					<?php
					for($i=0; $i<count($especies); $i++){
						echo "<input type='hidden' name='especies[]' id='especies' value='".$especies[$i]."'>";
					}
					?>
					<br>
					<table>
						<tbody>
							<tr>
								<th>
									<label>Punto de Venta</label>
									<div >
										<div class="input-group">
										<input  name="puntoVenta" id="puntoVenta" placeholder="Punto de Venta" type="text" size="50" value="<?php echo $puntoVenta;?>" readonly><a href="#" onClick="abrirBusquedaPuntoVenta();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
											<input  name="codigoPuntoVenta" id="codigoPuntoVenta" type="hidden" value="<?php echo $codigoPuntoVenta;?>">

										</div>
									</div>
								</th>
								<th>
									<a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
								</th>
							</tr>
						</tbody>
					</table>

					<div>
						<a class="ovalbutton" href="javascript:enviarTodos();"><span>Enviar Seleccionados</span></a>
						<br>
					</div>
					<div id="content">
						<br>
						<?php
						echo $htmlTabla;
						?>
					</div>
				</form>
				<form name ="formBusquedaPuntoVenta" id="formBusquedaPuntoVenta" method="post" action="../../view/generales/GetBusqueda.php" target="TheWindowChild">
					<input  name="action" id="action" type="hidden" value="BUSQUEDA_PUNTO_VENTA">
					<input  name="valor" id="valor" type="hidden" >
				</form>
			</div>
		</body>
		<script type="text/javascript">
			var popupWindow;
			function load(){
				var variableCarga = "<?php echo $resultadoCarga?>";
				if (variableCarga=="F"){
					setTimeout(window.opener.cerrarChild(),1000);
				}
			}

			function enviarTodos(){
				var b = 0;
				var f = document.getElementById('formEnvio')

				if (document.getElementById("datos")){
					if (f.datos=='undefined'){
						if (document.getElementById("datos").checked == true){
							b=1;
						}
					}else{
						for(i=0;i<f.datos.length;i++) {
							if(f.datos.item(i).checked == true) {
								b++;
							}
						}
					}
					if (b>0){
						document.getElementById('validatorTable').value='T';
						document.getElementById('formEnvio').submit();
					}else{
						alert("Debe Seleccionar al Menos un Certificado para Poder Enviar");
					}
				}else{
					alert("No ha realizado Ninguna Búsqueda");
				}
			}

			function envioFormulario(codProducto,numeroCertificado){
				window.opener.agregarOption(codProducto,numeroCertificado);
			}

			function abrirBusquedaPuntoVenta(){
				var f = document.getElementById('formBusquedaPuntoVenta');

				var window_width = 500;
				var window_height = 350;
				var newfeatures= 'scrollbars=no,resizable=no,menubar=no,location=no';
				var window_top = (screen.height-window_height)/2;
				var window_left = (screen.width-window_width)/2;
				popupWindow = window.open("", "TheWindowChild","_blank, width=" + window_width + ",height=" + window_height + ",top=" + window_top + ",left=" + window_left + ",features=" + newfeatures);
				f.submit();
			}

			function insertarPuntoVenta(codigo,descripcion){
				document.getElementById('codigoPuntoVenta').value=codigo;
				document.getElementById('puntoVenta').value=descripcion;

				popupWindow.close();

				buscar();
			}
		</script>
		</html>
		<?php
	}
}
?>