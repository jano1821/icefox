<?php

class MantenimientoPersonaEntity {

    private $conexion;

    public function MantenimientoPersonaEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerListaPersonaTabla($nombrePersona, $numeroDocumento, $estado, $tipo, $clasePersona, $limite, $cantidad) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaPersonaTabla";

        $consulta = "";
        if ($clasePersona == "") {
            $consulta = "select per.codPersona, "; //fila0
            $consulta .= "per.nombreRazonSocial, "; //fila1
            $consulta .= "tdoc.descTipoDocumento, "; //fila2
            $consulta .= "per.numeroDocumento, "; //fila3
            $consulta .= "per.tipoPersona "; //fila4
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        } else if ($clasePersona == "P") {
            $consulta = "select per.codPersona, "; //fila0
            $consulta .= "per.nombreRazonSocial, "; //fila1
            $consulta .= "tdoc.descTipoDocumento, "; //fila2
            $consulta .= "per.numeroDocumento, "; //fila3
            $consulta .= "per.tipoPersona "; //fila4
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join proveedor prov on prov.codPersona = per.codPersona ";
        } else if ($clasePersona == "C") {
            $consulta = "select per.codPersona, "; //fila0
            $consulta .= "per.nombreRazonSocial, "; //fila1
            $consulta .= "tdoc.descTipoDocumento, "; //fila2
            $consulta .= "per.numeroDocumento, "; //fila3
            $consulta .= "per.tipoPersona "; //fila4
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join cliente clie on clie.codPersona = per.codPersona ";
        } else if ($clasePersona == "E") {
            $consulta = "select per.codPersona, "; //fila0
            $consulta .= "per.nombreRazonSocial, "; //fila1
            $consulta .= "tdoc.descTipoDocumento, "; //fila2
            $consulta .= "per.numeroDocumento, "; //fila3
            $consulta .= "per.tipoPersona "; //fila4
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join empleado empl on empl.codPersona = per.codPersona ";
        }

        $consulta .= "where per.nombreRazonSocial like '%" . $nombrePersona . "%' ";
        $consulta .= "and per.numeroDocumento like '%" . $numeroDocumento . "%' ";
        $consulta .= "and per.tipoPersona like '%" . $tipo . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%' ";
        if ($cantidad > 0) {
            $consulta .= "limit " . $limite . "," . $cantidad . ";";
        }

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }
        return $resultado;
    }

    public function obtenerListaPersona($nombrePersona, $estado) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaPersona";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.apePaterno, "; //fila1
        $consulta .= "per.apeMaterno, "; //fila2
        $consulta .= "per.nombres, "; //fila3
        $consulta .= "per.nombreRazonSocial, "; //fila4
        $consulta .= "per.numeroDocumento, "; //fila5
        $consulta .= "per.tipoPersona, "; //fila6
        $consulta .= "per.sexo, "; //fila7
        $consulta .= "per.fechaNacimiento, "; //fila8
        $consulta .= "per.estadoCivil, "; //fila9
        $consulta .= "per.codTipoDocumento, "; //fila10
        $consulta .= "tdoc.descTipoDocumento, "; //fila11
        $consulta .= "per.estadoRegistro, "; //fila12
        $consulta .= "per.fechaInsercion, "; //fila13
        $consulta .= "per.usuarioInsercion "; //fila14
        $consulta .= "from persona per ";
        $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        $consulta .= "where per.nombreRazonSocial like '%" . $nombrePersona . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerPersona($codigo) {
        $modulo = "MantenimientoPersonaEntity.obtenerPersona";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.apePaterno, "; //fila1
        $consulta .= "per.apeMaterno, "; //fila2
        $consulta .= "per.nombres, "; //fila3
        $consulta .= "per.nombreRazonSocial, "; //fila4
        $consulta .= "per.numeroDocumento, "; //fila5
        $consulta .= "per.tipoPersona, "; //fila6
        $consulta .= "per.sexo, "; //fila7
        $consulta .= "per.fechaNacimiento, "; //fila8
        $consulta .= "per.estadoCivil, "; //fila9
        $consulta .= "per.codTipoDocumento, "; //fila10
        $consulta .= "tdoc.descTipoDocumento, "; //fila11
        $consulta .= "per.estadoRegistro, "; //fila12
        $consulta .= "per.fechaInsercion, "; //fila13
        $consulta .= "per.usuarioInsercion "; //fila14
        $consulta .= "from persona per ";
        $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        $consulta .= "where per.codPersona = '" . $codigo . "';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Data - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaProveedores($nombreProveedor, $estado) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaProveedores";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.apePaterno, "; //fila1
        $consulta .= "per.apeMaterno, "; //fila2
        $consulta .= "per.nombres, "; //fila3
        $consulta .= "per.nombreRazonSocial, "; //fila4
        $consulta .= "tdoc.descTipodocumento, "; //fila5
        $consulta .= "per.numeroDocumento "; //fila6
        $consulta .= "from persona per ";
        $consulta .= "inner join proveedor prov on prov.codPersona = per.codPersona ";
        $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        $consulta .= "where per.nombreRazonSocial like '%" . $nombreProveedor . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function insertarPersona($nombres, $apePat, $apeMat, $razonSocial, $TipoDocumento, $NumeroDocumento, $tipoPersona, $sexo, $fecNac, $estadoCivil, $estadoRegistro) {
        $modulo = "MantenimientoPersonaEntity.insertarPersona";

        $fecNac = str_replace('/', '-', $fecNac);
        $fecNac = date('Y-m-d', strtotime($fecNac));

        $consulta = "insert into persona( ";
        $consulta .= "apePaterno, ";
        $consulta .= "apeMaterno, ";
        $consulta .= "nombres, ";
        $consulta .= "nombreRazonSocial, ";
        $consulta .= "numeroDocumento, ";
        $consulta .= "tipoPersona, ";
        $consulta .= "sexo, ";
        $consulta .= "fechaNacimiento, ";
        $consulta .= "estadoCivil, ";
        $consulta .= "codTipoDocumento, ";
        $consulta .= "estadoRegistro, ";
        $consulta .= "fechaInsercion, ";
        $consulta .= "usuarioInsercion) ";
        $consulta .= "values( ";
        $consulta .= "'" . $apePat . "',";
        $consulta .= "'" . $apeMat . "',";
        $consulta .= "'" . $nombres . "',";
        $consulta .= "'" . $razonSocial . "',";
        $consulta .= "'" . $NumeroDocumento . "',";
        $consulta .= "'" . $tipoPersona . "',";
        $consulta .= "'" . $sexo . "',";
        $consulta .= "'" . $fecNac . "',";
        $consulta .= "'" . $estadoCivil . "',";
        $consulta .= "'" . $TipoDocumento . "',";
        $consulta .= "'" . $estadoRegistro . "',";
        $consulta .= "CURDATE(), ";
        $consulta .= "'" . $_SESSION['usuario'] . "');";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al insertar Perfil - " . $modulo;
            exit;
        }

        return $this->conexion->insert_id;
    }

    public function modificarPersona($codigo, $nombres, $apePat, $apeMat, $razonSocial, $TipoDocumento, $NumeroDocumento, $tipoPersona, $sexo, $fecNac, $estadoCivil, $estadoRegistro) {
        $modulo = "MantenimientoPersonaEntity.modificarPersona";

        $fecNac = str_replace('/', '-', $fecNac);
        $fecNac = date('Y-m-d', strtotime($fecNac));

        $consulta = "update persona ";
        $consulta .= "set apePaterno='" . $apePat . "', ";
        $consulta .= "apeMaterno='" . $apeMat . "', ";
        $consulta .= "nombres='" . $nombres . "', ";
        $consulta .= "nombreRazonSocial='" . $razonSocial . "', ";
        $consulta .= "numeroDocumento='" . $NumeroDocumento . "', ";
        $consulta .= "tipoPersona='" . $tipoPersona . "', ";
        $consulta .= "sexo='" . $sexo . "', ";
        $consulta .= "fechaNacimiento='" . $fecNac . "', ";
        $consulta .= "estadoCivil='" . $estadoCivil . "', ";
        $consulta .= "codTipoDocumento='" . $TipoDocumento . "', ";
        $consulta .= "estadoRegistro='" . $estadoRegistro . "', ";
        $consulta .= "fechaModificacion=CURDATE(), ";
        $consulta .= "usuarioModificacion='" . $_SESSION['usuario'] . "' ";
        $consulta .= "where codPersona = '" . $codigo . "';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al actualizar Perfil - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerCantidadRegistros($busqueda, $numeroDocumento, $estado, $tipo, $clasePersona) {
        $modulo = "MantenimientoPersonaEntity.obtenerCantidadRegistros";

        if ($clasePersona == "") {
            $consulta = "select count(per.codPersona) cant "; //fila0
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        } else if ($clasePersona == "P") {
            $consulta = "select count(per.codPersona) cant "; //fila0
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join proveedor prov on prov.codPersona = per.codPersona ";
        } else if ($clasePersona == "C") {
            $consulta = "select count(per.codPersona) cant "; //fila0
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join cliente clie on clie.codPersona = per.codPersona ";
        } else if ($clasePersona == "E") {
            $consulta = "select count(per.codPersona) cant "; //fila0
            $consulta .= "from persona per ";
            $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
            $consulta .= "inner join empleado empl on empl.codPersona = per.codPersona ";
        }
        $consulta .= "where per.nombreRazonSocial like '%" . $busqueda . "%' ";
        $consulta .= "and per.numeroDocumento like '%" . $numeroDocumento . "%' ";
        $consulta .= "and per.tipoPersona like '%" . $tipo . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%'; ";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener cantidad - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaEmpleados($nombreEmpleado, $estado) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaEmpleados";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.apePaterno, "; //fila1
        $consulta .= "per.apeMaterno, "; //fila2
        $consulta .= "per.nombres, "; //fila3
        $consulta .= "per.nombreRazonSocial, "; //fila4
        $consulta .= "tdoc.descTipodocumento, "; //fila5
        $consulta .= "per.numeroDocumento "; //fila6
        $consulta .= "from persona per ";
        $consulta .= "inner join empleado prov on prov.codPersona = per.codPersona ";
        $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        $consulta .= "where per.nombreRazonSocial like '%" . $nombreEmpleado . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaPuntosDeVenta($nombrePunto, $estado) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaPuntosDeVenta";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.apePaterno, "; //fila1
        $consulta .= "per.apeMaterno, "; //fila2
        $consulta .= "per.nombres, "; //fila3
        $consulta .= "per.nombreRazonSocial, "; //fila4
        $consulta .= "tdoc.descTipodocumento, "; //fila5
        $consulta .= "per.numeroDocumento "; //fila6
        $consulta .= "from persona per ";
        $consulta .= "inner join puntoventa prov on prov.codPersona = per.codPersona ";
        $consulta .= "inner join tipodocumento tdoc on tdoc.codTipoDocumento = per.codtipoDocumento ";
        $consulta .= "where per.nombreRazonSocial like '%" . $nombrePunto . "%' ";
        $consulta .= "and per.estadoRegistro like '%" . $estado . "%';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaPuntosDeVentaConDepositoLiquidado($valor) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaPuntosDeVentaConDepositoLiquidado";

        $consulta = "select per.codPersona, "; //fila0
        $consulta .= "per.nombreRazonSocial "; //fila1
        $consulta .= "from persona per ";
        $consulta .= "inner join puntoventa prov on prov.codPersona = per.codPersona ";
        $consulta .= "where (per.nombreRazonSocial like '%" . $valor . "%' ";
        $consulta .= "or per.codPersona like '%" . $valor . "%') ";
        $consulta .= "and exists (select dep.puntoventa from Deposito dep inner join depositoproducto dp on dep.codDeposito = dp.codDeposito where dep.puntoventa = per.codPersona and dp.estadoRegistro = 'S') ";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaPuntosDeVentaConLiquidaciones($valor) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaPuntosDeVentaConLiquidaciones";

        $consulta = "select persona, "; //fila0
        $consulta .= "razonSocial "; //fila1
        $consulta .= "from v_listapuntosventaconliquidacion ";
        $consulta .= "where (razonSocial like '%" . $valor . "%' ";
        $consulta .= "or persona = '" . $valor . "'); ";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaClientes($numeroDocumento) {
        $modulo = "MantenimientoPersonaEntity.obtenerListaClientes";

        $consulta = "select per.persona, "; //fila0
        $consulta .= "per.paterno, "; //fila1
        $consulta .= "per.materno, "; //fila2
        $consulta .= "per.nombre, "; //fila3
        $consulta .= "per.razon, "; //fila4
        $consulta .= "per.documento "; //fila5
        $consulta .= "from v_listcliente per ";
        $consulta .= "where per.documento like '%" . $numeroDocumento . "%';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }

}

?>