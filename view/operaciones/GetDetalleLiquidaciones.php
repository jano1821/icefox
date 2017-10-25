<?php
session_start();

if(isset($_POST['validatorTable'])) {
	$resultadoCarga = "I";
	$puntoVenta='';
	$especies = array();
	$codigoPuntoVenta='';

	if ($_POST['validatorTable']=='T'){
		$linea;
		$line;
		$arrayEV = array();
		if (isset($_SESSION['listaDetalleEVLiquidar'])){
			if (count($_SESSION['listaDetalleEVLiquidar'])>0){
				$arrayEV = $_SESSION['listaDetalleEVLiquidar'];
			}
		}
		foreach($_POST['datos'] as $check) {
			$linea = str_replace("','","-",$check);
			$line=explode("-",$linea);
			array_push($arrayEV, $line);
		}
		$_SESSION['listaDetalleEVLiquidar'] = $arrayEV;
		$resultadoCarga = "F";
	}

	if (isset($_SESSION['listaDetalleEVLiquidar'])){
		if (count($_SESSION['listaDetalleEVLiquidar'])>0){
			foreach ($_SESSION['listaDetalleEVLiquidar'] as $key) {
				array_push($especies,$key[1]);
			}
		}
	}

	if (isset($_POST['nombrePuntoVenta'])){
		$puntoVenta=$_POST['nombrePuntoVenta'];
	}else{
		if (isset($_POST['puntoVenta'])){
			$puntoVenta=$_POST['puntoVenta'];
		}
	}

	if (isset($_POST['codigoPuntoVenta'])){$codigoPuntoVenta=$_POST['codigoPuntoVenta'];}

	if (isset($_POST['puntoVenta']) && isset($_POST['codigoPuntoVenta'])){
		$_SESSION['arrayPuntoVenta'] = array($_POST['puntoVenta'],$_POST['codigoPuntoVenta']);
	}

	include('../../controller/operaciones/LiquidacionesController.php');
	$liquidacionesController = new LiquidacionesController;
	$liquidacionesController -> establishConnection();
	$liquidacionesController ->mostrarBusquedaEspeciesValoradas($especies,$puntoVenta,$resultadoCarga,$codigoPuntoVenta);

}
?>