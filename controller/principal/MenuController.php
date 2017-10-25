<?php
class MenuController{
	private $conexion = null;

	public function establishConnection(){
		include('../../inc/ConectarBD.php');
		$conectarBD = new ConectarBD;
		$this->conexion = $conectarBD -> conectar();
	}

	public function getconnection(){
		return $this->conexion;
	}

	public function setConnection($conexion){
		if ($conexion!=null){
			$this->conexion = $conexion;
		}
	}

	private function declaraEntityMantenimientoMenuSistema($conexion){
		include('../../entity/mantenimiento/MantenimientoMenuSistemaEntity.php');
		$mantenimientoMenuSistemaEntity = new MantenimientoMenuSistemaEntity($conexion);

		return $mantenimientoMenuSistemaEntity;
	}

	public function obtenerMenuPorCodigo($codigo){

		$mantenimientoMenuSistemaEntity = $this->declaraEntityMantenimientoMenuSistema($this->conexion);
		$resultadoMenu = $mantenimientoMenuSistemaEntity -> obtenerMenuSistema($codigo);

		while($row = $resultadoMenu->fetch_array()){
			$Menu[] = $row;
		}

		return $Menu;
	}

	public function cerrarconexion(){
		mysqli_close($this->conexion);
	}
}
?>