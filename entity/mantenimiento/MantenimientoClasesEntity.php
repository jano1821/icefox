<?php
class MantenimientoClasesEntity{
	private $conexion;

	public function MantenimientoClasesEntity($conexion){
		$this->conexion = $conexion;
	}

	public function obtenerClasePorPersona($codigo){
		$modulo="MantenimientoClasesEntity.obtenerClasePorPersona";


		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from proveedor prov ";
	    $consulta .= "where prov.codPersona = '".$codigo."' ";
		$consulta .= "union all ";
	    $consulta .= "select ifnull(count(codPersona),0) codPersona ";//fila1
	    $consulta .= "from empleado emp ";
	    $consulta .= "where emp.codPersona = '".$codigo."' ";
		$consulta .= "union all ";
	    $consulta .= "select ifnull(count(codPersona),0) codPersona ";//fila2
	    $consulta .= "from cliente cli ";
	    $consulta .= "where cli.codPersona = '".$codigo."' ";
	    $consulta .= "union all ";
	    $consulta .= "select ifnull(count(codPersona),0) codPersona ";//fila3
	    $consulta .= "from puntoventa pv ";
	    $consulta .= "where pv.codPersona = '".$codigo."';";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al obtener Data - ".$modulo." Cliente";
	      exit;
	    }

	    return $resultado;
	}

	public function insertarClaseProveedor($codigo){
		$modulo="MantenimientoClasesEntity.insertarClaseProveedor";

		$consulta = "insert into proveedor( ";
		$consulta .= "codPersona) ";
		$consulta .= "values('".$codigo."'); ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al insertar proveedor - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function insertarClaseEmpleado($codigo){
		$modulo="MantenimientoClasesEntity.insertarClaseEmpleado";

		$consulta = "insert into empleado( ";
		$consulta .= "codPersona) ";
		$consulta .= "values('".$codigo."'); ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al insertar empleado - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function insertarClaseCliente($codigo){
		$modulo="MantenimientoClasesEntity.insertarClaseCliente";

		$consulta = "insert into cliente( ";
		$consulta .= "codPersona) ";
		$consulta .= "values('".$codigo."'); ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al insertar cliente - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function insertarClasePuntoVenta($codigo){
		$modulo="MantenimientoClasesEntity.insertarClasePuntoVenta";

		$consulta = "insert into puntoventa( ";
		$consulta .= "codPersona) ";
		$consulta .= "values('".$codigo."'); ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al insertar proveedor - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function eliminarClaseProveedor($codigo){
		$modulo="MantenimientoClasesEntity.eliminarClaseProveedor";

		$consulta = "delete from proveedor ";
		$consulta .= "where codPersona='".$codigo."'; ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "error al elminar proveedor - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function eliminarClaseEmpleado($codigo){
		$modulo="MantenimientoClasesEntity.eliminarClaseEmpleado";

		$consulta = "delete from empleado ";
		$consulta .= "where codPersona='".$codigo."'; ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al eliminar empleado - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function eliminarClaseCliente($codigo){
		$modulo="MantenimientoClasesEntity.eliminarClaseCliente";

		$consulta = "delete from cliente ";
		$consulta .= "where codPersona='".$codigo."'; ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al eliminar cliente - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function eliminarClasePuntoVenta($codigo){
		$modulo="MantenimientoClasesEntity.eliminarClasePuntoVenta";

		$consulta = "delete from puntoventa ";
		$consulta .= "where codPersona='".$codigo."'; ";

		$resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "error al elminar proveedor - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function buscarClaseProveedor($codigo){
		$modulo="MantenimientoClasesEntity.buscarClaseProveedor";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from proveedor prov ";
	    $consulta .= "where prov.codPersona = '".$codigo."' ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al actualizar Perfil - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function buscarClaseEmpleado($codigo){
		$modulo="MantenimientoClasesEntity.buscarClaseEmpleado";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from empleado emp ";
	    $consulta .= "where emp.codPersona = '".$codigo."' ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al buscar empleado - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function buscarClaseCliente($codigo){
		$modulo="MantenimientoClasesEntity.buscarClaseCliente";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from cliente cli ";
	    $consulta .= "where cli.codPersona = '".$codigo."' ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al buscar cliente - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function buscarClasePuntoVenta($codigo){
		$modulo="MantenimientoClasesEntity.buscarClasePuntoVenta";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from puntoventa emp ";
	    $consulta .= "where emp.codPersona = '".$codigo."' ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al buscar empleado - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function evaluarDependenciasProveedores($codigo){
		$modulo="MantenimientoClasesEntity.evaluarDependenciasProveedores";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from producto pro ";
	    $consulta .= "where pro.codPersona = '".$codigo."'; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al evaluar dependencias de Proveedor - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function evaluarDependenciasEmpleados($codigo){
		$modulo="MantenimientoClasesEntity.evaluarDependenciasEmpleados";

		$consulta = "select ifnull(count(codPersona),0) codPersona ";//fila0
	    $consulta .= "from usuariosistema sis ";
	    $consulta .= "where sis.codPersona = '".$codigo."'; ";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al evaluar dependencias de empleado - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function evaluarDependenciasClientes($codigo){
		$modulo="MantenimientoClasesEntity.evaluarDependenciasClientes";

		$consulta = "select 0 codPersona ";//fila0
	    $consulta .= "from dual;";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al evaluar dependencias del cliente - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function evaluarDependenciasPuntoventa($codigo){
		$modulo="MantenimientoClasesEntity.evaluarDependenciasPuntoventa";

		$consulta = "select 0 codPersona ";//fila0
	    $consulta .= "from dual;";

	    $resultado = $this->conexion->query($consulta);
	    if(!$resultado){
	      echo 'MySQL Error: ' . $this->conexion->error."<br>";
	      echo 'MySQL Error: ' . "Error al evaluar dependencias de Punto de venta - ".$modulo;
	      exit;
	    }

	    return $resultado;
	}

	public function cerrarConexion(){
		mysqli_close($this->conexion);
	}
}
?>