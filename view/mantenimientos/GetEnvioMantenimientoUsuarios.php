<?php
session_start();
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else{
		include('../../controller/mantenimiento/MantenimientoUsuariosController.php');
		$mantenimientoUsuariosController = new MantenimientoUsuariosController;
		$mantenimientoUsuariosController -> establishConnection();
		$mantenimientoUsuariosController ->mostrarFormularioMantenimientoUsuarios($_POST['validatorTable']);
	}
}

if(isset($_POST['validatorForm'])) {
	include('../../controller/mantenimiento/MantenimientoUsuariosController.php');
	$mantenimientoUsuariosController = new MantenimientoUsuariosController;
	$mantenimientoUsuariosController -> establishConnection();
	$mantenimientoUsuariosController ->guardarFormularioMantenimientoUsuarios($_POST['validatorForm'],$_POST['usuario'],$_POST['estadoBloqueo'],$_POST['intentos'],$_POST['estadoUsuario'],$_POST['perfilUsuario']);
}
?>