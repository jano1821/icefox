<?php
session_start();
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else{
		include('../../controller/mantenimiento/MantenimientoOpcionesPorPerfilController.php');
		$mantenimientoOpcionesPorPerfilController = new MantenimientoOpcionesPorPerfilController;
		$mantenimientoOpcionesPorPerfilController -> establishConnection();
		$mantenimientoOpcionesPorPerfilController ->mostrarFormMantenimientoOpcionesPorPerfil($_POST['validatorTable']);
	}
}

if(isset($_POST['validatorForm'])) {
	include('../../controller/mantenimiento/MantenimientoOpcionesPorPerfilController.php');
	$mantenimientoOpcionesPorPerfilController = new MantenimientoOpcionesPorPerfilController();
	$mantenimientoOpcionesPorPerfilController -> establishConnection();

	if ($_POST['validatorForm'] == 'U'){
		$mantenimientoOpcionesPorPerfilController -> obtenerListaPerfiles('');
	}else{
		$mantenimientoOpcionesPorPerfilController -> guardarFormularioMantenimientoOpcionesPorPerfil($_POST['hosting'],$_POST['codigo']);
	}
}
?>