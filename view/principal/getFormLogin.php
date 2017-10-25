<?php
	session_start();
	if(isset($_POST['ingresar'])) {
        include('../../controller//principal/LoginController.php');
        $loginController = new LoginController;
        $loginController -> establishConnection();
        $loginController -> validarUsuario($_POST['username'],$_POST['password']);
    }
?>