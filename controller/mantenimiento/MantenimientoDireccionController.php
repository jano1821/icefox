
<?php
include('../../utility/AbstractClass.php');
class MantenimientoDireccionController extends AbstractClass{
	private $rutaEntityDirecciones = "../../entity/mantenimiento/MantenimientoDireccionEntity.php";
	private $claseEntityDirecciones= "MantenimientoDireccionEntity";
	private $rutaEntityUbigeo = "../../entity/mantenimiento/MantenimientoUbigeoEntity.php";
	private $claseEntityUbigeo= "MantenimientoUbigeoEntity";

	private function procesarListaDirecciones($resultadoListaDirecciones){
		$arrayDatos = array();
		while($row = $resultadoListaDirecciones->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Direccion","Principal","Distrito","Estado");
		$arrayBotones = array("Editar","Quitar");

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaMantenimientoDirecciones($htmlTabla,$codigoPersona){
		include('../../view/mantenimientos/TablaMantenimientoDirecciones.php');

		$tablaMantenimientoDirecciones = new TablaMantenimientoDirecciones;
		$tablaMantenimientoDirecciones -> mostrarTablaMantenimientoDirecciones($htmlTabla,$codigoPersona);
	}

	public function obtenerListaDirecciones($codigoPersona){
		$mantenimientoDireccionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityDirecciones,$this->claseEntityDirecciones);
		$resultadoListaDirecciones = $mantenimientoDireccionEntity -> obtenerListaDirecciones($codigoPersona);

		$htmlTabla = $this->procesarListaDirecciones($resultadoListaDirecciones);

		$mantenimientoDireccionEntity->cerrarConexion();

		$this->invocarTablaMantenimientoDirecciones($htmlTabla,$codigoPersona);
	}

	function mostrarFormMantenimientoDirecciones($codigoPersona,$correlativo){
		$mantenimientoDireccionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityDirecciones,$this->claseEntityDirecciones);
		$arrayDirecciones = array();
		$arrayDepartamentos = array();
		if ($correlativo!=''){
			 $resultadoDirecciones = $mantenimientoDireccionEntity -> obtenerDireccion($codigoPersona,$correlativo);
			 $arrayDirecciones = parent::_procesarLista($resultadoDirecciones);
		}
		$mantenimientoUbigeoEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityUbigeo,$this->claseEntityUbigeo);
		$resultadoListaDepartamentos = $mantenimientoUbigeoEntity->obtenerDepartamentos();
		$arrayDepartamentos = parent::_procesarLista($resultadoListaDepartamentos);

		include('../../view/mantenimientos/FormMantenimientoDirecciones.php');
		$formMantenimientoDirecciones = new FormMantenimientoDirecciones;
		$formMantenimientoDirecciones -> mostrarFormMantenimientoDirecciones($codigoPersona,$arrayDirecciones,$arrayDepartamentos);
	}

	public function guardarFormularioMantenimientoDirecciones($validatorForm,$codigo,$correlativo,$direccion,$distrito,$principal,$estadoRegistro){
		$mantenimientoDireccionEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityDirecciones,$this->claseEntityDirecciones);

		if ($validatorForm == 'N'){
			if ($correlativo==''){
				$resultado = $mantenimientoDireccionEntity->obtenerMaxDireccion($codigo);

				while($row = $resultado->fetch_array()){
					$array[] = $row;
				}

				$correlativo = $array[0][0];
			}
			$correlativo = $correlativo + 1;
			$resultadoListaDirecciones = $mantenimientoDireccionEntity -> insertarDireccion($codigo,$correlativo,$direccion,$distrito,$principal,$estadoRegistro);
		}else if($validatorForm == 'M'){
			$resultadoListaDirecciones = $mantenimientoDireccionEntity -> modificarDireccion($codigo,$correlativo,$direccion,$distrito,$principal,$estadoRegistro);
		}

		$resultadoListaDirecciones = $mantenimientoDireccionEntity -> obtenerListaDirecciones($codigo);

		$htmlTabla = $this->procesarListaDirecciones($resultadoListaDirecciones);

		$mantenimientoDireccionEntity->cerrarConexion();

		$this->invocarTablaMantenimientoDirecciones($htmlTabla,$codigo);

	}
};
?>