<?php

include('../../utility/AbstractClass.php');
class GeneradorReportesController extends AbstractClass {
    private $rutaReporteEntity = "../../entity/reporte/ReporteEntity.php";
    private $claseReporteEntity = "ReporteEntity";

    public function mostrarGeneradorReportesController() {
        $reporteEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaReporteEntity,
                                                        $this->claseReporteEntity);

        $resultadoReporte = $reporteEntity->obtenerGrupoReporte();
        $reporteEntity->cerrarConexion();

        include ('../../bean/reportes/GrupoReporteBean.php');

        $arrayDatos = array();
        while ($row = $resultadoReporte->fetch_array()) {
            $grupoReporteBean = new GrupoReporteBean;
            $grupoReporteBean->setCodGrupo($row[0]);
            $grupoReporteBean->setDescripcionGrupo($row[1]);

            array_push($arrayDatos,
                                    $grupoReporteBean);
        }

        include('../../view/reportes/GeneradorDeReportes.php');
        $generadorDeReportes = new GeneradorDeReportes;
        $generadorDeReportes->mostrarGeneradorDeReportes($arrayDatos);
    }

    public function obtenerIdentificadorReporte($reporte) {
        /* $reporteEntity = parent::_declaraEntity(parent::getConnection(),
          $this->rutaReporteEntity,
          $this->claseReporteEntity);
          $idReporte = '';

          $resultadoListaParametros = $reporteEntity->obtenerIdentificadorReporte($reporte);

          $row = $resultadoListaParametros->fetch_assoc();

          if ($row["idReporte"] != '') {
          $idReporte = $row["idReporte"];
          }

          $reporteEntity->cerrarConexion(); */
        return $idReporte . 'yy';
    }

    public function obtenerListaSubGrupoReporte($grupo) {
        $reporteEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaReporteEntity,
                                                        $this->claseReporteEntity);
        $resultadoListaSubGrupos = $reporteEntity->obtenerSubGrupoReporte($grupo);
        $arraySubGrupos = parent::_procesarLista($resultadoListaSubGrupos);
        $reporteEntity->cerrarConexion();

        $comboDinamico = parent::_armarComboBootstrap($arraySubGrupos,
                                                        'Sub Grupo',
                                                        'subGrupo',
                                                        'Seleccionar Sub Grupo',
                                                        'obtenerReportes(this.value);',
                                                        '');

        return $comboDinamico;
    }

    public function obtenerListaReportes($subGrupo) {
        $reporteEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaReporteEntity,
                                                        $this->claseReporteEntity);
        $arrayReportes = array();

        $resultadoListaReportes = $reporteEntity->obtenerReportes($subGrupo);

        $arrayReportes = parent::_procesarLista($resultadoListaReportes);
        $reporteEntity->cerrarConexion();

        $arrayTitulos = array("", "Nombre Reporte");
        $arrayBotones = array();
        $arrayFunciones = array();
        $arrayModal = array("obtenerParametros", "Seleccionar", "", "glyphicon glyphicon-record"); //separado

        $htmlTabla = parent::_armarTablaEspecialConFuncionesModalNew($arrayTitulos,
                                                        $arrayReportes,
                                                        '',
                                                        '',
                                                        false,
                                                        $arrayBotones,
                                                        $arrayFunciones,
                                                        $arrayModal);

        return $htmlTabla;
    }

    public function obtenerListaParametros($reporte) {
        $reporteEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaReporteEntity,
                                                        $this->claseReporteEntity);

        $resultadoListaParametros = $reporteEntity->obtenerParametros($reporte);

        $arrayParametros = parent::_procesarLista($resultadoListaParametros);
        $reporteEntity->cerrarConexion();

        $htmlTabla = parent::_armarTablaParametros($arrayParametros);

        return $htmlTabla;
    }
}
?>