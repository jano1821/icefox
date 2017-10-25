<?php
class MantenimientoMenuSistemaEntity{
	private $conexion;

	public function MantenimientoMenuSistemaEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaMenuSistema($descMenu,$estado){
		$modulo="MantenimientoMenuSistemaEntity.obtenerListaMenuSistema";

		$consulta = "select codMenuSistema, ";//fila0
		$consulta .= "etiquetaMenuSistema, ";//fila1
		$consulta .= "urlMenuSistema, ";//fila2
		$consulta .= "nroOrdenMenuSistema, ";//fila3
		$consulta .= "codSubGrupoSistema ";//fila4
	    $consulta .= "FROM menusistema ";
	    $consulta .= "WHERE etiquetaMenuSistema like '%".$descMenu."%' ";
	    $consulta .= "and estadoRegistro like '%".$estado."%' ";
	    $consulta .= "order by nroOrdenMenuSistema;";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function obtenerMenuSistema($codigoMenu){
		$modulo="MantenimientoMenuSistemaEntity.obtenerMenuSistema";

		$consulta = "select codMenuSistema, ";//fila0
		$consulta .= "etiquetaMenuSistema, ";//fila1
		$consulta .= "urlMenuSistema, ";//fila2
		$consulta .= "nroOrdenMenuSistema, ";//fila3
		$consulta .= "codSubGrupoSistema, ";//fila4
		$consulta .= "codigoDescMenu ";//fila5
	    $consulta .= "FROM menusistema ";
	    $consulta .= "WHERE codMenuSistema = '".$codigoMenu."' ";
	    $consulta .= "and estadoRegistro = 'S';";

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