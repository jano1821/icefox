<?php

include('../../utility/AbstractClass.php');
class ReporteController extends AbstractClass {
    private $rutaReporteEntity = "../../entity/reporte/ReporteEntity.php";
    private $claseReporteEntity = "ReporteEntity";

    public function obtenerIdentificadorReporte($reporte) {
        $reporteEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaReporteEntity,
                                                        $this->claseReporteEntity);
        $idReporte = '';

        $resultadoListaParametros = $reporteEntity->obtenerIdentificadorReporte($reporte);

        $row = $resultadoListaParametros->fetch_assoc();

        if ($row["idReporte"] != '') {
            $idReporte = $row["idReporte"];
        }

        $reporteEntity->cerrarConexion();
        return $idReporte;
    }
}
?>

