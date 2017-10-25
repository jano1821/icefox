<?php

class IntermedioController {

    public function mostrarFormMantenimientoVehiculo($arrayVehiculo,
                            $indicadorAccesoExterno) {
        include('../../bean/generales/CatalogoConstraintBean.php');
        
        include('../../inc/ConectarBDInterface.php');
        $conectarBDInterface = new ConectarBDInterface;
        $conexion = $conectarBDInterface->conectar();

        include('../../entity/mantenimiento/MantenimientoMarcaVehiculoEntity.php');
        $mantenimientoMarcaVehiculoEntity = new MantenimientoMarcaVehiculoEntity($conexion);
        $resultadoMarcaVehiculo = $mantenimientoMarcaVehiculoEntity->obtenerListaMarcas('');

        $arrayMarcaVehiculo = array();
        while ($row = $resultadoMarcaVehiculo->fetch_array()) {
            $arrayMarcaVehiculo[] = $row;
        }
        
        include('../../entity/general/CatalogoConstraintEntity.php');
        $catalogoConstraintEntity = new CatalogoConstraintEntity($conexion,false);
        $resultadoClaseVehiculo = $catalogoConstraintEntity->obtenerListaConstraint('claseVehiculo','vehiculo');

        $arrayClaseVehiculo = array();
        while ($row = $resultadoClaseVehiculo->fetch_array()) {
            $catalogoConstraintBean = new CatalogoConstraintBean;
            $catalogoConstraintBean->setValor($row[0]);
            $catalogoConstraintBean->setDescripcion($row[1]);
            
            array_push($arrayClaseVehiculo,
                                    $catalogoConstraintBean);
        }

        $catalogoConstraintEntity->cerrarConexion();
        
        include('../../view/mantenimientos/FormMantenimientoVehiculo.php');
        $formMantenimientoVehiculo = new FormMantenimientoVehiculo;
        $formMantenimientoVehiculo->mostrarFormMantenimientoVehiculo($arrayVehiculo,
                                $arrayMarcaVehiculo,
                                $arrayClaseVehiculo,
                                $indicadorAccesoExterno);
    }
}
?>