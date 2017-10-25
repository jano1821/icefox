<?php

session_start();
if (isset($_POST['exit'])) {
    if ($_POST['exit'] == 'N') {
        if (isset($_POST['codigo']) && isset($_POST['validatorTable'])) {

            include('../../controller/mantenimiento/MantenimientoDireccionController.php');
            $mantenimientoDireccionController = new MantenimientoDireccionController;
            $mantenimientoDireccionController->establishConnection();
            $mantenimientoDireccionController->mostrarFormMantenimientoDirecciones($_POST['codigo'],
                    $_POST['validatorTable']);
        }
    } else if ($_POST['exit'] == 'C') {
        if (isset($_POST['codigo'])) {
            $arrayTelefonos = array();

            include('../../controller/mantenimiento/MantenimientoDireccionController.php');
            $mantenimientoDireccionController = new MantenimientoDireccionController;
            $mantenimientoDireccionController->establishConnection();
            $mantenimientoDireccionController->obtenerListaDirecciones($_POST['codigo']);
        }
    } else if ($_POST['exit'] == 'G') {
        if (isset($_POST['codigo'])) {
            $arrayTelefonos = array();

            include('../../controller/mantenimiento/MantenimientoDireccionController.php');
            $mantenimientoDireccionController = new MantenimientoDireccionController;
            $mantenimientoDireccionController->establishConnection();
            $mantenimientoDireccionController->guardarFormularioMantenimientoDirecciones($_POST['validatorForm'],
                    $_POST['codigo'],
                    $_POST['correlativo'],
                    $_POST['direccion'],
                    $_POST['distrito'],
                    $_POST['principal'],
                    $_POST['estadoRegistro']);
        }
    } else {
        include('../../controller/mantenimiento/MantenimientoPersonaController.php');
        $mantenimientoPersonaController = new MantenimientoPersonaController;
        $mantenimientoPersonaController->establishConnection();
        $mantenimientoPersonaController->mostrarFormularioMantenimientoPersona($_POST['codigo']);
    }
}

if (isset($_GET['codDepartamento'])) {

    include('../../controller/mantenimiento/MantenimientoUbigeoController.php');
    $mantenimientoUbigeoController = new MantenimientoUbigeoController;
    $mantenimientoUbigeoController->establishConnection();
    $comboProvincias = $mantenimientoUbigeoController->obtenerListaProvincias($_GET['codDepartamento'],
            $_GET['codigoSeleccion']);

    echo $comboProvincias;
}

if (isset($_GET['codProvincia'])) {

    include('../../controller/mantenimiento/MantenimientoUbigeoController.php');
    $mantenimientoUbigeoController = new MantenimientoUbigeoController;
    $mantenimientoUbigeoController->establishConnection();
    $comboDistritos = $mantenimientoUbigeoController->obtenerListaDistritos($_GET['codProvincia'],
            $_GET['codigoSeleccion']);

    echo $comboDistritos;
}
?>