<?php
include('../../utility/AbstractClass.php');
class MantenimientoTelefonosController extends AbstractClass{
	private $rutaEntityTelefonos = "../../entity/mantenimiento/MantenimientoTelefonosEntity.php";
	private $claseEntityTelefonos= "MantenimientoTelefonosEntity";
	private $rutaEntityOperador = "../../entity/mantenimiento/MantenimientoOperadoresEntity.php";
	private $claseEntityOperador= "MantenimientoOperadoresEntity";

	private function procesarListaTelefonos($resultadoListaTelefonos){
		$arrayDatos = array();
		while($row = $resultadoListaTelefonos->fetch_array()){
			$arrayDatos[] = $row;
		}

		$arrayTitulos = array("","Numero Tel.","Operador","Principal","Tipo","Estado");
		$arrayBotones = array("Editar","Quitar");

		$htmlTabla = parent::_armarTablaSinCodigoVisible($arrayTitulos,$arrayDatos,$arrayBotones);

		return $htmlTabla;
	}

	private function invocarTablaMantenimientoTelefonos($htmlTabla,$codigoPersona){
		include('../../view/mantenimientos/TablaMantenimientoTelefonos.php');

		$tablaMantenimientoTelefonos = new TablaMantenimientoTelefonos;
		$tablaMantenimientoTelefonos -> mostrarTablaMantenimientoTelefonos($htmlTabla,$codigoPersona);
	}

	public function obtenerListaTelefonos($codigoPersona){
		$mantenimientoTelefonosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityTelefonos,$this->claseEntityTelefonos);
		$resultadoListaTelefonos = $mantenimientoTelefonosEntity -> obtenerListaTelefonos($codigoPersona);

		$htmlTabla = $this->procesarListaTelefonos($resultadoListaTelefonos);

		$mantenimientoTelefonosEntity->cerrarConexion();

		$this->invocarTablaMantenimientoTelefonos($htmlTabla,$codigoPersona);
	}


	function mostrarFormMantenimientoTelefonos($codigoPersona,$correlativo){
		$mantenimientoTelefonosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityTelefonos,$this->claseEntityTelefonos);
		$arrayTelefonos = array();
		$arrayOperadores = array();
		if ($correlativo!=''){
			 $resultadoListaTelefonos = $mantenimientoTelefonosEntity -> obtenerTelefono($codigoPersona,$correlativo);
			 $arrayTelefonos = parent::_procesarLista($resultadoListaTelefonos);
		}
		$mantenimientoOperadoresEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityOperador,$this->claseEntityOperador);
		$resultadoListaOperadores = $mantenimientoOperadoresEntity -> obtenerListaOperadores('','S');
		$arrayOperadores = parent::_procesarLista($resultadoListaOperadores);

		include('../../view/mantenimientos/FormMantenimientoTelefonos.php');
		$formMantenimientoTelefonos = new FormMantenimientoTelefonos;
		$formMantenimientoTelefonos -> mostrarFormMantenimiento($codigoPersona,$arrayTelefonos,$arrayOperadores);
	}

	public function guardarFormularioMantenimientoTelefonos($validatorForm,$codigo,$correlativo,$numeroTelefono,$operador,$principal,$tipo,$estadoRegistro){
		$mantenimientoTelefonosEntity = parent::_declaraEntity(parent::getConnection(),$this->rutaEntityTelefonos,$this->claseEntityTelefonos);

		if ($validatorForm == 'N'){
			if ($correlativo==''){
				$resultado = $mantenimientoTelefonosEntity->obtenerMaxTelefono($codigo);

				while($row = $resultado->fetch_array()){
					$array[] = $row;
				}

				$correlativo = $array[0][0];
			}
			$correlativo = $correlativo + 1;
			$resultadoListaTelefonos = $mantenimientoTelefonosEntity -> insertarTelefono($codigo,$correlativo,$numeroTelefono,$operador,$principal,$tipo,$estadoRegistro);
		}else if($validatorForm == 'M'){
			$resultadoListaTelefonos = $mantenimientoTelefonosEntity -> modificarTelefono($codigo,$correlativo,$numeroTelefono,$operador,$principal,$tipo,$estadoRegistro);
		}

		$resultadoListaTelefonos = $mantenimientoTelefonosEntity -> obtenerListaTelefonos($codigo);

		$htmlTabla = $this->procesarListaTelefonos($resultadoListaTelefonos);

		$mantenimientoTelefonosEntity->cerrarConexion();

		$this->invocarTablaMantenimientoTelefonos($htmlTabla,$codigo);

	}
};
?>