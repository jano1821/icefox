<?php
session_start();
if(isset($_POST['validatorTable'])) {
	if ($_POST['validatorTable'] == 'U'){
		include('../../controller/principal/LoginController.php');
		$loginController = new LoginController;
		$loginController -> establishConnection();
		$loginController -> llamarMenuPrincipal();

	}else if ($_POST['validatorTable'] == 'B' || $_POST['validatorTable'] == 'D'){
		$numeroCertificado = '';
		$codigoPuntoVenta = '';
		$puntoVenta = '';
		$pagina = 0;
		$direccion = 1;

		if (isset($_POST['numeroCertificado'])){
			$numeroCertificado = $_POST['numeroCertificado'];
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
			if ($puntoVenta!=''){
				$pagina = '1';
			}
		}

		include('../../controller/comercial/RegistroEspeciesValoradasLiquidadasController.php');
		$registroEspeciesValoradasLiquidadasController = new RegistroEspeciesValoradasLiquidadasController;
		$registroEspeciesValoradasLiquidadasController -> establishConnection();
		$registroEspeciesValoradasLiquidadasController ->obtenerListaRegistroEspeciesValoradasLiquidadas($numeroCertificado,$codigoPuntoVenta,$puntoVenta,$pagina,$direccion);
	}else if ($_POST['validatorTable'] == 'R' || $_POST['validatorTable'] == 'V' || $_POST['validatorTable'] == 'O' || $_POST['validatorTable'] == 'A'){
		$producto = '';

		if (isset($_POST['producto'])){
			$producto = $_POST['producto'];
		}

		include('../../controller/comercial/RegistroEspeciesValoradasLiquidadasController.php');
		$registroEspeciesValoradasLiquidadasController = new RegistroEspeciesValoradasLiquidadasController;
		$registroEspeciesValoradasLiquidadasController -> establishConnection();
		$registroEspeciesValoradasLiquidadasController ->cambioEstadoEspecieValoradaLiquidada($producto,$_POST['validatorTable']);
	}else{
		include('../../controller/comercial/RegistroEspeciesValoradasLiquidadasController.php');
		$registroEspeciesValoradasLiquidadasController = new RegistroEspeciesValoradasLiquidadasController;
		$registroEspeciesValoradasLiquidadasController -> establishConnection();
		$registroEspeciesValoradasLiquidadasController ->mostrarFormularioVentas('');
	}
}

if(isset($_POST['validatorForm'])) {
	$pagina = 1;

	include('../../controller/comercial/VentasController.php');
	$ventasController = new VentasController;
	$ventasController -> establishConnection();
	$ventasController ->guardarVenta($pagina);
}
?>