<?php
class AbstractSession{
	public function finalyTransaction($modulo,$conexion,$consulta){

		$resultado = $conexion->query($consulta);

		if(!$resultado){
			echo 'MySQL Error: ' . $conexion->error."<br>";
			echo 'MySQL Error: ' . "Error en Consulta - ".$modulo;
			exit;
		}

		return $resultado;
	}
};
?>