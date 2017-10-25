<?php
class LiquidacionProductoEntity extends AbstractSession{
	private $conexion;

	public function LiquidacionProductoEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerListaProductosPorLiquidacion($codLiquidacion){
		$modulo="LiquidacionProductoEntity.obtenerListaProductosPorLiquidacion";

		$consulta = "select pro.codProducto, ";
		$consulta .= "pro.numeroCertificado ";
		$consulta .= "from producto pro ";
		$consulta .= "inner join liquidacionproducto lpr on lpr.codProducto = pro.codProducto ";
		$consulta .= "where lpr.codLiquidacion = '".$codLiquidacion."' ";
		$consulta .= "and lpr.estadoRegistro = 'S' ";
		$consulta .= "order by lpr.codLiquidacion desc; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function insertarLiquidacionProductos($codLiquidacion,$codProducto,$estadoRegistro){
		$modulo="LiquidacionProductoEntity.insertarLiquidacionProductos";

		$consulta = "insert into liquidacionproducto( ";
		$consulta .= "codLiquidacion, ";
		$consulta .= "codProducto, ";
		$consulta .= "estadoRegistro, ";
		$consulta .= "fechaInsercion, ";
		$consulta .= "usuarioInsercion) ";
		$consulta .= "values( ";
		$consulta .= "'".$codLiquidacion."', ";
		$consulta .= "'".$codProducto."', ";
		$consulta .= "'".$estadoRegistro."', ";
		$consulta .= "CURDATE(), ";
		$consulta .= "'".$_SESSION['usuario']."');";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function modificarProductos($codigo){
		$modulo="LiquidacionProductoEntity.modificarProductos";

		$consulta = "update depositoproducto ";
		$consulta .= "set estadoRegistro='S', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codProducto in (select codProducto from liquidacionproducto where codLiquidacion = ".$codigo." and estadoRegistro = 'S') ";
		$consulta .= "and estadoRegistro = 'L'; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		$consulta = "update liquidacionproducto ";
		$consulta .= "set estadoRegistro='N', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codLiquidacion = '".$codigo."' ";
		$consulta .= "and estadoRegistro = 'S'; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function liquidarDepositos($codigo){
		$modulo="LiquidacionProductoEntity.liquidarDepositos";

		$consulta = "update depositoproducto ";
		$consulta .= "set estadoRegistro='L', ";
		$consulta .= "fechaModificacion=CURDATE(), ";
		$consulta .= "usuarioModificacion='".$_SESSION['usuario']."' ";
		$consulta .= "where codProducto = '".$codigo."' ";
		$consulta .= "and estadoRegistro = 'S'; ";

		$resultado = $this->conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $this->conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>