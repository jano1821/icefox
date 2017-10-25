<?php
session_start();
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else{
		include('../../controller/comercial/VentasController.php');
		$ventasController = new VentasController;
		$ventasController -> establishConnection();
		$ventasController ->listaVentas();
	}
}

if(isset($_POST['validatorForm'])) {
	include('../../controller/comercial/VentasController.php');
	$ventasController = new VentasController;
	$ventasController -> establishConnection();
	$ventasController ->guardarVenta();
}
?>