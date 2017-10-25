<?php
include('../../utility/AbstractSession.php');
class LiquidacionesEntity extends AbstractSession{
	private $conexion;

	public function LiquidacionesEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaLiquidacionesTabla($serie,$numero,$empleado,$puntoVenta,$limite,$cantidad){
		$modulo="LiquidacionesEntity.obtenerListaLiquidacionesTabla";

		$consulta = "select ";
		$consulta .= "dep.codLiquidacion, ";
		$consulta .= "dep.serieLiquidacion, ";
		$consulta .= "dep.numeroLiquidacion, ";
		$consulta .= "per1.nombreRazonSocial empleado, ";
		$consulta .= "per2.nombreRazonSocial punto_venta ";
		$consulta .= "FROM ";
		$consulta .= "liquidacion dep ";
		$consulta .= "INNER JOIN ";
		$consulta .= "empleado emp ON emp.codPersona = dep.empleado ";
		$consulta .= "INNER JOIN ";
		$consulta .= "puntoventa puv ON puv.codPersona = dep.puntoVenta ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per1 ON per1.codPersona = emp.codPersona ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per2 ON per2.codPersona = puv.codPersona ";
		$consulta .= "WHERE ";
		$consulta .= "dep.serieLiquidacion LIKE '%".$serie."%' ";
		$consulta .= "AND dep.numeroLiquidacion LIKE '%".$numero."%' ";
		$consulta .= "AND per1.codPersona LIKE '%".$empleado."%' ";
		$consulta .= "AND per2.codPersona LIKE '%".$puntoVenta."%' ";
		$consulta .= "order by dep.codLiquidacion desc ";
		$consulta .= "limit ".$limite.",".$cantidad.";";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function insertarLiquidacion($serie,$numero,$gestor,$punto,$fecha,$estadoRegistro){
		$modulo="LiquidacionesEntity.insertarLiquidacion";

		$fecha = str_replace('/', '-', $fecha);
		$fecha = date('Y-m-d', strtotime($fecha));

		$consulta = "insert into liquidacion( ";
		$consulta .= "serieliquidacion, ";
		$consulta .= "numeroliquidacion, ";
		$consulta .= "puntoVenta, ";
		$consulta .= "empleado, ";
		$consulta .= "fecha, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion) ";
		$consulta .= "values( ";
		$consulta .= "'".$serie."', ";
		$consulta .= "'".$numero."', ";
		$consulta .= "'".$punto."', ";
		$consulta .= "'".$gestor."', ";
		$consulta .= "'".$fecha."', ";
		$consulta .= "'".$estadoRegistro."', ";
		$consulta .= "CURDATE(), ";
		$consulta .= "'".$_SESSION['usuario']."');";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $this->conexion->insert_id;

	}

	public function modificarLiquidacion($codigo,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro){
		$modulo="LiquidacionesEntity.modificarLiquidacion";

		$fecha = str_replace('/', '-', $fecha);
		$fecha = date('Y-m-d', strtotime($fecha));

		$consulta = "update liquidacion ";
		$consulta .= "set serieliquidacion='".$serie."', ";
		$consulta .= "numeroliquidacion='".$numero."', ";
		$consulta .= "puntoVenta='".$punto."', ";
		$consulta .= "empleado='".$gestor."', ";
		$consulta .= "fecha='".$fecha."', ";
		$consulta .= "estadoRegistro = '".$estadoRegistro."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codLiquidacion = '".$codigo."';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerLiquidacion($codigo){
		$modulo="LiquidacionesEntity.obtenerLiquidacion";

		$consulta = "select codLiquidacion, ";//0
		$consulta .= "serieLiquidacion, ";//1
		$consulta .= "numeroLiquidacion, ";//2
		$consulta .= "puntoVenta, ";//3
		$consulta .= "empleado, ";//4
		$consulta .= "fecha, ";//5
		$consulta .= "estadoRegistro, ";//6
		$consulta .= "fechaInsercion, ";//7
		$consulta .= "usuarioInsercion, ";//8
		$consulta .= "fechaModificacion, ";//9
		$consulta .= "usuarioModificacion ";//10
		$consulta .= "from liquidacion ";
		$consulta .= "where codLiquidacion = '".$codigo."';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerCantidadRegistros($serie,$numero,$empleado,$puntoVenta){
		$modulo="LiquidacionesEntity.obtenerCantidadRegistros";

		$consulta = "select count(dep.codLiquidacion) cant ";
		$consulta .= "FROM ";
		$consulta .= "liquidacion dep ";
		$consulta .= "INNER JOIN ";
		$consulta .= "empleado emp ON emp.codPersona = dep.empleado ";
		$consulta .= "INNER JOIN ";
		$consulta .= "puntoventa puv ON puv.codPersona = dep.puntoVenta ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per1 ON per1.codPersona = emp.codPersona ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per2 ON per2.codPersona = puv.codPersona ";
		$consulta .= "WHERE ";
		$consulta .= "dep.serieLiquidacion LIKE '%".$serie."%' ";
		$consulta .= "AND dep.numeroLiquidacion LIKE '%".$numero."%' ";
		$consulta .= "AND per1.nombreRazonSocial LIKE '%".$empleado."%' ";
		$consulta .= "AND per2.nombreRazonSocial LIKE '%".$puntoVenta."%';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>