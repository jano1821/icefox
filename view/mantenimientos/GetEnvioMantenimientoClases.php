<?php
if (isset($_POST['exit'])){
	if ($_POST['exit']=='N'){
		if (isset($_POST['codigo'])){
			$proveedor=0;
			$cliente=0;
			$empleado=0;
			$puntoVenta=0;

			if (isset($_POST['proveedor'])){
				$proveedor=1;
			}
			if (isset($_POST['cliente'])){
				$cliente=1;
			}
			if (isset($_POST['empleado'])){
				$empleado=1;
			}
			if (isset($_POST['puntoVenta'])){
				$puntoVenta=1;
			}

			include('../../controller/mantenimiento/MantenimientoClasesController.php');
			$mantenimientoClasesController = new MantenimientoClasesController;
			$mantenimientoClasesController -> establishConnection();
			$mantenimientoClasesController -> guardarFormularioMantenimientoClases($_POST['codigo'],$proveedor,$cliente,$empleado,$puntoVenta);
		}
	}else{
		include('../../controller/mantenimiento/MantenimientoPersonaController.php');
		$mantenimientoPersonaController = new MantenimientoPersonaController;
		$mantenimientoPersonaController -> establishConnection();
		$mantenimientoPersonaController ->mostrarFormularioMantenimientoPersona($_POST['codigo']);
	}
}
?>