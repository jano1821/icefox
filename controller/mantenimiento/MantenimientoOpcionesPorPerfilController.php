<?php
include('../../utility/AbstractClass.php');
class MantenimientoOpcionesPorPerfilController extends AbstractClass{

	private function declaraEntityMantenimientoPerfiles($conexion){
		include('../../entity/mantenimiento/MantenimientoPerfilesEntity.php');
		$mantenimientoPerfilesEntity = new MantenimientoPerfilesEntity($conexion);

		return $mantenimientoPerfilesEntity;
	}

	private function declaraEntityMantenimientoOpcionesPorPerfil($conexion){
		include('../../entity/mantenimiento/MantenimientoOpcionesPorPerfilEntity.php');
		$mantenimientoOpcionesPorPerfilEntity = new MantenimientoOpcionesPorPerfilEntity($conexion);

		return $mantenimientoOpcionesPorPerfilEntity;
	}

	private function procesarListaPerfiles($resultadoListaPerfiles){
		while($row = $resultadoListaPerfiles->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Descripcion","Estado","Fecha Registro","Usuario Registro");
		$arrayBotones = array("Mostrar Opciones");

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaMantenimientoOpcionesPorPerfil($htmlTabla){
		include('../../view/mantenimientos/TablaMantenimientoOpcionesPorPerfil.php');

		$tablaMantenimientoOpcionesPorPerfil = new TablaMantenimientoOpcionesPorPerfil;
		$tablaMantenimientoOpcionesPorPerfil -> mostrarTablaMantenimientoOpcionesPorPerfil($htmlTabla);
	}

	public function obtenerListaPerfiles($busqueda){

		$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());
		$resultadoListaPerfiles = $mantenimientoPerfilesEntity -> obtenerListaPerfiles($busqueda,'');

		$htmlTabla = $this->procesarListaPerfiles($resultadoListaPerfiles);

		$mantenimientoPerfilesEntity->cerrarConexion();

		$this->invocarTablaMantenimientoOpcionesPorPerfil($htmlTabla);
	}

	public function mostrarFormMantenimientoOpcionesPorPerfil($codigoPerfil){

		$arrayGrupos=array();
		$arraySubgrupos=array();
		$arrayMenu=array();
		$MenuPerfil=array();
		$descripcionPerfil;

		include('../../entity/mantenimiento/MantenimientoGrupoSistemaEntity.php');
		$mantenimientoGrupoSistemaEntity = new MantenimientoGrupoSistemaEntity(parent::getConnection());
		$resultadoListaGrupo = $mantenimientoGrupoSistemaEntity -> obtenerListaGrupoSistema('','S');

		while($row = $resultadoListaGrupo->fetch_array()){
			$arrayGrupos[] = $row;
		}

		include('../../entity/mantenimiento/MantenimientoSubGrupoSistemaEntity.php');
		$mantenimientoSubGrupoSistemaEntity = new MantenimientoSubGrupoSistemaEntity(parent::getConnection());
		$resultadoListaSubGrupo = $mantenimientoSubGrupoSistemaEntity -> obtenerListaSubGrupoSistema('','S');

		while($row = $resultadoListaSubGrupo->fetch_array()){
			$arraySubgrupos[] = $row;
		}

		include('../../entity/mantenimiento/MantenimientoMenuSistemaEntity.php');
		$mantenimientoMenuSistemaEntity = new mantenimientoMenuSistemaEntity(parent::getConnection());
		$resultadoListaMenu = $mantenimientoMenuSistemaEntity -> obtenerListaMenuSistema('','S');

		while($row = $resultadoListaMenu->fetch_array()){
			$arrayMenu[] = $row;
		}

		if($codigoPerfil==''){
			$descripcionPerfil = "No Determinado";
		}else{

			$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());
			$resultadoPerfil = $mantenimientoPerfilesEntity -> obtenerPerfil($codigoPerfil);

			while($row = $resultadoPerfil->fetch_array() ){
				$descripcionPerfil = $row[1];
			}

			$resultadoPerfil = $mantenimientoPerfilesEntity -> obtenerMenuPorPerfil($codigoPerfil);

			while($row = $resultadoPerfil->fetch_array() ){
				$MenuPerfil[] = $row;
			}

			$mantenimientoPerfilesEntity -> cerrarConexion();
		}

		include('../../view/mantenimientos/FormMantenimientoOpcionesPorPerfil.php');
		$formMantenimientoOpcionesPorPerfil = new FormMantenimientoOpcionesPorPerfil;
		$formMantenimientoOpcionesPorPerfil -> mostrarFormMantenimientoOpcionesPorPerfil($arrayGrupos,$arraySubgrupos,$arrayMenu,$MenuPerfil,$codigoPerfil,$descripcionPerfil);
	}

	public function guardarFormularioMantenimientoOpcionesPorPerfil($menusSeleccionados,$codigoPerfil){

		$mantenimientoOpcionesPorPerfilEntity = $this->declaraEntityMantenimientoOpcionesPorPerfil(parent::getConnection());

		$mantenimientoOpcionesPorPerfilEntity -> quitarOpcionesPorPerfil($codigoPerfil);

		for ($index=0;$index<count($menusSeleccionados);$index++){
			$mantenimientoOpcionesPorPerfilEntity -> registrarOpcionesPorPerfil($menusSeleccionados[$index],$codigoPerfil);
		}

		$mantenimientoPerfilesEntity = $this->declaraEntityMantenimientoPerfiles(parent::getConnection());
		$resultadoListaPerfiles = $mantenimientoPerfilesEntity -> obtenerListaPerfiles('','');

		$htmlTabla = $this->procesarListaPerfiles($resultadoListaPerfiles);

		$mantenimientoOpcionesPorPerfilEntity -> cerrarConexion();

		$this->invocarTablaMantenimientoOpcionesPorPerfil($htmlTabla);
	}
};
?>