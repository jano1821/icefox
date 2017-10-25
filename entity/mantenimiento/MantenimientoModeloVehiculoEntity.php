<?php

class MantenimientoModeloVehiculoEntity {

    private $conexion;

    public function MantenimientoModeloVehiculoEntity($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerModelos($codigoMarca) {
        $modulo = "MantenimientoModeloVehiculoEntity.obtenerModelos";


        $consulta = "select prov.codModeloAutomovil, "; //fila0
        $consulta .= "prov.descModeloAutomovil "; //fila1
        $consulta .= "from modeloautomovil prov ";
        $consulta .= "where prov.codMarcaAutomovil = " . $codigoMarca . "; ";

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
