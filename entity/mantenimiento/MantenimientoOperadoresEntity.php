<?php
class MantenimientoOperadoresEntity{
	private $conexion;

	public function MantenimientoOperadoresEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaOperadores($descripcion,$estado){
		$modulo="MantenimientoTipoDocumentoEntity.obtenerListaTiposDocumento";

		$consulta = "select ope.codOperadorTelefonico, ";//fila0
		$consulta .= "ope.descOperador ";//fila1
		$consulta .= "from operadortelefonico ope ";
		$consulta .= "where ope.descOperador like '%".$descripcion."%' ";
		$consulta .= "and ope.estadoRegistro like '%".$estado."%';";

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