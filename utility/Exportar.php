<?php

class Exportar {

    public function exportarExcel($resultado,
                            $titulos,
                            $tituloDocumento,
                            $nombreArchivo) {
        if (PHP_SAPI == 'cli')
            die('Este ejemplo sólo se puede ejecutar desde un navegador Web');

        /** Incluye PHPExcel */
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
        // Crear nuevo objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        // Propiedades del documento
        $objPHPExcel->getProperties()->setCreator("Alejandro Nuñez")
                                ->setLastModifiedBy("Alejandro Nuñez")
                                ->setTitle('Especies Valoradas')
                                ->setSubject("Office 2010 XLSX Documento")
                                ->setDescription("Documento generado por icefox")
                                ->setKeywords("office 2010 openxml php")
                                ->setCategory("Reporte");



        // Combino las celdas desde A1 hasta la cantidad de celdas que conrresponda
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:' . $this->obtenerFinalDeCeldas(count($titulos)) . '1');

        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A1',
                                                        $tituloDocumento);
        $cel = 2;
        for ($i = 0; $i < count($titulos); $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( $this->obtenerFinalDeCeldas($i + 1).$cel, $titulos[$i]);
        }

        // Fuente de la primera fila en negrita
        $boldArray = array('font' => array('bold' => true,), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

        $objPHPExcel->getActiveSheet()->getStyle($this->obtenerFinalDeCeldas(1).'1:'.$this->obtenerFinalDeCeldas(count($titulos)).'2')->applyFromArray($boldArray);

        //Ancho de las columnas

        for ($i = 0; $i < count($titulos); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($this->obtenerFinalDeCeldas($i + 1))->setWidth(30);
        }

        $cel = 3;
        while ($row = $resultado->fetch_array()) {
            // Agregar datos
            for ($i = 0; $i < count($titulos); $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->obtenerFinalDeCeldas($i+1).$cel,$row[$i]);
            }
            $cel+=1;
        }

        $rango = 'A3:'.$this->obtenerFinalDeCeldas(count($titulos)).$cel;
        $styleArray = array('font' => array('name' => 'Arial', 'size' => 10),
                        'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FFF')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
        // Cambiar el nombre de hoja de cálculo
        $objPHPExcel->getActiveSheet()->setTitle('libro 1');


        // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirigir la salida al navegador web de un cliente ( Excel5 )
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '.xls"');
        header('Cache-Control: max-age=0');
        // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
        header('Cache-Control: max-age=1');

        // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,
                                                        'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    private function obtenerFinalDeCeldas($cantidadTitulos) {
        $letra = '';
        switch ($cantidadTitulos) {
            case 1:
                $letra = 'A';
                break;
            case 2:
                $letra = 'B';
                break;
            case 3:
                $letra = 'C';
                break;
            case 4:
                $letra = 'D';
                break;
            case 5:
                $letra = 'E';
                break;
            case 6:
                $letra = 'F';
                break;
            case 7:
                $letra = 'G';
                break;
            case 8:
                $letra = 'H';
                break;
            case 9:
                $letra = 'I';
                break;
            case 10:
                $letra = 'J';
                break;
            case 11:
                $letra = 'K';
                break;
            case 12:
                $letra = 'L';
                break;
            case 13:
                $letra = 'M';
                break;
            case 14:
                $letra = 'N';
                break;
            case 15:
                $letra = 'O';
                break;
            case 16:
                $letra = 'P';
                break;
            case 17:
                $letra = 'Q';
                break;
            case 18:
                $letra = 'R';
                break;
            case 19:
                $letra = 'S';
                break;
            case 20:
                $letra = 'T';
                break;
            case 21:
                $letra = 'U';
                break;
            case 22:
                $letra = 'V';
                break;
            case 23:
                $letra = 'W';
                break;
            case 24:
                $letra = 'X';
                break;
            case 25:
                $letra = 'Y';
                break;
            case 26:
                $letra = 'Z';
                break;
        }

        return $letra;
    }
}
;
