<?php

session_start();

if (isset($_GET['codGrupo'])) {
    include('../../controller/reportes/GeneradorReportesController.php');
    $generadorReportesController = new GeneradorReportesController;
    $generadorReportesController->establishConnection();
    $comboSubGrupo = $generadorReportesController->obtenerListaSubGrupoReporte($_GET['codGrupo']);

    echo $comboSubGrupo;
}

if (isset($_GET['codSubGrupo'])) {
    include('../../controller/reportes/GeneradorReportesController.php');
    $generadorReportesController = new GeneradorReportesController;
    $generadorReportesController->establishConnection();
    $tablaReportes = $generadorReportesController->obtenerListaReportes($_GET['codSubGrupo']);

    echo $tablaReportes;
}

if (isset($_GET['codReporte'])) {
    include('../../controller/reportes/GeneradorReportesController.php');
    $generadorReportesController = new GeneradorReportesController;
    $generadorReportesController->establishConnection();
    $tablaParametros = $generadorReportesController->obtenerListaParametros($_GET['codReporte']);

    echo $tablaParametros;
}

if (isset($_GET['idReporte'])) {
    include('../../controller/reportes/ReporteController.php');
    $reporteController = new ReporteController;
    $reporteController->establishConnection();
    $idReporte = $reporteController->obtenerIdentificadorReporte($_GET['idReporte']) . '';

    $myArr = array($idReporte);

    $myJSON = json_encode($myArr);

    echo $myJSON;
}
if (isset($_POST['validatorTable'])) {
    if ($_POST['validatorTable'] == 'U') {
        include('../../controller/principal/LoginController.php');
        $loginController = new LoginController;
        $loginController->establishConnection();
        $loginController->llamarMenuPrincipal();
    }else{
        if (isset($_POST['identificar'])) {

            if ($_POST['identificar'] == 'REPSTOOFI') {
                include('../../controller/reportes/ReporteEspeciesValoradasController.php');
                $reporteEspeciesValoradasController = new ReporteEspeciesValoradasController;
                $reporteEspeciesValoradasController->establishConnection();
                $reporteEspeciesValoradasController->reporteStockEnOficina();
            }
            if ($_POST['identificar'] == 'REPTRAZV') {
                include('../../controller/reportes/ReporteEspeciesValoradasController.php');
                $reporteEspeciesValoradasController = new ReporteEspeciesValoradasController;
                $reporteEspeciesValoradasController->establishConnection();
                $reporteEspeciesValoradasController->reporteDeCampo();
            }
            if ($_POST['identificar'] == 'RELIRAFE') {
                include('../../controller/reportes/ReporteEspeciesValoradasController.php');
                $reporteEspeciesValoradasController = new ReporteEspeciesValoradasController;
                $reporteEspeciesValoradasController->establishConnection();
                $variable = $_POST['parametros'];

                $reporteEspeciesValoradasController->reporteLiquidacionesPorFecha($variable[0],
                                        $variable[1]);
            }
            if ($_POST['identificar'] == 'REPLRAFE') {
                include('../../controller/reportes/ReporteEspeciesValoradasController.php');
                $reporteEspeciesValoradasController = new ReporteEspeciesValoradasController;
                $reporteEspeciesValoradasController->establishConnection();
                $variable = $_POST['parametros'];

                $reporteEspeciesValoradasController->reporteDepositosPorFecha($variable[0],
                                        $variable[1]);
            }
        }
    }
}
?>

