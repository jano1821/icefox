<?php
class MantenimientoTipoDocumentoEntity{
	private $conexion;

	public function MantenimientoTipoDocumentoEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaTiposDocumento($descripcion,$estado){
		$modulo="MantenimientoTipoDocumentoEntity.obtenerListaTiposDocumento";

		$consulta = "select tdoc.codTipoDocumento, ";//fila0
		$consulta .= "tdoc.descTipoDocumento ";//fila1
	    $consulta .= "from tipodocumento tdoc ";
	    $consulta .= "where tdoc.descTipoDocumento like '%".$descripcion."%' ";
	    $consulta .= "and tdoc.estadoRegistro like '%".$estado."%';";

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