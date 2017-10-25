<?php

class MantenimientoClaseEspecieValoradaEntity {

    private $conexion;

    public function MantenimientoClaseEspecieValoradaEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerListaClaseEV($descripcionClase) {
        $modulo = "MantenimientoClaseEspecieValoradaEntity.obtenerListaClaseEV";


        $consulta = "select prov.codClaseProducto, "; //fila0
        $consulta .= "prov.descClaseProducto "; //fila1
        $consulta .= "from claseproducto prov ";
        $consulta .= "where prov.descClaseProducto like '%" . $descripcionClase . "%'; ";

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


