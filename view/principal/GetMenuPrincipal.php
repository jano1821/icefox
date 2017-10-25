<?php

session_start();

if (isset($_POST['codigoMenu'])) {
    if ($_POST['codigoMenu'] != 'NN') {
        $conexion = null;

        include('../../controller/principal/MenuController.php');
        $menuController = new MenuController;
        $menuController->establishConnection();
        $menu = $menuController->obtenerMenuPorCodigo($_POST['codigoMenu']);
        $conexion = $menuController->getconnection();


        if ($menu[0][5] == 'ADSEOPXPE') {
            include('../..' . $menu[0][2]);
            $mantenimientoOpcionesPorPerfilController = new MantenimientoOpcionesPorPerfilController();
            $mantenimientoOpcionesPorPerfilController->setConnection($conexion);
            $mantenimientoOpcionesPorPerfilController->obtenerListaPerfiles('');
        }
        if ($menu[0][5] == 'MAPEUSUAR') {
            include('../..' . $menu[0][2]);
            $mantenimientoUsuariosController = new MantenimientoUsuariosController();
            $mantenimientoUsuariosController->setConnection($conexion);
            $mantenimientoUsuariosController->obtenerListaUsuarios('');
        }
        if ($menu[0][5] == 'MACOPERFIL') {
            include('../..' . $menu[0][2]);
            $mantenimientoPerfilesController = new MantenimientoPerfilesController();
            $mantenimientoPerfilesController->setConnection($conexion);
            $mantenimientoPerfilesController->obtenerListaPerfiles('');
        }
        if ($menu[0][5] == 'MAPEPERSO') {
            include('../..' . $menu[0][2]);
            $mantenimientoPersonaController = new MantenimientoPersonaController();
            $mantenimientoPersonaController->setConnection($conexion);
            $mantenimientoPersonaController->obtenerListaPersonasTabla('',
                                    '',
                                    '',
                                    '',
                                    '',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'OPREESPVAL') {
            include('../..' . $menu[0][2]);
            $especiesValoradasController = new EspeciesValoradasController();
            $especiesValoradasController->setConnection($conexion);
            $especiesValoradasController->obtenerListaEspeciesValoradas('',
                                    '',
                                    '',
                                    '',
                                    '',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'RELOREOPE') {
            include('../..' . $menu[0][2]);
            $LoteRegistroController = new LoteRegistroController();
            $LoteRegistroController->setConnection($conexion);
            $LoteRegistroController->obtenerListaLotes('',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'REPOESVA') {
            include('../..' . $menu[0][2]);
            $generadorReportesController = new GeneradorReportesController();
            $generadorReportesController->setConnection($conexion);
            $generadorReportesController->mostrarGeneradorReportesController();
        }
        if ($menu[0][5] == 'OPEHODEP') {
            include('../..' . $menu[0][2]);
            $depositosController = new DepositosController;
            $depositosController->setConnection($conexion);
            $depositosController->obtenerListaDepositos('',
                                    '',
                                    '',
                                    '',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'OPEHOLIQ') {
            include('../..' . $menu[0][2]);
            $liquidacionesController = new LiquidacionesController;
            $liquidacionesController->setConnection($conexion);
            $liquidacionesController->obtenerListaLiquidaciones('',
                                    '',
                                    '',
                                    '',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'COEVVENTA') {
            include('../..' . $menu[0][2]);
            $registroEspeciesValoradasLiquidadasController = new RegistroEspeciesValoradasLiquidadasController;
            $registroEspeciesValoradasLiquidadasController->setConnection($conexion);
            $registroEspeciesValoradasLiquidadasController->obtenerListaRegistroEspeciesValoradasLiquidadas('',
                                    '',
                                    '',
                                    0,
                                    1);
        }
        if ($menu[0][5] == 'COMEDVEN') {
            include('../..' . $menu[0][2]);
            $registroEspeciesValoradasLiquidadasController = new RegistroEspeciesValoradasLiquidadasController;
            $registroEspeciesValoradasLiquidadasController->setConnection($conexion);
            $registroEspeciesValoradasLiquidadasController->obtenerListaRegistroEspeciesValoradasLiquidadas('',
                                    '',
                                    '',
                                    0,
                                    1);
        }
    }
}
?>