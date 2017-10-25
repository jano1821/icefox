<?php
session_start();

if ($_GET['validatorForm']){
    
}
/*
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else if ($_POST['validatorTable'] == 'B'){
		$numeroCertificado = '';
		$numeroPlaca = '';
		$fechaVentaInicial = '';
		$fechaVentaFinal = '';
		$codigoPuntoVenta = '';
		$puntoVenta = '';
		$pagina = 0;
		$direccion = 1;

		if (isset($_POST['numeroCertificado'])){
			$numeroCertificado = $_POST['numeroCertificado'];
		}
		if (isset($_POST['placa'])){
			$numeroPlaca = $_POST['placa'];
		}
		if (isset($_POST['FechaInicial'])){
			$fechaVentaInicial = $_POST['FechaInicial'];
		}
		if (isset($_POST['FechaFinal'])){
			$fechaVentaFinal = $_POST['FechaFinal'];
		}
		if (isset($_POST['codigoPuntoVenta'])){
			$codigoPuntoVenta = $_POST['codigoPuntoVenta'];
		}
		if (isset($_POST['pagina'])){
			$pagina = $_POST['pagina'];
		}
		if (isset($_POST['direccion'])){
			$direccion = $_POST['direccion'];
		}
		if (isset($_POST['puntoVenta'])){
			$puntoVenta = $_POST['puntoVenta'];
		}

		include('../../controller/comercial/VentasController.php');
		$ventasController = new VentasController;
		$ventasController -> establishConnection();
		$ventasController ->obtenerListaVentas($numeroCertificado,$numeroPlaca,$fechaVentaInicial,$fechaVentaFinal,$codigoPuntoVenta,$puntoVenta,$pagina,$direccion);
	}else{
		include('../../controller/comercial/VentasController.php');
		$ventasController = new VentasController;
		$ventasController -> establishConnection();
		$ventasController ->mostrarFormularioVentas('');
	}
}
*/
if(isset($_GET['validatorForm'])) {
	//$pagina = 1;

	include('../../controller/comercial/VentasController.php');
	$ventasController = new VentasController;
	$ventasController -> establishConnection();
	$ventasController ->guardarVenta($pagina);
}
?>