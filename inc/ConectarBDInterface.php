<?php

class ConectarBDInterface {

    public function conectar() {
        include('../../inc/DB_mysqlInterface.php');
        $db_mysql = new DB_mysqlInterface;
        $conexion = $db_mysql->conectar();

        return $conexion;
    }
}
;
?>
