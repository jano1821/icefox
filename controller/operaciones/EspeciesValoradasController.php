<?php

include('../../utility/AbstractClass.php');

class EspeciesValoradasController extends AbstractClass {

    private $rutaEspecieValorada = '../../entity/operaciones/EspeciesValoradasEntity.php';
    private $claseEspecieValorada = 'EspeciesValoradasEntity';
    private $rutaLote = '../../entity/operaciones/LoteRegistroEntity.php';
    private $claseLote = 'LoteRegistroEntity';
    private $rutaPersona = '../../entity/mantenimiento/MantenimientoPersonaEntity.php';
    private $clasePersona = 'MantenimientoPersonaEntity';
    private $rutaClaseEV = '../../entity/mantenimiento/MantenimientoClaseEspecieValoradaEntity.php';
    private $claseClaseEV = 'MantenimientoClaseEspecieValoradaEntity';

    private function declaraEntityEspeciesValoradas($conexion) {
        include('../../entity/operaciones/EspeciesValoradasEntity.php');
        $especiesValoradasEntity = new EspeciesValoradasEntity($conexion);

        return $especiesValoradasEntity;
    }

    private function enviaCabeceraDetalleTablaEspecieValorada($resultadoEspeciesValoradas) {
        $arrayTitulos = array("", "Numero Certificado", "Tipo", "Lote", "Proveedor", "Punto Venta", "Estado");
        $arrayBotones = array("Editar", "Eliminar");
        $arrayDatos = parent::_procesarLista($resultadoEspeciesValoradas);

        $htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,
                        $arrayDatos,
                        $arrayBotones);

        return $htmlTabla;
    }

    private function invocarTablaEspeciesValoradas($htmlTabla,
            $arrayProveedores,
            $numeroCertificado,
            $lote,
            $tipo,
            $proveedor,
            $estadoRegistro,
            $pagina,
            $cantPaginas) {
        include('../../view/operaciones/TablaEspecieValorada.php');

        $tablaEspecieValorada = new TablaEspecieValorada;
        $tablaEspecieValorada->mostrarTablaEspecieValorada($htmlTabla,
                $arrayProveedores,
                $numeroCertificado,
                $lote,
                $tipo,
                $proveedor,
                $estadoRegistro,
                $pagina,
                $cantPaginas);
    }

    private function obtenerCantidadPaginas($especiesValoradasEntity,
            $cantidad,
            $numeroCertificado,
            $lote,
            $tipo,
            $proveedor,
            $estadoRegistro) {
        $result = $especiesValoradasEntity->obtenerCantidadRegistros($numeroCertificado,
                $lote,
                $tipo,
                $proveedor,
                $estadoRegistro);

        $row = $result->fetch_assoc();

        $paginas = floor($row["cant"] / $cantidad);
        $resto = $row["cant"] % $cantidad;

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    public function mostrarRegistroEspeciesValoradas($codigo) {
        $arrayEspecieValorada = array();
        if ($codigo != '') {
            $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                            $this->rutaEspecieValorada,
                            $this->claseEspecieValorada);
            $resultadoEspecieValorada = $especiesValoradasEntity->obtenerEspecieValorada($codigo);

            while ($row = $resultadoEspecieValorada->fetch_array()) {
                $arrayEspecieValorada[] = $row;
            }
        }
        $loteRegistroEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaLote,
                        $this->claseLote);
        $resultadoListaLote = $loteRegistroEntity->obtenerListaLotesSinLimite('',
                'S');

        $arrayLotes = array();

        while ($row = $resultadoListaLote->fetch_array()) {
            $arrayLotes[] = $row;
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

        $arrayClase = array();
        $mantenimientoClaseEspecieValoradaEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaClaseEV,
                        $this->claseClaseEV);
        $resultadoClaseEspecieValorada = $mantenimientoClaseEspecieValoradaEntity->obtenerListaClaseEV('');

        while ($row = $resultadoClaseEspecieValorada->fetch_array()) {
            $arrayClase[] = $row;
        }
        
        include('../../view/operaciones/FormRegistroEspeciesValoradas.php');
        $formRegistroEspeciesValoradas = new FormRegistroEspeciesValoradas;
        $formRegistroEspeciesValoradas->mostrarFormRegistroEspeciesValoradas($arrayEspecieValorada,
                $arrayLotes,
                $arrayProveedores,
                $arrayClase);
    }

    public function obtenerListaEspeciesValoradas($numeroCertificado,
            $lote,
            $tipo,
            $proveedor,
            $estadoRegistro,
            $pagina,
            $direccion) {
        $especiesValoradasEntity = parent::_declaraEntity(parent::getConnection(),
                        $this->rutaEspecieValorada,
                        $this->claseEspecieValorada);

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($especiesValoradasEntity,
                $cantidad,
                $numeroCertificado,
                $lote,
                $tipo,
                $proveedor,
                $estadoRegistro);

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
        $resultadoListaEspecieValorada = $especiesValoradasEntity->obtenerListaEspecieValoradaTabla($numeroCertificado,
                $lote,
                $tipo,
                $proveedor,
                $estadoRegistro,
                $limite,
                $cantidad);
        $especiesValoradasEntity->cerrarConexion();

        $htmlTabla = $this->enviaCabeceraDetalleTablaEspecieValorada($resultadoListaEspecieValorada);

        $this->invocarTablaEspeciesValoradas($htmlTabla,
                $arrayProveedores,
                $numeroCertificado,
                $lote,
                $tipo,
                $proveedor,
                $estadoRegistro,
                $pagina,
                $cantPaginas);
    }

    public function guardarFormularioEspecieValorada($validatorForm,
            $codigo,
            $metodo,
            $cantidadRegistros,
            $numero,
            $lote,
            $tipo,
            $proveedor,
            $poliza,
            $clase,
            $pagina) {
        $especiesValoradasEntity = $this->declaraEntityEspeciesValoradas(parent::getConnection());
        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                        parent::getConnection());
        $cantPaginas = $this->obtenerCantidadPaginas($especiesValoradasEntity,
                $cantidad,
                '',
                '',
                '',
                '',
                '');

        if ($validatorForm == 'N') {

            if ($metodo == 'I') {
                if ($tipo == "M") {
                    $poliza = $numero;
                }

                $especiesValoradasEntity->insertarEspecieValorada($numero,
                        $lote,
                        $tipo,
                        $proveedor,
                        $poliza,
                        $clase);
            } else {
                for ($i = 0; $i < $cantidadRegistros; $i++) {
                    $poliza = $numero + $i;
                    $especiesValoradasEntity->insertarEspecieValorada($numero + $i,
                            $lote,
                            $tipo,
                            $proveedor,
                            $poliza,
                            $clase);
                }
            }
        } else if ($validatorForm == 'M') {
            if ($tipo == "M") {
                $poliza = $numero;
            }
            $especiesValoradasEntity->modificarEspecieValorada($codigo,
                    $numero,
                    $lote,
                    $tipo,
                    $proveedor,
                    $poliza,
                    $clase);
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

        $resultadoListaEspecieValorada = $especiesValoradasEntity->obtenerListaEspecieValoradaTabla('',
                '',
                '',
                '',
                '',
                0,
                $cantidad);
        $especiesValoradasEntity->cerrarConexion();

        $htmlTabla = $this->enviaCabeceraDetalleTablaEspecieValorada($resultadoListaEspecieValorada);

        $this->invocarTablaEspeciesValoradas($htmlTabla,
                $arrayProveedores,
                '',
                '',
                '',
                '',
                '',
                1,
                $cantPaginas);
    }

}

;
?>