<?php
include('../../utility/AbstractClass.php');
class MantenimientoPerfilesController extends AbstractClass{
	private function declaraEntityMantenimientoPerfiles($conexion){
		include('../../entity/mantenimiento/MantenimientoPerfilesEntity.php');
		$mantenimientoPerfilesEntity = new MantenimientoPerfilesEntity($conexion);

		return $mantenimientoPerfilesEntity;
	}

	private function procesarListaPerfiles($resultadoListaPerfiles){
		while($row = $resultadoListaPerfiles->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Descripcion","Estado","Fecha Registro","Usuario Registro");
		$arrayBotones = array("Editar","Borrar");

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaMantenimientoPerfiles($htmlTabla){
		include('../../view/mantenimientos/TablaMantenimientoPerfiles.php');

		$tablaMantenimientoPerfiles = new TablaMantenimientoPerfiles;
		$tablaMantenimientoPerfiles -> mostrarTablaMantenimientoPerfiles($htmlTabla);
	}

	public function obtenerListaPerfiles($busqueda){
		$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());
		$resultadoListaPerfiles = $mantenimientoPerfilesEntity -> obtenerListaPerfiles($busqueda,'');

		$htmlTabla = $this->procesarListaPerfiles($resultadoListaPerfiles);

		$mantenimientoPerfilesEntity->cerrarConexion();

		$this->invocarTablaMantenimientoPerfiles($htmlTabla);
	}

	public function mostrarFormularioMantenimientoPerfiles($codigo){

		$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());

		if($codigo==''){
			$arrayPerfiles = array();
		}else{
			$resultadoPerfiles = $mantenimientoPerfilesEntity -> obtenerPerfil($codigo);

			while($row = $resultadoPerfiles->fetch_array() ){
				$arrayPerfiles[] = $row;
			}

			$mantenimientoPerfilesEntity->cerrarConexion();
		}

		include('../../view/mantenimientos/FormMantenimientoPerfiles.php');
		$formMantenimientoPerfiles = new FormMantenimientoPerfiles;
		$formMantenimientoPerfiles -> mostrarFormMantenimientoPerfiles($arrayPerfiles);
	}

	public function guardarFormularioMantenimientoUsuarios($validatorForm,$codigo,$descripcionPerfil,$estadoPerfil){

		$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());

		if ($validatorForm == 'N'){
			$resultadoPerfiles = $mantenimientoPerfilesEntity -> insertarPerfil($descripcionPerfil,$estadoPerfil);
		}else if($validatorForm == 'M'){
			$resultadoPerfiles = $mantenimientoPerfilesEntity -> modificarPerfil($codigo,$descripcionPerfil,$estadoPerfil);
		}

		$resultadoListaPerfiles = $mantenimientoPerfilesEntity -> obtenerListaPerfiles('','');

		$htmlTabla = $this->procesarListaPerfiles($resultadoListaPerfiles);

		$mantenimientoPerfilesEntity->cerrarConexion();

		$this->invocarTablaMantenimientoPerfiles($htmlTabla);

	}
};
?>