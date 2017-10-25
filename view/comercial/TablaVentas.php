<?php
class TablaVentas{
	public function mostrarTablaVentas($htmlTabla,$numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$cantPaginas){
		?>
		<!DOCTYPE html>
		<html >

		<head>
			<title>Lista de Ventas</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
			<script type="text/javascript" src="../../js/functions.js"></script>
			<script type="text/javascript" src="../../js/envioFormulario.js"></script>
			<script src="../../js/icefoxUtilitarios.js" type="text/javascript"></script>
			<link rel="stylesheet" type="text/css" href="../../css/screen.css" />
			<link rel="stylesheet" type="text/css" href="../../css/styleGrilla.css" />
			<link rel="stylesheet" type="text/css" href="../../css/styleButtons.css" />

		</head>

		<body>

			<div id ="block"></div>
			<div class="container">
				<h1 class="titulo" align="center">Lista de Especies Valoradas Liquidadas</h1>
				<form action="../../view/comercial/GetVentas.php" method="POST" name="formEnvio" id="formEnvio">
					<input type="hidden" name="validatorTable" id="validatorTable">
					<input type="hidden" name="direccion" id="direccion">

					<div class="buttonwrapper">
						<a class="ovalbutton" href="javascript:volverMenu();"><span>Volver al Menu</span></a>
						<a class="ovalbutton" href="javascript:envioFormulario('');"><span>Registro de Venta</span></a>
					</div>
					<br>
					<table>
						<tbody>
							<tr>
								<th>
									<label>Número de certificado</label>
									<div >
										<input  name="numeroCertificado" id="numeroCertificado" placeholder="Número de Certificado" type="text" size="20" value="<?php echo $numeroCertificado;?>">
									</div>
								</th>
								<th>
									<label>Número de Placa</label>
									<div >
										<input  name="placa" id="placa" placeholder="Número de Placa" type="text" size="20" value="<?php echo $numeroPlaca;?>">
									</div>
								</th>
								<th>
									<label>Punto de Venta</label>
									<div >
										<div class="input-group">
										<input  name="puntoVenta" id="puntoVenta" placeholder="Punto de Venta" type="text" size="50" value="<?php echo $puntoVenta;?>"><a href="#" onClick="abrirBusquedaPuntoVenta();"><img src="../../images/lupa4.png" width="15" height="15" border="0"></a>
											<input  name="codigoPuntoVenta" id="codigoPuntoVenta" type="hidden" value="<?php echo $codigoPuntoVenta;?>">

										</div>
									</div>
								</th>
								<th>
									<a class="ovalbutton" href="javascript:buscar();"><span>Buscar</span></a>
								</th>
							</tr>
							<tr>
								<th>
									<label>Fecha Inicial</label>
									<div >
										<input  name="FechaInicial" id="FechaInicial" placeholder="Fecha Inicial" type="text" size="20" value="<?php echo $fechaVentaInicial;?>">
									</div>
								</th>
								<th>
								<label>Fecha Final</label>
									<div >
										<input  name="FechaFinal" id="FechaFinal" placeholder="Fecha Final" type="text" size="20" value="<?php echo $fechaVentaFinal;?>">
									</div>
								</th>
								<th>

								</th>
							</tr>
						</tbody>
					</table>
					<br>
					<div id="content">
						<?php
						echo $htmlTabla;
						?>
					</div>
					<table>
						<tbody>
							<tr>
								<th>
									Página
									<input type="text" name="pagina" id="pagina" size="2" maxlength="2" readonly value="<?php echo $pagina;?>"> de <input type="text" name="totPagina" id="totPagina" size="2" maxlength="2" readonly value="<?php echo $cantPaginas;?>">
									<a class="ovalbutton" href="javascript:direccion('-1');"><span><</span></a>
									<a class="ovalbutton" href="javascript:direccion('1');"><span>></span></a>
								</th>
							</tr>
						</tbody>
					</table>

				</form>
				<form name ="formBusquedaPuntoVenta" id="formBusquedaPuntoVenta" method="post" action="../../view/generales/GetBusqueda.php" target="TheWindowChild">
					<input  name="action" id="action" type="hidden" value="BUSQUEDA_PUNTO_VENTA_LIQUIDADOS">
					<input  name="valor" id="valor" type="hidden" >
				</form>
			</div>
		</body>
		<script type="text/javascript">
			var popupWindow;
			function load(){

				//if (variableCarga=="F"){
					//setTimeout(window.opener.cerrarChild(),1000);
				//}
			}

			function abrirBusquedaPuntoVenta(){
				var f = document.getElementById('formBusquedaPuntoVenta');

				document.getElementById('valor').value=document.getElementById('puntoVenta').value;

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

				//buscar();
			}
		</script>
		</html>
		<?php
	}
}
?>