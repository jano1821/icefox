<?php
include('../../utility/AbstractSession.php');
class DepositosEntity extends AbstractSession{
	private $conexion;

	public function DepositosEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaDepositosTabla($serie,$numero,$empleado,$puntoVenta,$limite,$cantidad){
		$modulo="DepositosEntity.obtenerListaEspecieValoradaTabla";

		$consulta = "select ";
		$consulta .= "dep.codDeposito, ";
		$consulta .= "dep.serieDeposito, ";
		$consulta .= "dep.numeroDeposito, ";
		$consulta .= "per1.nombreRazonSocial empleado, ";
		$consulta .= "per2.nombreRazonSocial punto_venta ";
		$consulta .= "FROM ";
		$consulta .= "Deposito dep ";
		$consulta .= "INNER JOIN ";
		$consulta .= "empleado emp ON emp.codPersona = dep.empleado ";
		$consulta .= "INNER JOIN ";
		$consulta .= "puntoventa puv ON puv.codPersona = dep.puntoVenta ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per1 ON per1.codPersona = emp.codPersona ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per2 ON per2.codPersona = puv.codPersona ";
		$consulta .= "WHERE ";
		$consulta .= "dep.serieDeposito LIKE '%".$serie."%' ";
		$consulta .= "AND dep.numeroDeposito LIKE '%".$numero."%' ";
		$consulta .= "AND per1.codPersona LIKE '%".$empleado."%' ";
		$consulta .= "AND per2.codPersona LIKE '%".$puntoVenta."%' ";
		$consulta .= "order by dep.codDeposito desc ";
		$consulta .= "limit ".$limite.",".$cantidad.";";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function insertarDeposito($serie,$numero,$gestor,$punto,$fecha,$estadoRegistro){
		$modulo="DepositosEntity.insertarDeposito";

		$fecha = str_replace('/', '-', $fecha);
		$fecha = date('Y-m-d', strtotime($fecha));

		$consulta = "insert into Deposito( ";
		$consulta .= "serieDeposito, ";
		$consulta .= "numeroDeposito, ";
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

	public function modificarDeposito($codigo,$serie,$numero,$gestor,$punto,$fecha,$estadoRegistro){
		$modulo="DepositosEntity.modificarDeposito";

		$fecha = str_replace('/', '-', $fecha);
		$fecha = date('Y-m-d', strtotime($fecha));

		$consulta = "update Deposito ";
		$consulta .= "set serieDeposito='".$serie."', ";
		$consulta .= "numeroDeposito='".$numero."', ";
		$consulta .= "puntoVenta='".$punto."', ";
		$consulta .= "empleado='".$gestor."', ";
		$consulta .= "fecha='".$fecha."', ";
		$consulta .= "estadoRegistro = '".$estadoRegistro."', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codDeposito = '".$codigo."';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerDeposito($codigo){
		$modulo="DepositosEntity.obtenerDeposito";

		$consulta = "select codDeposito, ";//0
		$consulta .= "serieDeposito, ";//1
		$consulta .= "numeroDeposito, ";//2
		$consulta .= "puntoVenta, ";//3
		$consulta .= "empleado, ";//4
		$consulta .= "fecha, ";//5
		$consulta .= "estadoRegistro, ";//6
		$consulta .= "fechaInsercion, ";//7
		$consulta .= "usuarioInsercion, ";//8
		$consulta .= "fechaModificacion, ";//9
		$consulta .= "usuarioModificacion ";//10
		$consulta .= "from Deposito ";
		$consulta .= "where codDeposito = '".$codigo."';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function obtenerCantidadRegistros($serie,$numero,$empleado,$puntoVenta){
		$modulo="DepositosEntity.obtenerCantidadRegistros";

		$consulta = "select count(dep.codDeposito) cant ";
		$consulta .= "FROM ";
		$consulta .= "Deposito dep ";
		$consulta .= "INNER JOIN ";
		$consulta .= "empleado emp ON emp.codPersona = dep.empleado ";
		$consulta .= "INNER JOIN ";
		$consulta .= "puntoventa puv ON puv.codPersona = dep.puntoVenta ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per1 ON per1.codPersona = emp.codPersona ";
		$consulta .= "INNER JOIN ";
		$consulta .= "persona per2 ON per2.codPersona = puv.codPersona ";
		$consulta .= "WHERE ";
		$consulta .= "dep.serieDeposito LIKE '%".$serie."%' ";
		$consulta .= "AND dep.numeroDeposito LIKE '%".$numero."%' ";
		$consulta .= "AND per1.nombreRazonSocial LIKE '%".$empleado."%' ";
		$consulta .= "AND per2.nombreRazonSocial LIKE '%".$puntoVenta."%';";

		return parent::finalyTransaction($modulo,$this->conexion,$consulta);
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>