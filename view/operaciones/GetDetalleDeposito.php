<?php
session_start();

if(isset($_POST['validatorTable'])) {
	$numeroCertificado='';
	$pagina=0;
	$direccion=1;

	if (isset($_POST['especies'])){
		$especies = $_POST['especies'];
	}else{
		$especies = array();
	}

	if (isset($_POST['numeroCertificado'])){$numeroCertificado=$_POST['numeroCertificado'];}
	if (isset($_POST['pagina'])){$pagina=$_POST['pagina'];}
	if (isset($_POST['direccion'])){$direccion=$_POST['direccion'];}

	include('../../controller/operaciones/DepositosController.php');
	$depositosController = new DepositosController;
	$depositosController -> establishConnection();
	$depositosController ->mostrarBusquedaEspeciesValoradas($especies,$numeroCertificado,$pagina,$direccion);
}
?>