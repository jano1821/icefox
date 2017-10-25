<?php

include('../../utility/AbstractClass.php');
class LoteRegistroController extends AbstractClass {
    private $rutaLote = '../../entity/operaciones/LoteRegistroEntity.php';
    private $claseLote = 'LoteRegistroEntity';
    /* private function declaraEntityLoteRegistroEntity($conexion){
      include('../../entity/operaciones/LoteRegistroEntity.php');
      $loteRegistroEntity = new LoteRegistroEntity($conexion);

      return $loteRegistroEntity;
      } */

    private function obtenerCantidadPaginas($loteRegistroEntity,
                            $cantidad) {
        $result = $loteRegistroEntity->obtenerCantidadRegistros();

        $row = $result->fetch_assoc();

        $paginas = floor($row["cant"] / $cantidad);
        $resto = $row["cant"] % $cantidad;

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    private function procesarListaLotes($resultadoListaLotes) {
        $arrayDatos = array();
        while ($row = $resultadoListaLotes->fetch_array()) {
            $arrayDatos[] = $row;
        }

        $arrayTitulos = array("", "Descripcion", "Fecha de Recepcion", "Fecha de Vencimiento", "Estado Actividad");
        $arrayBotones = array("Editar", "Cerrar");
        $arrayFunciones = array("envioFormulario", "cerrar");

        $htmlTabla = parent::_armarTablaEspecialConFuncionesModalNew($arrayTitulos,
                                                        $arrayDatos,
                                                        '',
                                                        '',
                                                        false,
                                                        $arrayBotones,
                                                        $arrayFunciones,
                                                        array());

        return $htmlTabla;
    }

    private function invocarTablaLoteRegistro($htmlTabla,
                            $pagina,
                            $cantPaginas) {
        include('../../view/operaciones/TablaLoteRegistro.php');

        $tablaLoteRegistro = new TablaLoteRegistro;
        $tablaLoteRegistro->mostrarTablaLoteRegistro($htmlTabla,
                                $pagina,
                                $cantPaginas);
    }

    public function obtenerListaLotes($busqueda,
                            $pagina,
                            $direccion) {
        $loteRegistroEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaLote,
                                                        $this->claseLote);

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($loteRegistroEntity,
                                $cantidad);

        if ($direccion == '-1') {
            if ($pagina == 1) {
                echo '<script language="javascript">alert("No hay registros anteriores");</script>';
            }else {
                $pagina = $pagina - 1;
            }
        }

        if ($direccion == '1') {
            if ($pagina >= $cantPaginas) {
                echo '<script language="javascript">alert("No hay registros posteriores");</script>';
            }else {
                $pagina = $pagina + 1;
            }
        }

        $limite = $cantidad * ($pagina - 1);
        $resultadoListaLotes = $loteRegistroEntity->obtenerListaLotes($busqueda,
                                'S',
                                $limite,
                                $cantidad);

        $htmlTabla = $this->procesarListaLotes($resultadoListaLotes);

        $loteRegistroEntity->cerrarConexion();

        $this->invocarTablaLoteRegistro($htmlTabla,
                                $pagina,
                                $cantPaginas);
    }

    public function mostrarFormularioLoteRegistro($codigo) {

        $loteRegistroEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaLote,
                                                        $this->claseLote);

        if ($codigo == '') {
            $arrayLotes = array();
        }else {
            $resultadoLotes = $loteRegistroEntity->obtenerLote($codigo);

            while ($row = $resultadoLotes->fetch_array()) {
                $arrayLotes[] = $row;
            }

            $loteRegistroEntity->cerrarConexion();
        }

        include('../../view/operaciones/FormLoteRegistro.php');
        $formLoteRegistro = new FormLoteRegistro;
        $formLoteRegistro->mostrarFormLoteRegistro($arrayLotes);
    }

    public function guardarFormularioLoteRegistro($validatorForm,
                            $codigo,
                            $descripcionLote,
                            $fechaRecepcion,
                            $fechaVencimiento,
                            $estadoActividad,
                            $estadoLote,
                            $pagina,
                            $direccion) {

        $loteRegistroEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaLote,
                                                        $this->claseLote);

        if ($validatorForm == 'N') {
            $resultadoLotes = $loteRegistroEntity->insertarLote($descripcionLote,
                                    $fechaRecepcion,
                                    $fechaVencimiento,
                                    $estadoActividad,
                                    $estadoLote);
        }else if ($validatorForm == 'M') {
            $resultadoLotes = $loteRegistroEntity->modificarLote($codigo,
                                    $descripcionLote,
                                    $fechaRecepcion,
                                    $fechaVencimiento,
                                    $estadoActividad,
                                    $estadoLote);
        }

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($loteRegistroEntity,
                                $cantidad);

        if ($direccion == '-1') {
            if ($pagina == 1) {
                echo '<script language="javascript">alert("No hay registros anteriores");</script>';
            }else {
                $pagina = $pagina - 1;
            }
        }

        if ($direccion == '1') {
            if ($pagina >= $cantPaginas) {
                echo '<script language="javascript">alert("No hay registros posteriores");</script>';
            }else {
                $pagina = $pagina + 1;
            }
        }

        $limite = $cantidad * ($pagina - 1);
        $resultadoListaLotes = $loteRegistroEntity->obtenerListaLotes('',
                                'S',
                                $limite,
                                $cantidad);

        $htmlTabla = $this->procesarListaLotes($resultadoListaLotes);

        $loteRegistroEntity->cerrarConexion();

        $this->invocarTablaLoteRegistro($htmlTabla,
                                $pagina,
                                $cantPaginas);
    }

    public function cerrarLote($codLote) {
        $loteRegistroEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaLote,
                                                        $this->claseLote);

        $respuestaValidacion = $this->validarCerradoLote($codLote,
                                $loteRegistroEntity);

        if ($respuestaValidacion == 'N') {
            echo '<script language="javascript">alert("Este Lote cuenta con Especies Valoradas sin Procesar");</script>';
        }

        $loteRegistroEntity->cerrarLote($codLote);
        
        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($loteRegistroEntity,
                                $cantidad);

        $limite = 0;
        $resultadoListaLotes = $loteRegistroEntity->obtenerListaLotes('',
                                'S',
                                $limite,
                                $cantidad);

        $htmlTabla = $this->procesarListaLotes($resultadoListaLotes);

        $loteRegistroEntity->cerrarConexion();

        $this->invocarTablaLoteRegistro($htmlTabla,
                                1,
                                $cantPaginas);
    }

    private function validarCerradoLote($codLote,
                            $loteRegistroEntity) {
        $respuestaValidacion = $loteRegistroEntity->validarCerradoLote($codLote);
        return $respuestaValidacion;
    }
}
;
?>