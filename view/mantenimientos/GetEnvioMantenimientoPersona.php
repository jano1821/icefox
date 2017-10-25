<?php

session_start();
if (isset($_POST['validatorTable'])) {
    if ($_POST['validatorTable'] == 'U') {
        include('../../controller/principal/LoginController.php');
        $loginController = new LoginController;
        $loginController->establishConnection();
        $loginController->llamarMenuPrincipal();
    } else if ($_POST['validatorTable'] == 'B' || $_POST['validatorTable'] == 'D') {
        include('../../controller/mantenimiento/MantenimientoPersonaController.php');
        $mantenimientoPersonaController = new MantenimientoPersonaController;
        $mantenimientoPersonaController->establishConnection();
        $mantenimientoPersonaController->obtenerListaPersonasTabla($_POST['nombre'], $_POST['numeroDocumento'], $_POST['estadoRegistro'], $_POST['tipo'], $_POST['clase'], $_POST['pagina'], $_POST['direccion']);
    } else {
        include('../../controller/mantenimiento/MantenimientoPersonaController.php');
        $mantenimientoPersonaController = new MantenimientoPersonaController;
        $mantenimientoPersonaController->establishConnection();
        $mantenimientoPersonaController->mostrarFormularioMantenimientoPersona($_POST['validatorTable']);
    }
}

if (isset($_POST['validatorForm'])) {
    if ($_POST['validatorForm'] == 'D') {
        include('../../controller/mantenimiento/MantenimientoDireccionController.php');
        $mantenimientoDireccionController = new MantenimientoDireccionController;
        $mantenimientoDireccionController->establishConnection();
        $mantenimientoDireccionController->obtenerListaDirecciones($_POST['codigo']);
    } else if ($_POST['validatorForm'] == 'T') {
        include('../../controller/mantenimiento/MantenimientoTelefonosController.php');
        $mantenimientoTelefonosController = new MantenimientoTelefonosController;
        $mantenimientoTelefonosController->establishConnection();
        $mantenimientoTelefonosController->obtenerListaTelefonos($_POST['codigo']);
    } else if ($_POST['validatorForm'] == 'C') {
        include('../../controller/mantenimiento/MantenimientoClasesController.php');
        $mantenimientoClasesController = new MantenimientoClasesController;
        $mantenimientoClasesController->establishConnection();
        $mantenimientoClasesController->mostrarFormularioMantenimientoClases($_POST['codigo']);
    } else {
        include('../../controller/mantenimiento/MantenimientoPersonaController.php');
        $mantenimientoPersonaController = new MantenimientoPersonaController;
        $mantenimientoPersonaController->establishConnection();
        $mantenimientoPersonaController->guardarFormularioMantenimientoPersona($_POST['validatorForm'], $_POST['codigo'], $_POST['nombres'], $_POST['apePat'], $_POST['apeMat'], $_POST['razonSocial'], $_POST['TipoDocumento'], $_POST['NumeroDocumento'], $_POST['tipoPersona'], $_POST['sexo'], $_POST['fecNac'], $_POST['estadoCivil'], $_POST['estadoRegistro']);
    }
}

if (isset($_POST['validationModal'])) {
    include('../../controller/mantenimiento/MantenimientoPersonaController.php');
    $mantenimientoPersonaController = new MantenimientoPersonaController;
    $mantenimientoPersonaController->establishConnection();
    $mantenimientoPersonaController->mostrarFormularioMantenimientoPersona($_POST['validationModal']);
}

if (isset($_GET['valorBusqueda'])) {

    include('../../controller/mantenimiento/MantenimientoPersonaController.php');
    $mantenimientoPersonaController = new MantenimientoPersonaController;
    $mantenimientoPersonaController->establishConnection();
    $arrayClientes = $mantenimientoPersonaController->busquedaClientePorDocumento($_GET['valorBusqueda']);

    $xml = "<?xml version='1.0' encoding='ISO-8859-1'?>";
    if (count($arrayClientes) > 0) {
        $xml.="<datos>";
        $xml.= "<existe>TRUE</existe>";
        $xml.= "<codigo><![CDATA[" . $arrayClientes[0][0] . "]]></codigo>";
        $xml.= "<razon><![CDATA[" . $arrayClientes[0][4] . "]]></razon>";
        $xml.= "<documento><![CDATA[" . $arrayClientes[0][5] . "]]></documento>";
        $xml.="</datos>";
    } else {
        
        $xml.="<datos>";
        $xml.= "<existe>FALSO</existe>";
        $xml.="</datos>";
    }
    header("Content-type: text/xml");
    echo $xml;
}
?>