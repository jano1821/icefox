<?php

class CatalogoConstraintEntity {
    private $conexion;

    function CatalogoConstraintEntity($conexion,
                            $conectar) {
        if ($conectar) {
            include('../../inc/DB_mysql.php');
            $db_mysqlGenerales = new DB_mysql;
            $this->conexion = $db_mysqlGenerales->conectar();
        }else {
            $this->conexion = $conexion;
        }
    }

    public function obtenerListaConstraint($nomCampo,
                            $nomTabla) {
        $modulo = "CatalogoConstraintEntity.obtenerListaConstraint";

        $consulta = "select val, ";
        $consulta .= "descr ";
        $consulta .= "from v_listaconstraints ";
        $consulta .= "where campo = '".$nomCampo."' ";
        $consulta .= "and tabla = '".$nomTabla."'; ";
        try {
            $resultado = $this->conexion->query($consulta);
            if (!$resultado) {
                echo 'MySQL Error1: ' . mysql_error() . "<br>";
                echo 'MySQL Error1: ' . $resultado . "<br>";
                echo 'MySQL Error: ' . "Error al obtener constraints - " . $modulo;
                exit;
            }
        }catch (Exception $e) {
            echo 'MySQL Error: ' . mysql_error() . "<br>";
            echo 'MySQL Error: ' . $resultado . "<br>";
            echo 'MySQL Error: ' . "Error al obtener constraints - " . $modulo;
            exit;
        }
        return $resultado;
    }
    
    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}
;
?>

