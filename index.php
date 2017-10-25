<?php
session_start();
$_SESSION["PATH"]=str_replace('\\','/',dirname(__file__));
$url = $_SESSION["PATH"].'/view/principal/FormLogin.php';

if (file_exists($url)) {
	include($url);
	$formLogin = new FormLogin;
	$formLogin->mostrarFormLogin();
}else{
	echo "Error al cargar Ventana de Verificación de Usuario";
}
?>