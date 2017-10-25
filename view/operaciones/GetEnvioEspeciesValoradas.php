<?php
session_start();
if(isset($_POST['validatorTable'])) {

	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();
	}else if ($_POST['validatorTable'] == 'D' || $_POST['validatorTable'] == 'B'){
		include('../../controller/operaciones/EspeciesValoradasController.php');
		$especiesValoradasController = new EspeciesValoradasController();
		$especiesValoradasController -> establishConnection();
		$especiesValoradasController -> obtenerListaEspeciesValoradas($_POST['numeroCertificado'],$_POST['lote'],$_POST['tipo'],$_POST['proveedor'],$_POST['estadoRegistro'],$_POST['pagina'],$_POST['direccion']);
	}else{
		include('../../controller/operaciones/EspeciesValoradasController.php');
		$especiesValoradasController = new EspeciesValoradasController();
		$especiesValoradasController -> establishConnection();
		$especiesValoradasController ->mostrarRegistroEspeciesValoradas($_POST['validatorTable']);
	}
}

if(isset($_POST['validatorForm'])) {
	include('../../controller/operaciones/EspeciesValoradasController.php');
	$especiesValoradasController = new EspeciesValoradasController;
	$especiesValoradasController -> establishConnection();
	$especiesValoradasController ->guardarFormularioEspecieValorada($_POST['validatorForm'],$_POST['codigo'],$_POST['metodo'],$_POST['cantidad'],$_POST['numero'],$_POST['lote'],$_POST['tipo'],$_POST['proveedor'],$_POST['poliza'],$_POST['clase'],1);
}
?>