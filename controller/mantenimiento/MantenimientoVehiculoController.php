<?php

include('../../utility/AbstractClass.php');
class MantenimientoVehiculoController extends AbstractClass {
    private $rutaMantenimientoVehiculo = '../../entity/mantenimiento/MantenimientoVehiculoEntity.php';
    private $claseMantenimientoVehiculo = 'MantenimientoVehiculoEntity';
    private $rutaMantenimientoModeloVehiculoEntity = '../../entity/mantenimiento/MantenimientoModeloVehiculoEntity.php';
    private $claseMantenimientoModeloVehiculoEntity = 'MantenimientoModeloVehiculoEntity';
    private $rutaMantenimientoMarcaVehiculoEntity = '../../entity/mantenimiento/MantenimientoMarcaVehiculoEntity.php';
    private $claseMantenimientoMarcaVehiculoEntity = 'MantenimientoMarcaVehiculoEntity';

    private function obtenerCantidadPaginas($mantenimientoVehiculoEntity,
                            $numeroPlaca,
                            $cantidad) {
        $result = $mantenimientoVehiculoEntity->obtenerCantidadRegistros($numeroPlaca);
        $paginas = 0;

        $row = $result->fetch_assoc();

        if ($row["cant"] > 0) {
            $paginas = floor($row["cant"] / $cantidad);
            $resto = $row["cant"] % $cantidad;
        }else {
            $resto = 1;
        }

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    public function buscarVehiculoPorCliente($numeroPlaca) {

        $mantenimientoVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoVehiculo,
                                                        $this->claseMantenimientoVehiculo);

        $result = $mantenimientoVehiculoEntity->obtenerCantidadRegistros($numeroPlaca);
        $row = $result->fetch_assoc();
        if ($row["cant"] == 1) {
            $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                            parent::getConnection());

            $cantPaginas = $this->obtenerCantidadPaginas($mantenimientoVehiculoEntity,
                                    $numeroPlaca,
                                    $cantidad);

            if ($can) {
                buscaVehiculoPorPlaca();
            }
        }else if ($row["cant"] == 0) {
            echo '<script language="javascript">alert("");</script>';
        }

        $resultadoListaVentas = $ventasEntity->obtenerListaVentasTabla($numeroCertificado,
                                $numeroPlaca,
                                $fechaVentaInicial,
                                $fechaVentaFinal,
                                $puntoVenta,
                                $limite,
                                $cantidad);

        $mantenimientoVehiculoEntity->cerrarConexion();
    }

    public function buscarVehiculoPorPlaca($numeroPlaca) {

        $mantenimientoVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoVehiculo,
                                                        $this->claseMantenimientoVehiculo);

        $result = $mantenimientoVehiculoEntity->obtenerCantidadRegistrosVehiculo($numeroPlaca);
        $row = $result->fetch_assoc();
        
        
        $arrayResultados = array();
        if ($row["cant"]>0){
            $arrayDatos = array();
            $resultadoBusqueda = $mantenimientoVehiculoEntity->obtenerVehiculoPorPlaca($numeroPlaca);
            
            while ($rowVehiculo = $resultadoBusqueda->fetch_array()) {
                $arrayDatos[] = $rowVehiculo;
            }
            
            $arrayResultados = array($arrayDatos[0][0],$arrayDatos[0][1]);
        }else{
            $arrayResultados = array('0');
        }

        $mantenimientoVehiculoEntity->cerrarConexion();
        
        return $arrayResultados;
    }

    /*public function buscarVehiculoPorClienteAndPlaca($codCliente,
                            $numeroPlaca) {

        $mantenimientoVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoVehiculo,
                                                        $this->claseMantenimientoVehiculo);

        $result = $mantenimientoVehiculoEntity->obtenerCantidadRegistrosVehiculo($codCliente,
                                $numeroPlaca);
        $row = $result->fetch_assoc();

        $mantenimientoVehiculoEntity->cerrarConexion();

        return $row["cant"];
    }*/

    public function mostrarFormMantenimientoVehiculo($arrayVehiculo,
                            $indicadorAccesoExterno) {
        $arrayMarcaVehiculo = array();

        $mantenimientoMarcaVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoMarcaVehiculoEntity,
                                                        $this->claseMantenimientoMarcaVehiculoEntity);
        $resultadoMarcaVehiculo = $mantenimientoMarcaVehiculoEntity->obtenerListaMarcas('');

        $arrayMarcaVehiculo = parent::_procesarLista($resultadoMarcaVehiculo);

        include('../../view/mantenimientos/FormMantenimientoVehiculo.php');
        $formMantenimientoVehiculo = new FormMantenimientoVehiculo;
        $formMantenimientoVehiculo->mostrarFormMantenimientoVehiculo(array(),
                                $arrayMarcaVehiculo,
                                $indicadorAccesoExterno);
    }

    public function obtenerListaModelos($codigoMarca,
                            $codigoSeleccion) {
        $mantenimientoModeloVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoModeloVehiculoEntity,
                                                        $this->claseMantenimientoModeloVehiculoEntity);
        $resultadoListaModelos = $mantenimientoModeloVehiculoEntity->obtenerModelos($codigoMarca);
        $arrayModelos = parent::_procesarLista($resultadoListaModelos);
        $mantenimientoModeloVehiculoEntity->cerrarConexion();

        $comboDinamico = parent::_armarComboBootstrap($arrayModelos,
                                                        'Modelo Vehiculo',
                                                        'modeloVehiculoCombo',
                                                        'Seleccionar Modelo',
                                                        '',
                                                        $codigoSeleccion);

        return $comboDinamico;
    }

    public function guardarVehiculo($validatorForm,
                            $codigo,
                            $nroAsientos,
                            $nroSerieMotor,
                            $nroRuedas,
                            $nroPuertas,
                            $usoVehiculo,
                            $anioFabricacion,
                            $claseVehiculo,
                            $nroPlaca,
                            $modeloVehiculo,
                            $persona,
                            $estadoRegistro) {
        $mantenimientoModeloVehiculoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaMantenimientoVehiculo,
                                                        $this->claseMantenimientoVehiculo);
        if ($validatorForm == 'N' || $validatorForm == 'W') {
            $codigo = 0;
            $resultado = $mantenimientoModeloVehiculoEntity->guardarVehiculoProc('N',
                                    $codigo,
                                    $nroAsientos,
                                    $nroSerieMotor,
                                    $nroRuedas,
                                    $nroPuertas,
                                    $usoVehiculo,
                                    $anioFabricacion,
                                    $claseVehiculo,
                                    $nroPlaca,
                                    $modeloVehiculo,
                                    $persona,
                                    $estadoRegistro);
        }else {
            $resultado = $mantenimientoModeloVehiculoEntity->guardarVehiculoProc('M',
                                    $codigo,
                                    $nroAsientos,
                                    $nroSerieMotor,
                                    $nroRuedas,
                                    $nroPuertas,
                                    $usoVehiculo,
                                    $anioFabricacion,
                                    $claseVehiculo,
                                    $nroPlaca,
                                    $modeloVehiculo,
                                    $persona,
                                    $estadoRegistro);
        }

        $mantenimientoModeloVehiculoEntity->cerrarConexion();

        return $resultado;
    }
}
?>