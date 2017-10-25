<?php
class ConectarBD {

    public function conectar() {
        include('../../inc/DB_mysql.php');
        $db_mysql = new DB_mysql;
        $conexion = $db_mysql->conectar();

        return $conexion;
    }
}
;
?>