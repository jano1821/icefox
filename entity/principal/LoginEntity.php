<?php
class LoginEntity{
	private $conexion;

	public function LoginEntity($conexion){
		$this->conexion = $conexion;
	}

	public function validarUsuario($usuario,$password){
		$modulo="validarUsuario";

		$consulta = "select codUsuarioSistema ";
	    $consulta .= "from usuariosistema ";
	    $consulta .= "where codUsuarioSistema='".$usuario."' ";
	    $consulta .= "and passwordUsuarioSistema='".$password."' ";
	    $consulta .= "and estadoBloqueoUsuarioSistema='V' ";
	    $consulta .= "and estadoRegistro='S';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener privilegios - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerMenuUsuario($nomUsuario){
		$modulo="obtenerMenuUsuario";

		$consulta = "SELECT ";
		$consulta .= "mesis.codMenuSistema, ";//fila0
	    $consulta .= "mesis.etiquetaMenuSistema, ";//fila1
	    $consulta .= "mesis.urlMenuSistema, ";//fila2
	    $consulta .= "mesis.nroOrdenMenuSistema, ";//fila3
	    $consulta .= "mesis.codSubGrupoSistema ";//fila4
	    $consulta .= "FROM ";
	    $consulta .= "menusistema mesis ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilmenusistema pmsis ON pmsis.codMenuSistema = mesis.codMenuSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilsistema pesis ON pesis.codPerfilUsuario = pmsis.codPerfilUsuario ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "usuariosistema ussis ON ussis.codPerfilUsuario = pesis.codPerfilUsuario ";
	    $consulta .= "WHERE ";
	    $consulta .= "ussis.codUsuarioSistema = '".$nomUsuario."' ";
	    $consulta .= "ORDER BY mesis.codSubGrupoSistema , mesis.nroOrdenMenuSistema;";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener privilegios - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerSubGrupo($nomUsuario){
		$modulo="obtenerSubGrupo";

		$consulta = "SELECT ";
		$consulta .= "sgsis.codSubGrupoSistema, ";//fila0
	    $consulta .= "sgsis.descripcionSubGrupoSistema, ";//fila1
	    $consulta .= "sgsis.nroSubGrupoSistema, ";//fila2
	    $consulta .= "sgsis.codGrupoSistema ";//fila3
	    $consulta .= "FROM ";
	    $consulta .= "subgruposistema sgsis ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "menusistema mesis ON mesis.codSubGrupoSistema = sgsis.codSubGrupoSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilmenusistema pmsis ON pmsis.codMenuSistema = mesis.codMenuSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilsistema pesis ON pesis.codPerfilUsuario = pmsis.codPerfilUsuario ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "usuariosistema ussis ON ussis.codPerfilUsuario = pesis.codPerfilUsuario ";
	    $consulta .= "WHERE ";
	    $consulta .= "ussis.codUsuarioSistema = '".$nomUsuario."' ";
	    $consulta .= "AND sgsis.estadoRegistro = 'S' ";
	    $consulta .= "GROUP BY sgsis.codSubGrupoSistema , sgsis.descripcionSubGrupoSistema , sgsis.nroSubGrupoSistema ";
	    $consulta .= "ORDER BY sgsis.codGrupoSistema , sgsis.nroSubGrupoSistema; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener subgrupos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerGrupo($nomUsuario){
		$modulo="obtenerGrupo";

		$consulta = "SELECT ";
		$consulta .= "gusis.codGrupoSistema, ";//fila0
	    $consulta .= "gusis.descripcionGrupoSistema, ";//fila1
	    $consulta .= "gusis.nroOrdenGrupoSistema ";//fila2
	    $consulta .= "FROM ";
	    $consulta .= "gruposistema gusis ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "subgruposistema sgsis on sgsis.codGruposistema = gusis.codGrupoSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "menusistema mesis ON mesis.codSubGrupoSistema = sgsis.codSubGrupoSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilmenusistema pmsis ON pmsis.codMenuSistema = mesis.codMenuSistema ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "perfilsistema pesis ON pesis.codPerfilUsuario = pmsis.codPerfilUsuario ";
	    $consulta .= "INNER JOIN ";
	    $consulta .= "usuariosistema ussis ON ussis.codPerfilUsuario = pesis.codPerfilUsuario ";
	    $consulta .= "WHERE ";
	    $consulta .= "ussis.codUsuarioSistema = '".$nomUsuario."' ";
	    $consulta .= "AND gusis.estadoRegistro = 'S' ";
	    $consulta .= "GROUP BY gusis.codGrupoSistema , gusis.descripcionGrupoSistema , gusis.nroOrdenGrupoSistema ";
	    $consulta .= "ORDER BY gusis.nroOrdenGrupoSistema; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . $resultado."<br>";
	      echo 'MySQL Error: ' . "Error al obtener privilegios - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function actualizarIntentos($usuario,$cantidadIntentos,$estadoBloqueo){
		$modulo="actualizarIntentos";

		$consulta = "update usuariosistema ";
		$consulta .= "set contadorIntentos = ".$cantidadIntentos.", ";
		$consulta .= "estadoBloqueoUsuarioSistema = '".$estadoBloqueo."' ";
		$consulta .= "where codUsuarioSistema='".$usuario."' ";
		$consulta .= "and estadoBloqueoUsuarioSistema='V';";

		try{
			$this->conexion->query($consulta);
		}catch(Exception $e){
			echo "MySQL Error: ".$e."<br>";
		  	echo "MySQL Error: Error al actualizar los intentos - ".$modulo;
		  	exit;
		}
	}

	public function obtenerCantidadIntentos($usuario){
		$modulo="obtenerCantidadIntentos";

		$consulta = "select contadorIntentos ";
		$consulta .= "from usuariosistema ";
		$consulta .= "where codUsuarioSistema='".$usuario."';";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
		  	echo 'MySQL Error: ' . $resultado."<br>";
		  	echo 'MySQL Error: ' . "Error al obtener privilegios - ".$modulo;
		  	exit;
		}

		return $resultado;
	}

	public function cerrarConexion(){
			mysqli_close($this->conexion);
	}
}
?>