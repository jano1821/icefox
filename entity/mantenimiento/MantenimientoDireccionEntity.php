<?php
include('../../utility/AbstractSession.php');
class MantenimientoDireccionEntity extends AbstractSession{
	private $conexion;

	public function MantenimientoDireccionEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaDirecciones($codigoPersona){
		$modulo="MantenimientoDireccionEntity.obtenerListaDirecciones";

		$consulta = "select dir.corrDireccion, ";
		$consulta .= "dir.descDireccion, ";
		$consulta .= "CASE dir.indicadorDireccionPrincipal WHEN 'S' THEN 'Si' WHEN 'N' THEN 'No' END principal, ";
		$consulta .= "dis.descDistrito, ";
		$consulta .= "CASE dir.estadoRegistro WHEN 'S' THEN 'Activo' WHEN 'N' THEN 'Inactivo' END estado ";
		$consulta .= "from direccion dir ";
		$consulta .= "inner join distrito dis on dis.codDistrito = dir.codDistrito ";
		$consulta .= "where dir.codPersona = '".$codigoPersona."' ";
		$consulta .= "order by dir.corrDireccion desc; ";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerDireccion($codigoPersona,$correlativo){
		$modulo="MantenimientoDireccionEntity.obtenerDireccion";

		$consulta = "select dir.codPersona, ";//0
		$consulta .= "dir.corrDireccion, ";//1
		$consulta .= "dir.descDireccion, ";//2
		$consulta .= "dir.codDistrito, ";//3
		$consulta .= "pro.codProvincia, ";//4
		$consulta .= "dep.codDepartamento, ";//5
		$consulta .= "dir.indicadorDireccionPrincipal, ";//6
		$consulta .= "dir.estadoRegistro ";//7
		$consulta .= "from direccion dir ";
		$consulta .= "inner join distrito dis on dis.codDistrito = dir.codDistrito ";
		$consulta .= "inner join provincia pro on pro.codProvincia = dis.codProvincia ";
		$consulta .= "inner join departamento dep on dep.codDepartamento = pro.codDepartamento ";
		$consulta .= "where dir.codPersona = ".$codigoPersona." ";
		$consulta .= "and dir.corrDireccion = ".$correlativo.";";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerMaxDireccion($codigoPersona){
		$modulo="MantenimientoDireccionEntity.obtenerMaxDireccion";

		$consulta = "select max(dir.corrDireccion) ";//0
		$consulta .= "from direccion dir ";
		$consulta .= "where dir.codPersona = ".$codigoPersona."; ";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function insertarDireccion($codigo,$correlativo,$direccion,$distrito,$principal,$estadoRegistro){
		$modulo="MantenimientoDireccionEntity.insertarDireccion";

		$consulta = "insert into direccion( ";
		$consulta .= "codPersona, ";
		$consulta .= "corrDireccion, ";
		$consulta .= "descDireccion, ";
		$consulta .= "codDistrito, ";
		$consulta .= "indicadorDireccionPrincipal, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion) ";
		$consulta .= "values( ";
		$consulta .= "'".$codigo."',";
		$consulta .= "'".$correlativo."',";
		$consulta .= "'".$direccion."',";
		$consulta .= "'".$distrito."',";
		$consulta .= "'".$principal."',";
		$consulta .= "'".$estadoRegistro."',";
		$consulta .= "CURDATE(), ";
		$consulta .= "'".$_SESSION['usuario']."');";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function modificarDireccion($codigo,$correlativo,$direccion,$distrito,$principal,$estadoRegistro){
		$modulo="MantenimientoDireccionEntity.modificarDireccion";

		$consulta = "update direccion ";
		$consulta .= "set descDireccion='".$direccion."', ";
		$consulta .= "codDistrito='".$distrito."', ";
		$consulta .= "indicadorDireccionPrincipal='".$principal."', ";
		$consulta .= "estadoRegistro='".$estadoRegistro."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codPersona = ".$codigo." ";
		$consulta .= "and corrDireccion = ".$correlativo."; ";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>