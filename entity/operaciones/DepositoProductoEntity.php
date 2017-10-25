<?php
class DepositoProductoEntity extends AbstractSession{
	private $conexion;

	public function DepositoProductoEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaProductosPorDeposito($codDeposito){
		$modulo="DepositoProductoEntity.obtenerListaProductosPorDeposito";

		$consulta = "select pro.codProducto, ";
		$consulta .= "pro.numeroCertificado ";
		$consulta .= "from producto pro ";
		$consulta .= "inner join depositoproducto dpr on dpr.codProducto = pro.codProducto ";
		$consulta .= "where dpr.codDeposito = '".$codDeposito."' ";
		$consulta .= "and dpr.estadoRegistro = 'S' ";
		$consulta .= "order by dpr.correlativoHistorico; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function insertarProductos($codDeposito,$codProducto,$estadoRegistro){
		$modulo="DepositoProductoEntity.insertarProductos";

		$consulta = "call prc_insertardepositoproducto( ";
		$consulta .= $codDeposito.", ";
		$consulta .= $codProducto.", ";
		$consulta .= "'".$estadoRegistro."', ";
		$consulta .= "'".$_SESSION['usuario']."'); ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function modificarProductos($codigo){
		$modulo="DepositoProductoEntity.modificarDeposito";

		$consulta = "update depositoproducto ";
		$consulta .= "set estadoRegistro='N', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codDeposito = '".$codigo."' ";
		$consulta .= "and estadoRegistro = 'S'; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	/*public function obtenerDeposito($codigo){
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
	}*/

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>