<?php
include('../../utility/AbstractClass.php');
class MantenimientoUsuariosController extends AbstractClass{
	private $rutaEntityClases = "../../entity/mantenimiento/MantenimientoUsuariosEntity.php";
	private $usuarioEntityClases= "MantenimientoUsuariosEntity";
	private $rutaPerfilEntityClases = "../../entity/mantenimiento/MantenimientoPerfilesEntity.php";
	private $perfilEntityClases= "MantenimientoPerfilesEntity";

	private function invocarTablaMantenimientoUsuarios($htmlTabla){
		include('../../view/mantenimientos/TablaMantenimientoUsuarios.php');

		$tablaMantenimientoUsuarios = new TablaMantenimientoUsuarios;
		$tablaMantenimientoUsuarios -> mostrarTablaMantenimientoUsuarios($htmlTabla);
	}

	private function enviaCabeceraDetalleUsuarios($resultadoListaUsuarios){
		$arrayTitulos = array("Usuario","Estado Bloqueo","Intentos","Estado Usuario","Fecha Registro","Usuario Registro");
		$arrayBotones = array("Editar","Borrar");
		$arrayDatos = parent::_procesarLista($resultadoListaUsuarios);

		$htmlTabla = parent::_armarTabla($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	public function obtenerListaUsuarios($busqueda){
		$mantenimientoUsuariosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityClases,$this->usuarioEntityClases);
		$resultadoListaUsuarios = $mantenimientoUsuariosEntity -> obtenerListaUsuarios($busqueda);

		$htmlTabla = $this->enviaCabeceraDetalleUsuarios($resultadoListaUsuarios);

		$mantenimientoUsuariosEntity->cerrarConexion();

		$this->invocarTablaMantenimientoUsuarios($htmlTabla);
	}

	public function mostrarFormularioMantenimientoUsuarios($codigo){
		$mantenimientoPerfilesEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaPerfilEntityClases,$this->perfilEntityClases);
		$comboPerfiles = $mantenimientoPerfilesEntity -> obtenerListaPerfiles('','');

		while($row = $comboPerfiles->fetch_array() ){
			$arrayComboPerfiles[] = $row;
		}

		$mantenimientoUsuariosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityClases,$this->usuarioEntityClases);

		if($codigo==''){
			$arrayUsuario = array();
		}else{
			$resultadoUsuarios = $mantenimientoUsuariosEntity -> obtenerUsuario($codigo);

			while($row = $resultadoUsuarios->fetch_array() ){
				$arrayUsuario[] = $row;
			}

			$mantenimientoUsuariosEntity->cerrarConexion();
		}

		include('../../view/mantenimientos/FormMantenimientoUsuarios.php');
		$formMantenimientoUsuarios = new FormMantenimientoUsuarios;
		$formMantenimientoUsuarios -> mostrarFormMantenimientoUsuarios($arrayUsuario,$arrayComboPerfiles);
	}

	public function guardarFormularioMantenimientoUsuarios($validatorForm,$usuario,$estadoBloqueo,$intentos,$estadoUsuario,$perfil){
		$mantenimientoUsuariosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityClases,$this->usuarioEntityClases);

		if ($validatorForm == 'N'){
			$mantenimientoUsuariosEntity -> insertarUsuario($usuario,$estadoBloqueo,$intentos,$estadoUsuario,$perfil);
		}else if($validatorForm == 'M'){
			$mantenimientoUsuariosEntity -> modificarUsuario($usuario,$estadoBloqueo,$intentos,$estadoUsuario,$perfil);
		}

		$resultadoListaUsuarios = $mantenimientoUsuariosEntity -> obtenerListaUsuarios('');

		$htmlTabla = $this->enviaCabeceraDetalleUsuarios($resultadoListaUsuarios);

		$mantenimientoUsuariosEntity->cerrarConexion();

		$this->invocarTablaMantenimientoUsuarios($htmlTabla);
	}
};
?>