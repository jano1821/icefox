<?php
class MantenimientoOpcionesPorPerfilEntity{
	private $conexion;

	public function MantenimientoOpcionesPorPerfilEntity($conexion){
		$this->conexion = $conexion;
	}

	public function quitarOpcionesPorPerfil($codigoPerfil){
		$modulo="MantenimientoOpcionesPorPerfilEntity.quitarOpcionesPorPerfil";

		$consulta = "delete from perfilmenusistema ";
	    $consulta .= "where codPerfilUsuario = ".$codigoPerfil.";";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function registrarOpcionesPorPerfil($codigoMenu,$codigoPerfil){
		$modulo="MantenimientoOpcionesPorPerfilEntity.registrarOpcionesPorPerfil";

		$consulta = "insert into perfilmenusistema(codPerfilUsuario,codMenuSistema) ";//fila0
		$consulta .= "values(".$codigoPerfil.",".$codigoMenu.");";

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
};
?>