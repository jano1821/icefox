<?php
class MantenimientoUbigeoEntity{
	private $conexion;

	public function MantenimientoUbigeoEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerDepartamentos(){
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
	}

	public function obtenerProvincias($codigoDepartamento){
		$modulo="MantenimientoDepartamentosEntity.obtenerProvincias";


		$consulta = "select prov.codProvincia, ";//fila0
		$consulta .= "prov.descProvincia ";//fila1
	    $consulta .= "from provincia prov ";
	    $consulta .= "where prov.codDepartamento = ".$codigoDepartamento."; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerDistritos($codigoProvincia){
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
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>