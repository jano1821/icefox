<?php

session_start();
if (isset($_POST['validatorTable'])) {

    if ($_POST['validatorTable'] == 'U') {
        include('../../controller/principal/LoginController.php');
        $loginController = new LoginController;
        $loginController->establishConnection();
        $loginController->llamarMenuPrincipal();
    } else if ($_POST['validatorTable'] == 'D' || $_POST['validatorTable'] == 'B') {
        include('../../controller/operaciones/DepositosController.php');
        $depositosController = new DepositosController;
        $depositosController->establishConnection();
        $depositosController->obtenerListaDepositos($_POST['serie'],
                $_POST['numero'],
                $_POST['empleado'],
                $_POST['puntoVenta'],
                $_POST['pagina'],
                $_POST['direccion']);
    } else {
        include('../../controller/operaciones/DepositosController.php');
        $depositosController = new DepositosController;
        $depositosController->establishConnection();
        $depositosController->mostrarRegistroDepositos($_POST['validatorTable']);
    }
}

if (isset($_POST['validatorForm'])) {
    if (isset($_POST['especiesValoradas'])) {
        $especiesValoradas = $_POST['especiesValoradas'];
    } else {
        $especiesValoradas = array();
    }

    include('../../controller/operaciones/DepositosController.php');
    $depositosController = new DepositosController;
    $depositosController->establishConnection();
    $depositosController->guardarDeposito($especiesValoradas,
            $_POST['validatorForm'],
            $_POST['codigo'],
            $_POST['metodo'],
            $_POST['cantidad'],
            $_POST['serie'],
            $_POST['numero'],
            $_POST['gestorCampo'],
            $_POST['puntoVenta'],
            $_POST['fecha'],
            $_POST['estadoRegistro'],
            1);
}
?>