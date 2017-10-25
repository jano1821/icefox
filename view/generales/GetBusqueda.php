<?php
session_start();

if (isset($_POST['action'])){
	$arrayTipoBusqueda = array();
	if (isset($_POST['valor'])){
		if (isset($_POST['tipo'])){
			$tipo = $_POST['tipo'];
		}else{
			$tipo = "1";
		}
		$arrayTipoBusqueda=array(array("0","Codigo"),array("1","Razón Social"));

		include("../../view/generales/BusquedaCNTR.php");
		$busquedaCNTR = new BusquedaCNTR;
		$busquedaCNTR ->mostrarBusquedaCNTR($arrayTipoBusqueda,$tipo,$_POST['valor'],$_POST['action']);
	}

}

if (isset($_POST['actionTable'])){
	include('../../controller/generales/BusquedaController.php');
	$busquedaController = new BusquedaController;
	$busquedaController -> establishConnection();
	$busquedaController -> ProcesarBusqueda($_POST['actionTable'],$_POST['valorOpcion']);
}
?>