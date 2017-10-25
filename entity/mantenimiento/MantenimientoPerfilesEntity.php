<?php
class MantenimientoPerfilesEntity{
	private $conexion;

	public function MantenimientoPerfilesEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaPerfiles($descPerfil,$estado){
		$modulo="MantenimientoPerfilesEntity.obtenerListaPerfiles";

		$consulta = "select codPerfilUsuario, ";//fila0
		$consulta .= "descripcionPerfilUsuario, ";//fila1
		$consulta .= "estadoRegistro, ";//fila2
		$consulta .= "fechaInsercion, ";//fila3
		$consulta .= "usuarioInsercion ";//fila4
	    $consulta .= "from perfilsistema ";
	    $consulta .= "where descripcionPerfilUsuario like '%".$descPerfil."%' ";
	    $consulta .= "and estadoRegistro like '%".$estado."%';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerPerfil($codigo){
		$modulo="MantenimientoPerfilesEntity.obtenerPerfil";

		$consulta = "select codPerfilUsuario, ";//fila0
		$consulta .= "descripcionPerfilUsuario, ";//fila1
		$consulta .= "estadoRegistro ";//fila2
	    $consulta .= "from perfilsistema ";
	    $consulta .= "where codPerfilUsuario = '".$codigo."';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Data - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function insertarPerfil($descripcionPerfil,$estadoPerfil){
		$modulo="MantenimientoPerfilesEntity.insertarPerfil";

		$consulta = "insert into perfilsistema( ";
		$consulta .= "descripcionPerfilUsuario, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion) ";
	    $consulta .= "values( ";
	    $consulta .= "'".$descripcionPerfil."',";
	    $consulta .= "'".$estadoPerfil."',";
	    $consulta .= "CURDATE(), ";
	    $consulta .= "'".$_SESSION['usuario']."');";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al insertar Perfil - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function modificarPerfil($codigoPerfil,$descripcionPerfil,$estadoPerfil){
		$modulo="MantenimientoPerfilesEntity.modificarPerfil";

		$consulta = "update perfilsistema ";
		$consulta .= "set descripcionPerfilUsuario='".$descripcionPerfil."', ";
		$consulta .= "estadoRegistro='".$estadoPerfil."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
	    $consulta .= "where codPerfilUsuario = '".$codigoPerfil."';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al actualizar Perfil - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerMenuPorPerfil($codigoPerfil){
		$modulo="MantenimientoPerfilesEntity.obtenerMenuPorPerfil";

		$consulta = "select codMenuSistema ";
		$consulta .= "from perfilmenusistema ";
		$consulta .= " where codPerfilUsuario='".$codigoPerfil."'; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al actualizar Perfil - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>