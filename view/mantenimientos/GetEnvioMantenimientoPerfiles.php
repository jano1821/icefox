<?php
session_start();
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else{
		include('../../controller/mantenimiento/MantenimientoPerfilesController.php');
		$mantenimientoPerfilesController = new MantenimientoPerfilesController;
		$mantenimientoPerfilesController -> establishConnection();
		$mantenimientoPerfilesController ->mostrarFormularioMantenimientoPerfiles($_POST['validatorTable']);
	}
}

if(isset($_POST['validatorForm'])) {
	include('../../controller/mantenimiento/MantenimientoPerfilesController.php');
	$mantenimientoPerfilesController = new MantenimientoPerfilesController;
	$mantenimientoPerfilesController -> establishConnection();
	$mantenimientoPerfilesController ->guardarFormularioMantenimientoUsuarios($_POST['validatorForm'],$_POST['codigo'],$_POST['perfil'],$_POST['estadoPerfil']);
}
?>