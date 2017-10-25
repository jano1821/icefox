<?php

session_start();
if (isset($_POST['action'])) {

    include('../../controller/mantenimiento/MantenimientoVehiculoController.php');
    $mantenimientoVehiculoController = new MantenimientoVehiculoController;
    $mantenimientoVehiculoController->establishConnection();
    $respuestaValidacionVehiculo = $mantenimientoVehiculoController->mostrarFormMantenimientoVehiculo(array(),
                            'W');
}

if (isset($_GET['codCliente']) && isset($_GET['placa'])) {

    include('../../controller/mantenimiento/MantenimientoVehiculoController.php');
    $mantenimientoVehiculoController = new MantenimientoVehiculoController;
    $mantenimientoVehiculoController->establishConnection();
    $resultado = $mantenimientoVehiculoController->buscarVehiculoPorPlaca($_GET['placa']);

    $myJSON = json_encode($resultado);

    echo $myJSON;
}

if (isset($_GET['codMarca'])) {
    include('../../controller/mantenimiento/MantenimientoVehiculoController.php');
    $mantenimientoVehiculoController = new MantenimientoVehiculoController;
    $mantenimientoVehiculoController->establishConnection();
    $comboModelos = $mantenimientoVehiculoController->obtenerListaModelos($_GET['codMarca'],
                            $_GET['codigoSeleccion']);

    echo $comboModelos;
}

if (isset($_GET['validatorForm'])) {
    include('../../controller/mantenimiento/MantenimientoVehiculoController.php');
    $mantenimientoVehiculoController = new MantenimientoVehiculoController;
    $mantenimientoVehiculoController->establishConnection();
    $resultado = $mantenimientoVehiculoController->guardarVehiculo($_GET['validatorForm'],
                            $_GET['codigo'],
                            $_GET['nroAsientos'],
                            $_GET['nroSerieMotor'],
                            $_GET['nroRuedas'],
                            $_GET['nroPuertas'],
                            $_GET['usoVehiculo'],
                            $_GET['anioFabricacion'],
                            $_GET['claseVehiculo'],
                            $_GET['nroPlaca'],
                            $_GET['modeloVehiculo'],
                            $_GET['persona'],
                            $_GET['estadoRegistro']);
    $myArr = array($resultado);

    $myJSON = json_encode($myArr);

    echo $myJSON;
}
?>