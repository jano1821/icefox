<?php

class MantenimientoMarcaVehiculoEntity {

    private $conexion;

    public function MantenimientoMarcaVehiculoEntity($conexion) {
        $this->conexion = $conexion;
    }

    /* public function obtenerDepartamentos(){
      $modulo="MantenimientoUbigeoEntity.obtenerDepartamentos";


      $consulta = "select codDepartamento, ";//fila0
      $consulta .= "descDepartamento ";//fila1
      $consulta .= "from departamento; ";

      $resultado = $this->conexion->query($consulta);
      if(!$resultado){
      echo 'MySQL Error: ' . $this->conexion->error."<br>";
      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
      exit;
      }

      return $resultado;
      } */

    public function obtenerListaMarcas($descripcionMarca) {
        $modulo = "MantenimientoMarcaVehiculoEntity.obtenerListaMarcas";


        $consulta = "select prov.codMarcaAutomovil, "; //fila0
        $consulta .= "prov.descMarcaAutomovil "; //fila1
        $consulta .= "from marcaautomovil prov ";
        $consulta .= "where prov.descMarcaAutomovil like '%" . $descripcionMarca . "%'; ";

        $resultado = $this->conexion->query($consulta);
        if (!$resultado) {
            echo 'MySQL Error: ' . $this->conexion->error . "<br>";
            echo 'MySQL Error: ' . "Error al obtener Datos - " . $modulo;
            exit;
        }

        return $resultado;
    }

    /* public function obtenerDistritos($codigoProvincia){
      $modulo="MantenimientoDepartamentosEntity.obtenerDistritos";


      $consulta = "select codDistrito, ";//fila0
      $consulta .= "descDistrito ";//fila1
      $consulta .= "from distrito dis ";
      $consulta .= "where dis.codProvincia = '".$codigoProvincia."' ";

      $resultado = $this->conexion->query($consulta);
      if(!$resultado){
      echo 'MySQL Error: ' . $this->conexion->error."<br>";
      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
      exit;
      }

      return $resultado;
      } */

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }

}

?>
