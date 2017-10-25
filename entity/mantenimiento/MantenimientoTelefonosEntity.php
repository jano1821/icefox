<?php
include('../../utility/AbstractSession.php');
class MantenimientoTelefonosEntity extends AbstractSession{
	private $conexion;

	public function MantenimientoTelefonosEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaTelefonos($codigoPersona){
		$modulo="MantenimientoTelefonosEntity.obtenerListaTelefonos";

		$consulta = "select tel.corrTelefono, ";
		$consulta .= "tel.numeroTelefono, ";
		$consulta .= "ot.descOperador, ";
		$consulta .= "CASE tel.indicadorPrincipal WHEN 'S' THEN 'Si' WHEN 'N' THEN 'No' END principal, ";
		$consulta .= "CASE tel.tipoTelefono WHEN 'C' THEN 'Celular' WHEN 'F' THEN 'Fijo' END tipo, ";
		$consulta .= "CASE tel.estadoRegistro WHEN 'S' THEN 'Activo' WHEN 'N' THEN 'Inactivo' END estado ";
		$consulta .= "from telefono tel ";
		$consulta .= "inner join operadortelefonico ot on ot.codOperadorTelefonico = tel.codOperadorTelefonico ";
		$consulta .= "where tel.codPersona = '".$codigoPersona."' ";
		$consulta .= "order by tel.corrTelefono desc; ";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerTelefono($codigoPersona,$correlativo){
		$modulo="MantenimientoTelefonosEntity.obtenerTelefono";

		$consulta = "select tel.codPersona, ";//0
		$consulta .= "tel.corrTelefono, ";//1
		$consulta .= "tel.numeroTelefono, ";//2
		$consulta .= "tel.codOperadorTelefonico, ";//3
		$consulta .= "tel.indicadorPrincipal, ";//4
		$consulta .= "tel.tipoTelefono, ";//5
		$consulta .= "tel.estadoRegistro ";//6
		$consulta .= "from telefono tel ";
		$consulta .= "where tel.codPersona = ".$codigoPersona." ";
		$consulta .= "and tel.corrTelefono = ".$correlativo.";";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerMaxTelefono($codigoPersona){
		$modulo="MantenimientoTelefonosEntity.obtenerMaxTelefono";

		$consulta = "select max(tel.corrTelefono) ";//0
		$consulta .= "from telefono tel ";
		$consulta .= "where tel.codPersona = ".$codigoPersona."; ";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function insertarTelefono($codigo,$correlativo,$numeroTelefono,$operador,$principal,$tipo,$estadoRegistro){
		$modulo="MantenimientoTelefonosEntity.insertarTelefono";

		$consulta = "insert into telefono( ";
		$consulta .= "codPersona, ";
		$consulta .= "corrTelefono, ";
		$consulta .= "numeroTelefono, ";
		$consulta .= "codOperadorTelefonico, ";
		$consulta .= "indicadorPrincipal, ";
		$consulta .= "tipoTelefono, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion) ";
	    $consulta .= "values( ";
	    $consulta .= "'".$codigo."',";
	    $consulta .= "'".$correlativo."',";
	    $consulta .= "'".$numeroTelefono."',";
	    $consulta .= "'".$operador."',";
	    $consulta .= "'".$principal."',";
	    $consulta .= "'".$tipo."',";
	    $consulta .= "'".$estadoRegistro."',";
	    $consulta .= "CURDATE(), ";
	    $consulta .= "'".$_SESSION['usuario']."');";

	    return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function modificarTelefono($codigo,$correlativo,$numeroTelefono,$operador,$principal,$tipo,$estadoRegistro){
		$modulo="MantenimientoTelefonosEntity.modificarTelefono";

		$consulta = "update telefono ";
		$consulta .= "set numeroTelefono='".$numeroTelefono."', ";
		$consulta .= "codOperadorTelefonico='".$operador."', ";
		$consulta .= "indicadorPrincipal='".$principal."', ";
		$consulta .= "tipoTelefono='".$tipo."', ";
		$consulta .= "estadoRegistro='".$estadoRegistro."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
	    $consulta .= "where codPersona = ".$codigo." ";
	    $consulta .= "and corrTelefono = ".$correlativo."; ";

	    return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>