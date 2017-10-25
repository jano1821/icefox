<?php

class AbstractClass {
    private $conexion = null;

    public function completaCadena($cadena,
                            $tamanio,
                            $simbolo,
                            $alineacion) {
        if ($alineacion == "B") {
            $cadena = str_pad($cadena,
                                    $tamanio,
                                    $simbolo,
                                    STR_PAD_BOTH);
        }
        if ($alineacion == "I") {
            $cadena = str_pad($cadena,
                                    $tamanio,
                                    $simbolo,
                                    STR_PAD_LEFT);
        }
        if ($alineacion = "D") {
            $cadena = str_pad($cadena,
                                    $tamanio,
                                    $simbolo,
                                    STR_PAD_RIGHT);
        }
        return $cadena;
    }

    public function _strlen($cadena,
                            $indexColumnasEspacio) {
        if ($indexColumnasEspacio == "true") {
            return strlen($cadena);
        }else {
            return strlen(trim($cadena));
        }
    }

    public function _sesionActiva() {

        $URL = $_SESSION['URL'];

        if ($_SESSION["autenticado"] != "SI") {
            session_destroy();
            include("../../view/generales/SessionExpirada.php");
            $sessionExpirada = new SessionExpirada;
            $sessionExpirada->mostrarSessionExpirada($URL);
            return false;
        }else {
            try {
                $fechaGuardada = $_SESSION["ultimoAcceso"];
            }catch (Exception $indexColumnas) {
                $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
            }
            $ahora = date("Y-n-j H:i:s");
            $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));

            if ($tiempo_transcurrido >= 1200) {
                session_destroy();
                include("../../view/generales/SessionExpirada.php");
                $sessionExpirada = new SessionExpirada;
                $sessionExpirada->mostrarSessionExpirada($URL);
                return false;
            }else {
                $_SESSION["ultimoAcceso"] = $ahora;
                return true;
            }
        }
    }

    public function _devuelveCantidadDias($mes,
                            $anio) {
        switch ($mes) {
            case 1:
                return 31;
                break;
            case 2:
                if ($this->_isBisiesto($anio) == 1) {
                    return 29;
                }else {
                    return 28;
                }
                break;
            case 3:
                return 31;
                break;
            case 4:
                return 30;
                break;
            case 5:
                return 31;
                break;
            case 6:
                return 30;
                break;
            case 7:
                return 31;
                break;
            case 8:
                return 31;
                break;
            case 9:
                return 30;
                break;
            case 10:
                return 31;
                break;
            case 11:
                return 30;
                break;
            case 12:
                return 31;
                break;
        }
    }

    public function _isBisiesto($anio) {
        if (($anio % 4 == 0 && $anio % 100 != 0) || $anio % 400 == 0) {
            return 1;
        }else {
            return 0;
        }
    }

    public function _devuelveDiaLetras($dia) {
        switch ($dia) {
            case 0:
                return "Domingo";
                break;
            case 1:
                return "Lunes";
                break;
            case 2:
                return "Martes";
                break;
            case 3:
                return "Miercoles";
                break;
            case 4:
                return "Jueves";
                break;
            case 5:
                return "Viernes";
                break;
            case 6:
                return "Sabado";
                break;
        }
    }

    public function _devuelveMesLetras($mes) {
        switch ($mes) {
            case 1:
                return "Enero";
                break;
            case 2:
                return "Febrero";
                break;
            case 3:
                return "Marzo";
                break;
            case 4:
                return "Abril";
                break;
            case 5:
                return "Mayo";
                break;
            case 6:
                return "Junio";
                break;
            case 7:
                return "Julio";
                break;
            case 8:
                return "Agosto";
                break;
            case 9:
                return "Setiembre";
                break;
            case 10:
                return "Octubre";
                break;
            case 11:
                return "Noviembre";
                break;
            case 12:
                return "Diciembre";
                break;
        }
    }

    public function _armarTabla($arrayTitulos,
                            $arrayDatos,
                            $arrayBotones) {
        return $this->_armarTablaEspecialConFunciones($arrayTitulos,
                                                        $arrayDatos,
                                                        '',
                                                        '',
                                                        true,
                                                        $arrayBotones,
                                                        array());
    }

    public function _armarTablaSinCodigoVisible($arrayTitulos,
                            $arrayDatos,
                            $arrayBotones) {
        return $this->_armarTablaEspecialConFunciones($arrayTitulos,
                                                        $arrayDatos,
                                                        '',
                                                        '',
                                                        false,
                                                        $arrayBotones,
                                                        array());
    }

    public function _armarTablaEspecial($arrayTitulos,
                            $arrayDatos,
                            $tipoDatoEspecial,
                            $columnaDatosEspecial,
                            $mostrarCodigo,
                            $arrayBotones) {
        return $this->_armarTablaEspecialConFunciones($arrayTitulos,
                                                        $arrayDatos,
                                                        $tipoDatoEspecial,
                                                        $columnaDatosEspecial,
                                                        false,
                                                        $arrayBotones,
                                                        array());
    }

    public function _armarTablaEspecialConFunciones($arrayTitulos,
                            $arrayDatos,
                            $tipoDatoEspecial,
                            $columnaDatosEspecial,
                            $mostrarCodigo,
                            $arrayBotones,
                            $arrayFuncionesJS) {
        $htmlTabla = '';

        if ($this->_strlen($tipoDatoEspecial,
                                                        "false") == 0) {

            $htmlTabla .= '<table>';

            $htmlTabla .= '<thead><tr>';
            if ($columnaDatosEspecial == true) {
                $htmlTabla .= '<th></th>';
            }
            for ($i = 0; $i < count($arrayTitulos); $i++) {
                $htmlTabla .= '<th>' . $arrayTitulos[$i] . '</th>';
            }
            for ($indexBotones = 0; $indexBotones < count($arrayBotones); $indexBotones++) {
                $htmlTabla .= '<th></th>';
            }
            $htmlTabla .= '</tr></thead>';

            $htmlTabla .= '<tbody>';
            for ($indexFilas = 0; $indexFilas < count($arrayDatos); $indexFilas++) {
                $htmlTabla .= '<tr>';

                if ($columnaDatosEspecial == true) {
                    $htmlTabla .= '<td><input type="checkbox" name="datos[]" id="datos" value="' . $arrayDatos[$indexFilas][0] . '"></td>';
                }

                for ($indexColumnas = 0; $indexColumnas < count($arrayTitulos); $indexColumnas++) {
                    if ($mostrarCodigo == true && $indexColumnas == 0) {
                        $htmlTabla .= '<td>' . $arrayDatos[$indexFilas][$indexColumnas] . '</td>';
                    }elseif ($mostrarCodigo == false && $indexColumnas == 0) {
                        $htmlTabla .= '<td></td>';
                    }
                    if ($indexColumnas > 0) {
                        $htmlTabla .= '<td>' . $arrayDatos[$indexFilas][$indexColumnas] . '</td>';
                    }
                }
                for ($indexBotones = 0; $indexBotones < count($arrayBotones); $indexBotones++) {
                    if (count($arrayFuncionesJS) > 0) {
                        $htmlTabla .= '<td><a class="ovalbutton" href="javascript:' . $arrayFuncionesJS[$indexBotones] . '(\'' . $arrayDatos[$indexFilas][0] . '\');"><span>' . $arrayBotones[$indexBotones] . '</span></a></td>';
                    }else {
                        $htmlTabla .= '<td><a class="ovalbutton" href="javascript:envioFormulario(\'' . $arrayDatos[$indexFilas][0] . '\');"><span>' . $arrayBotones[$indexBotones] . '</span></a></td>';
                    }
                }
                $htmlTabla .= '</tr>';
            }

            $htmlTabla .= '</tbody>';

            $htmlTabla .= '</table>';
        }
        return $htmlTabla;
    }

    public function _armarTablaEspecialConFuncionesNew($arrayTitulos,
                            $arrayDatos,
                            $tipoDatoEspecial,
                            $columnaDatosEspecial,
                            $mostrarCodigo,
                            $arrayBotones,
                            $arrayFuncionesJS) {
        $this->_armarTablaEspecialConFuncionesModalNew($arrayTitulos,
                                $arrayDatos,
                                $tipoDatoEspecial,
                                $columnaDatosEspecial,
                                $mostrarCodigo,
                                $arrayBotones,
                                $arrayFuncionesJS,
                                array());
    }

    public function _armarTablaEspecialConFuncionesModalNew($arrayTitulos,
                            $arrayDatos,
                            $tipoDatoEspecial,
                            $columnaDatosEspecial,
                            $mostrarCodigo,
                            $arrayBotones,
                            $arrayFuncionesJS,
                            $arrayModal)/* el array modal trae cuatro argumentos */
    /* el primero es nombre de la opcion, el */
    /* segundo es el estilo del boton, el tercero */
    /* es el id en case sea llamado como ventana */
    /* flotante y el cuearto es la funcion javascript */
    /* que llamaria adicionalmente si se requiere */ {
        $htmlTabla = '';

        if ($this->_strlen($tipoDatoEspecial,
                                                        "false") == 0) {

            $htmlTabla .= '<div class="table-responsive">';
            $htmlTabla .= '<table class="table">';

            $htmlTabla .= '<tr class="info">';
            if ($columnaDatosEspecial == true) {
                $htmlTabla .= '<th></th>';
            }
            for ($i = 0; $i < count($arrayTitulos); $i++) {
                $htmlTabla .= '<th>' . $arrayTitulos[$i] . '</th>';
            }
            if (isset($arrayModal)) {
                if (count($arrayModal) > 0) {
                    $htmlTabla .= '<td></td>';
                }
            }
            for ($indexBotones = 0; $indexBotones < count($arrayBotones); $indexBotones++) {
                $htmlTabla .= '<th></th>';
            }
            $htmlTabla .= '</tr>';


            for ($indexFilas = 0; $indexFilas < count($arrayDatos); $indexFilas++) {
                $htmlTabla .= '<tr>';

                if ($columnaDatosEspecial == true) {
                    $htmlTabla .= '<td style="width:250px;"><input type="checkbox" name="datos[]" id="datos" value="' . $arrayDatos[$indexFilas][0] . '"></td>';
                }

                for ($indexColumnas = 0; $indexColumnas < count($arrayTitulos); $indexColumnas++) {
                    if ($mostrarCodigo == true && $indexColumnas == 0) {
                        $htmlTabla .= '<td>' . $arrayDatos[$indexFilas][$indexColumnas] . '</td>';
                    }elseif ($mostrarCodigo == false && $indexColumnas == 0) {
                        $htmlTabla .= '<td></td>';
                    }
                    if ($indexColumnas > 0) {
                        $htmlTabla .= '<td>' . $arrayDatos[$indexFilas][$indexColumnas] . '</td>';
                    }
                }

                $htmlTabla .= '<td><span class="pull-right">';
                if (count($arrayModal) > 0) {
                    $htmlTabla .= '<a ';
                    if (isset($arrayModal[0])) {
                        if ($arrayModal[0] != '') {
                            $htmlTabla .= 'href="javascript:' . $arrayModal[0] . '(' . $arrayDatos[$indexFilas][0] . ');" ';
                        }
                    }
                    $htmlTabla .= 'class="btn btn-info" ';
                    if (isset($arrayModal[1])) {
                        $htmlTabla .= 'title="' . $arrayModal[1] . '" ';
                    }
                    if (isset($arrayModal[2])) {
                        if ($arrayModal[2] != '') {
                            $htmlTabla .= ' data-toggle="modal" ';
                            $htmlTabla .= ' data-target="' . $arrayModal[2] . '" ';
                        }
                    }
                    $htmlTabla .= '><i ';
                    if (isset($arrayModal[3])) {
                        $htmlTabla .= 'class="' . $arrayModal[3] . '" ';
                    }
                    $htmlTabla .= '></i></a>';
                }
                for ($indexBotones = 0; $indexBotones < count($arrayBotones); $indexBotones++) {
                    if (count($arrayFuncionesJS) > 0) {
                        $htmlTabla .= '<a href="#" class="btn btn-default" title="' . $arrayBotones[$indexBotones] . '" onclick="' . $arrayFuncionesJS[$indexBotones] . '(\'' . $arrayDatos[$indexFilas][0] . '\');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>';
                    }else {
                        $htmlTabla .= '<a href="#" class="btn btn-default" title="' . $arrayBotones[$indexBotones] . '" onclick="javascript:envioFormulario(\'' . $arrayDatos[$indexFilas][0] . '\');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>';
                    }
                }

                $htmlTabla .= '</span></td>';
                $htmlTabla .= '</tr>';
            }

            $htmlTabla .= '</table>';
            $htmlTabla .= '</div>';
        }
        return $htmlTabla;
    }

    public function establishConnection() {
        include('../../inc/ConectarBD.php');
        $conectarBD = new ConectarBD;
        $conexion = $conectarBD->conectar();

        $this->conexion = $conexion;
    }

    public function getConnection() {
        return $this->conexion;
    }

    public function setConnection($conexion) {
        if ($conexion != null) {
            $this->conexion = $conexion;
        }
    }

    public function _declaraEntity($conexion,
                            $ruta,
                            $className) {
        include($ruta);

        if (class_exists($className)) {
            $entity = new $className($conexion);
        }

        return $entity;
    }

    public function _procesarLista($resultado) {
        $arrayDatos = array();
        while ($row = $resultado->fetch_array()) {
            $arrayDatos[] = $row;
        }

        return $arrayDatos;
    }

    public function _obtenerParametro($codParametro,
                            $conexion) {
        include('../../entity/general/GeneralesEntity.php');
        $generalesEntity = new GeneralesEntity($conexion,
                                false);
        $respuesta = '';

        $resultadoParametros = $generalesEntity->obtenerParametro($codParametro);
        while ($row = $resultadoParametros->fetch_array()) {
            $respuesta = $row[0];
        }

        return $respuesta;
    }

    public function _armarCombo($arrayDatos,
                            $etiqueta,
                            $nombre,
                            $placeHolder,
                            $nombreMetodo,
                            $codigoSeleccion) {
        $comboDinamico = '';
        $comboDinamico .= '<div class="form-group">';
        $comboDinamico .= '<label class="col-md-4 control-label">' . $etiqueta . '</label>';
        $comboDinamico .= '<div class="col-md-4 selectContainer">';
        $comboDinamico .= '<div class="input-group">';
        $comboDinamico .= '<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>';
        $comboDinamico .= '<select name="' . $nombre . '" id="' . $nombre . '" class="form-control selectpicker" onchange="' . $nombreMetodo . '">';
        $comboDinamico .= '<option value="" >' . $placeHolder . '</option>';
        for ($i = 0; $i < count($arrayDatos); $i++) {
            if ($codigoSeleccion == $arrayDatos[$i][0]) {
                $comboDinamico .= '<option value="' . $arrayDatos[$i][0] . '" selected>' . $arrayDatos[$i][1] . '</option>';
            }else {
                $comboDinamico .= '<option value="' . $arrayDatos[$i][0] . '">' . $arrayDatos[$i][1] . '</option>';
            }
        }
        $comboDinamico .= '</select>';
        $comboDinamico .= '</div>';
        $comboDinamico .= '</div>';
        $comboDinamico .= '</div>';

        return $comboDinamico;
    }

    public function _armarComboBootstrap($arrayDatos,
                            $etiqueta,
                            $nombre,
                            $placeHolder,
                            $nombreMetodo,
                            $codigoSeleccion) {
        $comboDinamico = '';
        $comboDinamico .= '<div class="form-group">';
        $comboDinamico .= '<label class="col-sm-3 control-label">' . $etiqueta . '</label>';
        $comboDinamico .= '<div class="col-sm-8">';
        $comboDinamico .= '<select class="form-control" name="' . $nombre . '" id="' . $nombre . '" required onchange="' . $nombreMetodo . '">';
        $comboDinamico .= '<option value="" >' . $placeHolder . '</option>';
        for ($i = 0; $i < count($arrayDatos); $i++) {
            if ($codigoSeleccion == $arrayDatos[$i][0]) {
                $comboDinamico .= '<option value="' . $arrayDatos[$i][0] . '" selected>' . $arrayDatos[$i][1] . '</option>';
            }else {
                $comboDinamico .= '<option value="' . $arrayDatos[$i][0] . '">' . $arrayDatos[$i][1] . '</option>';
            }
        }
        $comboDinamico .= '</select>';
        $comboDinamico .= '</div>';
        $comboDinamico .= '</div>';

        return $comboDinamico;
    }

    public function _armarTablaParametros($arrayDatos) {
        $htmlTabla = '';

        $htmlTabla .= '<div class="table-responsive">';
        $htmlTabla .= '<table class="table">';

        $htmlTabla .= '<tr class="info">';
        
        $htmlTabla .= '</tr>';

        for ($indexFilas = 0; $indexFilas < count($arrayDatos); $indexFilas++) {
            $htmlTabla .= '<tr>';
            $htmlTabla .= '<td>';
            $htmlTabla .= '<div class="form-group">';
            $htmlTabla .= '<label class="col-sm-3 control-label">'.$arrayDatos[$indexFilas][2].'</label>';
            $htmlTabla .= '<div class="col-sm-8">';
            if ($arrayDatos[$indexFilas][4]=='C'){
                $htmlTabla .= '<input type="text" class="form-control" id="parametros" name="parametros[]" placeholder="'.$arrayDatos[$indexFilas][2].'" required maxlength="'.$arrayDatos[$indexFilas][5].'">';
            }else if ($arrayDatos[$indexFilas][4]=='O'){
                $htmlTabla .= '<input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Comprobante" required maxlength="50">';
            }
            $htmlTabla .= '</div>';
            $htmlTabla .= '</div>';
            $htmlTabla .= '</td>';
            $htmlTabla .= '<td>';
            $htmlTabla .= '';
            $htmlTabla .= '</td>';
            $htmlTabla .= '</tr>';
        }

        $htmlTabla .= '</table>';
        $htmlTabla .= '</div>';

        return $htmlTabla;
    }
}
?>