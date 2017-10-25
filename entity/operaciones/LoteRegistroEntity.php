<?php

class LoteRegistroEntity {
    private $conexion;

    public function LoteRegistroEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerListaLotes($descLote,
                            $estado,
                            $limite,
                            $cantidad) {
        $modulo = "LoteRegistroEntity.obtenerListaLotes";

        $consulta = "select codLote, "; //fila0
        $consulta .= "descripcionLote, "; //fila1
        $consulta .= "fechaRecepcion, "; //fila2
        $consulta .= "fechaVencimiento, "; //fila3
        $consulta .= "estadoCierre, "; //fila4
        $consulta .= "estadoRegistro, "; //fila5
        $consulta .= "fechaInsercion, "; //fila6
        $consulta .= "usuarioInsercion "; //fila7
        $consulta .= "from v_listalotes ";
        $consulta .= "where descripcionLote like '%" . $descLote . "%' ";
        $consulta .= "and estadoRegistro like '%" . $estado . "%' ";
        $consulta .= "limit " . $limite . "," . $cantidad . ";";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerListaLotesSinLimite($descLote,
                            $estado) {
        $modulo = "LoteRegistroEntity.obtenerListaLotes";

        $consulta = "select codLote, "; //fila0
        $consulta .= "descripcionLote, "; //fila1
        $consulta .= "fechaRecepcion, "; //fila2
        $consulta .= "fechaVencimiento, "; //fila3
        $consulta .= "estadoCierre, "; //fila4
        $consulta .= "estadoRegistro, "; //fila5
        $consulta .= "fechaInsercion, "; //fila6
        $consulta .= "usuarioInsercion "; //fila7
        $consulta .= "from v_listalotes ";
        $consulta .= "where descripcionLote like '%" . $descLote . "%' ";
        $consulta .= "and estadoRegistro like '%" . $estado . "%'; ";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerCantidadRegistros() {
        $modulo = "LoteRegistroEntity.obtenerCantidadRegistros";

        $consulta = "select count(codLote) cant "; //fila0
        $consulta .= "from v_listalotes ";
        $consulta .= "where estadoRegistro like 'S';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function obtenerLote($codigo) {
        $modulo = "LoteRegistroEntity.obtenerLote";

        $consulta = "select codLote, "; //fila0
        $consulta .= "descripcionLote, "; //fila1
        $consulta .= "fechaRecepcion, "; //fila2
        $consulta .= "fechaVencimiento, "; //fila3
        $consulta .= "estadoCierre, "; //fila4
        $consulta .= "estadoRegistro, "; //fila5
        $consulta .= "fechaInsercion "; //fila6
        $consulta .= "from loteproductos ";
        $consulta .= "where codLote = '" . $codigo . "';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Data - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function insertarLote($descripcionLote,
                            $fechaRecepcion,
                            $fechaVencimiento,
                            $estadoActividad,
                            $estadoLote) {
        $modulo = "LoteRegistroEntity.insertarLote";

        $fechaRecepcion = str_replace('/',
                                '-',
                                $fechaRecepcion);
        $fechaRecepcion = date('Y-m-d',
                                strtotime($fechaRecepcion));
        $fechaVencimiento = str_replace('/',
                                '-',
                                $fechaVencimiento);
        $fechaVencimiento = date('Y-m-d',
                                strtotime($fechaVencimiento));

        $consulta = "insert into loteproductos( ";
        $consulta .= "descripcionLote, ";
        $consulta .= "fechaRecepcion, ";
        $consulta .= "fechaVencimiento, ";
        $consulta .= "estadoCierre, ";
        $consulta .= "estadoRegistro, ";
        $consulta .= "fechaInsercion, ";
        $consulta .= "usuarioInsercion) ";
        $consulta .= "values( ";
        $consulta .= "'" . $descripcionLote . "', ";
        $consulta .= "STR_TO_DATE('" . $fechaRecepcion . "','%Y-%m-%d'), ";
        $consulta .= "STR_TO_DATE('" . $fechaVencimiento . "','%Y-%m-%d'), ";
        $consulta .= "'" . $estadoActividad . "', ";
        $consulta .= "'" . $estadoLote . "', ";
        $consulta .= "CURDATE(), ";
        $consulta .= "'" . $_SESSION['usuario'] . "');";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al insertar Lote - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function modificarLote($codigo,
                            $descripcionLote,
                            $fechaRecepcion,
                            $fechaVencimiento,
                            $estadoActividad,
                            $estadoLote) {
        $modulo = "LoteRegistroEntity.modificarLote";

        $fechaRecepcion = str_replace('/',
                                '-',
                                $fechaRecepcion);
        $fechaRecepcion = date('Y-m-d',
                                strtotime($fechaRecepcion));
        $fechaVencimiento = str_replace('/',
                                '-',
                                $fechaVencimiento);
        $fechaVencimiento = date('Y-m-d',
                                strtotime($fechaVencimiento));

        $consulta = "update loteproductos ";
        $consulta .= "set descripcionLote='" . $descripcionLote . "', ";
        $consulta .= "fechaRecepcion='" . $fechaRecepcion . "', ";
        $consulta .= "fechaVencimiento='" . $fechaVencimiento . "', ";
        $consulta .= "estadoCierre='" . $estadoActividad . "', ";
        $consulta .= "estadoRegistro='" . $estadoLote . "', ";
        $consulta .= "fechaModificacion=CURDATE(), ";
        $consulta .= "usuarioModificacion='" . $_SESSION['usuario'] . "' ";
        $consulta .= "where codLote = '" . $codigo . "';";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al actualizar Lote - " . $modulo;
            exit;
        }

        return $resultado;
    }

    public function validarCerradoLote($codLote) {
        //$modulo = "LoteRegistroEntity.validarCerradoLote";
        $valorDevuelto = "";

        $consulta = "call prc_validarcerradolote(?,@repuesta); ";
        
        $sentencia = mysqli_prepare($this->conexion,$consulta);
        if ($sentencia){
            mysqli_stmt_bind_param($sentencia,'i', $codLote); 

            mysqli_stmt_execute($sentencia);
            
            $select = mysqli_query($this->conexion, 'SELECT @repuesta');
            $result = mysqli_fetch_assoc($select);
            $valorDevuelto     = $result['@repuesta'];
            
            mysqli_stmt_close($sentencia);
        }
            
        return $valorDevuelto;
        
    }
    
    public function cerrarLote($codLote) {
        //$modulo = "LoteRegistroEntity.validarCerradoLote";
        $estadoLote = 'C';
        $usuario = $_SESSION['usuario'];

        $consulta = "call prc_actualizarestadolote(?,?,?); ";
        
        $sentencia = mysqli_prepare($this->conexion,$consulta);
        if ($sentencia){
            
            mysqli_stmt_bind_param($sentencia,'iss', $codLote,$estadoLote,$usuario); 

            mysqli_stmt_execute($sentencia);
            
            mysqli_stmt_close($sentencia);
        }
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}
?>