<?php
class MantenimientoSubGrupoSistemaEntity{
	private $conexion;

	public function MantenimientoSubGrupoSistemaEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaSubGrupoSistema($descSubGrupo,$estado){
		$modulo="MantenimientoSubGrupoSistemaEntity.obtenerListaSubGrupoSistema";

		$consulta = "select codSubGrupoSistema, ";//fila0
		$consulta .= "descripcionSubGrupoSistema, ";//fila1
		$consulta .= "codGrupoSistema, ";//fila2
		$consulta .= "estadoRegistro, ";//fila3
		$consulta .= "fechaInsercion, ";//fila4
		$consulta .= "usuarioInsercion ";//fila5
	    $consulta .= "from subgruposistema ";
	    $consulta .= "where descripcionSubGrupoSistema like '%".$descSubGrupo."%' ";
	    $consulta .= "and estadoRegistro like '%".$estado."%' ";
	    $consulta .= "order by nroSubGrupoSistema;";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Datos - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}
}
?>