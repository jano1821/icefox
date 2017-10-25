<?php

session_start();
if (isset($_POST['validatorTable'])) {

    if ($_POST['validatorTable'] == 'U') {
        include('../../controller/principal/LoginController.php');
        $loginController = new LoginController;
        $loginController->establishConnection();
        $loginController->llamarMenuPrincipal();
    }else if ($_POST['validatorTable'] == 'D') {
        include('../../controller/operaciones/LoteRegistroController.php');
        $loteRegistroController = new LoteRegistroController();
        $loteRegistroController->establishConnection();
        $loteRegistroController->obtenerListaLotes('',
                                $_POST['pagina'],
                                $_POST['direccion']);
    }else if ($_POST['validatorTable'] == 'C') {
        include('../../controller/operaciones/LoteRegistroController.php');
        $loteRegistroController = new LoteRegistroController();
        $loteRegistroController->establishConnection();
        $loteRegistroController->cerrarLote($_POST['codigoLoteReg']);
    }else {
        include('../../controller/operaciones/LoteRegistroController.php');
        $loteRegistroController = new LoteRegistroController;
        $loteRegistroController->establishConnection();
        $loteRegistroController->mostrarFormularioLoteRegistro($_POST['validatorTable']);
    }
}

if (isset($_POST['validatorForm'])) {
    include('../../controller/operaciones/LoteRegistroController.php');
    $loteRegistroController = new LoteRegistroController;
    $loteRegistroController->establishConnection();
    $loteRegistroController->guardarFormularioLoteRegistro($_POST['validatorForm'],
                            $_POST['codigo'],
                            $_POST['descripcionLote'],
                            $_POST['fechaRegistro'],
                            $_POST['fechaVencimiento'],
                            $_POST['estadoActividad'],
                            $_POST['estadoLote'],
                            0,
                            1);
}
?>