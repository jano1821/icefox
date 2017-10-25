<?php

include('../../utility/AbstractClass.php');

class DepositosController extends AbstractClass {

    private $rutaDespositos = '../../entity/operaciones/DepositosEntity.php';
    private $claseDepositos = 'DepositosEntity';
    private $rutaPersona = '../../entity/mantenimiento/MantenimientoPersonaEntity.php';
    private $clasePersona = 'MantenimientoPersonaEntity';
    private $rutaEspecieValorada = '../../entity/operaciones/EspeciesValoradasEntity.php';
    private $claseEspecieValorada = 'EspeciesValoradasEntity';
    private $rutaLote = '../../entity/operaciones/LoteRegistroEntity.php';
    private $claseLote = 'LoteRegistroEntity';
    private $rutaDepositoProducto = '../../entity/operaciones/DepositoProductoEntity.php';
    private $claseDepositoProducto = 'DepositoProductoEntity';

    private function procesarListaDepositos($resultadoListaDepositos) {
        $arrayDatos = array();
        while ($row = $resultadoListaDepositos->fetch_array()) {
            $arrayDatos[] = $row;
        }

        $arrayTitulos = array("", "Serie", "Numero", "Gestor de Campo", "Punto de venta");
        $arrayBotones = array("Editar", "Eliminar");

        $htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,
                        $arrayDatos,
                        $arrayBotones);

        return $htmlTabla;
    }

    private function invocarTablaDepositos($htmlTabla,
            $arrayEmpleados,
            $arrayPuntoVenta,
            $serie,
            $numero,
            $empleado,
            $puntoVenta,
            $pagina,
            $cantPaginas) {
        include('../../view/operaciones/TablaDepositos.php');

        $tablaDepositos = new TablaDepositos;
        $tablaDepositos->mostrarTablaDepositos($htmlTabla,
                $arrayEmpleados,
                $arrayPuntoVenta,
                $serie,
                $numero,
                $empleado,
                $puntoVenta,
                $pagina,
                $cantPaginas);
    }

    private function enviaCabeceraDetalleTablaEspecieValorada($resultadoEspeciesValoradas) {
        $arrayTitulos = array("", "Numero Certificado", "Tipo", "Lote", "Proveedor");
        $arrayBotones = array("Seleccionar");
        $arrayDatos = parent::_procesarLista($resultadoEspeciesValoradas);

        $htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,
                        $arrayDatos,
                        $arrayBotones);


        return $htmlTabla;
    }

    private function obtenerCantidadPaginas($depositosEntity,
            $serie,
            $numero,
            $empleado,
            $puntoVenta,
            $cantidad) {
        $result = $depositosEntity->obtenerCantidadRegistros($serie,
                $numero,
                $empleado,
                $puntoVenta);
        $paginas = 0;

        $row = $result->fetch_assoc();

        if ($row["cant"] > 0) {
            $paginas = floor($row["cant"] / $cantidad);
            $resto = $row["cant"] % $cantidad;
        } else {
            $resto = 1;
        }

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    private function obtenerCantidadPaginasEspeciesValoradas($especiesValoradasEntity,
            $cantidad,
            $numeroCertificado) {
        $result = $especiesValoradasEntity->obtenerCantidadRegistrosParaBusqueda($numeroCertificado);
        $paginas = 0;

        $row = $result->fetch_assoc();

        if ($row["cant"] > 0) {
            $paginas = floor($row["cant"] / $cantidad);
            $resto = $row["cant"] % $cantidad;
        } else {
            $resto = 1;
        }

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    public function mostrarRegistroDepositos($codigo) {
        $arrayDeposito = array();
        $arrayDepositoProducto = array();

        if ($codigo != '') {
            $depositosEntity = parent::_declaraEntity(parent::getConnection(),
                            $this->rutaDespositos,
                            $this->claseDepositos);
            $resultadoDesposito = $depositosEntity->obtenerDeposito($codigo);

            while ($row = $resultadoDesposito->fetch_array()) {
                $arrayDeposito[] = $row;
            }

            $depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),
                            $this->rutaDepositoProducto,
                            $this->claseDepositoProducto);
            $resultadoDespositoProducto = $depositoProductoEntity->obtenerListaProductosPorDeposito($codigo);

            while ($row = $resultadoDespositoProducto->fetch_array()) {
                $arrayDepositoProducto[] = $row;
            }
        }

        $arrayEmpleados = array();
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaPersona,
                        $this->clasePersona);
        $resultadoListaEmpleados = $mantenimientoPersonaEntity->obtenerListaEmpleados('',
                'S');

        while ($row = $resultadoListaEmpleados->fetch_array()) {
            $arrayEmpleados[] = $row;
        }

        $arrayPuntoVenta = array();
        $resultadoListaPuntoVenta = $mantenimientoPersonaEntity->obtenerListaPuntosDeVenta('',
                'S');

        while ($row = $resultadoListaPuntoVenta->fetch_array()) {
            $arrayPuntoVenta[] = $row;
        }



        include('../../view/operaciones/FormDepositos.php');
        $formDepositos = new FormDepositos;
        $formDepositos->mostrarFormDepositos($arrayDepositoProducto,
                $arrayDeposito,
                $arrayEmpleados,
                $arrayPuntoVenta);
    }

    public function obtenerListaDepositos($serie,
            $numero,
            $empleado,
            $puntoVenta,
            $pagina,
            $direccion) {
        $depositosEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaDespositos,
                        $this->claseDepositos);

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($depositosEntity,
                $serie,
                $numero,
                $empleado,
                $puntoVenta,
                $cantidad);

        if ($direccion == '-1') {
            if ($pagina == 1) {
                echo '<script language="javascript">alert("No hay registros anteriores");</script>';
            } else {
                $pagina = $pagina - 1;
            }
        }

        if ($direccion == '1') {
            if ($pagina >= $cantPaginas) {
                echo '<script language="javascript">alert("No hay registros posteriores");</script>';
            } else {
                $pagina = $pagina + 1;
            }
        }

        $arrayEmpleados = array();
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaPersona,
                        $this->clasePersona);
        $resultadoListaEmpleados = $mantenimientoPersonaEntity->obtenerListaEmpleados('',
                'S');

        while ($row = $resultadoListaEmpleados->fetch_array()) {
            $arrayEmpleados[] = $row;
        }

        $arrayPuntoVenta = array();
        $resultadoListaPuntoVenta = $mantenimientoPersonaEntity->obtenerListaPuntosDeVenta('',
                'S');

        while ($row = $resultadoListaPuntoVenta->fetch_array()) {
            $arrayPuntoVenta[] = $row;
        }

        $limite = $cantidad * ($pagina - 1);
        $resultadoListaDepositos = $depositosEntity->obtenerListaDepositosTabla($serie,
                $numero,
                $empleado,
                $puntoVenta,
                $limite,
                $cantidad);

        $depositosEntity->cerrarConexion();

        $htmlTabla = $this->procesarListaDepositos($resultadoListaDepositos);

        $this->invocarTablaDepositos($htmlTabla,
                $arrayEmpleados,
                $arrayPuntoVenta,
                $serie,
                $numero,
                $empleado,
                $puntoVenta,
                $pagina,
                $cantPaginas);
    }

    public function guardarDeposito($especiesValoradas,
            $validatorForm,
            $codigo,
            $metodo,
            $cantidadRegistros,
            $serie,
            $numero,
            $gestor,
            $punto,
            $fecha,
            $estadoRegistro,
            $pagina) {
        $depositosEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaDespositos,
                        $this->claseDepositos);
        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                        parent::getConnection());
        $id = "";
        $cantPaginas = $this->obtenerCantidadPaginas($depositosEntity,
                '',
                '',
                '',
                '',
                $cantidad);

        if ($validatorForm == 'N') {

            if ($metodo == 'I') {
                $id = $depositosEntity->insertarDeposito($serie,
                        $numero,
                        $gestor,
                        $punto,
                        $fecha,
                        $estadoRegistro);
                if ($id != null && $id != "" && $id > 0) {
                    $depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),
                                    $this->rutaDepositoProducto,
                                    $this->claseDepositoProducto);

                    for ($i = 0; $i < count($especiesValoradas); $i++) {
                        $depositoProductoEntity->insertarProductos($id,
                                $especiesValoradas[$i],
                                'S');
                    }
                }
            } else {
                for ($i = 0; $i < $cantidadRegistros; $i++) {
                    $poliza = $numero + $i;
                    $depositosEntity->insertarDeposito($serie,
                            $numero + $i,
                            $gestor,
                            $punto,
                            $fecha,
                            $estadoRegistro);
                }
            }
        } else if ($validatorForm == 'M') {
            $depositosEntity->modificarDeposito($codigo,
                    $serie,
                    $numero,
                    $gestor,
                    $punto,
                    $fecha,
                    $estadoRegistro);

            $depositoProductoEntity = parent::_declaraEntity(parent::getConnection(),
                            $this->rutaDepositoProducto,
                            $this->claseDepositoProducto);
            $depositoProductoEntity->modificarProductos($codigo);

            for ($i = 0; $i < count($especiesValoradas); $i++) {
                $depositoProductoEntity->insertarProductos($codigo,
                        $especiesValoradas[$i],
                        'S');
            }
        }

        $arrayEmpleados = array();
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaPersona,
                        $this->clasePersona);
        $resultadoListaEmpleados = $mantenimientoPersonaEntity->obtenerListaEmpleados('',
                'S');

        while ($row = $resultadoListaEmpleados->fetch_array()) {
            $arrayEmpleados[] = $row;
        }

        $arrayPuntoVenta = array();
        $resultadoListaPuntoVenta = $mantenimientoPersonaEntity->obtenerListaPuntosDeVenta('',
                'S');

        while ($row = $resultadoListaPuntoVenta->fetch_array()) {
            $arrayPuntoVenta[] = $row;
        }

        $limite = $cantidad * ($pagina - 1);
        $resultadoListaDepositos = $depositosEntity->obtenerListaDepositosTabla('',
                '',
                '',
                '',
                $limite,
                $cantidad);

        $depositosEntity->cerrarConexion();

        $htmlTabla = $this->procesarListaDepositos($resultadoListaDepositos);

        $this->invocarTablaDepositos($htmlTabla,
                $arrayEmpleados,
                $arrayPuntoVenta,
                '',
                '',
                '',
                '',
                $pagina,
                $cantPaginas);
    }

    public function mostrarBusquedaEspeciesValoradas($especies,
            $numeroCertificado,
            $pagina,
            $direccion) {
        $resultadoCarga = '';
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaEspecieValorada,
                        $this->claseEspecieValorada);

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginasEspeciesValoradas($especiesValoradasEntity,
                $cantidad,
                $numeroCertificado);

        if ($direccion == '-1') {
            if ($pagina == 1) {
                echo '<script language="javascript">alert("No hay registros anteriores");</script>';
            } else {
                $pagina = $pagina - 1;
            }
        }

        if ($direccion == '1') {
            if ($pagina >= $cantPaginas) {
                echo '<script language="javascript">alert("No hay registros posteriores");</script>';
            } else {
                $pagina = $pagina + 1;
            }
        }

        $arrayProveedores = array();
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaPersona,
                        $this->clasePersona);
        $resultadoListaProveedores = $mantenimientoPersonaEntity->obtenerListaProveedores('',
                'S');

        while ($row = $resultadoListaProveedores->fetch_array()) {
            $arrayProveedores[] = $row;
        }

        $limite = $cantidad * ($pagina - 1);
        $resultadoListaEspecieValorada = $especiesValoradasEntity->obtenerListaEspecieValoradaSeleccion($especies,
                $numeroCertificado,
                $limite,
                $cantidad);
        $especiesValoradasEntity->cerrarConexion();

        $htmlTabla = $this->enviaCabeceraDetalleTablaEspecieValorada($resultadoListaEspecieValorada);

        include('../../view/operaciones/FormDetalleEspeciesValoradas.php');
        $formDetalleEspeciesValoradas = new FormDetalleEspeciesValoradas;
        $formDetalleEspeciesValoradas->mostrarFormDetalleEspeciesValoradas($especies,
                $htmlTabla,
                $numeroCertificado,
                $pagina,
                $cantPaginas,
                $resultadoCarga);
    }

}

;
?>