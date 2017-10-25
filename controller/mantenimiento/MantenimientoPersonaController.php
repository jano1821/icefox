<?php

include('../../utility/AbstractClass.php');
class MantenimientoPersonaController extends AbstractClass {
    private $rutaEntityPersona = "../../entity/mantenimiento/MantenimientoPersonaEntity.php";
    private $claseEntityPersona = "MantenimientoPersonaEntity";
    private $rutaEntityTipoDocumento = "../../entity/mantenimiento/MantenimientoTipoDocumentoEntity.php";
    private $claseEntityTipoDocumento = "MantenimientoTipoDocumentoEntity";
    private $rutaMantenimientoClasesEntity = "../../entity/mantenimiento/MantenimientoClasesEntity.php";
    private $claseMantenimientoClasesEntity = "MantenimientoClasesEntity";

    private function enviaCabeceraDetalleTablaPersona($resultadoListaPersonas) {
        $arrayTitulos = array("", "Nombre", "Tipo documento", "Numero documento", "Tipo Persona");
        $arrayBotones = array("Editar", "Eliminar");
        $arrayDatos = parent::_procesarLista($resultadoListaPersonas);

        $htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,
                                                        $arrayDatos,
                                                        $arrayBotones);

        return $htmlTabla;
    }

    private function invocarTablaMantenimientoPersonas($htmlTabla,
                            $busqueda,
                            $numeroDocumento,
                            $estado,
                            $tipo,
                            $clasePersona,
                            $pagina,
                            $cantPaginas) {
        include('../../view/mantenimientos/TablaMantenimientoPersona.php');

        $tablaMantenimientoPersona = new TablaMantenimientoPersona;
        $tablaMantenimientoPersona->mostrarTablaMantenimientoPersona($htmlTabla,
                                $busqueda,
                                $numeroDocumento,
                                $estado,
                                $tipo,
                                $clasePersona,
                                $pagina,
                                $cantPaginas);
    }

    private function obtenerCantidadPaginas($mantenimientoPersonaEntity,
                            $cantidad,
                            $busqueda,
                            $numeroDocumento,
                            $estado,
                            $tipo,
                            $clasePersona) {
        $result = $mantenimientoPersonaEntity->obtenerCantidadRegistros($busqueda,
                                $numeroDocumento,
                                $estado,
                                $tipo,
                                $clasePersona);

        $row = $result->fetch_assoc();

        $paginas = floor($row["cant"] / $cantidad);
        $resto = $row["cant"] % $cantidad;

        if ($resto > 0) {
            $paginas++;
        }

        return $paginas;
    }

    public function mostrarFormularioMantenimientoPersona($codigo) {
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityPersona,
                                                        $this->claseEntityPersona);
        $mantenimientoTipoDocumentoEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityTipoDocumento,
                                                        $this->claseEntityTipoDocumento);

        $arrayTipoDocumento = array();

        $resultadoTipoDocumento = $mantenimientoTipoDocumentoEntity->obtenerListaTiposDocumento('',
                                '');
        $arrayTipoDocumento = parent::_procesarLista($resultadoTipoDocumento);

        if ($codigo == '' || $codigo == 'W') {//cuando es nuevo o viene de la validacion de cliente en venta(W)
            $arrayPersona = array();
        }else {
            $resultadoPersona = $mantenimientoPersonaEntity->obtenerPersona($codigo);

            $arrayPersona = parent::_procesarLista($resultadoPersona);
        }

        $mantenimientoPersonaEntity->cerrarConexion();

        include('../../view/mantenimientos/FormMantenimientoPersona.php');
        $formMantenimientoPersona = new FormMantenimientoPersona;
        $formMantenimientoPersona->mostrarFormMantenimientoPersonaExterno($arrayPersona,
                                $arrayTipoDocumento,
                                $codigo);
    }

    public function obtenerListaPersonasTabla($busqueda,
                            $numeroDocumento,
                            $estado,
                            $tipo,
                            $clasePersona,
                            $pagina,
                            $direccion) {
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityPersona,
                                                        $this->claseEntityPersona);

        $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                        parent::getConnection());

        $cantPaginas = $this->obtenerCantidadPaginas($mantenimientoPersonaEntity,
                                $cantidad,
                                $busqueda,
                                $numeroDocumento,
                                $estado,
                                $tipo,
                                $clasePersona);

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

        $resultadoListaPersonas = $mantenimientoPersonaEntity->obtenerListaPersonaTabla($busqueda,
                                $numeroDocumento,
                                $estado,
                                $tipo,
                                $clasePersona,
                                $limite,
                                $cantidad);
        $mantenimientoPersonaEntity->cerrarConexion();

        $htmlTabla = $this->enviaCabeceraDetalleTablaPersona($resultadoListaPersonas);

        $this->invocarTablaMantenimientoPersonas($htmlTabla,
                                $busqueda,
                                $numeroDocumento,
                                $estado,
                                $tipo,
                                $clasePersona,
                                $pagina,
                                $cantPaginas);
    }

    public function obtenerListaProveedores($busqueda) {
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityPersona,
                                                        $this->claseEntityPersona);

        $resultadoListaProveedores = $mantenimientoPersonaEntity->obtenerListaProveedores($busqueda,
                                '');

        $arrayProveedores = parent::_procesarLista($resultadoListaProveedores);

        $mantenimientoPersonaEntity->cerrarConexion();

        return $arrayProveedores;
    }

    public function guardarFormularioMantenimientoPersona($validatorForm,
                            $codigo,
                            $nombres,
                            $apePat,
                            $apeMat,
                            $razonSocial,
                            $TipoDocumento,
                            $numeroDocumento,
                            $tipoPersona,
                            $sexo,
                            $fecNac,
                            $estadoCivil,
                            $estadoRegistro) {

        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityPersona,
                                                        $this->claseEntityPersona);
        $id = '';

        if ($validatorForm != 'W') {
            $cantidad = parent::_obtenerParametro('CANT_REG_PAG',
                                                            parent::getConnection());

            $cantPaginas = $this->obtenerCantidadPaginas($mantenimientoPersonaEntity,
                                    $cantidad,
                                    '',
                                    '',
                                    '',
                                    '',
                                    '');
            $direccion = '1';
            $pagina = 0;

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
        }
        if ($tipoPersona == 'N' || $validatorForm == 'W') {
            $razonSocial = $nombres . ' ' . $apePat . ' ' . $apeMat;
        }

        if ($validatorForm == 'N' || $validatorForm == 'W') {//el W es un indicador que el formulario fue invocado desde una ubicacion fuera de la tabla de listado de personas
            $id = $mantenimientoPersonaEntity->insertarPersona($nombres,
                                    $apePat,
                                    $apeMat,
                                    $razonSocial,
                                    $TipoDocumento,
                                    $numeroDocumento,
                                    $tipoPersona,
                                    $sexo,
                                    $fecNac,
                                    $estadoCivil,
                                    $estadoRegistro);
        }else if ($validatorForm == 'M') {
            $mantenimientoPersonaEntity->modificarPersona($codigo,
                                    $nombres,
                                    $apePat,
                                    $apeMat,
                                    $razonSocial,
                                    $TipoDocumento,
                                    $numeroDocumento,
                                    $tipoPersona,
                                    $sexo,
                                    $fecNac,
                                    $estadoCivil,
                                    $estadoRegistro);
        }

        if ($validatorForm != 'W') {
            $resultadoListaPersonas = $mantenimientoPersonaEntity->obtenerListaPersonaTabla('',
                                    '',
                                    '',
                                    '',
                                    '',
                                    $limite,
                                    $cantidad);

            $htmlTabla = $this->enviaCabeceraDetalleTablaPersona($resultadoListaPersonas);
        }

        if ($validatorForm == 'W') {
            if ($id != null && $id != "" && $id > 0) {
                $mantenimientoClasesEntity = parent::_declaraEntity(parent::getConnection(),
                                                                $this->rutaMantenimientoClasesEntity,
                                                                $this->claseMantenimientoClasesEntity);
                $mantenimientoClasesEntity->insertarClaseCliente($id);
            }
        }

        $mantenimientoPersonaEntity->cerrarConexion();

        if ($validatorForm != 'W') {
            $this->invocarTablaMantenimientoPersonas($htmlTabla,
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    $pagina,
                                    $cantPaginas);
        }else {
            echo "<script language='javascript'>alert('La Operación se Realizó Satisfactoriamente');";
            echo "window.opener.insertarCliente('" . $id . "','" . $razonSocial . "','" . $numeroDocumento . "')";
            echo "</script>";
        }
    }

    public function busquedaClientePorDocumento($numeroDocumento) {
        $mantenimientoPersonaEntity = parent::_declaraEntity(parent::getConnection(),
                                                        $this->rutaEntityPersona,
                                                        $this->claseEntityPersona);

        $resultadoPersona = $mantenimientoPersonaEntity->obtenerListaClientes($numeroDocumento);

        $arrayClientes = parent::_procesarLista($resultadoPersona);

        if (count($arrayClientes) == 0) {
            return array();
        }else if (count($arrayClientes) == 1) {
            return $arrayClientes;
        }
    }
}
?>