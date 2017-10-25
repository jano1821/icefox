<?php
class MantenimientoUsuariosEntity{

	private $conexion;

	public function MantenimientoUsuariosEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaUsuarios($valor){
		$modulo="MantenimientoUsuariosEntity.obtenerListaUsuarios";

		$consulta = "select codUsuarioSistema, ";//fila0
		$consulta .= "estadoBloqueoUsuarioSistema, ";//fila1
		$consulta .= "contadorIntentos, ";//fila2
		$consulta .= "estadoRegistro, ";//fila3
		$consulta .= "fechaInsercion, ";//fila4
		$consulta .= "usuarioInsercion, ";//fila5
		$consulta .= "codPerfilUsuario ";//fila6
	    $consulta .= "from usuariosistema ";
	    $consulta .= "where codUsuarioSistema like '%".$valor."%';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener privilegios - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerUsuario($codigo){
		$modulo="MantenimientoUsuariosEntity.obtenerUsuario";

		$consulta = "select codUsuarioSistema, ";//fila0
		$consulta .= "estadoBloqueoUsuarioSistema, ";//fila1
		$consulta .= "contadorIntentos, ";//fila2
		$consulta .= "estadoRegistro, ";//fila3
		$consulta .= "codPerfilUsuario ";//fila4
	    $consulta .= "from usuariosistema ";
	    $consulta .= "where codUsuarioSistema = '".$codigo."';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Data - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function insertarUsuario($usuario,$estadoBloqueo,$intentos,$estadoUsuario,$perfil){
		$modulo="MantenimientoUsuariosEntity.insertarUsuario";

		$consulta = "insert into usuariosistema( ";
		$consulta .= "codUsuarioSistema, ";
		$consulta .= "estadoBloqueoUsuarioSistema, ";
		$consulta .= "contadorIntentos, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion, ";
		$consulta .= "codPerfilUsuario) ";
	    $consulta .= "values( ";
	    $consulta .= "'".$usuario."',";
	    $consulta .= "'".$estadoBloqueo."',";
	    $consulta .= "".$intentos.",";
	    $consulta .= "'".$estadoUsuario."',";
	    $consulta .= "CURDATE(), ";
	    $consulta .= "'".$_SESSION['usuario']."',";
	    $consulta .= "'".$perfil."');";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al insertar Usuario - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function modificarUsuario($usuario,$estadoBloqueo,$intentos,$estadoUsuario,$perfil){
		$modulo="MantenimientoUsuariosEntity.modificarUsuario";

		$consulta = "update usuariosistema ";
		$consulta .= "set estadoBloqueoUsuarioSistema='".$estadoBloqueo."', ";
		$consulta .= "contadorIntentos=".$intentos.", ";
		$consulta .= "estadoRegistro='".$estadoUsuario."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."', ";
		$consulta .= "codPerfilUsuario='".$perfil."' ";
	    $consulta .= "where codUsuarioSistema = '".$usuario."';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al actualizar usuario - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>