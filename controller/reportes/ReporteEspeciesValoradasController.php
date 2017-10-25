<?php

include('../../utility/AbstractClass.php');
class ReporteEspeciesValoradasController extends AbstractClass {
    private $rutaEspecieValorada = '../../entity/operaciones/EspeciesValoradasEntity.php';
    private $claseEspecieValorada = 'EspeciesValoradasEntity';

    public function exportarReporteExcelEV() {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEspecieValorada,
                                                        $this->claseEspecieValorada);
        $resultadoListaEspecieValorada = $especiesValoradasEntity->obtenerEspecieValoradaReporte();

        $titulos = array('Numero de Certificado', 'Tipo', 'Lote', 'Proveedor', 'Fecha de Emision', 'Fecha de Vencimiento');

        include('../../utility/Exportar.php');
        $exportar = new Exportar;
        $exportar->exportarExcel($resultadoListaEspecieValorada,
                                $titulos,
                                'REPORTE DE ESPECIES VALORADAS',
                                'EspeciesValoradas');
    }

    public function reporteStockEnOficina() {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEspecieValorada,
                                                        $this->claseEspecieValorada);
        $resultadoreporteStockEnOficina = $especiesValoradasEntity->reporteStockEnOficina();

        $titulos = array('Numero de Certificado', 'Numero de Poliza', 'Proveedor');

        include('../../utility/Exportar.php');
        $exportar = new Exportar;
        $exportar->exportarExcel($resultadoreporteStockEnOficina,
                                $titulos,
                                'REPORTE DE STOCK EN OFICINA',
                                'stockEnOficina');
    }

    public function reporteDeCampo() {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEspecieValorada,
                                                        $this->claseEspecieValorada);
        $resultadoReporteCampo = $especiesValoradasEntity->reporteDeCampo();

        $titulos = array('Numero de Certificado', 'Proveedor', 'Punto de Venta', 'Fecha de Deposito', 'Fecha de Vencimiento', 'Dias Restantes', 'Condicion');

        include('../../utility/Exportar.php');
        $exportar = new Exportar;
        $exportar->exportarExcel($resultadoReporteCampo,
                                $titulos,
                                'REPORTE DE TRAZABILIDAD',
                                'trazabilidad');
    }

    public function reporteLiquidacionesPorFecha($fechaInicial,
                            $fechaFinal) {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEspecieValorada,
                                                        $this->claseEspecieValorada);
        $resultadoReporteCampo = $especiesValoradasEntity->reporteLiquidacionesPorFecha($fechaInicial,
                                $fechaFinal);

        $titulos = array('Numero de Certificado', 'Proveedor', 'Punto de Venta', 'Fecha de Liquidacion');

        include('../../utility/Exportar.php');
        $exportar = new Exportar;
        $exportar->exportarExcel($resultadoReporteCampo,
                                $titulos,
                                'REPORTE DE PLANILLA DE COBRANZA',
                                'planillacobranzaporfecha');
    }

    public function reporteDepositosPorFecha($fechaInicial,
                            $fechaFinal) {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEspecieValorada,
                                                        $this->claseEspecieValorada);
        $resultadoReporteCampo = $especiesValoradasEntity->reporteDepositosPorFecha($fechaInicial,
                                $fechaFinal);

        $titulos = array('Numero de Certificado', 'Proveedor', 'Punto de Venta', 'Fecha de Depósito');

        include('../../utility/Exportar.php');
        $exportar = new Exportar;
        $exportar->exportarExcel($resultadoReporteCampo,
                                $titulos,
                                'REPORTE DE PLANILLA DE VENTA',
                                'planillaventaporfecha');
    }
}
?>