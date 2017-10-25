<?php
class MantenimientoGrupoSistemaEntity{
	private $conexion;

	public function MantenimientoGrupoSistemaEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaGrupoSistema($descGrupo,$estado){
		$modulo="MantenimientoGrupoSistemaEntity.obtenerListaGrupoSistema";

		$consulta = "select codGrupoSistema, ";//fila0
		$consulta .= "descripcionGrupoSistema, ";//fila1
		$consulta .= "estadoRegistro, ";//fila2
		$consulta .= "fechaInsercion, ";//fila3
		$consulta .= "usuarioInsercion ";//fila4
	    $consulta .= "from gruposistema ";
	    $consulta .= "where descripcionGrupoSistema like '%".$descGrupo."%' ";
	    $consulta .= "and estadoRegistro like '%".$estado."%' ";
	    $consulta .= "order by nroOrdenGruposistema;";

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