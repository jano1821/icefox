<?php
session_start();
if (isset($_POST['exit'])){
	if ($_POST['exit']=='N'){

		if (isset($_POST['codigo']) && isset($_POST['validatorTable'])){

			include('../../controller/mantenimiento/MantenimientoTelefonosController.php');
			$mantenimientoTelefonosController = new MantenimientoTelefonosController;
			$mantenimientoTelefonosController -> establishConnection();
			$mantenimientoTelefonosController -> mostrarFormMantenimientoTelefonos($_POST['codigo'],$_POST['validatorTable']);
		}
	}else if ($_POST['exit']=='C'){
		if (isset($_POST['codigo'])){
			$arrayTelefonos = array();

			include('../../controller/mantenimiento/MantenimientoTelefonosController.php');
			$mantenimientoTelefonosController = new MantenimientoTelefonosController;
			$mantenimientoTelefonosController -> establishConnection();
			$mantenimientoTelefonosController -> obtenerListaTelefonos($_POST['codigo']);
		}
	}else if ($_POST['exit']=='G'){
		if (isset($_POST['codigo'])){
			$arrayTelefonos = array();

			include('../../controller/mantenimiento/MantenimientoTelefonosController.php');
			$mantenimientoTelefonosController = new MantenimientoTelefonosController;
			$mantenimientoTelefonosController -> establishConnection();
			$mantenimientoTelefonosController -> guardarFormularioMantenimientoTelefonos($_POST['validatorForm'],$_POST['codigo'],$_POST['correlativo'],$_POST['numeroTelefono'],$_POST['operador'],$_POST['principal'],$_POST['tipo'],$_POST['estadoRegistro']);
		}
	}else{
		include('../../controller/mantenimiento/MantenimientoPersonaController.php');
		$mantenimientoPersonaController = new MantenimientoPersonaController;
		$mantenimientoPersonaController -> establishConnection();
		$mantenimientoPersonaController ->mostrarFormularioMantenimientoPersona($_POST['codigo']);
	}
}
?>