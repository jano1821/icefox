<?php

class GeneralesEntity {
    private $conexionGenerales;

    function GeneralesEntity($conexionGenerales,
                            $conectar) {
        if ($conectar) {
            include('../../inc/DB_mysql.php');
            $db_mysqlGenerales = new DB_mysql;
            $this->conexionGenerales = $db_mysqlGenerales->conectar();
        }else {
            $this->conexionGenerales = $conexionGenerales;
        }
    }

    public function obtenerParametro($codigoParametro) {
        $modulo = "GeneralesEntity.obtenerParametro";

        $consulta = "select valorParametroGeneral ";
        $consulta .= "from parametrogeneral ";
        $consulta .= "where codigoParametroGeneral='" . $codigoParametro . "' ";
        $consulta .= "and estadoRegistro='S';";

        try {
            $resultado = $this->conexionGenerales->query($consulta);
            if (!$resultado) {
                echo 'MySQL Error: ' . mysql_error() . "<br>";
                echo 'MySQL Error: ' . $resultado . "<br>";
                echo 'MySQL Error: ' . "Error al obtener parametros generales - " . $modulo;
                exit;
            }
        }catch (Exception $e) {
            echo 'MySQL Error: ' . mysql_error() . "<br>";
            echo 'MySQL Error: ' . $resultado . "<br>";
            echo 'MySQL Error: ' . "Error al obtener parametros generales - " . $modulo;
            exit;
        }
        //mysql_close($this->conexionGenerales);
        return $resultado;
    }
}
?>